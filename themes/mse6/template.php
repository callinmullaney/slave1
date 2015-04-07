<?php 

function mse6_js_alter(&$javascript) {
  // Swap out jQuery to use an updated version of the library.
  $javascript['misc/jquery.js']['data'] = 'http://code.jquery.com/jquery-1.8.3.min.js';
}

function mse6_form_element($variables) {
  $element = $variables['element'];
  $value = $variables['element']['#children'];

  $wrapper_classes = array(
    'form-item',
  );
  $output = '<div class="' . implode(' ', $wrapper_classes) . '" id="' . $element['#id'] . '-wrapper">' . "\n";
  $required = !empty($element['#required']) ? '<span class="form-required" title="' . t('This field is required.') . '">*</span>' : '';

  $output .= $value . "\n";

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    $output .= ' <label for="' . $element['#id'] . '"><span class="labelwrap">' . t('!title: !required', array('!title' => filter_xss_admin($title), '!required' => $required)) . "</span></label>\n";
  }

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">' . $element['#description'] . "</div>\n";
  }

  $output .= "</div>\n";

  return $output;
}