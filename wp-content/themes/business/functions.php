<?php
add_theme_support("title-tag");

//css and javascript libraries
add_action("wp_enqueue_scripts", "b_scripts");
function b_scripts()
{
    //css
    wp_enqueue_style("b-bootstrap-icons", "https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css", array(), "1.0");
    wp_enqueue_style("b-styles", get_theme_file_uri("/css/styles.css"), array('b-bootstrap-icons'), "1.0");

    //js
    wp_enqueue_script("b-bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js", array(), "1.0", true);

    wp_enqueue_script("b-scripts", get_theme_file_uri("/js/scripts.js"), array("b-bootstrap"), "1.0", true);
}
