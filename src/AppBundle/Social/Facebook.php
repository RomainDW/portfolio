<?php

namespace AppBundle\Social;


use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;

class Facebook
{
    private $appId;
    private $appSecret;
    private $version;



    public function __construct($appId,$appSecret,$version)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->version = $version;

    }

    public function connexion()
    {
        $fb = new \Facebook\Facebook([
            'app_id'        => $this->appId,
            'app_secret'    => $this->appSecret,
            'default_graph_version' => $this->version,
        ]);

        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response = $fb->get('/me?fields=friends,feed', 'EAAGUdwGfkncBAF6l4oum8pcDNsqyoPn5nvjtZAETQqIxdjZBFigEQXcyeR9m1pQhZC4l7Shy5imz12VQTKrBEYUW5hl6VPECqj4tWJAPGKNB6Cp1I8ZAgDijlTaUZAS9sq62IASRjoio8WSZAZC15U1nSwbWAQZAz4koGrlIMKkgSQZDZD');
        } catch(FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        return $response->getGraphUser();
    }

}