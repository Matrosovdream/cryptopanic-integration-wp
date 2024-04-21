<?php
class Crypto_cron {

    public function __construct() {

        // For better performance
        $this->set_server_settings();

        add_action('init', array($this, 'crypto_init_cron') );

        // Time intervals
        add_filter('cron_schedules', array($this, 'add_custom_intervals'));

        // Schedule/add events
        $this->schedule_events();
        $this->add_events();

    }

    public function schedule_events() {

        // Schedule Cron Job Event
        if (!wp_next_scheduled('update_crypto_news_event')) {
            wp_schedule_event(time(), 'every_10_minutes', 'update_crypto_news_event');
        }

    }

    public function add_events() {

        add_action('update_crypto_news_event', array($this, 'update_crypto_news_cron'));
        
    }

    public function update_crypto_news_cron() {
    
        $posts_up = new Crypto_posts;
        $posts_up->update_posts( $pages=2 );

    }

    private function set_server_settings() {

        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '1024M');

    }

    public function crypto_init_cron() {

        if( isset($_GET['crypto-news-update']) ) {

            $posts_up = new Crypto_posts;
            $posts_up->update_posts( $pages=2 );

            die();
    
        }

    }

    public function add_custom_intervals($schedules) {

        // For updates
        $schedules['every_10_minutes'] = array(
            'interval' => 60 * 10, // 60 seconds, one minute
            'display'  => __('Every 10 Minutes'),
        );

        return $schedules;
    }

    public function log($text) {

        $new_str = $text;
        $filename = $_SERVER['DOCUMENT_ROOT'].'/wp-content/plugins/cryptopanic-integration/log.txt';
        
        file_put_contents($filename, PHP_EOL . $new_str, FILE_APPEND);

    }

}

new Crypto_cron();







