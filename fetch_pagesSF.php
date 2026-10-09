<?php
error_reporting(E_ALL); 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	require "controladorSB.php";


$connecDB = $conexion->db();
$item_per_page = 7;
if(isset($_POST["page"])){
	$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
	if(!is_numeric($page_number)){die('Invalid page number!');} //incase of invalid page number
}else{
	$page_number = 1;
}
$position = (($page_number-1) * $item_per_page);
//print_r($_POST);
$SOLICITADO = ISSET($_POST["SOLICITADO"])?$_POST["SOLICITADO"]:'';
$APROBADO = ISSET($_POST["APROBADO"])?$_POST["APROBADO"]:'';
$RECHAZADO = ISSET($_POST["RECHAZADO"])?$_POST["RECHAZADO"]:'';
$BORRAR = ISSET($_POST["BORRAR"])?$_POST["BORRAR"]:'';
$BUSQUEDA = ISSET($_POST["BUSCAR"])?$_POST["BUSCAR"]:'';

if($BUSQUEDA !=''){
	
	$_SESSION['where'] = " WHERE idRelacion = '".$_SESSION['idPROV']."' AND (NOMBRE_COMERCIAL LIKE '%".$BUSQUEDA."%' OR  RAZON_SOCIAL LIKE '%".$BUSQUEDA."%'  OR  RFC_PROVEEDOR LIKE '%".$BUSQUEDA."%' OR  MONTO_DEPOSITAR LIKE '%".$BUSQUEDA."%' OR  STATUS_DE_PAGO LIKE '%".$BUSQUEDA."%' ) ";
	
}elseif($SOLICITADO!=''){
	
	UNSET($_SESSION['where']);
$_SESSION['where'] = " WHERE idRelacion = '".$_SESSION['idPROV']."' ";
if($SOLICITADO!=''){
	$SOLICITADO1 = "  and STATUS_DE_PAGO = '".$SOLICITADO ."' ";
}
	$_SESSION['where'] = $_SESSION['where'].$SOLICITADO1.$_SESSION['where2'];
	
}
elseif($APROBADO!=''){
	
	UNSET($_SESSION['where']);
$_SESSION['where'] = " WHERE idRelacion = '".$_SESSION['idPROV']."' ";
if($APROBADO!=''){
	$APROBADO1 = "  and STATUS_DE_PAGO = '".$APROBADO ."' ";
}
	$_SESSION['where'] = $_SESSION['where'].$APROBADO1.$_SESSION['where2'];
	
}
elseif($RECHAZADO!=''){
	
	UNSET($_SESSION['where']);
$_SESSION['where'] = " WHERE idRelacion = '".$_SESSION['idPROV']."' ";
if($RECHAZADO!=''){
	$RECHAZADO1 = "  and STATUS_DE_PAGO = '".$RECHAZADO ."' ";
}
	$_SESSION['where'] = $_SESSION['where'].$RECHAZADO1.$_SESSION['where2'];
	
}
elseif($BORRAR!=''){
	UNSET($_SESSION['where2']);
UNSET($_SESSION['where']);
$_SESSION['where'] = " WHERE idRelacion = '".$_SESSION['idPROV']."' ";

}
//ECHO $_SESSION['where'];  idRelacion 

/*SELECT * FROM 02SUBETUFACTURA WHERE idRelacion = '35' and STATUS_DE_PAGO = 'APROBADO' idRelacion = '35' AND (NOMBRE_COMERCIAL LIKE '%FATIMA%' OR RAZON_SOCIAL LIKE '%FATIMA%' OR RFC_PROVEEDOR LIKE '%FATIMA%' OR MONTO_DEPOSITAR LIKE '%FATIMA%' OR STATUS_DE_PAGO LIKE '%FATIMA%' ) order by id desc LIMIT 0, 7You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'idRelacion = '35' AND (NOMBRE_COMERCIAL LIKE '%FATIMA%' OR RAZON_SOCIAL LIKE...' at line 1*/


/*$_SESSION['where'] = isset($_SESSION['where'])?$_SESSION['where']: 

if($BUSQUEDA!=''){
$_SESSION['where'] = " WHERE idRelacion = '".$_SESSION['idPROV']."' AND (NOMBRE_COMERCIAL LIKE '%".$BUSQUEDA."%' OR  RAZON_SOCIAL LIKE '%".$BUSQUEDA."%'  OR  RFC_PROVEEDOR LIKE '%".$BUSQUEDA."%' OR  MONTO_DEPOSITAR LIKE '%".$BUSQUEDA."%' OR  STATUS_DE_PAGO LIKE '%".$BUSQUEDA."%' ) ";
}elseif($SOLICITADO!=''){
$_SESSION['where'] = " WHERE STATUS_DE_PAGO = '".$SOLICITADO."'";	
}else{
	
}
*/


