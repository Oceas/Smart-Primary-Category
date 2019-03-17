<?php

class Episcopal_VOTD
{
    public function __construct() {

        add_shortcode( 'myepiscopal-votd', array( $this, 'episcopal_votd' ));

    }

    function episcopal_call($endpoint, $args = 'null', $method = 'GET')
    {
        //Populate the correct endpoint for the API request
        $url = "https://api.myepiscopal.com/api/{$endpoint}";
        //Make the call and store the response in $res
        $res = wp_remote_get($url);
        //Check for success
        if (!is_wp_error($res) && ($res['response']['code'] == 200 || $res['response']['code'] == 201)) {
            return json_decode($res['body']);
        } else {
            return false;
        }
    }
    function episcopal_votd($attributes)
    {
        $response = get_transient('votd_response');
        if (!$response) {
            $response = episcopal_call('verses/votd');
            set_transient('votd_response', $response, DAY_IN_SECONDS);
        }
        return sprintf('<p>%s - %s</p>', $response->verse, $response->reading);
    }
}