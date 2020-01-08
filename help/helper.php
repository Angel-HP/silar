<?php
/*
Este codigo valida los campos provenientes de formularios enviados por el metodo POST
Lo que hace es limpiar los espacios vacios y evitando insercion de codigo SQL o JS
definido en un afuncion que recibe un valor escrito desde el formulario
 */

function validate_field($field){
	$field = trim($field);
	$field = stripcslashes($field);
	$field = htmlspecialchars($field);

	return $field;
}