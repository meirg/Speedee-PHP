<?php

namespace SpeeDee;

function GetFileContents($rel_name){
	return file_get_contents(dirname(__FILE__).'/'.$rel_name);
}

function _GetZoneTable($origin_zip){
	$csv = explode(PHP_EOL, GetFileContents('ZoneTables.CSV'));
	array_shift($csv); // Skip Headers
	while(!is_null($r = array_shift($csv))) {
		$r = str_getcsv($r);
		if($origin_zip >= $r[1] && $origin_zip <= $r[2])
			return $r[3];
	}
	return false;
}

function _GetZoneFromTable($table, $dest_zip){
	$csv = explode(PHP_EOL, GetFileContents('zones/SP'.(int)substr($table, 2).'.CSV'));
	array_shift($csv); // Skip Headers
	while(!is_null($r = array_shift($csv))) {
		$r = str_getcsv($r);
		if($dest_zip >= $r[1] && $dest_zip <= $r[2])
			return $r[3];
	}
	return false;
}

function _GetRate($zone, $weight){
	$csv = explode(PHP_EOL, GetFileContents('RatesOnly.csv'));
	$weight = ceil($weight);
	foreach($csv as $max_weight => $zones){
		if($weight <= $max_weight + 1){
			$zones = str_getcsv($zones);
			if(isset($zones[$zone - 2]))
				return (float)$zones[$zone - 2];
		}
	}
	return false;
}

function CalcRate($origin_zip, $dest_zip, $weight){
	if(!($table = _GetZoneTable($origin_zip)))
		return false;
	if(!($zone = _GetZoneFromTable($table, $dest_zip)))
		return false;
	return _GetRate($zone, $weight);
}
