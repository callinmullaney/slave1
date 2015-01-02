<?php 

function mse6_js_alter(&$javascript) {
  // Swap out jQuery to use an updated version of the library.
  $javascript['misc/jquery.js']['data'] = 'http://code.jquery.com/jquery-1.8.3.min.js';
}