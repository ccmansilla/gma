<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        
        <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css')?>">

		<link rel="shortcut icon" href="<?= base_url('favicon.png');?>" type="image/png">

        <style>
            * { -webkit-box-sizing:border-box; -moz-box-sizing:border-box; -ms-box-sizing:border-box; -o-box-sizing:border-box; box-sizing:border-box; }

            html { 
                width: 100%; 
                height:100%; 
                overflow:hidden; 
            }

            body{
                width: 100%;
                height:100vh;
                background-image: url("<?= base_url('assets/images/fondo.png');?>");
				background-repeat: no-repeat;
				background-size: cover;
            }

			.contenedor {
				width: 100%;
				height: 100vh;
				display: flex;
				flex-direction: column;
				justify-content: end;
				align-items: center;
			}

            .filtro {
                position: absolute;
                top: 0px;
                left: 0px;
                background-color: #3532326e;
                width: 100%;
                height:100vh;
            }

            .logo {
                width: 120px;
                height: 180px;
            }

            .title{
				width: 300px;
				height: 260px;
                padding: 10px;
            }

			.title h1 {
				font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
				color: white;
				text-shadow: 2px 2px 2px black;
			}

			.login {
				width: 300px;
				height: 220px;
			}

            .form-group input{
                background: none;
                color: white;
                height: 42px;
                font-size: 18px;
                border:1px white solid;
                padding-left: 54px;
                border-radius: 5px;
            }

            .form-group input::placeholder{
                color: silver;
            }

            .form-group input::placeholder:focus{
                color: gray;
            }

            input[type=submit]{
                width: 60%;
                margin: 5px 0 25px;
                font-size: 18px;
            }

        </style>
            
        <title>Mantenimiento</title>
        
    </head>
    <body>
        <div class="filtro">
			<div class="contenedor">
				<div class="title text-center">
					<div>
						<img src="<?= base_url('assets/images/escudo.png');?>" class="logo" alt="">
					</div>
					<div>
						<h1>Mantenimiento</h1>
					</div>
				</div>
				<div class="login text-center">
					<?= form_open('/auth/login') ?>
					<?php
						$nick = array(
							'name' => 'nick',
							'class' => 'form-control',
							'value' => (isset($nick))? $nick : '',
							'placeholder' => 'Usuario',
							'required' => 'required'
						);

						$pass = array(
							'name' => 'pass',
							'class' => 'form-control',
							'type' => 'password',
							'value' => (isset($pass))? $pass : '',
							'placeholder' => 'Contraseña',
							'required' => 'required'
						);

						$submit = array(
							'class' => 'btn btn-outline-light',
							'type' => 'submit',
							'value' => 'Entrar'
						);
					?>
					<div class="form-group"><?=form_input($nick);?></div>
					<div class="alert-danger" role="alert"><?= form_error('nick'); ?></div>
					<div class="form-group"><?=form_input($pass);?></div>
					<div class="alert-danger" role="alert"><?= form_error('pass'); ?></div>
					<div class="alert-danger" role="alert"><?= (isset($msg))? $msg : "" ?></div>
					<br>
					<div><?= form_submit($submit);?></div>
					<?= form_close();?>
				</div>
			</div>
        </div>

    <script src="<?= base_url('/assets/js/jquery-3.5.1.slim.min.js') ?>" ></script>
    <script src="<?= base_url('/assets/js/bootstrap.bundle.min.js') ?>"></script>

    </body>
</html>
