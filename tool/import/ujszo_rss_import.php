<?php

$found = 0;

if (($handle = fopen("tool/import/hely-ek.csv", "r")) !== FALSE) {
	while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
		$res = db_query("SELECT entity_id FROM  field_data_field_hungarian_name WHERE bundle='municipality' AND entity_type='node' AND  field_hungarian_name_value = :title LIMIT 1", array('title'=>$data[1]));
		foreach ($res as $record) {
			echo $data[1] . "\n";
			echo $record->entity_id . "\n";
			$found++;
			$node = node_load($record->entity_id);
			if (is_object($node)) {
				$node->field_rss['und'][0]['url'] = 'http://ujszo.com/taxonomy/term/' . $data[0] . '/all/feed';
				node_save($node);
			}
		}
	}
}

echo "found:$found\n";

