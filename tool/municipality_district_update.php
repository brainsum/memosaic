<?php

$res = db_query("SELECT nid FROM node WHERE type='votes'");


$i = 1;
foreach ($res as $record) {

	$i++;
	echo $i .". vote nid: " .$record->nid . "\n";
	$vote = node_load($record->nid);
//	var_dump($vote);

/*
  ["field_municipality"]=>
  array(1) {
    ["und"]=>
    array(1) {
      [0]=>
      array(1) {
        ["target_id"]=>
        string(4) "5831"
      }
    }
  }
  ["field_district"]=>
  array(1) {
    ["und"]=>
    array(1) {
      [0]=>
      array(1) {
        ["target_id"]=>
        string(4) "5830"
      }
    }
  }


*/
	$municipality_id = $vote->field_municipality['und'][0]['target_id'];
	$district_id = $vote->field_district['und'][0]['target_id'];
	
//		echo "$municipality_id / $district_id\n";
	if ($municipality_id && $district_id) {
		$municipality = node_load($municipality_id);
		//var_dump($municipality);
		echo $municipality->field_district['und'][0]['target_id'] . " =? " . $district_id . "\n";
		//if ($municipality->field_district['und'][0]['target_id'] != $district_id) {
		if ($municipality->field_district == array())  {
//$municipality->field_district != $vote->field_district) {
			$municipality->field_district = $vote->field_district;
			//var_dump($municipality->field_district);
			echo "Saving municipality... \t";
			node_save($municipality);
			echo $municipality->nid . " saved - probably...\n";
			//var_dump($municipality->field_district);
		}
		unset($municipality);
	}
	unset($vote);
}


