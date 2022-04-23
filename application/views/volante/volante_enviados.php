<div class="row">
<div class="col-sm-12">
<br>
<a class="btn btn-success" href="<?=base_url()?>jefatura/volante_create" role="button">Nuevo</a>
<div class="table-orden">          
<table class="table">
	<thead class="thead-dark">
		<tr>
		<th>Numero/Año</th>
		<th>Fecha</th>
		<th>Destino</th>
		<th>Asunto</th>
		<th>Archivo</th>
		<th>Visto</th>
		<th></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($volantes as $volante): ?>
		<?php $id = $volante['id']; ?>
	    <tr>
	        <td><?php echo $volante['numero']."/".$volante['year']; ?></td>
			<td><?php echo $volante['fecha']; ?></td>
			<td><?php echo $volante['id_user_destino']; ?></td>
			<td><?php echo $volante['asunto']; ?></td>
	        <td><a href='<?php echo site_url('uploads/'.$volante['enlace_archivo']); ?>' target="_blank" >abrir</a></td>
			<td><?php echo $volante['visto']; ?></td>
	        <td>
				<a class="btn btn-primary" href="<?= base_url('jefatura/volante_edit/') . $id ?>" role="button">editar</a> 
				<a class="btn btn-danger" href="<?=base_url('jefatura/volante_delete/') . $id ?>" role="button">borrar</a>
			</td>
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

