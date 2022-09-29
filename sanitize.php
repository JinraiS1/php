<?php

header ("X-XSS-Protection: 0");

$permitidos = "/^[a-zA-ZñÑáéíóúü\s]+$/"; 
//cadena donde definimos los caracteres permitidos , en este caso letras del abecedario español y espacios.

$nombre = $_GET[ 'name' ]; 
//variable que recoge la cadena introducida por el usuario 

$coincide = preg_match($permitidos,$nombre); 
//variable que comprueba si la variable $nombre contiene los caracteres contenidos en la variable $permitidos. Si coincide , el output es uno.

$saneado = filter_var($nombre, FILTER_SANITIZE_STRING);
//variable que elimina etiquetas en el nombre introducido, por ejemplo <script> , <html> , etc.

if( array_key_exists( "name", $_GET ) && $nombre == NULL){  
	//si el campo está vacío, devuelve el siguiente mensaje:
	
	$html .= '<p class="alert alert-warning">El campo no puede estar vacío.'; 
		
	}
else{
	if ($coincide == 1) {  
	//si los caracteres de la cadena introducida estan dentro de los caracteres permitidos, sanea la entrada (le quita etiquetas) y nos saluda
	
            $html .= '<p class="alert alert-success">Hola ' . $saneado.'. Bienvenido!';}
            
        else {
        //si no están permitidos, nos avisa
            
            $html .= '<p class="alert alert-danger">Solo puedes introducir letras. El nombre  ' . $saneado. ' no es válido. Inténtalo de nuevo!';     
      
   	      }
    } 
?>
