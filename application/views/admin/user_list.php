<h2><?php echo $title; ?></h2>

<a class="btn btn-light" href="<?=base_url()?>admin/user_create" role="button">
<img src="<?= base_url('assets/images/add.png') ?>" width="20px">Nuevo</a>

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
		        <td>
					<a class="btn btn-light" href="<?= base_url('admin/user_edit/') . $user['id'] ?>" role="button" >
						<img src="<?= base_url('assets/images/edit.png') ?>" width="20px">Editar
					</a> 
					<a class="btn btn-light" href="<?= base_url('admin/user_delete/') . $user['id'] ?>" role="button" >
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
