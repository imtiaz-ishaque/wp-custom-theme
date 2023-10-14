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

//register menu
register_nav_menus(array(
    'main_menu' => __('Main Menu'),
    'footer_menu' => __('Footer Menu')
));

// b custom menu
function b_menu($theme_location)
{
    if (($theme_location) && ($locations = get_nav_menu_locations()) && isset($locations[$theme_location])) 
    {
        $menu = get_term($locations[$theme_location], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $menu_list = '';

        if ($theme_location == 'main_menu') {
            $menu_list .= '<ul class="navbar-nav ms-auto mb-2 mb-lg-0">' . "\n";

            $total_menu_items = count($menu_items);
            $c = 0;

            foreach ($menu_items as $menu_item) {
                $c++;
                $classes = implode(' ', $menu_item->classes);

                if ($menu_item->menu_item_parent == 0) {
                    $parent = $menu_item->ID;

                    $menu_array = array();
                    foreach ($menu_items as $submenu) {
                        if ($submenu->menu_item_parent == $parent) {
                            $bool = true;
                            $submenu_classes = implode(' ', $submenu->classes);
                            $menu_array[] = '<li><a class="dropdown-item ' . $submenu_classes . '" href="' . $submenu->url . '">' . $submenu->title . '</a></li>' . "\n";
                        }
                    }

                    if (count($menu_array) > 0) {
                        $menu_list .= '<li class="nav-item dropdown ' . $classes . '">' . "\n";
                        $menu_list .= '<a class="nav-link dropdown-toggle" id="navbarDropdown" href="' . $menu_item->url . '" role="button" data-bs-toggle="dropdown" aria-expanded="false">' . $menu_item->title . '</a>' . "\n";

                        $menu_list .= ' <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">' . "\n";

                        $menu_list .= implode("\n", $menu_array);

                        $menu_list .= '</ul>' . "\n";
                    } else {
                        $menu_list .= '<li class="nav-item ' . $classes . '">' . "\n";
                        $menu_list .= '<a class="nav-link" href="' . $menu_item->url . '">' . $menu_item->title . '</a>' . "\n";
                    }

                    // end <li>
                    $menu_list .= '</li>' . "\n";
                }
            }

            $menu_list .= '</ul>' . "\n";
        } else if ($theme_location == 'footer_menu') {
            $total_menu_items = count($menu_items);
            $c = 0;
            foreach ($menu_items as $key => $menu_item) {
                $c++;
                $classes = implode(' ', $menu_item->classes);
                $title = $menu_item->title;
                $url = $menu_item->url;

                if ($c < $total_menu_items) {
                    $menu_list .= '<a class="link-light small" href="' . $url . '">' . $title . '</a> <span class="text-white mx-1">&middot;</span> ';
                } else {
                    $menu_list .= '<a class="link-light small" href="' . $url . '">' . $title . '</a>';
                }
            }
        }
    } else {
        $menu_list = '<!-- no menu defined in location "' . $theme_location . '" -->';
    }

    echo $menu_list;
}

