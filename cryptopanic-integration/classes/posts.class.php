<?php
class Crypto_posts {

    private $api;
    private $post_type;

    public function __construct() {

        $this->api = new Crypto_API();

        $this->post_type = 'crypto_news';

    }

    public function update_posts() {

        // Remove all
        $this->remove_all_posts();

        // Insert the new ones
        $news = $this->api->collect_news( $pages=2 );

        foreach( $news as $post ) {
            $this->insert_post( $post );
        }

        echo "<pre>";
        print_r($news);
        echo "</pre>";

    }

    private function insert_post( $data ) {

        // Step 1: Parse the input date/time string
        $datetime = new DateTime($data['published_at'], new DateTimeZone('UTC'));

        // Step 2: Format the date/time for WordPress
        $wp_post_date = $datetime->format('Y-m-d H:i:s');

        $post = array(
            'post_title'    => wp_strip_all_tags( $data['title'] ),
            //'post_content'  => $data['metadata']['description'],
            'post_content'  => '',
            'post_status'   => 'publish',
            'post_date' => $wp_post_date,
            'post_author'   => 1,
            'post_type' => $this->post_type
        );
        $post_id = wp_insert_post( $post );

        // Meta data
        update_post_meta( $post_id, 'url', $data['url'] );
        update_post_meta( $post_id, 'news_id', $data['id'] );

    }

    private function remove_all_posts() {

        $allposts = get_posts( array( 'post_type'=> $this->post_type, 'numberposts'=> -1 ) );
        foreach ($allposts as $eachpost) {
            wp_delete_post( $eachpost->ID, true );
        }

    }

}