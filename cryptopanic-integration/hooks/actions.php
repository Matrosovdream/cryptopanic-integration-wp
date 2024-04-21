<?php
add_filter('post_type_link', function ($post_link, $post, $leavename, $sample) {
    if ($post->post_type == 'crypto_news') {
    
        $post_link = get_post_meta( $post->ID, 'url', true );

    }
    return $post_link;
  }, 999, 4);
