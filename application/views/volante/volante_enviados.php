<div class="row">
<div class="col-sm-12">
	<h1><?= $title ?></h1>
<br>
<a class="btn btn-success mb-2" href="<?= $new_url ?>" role="button">Nuevo</a>
<div class="table-orden">          
<table class="table">
	<thead class="thead-dark">
		<tr>
		<th style="width: 6%;">Número</th>
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
			<td><?php echo fechaEsp($volante['fecha']); ?></td>
			<td><?php echo $volante['name']; ?></td>
			<td><?php echo $volante['asunto']; ?></td>
	        <td><a href='<?php echo base_url('uploads/'.$volante['enlace_archivo']); ?>' target="_blank" >abrir</a></td>
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
				<a class="btn btn-primary" href="<?= $edit_url . $id ?>" role="button">editar</a> 
				<a class="btn btn-danger" href="<?= $del_url . $id ?>" role="button">borrar</a>
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

