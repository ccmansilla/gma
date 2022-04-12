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
	    <label class="control-label col-sm-2" for="numero">Numero/Año: </label>
		<div class="form__flex">
			<input type="number" class="form__number" id="numero" name="numero" value="" /> 
			/ <input type="number" class="form__number" id="year" name="year" value="" /><br />
		</div>
	</div>

	<div class="form-group">
	    <label class="control-label col-sm-2" for="destino">Destino: </label>
		<select class="form-control" id="destino" name="destino">
			<option value="od">Dpto Ingenieria<option>
		</select>
	</div>

	<div class="form-group">
	    <label class="control-label col-sm-2" for="tema">Asunto: </label>
	    <textarea class="form-control" id="asunto" name="asunto">
			<?php echo (isset ($volante))? $volante['asunto'] : '' ?>
		</textarea><br />
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for="nombre">Archivo: </label>
		<input type="file" name="file" size="20" />
	<br />

    <div class="col-sm-offset-2 col-sm-6">
    	<input type="submit" class="btn btn-success" name="submit" value="Guardar" />
        <button class="btn btn-danger" href="<?= base_url("jefatura/volante_list/enviados");?>" >Cancelar</button>
    </div>
</form>
</div>