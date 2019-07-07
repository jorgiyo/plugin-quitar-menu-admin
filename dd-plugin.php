<?php
/*
Plugin Name: DD Plugin
Plugin URI: peonnegro.com
Description: Plugin de WPcommerce Fácil
Version: 4.1.1
Author: Fernando Portomeñe y jorgiyo
GitHub Plugin URI: https://github.com/jorgiyo/plugin-quitar-menu-admin
*/

function ece_remove_menus(){

remove_menu_page( 'index.php' ); //Dashboard
remove_menu_page( 'wpcf7' ); //Contact Form 7
remove_menu_page( 'edit.php' ); //Posts
remove_menu_page( 'upload.php' ); //Media
remove_menu_page( 'edit.php?post_type=page' ); //Pages
remove_menu_page( 'edit-comments.php' ); //Comments
remove_menu_page( 'themes.php' ); //Appearance
remove_menu_page( 'plugins.php' ); //Plugins
remove_menu_page( 'users.php' ); //Users
remove_menu_page( 'tools.php' ); //Tools
remove_menu_page( 'options-general.php' ); //Settings
}
//Quitar menú Elementor
function ece_my_remove_menu_pages() {
remove_menu_page( 'edit.php?post_type=elementor_library' );
remove_menu_page( 'elementor' );

}
//Quitar submenus
function ece_quitar_submenus(){
global $wp_admin_bar;
$wp_admin_bar->remove_menu('wp-logo');
$wp_admin_bar->remove_menu('comments');
$wp_admin_bar->remove_menu('new-page');
$wp_admin_bar->remove_menu('new-media');
$wp_admin_bar->remove_menu('new-post');
$wp_admin_bar->remove_node('new-elementor_library'); //si inspeccionamos el elemento vemos wp-admin-bar-new-elementor_library pero el ID es new-elementor_library
}

function esperar_usuario_carga (){
global $user_ID;
if (current_user_can('editor')) {
add_action( 'admin_menu', 'ece_remove_menus' );
add_action( 'admin_init', 'ece_my_remove_menu_pages' );
add_action( 'wp_before_admin_bar_render', 'ece_quitar_submenus' );
}
}
add_action( 'wp_loaded', 'esperar_usuario_carga' );

//Quitar el menú opciones de pantalla para todos menos el admin
function ece_wpb_remove_screen_options() {
if(!current_user_can('manage_options')) {
return false;
}
return true;
}

add_filter('screen_options_show_screen', 'ece_wpb_remove_screen_options');
