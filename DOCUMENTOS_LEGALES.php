<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" id="mostrar100" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar100" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp; ACTUALIZAR DOCUMENTOS FISCALES DEL PROVEEDOR&nbsp; <a style="color:red;font:12px">    (ES OBLIGATORIO SUBIR TUS DOCUMENTOS DEL MES EN CURSO ANTES DE SUBIR TU FACTURA)  </a></p></strong>

<div  id="mensajeDOCUFISCAL2">
<div class="progress" style="width: 25%;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $datosFISCALDOCU; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $datosFISCALDOCU ; ?>%</div></div>
									</div>
							
	        <div id="target100" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">
          <?php if($conexion->variablespermisos('','DOCUMENTOS_LEGALES_SP','guardar')=='si'){ ?>
                      <form class="row g-3 needs-validation was-validated" id="DOCUFISCALform"  novalidate="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 

                        <div class="col-md-4"style="background:#fef5e7">
 
                    
<strong><label for="validationCustom02" class="form-label">DOCUMENTO FISCAL DEL PROVEEDOR:</label></strong>
   
   <span id="documentoslegales1a12">
   <?php
   /*linea para multiples colores*/
   $fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
   $num = 0;
   /*linea para multiples colores*/
   
   $queryper = $SUBEFACTURA->variable_nuevodocumentotodos();
   $encabezado = '<select class="form-select mb-3" aria-label="Default select example" id="DOCUMENTO_LEGAL" required="" name="DOCUMENTO_LEGAL">
   <option value="">SELECCIONA UNA OPCIÓN</option>';	
while($row1 = mysqli_fetch_array($queryper))
{ 
    $doc = trim($row1['nuevo_documento']);

    // SOLO permitir 2 opciones
    if($doc !== 'CONSTANCIA DE SITUACIÓN FISCAL' 
    && $doc !== 'OPINIÓN DE CUMPLIMIENTO'){
        continue; // saltar todo lo demás
    }

    $select = ($DOCUMENTO_LEGAL==$doc) ? "selected" : "";

    if($num==8){$num=0;}else{$num++;}

    $option3 .= '<option style="background: #'.$fondos[$num].'" '.$select.' value="'.$doc.'">'.$doc.'</option>';
}
   echo $encabezado.$option3.'</select>';			
   ?>
   </span>

  <div class="valid-feedback">Bien!</div>
  </div>
						  
						  
                        <div class="col-md-4"style="background:#d4f6c8">

                        <strong>   <label for="validationCustom01" class="form-label">ADJUNTAR DOCUMENTO: (FORMATO PDF, JPG O PNG)</label></strong>
                          <input type="file" class="form-control" id="validationCustom01" value="<?php echo $ADJUNTAR_DOCUMENTO_LEGAL; ?>" required="" name="ADJUNTAR_DOCUMENTO_LEGAL">
                          <div class="valid-feedback">Bien!</div>
                        </div>
                        <div class="col-md-4"style="background:#fbeee6">

                        <strong>   <label for="validationCustom01" class="form-label">OBSERVACIONES:</label></strong>
                          <input type="text" class="form-control" id="validationCustom01" value="<?php echo $ADJUNTAR_DOCUMENTO_OBSERVACIONES; ?>" required="" name="ADJUNTAR_DOCUMENTO_OBSERVACIONES">
                          <div class="valid-feedback">Bien!</div>
                        
                        </div>


                      
                        <td style="text-align:center;background:#faebee;" scope="col">FECHA DE ÚLTIMA CARGA 
                         
     
           <strong>
           <?php echo date('Y-m-d'); ?>
           </strong>
           <input type="hidden" style="width:200px;"  class="form-control" id="validationCustom03"   value="<?php echo date('Y-m-d'); ?>" name="FECHA_ULTIMA_DOCUMEN">
    
</td><table><tr>
    <td  style="width: 200px;"> 


<button class="btn btn-sm btn-outline-success px-5"   type="button" id="enviarDOCUMENTOSFISCALES">GUARDAR</button><div style="

    text-shadow: 1px 1px 1px #919191,
        1px 2px 1px #919191,
        1px 3px 1px #919191,
        1px 4px 1px #919191,
        1px 5px 1px #919191,
        1px 6px 1px #919191,
        1px 7px 1px #919191,
        1px 8px 1px #919191,
        1px 9px 1px #919191,
        1px 10px 1px #919191,
    1px 18px 6px rgba(16,16,16,0.4),
    1px 22px 10px rgba(16,16,16,0.2),
    1px 25px 35px rgba(16,16,16,0.2),
    1px 30px 60px rgba(16,16,16,0.4);"


id="mensajeDOCUFISCAL"/></td></tr></table><?php } ?>
            
                        

 
                       
                    <input type="hidden" value="validaDOCUMENTOSFISCAL" name="validaDOCUMENTOSFISCAL"/>     
                   
                      
                   
  
            
        </form>
       
      <?php if($conexion->variablespermisos('','DOCUMENTOS_LEGALES_SP','email')=='si'){ ?>
        <form name="form_emai_docuFISCAL" id="form_emai_docuFISCAL">
                <table><tr>         
         <td style="width:500px;" ><textarea  style="float:right" placeholder="ESCRIBE AQUÍ TUS CORREOS SEPARADOS POR PUNTO Y COMA EJEMPLO: NOMBRE@CORREO.ES;NOMBRE@CORREO.ES"  name="ENVIAR_EMAIL_DOCUFISCAL" id="ENVIAR_EMAIL_DOCUFISCAL" class="form-control" aria-label="With textarea"><?php echo $ENVIAR_EMAIL_DOCUFISCAL; ?></textarea></td>
           <td> <button class="btn btn-sm btn-outline-success px-5"  type="button" id="enviar_email_DOCUFISCAL">ENVIAR POR EMAIL</button></th>   
          </tr></table><?php } ?>


           

          <?php
