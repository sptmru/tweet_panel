<?php

require_once "TwitterAPIExchange.php";

class TwitterWrapper {

	private $settings = array();
	private $Twitter;

	private function makeGETRequest($url, $getField) {
		$requestMethod = 'GET';
		$result = $this->Twitter->setGetfield($getField)
			->buildOauth($url, $requestMethod)
			->performRequest();
		return $result;
	}
	
	public function __construct($oauthToken, $oauthSecret, $consumerKey, $consumerSecret) {
		$this->settings = array(
			'oauth_access_token' => $oauthToken,
			'oauth_access_token_secret' => $oauthSecret,
			'consumer_key' => $consumerKey,
			'consumer_secret' => $consumerSecret
			);
		$this->Twitter = new TwitterAPIExchange($this->settings);
	}

	public function getTimeline($username) {
		$requestUrl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$requestParams = '?screen_name='.$username;
		$jsonResult = $this->makeGETRequest($requestUrl, $requestParams);
		$result = json_decode($jsonResult);

		return $result;
	}



}