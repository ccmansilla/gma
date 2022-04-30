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
		<?php 
			$id = $volante['id'];
			$numero = $volante['numero']."/".$volante['year']; 
		?>
	    <tr>
	        <td><?php echo $numero; ?></td>
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
				<a class="btn btn-light" onclick="modalBorrar(<?= $id ?>, '<?= $numero ?>')"  role="button" title="borrar volante">
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
<!-- Modal Borrado -->
<div class="modal fade" id="modal__borrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Confirmar</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div id="modal__body">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-light" data-dismiss="modal">No</button>
			<a href="#delete" id="confirma"><button type="button" class="btn btn-light">Si</button></a>
		</div>
		</div>
	</div>
	</div>

</div>
</div>
<script>
	function modalBorrar(id, numero){
		$("#modal__body").html("<br>&nbsp;¿Esta seguro de borrar el volante numero "+numero+"?  <br><br>");
		$("#confirma").attr("href", "<?= $del_url ?>"+id);
		$("#modal__borrar").modal();
	}
</script>
</div>
</div>

