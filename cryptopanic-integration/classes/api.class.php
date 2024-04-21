<?php
class Crypto_API {

    private $token;
    private $url;

    public function __construct() {

        $this->token = get_option('cryptopanic_api_key');
        $this->url = 'https://cryptopanic.com/api/v1/posts/';

    }

    private function request( $url ) {

        
        $result = wp_remote_get( $url );
        $res = json_decode( $result['body'], true );

        return array(
            "posts" => $res['results'],
            "next" => $res['next']
        );

    }

    public function collect_news( $pages=1 ) {

        $ready_pages = 0;
        $next = '';
        $news = array();

        while( $ready_pages < $pages ) {

            if( $data['next'] ) {
                $url = $data['next'];
            } else {
                $url = $this->url.'?auth_token='.$this->token;
            }

            $data = $this->request($url);

            $news = array_merge( $news, $data['posts'] );

            $ready_pages++;
        }

        return $news;

    }

}