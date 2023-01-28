<?php

function wp_sideBar_load_assets()
{

    wp_register_style('wp_sideBarCss_style', WF_sl_URL . 'assets/css/css.css?v=version154.8');
    wp_enqueue_style('wp_sideBarCss_style');
    wp_register_script('wp_sideBarCss_script', WF_sl_URL . 'assets/js/jsInfo.js?v=version140.6',['jquery']);
    wp_enqueue_script('wp_sideBarCss_script');

}


add_action('wp_enqueue_scripts', 'wp_sideBar_load_assets');
