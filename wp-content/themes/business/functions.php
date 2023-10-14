<?php
add_theme_support("title-tag");

//css
add_action("wp_enqueue_scripts","b_scripts");
function b_scripts(){
    wp_enqueue_style("b-bootstrap-icons", "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css", array(), "1.0");
    wp_enqueue_style("b-styles",get_theme_file_uri("/css/styles.css"),array(), "1.0");
}
