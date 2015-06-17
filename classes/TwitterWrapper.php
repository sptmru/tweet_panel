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

	public function getTimelineFor($username, $requestParams = '?screen_name='.$username) {
		$requestUrl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		//$requestParams = '?screen_name='.$username;
		$jsonResult = $this->makeGETRequest($requestUrl, $requestParams);
		$result = json_decode($jsonResult);

		return $result;
	}

	public function getAllTweetsfor($username) {
		$allTweets = array();
		$newTweets = $this->getTimelineFor($username);
		$allTweets = array_merge($allTweets, $newTweets);

		$lastTweet = end($allTweets);
		$oldestID = $last['id'] - 1;
		$requestParams = '?screen_name='.$username.'&count=200&max_id='.$oldestID;

		while(!empty($newTweets)) {
			$newTweets = $this->getTimelineFor($username, $requestParams);
			$allTweets = array_merge($allTweets, $newTweets);
			$lastTweet = end($allTweets);
			$oldestID = $last['id'] - 1;
		}

		return $allTweets;
	}



}