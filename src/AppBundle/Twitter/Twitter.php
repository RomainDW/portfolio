<?php

namespace AppBundle\Twitter;


use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{
// Ces variables réceptionnerons nos identifiants
    private $consumerKey;
    private $consumerSecret;
    private $accessToken;
    private $accessSecret;

    // Cette variable contiendra notre connexion avec l’API et sera utilisé pour interagir
    private $connection;

    public function __construct($consumerKey,$consumerSecret,$accessToken,$accessSecret)
    {
        $this->consumerKey = $consumerKey;
        $this->consumerSecret = $consumerSecret;
        $this->accessToken = $accessToken;
        $this->accessSecret = $accessSecret;

        // Ces 2 lignes de code effectue la connection avec Twitter
        $this->connection = new TwitterOAuth($this->consumerKey, $this->consumerSecret, $this->accessToken, $this->accessSecret);
        $content = $this->connection->get("account/verify_credentials");
    }

    // Fonction pour tweeter
    public function tweeter($msg)
    {
        // On envoi notre Tweet
        $this->connection->post("statuses/update", array("status" => $msg));
    }

    // Fonction pour avoir les données
    public function twitterData()
    {
        $content = $this->connection->get("account/verify_credentials");
        return $content;
    }
}