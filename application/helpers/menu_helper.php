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
					'title' => 'Ordenes del día',
					'url' => 'jefatura/index/od'
				),
				array(
					'title' => 'Ordenes de guarnicion',
					'url' => 'jefatura/index/og'
				),
				array(
					'title' => 'Ordenes reservada',
					'url' => 'jefatura/index/or'
				)
            ),
            array(
                array(
					'title' => 'Volantes',
					'url' => ''
				),
				array(
					'title' => 'Volantes enviados',
					'url' => 'jefatura/volante_enviados'
				),
				array(
					'title' => 'Volantes recibidos',
					'url' => 'jefatura/volante_recibidos'
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
					'title' => 'Ordenes del día',
					'url' => 'dependencia/index/od'
				),
				array(
					'title' => 'Ordenes de guarnicion',
					'url' => 'dependencia/index/og'
				),
				array(
					'title' => 'Ordenes reservada',
					'url' => 'dependencia/index/or'
				)
			),
            array(
                array(
					'title' => 'Volantes',
					'url' => ''
				),
				array(
					'title' => 'Volantes enviados',
					'url' => 'dependencia/volante_enviados'
				),
				array(
					'title' => 'Volantes recibidos',
					'url' => 'dependencia/volante_recibidos'
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
