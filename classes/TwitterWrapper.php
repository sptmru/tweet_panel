<?php

require_once "TwitterAPIExchange.php";

class TwitterWrapper {

	private $settings = array();
	private $Twitter;

	public function __construct($oauthToken, $oauthSecret, $consumerKey, $consumerSecret) {
		$this->settings = array(
			'oauth_access_token' => $oauthToken,
			'oauth_access_token_secret' => $oauthSecret,
			'consumer_key' => $consumerKey,
			'consumer_secret' => $consumerSecret
			);
		$this->Twitter = new TwitterAPIExchange($this->settings);
	}

	public function makeGETRequest($url, $getField) {
		$requestMethod = 'GET';
		$result = $this->Twitter->setGetfield($getField)
			->buildOauth($url, $requestMethod)
			->performRequest();
		return $result;
	}

}