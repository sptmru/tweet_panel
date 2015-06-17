<?php 
header('Content-Type: text/html; charset=utf-8');

//TODO: credentials are here when testing, please move it to config file when done
$oauthToken = '1101134347-n14Ps59pjDfpooMIaLgzlCZd2bW9tm1RWm4x5FR';
$oauthSecret = 'RquykuLqwtxQQmw8yLHSvvB2iHfIKFEek27i06E74mqBw';
$consumerKey = 'qOpUUJamHeWUyGETaGphnIa3A';
$consumerSecret = 'AWNL3oDOS1rPXvLccF8HWon8KZOwKQAGzMfWt0wK72p5TLtDg8';


require_once ('classes/TwitterWrapper.php');
$TwitterWrapper = new TwitterWrapper($oauthToken, $oauthSecret, $consumerKey, $consumerSecret);


$allTweets = $TwitterWrapper->getAllTweetsfor("supporteamru");

foreach ($allTweets as $tweet) {
	echo "Created at: ".$tweet->created_at."<br />";
	echo "ID: ".$tweet->id."<br />";
	echo "Text: ".$tweet->text."<br />";
	echo "Source: ".$tweet->source."<br />";
	echo "Truncated: ".$tweet->truncated."<br />";
	echo "In reply to status ID: ".$tweet->in_reply_to_status_id."<br />";
	echo "In reply to user ID: ".$tweet->in_reply_to_user_id."<br />";	
	echo "In reply to user name: ".$tweet->in_reply_to_screen_name."<br />";
	echo "<br /><br />";
	echo "-----------------------------------------";
	echo "<br /><br />";
}


?>