$VARSQL = "SELECT * FROM 02SUBETUFACTURA ".$_SESSION['where']." order by id desc LIMIT $position, $item_per_page";
$results = mysqli_query($connecDB,$VARSQL)or die(mysqli_error($connecDB));




  $VARSQL1 = "SELECT  COUNT(*) as total FROM 02SUBETUFACTURA ".$_SESSION['where']." ";

  $VARSQL2 = "SELECT  SUM(MONTO_DEPOSITAR) as Gtotal FROM 02SUBETUFACTURA ".$_SESSION['where']." ";
  
  $results2 = mysqli_query($connecDB,$VARSQL2)or die(mysqli_error($connecDB));
$Gtotal = mysqli_fetch_array($results2);
  
  $results1 = mysqli_query($connecDB,$VARSQL1)or die(mysqli_error($connecDB));
$grantotal = mysqli_fetch_array($results1);

echo 'TOTAL DE REGISTROS: '.$grantotal['total'];
//output results from database
?>
     <table class="table table-striped table-bordered" style="width:100%"  id="reseteateINVENTARIO" name="reseteateINVENTARIO">

	  
<tr style="text-align:center">
<th width="20%"style="background:#c9e8e8">FECHA DE SOLICITUD</th>
<th width="20%"style="background:#c9e8e8">FACTURA XML</th>
<th width="20%"style="background:#c9e8e8">FACTURA PDF</th>
<th width="20%"style="background:#c9e8e8">NÚMERO CONSECUTIVO</th>
<th width="20%"style="background:#c9e8e8">NOMBRE COMERCIAL </th>
<th width="20%"style="background:#c9e8e8">RAZÓN SOCIAL</th>
<th width="20%"style="background:#c9e8e8">RFC</th>
<th width="20%"style="background:#c9e8e8">NÚMERO DE EVENTO</th>
<th width="20%"style="background:#c9e8e8">CONCEPTO</th>
<th width="20%"style="background:#c9e8e8">MONTO TOTAL DE LA COTIZACIÓN O ADEUDO</th>
<th width="20%"style="background:#c9e8e8">COTIZACIÓN O  REPORTE</th>
<th width="20%"style="background:#c9e8e8">SUBTOTAL</th>
<th width="20%"style="background:#c9e8e8">IVA</th>
<th width="20%"style="background:#c9e8e8">IMPUESTOS RETENIDOS</th>
<th width="20%"style="background:#c9e8e8">MONTO DE PROPINA</th>
<th width="20%"style="background:#c9e8e8">IMPUESTO HOSPEDAJE O SANEAMIENTO</th>
<th width="20%"style="background:#c9e8e8">TOTAL</th>
<th width="20%"style="background:#c9e8e8">MONTO DEPOSITADO</th>
<!-- <th width="20%"style="background:#c9e8e8">PENDIENTE DE PAGO</th> -->
<th width="20%"style="background:#c9e8e8">TIPO DE MONEDA</th>
<th width="20%"style="background:#c9e8e8">METODO DE PAGO</th>
<th width="20%"style="background:#c9e8e8">FECHA DE PROGRAMACIÓN DEL PAGO</th>
<th width="20%"style="background:#c9e8e8">STATUS DE PAGO</th>
<th width="20%"style="background:#c9e8e8">CONPROBANTE DE TRANSFERENCIA</th>
<th width="20%"style="background:#c9e8e8">NOMBRE DEL EJECUTIVO</th>
<th width="20%"style="background:#c9e8e8">OBSERVACIONES</th>
<th width="20%"style="background:#c9e8e8">ADJUNTAR ARCHIVO RELACIONADO<br> CON ESTA FACTURA</th>
</tr>
		
		
		<?php

