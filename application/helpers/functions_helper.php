<?php
/**
 * Convierte una fecha sql aaaa-mm-dd en una fecha en formato español dd/mm/aaaa
 */
function fechaEsp($fechaSQL){
    if($fechaSQL !== NULL){
        return date("d/m/Y", strtotime($fechaSQL));
    } else {
        return NULL;
    }
}

/**
 * Convierte en arreglo asociativo
 */
function simple_to_associative($array) {
    $new_array = [];
    foreach ($array as $row) {
		$id = $row['id'];
		$name = $row['name'];
        $new_array[$id] = $name;
    }
    return $new_array;
}
