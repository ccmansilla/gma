
<h1><?= $title; ?></h1>
<br>
	<div class="table-orden">          
	<table class="table">
	<thead class="thead-dark">
		<tr>
		<th style="width: 10%;">Número</th>
		<th style="width: 70%;">Tema</th>
		<th style="width: 10%;">Archivo</th>
		<th style="width: 10%;">Visto</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($orders as $order): ?>
		<?php 
			$id = $order['id']; 
			$numero = $order['number']."/".$order['year'];
		?>
	    <tr>
	        <td><?= $numero; ?></td>
			<td><?= $order['about']; ?></td>
	        <td>
				<a class="btn btn-light" href='<?php echo site_url('uploads/'.$order['file']); ?>' target="_blank" title="abrir archivo">
					<img src="<?= base_url('assets/images/file_open.png') ?>" width="20px" >
				</a>
			</td>
			<td>
			<?php echo form_open("dependencia/view/$type/$from");?>	
				<?php
					$id = $order['id'];
					if ($order['id_order'] != NULL) {
						echo "<input type='checkbox' name='id_order' checked='cheked' disabled>";
					} else {
						echo "<input type='checkbox' name='id_order' onchange='submit();' value='$id'>";
					}
				?>
			</form>
			</td>
	    </tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	<div class="row" id="pages">
		<ul class="pagination">
			<?= $pagination ?>
		</ul>
	</div>	
	</div>
