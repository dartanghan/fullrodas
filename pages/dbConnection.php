<?php
/*
 * Created on 12/01/2009
 * Aqui criamos a conex�o com o banco de dados.
 * Tamb�m fechamos aqui ;)
 */

/**
 * use este m�todo para conectar no banco...
 */
function fullRodasConnect(){
	// defini��o de conex�o
	$dbhost = '65.75.245.109';
	$dbuser = 'fullrodas';
	$dbpass = 'full';
	// conectando
	$conn = mysql_connect($dbhost, $dbuser, $dbpass);
	$dbname = 'fullrodas';
	mysql_select_db($dbname);
}

/**
 * Desconecta da base de dados.
 */
function fullRodasDisconnect(){
	mysql_close();
}

?>
