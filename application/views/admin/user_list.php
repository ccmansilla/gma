<h2><?php echo $title; ?></h2>

<a class="btn btn-success" href="<?=base_url()?>admin/user_create" role="button">Nuevo</a>

<div class="table-user">          
<table class="table">
	<thead class="thead-dark">
		<tr>
			<th>Escuadron</th>
			<th>Rol</th>
			<th>Usuario</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	        <tr>
		        <td><?php echo $user['name']; ?></td>
		        <td><?php echo $user['role']; ?></td>
		        <td><?php echo $user['nick']; ?></td>
		        <td><a class="btn btn-primary" href="<?= base_url('admin/user_edit/') . $user['id'] ?>" role="button" >editar</a> <a class="btn btn-danger" href="<?= base_url('admin/user_delete/') . $user['id'] ?>" role="button" >borrar</a></td>
		    </tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>
<div class="pagination">
	<?= $pagination ?>
</div>