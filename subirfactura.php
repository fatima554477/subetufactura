<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
	
isset($_SESSION["logeado"])?'':header("location: index.php?salir=1");
require "includes/error_reporting.php";

$idget = isset($_GET['id'])?$_GET['id']:'no';
if($idget!='no'){
$_SESSION['id'] = $idget;
}ELSE{
$_SESSION['id'] = $_SESSION['idem'];
}


	require "subirfactura/controladorSB.php";
	require "subirfactura/variablesSB.php";
	
$situacionfiscal = isset($_GET['situacionfiscal'])?$_GET['situacionfiscal']:'';
if($situacionfiscal!=''){
	//ADJUNTAR_CONSFISCAL_INFORMACION
$row = $SUBEFACTURA->descargar_documentos($situacionfiscal);
$ADJUNTAR_CONSFISCAL_INFORMACION = $row['ADJUNTAR_CONSFISCAL_INFORMACION'];
header("Content-disposition: attachment; filename=".$ADJUNTAR_CONSFISCAL_INFORMACION."");
header("Content-type: MIME");
readfile('includes/archivos/'.$ADJUNTAR_CONSFISCAL_INFORMACION);
exit;
}

$opinion_cumplimiento = isset($_GET['opinion_cumplimiento'])?$_GET['opinion_cumplimiento']:'';
if($opinion_cumplimiento!=''){
$row = $SUBEFACTURA->descargar_documentos($opinion_cumplimiento);
$ADJUNTAR_OPINION_INFORMACION = $row['ADJUNTAR_OPINION_INFORMACION'];
header("Content-disposition: attachment; filename=".$ADJUNTAR_OPINION_INFORMACION."");
header("Content-type: MIME");
readfile('includes/archivos/'.$ADJUNTAR_OPINION_INFORMACION);
exit;
}

$domicilio_empresa = isset($_GET['domicilio_empresa'])?$_GET['domicilio_empresa']:'';
if($domicilio_empresa!=''){
$row = $SUBEFACTURA->descargar_documentos($domicilio_empresa);
$ADJUNTAR_CDOMICI_INFORMACION = $row['ADJUNTAR_CDOMICI_INFORMACION'];
header("Content-disposition: attachment; filename=".$ADJUNTAR_CDOMICI_INFORMACION."");
header("Content-type: MIME");
readfile('includes/archivos/'.$ADJUNTAR_CDOMICI_INFORMACION);
exit;
}

	
?><!doctype html>
<html lang="en" class="light-theme">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- loader-->
	  <link href="assets/css/pace.min.css" rel="stylesheet" />
	  <script src="assets/js/pace.min.js"></script>

    <!--plugins-->
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />

    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!--Theme Styles-->
    <link href="assets/css/dark-theme.css" rel="stylesheet" />
    <link href="assets/css/semi-dark.css" rel="stylesheet" />
    <link href="assets/css/header-colors.css" rel="stylesheet" />
        <style type="text/css">
            #content {

            }
            #close {

            }
            .content2 {
                margin: 0px auto;
                min-height: 100px;
                box-shadow: 0 2px 5px #666666;
                padding: 10px;
            }
			
	#drop_file_zone {
	    background-color: #EEE;
	    border: #999 1px solid;
	    padding: 8px;
	}			

	#nono {
	  display: none;
	}
	
input[type=text] {
    text-transform: uppercase;
}

#ACTUALIZADO{
color:green;
    text-transform: uppercase;
	font-size:25px;
	font-weight: bold;
}
  #ERROR{
color:red;
    text-transform: uppercase;
	font-size:25px;
	font-weight: bold;
}
		td ,tr, table, textarea {
    text-transform: uppercase;
}
        </style>
		
<style id="jsbin-css">
    @media (min-width: 768px) {
      .modal-xl {
        width: 90%;
       max-width:1200px;
      }
    }

</style>
		
    <title>PAGO A PROVEEDORES</title>
  </head>
  <body>
    

 <!--start wrapper-->
    <div class="wrapper">
       <!--start sidebar -->
	    <aside class="sidebar-wrapper" data-simplebar="true">
      <?php require "includes/menuLateral.php"; /*php menu lateral*/ ?>
		</aside>
     <!--end sidebar -->

        <!--start top header-->
          <header class="top-header">
		  <?php require "subirfactura/notificaciones.php"; /*php notificaciones*/ ?>
          </header>
        <!--end top header-->


        <!-- start page content wrapper-->
        <div class="page-content-wrapper">
          <!-- start page content-->
         <div class="page-content">

          <!--start breadcrumb-->
          <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
		  <?php require "subirfactura/mapeo1.php"; /*php mapa*/ ?>
          </div>
          <!--end breadcrumb-->


          <div class="row">
            <div class="col-xl-12 mx-auto"> 
<?php
   
 require "subirfactura/texto.php";
 
 /*require "subirfactura/expansores.php";*/
 require "subirfactura/documentos.php";
require "subirfactura/NOTAS_IMPORTANTES2.php";


 if($conexion->variablespermisos('','SUBIR_FACTURA','ver')=='si'){
 require "subirfactura/SUBIR_FACTURA.php";
 require "subirfactura/fetch_page_nuevo.php";
}
 //require "subirfactura/documentos.php";
 if($conexion->variablespermisos('','DATOS_BANCARIOS_1SF','ver')=='si'){
 require "subirfactura/DATOS_BANCARIOS_1.php";
 
} ?>
            </div>
          </div>
             

          </div>
          <!-- end page content-->
         </div>
         


         <!--Start Back To Top Button-->
		     <a href="javaScript:;" class="back-to-top"><ion-icon name="arrow-up-outline"></ion-icon></a>
         <!--End Back To Top Button-->
  
         <!--start switcher-->
         <div class="switcher-body">
		 <?php require "includes/coloresEncabezado.php"; ?>
         </div>
         <!--end switcher-->


         <!--start overlay-->
          <div class="overlay"></div>
         <!--end overlay-->

     </div>
  <!--end wrapper-->

    <!-- JS Files-->
				<?php require "includes/convertirma.php"; ?>
    <script src="assets/js/jquery.min.js"></script>
		<script type="text/javascript" src="inventario/js/jquery.bootpag.min.js"></script>
	<?php require "subirfactura/scriptSB.php"; ?>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <!--plugins-->
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <!-- Main JS-->
    <script src="assets/js/main.js"></script>


  </body>
</html>