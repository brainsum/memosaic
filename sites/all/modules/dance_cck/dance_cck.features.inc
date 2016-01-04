<?php
/**
 * @file
 * dance_cck.features.inc
 */

/**
 * Implements hook_node_info().
 */
function dance_cck_node_info() {
  $items = array(
    'dance' => array(
      'name' => t('dance'),
      'base' => 'node_content',
      'description' => '',
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
