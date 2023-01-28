<?php

use LDAP\Result;

function wp_setter($atts, $content = null)
{
    ob_start();
    include WF_sl_tpl . "front/s.php";
    return ob_get_clean();

}

add_shortcode('sliderNew', 'wp_setter');

function wp_setterr($atts, $content = null)
{
    ob_start();
    include WF_sl_tpl . "front/newsInformation.php";
    return ob_get_clean();
}
$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$custom_page = "https://example.com/custom_page/";
if($link == $custom_page) {
    ob_start();
    include WF_sl_tpl . "front/newsInformation.php";
    return ob_get_clean();
}
add_shortcode('newsInfo', 'wp_setterr');
