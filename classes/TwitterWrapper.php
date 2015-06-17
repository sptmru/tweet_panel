<?php
header('Content-Type: text/html; charset=utf-8');

//let's test VS Code :)

require_once "TwitterAPIExchange.php";
require_once "config/config.php";

//another test

class TwitterWrapper {

	private $mysqli = '';
	private $settings = array();
	private $Twitter;

	private function makeGETRequest($url, $getField) {
		$requestMethod = 'GET';
		$result = $this->Twitter->setGetfield($getField)
			->buildOauth($url, $requestMethod)
			->performRequest();
		return $result;
	}


	private function getTimelineFor($username, $requestParams) {
		$requestUrl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
		$jsonResult = $this->makeGETRequest($requestUrl, $requestParams);
		$result = json_decode($jsonResult);

		return $result;
	}
	
	public function __construct() {
		$this->settings = array(
			'oauth_access_token' => OAUTH_TOKEN,
			'oauth_access_token_secret' => OAUTH_SECRET,
			'consumer_key' => CONSUMER_KEY,
			'consumer_secret' => CONSUMER_SECRET
			);
		$this->Twitter = new TwitterAPIExchange($this->settings);

		$this->mysqli = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DB);
		$this->mysqli->set_charset('utf8');
	}

	public function getAllTweetsfor($username) {
		$allTweets = array();
		$requestParams = '?screen_name='.$username.'&count=200';
		$newTweets = $this->getTimelineFor($username, $requestParams);
		$allTweets = array_merge($allTweets, $newTweets);

		$lastTweet = end($allTweets);
		$oldestID = $lastTweet->id - 1;

		while(!empty($newTweets)) {
			$requestParams = '?screen_name='.$username.'&count=200&max_id='.$oldestID;
			$newTweets = $this->getTimelineFor($username, $requestParams);
			$allTweets = array_merge($allTweets, $newTweets);
			$lastTweet = end($allTweets);
			$oldestID = $lastTweet->id - 1;

		}

		return $allTweets;
	}

	public function putAllTweetsToDatabase($tweets) {
		foreach ($tweets as $tweet) {
			$stmt = $this->mysqli->prepare("INSERT INTO tweets (id, datetime, text) VALUES(?, ?, ?)");
			$stmt->bind_param('sss', $tweet->id, $tweet->created_at, $tweet->text);

			$stmt->execute();
			$stmt->close();
		}
	}



}