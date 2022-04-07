<?php 
	$menu_active = (isset($menu_active))? $menu_active : 'Acerca de';
?>
<!DOCTYPE html>
<html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css')?>">
            
            <title>GMA</title>

            <style>
			
				body{
					background-color: #f2f2f2;
				}
				
                table, tr, th, td{
                    border: 1px solid black;
                }

                .table td, .table thead th{
                    border: 1px solid black;
                }

                .table-user, .table-sa, .table-taller{
                    padding: 10px;
                    max-width: 800px; 
                }

                .table-ot {
                    padding: 10px;
                }

                #container{
                    margin: 20px;
                }

                #body{
                    margin: 0 15px 0 15px;
                }

                #formulario{
                    background-color: gray;
                    opacity: .85;
					margin: 20px;
                    padding: 20px;
                    border-radius: .3rem;
                    border: 1px groove #000 !important;
                    -webkit-box-shadow:  0px 5px 5px 0px #000;
                            box-shadow:  0px 5px 5px 0px #000;
                    color: white;
                }

                fieldset {
                    border: 1px groove #ccc !important;
                    padding: 0 1.4em 1.4em 1.4em !important;
                    margin: 0 0 1.5em 0 !important;
                }

                legend {
                    width:inherit; /* Or auto */
                    padding:0 10px; /* To give a bit of padding on the left and right */
                    border-bottom:none;
                }

                label {
                    font-weight: bold;
                }

                p.footer {
                    text-align: right;
                    font-size: 11px;
                    border-top: 1px solid #D0D0D0;
                    line-height: 32px;
                    padding: 0 10px 0 10px;
                    margin: 20px 0 0 0;
                }

                .pagination * {
                    padding: 3px;
                }
				
				.logo{
					height: 160px;
					border:0;
					border-radius: .3rem;
					padding: 2rem 2rem;
					margin-bottom: 2rem;
					background-color: #1877f2;
					box-shadow: 5px 5px 5px #000;
					color: white;
				}
				
				.nav-link{
					font-weight: bold;
				}
				.thead-dark th{
					background-color: gray !important;
				}
				
				.username{
					color: white;
				}

                #view_container {
                    width: 100%;
                    height: 100%;
                }
            </style>
                
        </head>
        <body>
        <div id="container">
		<div class="logo">
			<img src="<?= base_url() . 'assets/images/gma.png' ?>" alt="GMA"/>
			<h6>Grupo Mantenimiento Administracion</h6>
		</div>
        <nav class="navbar navbar-dark bg-dark navbar-expand-md border-bottom border-info"> 
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="navbar-nav">
                    <?php foreach ($menu as $item) { ?>
						<?php if(count($item) > 2) {?>
							<li class="nav-item dropdown">
							<?php $i = 1;?>
							<?php foreach ($item as $subitem) { ?>
							<?php if ($i == 1) { ?>
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?= $subitem['title'] ?>
								</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdown1">
							<?php } else {?>
								<a class="dropdown-item" href="<?= base_url() . $subitem['url'] ?>"><?= $subitem['title'] ?></a>
							<?php } ?>
							<?php $i++;?>
							<?php } ?>
							</div>
							</li>
						<?php } else {?>
						<li class="nav-item <?php echo ($menu_active == $item['title'])? "active": ""; ?>">
							<a class="nav-link" href="<?= base_url() . $item['url'] ?>"><?= $item['title'] ?></a>
						</li>
						<?php }?>
                    <?php } ?> 
                </div>
            </div>
            <div class="navbar-nav navbar-right">
                    <span class="username"><?= $this->session->name ?></span>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </nav> 
            <div id="body">
