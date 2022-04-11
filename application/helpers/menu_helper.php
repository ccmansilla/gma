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
                array(
					'title' => 'Ordenes',
					'url' => ''
				),
				array(
					'title' => 'Orden día',
					'url' => 'jefatura/index/od'
				),
				array(
					'title' => 'Orden guarnicion',
					'url' => 'jefatura/index/og'
				),
				array(
					'title' => 'Orden reservada',
					'url' => 'jefatura/index/or'
				)
            ),
            array(
                array(
					'title' => 'Volantes',
					'url' => ''
				),
				array(
					'title' => 'Enviados',
					'url' => 'jefatura/volante_list/enviados'
				),
				array(
					'title' => 'Recibidos',
					'url' => 'jefatura/volantes_list/recibidos'
				)
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
                array(
					'title' => 'Volantes',
					'url' => ''
				),
				array(
					'title' => 'Enviados',
					'url' => 'dependencia/volante_list/enviados'
				),
				array(
					'title' => 'Recibidos',
					'url' => 'dependencia/volantes_list/recibidos'
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