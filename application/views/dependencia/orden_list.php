
	<div class="row" style="height: 700px;">
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
							<label for="visto">
								<a href="#" onclick="cambiar_vista('<?php echo site_url('uploads/'.$order['file']);?>')" title="<?php echo $order['about'];?>">
									<?php echo $order['type']." ".$order['number']."/".$order['year']; ?>
								</a>
							</label>
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
				<?php endforeach ?>
			</tbody>
		</table>
		</div>
	  </div>
		<div class="col-sm-10" id="view_container"> 
			<embed id="vista" frameborder="0" width="100%" height="100%">
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
			parent.append("<embed id='vista' frameborder='0' width='100%' height='100%' src=" + source + " />");
		}
	</script>
