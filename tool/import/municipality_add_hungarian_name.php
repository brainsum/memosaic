<?php
/**
 * drush script 
 **/

if (($handle = fopen("tool/import/hungarians-by-municipality-sk-hu.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $num = count($data);
        $row++;
    	$sk_name = $data[1];
    	$hu_name = $data[0];
	if ($hu_name!='' && $sk_name!='') {
		echo $hu_name . "\t" . $sk_name . "\n";
		$res = db_query("SELECT nid FROM node WHERE title=:title AND type='municipality'", array('title'=>$sk_name));
		foreach ($res as $row) {
			$node = node_load($row->nid); //var_dump($node);
			if ($node->field_hungarian_name['und'][0]['value'] == '') {
				$node->field_hungarian_name['und'][0]['value'] = $hu_name;
				try {
					node_save($node);			
				} catch (Exception $e) {
					var_dump( $e );
					throw $e;
					exit;
				}
				echo $node->nid . " saved\n";
				$saved++;
			}
			unset($node);
			//echo $row->nid . "\t" . $node->field_hungarian_name['und'][0]['value'] . "\n";
			//var_dump($node->field_hungarian_name['und'][0]['value']);
		}
	}

    }
    fclose($handle);
}

echo "saved: $saved\n";
