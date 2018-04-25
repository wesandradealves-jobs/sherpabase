<?php

    function remove_menus(){
        remove_menu_page( 'index.php' );                  //Dashboard
        remove_menu_page( 'jetpack' );                    //Jetpack* 
        remove_menu_page( 'edit.php' );                   //Posts
        // remove_menu_page( 'upload.php' );                 //Media
        // remove_menu_page( 'edit.php?post_type=page' );    //Pages
        // remove_menu_page( 'edit-comments.php' );          //Comments
        // remove_menu_page( 'themes.php' );                 //Appearance
        // remove_menu_page( 'plugins.php' );                //Plugins
        // remove_menu_page( 'users.php' );                  //Users
        // remove_menu_page( 'tools.php' );                  //Tools
        // remove_menu_page( 'options-general.php' );        //Settings

    }
    add_action( 'admin_menu', 'remove_menus' );

    function getrid() {
      // remove_post_type_support( 'page', 'editor' );
      remove_post_type_support( 'page', 'thumbnail' );
      remove_post_type_support( 'page', 'page-attributes' );
      remove_post_type_support( 'page', 'comments' );
      remove_post_type_support( 'page', 'author' );
    }
    add_action( 'init', 'getrid' );

    function df_terms_clauses($clauses, $taxonomy, $args) {
        if (!empty($args['post_type'])) {
            global $wpdb;
            $post_types = array();
            foreach($args['post_type'] as $cpt) {
                $post_types[] = "'".$cpt."'";
            }
            if(!empty($post_types)) {
                $clauses['fields'] = 'DISTINCT '.str_replace('tt.*', 'tt.term_taxonomy_id, tt.term_id, tt.taxonomy, tt.description, tt.parent', $clauses['fields']).', COUNT(t.term_id) AS count';
                $clauses['join'] .= ' INNER JOIN '.$wpdb->term_relationships.' AS r ON r.term_taxonomy_id = tt.term_taxonomy_id INNER JOIN '.$wpdb->posts.' AS p ON p.ID = r.object_id';
                $clauses['where'] .= ' AND p.post_type IN ('.implode(',', $post_types).')';
                $clauses['orderby'] = 'GROUP BY t.term_id '.$clauses['orderby'];
            }
        }
        return $clauses;
    }
    add_filter('terms_clauses', 'df_terms_clauses', 10, 3);

    function remove_customizer_settings( $wp_customize ){
      $wp_customize->remove_panel('nav_menus');
      $wp_customize->remove_section('static_front_page');
    }
    add_action( 'customize_register', 'remove_customizer_settings', 20 );

    function get_the_category_bytax( $id = false, $tcat = 'category' ) {
        $categories = get_the_terms( $id, $tcat );
        if ( ! $categories )
            $categories = array();
        $categories = array_values( $categories );
        foreach ( array_keys( $categories ) as $key ) {
            _make_cat_compat( $categories[$key] );
        }
        // Filter name is plural because we return alot of categories (possibly more than #13237) not just one
        return apply_filters( 'get_the_categories', $categories );
    }

    function get_custom_field_data($key, $echo = false) {
        global $post;
        $value = get_post_meta($post->ID, $key, true);
        if($echo == false) {
            return $value;
        } else {
            echo $value;
        }
    }

    function hide_admin_bar() {
        wp_add_inline_style('admin-bar', '<style> html { margin-top: 0 !important; } </style>');
        return false;
    }
    add_filter( 'show_admin_bar', 'hide_admin_bar' );

    function menu() {
      register_nav_menus(
        array(
          'header' => __( 'Header' ),
          'footer' => __( 'Footer' )
        )
      );
    }
    add_action( 'init', 'menu' );

    function query_post_type($query) {
      if(is_category() || is_tag()) {
        $post_type = get_query_var('post_type');
        if($post_type)
            $post_type = $post_type;
        else
            $post_type = array('nav_menu_item','post','articles');
        $query->set('post_type',$post_type);
        return $query;
        }
    }
    add_filter('pre_get_posts', 'query_post_type');

    class description_walker extends Walker_Nav_Menu{
    function start_el(&$output, $item, $depth, $args){
    global $wp_query;
    $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    $class_names = $value = '';
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
    $class_names = ' class="'. esc_attr( $class_names ) . '"';
    $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . '>';
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $prepend = '<strong>';
        $append = '</strong>';
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';
        if($depth != 0)
        {
        $description = $append = $prepend = "";
        }
        $item_output = $args->before;
        $item_output .= '<a'. $attributes . $class_names .'>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        if ($item->menu_order == 1) {
        $classes[] = 'first';
        }
        }
        }


?>