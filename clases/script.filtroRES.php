<script type="text/javascript">



function LIMPIAR(){
	load(1);

$("#NUMERO_CONSECUTIVO_PROVEE_1").val("");
$("#NOMBRE_COMERCIAL_1").val("");
$("#RAZON_SOCIAL_1").val("");
$("#VIATICOSOPRO_1").val("");
$("#RFC_PROVEEDOR_1").val("");
$("#NUMERO_EVENTO_1").val("");
$("#NOMBRE_EVENTO_1").val("");
$("#MOTIVO_GASTO_1").val("");
$("#CONCEPTO_PROVEE_1").val("");
$("#MONTO_TOTAL_COTIZACION_ADEUDO_1").val("");
$("#MONTO_FACTURA_1").val("");
$("#MONTO_PROPINA_1").val("");
$("#MONTO_DEPOSITAR_1").val("");
$("#TIPO_DE_MONEDA_1").val("");
$("#PFORMADE_PAGO_1").val("");

$("#FECHA_DE_PAGO").val("");
$("#FECHA_DE_PAGO2a").val("");

$("#FECHA_A_DEPOSITAR_1").val("");
 $("#STATUS_DE_PAGO_1").val("");
 $("#ACTIVO_FIJO_1").val("");
 $("#GASTO_FIJO_1").val("");
 $("#PAGAR_CADA_1").val("");
 $("#FECHA_PPAGO_1").val("");
 $("#FECHA_TPROGRAPAGO_1").val("");
 $("#NUMERO_EVENTOFIJO_1").val("");
 $("#CLASI_GENERAL_1").val("");
 $("#SUB_GENERAL_1").val("");
 $("#MONTO_DEPOSITADO_1").val("");
 $("#NUMERO_EVENTO1_1").val("");
 $("#CLASIFICACION_GENERAL_1").val("");
 $("#CLASIFICACION_ESPECIFICA_1").val("");
 $("#PLACAS_VEHICULO_1").val("");
 $("#MONTO_DE_COMISION_1").val("");
 $("#POLIZA_NUMERO_1").val("");
 $("#NOMBRE_DEL_EJECUTIVO_1").val("");
 $("#NOMBRE_DEL_AYUDO_1").val("");
 $("#OBSERVACIONES_1_1").val("");
 $("#FECHA_DE_LLENADO_1").val("");
 $("#ID_RELACIONADO").val("");
 $("#IVA").val("");
 $("#TImpuestosRetenidos").val("");

 $("#UUID").val("");
 $("#metodoDePago").val("");
 $("#totalf").val("");
 $("#serie").val("");
 $("#folio").val("");
 $("#regimenE").val("");
 $("#UsoCFDI").val("");
 $("#TImpuestosTrasladados").val("");
 $("#TImpuestosRetenidos").val("");
 $("#Version").val("");
 $("#tipoDeComprobante").val("");
 $("#condicionesDePago").val("");
 $("#fechaTimbrado").val("");
 $("#nombreR").val("");
 $("#rfcR").val("");
 $("#Moneda").val("");
 $("#TipoCambio").val("");
 $("#ValorUnitarioConcepto").val("");
 $("#DescripcionConcepto").val("");
 $("#ClaveUnidadConcepto").val("");
 $("#ClaveProdServConcepto").val("");
 $("#CantidadConcepto").val("");
 $("#ImporteConcepto").val("");
 $("#UnidadConcepto").val("");
 $("#TUA").val("");
 $("#TuaTotalCargos").val("");
 $("#Descuento").val("");
 $("#subTotal").val("");
 $("#TIPO_CAMBIOP").val("");
 $("#TOTAL_ENPESOS").val("");
 $("#IMPUESTO_HOSPEDAJE").val("");
 $("#NOMBRE_COMERCIALCC").val("");
 $("#propina").val("");
		$(function() {
			load(1);
		});
}

		$(function() {
			load(1);
		});
		function load(page){
			var query=$("#NOMBRE_EVENTO").val();
			var DEPARTAMENTO2=$("#DEPARTAMENTO2WE").val();var NUMERO_CONSECUTIVO_PROVEE=$("#NUMERO_CONSECUTIVO_PROVEE_1").val();
var NOMBRE_COMERCIAL=$("#NOMBRE_COMERCIAL_1").val();
var RAZON_SOCIAL=$("#RAZON_SOCIAL_1").val();
var VIATICOSOPRO=$("#VIATICOSOPRO_1").val();
var RFC_PROVEEDOR=$("#RFC_PROVEEDOR_1").val();
var NUMERO_EVENTO=$("#NUMERO_EVENTO_1").val();
var NOMBRE_EVENTO=$("#NOMBRE_EVENTO_1").val();
var MOTIVO_GASTO=$("#MOTIVO_GASTO_1").val();
var CONCEPTO_PROVEE=$("#CONCEPTO_PROVEE_1").val();
var MONTO_TOTAL_COTIZACION_ADEUDO=$("#MONTO_TOTAL_COTIZACION_ADEUDO_1").val();
var MONTO_FACTURA=$("#MONTO_FACTURA_1").val();
var MONTO_PROPINA=$("#MONTO_PROPINA_1").val();
var MONTO_DEPOSITAR=$("#MONTO_DEPOSITAR_1").val();
var TIPO_DE_MONEDA=$("#TIPO_DE_MONEDA_1").val();
var PFORMADE_PAGO=$("#PFORMADE_PAGO_1").val();

var FECHA_DE_PAGO=$("#FECHA_DE_PAGO").val();
var FECHA_DE_PAGO2a=$("#FECHA_DE_PAGO2a").val();


var FECHA_A_DEPOSITAR=$("#FECHA_A_DEPOSITAR_1").val();
var STATUS_DE_PAGO=$("#STATUS_DE_PAGO_1").val();
var ACTIVO_FIJO=$("#ACTIVO_FIJO_1").val();
var GASTO_FIJO=$("#GASTO_FIJO_1").val();
var PAGAR_CADA=$("#PAGAR_CADA_1").val();
var FECHA_PPAGO=$("#FECHA_PPAGO_1").val();
var FECHA_TPROGRAPAGO=$("#FECHA_TPROGRAPAGO_1").val();
var NUMERO_EVENTOFIJO=$("#NUMERO_EVENTOFIJO_1").val();
var CLASI_GENERAL=$("#CLASI_GENERAL_1").val();
var SUB_GENERAL=$("#SUB_GENERAL_1").val();
var MONTO_DEPOSITADO=$("#MONTO_DEPOSITADO_1").val();
var NUMERO_EVENTO1=$("#NUMERO_EVENTO1_1").val();
var CLASIFICACION_GENERAL=$("#CLASIFICACION_GENERAL_1").val();
var CLASIFICACION_ESPECIFICA=$("#CLASIFICACION_ESPECIFICA_1").val();
var PLACAS_VEHICULO=$("#PLACAS_VEHICULO_1").val();
var MONTO_DE_COMISION=$("#MONTO_DE_COMISION_1").val();
var POLIZA_NUMERO=$("#POLIZA_NUMERO_1").val();
var NOMBRE_DEL_EJECUTIVO=$("#NOMBRE_DEL_EJECUTIVO_1").val();
var NOMBRE_DEL_AYUDO=$("#NOMBRE_DEL_AYUDO_1").val();
var OBSERVACIONES_1=$("#OBSERVACIONES_1_1").val();
var FECHA_DE_LLENADO=$("#FECHA_DE_LLENADO_1").val();
var hiddenpagoproveedores=$("#hiddenpagoproveedores_1").val();
var TIPO_CAMBIOP=$("#TIPO_CAMBIOP").val();
var TOTAL_ENPESOS=$("#TOTAL_ENPESOS").val();
var IMPUESTO_HOSPEDAJE=$("#IMPUESTO_HOSPEDAJE_1").val();
var NOMBRE_COMERCIALCC=$("#NOMBRE_COMERCIALCC_1").val();
var ID_RELACIONADO=$("#ID_RELACIONADO_1").val();
var IVA=$("#IVA_1").val();
var TImpuestosRetenidosIVA=$("#TImpuestosRetenidosIVA_4").val();
var TImpuestosRetenidosISR=$("#TImpuestosRetenidosISR_4").val();
var descuentos=$("#descuentos_4").val();

var UUID=$("#UUID").val();
var metodoDePago=$("#metodoDePago").val();
var totalf=$("#totalf").val();
var serie=$("#serie").val();
var folio=$("#folio").val();
var regimenE=$("#regimenE").val();
var UsoCFDI=$("#UsoCFDI").val();
var TImpuestosTrasladados=$("#TImpuestosTrasladados").val();
var TImpuestosRetenidos=$("#TImpuestosRetenidos_1").val();
var Version=$("#Version").val();
var tipoDeComprobante=$("#tipoDeComprobante").val();
var condicionesDePago=$("#condicionesDePago").val();
var fechaTimbrado=$("#fechaTimbrado").val();
var nombreR=$("#nombreR").val();
var rfcR=$("#rfcR").val();
var Moneda=$("#Moneda").val();
var TipoCambio=$("#TipoCambio").val();
var ValorUnitarioConcepto=$("#ValorUnitarioConcepto").val();
var DescripcionConcepto=$("#DescripcionConcepto").val();
var ClaveUnidadConcepto=$("#ClaveUnidadConcepto").val();
var ClaveProdServConcepto=$("#ClaveProdServConcepto").val();
var CantidadConcepto=$("#CantidadConcepto").val();
var ImporteConcepto=$("#ImporteConcepto").val();
var UnidadConcepto=$("#UnidadConcepto").val();
var TUA=$("#TUA").val();
var TuaTotalCargos=$("#TuaTotalCargos").val();
var Descuento=$("#Descuento").val();
var subTotal=$("#subTotal").val();
var propina=$("#propina").val();
/*termina copiar y pegar*/
			
			var per_page=$("#per_page").val();
			var parametros = {
			"action":"ajax",
			"page":page,
			'query':query,
			'per_page':per_page,

/*inicia copiar y pegar*/'NUMERO_CONSECUTIVO_PROVEE':NUMERO_CONSECUTIVO_PROVEE,
'NOMBRE_COMERCIAL':NOMBRE_COMERCIAL,
'RAZON_SOCIAL':RAZON_SOCIAL,
'RFC_PROVEEDOR':RFC_PROVEEDOR,
'VIATICOSOPRO':VIATICOSOPRO,
'NUMERO_EVENTO':NUMERO_EVENTO,
'NOMBRE_EVENTO':NOMBRE_EVENTO,
'MOTIVO_GASTO':MOTIVO_GASTO,
'CONCEPTO_PROVEE':CONCEPTO_PROVEE,
'MONTO_TOTAL_COTIZACION_ADEUDO':MONTO_TOTAL_COTIZACION_ADEUDO,
'MONTO_FACTURA':MONTO_FACTURA,
'MONTO_PROPINA':MONTO_PROPINA,
'MONTO_DEPOSITAR':MONTO_DEPOSITAR,
'TIPO_DE_MONEDA':TIPO_DE_MONEDA,
'PFORMADE_PAGO':PFORMADE_PAGO,

'FECHA_DE_PAGO':FECHA_DE_PAGO,
'FECHA_DE_PAGO2a':FECHA_DE_PAGO2a,

'FECHA_A_DEPOSITAR':FECHA_A_DEPOSITAR,
'STATUS_DE_PAGO':STATUS_DE_PAGO,
'ACTIVO_FIJO':ACTIVO_FIJO,
'GASTO_FIJO':GASTO_FIJO,
'PAGAR_CADA':PAGAR_CADA,
'FECHA_PPAGO':FECHA_PPAGO,
'FECHA_TPROGRAPAGO':FECHA_TPROGRAPAGO,
'NUMERO_EVENTOFIJO':NUMERO_EVENTOFIJO,
'CLASI_GENERAL':CLASI_GENERAL,
'SUB_GENERAL':SUB_GENERAL,
'MONTO_DEPOSITADO':MONTO_DEPOSITADO,
'NUMERO_EVENTO1':NUMERO_EVENTO1,
'CLASIFICACION_GENERAL':CLASIFICACION_GENERAL,
'CLASIFICACION_ESPECIFICA':CLASIFICACION_ESPECIFICA,
'PLACAS_VEHICULO':PLACAS_VEHICULO,
'MONTO_DE_COMISION':MONTO_DE_COMISION,
'POLIZA_NUMERO':POLIZA_NUMERO,
'NOMBRE_DEL_AYUDO':NOMBRE_DEL_AYUDO,
'NOMBRE_DEL_EJECUTIVO':NOMBRE_DEL_EJECUTIVO,
'OBSERVACIONES_1':OBSERVACIONES_1,
'FECHA_DE_LLENADO':FECHA_DE_LLENADO,
'hiddenpagoproveedores':hiddenpagoproveedores,
'TIPO_CAMBIOP':TIPO_CAMBIOP,
'TOTAL_ENPESOS':TOTAL_ENPESOS,
'IMPUESTO_HOSPEDAJE_1':IMPUESTO_HOSPEDAJE,
'NOMBRE_COMERCIALCC':NOMBRE_COMERCIALCC,
'ID_RELACIONADO':ID_RELACIONADO,
'TImpuestosRetenidosIVA_4':TImpuestosRetenidosIVA,
'TImpuestosRetenidosISR_4':TImpuestosRetenidosISR,
'descuentos_4':descuentos,
'IVA':IVA,

'UUID':UUID,
'metodoDePago':metodoDePago,
'totalf':totalf,
'serie':serie,
'folio':folio,
'regimenE':regimenE,
'UsoCFDI':UsoCFDI,
'TImpuestosTrasladados':TImpuestosTrasladados,
'TImpuestosRetenidos_1':TImpuestosRetenidos,
'Version':Version,
'tipoDeComprobante':tipoDeComprobante,
'condicionesDePago':condicionesDePago,
'fechaTimbrado':fechaTimbrado,
'nombreR':nombreR,
'rfcR':rfcR,
'Moneda':Moneda,
'TipoCambio':TipoCambio,
'ValorUnitarioConcepto':ValorUnitarioConcepto,
'DescripcionConcepto':DescripcionConcepto,
'ClaveUnidadConcepto':ClaveUnidadConcepto,
'ClaveProdServConcepto':ClaveProdServConcepto,
'CantidadConcepto':CantidadConcepto,
'ImporteConcepto':ImporteConcepto,
'UnidadConcepto':UnidadConcepto,
'TUA':TUA,
'TuaTotalCargos':TuaTotalCargos,
'Descuento':Descuento,
'subTotal':subTotal,
'propina':propina,

/*termina copiar y pegar*/

			'DEPARTAMENTO2':DEPARTAMENTO2
			};
			$("#loader").fadeIn('slow');
			$.ajax({
				url:'subirfactura/clases/controlador_filtro.php',
				type: 'POST',				
				data: parametros,
				 beforeSend: function(objeto){
				$("#loader").html("Cargando...");
			  },
				success:function(data){
					$(".datos_ajax").html(data).fadeIn('slow');
					$("#loader").html("");
				}
			})
		}
