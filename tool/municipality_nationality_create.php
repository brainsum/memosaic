<?php

$res = db_query("SELECT nid FROM node WHERE type='obce_narodnost'");

$natio = array(

	'field_slovenska'=>123936,
	'field_madarska'=>123937,
	'field_romska'=>123938,
	'field_rusinska'=>123939,
	'field_ukrajinska'=>123940,
	'field_ceska'=>123941,
	'field_nemecka'=>123942,
	'field_polska'=>123943,
	'field_chorvatska'=>123944,
	'field_srbska'=>123945,
	'field_ruska'=>123946,
	'field_zidovska'=>123947,
	'field_moravska'=>123948,
	'field_bulharska'=>123949,
	'field_ostatne'=>123950,
	'field_nezistena'=>123951,

);

foreach($natio as $fnat=>$nid) {
	$resn = db_query("SELECT title FROM node WHERE nid=:nid", array('nid'=>$nid));
	foreach($resn as $recordn) {
		$natio_name[$fnat] = $recordn->title;
	}
}

foreach ($res as $record) {

	$source = node_load($record->nid);
	echo $record->nid . "\t" . $source->title . "\n";
//	var_dump($source);
	
	$resm = db_query("SELECT nid FROM node WHERE type='municipality' and title=:title", array('title'=>$source->title));
	foreach ($resm as $recordm) {
		$city = node_load($recordm->nid);
		break;
	}
	if (is_object($city)) {

		$spolu = $source->field_spolu['und'][0]['value'];
		echo "NOTICE: FOUND " . $source->title . "\t" . $city->nid . "\t" . $spolu . "\n";

		foreach ($natio as $nat=>$nat_nid) {
			if (!isset($source->{$nat})) {
				die("Fatal");
			}
			$number_of_people = $source->{$nat}['und'][0]['value'];


			$node = new stdClass();
			$node->type = 'nationality_municipality';
			$node->uid = '1';
			node_object_prepare($node);
			$node->title = $source->title . " - " . $natio_name[$nat];
			$node->language = LANGUAGE_NONE;

			$node->field_nationality[$node->language][0]['target_id'] = (string)$natio[$nat];
			$node->field_municipality[$node->language][0]['target_id'] = $city->nid;
			$node->field_number_of_people[$node->language][0]['value'] = $number_of_people;
			//$node->field_share[$node->language][0]['value'] = str_replace('.', ',', round($number_of_people * 100 / $spolu, 2));
			$node->field_share[$node->language][0]['value'] = round($number_of_people * 100 / $spolu, 2);
				

			var_dump($node);
			node_save($node);
			echo "created node: " . $node->nid . "\t" . $nat . '=' . $number_of_people . "\n";
			unset($node);
		}
	//	if ($record->field_geo_wkt != $rec2->field_geo_wkt) {
	}else{
		echo "WARNING municipality not found for: " . $source->title . "\n";
	}
	unset($city);
	unset($source);

}

