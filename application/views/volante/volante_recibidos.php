<div class="row">
<div class="col-sm-12">
	<h1 class="text-center"><?= $title ?></h1>
<br>
<div class="row justify-content-center">
	<div class="col-12 col-md-10 col-lg-8">
		<form class="card card-sm" style="background-color:#C2CEDB;">
			<div class="card-body row no-gutters align-items-end">
				<div class="col-2">
					<label for="numero">Número:</label>
					<input class="form-control form-control-borderless" type="number" name="numero" min="1" max="999" value="<?= $fnumero?>">
				</div>
				<div class="col-2">
					<label for="year">Año:</label>
					<input class="form-control form-control-borderless" type="number" name="year"  min="1" max="99" value="<?= $fyear ?>">
				</div>
				<!--end of col-->
				<div class="col-6">
					<label for="year">Asunto:</label>
					<input class="form-control form-control-borderless" type="search" name="asunto" value="<?= $fasunto ?>" placeholder="Ingrese palabras">
				</div>
				<!--end of col-->
				<div class="col-2">
					<button class="btn btn-light ml-2" type="submit"><img src="<?= base_url('assets/images/search.png') ?>" width="20px">Buscar</button>
				</div>
				<!--end of col-->
			</div>
		</form>
	</div>
	<!--end of col-->
</div>
<br>
<div class="table-orden">          
<table class="table table-bordered">
	<thead class="thead-dark">
		<tr>
		<th style="width: 10%;">Número</th>
		<th style="width: 20%;">Origen</th>
		<th style="width: 40%;">Asunto</th>
		<th style="width: 10%;">Archivo</th>
		<th style="width: 10%;">Adjunto</th>
		<th style="width: 10%;">Visto</th>
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
					<a class="btn btn-light" href='<?php echo site_url('uploads/'.$volante['enlace_archivo']); ?>' target="_blank" title="abrir archivo">
						<img src="<?= base_url('assets/images/file_open.png') ?>" width="20px">
					</a>
				</td>
				<td>
					<?php if($volante['enlace_adjunto'] != NUll) { ?>
						<a class="btn btn-light" href='<?php echo base_url('uploads/'.$volante['enlace_adjunto']); ?>' target="_blank" title="abrir archivo">
							<img src="<?= base_url('assets/images/file_open.png') ?>" width="20px">
						</a>
					<?php } ?>
				</td>
				<td>
					<?php echo form_open($action);?>
						<?php 
							$visto = $volante['visto']; 
							if($visto == 1){
								echo "<input type='checkbox' name='id_volante' checked='checked' disabled>";
							} else {
								echo "<input type='checkbox' name='id_volante' onchange='submit();' value='$id'>";
							}
						?>
					</form>
				</td>
			</tr>
		<?php endforeach;?>
	</tbody>
</table>
</div>
<div class="pagination">
	<?= $pagination ?>
</div>

</div>
</div>

