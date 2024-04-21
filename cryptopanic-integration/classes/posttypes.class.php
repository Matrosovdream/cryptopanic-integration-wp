<?php
class Crypto_posttypes {

    public function __construct() {

        add_action( 'init', array($this, 'crypto_register_posttypes') );

    }

    public function crypto_register_posttypes() {

        /**
         * Post Type: Crypto News.
         */

        $labels = [
            "name" => esc_html__( "Crypto News", "newspaper" ),
            "singular_name" => esc_html__( "Crypto News", "newspaper" ),
        ];

        $args = [
            "label" => esc_html__( "Crypto News", "newspaper" ),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "rest_namespace" => "wp/v2",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "can_export" => false,
            "rewrite" => [ "slug" => "crypto_news", "with_front" => true ],
            "query_var" => true,
            "supports" => [ "title", "editor", "thumbnail" ],
            "show_in_graphql" => false,
        ];

        register_post_type( "crypto_news", $args );
    }

}

new Crypto_posttypes;
