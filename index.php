<?php 

//TODO: credentials are here when testing, please move it to config file when done
$oauthToken = '1101134347-n14Ps59pjDfpooMIaLgzlCZd2bW9tm1RWm4x5FR';
$oauthSecret = 'RquykuLqwtxQQmw8yLHSvvB2iHfIKFEek27i06E74mqBw';
$consumerKey = 'qOpUUJamHeWUyGETaGphnIa3A';
$consumerSecret = 'AWNL3oDOS1rPXvLccF8HWon8KZOwKQAGzMfWt0wK72p5TLtDg8';


require_once ('classes/TwitterWrapper.php');
$TwitterWrapper = new TwitterWrapper($oauthToken, $oauthSecret, $consumerKey, $consumerSecret);


$requestUrl = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
$requestParams = '?screen_name=supporteamru';
echo $TwitterWrapper->makeGETRequest($requestUrl, $requestParams);
?>