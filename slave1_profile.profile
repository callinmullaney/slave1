<?php

/**
 * Implements hook_install_tasks()
 */
function slave1_install_tasks(&$install_state) {

  // Add our custom CSS file for the installation process
  drupal_add_css(drupal_get_path('profile', 'slave1') . '/slave1.css');

}


/**
 * Implements hook_form_FORM_ID_alter().
 *
 * Allows the profile to alter the site configuration form.
 */
function slave1_profile_form_install_configure_form_alter(&$form, $form_state) {
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