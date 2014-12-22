<?php

/**
 * Force-set a theme at any point during the execution of the request.
 *
 * Drupal doesn't give us the option to set the theme during the installation
 * process and forces enable the maintenance theme too early in the request
 * for us to modify it in a clean way.
 */
function _slave1_set_theme($target_theme) {
  if ($GLOBALS['theme'] != $target_theme) {
    unset($GLOBALS['theme']);

    drupal_static_reset();
    $GLOBALS['conf']['maintenance_theme'] = $target_theme;
    _drupal_maintenance_theme();
  }
}

/**
 * Let's set the default language to english so we can skip step 2.
 */
function slave1_locale_selection(&$install_state){
    $install_state['parameters']['locale'] = 'en';
}

/**
 * Implements hook_install_tasks_alter().
 */
function slave1_install_tasks_alter(&$tasks, $install_state) {
  _slave1_set_theme('mse6');
  $tasks['install_select_locale']['function'] = 'slave1_locale_selection';
}

/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Allows the profile to alter the site configuration form.
 */
function slave1_form_install_configure_form_alter(&$form, $form_state) {
  // Pre-populate the site name with the server name.
  $form['site_information']['site_name']['#default_value'] = $_SERVER['SERVER_NAME'];
  $form['site_information']['site_mail']['#default_value'] = "no-reply@clientemail.com";
  // Account information defaults
  $form['admin_account']['account']['name']['#default_value'] = 'augustash';
  $form['admin_account']['account']['mail']['#default_value'] = 'drupal@augustash.com';
  // Pre-populate the country name with the United States.
  $form['server_settings']['site_default_country']['#default_value'] = 'US';
  $form['server_settings']['date_default_timezone']['#default_value'] = 'America/Chicago';
  // Unset the timezone detect stuff
  unset($form['server_settings']['date_default_timezone']['#attributes']['class']);

  // Only check for updates, no need for email notifications
  $form['update_notifications']['update_status_module']['#default_value'] = array(1);
  
}