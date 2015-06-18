<?php 

require_once ('classes/TwitterWrapper.php');
$TwitterWrapper = new TwitterWrapper();

if(isset($_GET['actions']) && isset($_POST)) {
	if($_GET['actions']) {
		
		if(@$_POST['favourite']) {
			echo "<h1>Favourite</h1>";
		} else if(@$_POST['retweet']) {
			echo "<h1>Retweet</h1>";
		} else if(@$_POST['answer']) {
			echo "<h1>Answer</h1>";
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Tweets</title>
	<!-- Latest compiled and minified Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<!-- Optional Bootstrap theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">

	<!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
</head>
<body>
	<div class="site-wrapper">
		<div class="site-wrapper-inner">
			<div class="cover-container">
				<div class="masthead clearfix">
					<div class="inner">
						<h3 class="masthead-brand">Tweets</h3>
						<nav>
							<ul class="nav masthead-nav">
								<li class="active"><a href="#">Show tweets</a></li>
								<li><a href="/updatabase.php">Load tweets to DB</a></li>
							</ul>
						</nav>
					</div>
				</div>
				<br /> <br />
				<?php
					$result = $TwitterWrapper->getAllTweetsFromDatabase();
					while ($tweet = $result->fetch_array(MYSQLI_ASSOC)) {
						$id = $tweet['id'];
						$datetime = $tweet['datetime'];
						$year = substr($datetime, -4);
						$date = substr($datetime, 4, 12);
						$text = $tweet['text'];
			
						echo "<div class='highlight'>";
						echo "<h4>".$text."</h4>";
						echo "<br />";
						echo "<div class='row'>";
						echo "<div class='text-left col-md-6'>";
						echo "<form action='index.php?actions=1' method='post' class='form-inline'>";
						echo "<input class='btn btn-success' type='submit' name='favourite' value='Favourite'>";
						echo "<input class='btn btn-warning' type='submit' name='retweet' value='Retweet'>";
						echo "<input class='btn btn-info' type='submit' name='answer' value='Answer'>";
						echo "</form>";
						echo "</div>";
						echo "<div style='margin-top: 2%' class= 'text-right col-md-6'>";
						echo $date.", ".$year;
						echo "</div>";
						echo "</div>";
						echo "</div>";
					} 
				?>
			</div>
		</div>
	</div>
</body>
</html>
