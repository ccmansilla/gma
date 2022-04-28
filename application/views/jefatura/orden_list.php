<div class="row">
<div class="col-sm-12">
<h1><?= $title; ?></h1>
<br>
<a class="btn btn-light mb-2" href="<?=base_url()?>jefatura/order_create" role="button" title="nueva orden">
	<img src="<?= base_url('assets/images/add.png') ?>" width="20px">Nueva
</a>
<div class="table-orden">          
<table class="table">
	<thead class="thead-dark">
		<tr>
		<th style="width: 10%;">Número</th>
		<th style="width: 50%;">Tema</th>
		<th style="width: 10%;">Archivo</th>
		<th style="width: 10%;">Vistos</th>
		<th style="width: 20%;">Accion</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($orders as $order): ?>
		<?php 
			$id = $order['id']; 
			$numero = $order['number']."/".$order['year'];
		?>
	    <tr>
	        <td><?= $numero; ?></td>
			<td><?= $order['about']; ?></td>
	        <td>
				<a class="btn btn-light" href='<?php echo site_url('uploads/'.$order['file']); ?>' target="_blank"  title="abrir archivo">
					<img src="<?= base_url('assets/images/file_open.png') ?>" width="20px">
				</a>
			</td>
			<td>
				<a class="btn btn-light" data-toggle="modal" onclick="modal(<?= $id ?>, '<?= $numero ?>')" href="#"  title="listar vistos">   
					<img src="<?= base_url('assets/images/fact_check.png') ?>" width="20px">
				</a>
			</td>
	        <td class="text-center">
				<a class="btn btn-light" href="<?= base_url('jefatura/order_edit/') . $id ?>" role="button"  title="editar orden">
					<img src="<?= base_url('assets/images/edit.png') ?>" width="20px">Editar
				</a> 
				<a class="btn btn-light" href="<?=base_url('jefatura/order_delete/') . $id ?>" role="button"  title="borrar orden">
					<img src="<?= base_url('assets/images/delete.png') ?>" width="20px">Borrar
				</a>
			</td>
	    </tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>
<div class="pagination">
	<?= $pagination ?>
</div>
  <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title" id="modal_title">Dependencias</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<pre  id="modal_content">

			</pre>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-light" data-dismiss="modal">Cerrar</button>
        </div>
        
      </div>
    </div>
  </div>

</div>
</div>
<script>
	function modal(id, numero){
		fetch('http://localhost/gma/jefatura/order_views/'+id)
		.then((response) => {
			return response.json();
		})
		.then((users) => {
			$lista = '';
			for (var i = 0; i < users.length; i++){
				var user = users[i];
				$lista += user['name'] + '<br>';
			}
			$("#modal_content").html($lista);
			$("#modal_title").html('Dependencias con visto Orden '+numero);
			//console.log(users);
		});
		
		$("#myModal").modal()
	}
</script>
