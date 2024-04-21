<?php
add_shortcode('cryptonews_list', 'cryptonews_list_func');
function cryptonews_list_func() {

    ob_start();
    ?>

    123123

    <?php
    return ob_get_clean();

}