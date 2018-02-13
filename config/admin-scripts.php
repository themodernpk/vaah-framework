<?php

add_action('admin_enqueue_scripts', 'vaah_scripts');
function vaah_scripts() {


    //admin scripts
    wp_enqueue_script( 'jquery-2', plugin_dir_url( __FILE__ ) . '../assets/common/jquery.js');

    wp_enqueue_script( 'bootstrap-js',  plugin_dir_url( __FILE__ ) . '../assets/common/bootstrap.min.js', array('jquery-2') );

    wp_enqueue_script( 'nprogress-js',  plugin_dir_url( __FILE__ ) . '../assets/common/nprogress.js' );

    wp_enqueue_script( 'vue-js',  plugin_dir_url( __FILE__ ) . '../assets/common/vue.min.js' );
    wp_enqueue_script( 'vue-resource-js',  plugin_dir_url( __FILE__ ) . '../assets/common/vue-resource.min.js' );
    wp_enqueue_script( 'vue-common-js',  plugin_dir_url( __FILE__ ) . '../assets/common/VueCommon.js' );
    wp_enqueue_script( 'vue-pagination-js',  plugin_dir_url( __FILE__ ) . '../assets/common/VuePagination.js' );




    //admin css
    wp_enqueue_style( 'bootstrap-css',  plugin_dir_url( __FILE__ ) . '../assets/common/bootstrap.min.css' );
    wp_enqueue_style( 'vaah-admin-css',  plugin_dir_url( __FILE__ ) . '../assets/common/vaah.admin.css' );
    wp_enqueue_style( 'nprogress-css',  plugin_dir_url( __FILE__ ) . '../assets/common/nprogress.min.css' );

}