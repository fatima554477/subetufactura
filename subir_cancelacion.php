<?php
/*
fecha fatis : 04/04/2024

*/

if(!isset($_SESSION)) { session_start(); }

$identioficador = isset($_POST["personal_id"]) ? $_POST["personal_id"] : '';

if($identioficador != '') {
    $output = '';
    require "controladorPP.php";

    $queryVISTAPREV = $pagoproveedores->Listado_pagoproveedor2($identioficador);

    while($row = mysqli_fetch_array($queryVISTAPREV)) {

        $row2xml = $pagoproveedores->busca_02XML($row['id']);
        $conn    = $pagoproveedores->db();

        // ── Obtener TODOS los archivos desde 02SUBETUFACTURADOCTOS ────────
        $columnasArchivos = [
            'ADJUNTAR_FACTURA_XML',
            'ADJUNTAR_FACTURA_PDF',
            'ADJUNTAR_COTIZACION',
            'CONPROBANTE_TRANSFERENCIA',
            'ACUSE_CANCELACION',
            'FOTO_ESTADO_PROVEE11',
            'COMPLEMENTOS_PAGO_PDF',
            'COMPLEMENTOS_PAGO_XML',
            'CANCELACIONES_PDF',
            'CANCELACIONES_XML',
            'ADJUNTAR_FACTURA_DE_COMISION_PDF',
            'ADJUNTAR_FACTURA_DE_COMISION_XML',
            'CALCULO_DE_COMISION',
            'COMPROBANTE_DE_DEVOLUCION',
            'NOTA_DE_CREDITO_COMPRA',
            'ADJUNTAR_ARCHIVO_1',
        ];

        $archivosActuales = array_fill_keys($columnasArchivos, '');
        $listaDoctos      = array_fill_keys($columnasArchivos, '');
 $camposSinBorrado = [

            'ADJUNTAR_FACTURA_XML',

            'ADJUNTAR_FACTURA_PDF',

        ];

        $qArchivos = mysqli_query($conn,
            "SELECT * FROM 02SUBETUFACTURADOCTOS 
             WHERE idTemporal = '" . intval($row['id']) . "' 
             ORDER BY id DESC"
        );

        if ($qArchivos) {
            while ($rowDoc = mysqli_fetch_assoc($qArchivos)) {
                foreach ($columnasArchivos as $col) {
                    if (!empty($rowDoc[$col])) {
                        if ($archivosActuales[$col] === '') {
                            $archivosActuales[$col] = $rowDoc[$col];
                        }
                                              // ── FIX: agregado span Borrar para que view_dataSBborrar2 funcione ──

                        $accionBorrar = in_array($col, $camposSinBorrado, true)

                            ? ''

                            : " <span id='" . $rowDoc['id'] . "' class='view_dataSBborrar2' style='cursor:pointer;color:blue;'>Borrar!</span>";

                        $listaDoctos[$col] .=
                            "<a target='_blank' href='includes/archivos/" . $rowDoc[$col] . "'>Visualizar!</a>"
                                           . $accionBorrar
                            . " <span>" . $rowDoc['fechaingreso'] . "</span><br/>";
                    }
                }
            }
        }
        // ─────────────────────────────────────────────────────────────────

        // ── Status de pago (disabled + hidden para enviar el valor) ──────
        $SOLICITADO = $APROBADO = $PAGADO = $RECHAZADO = '';
        if($row['STATUS_DE_PAGO'] == "SOLICITADO")    { $SOLICITADO = "selected"; }
        elseif($row['STATUS_DE_PAGO'] == "APROBADO")  { $APROBADO   = "selected"; }
        elseif($row['STATUS_DE_PAGO'] == "PAGADO")    { $PAGADO     = "selected"; }
        elseif($row['STATUS_DE_PAGO'] == "RECHAZADO") { $RECHAZADO  = "selected"; }

        $STATUS_DE_PAGO  = '<select required name="STATUS_DE_PAGO" disabled>';
        $STATUS_DE_PAGO .= '<option value="SOLICITADO" ' . $SOLICITADO . '>SOLICITADO</option>';
        $STATUS_DE_PAGO .= '<option value="APROBADO"   ' . $APROBADO   . '>APROBADO</option>';
        $STATUS_DE_PAGO .= '<option value="PAGADO"     ' . $PAGADO     . '>PAGADO</option>';
        $STATUS_DE_PAGO .= '<option value="RECHAZADO"  ' . $RECHAZADO  . '>RECHAZADO</option>';
        $STATUS_DE_PAGO .= '</select>';
        $STATUS_DE_PAGO .= '<input type="hidden" name="STATUS_DE_PAGO" value="' . $row['STATUS_DE_PAGO'] . '">';

        // ── Bloqueo de fecha si ya está aprobado/pagado ───────────────────
        $fechaDePagoBloqueada    = '';
        $fechaProgramacionColor  = '#dfd9f3';
        if (in_array($row['STATUS_DE_PAGO'], ['APROBADO', 'PAGADO'])) {
            $fechaDePagoBloqueada   = ' readonly="readonly" style="background:#d7bde2"';
        }

        // ── Factura XML/PDF siempre bloqueadas en esta vista ─────────────

        // ── Helper zona de carga ACTIVA ───────────────────────────────────
        $zonaArchivo = function($campo, $valor, $historial, $extraAttr = '', $zoneStyle = 'style="width:300px;"') {
            return '
            <div id="drop_file_zone" ondrop="upload_file2(event,\''.$campo.'\')" ondragover="return false" '.$zoneStyle.'>
                <p>Suelta aquí o busca tu archivo</p>
                <p><input class="form-control form-control-sm" id="'.$campo.'" type="text"
                    onkeydown="return false"
                    onclick="file_explorer2(\''.$campo.'\');"
                    style="width:250px;"
                    VALUE="'.$valor.'"
                    required'.$extraAttr.' /></p>
                <input type="file" name="'.$campo.'" id="nono"'.$extraAttr.'/>
                <div id="3'.$campo.'">'.$historial.'</div>
            </div>';
        };

        // ── Helper zona de carga BLOQUEADA (igual que vista 2) ───────────
        $zonaArchivoBloqueada = function($campo, $valor, $historial) {
            return '
            <div id="drop_file_zone" style="width:300px; background-color:#d7bde2;">
                <p style="color:#999;">Suelta aquí o busca tu archivo</p>
                <p>
                    <input
                        class="form-control form-control-sm"
                        id="'.$campo.'"
                        type="text"
                        readonly
                        style="width:250px; background-color:#e9ecef;"
                        value="'.$valor.'"
                        required
                    />
                </p>
                <input type="file" name="'.$campo.'" id="nono" style="display:none;" disabled />
                <div id="3'.$campo.'">'.$historial.'</div>
            </div>';
        };

        // ── Bloque XML ────────────────────────────────────────────────────
        $campos_xml = '';
        if ($row2xml["Version"] == 'no' || $row2xml["Version"] == '') {
            $campos_xml = '
            <tr style="background:#fbf696;">
                <td width="30%"><label>NOMBRE RECEPTOR</label></td>
                <td width="70%"><input type="text" readonly style="background:#d7bde2" name="nombreR" value="'.$row2xml["nombreR"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>RFC RECEPTOR</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="rfcR" value="'.$row2xml["rfcR"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>RÉGIMEN FISCAL</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="regimenE" value="'.$row2xml["regimenE"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>UUID</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="UUID" value="'.$row2xml["UUID"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>FOLIO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="folio" value="'.$row2xml["folio"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>SERIE</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="serie" value="'.$row2xml["serie"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>CLAVE DE UNIDAD</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="ClaveUnidadConcepto" value="'.$row2xml["ClaveUnidadConcepto"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>FORMA DE PAGO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="formaDePago" value="'.$row2xml["formaDePago"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>CANTIDAD</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="CantidadConcepto" value="'.$row2xml["CantidadConcepto"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>CLAVE DE PRODUCTO O SERVICIO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="ClaveProdServConcepto" value="'.$row2xml["ClaveProdServConcepto"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>DESCRIPCIÓN</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="DescripcionConcepto" value="'.$row2xml["DescripcionConcepto"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>MONEDA</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="Moneda" value="'.$row2xml["Moneda"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>TIPO DE CAMBIO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="TipoCambio" value="'.$row2xml["TipoCambio"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>USO DE CFDI</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="UsoCFDI" value="'.$row2xml["UsoCFDI"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>MÉTODO DE PAGO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="metodoDePago" value="'.$row2xml["metodoDePago"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>CONDICIONES DE PAGO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="condicionesDePago" value="'.$row2xml["condicionesDePago"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>TIPO DE COMPROBANTE</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="tipoDeComprobante" value="'.$row2xml["tipoDeComprobante"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>VERSIÓN</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="Version" value="'.$row2xml["Version"].'"></td>
            </tr>
            <input type="hidden" name="actualiza" value="true">
            <tr style="background:#fbf696;">
                <td><label>FECHA DE TIMBRADO</label></td>
                <td><input type="date" readonly style="background:#d7bde2" name="fechaTimbrado" value="'.$row2xml["fechaTimbrado"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>SUBTOTAL</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="subTotal" value="'.$row2xml["subTotal"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>SERVICIO, PROPINA, ISH Y SANEAMIENTO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="Propina" value="'.$row2xml["Propina"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>DESCUENTO</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="DESCUENTO" value="'.$row2xml["Descuento"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>TOTAL DE IMPUESTOS TRASLADADOS</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="TImpuestosTrasladados" value="'.$row2xml["TImpuestosTrasladados"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>TOTAL DE IMPUESTOS RETENIDOS</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="TImpuestosRetenidos" value="'.$row2xml["TImpuestosRetenidos"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>TUA</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="TUA" value="'.$row2xml["TUA"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>TUA TOTAL CARGOS</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="TuaTotalCargos" value="'.$row2xml["TuaTotalCargos"].'"></td>
            </tr>
            <tr style="background:#fbf696;">
                <td><label>TOTAL</label></td>
                <td><input type="text" readonly style="background:#d7bde2" name="totalf" value="'.$row2xml["totalf"].'"></td>
            </tr>';
        }

        // ── Campos hidden (no editables en esta vista) ────────────────────
        $hiddens  = '<input type="hidden" name="ACTIVO_FIJO"                      value="'.$row["ACTIVO_FIJO"].'">
                     <input type="hidden" name="GASTO_FIJO"                       value="'.$row["GASTO_FIJO"].'">
                     <input type="hidden" name="PAGAR_CADA"                       value="'.$row["PAGAR_CADA"].'">
                     <input type="hidden" name="FECHA_PPAGO"                      value="'.$row["FECHA_PPAGO"].'">
                     <input type="hidden" name="FECHA_TPROGRAPAGO"                value="'.$row["FECHA_TPROGRAPAGO"].'">
                     <input type="hidden" name="NUMERO_EVENTOFIJO"                value="'.$row["NUMERO_EVENTOFIJO"].'">
                     <input type="hidden" name="CLASI_GENERAL"                    value="'.$row["CLASI_GENERAL"].'">
                     <input type="hidden" name="SUB_GENERAL"                      value="'.$row["SUB_GENERAL"].'">
                     <input type="hidden" name="BANCO_ORIGEN"                     value="'.$row["BANCO_ORIGEN"].'">
                     <input type="hidden" name="PLACAS_VEHICULO"                  value="'.$row["PLACAS_VEHICULO"].'">
                     <input type="hidden" name="MONTO_DE_COMISION"                value="'.$row["MONTO_DE_COMISION"].'">
                     <input type="hidden" name="PFORMADE_PAGO"                    value="'.$row["PFORMADE_PAGO"].'">
                     <input type="hidden" name="TIPO_CAMBIOP"                     value="'.$row["TIPO_CAMBIOP"].'">
                     <input type="hidden" name="TOTAL_ENPESOS"                    value="'.$row["TOTAL_ENPESOS"].'">
                     <input type="hidden" name="MONTO_DEPOSITADO"                 value="'.$row["MONTO_DEPOSITADO"].'">
                     <input type="hidden" name="TIPO_DE_MONEDA"                   value="'.$row["TIPO_DE_MONEDA"].'">
                     <input type="hidden" name="NOMBRE_COMERCIAL"                 value="'.$row["NOMBRE_COMERCIAL"].'">
                     <input type="hidden" name="RAZON_SOCIAL"                     value="'.$row["RAZON_SOCIAL"].'">
                     <input type="hidden" name="RFC_PROVEEDOR"                    value="'.$row["RFC_PROVEEDOR"].'">
                     <input type="hidden" name="NUMERO_EVENTO"                    value="'.$row["NUMERO_EVENTO"].'">
                     <input type="hidden" name="NOMBRE_EVENTO"                    value="'.$row["NOMBRE_EVENTO"].'">
                     <input type="hidden" name="CONCEPTO_PROVEE"                  value="'.$row["CONCEPTO_PROVEE"].'">
                     <input type="hidden" name="VIATICOSOPRO"                     value="'.$row["VIATICOSOPRO"].'">
                     <input type="hidden" name="NUMERO_CONSECUTIVO_PROVEE"        value="'.$row["NUMERO_CONSECUTIVO_PROVEE"].'">
                     <input type="hidden" name="POLIZA_NUMERO"                    value="'.$row["POLIZA_NUMERO"].'">
                     <input type="hidden" name="NOMBRE_DEL_AYUDO"                 value="'.$row["NOMBRE_DEL_AYUDO"].'">
                     <input type="hidden" name="NOMBRE_DEL_EJECUTIVO"             value="'.$row["NOMBRE_DEL_EJECUTIVO"].'">
                     <input type="hidden" name="FECHA_A_DEPOSITAR"                value="'.$row["FECHA_A_DEPOSITAR"].'">
                     <input type="hidden" name="FECHA_DE_LLENADO"                 value="'.$row["FECHA_DE_LLENADO"].'">
                     <input type="hidden" name="TImpuestosRetenidosIVA"           value="'.$row["TImpuestosRetenidosIVA"].'">
                     <input type="hidden" name="TImpuestosRetenidosISR"           value="'.$row["TImpuestosRetenidosISR"].'">
                     <input type="hidden" name="descuentos"                       value="'.$row["descuentos"].'">
                     <input type="hidden" name="MOTIVO_GASTO"                     value="'.$row["MOTIVO_GASTO"].'">
                     <input type="hidden" name="MONTO_TOTAL_COTIZACION_ADEUDO"    value="'.$row["MONTO_TOTAL_COTIZACION_ADEUDO"].'">
                     <input type="hidden" name="MONTO_FACTURA"                    value="'.$row["MONTO_FACTURA"].'">
                     <input type="hidden" name="IVA"                              value="'.$row["IVA"].'">
                     <input type="hidden" name="MONTO_PROPINA"                    value="'.$row["MONTO_PROPINA"].'">
                     <input type="hidden" name="IMPUESTO_HOSPEDAJE"               value="'.$row["IMPUESTO_HOSPEDAJE"].'">
                     <input type="hidden" name="OBSERVACIONES_1"                  value="'.$row["OBSERVACIONES_1"].'">
                     <input type="hidden" name="CONPROBANTE_TRANSFERENCIA"        value="'.$archivosActuales['CONPROBANTE_TRANSFERENCIA'].'">
					  <input type="hidden" name="ACUSE_CANCELACION"        value="'.$archivosActuales['ACUSE_CANCELACION'].'">
                     <input type="hidden" name="COMPLEMENTOS_PAGO_PDF"            value="'.$archivosActuales['COMPLEMENTOS_PAGO_PDF'].'">
                     <input type="hidden" name="COMPLEMENTOS_PAGO_XML"            value="'.$archivosActuales['COMPLEMENTOS_PAGO_XML'].'">
                     <input type="hidden" name="CANCELACIONES_PDF"                value="'.$archivosActuales['CANCELACIONES_PDF'].'">
                     <input type="hidden" name="CANCELACIONES_XML"                value="'.$archivosActuales['CANCELACIONES_XML'].'">
                     <input type="hidden" name="ADJUNTAR_FACTURA_DE_COMISION_PDF" value="'.$archivosActuales['ADJUNTAR_FACTURA_DE_COMISION_PDF'].'">
                     <input type="hidden" name="ADJUNTAR_FACTURA_DE_COMISION_XML" value="'.$archivosActuales['ADJUNTAR_FACTURA_DE_COMISION_XML'].'">
                     <input type="hidden" name="CALCULO_DE_COMISION"              value="'.$archivosActuales['CALCULO_DE_COMISION'].'">
                     <input type="hidden" name="COMPROBANTE_DE_DEVOLUCION"        value="'.$archivosActuales['COMPROBANTE_DE_DEVOLUCION'].'">
                     <input type="hidden" name="NOTA_DE_CREDITO_COMPRA"           value="'.$archivosActuales['NOTA_DE_CREDITO_COMPRA'].'">
                     <input type="hidden" name="FOTO_ESTADO_PROVEE11"             value="'.$archivosActuales['FOTO_ESTADO_PROVEE11'].'">';

        // ── HTML de la vista ──────────────────────────────────────────────
        $output .= '
        <div id="respuestaser"></div>
        <form id="ListadoPAGOPROVEEform">
        <div class="table-responsive">
        <table class="table table-bordered">

<td width="70%">	<div id="drop_file_zone" ondrop="upload_file2(event,\'ACUSE_CANCELACION\')" ondragover="return false" style="width:300px;">
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="ACUSE_CANCELACION" type="text" onkeydown="return false" onclick="file_explorer2(\'ACUSE_CANCELACION\');" style="width:250px;" VALUE="'.$row["ACUSE_CANCELACION"] .' " required /></p>
<input type="file" name="ACUSE_CANCELACION" id="nono"/>
<div id="3ACUSE_CANCELACION">
'.$ACUSE_CANCELACION.'
</tr> 

        <tr>
            <td colspan="2">
                <table id="reseteaxml" style="width:100%;">'.$campos_xml.'</table>
            </td>
        </tr>

        <tr>
            <td><label>FECHA DE ÚLTIMA CARGA</label></td>
            <td><input type="text" readonly style="background:#decaf1" name="FECHA_DE_LLENADO" value="'.$row["FECHA_DE_LLENADO"].'"></td>
        </tr>

        </table>

        '.$hiddens.'

        <tr>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp
            <td>
                <button class="btn btn-sm btn-outline-success px-5" type="button" id="clickPAGOP">GUARDAR</button></td><td>
                <div id="respuestaser2" class="d-inline-block ms-3"><div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

        <!-- Botón CERRAR al lado -->
        <button class="btn btn-sm btn-outline-success px-5" type="button" data-bs-dismiss="modal">CERRAR</button>
                <input type="hidden" value="ENVIARPAGOprovee" name="ENVIARPAGOprovee"/>
                <input type="hidden" value="'.$row["id"].'" name="IPpagoprovee" id="IPpagoprovee"/>
            </td>
        </tr>

        </div>
        </form>';

    } // end while

    echo $output;
}
?>

<script>
(function () {

    function calcularTotal() {
        var ids = ['montoTotalEvento','montoTotalAvion','montoTotalpropina',
                   'montoTotalhospedaje','montoRetenidoIVA','montoRetenidoISR','montoDescuentos'];
        var vals = ids.map(function(id) {
            var el = document.getElementById(id);
            return parseFloat((el ? el.value : '0').replace(/,/g,'')) || 0;
        });
        var total = vals[0] + vals[1] + vals[2] + vals[3] - vals[4] - vals[5] - vals[6];
        var res = document.getElementById('montoTotalEventoResultado');
        if (res) res.value = total.toFixed(2);
    }

    // Calcular al cargar
    calcularTotal();

    // ── Guardar ───────────────────────────────────────────────────────────
    $(document).ready(function () {
        $(document)
            .off('click', '#clickPAGOP')
            .on('click',  '#clickPAGOP', function () {
                $.ajax({
                    url: "pagoproveedores/controladorPP.php",
                    method: "POST",
                    data: $('#ListadoPAGOPROVEEform').serialize(),
                    beforeSend: function () {
                        $('#mensajepagoproveedores').html('cargando...');
                    },
        success: function (data) {
                        var r = $.trim(data).toLowerCase();
                        if (r.indexOf('actualizado') !== -1 || r.indexOf('ingresado') !== -1) {
                            $('#dataModal').modal('hide');
                            if (typeof load === 'function') load(1);
                            $("#mensajepagoproveedores").html("<span id='ACTUALIZADO'>" + $.trim(data) + "</span>");
                            $("#respuestaser2").html("<span id='ACTUALIZADO'>" + $.trim(data) + "</span>");
                        } else {
                            if (r.indexOf('favor de llenar campos obligatorios') !== -1) {
                                $("#respuestaser2").html("<span id='ACTUALIZADO'>" + $.trim(data) + "</span>");
                                $("#mensajepagoproveedores").html('');
                            } else {
                                $("#mensajepagoproveedores").html(data);
                            }
                        }
                    }
                });
            });
    });


    // ── Subida de archivos (zonas activas: COMPLEMENTOS_PAGO_XML y COMPLEMENTOS_PAGO_PDF) ──
    window.upload_file2 = function (e, name) {
        e.preventDefault();
        ajax_file_upload2(e.dataTransfer.files[0], name);
    };

    window.file_explorer2 = function (name) {
        var input = document.getElementsByName(name)[0];
        if (!input) return;
        input.click();
        input.onchange = function () { ajax_file_upload2(input.files[0], name); };
    };

  function ajax_file_upload2(file_obj, nombre) {
    if (!file_obj) return;

    var form_data = new FormData();
    form_data.append(nombre, file_obj);
    form_data.append("IPpagoprovee", $("#IPpagoprovee").val());

    $.ajax({
        type: 'POST',
        url: 'pagoproveedores/controladorPP.php',
        dataType: 'html',
        contentType: false,
        processData: false,
        data: form_data,
        beforeSend: function () {
            $('#3' + nombre).html('<p style="color:green;"><span class="spinner-border spinner-border-sm"></span>&nbsp;Cargando archivo...</p>');
            $('#respuestaser').html('<p style="color:green;"><span class="spinner-border spinner-border-sm"></span>&nbsp;Cargando archivo...</p>');
        },
        success: function (response) {
            var resp = $.trim(response);

            // ── Archivo vacío (0 bytes) ───────────────────────────────────
            if (resp.indexOf('VACIO^^') === 0) {
                $('#3' + nombre).html(
                    '<p style="color:red;font-weight:600;">⚠️ EL ARCHIVO ESTÁ VACÍO (0 KB). ' +
                    'Verifica que el archivo tenga contenido antes de subirlo.</p>'
                );
                $('#' + nombre).val('');

            // ── Archivo sin extensión ─────────────────────────────────────
            } else if (resp.indexOf('SIN_EXTENSION^^') === 0) {
                $('#3' + nombre).html(
                    '<p style="color:red;font-weight:600;">⚠️ EL ARCHIVO NO TIENE EXTENSIÓN RECONOCIDA. ' +
                    'Asegúrate de que el nombre del archivo termine en .xml, .pdf, .jpg, etc.</p>'
                );
                $('#' + nombre).val('');

            // ── Error de subida al servidor ───────────────────────────────
            } else if (resp.indexOf('ERROR_SUBIDA^^') === 0) {
                $('#3' + nombre).html(
                    '<p style="color:red;font-weight:600;">⚠️ ERROR AL RECIBIR EL ARCHIVO EN EL SERVIDOR. ' +
                    'Puede que sea demasiado grande o que la conexión se haya interrumpido. ' +
                    'Intenta de nuevo.</p>'
                );
                $('#' + nombre).val('');

            // ── Formato no permitido genérico ─────────────────────────────
            } else if (resp === '2') {
                var exts = (nombre === 'ADJUNTAR_FACTURA_XML') ? 'XML' :
                           (nombre === 'ADJUNTAR_FACTURA_PDF') ? 'PDF' :
                           'PDF, JPG, PNG, DOCX, XML, XLSX, MP4, TXT u otro formato de documento';
                $('#3' + nombre).html(
                    '<p style="color:red;">⚠️ FORMATO DE ARCHIVO NO PERMITIDO. ' +
                    'Este campo acepta únicamente archivos en formato: <strong>' + exts + '</strong>.</p>'
                );
                $('#' + nombre).val('');

            // ── Error al mover el archivo en disco ────────────────────────
            } else if (resp === '1') {
                $('#3' + nombre).html(
                    '<p style="color:red;font-weight:600;">⚠️ ERROR AL GUARDAR EL ARCHIVO EN EL SERVIDOR. ' +
                    'Intenta de nuevo o contacta a soporte técnico.</p>'
                );
                $('#' + nombre).val('');

            // ── UUID duplicado en Pago Proveedores (02XML) ────────────────
            } else if (resp.indexOf('3^^') === 0) {
                var partes = resp.split('^^');
                var numeroSolicitud = partes[1] ? $.trim(partes[1]) : '';
                var numeroEvento    = partes[2] ? $.trim(partes[2]) : '';
                var detalleEvento   = numeroEvento !== ''
                    ? ' — Evento: <strong>' + numeroEvento + '</strong>'
                    : '';
                var msgDuplicado = numeroSolicitud !== ''
                    ? '<p style="color:red;font-weight:600;">⚠️ UUID YA REGISTRADO — Se encuentra en la solicitud: <strong>' + numeroSolicitud + '</strong>' + detalleEvento + '</p>'
                    : '<p style="color:red;font-weight:600;">⚠️ UUID PREVIAMENTE CARGADO.</p>';
                $('#3' + nombre).html(msgDuplicado);
                $('#' + nombre).val('');

            // ── UUID duplicado en Comprobación de Gastos (07XML) ──────────
            } else if (resp.indexOf('7^^^') === 0) {
                var partesGasto = resp.split('^^^');
                var numeroGasto = partesGasto[1] ? $.trim(partesGasto[1]) : '';
                var msgGasto = numeroGasto !== ''
                    ? '<p style="color:#C82909;font-weight:600;">⚠️ UUID YA REGISTRADO EN COMPROBACIÓN DE GASTOS — CON EL ID: <strong>' + numeroGasto + '</strong></p>'
                    : '<p style="color:#C82909;font-weight:600;">⚠️ UUID PREVIAMENTE CARGADO EN COMPROBACIÓN DE GASTOS.</p>';
                $('#3' + nombre).html(msgGasto);
                $('#' + nombre).val('');

            // ── XML vacío o sin timbre válido ─────────────────────────────
            } else if (resp.indexOf('5^^') === 0) {
                $('#3' + nombre).html(
                    '<p style="color:red;font-weight:600;">⚠️ EL ARCHIVO XML ESTÁ VACÍO O NO CONTIENE INFORMACIÓN VÁLIDA. ' +
                    'Verifica que sea un CFDI timbrado correctamente e inténtalo de nuevo.</p>'
                );
                $('#' + nombre).val('');

            // ── Receptor de factura no válido (no es EPC/INN/EVE520) ──────
            } else if (resp.indexOf('6^^') === 0) {
                var partesReceptor = resp.split('^^');
                var receptorXML    = partesReceptor[1] ? $.trim(partesReceptor[1]) : '';
                var msgReceptor = receptorXML !== ''
                    ? '⚠️ EL RECEPTOR DE LA FACTURA NO ES VÁLIDO: <strong>' + receptorXML + '</strong>. Debe ser EPC, INN o EVE520.'
                    : '⚠️ EL RECEPTOR DE LA FACTURA NO ES EPC, INN O EVE520.';
                $('#3' + nombre).html('<p style="color:red;font-weight:600;">' + msgReceptor + '</p>');
                $('#' + nombre).val('');

            // ── Éxito: archivo cargado correctamente ──────────────────────
            } else {
                var result = response.split('^^');
                $('#' + nombre).val($.trim(result[0] || ''));

                $('#3' + nombre).html('<p style="color:green;">✅ <a target="_blank" href="includes/archivos/' + $.trim(result[0]) + '">Visualizar archivo</a></p>');

                // ── Para XML de factura ──
                  if (nombre === 'ADJUNTAR_FACTURA_XML') {
                    var nombreArchivoXml = $.trim(result[0]);
                    $('#3' + nombre).html(
                        '<p style="color:green;">✅ <a target="_blank" href="includes/archivos/'
                        + nombreArchivoXml + '">Visualizar archivo</a> &nbsp;'
                        + '<span style="color:blue;cursor:pointer;" class="view_dataSBborrar2" id="'
                        + nombreArchivoXml + '">Borrar!</span></p>'
                    );

                    var formaPago = $.trim(result[2] || '');
                    if (formaPago.length) {
                        $('select[name="PFORMADE_PAGO_VISUAL"]').val(formaPago);
                        $('input[name="PFORMADE_PAGO"]').val(formaPago);
                    }

                    if ((result[1] || '').length > 1) {
                        $('#respuestaser').html(
                            '<p style="color:green;font-size:25px;font-weight:bolder;">XML CORRECTAMENTE CARGADO CON EL UUID:<br> '
                            + result[1] + '</p>'
                        );
                        $('#reseteaxml').remove();
                    }

                    recargarElementos([
                        '#3ADJUNTAR_FACTURA_XML',
                        '#RAZON_SOCIAL2', '#RFC_PROVEEDOR2', '#CONCEPTO_PROVEE2',
                        '#TIPO_DE_MONEDA2', '#FECHA_DE_PAGO2', '#NUMERO_CONSECUTIVO_PROVEE2',
                        '#2MONTO_FACTURA', '#2MONTO_DEPOSITAR', '#2PFORMADE_PAGO',
                        '#2IVA', '#2TImpuestosRetenidosIVA', '#2TImpuestosRetenidosISR',
                        '#2descuentos', '#NOMBRE_COMERCIAL2', '#resettabla'
                    ]);

                } else {
                    // ── Para todos los demás archivos (complementos, etc.) ──
                    var nombreArchivo = $.trim(result[0]);
                    var nuevoValor    = $.trim(result[1] || result[0]);

                    $('#3' + nombre).html(
                        '<p style="color:green;">✅ <a target="_blank" href="includes/archivos/'
                        + nombreArchivo + '">Visualizar!</a> &nbsp;'
                        + '<span style="color:blue;cursor:pointer;" class="view_dataSBborrar2" id="'
                        + nombreArchivo + '">Borrar!</span></p>'
                    );

                    // Actualizar el hidden para que el form envíe el nuevo archivo
                    $('input[name="' + nombre + '"]').val(nuevoValor);

                    $('#respuestaser').html('<p style="color:green;">✅ ¡Archivo cargado con éxito!</p>');
                    recargarElemento('#resettabla');
                }
            }
        }
    });
}

})();
</script>
