<?php

require_once ('classes/TwitterWrapper.php');
$TwitterWrapper = new TwitterWrapper();

$username = "eriction"; //Twitter username to get tweets from

$allTweets = $TwitterWrapper->getAllTweetsfor($username);
$TwitterWrapper->putAllTweetsToDatabase($allTweets);

echo "Tweets were uploaded.";

?>