while($row = mysqli_fetch_array($results))
{	 
	$ADJUNTAR_FACTURA_PDF = '';$ADJUNTAR_FACTURA_XML='';$ADJUNTAR_COTIZACION='';$CONPROBANTE_TRANSFERENCIA='';$ADJUNTAR_ARCHIVO_1='';
	$querycontrasDOCTOS = $SUBEFACTURA->Listado_subefacturaDOCTOS($row['id']);
	while($rowDOCTOS = mysqli_fetch_array($querycontrasDOCTOS))
	{
			//$ADJUNTAR_FACTURA_PDF = '';				
		if($rowDOCTOS["ADJUNTAR_FACTURA_PDF"]!=''){
			$ADJUNTAR_FACTURA_PDF .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_FACTURA_PDF"].'" target ="_blank">Ver!</a><br/>';
		}
		
		if($rowDOCTOS["ADJUNTAR_FACTURA_XML"]!=''){
			$ADJUNTAR_FACTURA_XML .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_FACTURA_XML"].'" target ="_blank">Ver!</a><br/>';
		}
		
		if($rowDOCTOS["ADJUNTAR_COTIZACION"]!=''){
			$ADJUNTAR_COTIZACION .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_COTIZACION"].'" target ="_blank">Ver!</a><br/>';
		}
		if($rowDOCTOS["CONPROBANTE_TRANSFERENCIA"]!=''){
			$CONPROBANTE_TRANSFERENCIA .= '<a href="includes/archivos/'.$rowDOCTOS["CONPROBANTE_TRANSFERENCIA"].'" target ="_blank">Ver!</a><br/>';
		}
		if($rowDOCTOS["ADJUNTAR_ARCHIVO_1"]!=''){
			$ADJUNTAR_ARCHIVO_1 .= '<a href="includes/archivos/'.$rowDOCTOS["ADJUNTAR_ARCHIVO_1"].'" target ="_blank">Ver!</a><br/>';
		}

	}
	
	?>

<tr style='background:#f5f9fc;text-align:center'>
<td ><?php echo $row["FECHA_DE_LLENADO"];?></td>
<td ><?php echo $ADJUNTAR_FACTURA_XML; ?></td>
<td ><?php echo $ADJUNTAR_FACTURA_PDF; ?></td>
<td ><?php echo $row["NUMERO_CONSECUTIVO_PROVEE"]; ?></td>
<td ><?php echo $row["NOMBRE_COMERCIAL"]; ?></td>
<td ><?php echo $row["RAZON_SOCIAL"]; ?></td>
<td ><?php echo $row["RFC_PROVEEDOR"]; ?></td>
<td ><?php echo $row["NUMERO_EVENTO"]; ?></td>
<td ><?php echo $row["CONCEPTO_PROVEE"]; ?></td>
<td ><?php echo $row["MONTO_TOTAL_COTIZACION_ADEUDO"]; ?></td>
<td ><?php echo $ADJUNTAR_COTIZACION; ?></td>
<td ><?php echo $row["MONTO_FACTURA"]; ?></td>
<td ><?php echo $row["IVA"]; ?></td>
<td ><?php echo $row["TImpuestosRetenidos"]; ?></td>
<td ><?php echo $row["MONTO_PROPINA"]; ?></td>
<td ><?php echo $row["IMPUESTO_HOSPEDAJE"]; ?></td>
<td ><?php echo $row["MONTO_DEPOSITAR"]; ?></td>
<td ><?php echo $row["MONTO_DEPOSITADO"]; ?></td>
<!-- <td ><?php //echo $row["PENDIENTE_PAGO"]; ?></td> -->
<td ><?php echo $row["TIPO_DE_MONEDA"]; ?></td>
<td ><?php echo $row["PFORMADE_PAGO"]; ?></td>
<td ><?php echo $row["FECHA_DE_PAGO"]; ?></td>
<td ><?php echo $row["STATUS_DE_PAGO"]; ?></td>
<td ><?php echo $CONPROBANTE_TRANSFERENCIA; ?></td>
<td ><?php echo $row["NOMBRE_DEL_EJECUTIVO"]; ?></td>
<td ><?php echo $row["OBSERVACIONES_1"]; ?></td>
<td ><?php echo $ADJUNTAR_ARCHIVO_1; ?></td>



<td><?php if($conexion->variablespermisos('',' 	SUBIR_FACTURA','borrar')=='si'){ ?>

<input type="button" name="view2" value="BORRAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_dataSBborrar" />
<?php } ?></td>
</tr>
      <?php
      }
      ?>
	  
	  
<tr style='background:#f5f9fc;text-align:center'>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td >SUMA TOTAL:</td>
<td style="border-top:solid;" ><?php echo '$ '. number_format( $Gtotal['Gtotal'],2,'.',',') ; ?></td>


<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td ></td>
<td></td>
<td></td>
</tr>	  


	  
	  
	  
     </table>



