<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" id="mostrar50" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar50" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp; AVISOS IMPORTANTES</p></strong>


<div  id="mensajeNOTAS">
<div class="progress" style="width: 25%;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $eventoscrono ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">%</div></div>
									</div>
									</div>
							
	        <div id="target50" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">

                      <form class="row g-3 needs-validation was-validated" id="NOTASform"  novalidate="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 



                                    
    <input type="hidden" value="hNOTAS" name="hNOTAS"/>     
 


           <?php
$querycontras = $SUBEFACTURA->Listado_NOTAS();
?>

<br />
<div class='table-responsive'>
<div align='right'>
</div>
<br />
<div id='employee_table'>
<tbody= 'font-style:italic;'>
<table class="table table-striped table-bordered" style="width:100%" id='reset_NOTAS' name='reset_NOTAS'>
<tr style='background:#f5f9fc;text-align:center'>

<th width="20%"style="background:#c9e8e8">INFORMACIÓN</th>
<th width="20%"style="background:#c9e8e8">DOCUMENTO</th>
<th style="background:#c9e8e8">OBSERVACIONES</th>
<th width="20%"style="background:#c9e8e8">FECHA DE CARGA</th>

</tr>

<?php
$urlADJUNTO_NOTAS ='';
while($row = mysqli_fetch_array($querycontras))
{	
	$urlADJUNTO_NOTAS = $conexion->descargararchivo($row["ADJUNTO_NOTAS"]);
?>

<tr style='background:#f5f9fc;'>

<td width="500" style="
    word-break: break-word;
    white-space: normal;
    line-height: 1.4em;
    max-height: 5.6em; /* (3 líneas * 1.2em) */
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Limita a 3 líneas */
    -webkit-box-orient: vertical;
">
    <?php echo $row["DOCUMENTO_NOTAS"]; ?>
</td>
<td><?php echo $urlADJUNTO_NOTAS; ?></td>
<td width="700" style="
    word-break: break-word;
    white-space: normal;
    line-height: 1.4em;
    max-height: 10.6em; /* (3 líneas * 1.2em) */
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 10; /* Limita a 3 líneas */
    -webkit-box-orient: vertical;
">
    <?php echo $row["OBSERVACIONES_NOTAS"]; ?>
</td>


<td style="text-align:center"><?php echo $row["FECHA_NOTAS"]; ?></td>



</tr>
<script>
// ===== CONFIG =====
const TABLE_ID = 'reseteINFOIMPO';             // tu ID de tabla
const STORAGE_KEY = `rowHeights:${TABLE_ID}`;  // clave localStorage

// Aplica alturas guardadas lo antes posible (reduce FOUC)
(function applySavedHeightsEarly() {
  try {
    const saved = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');
    const table = document.getElementById(TABLE_ID);
    if (!table || !saved.length) return;

    const rows = Array.from(table.querySelectorAll('tr'));
    rows.forEach((tr, i) => {
      const h = saved[i];
      if (!h) return;
      tr.querySelectorAll('td,th').forEach(td => {
        td.style.height = h + 'px';
      });
    });
  } catch (_) {}
})();

// Calcula altura máxima por fila y la aplica a todas las celdas de esa fila
function sincronizarFilas() {
  const table = document.getElementById(TABLE_ID);
  if (!table) return;

  const rowHeights = [];
  const rows = Array.from(table.querySelectorAll('tr'));

  rows.forEach(tr => {
    // quitar alturas previas para medir natural
    tr.querySelectorAll('td,th').forEach(td => td.style.height = '');
    // medir alto máximo real de las celdas
    const maxH = Math.max(
      ...Array.from(tr.querySelectorAll('td,th')).map(td => td.scrollHeight || td.offsetHeight || 0),
      0
    );
    // aplicar el mismo alto a todas las celdas
    tr.querySelectorAll('td,th').forEach(td => td.style.height = maxH + 'px');
    rowHeights.push(maxH);
  });

  // guardar para la próxima recarga
  try {
    localStorage.setItem(STORAGE_KEY, JSON.stringify(rowHeights));
  } catch (_) {}
}

// Re-sincroniza cuando todo está cargado (imágenes/fuentes) y en cambios de tamaño
window.addEventListener('load', sincronizarFilas);
window.addEventListener('resize', () => {
  // debounced
  clearTimeout(window.__syncTimer);
  window.__syncTimer = setTimeout(sincronizarFilas, 120);
});

// Si agregas/actualizas filas vía AJAX, llama a sincronizarFilas() después de inyectar el HTML.
// Ejemplo: $.ajax({ ... success: function(){ /* insertas HTML */ sincronizarFilas(); } });

// Si además usas tu autoajuste por contenido, llámalo antes:
function autoAjustarAlturas() {
  document.querySelectorAll('.auto-height').forEach(celda => {
    celda.style.height = ''; // reset para medir natural
    celda.style.whiteSpace = 'pre-wrap';
    celda.style.overflow = 'visible';
  });
  // luego sincronizamos filas para igualar alturas
  sincronizarFilas();
}
</script>
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