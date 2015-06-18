<?php 

require_once ('classes/TwitterWrapper.php');
$TwitterWrapper = new TwitterWrapper();

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
						$text = $tweet['text'];
			
						echo "<div>";
						echo "<h4>".$text."</h4>";
						echo "<p class='text-right'>".$datetime."</p>";
						echo "</div>";
					} 
				?>
			</div>
		</div>
	</div>
</body>
</html>
