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
		<th>File</th>
		<th>Accion</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($orders as $order): ?>
	    <tr>
			<td><?php echo $order['type']; ?></td>
	        <td><?php echo $order['number']."/".$order['year']; ?></td>
			<td><?php echo $order['about']; ?></td>
	        <td><a href='<?php echo site_url('uploads/'.$order['file']); ?>'>archivo</a></td>
	        <td><a class="btn btn-primary" href="<?= base_url('jefatura/order_edit/') . $order['id'] ?>" role="button">editar</a> <a class="btn btn-danger" href="<?=base_url('jefatura/order_delete/') . $order['id'] ?>" role="button">borrar</a></td>
	    </tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>
<div class="pagination">
	<?= $pagination ?>
</div>
</div>
</div>