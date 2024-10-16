<?php

class Facebook {

    private $app_id;
    private $app_secret;
    private $redirect_uri;

    public function __construct() {
        $this->app_id = '1920078111844189';
        $this->app_secret = '284b8d009a6ab2551baff0344ced7ee3';
        $this->redirect_uri = 'http://localhost/codeigniter3/index.php/user/facebook_login_callback';
        // $this->app_id = '957787049446988';
        // $this->app_secret = '6bf33be60e9fb2ca7cf6bc6ce7cd7b09';
        // $this->redirect_uri = 'http://localhost/codeigniter3/index.php/user/facebook_login_callback';
    }

    public function get_login_url() {
        $login_url = 'https://www.facebook.com/dialog/oauth?';
        $login_url .= 'client_id=' . $this->app_id;
        $login_url .= '&redirect_uri=' . urlencode($this->redirect_uri);
        $login_url .= '&scope=email';
        return $login_url;
    }

    public function get_access_token($code) {
        $token_url = 'https://graph.facebook.com/oauth/access_token?';
        $token_url .= 'client_id=' . $this->app_id;
        $token_url .= '&redirect_uri=' . urlencode($this->redirect_uri);
        $token_url .= '&client_secret=' . $this->app_secret;
        $token_url .= '&code=' . $code;

        // cURL to make the request to Facebook's API and obtain the response.
        $ch = curl_init($token_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
//response and returns the access token.
        $response = json_decode($response, true);
        return $response['access_token'];
    }

    public function get_user_data($access_token) {
        $graph_url = 'https://graph.facebook.com/me?';
        $graph_url .= 'access_token=' . $access_token;

        // Use curl instead of file_get_contents
        $ch = curl_init($graph_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response, true);
        return $response;
    }

    
}