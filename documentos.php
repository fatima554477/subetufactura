
<div id="content">     
			<hr/>
	<strong> <P class="mb-0 text-uppercase">
<img src="includes/contraer31.png" id="mostrar5" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar5" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp;DESCARGA LOS DOCUMENTOS FISCALES DE NUESTRO CORPORATIVO</p></strong></div>


<div  id="mensajedocumentosdocu">
<div class="progress" style="width: 25%;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $contactosventasproveedoresporcentaje ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $contactosventasproveedoresporcentaje ; ?>%</div></div></div>


	        <div id="target5" style="display:block;"  class="content2">
        <div class="card">
          <div class="card-body">

<?php
//listado_empresas1a
$querycontras = $SUBEFACTURA->listado_empresas1a();
?>


<?php
while($row = mysqli_fetch_array($querycontras))
{
$doc_situacion = $SUBEFACTURA->descargar_documentos($row["id"], 'COSNTACIA DE SITUACIÓN FISCAL');
$doc_opinion   = $SUBEFACTURA->descargar_documentos($row["id"], 'OPINION DE CUMPLIMIENTO');
$doc_domicilio = $SUBEFACTURA->descargar_documentos($row["id"], 'COMPROBANTE DE DOMICILIO');
?>

 <STRONG>EMPRESA:&nbsp;&nbsp;<?php echo $row["NCE_INFORMACION"]; ?></STRONG><BR/>
 
 
<a href="<?php echo $_SERVER['PHP_SELF'].'?situacionfiscal='.$row["id"]; ?>" class="" target="_blanck">DESCARGAR PDF CONSTANCIA DE SITUACION FISCAL</a>
<?php if($doc_situacion){ echo '<BR/><small>Último: '.$doc_situacion['FECHA_ULTIMA_DOCUMEN'].'</small>'; } ?>
<BR/>
<BR/>
<a href="<?php echo $_SERVER['PHP_SELF'].'?opinion_cumplimiento='.$row["id"]; ?>" class="" target="_blanck">DESCARGAR PDF OPINIÓN DE CUMPLIMIENTO</a>
<?php if($doc_opinion){ echo '<BR/><small>Último: '.$doc_opinion['FECHA_ULTIMA_DOCUMEN'].'</small>'; } ?>
<BR/>
<BR/>
<a href="<?php echo $_SERVER['PHP_SELF'].'?domicilio_empresa='.$row["id"]; ?>" class="" target="_blanck">DESCARGAR PDF COMPROBANTE DE DOMICILIO</a>
<?php if($doc_domicilio){ echo '<BR/><small>Último: '.$doc_domicilio['FECHA_ULTIMA_DOCUMEN'].'</small>'; } ?>



<hr>
<?php
}
?>








		</div>
		</div> 
		</div> 
              