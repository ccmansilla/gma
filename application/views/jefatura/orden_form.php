<div id="formulario" class="col-sm-6">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors();?>
<?php //echo error;?>

<?php echo form_open_multipart($action);?>
	<div class="form-group">
	    <label class="control-label col-sm-2" for="tipo">Tipo: </label>
		<select class="form-control" id="tipo" name="tipo">
			<?php $type = (isset($order))? $order['type'] : ''?>
			<option value="od" <?= ($type == 'od')? 'selected' : ''?> >Orden del Día</option>
			<option value="og" <?= ($type == 'og')? 'selected' : ''?> >Orden de Guarnición</option>
			<option value="or" <?= ($type == 'or')? 'selected' : ''?> >Orden Reservada</option>
		</select>
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for="fecha">Fecha: </label>
	    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo (isset ($order))? $order['date'] : ''?>" /><br />
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for="numero">Numero: </label>
	    <input type="text" class="form-control" id="numero" name="numero" value="<?php echo (isset ($order))? $order['number'] : ''?>" /><br />
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for="tema">Tema: </label>
	    <textarea class="form-control" id="tema" name="tema"><?php echo (isset ($order))? $order['about'] : '' ?></textarea><br />
	</div>
	
	<div class="form-group">
	    <label class="control-label col-sm-2" for="nombre">Archivo: </label>
		<input type="file" class="form-control-file" name="file" size="20" />
	<br />

	<div class="form-group">
	    <label class="control-label col-sm-2" for="attached">Adjunto: </label>
		<input type="file" class="form-control-file" name="attached" size="20" />
	</div>

    <div class="col-sm-offset-2 text-center pt-5">
    	<input type="submit" class="btn btn-light" name="submit" value="Guardar" />
        <button class="btn btn-light" onclick="window.history.back();" >Cancelar</button>
    </div>
</form>
</div>