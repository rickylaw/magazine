<?php

//load css and js
function magazine_script_enqueue(){
      //css
      //wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.min.css',array(),'4.1.3','all');
      //wp_enqueue_style('basic',get_template_directory_uri().'/css/basic.css',array(),'1.0.1','all');
      //wp_enqueue_style('magazine',get_template_directory_uri().'/css/magazine.css',array(),'1.1.5','all');
      //wp_enqueue_style('jqueryUI',get_template_directory_uri().'/css/jquery.ui.css',array(),'1.0.0','all');
      //wp_enqueue_style('Basic',get_template_directory_uri().'/css/basic.css',array(),'1.0.0','all');


      //js
      wp_enqueue_script('jquery',get_template_directory_uri().'/js/jquery.js',array(),'1.1.3',true);
      //wp_enqueue_script('jquery');
      //wp_enqueue_script('jquery.min.1.7',get_template_directory_uri().'/js/jquery.min.1.7.js',array(),'1.0.0',true);
      //wp_enqueue_script('modernizr.2.5.3.min',get_template_directory_uri().'/js/modernizr.2.5.3.min.js',array(),'1.0.0',true);
      //wp_enqueue_script('MAIN',get_template_directory_uri().'/js/main.js',array(),'1.0.2',true);
      wp_enqueue_script('turnjs',get_template_directory_uri().'/js/turn.js',array(),'1.0.0',true);
      //wp_enqueue_script('turnHtml4Min',get_template_directory_uri().'/js/turn.html4.min.js',array(),'1.0.0',true);
      //wp_enqueue_script('zoom.min',get_template_directory_uri().'/js/zoom.min.js',array(),'1.0.0',true);
      //wp_enqueue_script('basic',get_template_directory_uri().'/js/basic.js',array(),'1.1.3',true);
      //wp_enqueue_script('magazineJS',get_template_directory_uri().'/js/magazine.js',array(),'1.0.2',true);

}

add_action('wp_enqueue_scripts','magazine_script_enqueue');

function magazine_theme_setup(){

        add_theme_support('menus');

        register_nav_menu('primary','Primay header navigation');
        register_nav_menu('secondary','Footer navigation');

}

add_action('init','magazine_theme_setup');

add_theme_support('custom-background');
add_theme_support('custom-header');

function get_newest_id(){
    return get_site_option('flash_issue_num');
   
  //  return 777;
}

function get_magazine_fold($issue_id = false){
    if ($issue_id == false) $issue_id = get_newest_id();
    
    $theme_root_uri = get_theme_root_uri( );
    
    return $theme_root_uri. '/magazine/flash/asset/images/'.$issue_id;
    
}


include_once (STYLESHEETPATH . '/includes/real3d-flipbook/real3d-flipbook.php');

 ?>
