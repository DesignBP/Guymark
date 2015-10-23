<?php 
define('WP_USE_THEMES', false);
require($_SERVER['DOCUMENT_ROOT']  . '/wp-load.php');
wp_mail("philip.jones@designbp.ltd.uk", "Test", "message");
?>