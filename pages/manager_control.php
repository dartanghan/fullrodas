<?php
/*
 * Created on 31/01/2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
	include './dbConnection.php';

	/**
	 * Obtém a lista de todas as companhias cadastradas
	 * independente de seu tipo.
	 */
	function getCompanies(){
		fullRodasConnect();
		$companies = '{ companies : [';
		$result = mysql_query("SELECT * FROM FR_COMPANY");
		$rows=mysql_num_rows($result);
		$i = 0;
		while( $i < $rows ){
			$companies .= '{'.
				' company_code:\''.mysql_result($result,$i,'company_code').'\','. //id
				' company_name:\''.mysql_result($result,$i,'company_name').'\','. //nome
				' company_image_url:\''.mysql_result($result,$i,'company_image_url').'\','. //url para imagem
				' company_type:\''.mysql_result($result,$i,'company_type').'\''. //type
			'}';
			if( $i < $rows-1 )
				$companies.=',';
			$i = $i+1;
		}
		$companies .= '] }'; // fim do objeto JSON
		fullRodasDisconnect();
		return $companies;
	}

	/**
	 * Traz os objetos de uma companhia.
	 *
	 * Se usar este método, certifique-se de que
	 * o atributo company_code esteja na request.
	 */
	function getCompanyObjects(){
		$objects = '{ companyObjects : [';
		$i = 0;

		fullRodasConnect();
		$result = mysql_query("SELECT * FROM FR_OBJECT");
		$rows=mysql_num_rows($result);
		while( $i < $rows ){
			$objects .= '{'.
				' object_code:\''.mysql_result($result,$i,'object_code').'\','. //id
				' object_name:\''.mysql_result($result,$i,'object_name').'\','. //nome
				' object_image_url:\''.mysql_result($result,$i,'object_image_url').'\','. //url para imagem
				' object_description:\''.mysql_result($result,$i,'object_description').'\','. //description
				' company_code:\''.mysql_result($result,$i,'company_code').'\''. //company
			'}';
			if( $i < $rows-1 )
				$objects .=',';
			$i = $i+1;
		}
		fullRodasDisconnect();

		$objects .= '] }'; // fim do objeto JSON
		return $objects;
	}

	function saveCompanyObject(){
		$object_code = $_REQUEST['object_code'];
		$object_description = $_REQUEST['object_description'];
		$object_name = $_REQUEST['object_name'];
		$object_image_url = $_REQUEST['object_image_url'];
		$company_code = $_REQUEST['company_code'];

		fullRodasConnect();
		echo "conectado...";
		if( $object_code == null || $object_code == "---" ){
			$query = "INSERT INTO FR_OBJECT (object_name, object_image_url, object_description, company_code ) VALUES ('".$object_name."','".$object_image_url."','".$object_description."',".$company_code.")";
		}else{
			$query = "UPDATE FR_OBJECT SET object_name='".$object_name."', object_image_url='".$object_image_url."', object_description='".$object_description."',company_code=".$company_code." WHERE object_code = ".$object_code;
		}
		//echo $query;
		$result = mysql_query( $query );

		fullRodasDisconnect();
		return $result;
	}

	function saveCompany(){
		$company_code = $_REQUEST['company_code'];
		$company_type = $_REQUEST['company_type'];
		$company_name = $_REQUEST['company_name'];
		$company_image_url = $_REQUEST['company_image_url'];

		fullRodasConnect();
		if( $company_code == null || $company_code == "---" ){
			echo "insert";
			$result = mysql_query("INSERT INTO FR_COMPANY (company_name, company_type, company_image_url ) VALUES ('".$company_name."','".$company_type."','".$company_image_url."')");
		}else{
			echo "update";
			$result = mysql_query("UPDATE FR_COMPANY SET company_name='".$company_name."', company_image_url='".$company_image_url."', company_type='".$company_type."', company_name='".$company_name."' WHERE company_code = ".$company_code);
		}
		fullRodasDisconnect();
		return $result;
	}




	$metodo = $_REQUEST['metodo'];
	$caller ="echo ".$metodo."();";
	eval($caller);

?>

