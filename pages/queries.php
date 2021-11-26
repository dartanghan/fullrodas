<?php
/*
 * Created on 31/01/2009
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

	function getCompaniesByType( $type ){
		fullRodasConnect();
		$companies = array();
		$result = mysql_query("SELECT * FROM FR_COMPANY WHERE COMPANY_TYPE = ".$type);
		$rows=mysql_num_rows($result);
		$i = 0;
		while( $i < $rows ){
			$companies[$i] = array(
				0 => mysql_result($result,$i,'company_code'), //id
				1 => mysql_result($result,$i,'company_name'), //nome
				2 => mysql_result($result,$i,'company_image_url'), //url para imagem
				3 => mysql_result($result,$i,'company_type') //type
			);
			$i = $i+1;
		}
		fullRodasDisconnect();
		return $companies;
	}

	/**
	 * Busca todas as rodas de uma companhia.
	 */
	function getWheelsByCompany( $company ){
		fullRodasConnect();
		$list = array();
		$result = mysql_query("SELECT * FROM FR_OBJECT WHERE object_active = 1 AND company_code = ".$company);
		$rows=mysql_num_rows($result);
		$i = 0;
		while( $i < $rows ){
			$list[$i] = array(
				0 => mysql_result($result,$i,'object_code'), //id
				1 => mysql_result($result,$i,'object_name'), //nome
				2 => mysql_result($result,$i,'object_image_url'), //url para imagem
				3 => mysql_result($result,$i,'object_description') //type
			);
			$i = $i+1;
		}
		fullRodasDisconnect();
		return $list;
	}
	/**
	 * Busca todas os carros de uma companhia.
	 */
	function getCarsByCompany( $company ){
		fullRodasConnect();
		$list = array();
		$result = mysql_query("" .
				"SELECT * " .
				"  FROM FR_OBJECT obj " .
				"  JOIN FR_CAR_SPECS spc ON ( spc.object_code = obj.object_code )" .
				" WHERE obj.object_active = 1 " .
				"   AND obj.company_code = ".$company);
		$rows=mysql_num_rows($result);
		$i = 0;
		while( $i < $rows ){
			$list[$i] = array(
				0 => mysql_result($result,$i,'object_code'), //id
				1 => mysql_result($result,$i,'object_name'), //nome
				2 => mysql_result($result,$i,'object_image_url'), //url para imagem
				3 => mysql_result($result,$i,'object_description'), //type
				4 => mysql_result($result,$i,'position_hor_wheel1'), //id
				5 => mysql_result($result,$i,'position_hor_wheel2'), //nome
				6 => mysql_result($result,$i,'position_vert_wheels') //id

			);
			$i = $i+1;
		}
		fullRodasDisconnect();
		return $list;
	}
?>

