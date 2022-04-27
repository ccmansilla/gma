<div class="row">
<div class="col-sm-12">
	<h1><?= $title ?></h1>
<br>
<div class="table-orden">          
<table class="table table-bordered">
	<thead class="thead-dark">
		<tr>
		<th style="width: 6%;">Número</th>
		<th style="width: 9%;">Fecha</th>
		<th style="width: 17%;">Origen</th>
		<th style="width: 50%;">Asunto</th>
		<th style="width: 9%;">Archivo</th>
		<th style="width: 9%;">Visto</th>
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
	        <td><a href='<?php echo site_url('uploads/'.$volante['enlace_archivo']); ?>' target="_blank" >abrir</a></td>
			<td>
				<?php 
					$visto = $volante['visto']; 
					if($visto == 1){
						echo "<input type='checkbox' name='' id='' checked='checked' disabled>";
					} else {
						echo "<input type='checkbox' name='' id=''>";
					}
				?>
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

