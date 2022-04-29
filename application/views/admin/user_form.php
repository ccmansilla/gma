<div class="row">
<div id="formulario" class="col-sm-8">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open($action); ?>

    <div class="form-group">
        <label class="control-label col-sm-2" for="role">Rol: </label>
        <select class="form-control" name="role" id="role" >
            <option>dependencia</option>
            <option>jefatura</option>
        </select>
    </div>
    <br />
	
	<div class="form-group">
        <label class="control-label col-sm-2" for="name">Escuadron: </label>
        <input type="text" class="form-control" id="name" name="name" value="<?= (isset($user))? $user['name'] : ""?>" required />
    </div>
    <br />

    <div class="form-group">
        <label class="control-label col-sm-2" for="nick">Usuario: </label>
        <input type="text" class="form-control" id="nick" name="nick" value="<?= (isset($user))? $user['nick'] : ""?>" required />
    </div>
    <br />

    <div class="form-group">
        <label class="control-label col-sm-2" for="pass">Contraseña: </label>
        <input type="text" class="form-control" id="pass" name="pass" required />
    </div>
    <br />

    <div class="col-sm-offset-2 col-sm-6">
        <input type="submit" class="btn btn-light" name="submit" value="Guardar" />
        <button class="btn btn-light" onclick="window.history.back();" >Cancelar</button>
    </div>
</form>
</div>
</div>
<script>

    document.getElementById('rol').addEventListener('change', function () {
        var style = (this.value === 'taller')? 'inline' : 'none';
        document.getElementById('label_taller').style.display = style;
        document.getElementById('num_taller').style.display = style;
    });

</script>