/* terminaB1*/		
		

	
/* Modales AJAX para documentos de pago; los eventos delegados sobreviven a la paginación del listado. */
(function ($) {
    var endpointDocumentosPago = 'subirfactura/controladorSB.php';
    var camposPorModal = {
        acuse_cancelacion: ['ACUSE_CANCELACION'],
        complemento_pago: ['COMPLEMENTOS_PAGO_XML', 'COMPLEMENTOS_PAGO_PDF']
    };
    function escapar(valor) { return $('<div>').text(valor || '').html(); }
    function modalId(tipo) { return tipo === 'acuse_cancelacion' ? '#modalAcuseCancelacion' : '#modalComplementoPago'; }
    function mostrarModal(tipo) {
        var el = document.querySelector(modalId(tipo));
        if (window.bootstrap && window.bootstrap.Modal) { window.bootstrap.Modal.getOrCreateInstance(el).show(); }
        else { $(el).modal('show'); }
    }
    function cerrarModal(tipo) {
        var el = document.querySelector(modalId(tipo));
        if (window.bootstrap && window.bootstrap.Modal) { window.bootstrap.Modal.getOrCreateInstance(el).hide(); }
        else { $(el).modal('hide'); }
    }
    function renderDocumentos(tipo, documentos) {
        var modal = $(modalId(tipo));
        camposPorModal[tipo].forEach(function (campo) {
            var archivo = documentos[campo] || '';
            var contenedor = modal.find('[data-documento-actual="' + campo + '"]');
            if (!archivo) { contenedor.html('<span class="text-muted">Sin archivo cargado.</span>'); return; }
            var enlace = 'includes/archivos/' + encodeURIComponent(archivo);
            contenedor.html('<a target="_blank" rel="noopener" href="' + enlace + '">Visualizar ' + escapar(archivo) + '</a> <button type="button" class="btn btn-link btn-sm p-0 eliminar_documento_pago" data-campo="' + campo + '">Eliminar</button>');
        });
    }
    $(document).on('click', '.view_documento_pago', function () {
        var tipo = $(this).data('documento-tipo'), id = $(this).data('id');
        var modal = $(modalId(tipo));
        modal.data('registro-id', id).find('input[type=file]').val('');
        modal.find('.nombre-archivo').text('Ningún archivo seleccionado.');
        $.post(endpointDocumentosPago, {action: 'documentos_pago_info', id: id}, function (respuesta) {
            if (!respuesta.ok) { alert(respuesta.mensaje); return; }
            renderDocumentos(tipo, respuesta.documentos); mostrarModal(tipo);
        }, 'json').fail(function () { alert('No fue posible consultar los documentos.'); });
    });
    $(document).on('change', '.modal-documento-pago input[type=file]', function () {
        $(this).closest('.form-group').find('.nombre-archivo').text(this.files.length ? this.files[0].name : 'Ningún archivo seleccionado.');
    });
    $(document).on('click', '.guardar_documento_pago', function () {
        var modal = $(this).closest('.modal-documento-pago'), tipo = modal.data('tipo'), id = modal.data('registro-id');
        var archivos = modal.find('input[type=file]'), pendientes = 0, error = false;
        archivos.each(function () { if (this.files.length) { pendientes++; } });
        if (!pendientes) { alert('Seleccione al menos un archivo.'); return; }
        $(this).prop('disabled', true);
        archivos.each(function () {
            if (!this.files.length) { return; }
            var fd = new FormData(); fd.append('action', 'documentos_pago_guardar'); fd.append('id', id); fd.append('campo', $(this).data('campo')); fd.append('archivo', this.files[0]);
            $.ajax({url: endpointDocumentosPago, type: 'POST', data: fd, processData: false, contentType: false, dataType: 'json'}).done(function (respuesta) {
                if (!respuesta.ok) { error = true; alert(respuesta.mensaje); } else { renderDocumentos(tipo, respuesta.documentos); }
            }).fail(function () { error = true; alert('No fue posible guardar el archivo.'); }).always(function () {
                pendientes--; if (!pendientes) { modal.find('.guardar_documento_pago').prop('disabled', false); if (!error) { modal.find('input[type=file]').val(''); modal.find('.nombre-archivo').text('Ningún archivo seleccionado.'); cerrarModal(tipo); load(1); } }
            });
        });
    });
    $(document).on('click', '.eliminar_documento_pago', function () {
        var modal = $(this).closest('.modal-documento-pago'), tipo = modal.data('tipo');
        if (!confirm('¿Desea eliminar este documento?')) { return; }
        $.post(endpointDocumentosPago, {action: 'documentos_pago_eliminar', id: modal.data('registro-id'), campo: $(this).data('campo')}, function (respuesta) {
            if (!respuesta.ok) { alert(respuesta.mensaje); return; } renderDocumentos(tipo, respuesta.documentos);
        }, 'json');
    });
    $(document).on('hidden.bs.modal', '.modal-documento-pago', function () {
        load(1);
    });
	
})(jQuery);
		</script>

