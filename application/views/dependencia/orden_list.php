	<!--
	<div class="row border">
		<div class="col-sm-12 bg-light">
			<?php echo form_open($action); ?>
				<label for="tipo">Tipo:</label>
				<select name='tipo' onchange="submit()">
					<option value='od' <?= ($type == 'od')? 'selected': '';?> >orden del día</option>
					<option value='og' <?= ($type == 'og')? 'selected': '';?>>orden de guarnicíon</option>
					<option value='or' <?= ($type == 'or')? 'selected': '';?>>orden reservada</option>
				</select>
			</form>
		</div>
	</div>
	-->
	<div class="row">
	  <div class="col-sm-2">
		<div class="table-orden">          
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
				<th>Número</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($orders as $order): ?>
				<tr>
					<td>
						<a href="#" onclick="cambiar_vista('<?php echo site_url('uploads/'.$order['file']);?>')" title="<?php echo $order['about'];?>">
							<?php echo $order['type']."_".$order['number']."_".$order['year']; ?>
						</a>
					</td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
		</div>
	  </div>
		<div class="col-sm-10" id="view_container"> 
			<embed id="vista" frameborder="0" width="100%" height="400px">
		</div>
	</div>
	<div class="row" id="pages">
		<ul class="pagination">
			<?= $pagination ?>
		</ul>
	</div>	
	</div>

	<script>
		function cambiar_vista(source){
			var parent = $("#vista").parent();
			$("#vista").remove();
			parent.append("<embed id='vista' frameborder='0' width='100%' height='400px' src=" + source + " />");
		}
	</script>
