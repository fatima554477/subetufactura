<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" onclick='LIMPIAR();' id="mostrar3" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar3" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp;STATUS DE TUS FACTURAS</p></strong></div>


<div  id="mensajefiltro">
<div class="progress" style="width: 25%;">
<div class="progress-bar" role="progressbar" style="width: <?php echo $Aeventosporcentaje ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $Aeventosporcentaje ; ?>%</div></div>
 </div>
							
	        <div id="target3" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">
      
<!--aqui inicia filtro-->

            <div class="row text-center" id="loader" style="position: absolute;top: 140px;left: 50%"></div>
<table width="100%" border="0">
<tr>
<td width="30%" align="center">
	<span>Mostrar</span>
	<select  class="form-select mb-3" id="per_page" onchange="load(1);">
<option value="10" <?php if($_REQUEST['per_page']=='10'){echo 'selected';} ?>>10</option>
<option value="20" <?php if($_REQUEST['per_page']=='20'){echo 'selected';} ?>>20</option>
		<option value="50" <?php if($_REQUEST['per_page']=='50'){echo 'selected';} ?>>50</option>
		<option value="100" <?php if($_REQUEST['per_page']=='100'){echo 'selected';} ?>>100</option>
		<option value="200" <?php if($_REQUEST['per_page']=='200'){echo 'selected';} ?>>200</option>
		<option value="200000" <?php if($_REQUEST['per_page']=='200000'){echo 'selected';} ?>>TODOS</option>
	</select>
</td>


<td width="30%" align="center">					
	<button  class="btn btn-sm btn-outline-success px-5" type="button" onclick="load(1);" >BUSCAR</button>
</td>



</tr>
</table>
		<div class="datos_ajax">
		</div>
  
<!--aqui termina filtro-->


</div>
</div>
</div>

<?php 
require "clases/script.filtro.php";
?>