<div class="modal fade modal-documento-pago" id="modalAcuseCancelacion" data-tipo="acuse_cancelacion" tabindex="-1" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Acuse de cancelación</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div><div class="modal-body"><div class="form-group mb-3"><label class="text-uppercase fw-bold">Archivo PDF</label><input type="file" class="form-control" data-campo="ACUSE_CANCELACION" accept="application/pdf,.pdf"><small class="nombre-archivo text-muted">Ningún archivo seleccionado.</small><div class="mt-2" data-documento-actual="ACUSE_CANCELACION"></div></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button><button type="button" class="btn btn-danger guardar_documento_pago">Guardar acuse</button></div></div></div></div>
<div class="modal fade modal-documento-pago" id="modalComplementoPago" data-tipo="complemento_pago" tabindex="-1" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h5 class="modal-title">Complemento de pago</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button></div><div class="modal-body"><div class="form-group mb-3"><label class="text-uppercase fw-bold">XML del complemento de pago</label><input type="file" class="form-control" data-campo="COMPLEMENTOS_PAGO_XML" accept="application/xml,text/xml,.xml"><small class="nombre-archivo text-muted">Ningún archivo seleccionado.</small><div class="mt-2" data-documento-actual="COMPLEMENTOS_PAGO_XML"></div></div><div class="form-group mb-3"><label class="text-uppercase fw-bold">PDF del complemento de pago</label><input type="file" class="form-control" data-campo="COMPLEMENTOS_PAGO_PDF" accept="application/pdf,.pdf"><small class="nombre-archivo text-muted">Ningún archivo seleccionado.</small><div class="mt-2" data-documento-actual="COMPLEMENTOS_PAGO_PDF"></div></div></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button><button type="button" class="btn btn-primary guardar_documento_pago">Guardar complemento</button></div></div></div></div>
