<?php
/**
 * drush script for updateting zeore vote values
 **/ 

$years = array('2010', '2012');
foreach ($years as $year) {
	$row = 1;
	if (($handle = fopen("tool/import/" . $year .  "-volby.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 0, "\t")) !== FALSE) {
			$row++;
			$votes_csv = $data[5];
			$votes_csv_int = (int)str_replace(' ', '', $votes_csv);
			if ($votes_csv_int==0) continue;
			//if (strpos($data[5], ' ')!==FALSE && strpos($data[2], 'MKP')!==FALSE) {
			if (strpos($data[5], ' ')!==FALSE) {

				/* get party tid */
				$party = $data[2];
				$party_nid = NULL;
				$nodeQuery = new EntityFieldQuery();
				$nodeQuery->entityCondition('entity_type', 'node')
					->entityCondition('bundle', 'political_party')
					->propertyCondition('title', $party)
					->pager(1);
				$result = $nodeQuery->execute();
				if ($result) {
					list($party_nid,$res) = each($result['node']);
				}	
			
				/* get municipality nid */	
				$municipality = $data[3];
				$municipality_nid = NULL;
				$nodeQuery = new EntityFieldQuery();
				$nodeQuery->entityCondition('entity_type', 'node')
					->entityCondition('bundle', 'municipality')
					->propertyCondition('title', $municipality)
					->pager(1);
				$result = $nodeQuery->execute();
				if ($result) {
					list($municipality_nid,$res) = each($result['node']);
				}	
				
				/* get year tid */	
				$year_tid = NULL;
				$nodeQuery = new EntityFieldQuery();
				$nodeQuery->entityCondition('entity_type', 'taxonomy_term')
					->propertyCondition('name', $year)
					->pager(1);
				$result = $nodeQuery->execute();
				if ($result) {
					list($year_tid,$res) = each($result['taxonomy_term']);
				}	
			
				/* get votes node */	
				$nodeQuery = new EntityFieldQuery();
				$nodeQuery->entityCondition('entity_type', 'node')
					->entityCondition('bundle', 'votes')
					->fieldCondition('field_party', 'target_id', $party_nid)
					->fieldCondition('field_municipality', 'target_id', $municipality_nid)
					->fieldCondition('field_year', 'tid', $year_tid)
					->pager(1);
				$result = $nodeQuery->execute();
				//echo "party_nid:$party_nid\tmunicipality_nid:$municipality_nid\tyear_tid:$year_tid\n";
				//var_dump($result);
				if ($result) {
					list($votes_nid,$res) = each($result['node']);
				}
				$votes_node = node_load($votes_nid);

				//var_dump($votes_node->title);
				//var_dump($votes_node->field_votes);
				if ($votes_node->field_votes[LANGUAGE_NONE][0]['value']==0) {
					$votes_node->field_votes[LANGUAGE_NONE][0]['value'] = (string)$votes_csv_int;
					node_save($votes_node);
					echo "NOTICE: " . $votes_node->nid . " updated\n";
					$updated++;
					var_dump($votes_node->field_votes);
						
				} 


			}
		}
		fclose($handle);
	}
}


echo "updated nodes: $updated\n";
