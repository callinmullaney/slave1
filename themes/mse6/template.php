<?php

/**
 * @file
 * This file contains the main theme functions hooks and overrides.
 */

/**
 * Override or insert variables into the maintenance page template.
 */
function mse6_preprocess_maintenance_page(&$vars) {
  // While markup for normal pages is split into page.tpl.php and html.tpl.php,
  // the markup for the maintenance page is all in the single
  // maintenance-page.tpl.php template. So, to have what's done in
  // mse6_preprocess_html() also happen on the maintenance page, it has to be
  // called here.
  mse6_preprocess_html($vars);
}

/**
 * Override or insert variables into the html template.
 */
function mse6_preprocess_html(&$vars) {

  // Get mse6 folder path.
  $mse6_path = drupal_get_path('theme', 'mse6');

  // Add conditional CSS for IE8 and below.
  drupal_add_css($mse6_path . '/css/style.css', array('group' => CSS_THEME, 'weight' => 999, 'preprocess' => FALSE));

  // Fix the viewport and zooming in mobile devices.
  $viewport = array(
   '#tag' => 'meta',
   '#attributes' => array(
     'name' => 'viewport',
     'content' => 'width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no, initial-scale=1',
   ),
  );
  drupal_add_html_head($viewport, 'viewport');

}