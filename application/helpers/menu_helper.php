<?php

function getMenu($role) {
    if ($role == 'admin') {
        $menu = array(
            array(
                'title' => 'Usuarios',
                'url' => 'admin/index'
            ),
            array(
                'title' => 'Acerca de',
                'url' => 'about'
            ),
            array(
                'title' => 'Salir',
                'url' => 'auth/logout'
            )
        );
        return $menu;
    } elseif ($role == 'jefatura') {
        $menu = array(
            array(
                'title' => 'Ordenes',
                'url' => 'jefatura/index'
            ),
            array(
                'title' => 'Salir',
                'url' => 'auth/logout'
            )
        );
        return $menu;
    } elseif ($role == 'dependencia') {
        $menu = array(
			array(
				array(
					'title' => 'Ordenes',
					'url' => ''
				),
				array(
					'title' => 'Orden día',
					'url' => 'dependencia/index/od'
				),
				array(
					'title' => 'Orden guarnicion',
					'url' => 'dependencia/index/og'
				),
				array(
					'title' => 'Orden reservada',
					'url' => 'dependencia/index/or'
				)
			),
            array(
                'title' => 'Salir',
                'url' => 'auth/logout'
            )
        );
        return $menu;
    } else {
        return Null;
    }
    
}