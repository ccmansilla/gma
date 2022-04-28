<div class="row">
<div class="col-sm-12">
	<h1><?= $title ?></h1>
<br>
<a class="btn btn-light mb-2" href="<?= $new_url ?>" role="button"  title="nuevo volante">
	<img src="<?= base_url('assets/images/add.png') ?>" width="20px">Nuevo
</a>
<div class="table-orden">          
<table class="table">
	<thead class="thead-dark">
		<tr>
		<th style="width: 10%;">Número</th>
		<th style="width: 20%;">Destino</th>
		<th style="width: 30%;">Asunto</th>
		<th style="width: 10%;">Archivo</th>
		<th style="width: 10%;">Visto</th>
		<th style="width: 20%;"></th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($volantes as $volante): ?>
		<?php $id = $volante['id']; ?>
	    <tr>
	        <td><?php echo $volante['numero']."/".$volante['year']; ?></td>
			<td><?php echo $volante['name']; ?></td>
			<td><?php echo $volante['asunto']; ?></td>
	        <td>
				<a class="btn btn-light" href='<?php echo base_url('uploads/'.$volante['enlace_archivo']); ?>' target="_blank" title="abrir archivo">
					<img src="<?= base_url('assets/images/file_open.png') ?>" width="20px">
				</a>
			</td>
			<td>
				<?php 
					$visto = $volante['visto'];
					if($visto == 1) {
						echo 'Sí';
					} else {
						echo 'No';	
					}
				?>
			</td>
	        <td>
				<a class="btn btn-light" href="<?= $edit_url . $id ?>" role="button" title="editar volante">
					<img src="<?= base_url('assets/images/edit.png') ?>" width="20px">Editar
				</a> 
				<a class="btn btn-light" href="<?= $del_url . $id ?>" role="button" title="borrar volante">
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
</div>
</div>

