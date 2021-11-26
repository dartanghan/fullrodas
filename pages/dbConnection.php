<?php
/*
 * Created on 12/01/2009
 * Aqui criamos a conexão com o banco de dados.
 * Também fechamos aqui ;)
 */

/**
 * use este método para conectar no banco...
 */
function fullRodasConnect(){
	// definição de conexão
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
