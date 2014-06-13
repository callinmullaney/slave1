<?php
/**
 * @file
 * page_content.features.inc
 */

/**
 * Implements hook_ctools_plugin_api().
 */
function page_content_ctools_plugin_api($module = NULL, $api = NULL) {
  if ($module == "field_group" && $api == "field_group") {
    return array("version" => "1");
  }
  if ($module == "strongarm" && $api == "strongarm") {
    return array("version" => "1");
  }
}

/**
 * Implements hook_views_api().
 */
function page_content_views_api($module = NULL, $api = NULL) {
  return array("api" => "3.0");
}

/**
 * Implements hook_eck_bundle_info().
 */
function page_content_eck_bundle_info() {
  $items = array(
  'sidebar_content_static_content' => array(
  'machine_name' => 'sidebar_content_static_content',
  'entity_type' => 'sidebar_content',
  'name' => 'static_content',
  'label' => 'Static Content',
),
  );
  return $items;
}

/**
 * Implements hook_eck_entity_type_info().
 */
function page_content_eck_entity_type_info() {
$items = array(
       'sidebar_content' => array(
  'name' => 'sidebar_content',
  'label' => 'Sidebar Content',
  'properties' => array(
    'title' => array(
      'label' => 'Title',
      'type' => 'text',
      'behavior' => 'title',
    ),
    'created' => array(
      'label' => 'Created',
      'type' => 'integer',
      'behavior' => 'created',
    ),
  ),
),
  );
  return $items;
}

/**
 * Implements hook_node_info().
 */
function page_content_node_info() {
  $items = array(
    'page' => array(
      'name' => t('Page'),
      'base' => 'node_content',
      'description' => t('Use <em>basic pages</em> for your static content, such as an \'About us\' page.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
