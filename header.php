<!DOCTYPE html>
<html lang="ro">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>SM</title>
	</head>
	<body>
	<header>
		<div class="menu">

			<ul>
				<li><img src="images\logo.png" alt="SM_movies" class="ImageLogo" style="width:61px;height:61px;padding:7px;"></li>
			  <li><a href="index.php">Home</a></li>
			  <li><a href="archive.php">Movies</a></li>
			  <li><a href="genres.php">Genres</a></li>

			  <li style="float:right;" id="Contact"><a class="active" href="#about">Contact</a></li>
				<li id="search">
					<form class="search-bar" action="search-results.php">
					  <input type="text" placeholder="Search..." name="s">
					  <button type="submit"><i class="fa fa-search"></i></button>
					</form>
				</li>
			</ul>

		</div>
	</header>
	<?php include 'functions.php';
	$movies = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->movies;
	$genres = json_decode(file_get_contents('https://raw.githubusercontent.com/yegor-sytnyk/movies-list/master/db.json'))->genres;
	$max_runtime = longest_movie($movies);?>
