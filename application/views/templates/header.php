<?php 
	$menu_active = (isset($menu_active))? $menu_active : 'Acerca de';
?>
<!DOCTYPE html>
<html lang="es">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <link rel="stylesheet" href="<?= base_url('/assets/css/bootstrap.min.css')?>">
			<link rel="shortcut icon" href="<?= base_url('favicon.png');?>" type="image/png">
            
            <title>Mantenimiento</title>

            <style>
			
				body{
					background-color: #f2f2f2;
				}

                .nav__bg {
                    background-color:  #245C8C;
                }

                .nav__dropdown__bg {
                    background-color: #F9ED93; /*#F6F2D4;*/
                }

                .nav__dropdown__color {
                    color: gray;
                }

                .dropdown-item:hover{
                    color: black !important;
                }

                
                .dropdown-item:focus{
                    background-color: white;
                }

                .header__borde {
                    border-bottom: 1px black solid;
                    box-shadow: 0px 5px 5px #000;
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
                    background-color: #C2CEDB;/*#F9ED93;*/
                    opacity: .85;
					margin: 20px;
                    padding: 20px;
                    border-radius: .3rem;
                    border: 1px groove #000 !important;
                    -webkit-box-shadow:  0px 5px 5px 0px #000;
                            box-shadow:  0px 5px 5px 0px #000;
                    color: black;
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
                    width: 70px;
					height: 100px;
                    margin-left: 10px;
                    margin-right: 20px;
					border: 0;
				}
				
				.nav-link{
                    color: rgba(255,255,255) !important;
					font-weight: bold;
				}

                .dropdown-item:hover {
                    color: blue;
                }

				.thead-dark th{
					background-color: gray !important;
				}
				
				.username{
					color: rgba(255,255,255);
                    font-weight: bold;
				}

                #view_container {
                    width: 100%;
                    height: 100%;
                }

                .form__number {
                    display: inline-block;
                    /*width: 45%;*/
                    height: calc(1.5em + .75rem + 2px);
                    padding: .375rem .75rem;
                    font-size: 1rem;
                    font-weight: 400;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: .25rem;
                    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
                }

                .form__flex {
                    display: flex;
                    align-items: center;
                    justify-content: space-around;
                }

				.btn {
					border: 1px black solid;
                    font-weight: bold;
				}

				.btn:hover {
                    background-color: #92a0d0;
                    color: white;
					border: 1px black solid;
				}

                .btn-light {
                    /*background-color: #AECC0D;*/
                    background-color: #243471;
                    color: white;
                }

                .modal-header{
                    background-color: #245C8C;
                    color: white;
                }

                .close {
                    color: white;
                }

                .close:hover {
                    color: white;
                }
				
            </style>
                
        </head>
        <body>
        <header class="container-fluid nav__bg header__borde">      
            <nav class="navbar navbar-dark nav__bg navbar-expand-md"> 
                <a href="#">
                    <img class="logo" src="<?= base_url('assets/images/escudo.png'); ?>" alt="">
                </a>
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
                                    <div class="dropdown-menu nav__dropdown__bg" aria-labelledby="navbarDropdown1">
                                <?php } else {?>
                                    <a class="dropdown-item nav__dropdown__color" href="<?= base_url() . $subitem['url'] ?>"><?= $subitem['title'] ?></a>
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
        </header> 
        
        <div id="container" class="conatiner">
            <div id="body">
