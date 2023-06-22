<!DOCTYPE html>
<html>
<head>
	<title>Taskmanager</title>
	<link rel="stylesheet" type="text/css" href="/Taskmanager/css/bootstrap.min.css"/>
	<link rel="stylesheet" type="text/css" href="/Taskmanager/css/font-awesome.css"/>
	<link href = "/Taskmanager/css/animate.css" rel = "stylesheet"/>
	<link rel="stylesheet" type="text/css" href="/Taskmanager/css/style.css"/>
	<link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
		
</head>
<body>
	<?php session_start();  ?>

<nav class="navbar navbar-expand-lg navbar-light bg-primary">
  <a class="navbar-brand" href="#">Taskmanager</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      
     <?php 

               if (isset($_SESSION['uname'])) {
               		echo '<li class="nav-item">
        <a class="nav-link" href="">Create Task</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="">My Tasks</a>
      </li><li class="nav-item"><a class="nav-link" href="" name = "logout">Log out</a></li>';
               }
                ?>
      
    </ul>
  </div>
</nav>

