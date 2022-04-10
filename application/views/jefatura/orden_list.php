<div class="row">
<div class="col-sm-12">
<br>
<a class="btn btn-success" href="<?=base_url()?>jefatura/order_create" role="button">Nuevo</a>
<div class="table-orden">          
<table class="table">
	<thead class="thead-dark">
		<tr>
		<th>Tipo</th>
		<th>Numero/Año</th>
		<th>Tema</th>
		<th>Archivo</th>
		<th>Vistos</th>
		<th>Accion</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($orders as $order): ?>
		<?php $id = $order['id']; ?>
	    <tr>
			<td><?php echo $order['type']; ?></td>
	        <td><?php echo $order['number']."/".$order['year']; ?></td>
			<td><?php echo $order['about']; ?></td>
	        <td><a href='<?php echo site_url('uploads/'.$order['file']); ?>' target="_blank" >abrir</a></td>
			<td><a data-toggle="modal" onclick="modal(<?php echo $id; ?>)" href="#">   
				<!-- href='<?php echo site_url('jefatura/order_views/'.$order['id']); ?>' target="_blank">
	--> listar</a></td>
	        <td><a class="btn btn-primary" href="<?= base_url('jefatura/order_edit/') . $order['id'] ?>" role="button">editar</a> <a class="btn btn-danger" href="<?=base_url('jefatura/order_delete/') . $order['id'] ?>" role="button">borrar</a></td>
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
          <h4 class="modal-title">Lista de Usuarios</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
			<pre  id="modal__content">

			</pre>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>

</div>
</div>
<script>
	function modal(id){
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
			$("#modal__content").html($lista);
			//console.log(users);
		});
		
		$("#myModal").modal()
	}
</script>
