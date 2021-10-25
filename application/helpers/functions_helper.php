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
