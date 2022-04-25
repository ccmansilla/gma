<div class="row">
<div class="col-sm-12">
	<h1>Lista de Volantes Enviados</h1>
<br>
<a class="btn btn-success mb-2" href="<?= $new_url; ?>" role="button">Nuevo</a>
<div class="table-orden">          
<table class="table">
	<thead class="thead-dark">
		<tr>
		<th style="width: 6%;">Nº/Año</th>
		<th style="width: 9%;">Fecha</th>
		<th style="width: 18%;">Destino</th>
		<th style="width: 40%;">Asunto</th>
		<th style="width: 6%;">Archivo</th>
		<th style="width: 6%;">Visto</th>
		<th style="width: 15%;"></th>
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

