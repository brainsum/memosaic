<?php

$res = db_query("SELECT n.nid, n.title, f.field_geo_wkt FROM node n, field_data_field_geo f WHERE f.entity_id=n.nid AND type='obce_narodnost'");


foreach ($res as $record) {

	echo $record->nid . "\n";
	$res2 = db_query("SELECT * FROM node n, field_data_field_geo f WHERE f.entity_id=n.nid AND title = :title AND type='municipality' ", array('title'=>$record->title));
	foreach($res2 as $rec2) {
		if ($record->field_geo_wkt != $rec2->field_geo_wkt) {
			$n1 = node_load($record->nid);
			$n2 = node_load($rec2->nid);
			$n2->field_geo = $n1->field_geo;
			node_save($n2);
			echo $rec2->nid . " updated\n";
		}else{
			echo "WKT same, OK\n";
		}
	}

}

