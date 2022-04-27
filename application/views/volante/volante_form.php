<div id="formulario" class="col-sm-6">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors();?>
<?php //echo error;?>

<?php echo form_open_multipart($action);?>
		
	<div class="form-group">
	    <label class="control-label col-sm-2" for="fecha">Fecha: </label>
	    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo (isset ($volante))? $volante['fecha'] : ''?>" /><br />
	</div>

	<div class="form-group">
	    <label class="control-label col-sm-2" for="numero">Numero: </label>
		<input type="number" class="form-control" id="numero" name="numero" value="" /> 
	</div>

	<div class="form-group">
	    <label class="control-label col-sm-2" for="destino">Destino: </label>
		<?php echo form_dropdown('destino', $destinos, '', "class='form-control'"); ?>
	</div>

	<div class="form-group">
	    <label class="control-label col-sm-2" for="tema">Asunto: </label>
	    <textarea class="form-control" id="asunto" name="asunto">
			<?php echo (isset ($volante))? $volante['asunto'] : '' ?>
		</textarea><br />
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for="nombre">Archivo: </label>
		<input type="file" class="form-control-file" name="file" size="20" />
	<br />

    <div class="col-sm-offset-2 text-center pt-5">
    	<input type="submit" class="btn btn-success" name="submit" value="Guardar" />
        <button class="btn btn-danger"  onclick="window.history.back();" >Cancelar</button>
    </div>
</form>
</div>
