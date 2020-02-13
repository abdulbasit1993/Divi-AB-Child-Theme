<?php
/*-------------------------------------------------------
 * Divi AB Child Theme Functions.php
------------------ ADD YOUR PHP HERE ------------------*/

function divichild_enqueue_scripts()
{
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}
add_action('wp_enqueue_scripts', 'divichild_enqueue_scripts');
