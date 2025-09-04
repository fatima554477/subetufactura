
<div id="content">     
			<hr/>
	<strong> <P class="mb-0 text-uppercase">
<img src="includes/contraer31.png" id="mostrar5" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar5" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp;DESCARGA LOS DOCUMENTOS FISCALES DE LA EMPRESA</p></strong></div>


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
?>

 <STRONG>EMPRESA:&nbsp;&nbsp;<?php echo $row["NCE_INFORMACION"]; ?></STRONG><BR/>
<a href="<?php echo $_SERVER['PHP_SELF'].'?situacionfiscal='.$row["id"]; ?>" class="" target="_blanck">DESCARGAR PDF CONSTANCIA DE SITUACION FISCAL</a>
<BR/>
<BR/>
<a href="<?php echo $_SERVER['PHP_SELF'].'?opinion_cumplimiento='.$row["id"]; ?>" class="" target="_blanck">DESCARGAR PDF OPINIÓN DE CUMPLIMIENTO</a>
<BR/>
<BR/>
<a href="<?php echo $_SERVER['PHP_SELF'].'?domicilio_empresa='.$row["id"]; ?>" class="" target="_blanck">DESCARGAR PDF COMPROBANTE DE DOMICILIO</a>



<hr>
<?php
}
?>



	<!--<form class="row g-3 needs-validation was-validated" novalidate="" id="empresadocu" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
	
	
                  <table  style="border-collapse: collapse;" border="1" class="table mb-0 table-striped">


         <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">DESCARGAR CONTRATO PARA LLENADO DE PROVEEDORES:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""   value="<?php echo $empresa_documento; ?>"   name="empresa_documento"></td>
         </tr>



		 
         <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">DESCARGAR CONTRATO PARA LLENADO DE PROVEEDORES:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""   value="<?php echo $contrato_documento; ?>"   name="contrato_documento"></td>
         </tr>		 
         <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">DESCARGAR CONSTANCIA DE SITUACIÓN FISCAL:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""   value="<?php echo $constancia_documento; ?>"   name="constancia_documento"></td>
         </tr>
    <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">DESCARGAR OPINIÓN DE CUMPLIMIENTO:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""   value="<?php echo $opinion_documento; ?>"   name="opinion_documento"></td>
         </tr>
    <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">DESCARGAR RÉGIMEN FISCAL:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""   value="<?php echo $regimen_documento; ?>"   name="regimen_documento"></td>
         </tr>    <tr style="background:#ebf8fa"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">DESCARGAR ACTA CONSTITUTIVA ( PERSONA MORAL): </label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""   value="<?php echo $acta_documento; ?>"   name="acta_documento"></td>
         </tr>
		 <tr>
		 <td>


     <input type="hidden" name="hiddendocupro" value="hiddendocupro">

<button class="btn btn-primary" type="button" id="enviarDOCUproveedor">ENVIAR</button></td></tr>   
	</div>
    

	

			</table>
		</form>-->
		</div>
		</div> 
		</div> 
              