$querycontras = $SUBEFACTURA->listadoDOCUMENTOSFISCALES();
?>

<br />
<div class='table-responsive'>
<div align='right'>
</div>
<br />
<div id='employee_table'>
<tbody= 'font-style:italic;'>
<table class="table table-striped table-bordered" style="width:100%"  id='resetedocufiscal' name='resetedocufiscal'>
<tr style="text-align:center">
<th width="15%"style="background:#c9e8e8">ENVIAR POR EMAIL</th>  
<th width="20%"style="background:#c9e8e8">NOMBRE DEL DOCUMENTO</th>
<th width="20%"style="background:#c9e8e8">DOCUMENTO</th>
<th width="20%"style="background:#c9e8e8">OBSERVACIONES</th>
<th width="20%"style="background:#c9e8e8">FECHA DE ÚLTIMA CARGA</th>
</tr>
<?php
$ADJUNTAR_DOCUMENTO_LEGAL ='';
while($row = mysqli_fetch_array($querycontras))
{	
	$ADJUNTAR_DOCUMENTO_LEGAL = $conexion->descargararchivo($row["ADJUNTAR_DOCUMENTO_LEGAL"]);
?>
<tr style='background:#f5f9fc;text-align:center'>
<td style="text-align:center" >
<input type="checkbox" style="width:17%" class="form-check-input" name="fiscalesdocu[]" id="fiscalesdocu" value="<?php echo $row["id"]; ?>"/> </td>
<td ><?php echo $row["DOCUMENTO_LEGAL"]; ?></td>
<td ><?php echo $ADJUNTAR_DOCUMENTO_LEGAL; ?></td>
<td ><?php echo $row["ADJUNTAR_DOCUMENTO_OBSERVACIONES"]; ?></td>               
<td ><?php echo $row["FECHA_ULTIMA_DOCUMEN"]; ?></td>
<?php if($conexion->variablespermisos('','DOCUMENTOS_LEGALES_SP','modificar')=='si'){ ?>
<td>

<input type="button" name="view" value="MODIFICAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_datadocufiscalmodifica" /></td><?php } ?>

<td><?php if($conexion->variablespermisos('','DOCUMENTOS_LEGALES_SP','borrar')=='si'){ ?><input type="button" name="view2" value="BORRAR" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_datadocufiscalborrar" /><?php } ?></td>
</tr>
<?php
}
?>
</table>
</tbody>
</form>
          </div>
          </div>
         

		 </div>           
           </div>     
       </div>           
    