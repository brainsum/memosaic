<?php

$result = db_query("SELECT entity_id FROM `field_data_field_obec` WHERE `field_obec_value` LIKE 'Slovakia,%%' AND entity_type='node'");

foreach ($result as $record) {

	echo $record->entity_id . "\n"; 

	node_delete($record->entity_id);	
}
