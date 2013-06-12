<?php
/**
 *	Autocomplete Facebook Style Plugin
 *	@package autocomplete facebook style
 *	@initial author Liran Tal <liran.tal@gmail.com>
 *	@modified by Julien Crestin <julien.crestin@gmail.com>
 *	@license GNU General Public License (GPL) version 2
 *	@copyright (c) Liran Tal of Enginx 2009
 *	@link http://www.enginx.com
 **/

$entities = $vars['entities'];
	
$str = "[";
foreach($entities as $entityObj) {
	$entityName = $entityObj->name;
	$entityGUID = $entityObj->guid;
	
	//clean up entity name
	$entityName = str_replace("'","\'", $entityName);
	$entityName = str_replace("\"","\'", $entityName);
	$entityName = str_replace("\r\n"," ", $entityName);

	$str .= '{"key":"'.$entityGUID.'","value":"'.$entityName.'"},';
}

$str = substr($str, 0, -1);
$str .= "]";
echo $str;


?>