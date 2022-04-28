
	<div class="table-orden">          
	<table class="table">
	<thead class="thead-dark">
		<tr>
		<th style="width: 10%;">Tipo</th>
		<th style="width: 10%;">Número</th>
		<th style="width: 60%;">Tema</th>
		<th style="width: 10%;">Archivo</th>
		<th style="width: 10%;">Vistos</th>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($orders as $order): ?>
		<?php 
			$id = $order['id']; 
			$numero = $order['number']."/".$order['year'];
		?>
	    <tr>
			<td><?= $order['type']; ?></td>
	        <td><?= $numero; ?></td>
			<td><?= $order['about']; ?></td>
	        <td><a href='<?php echo site_url('uploads/'.$order['file']); ?>' target="_blank" >abrir</a></td>
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
