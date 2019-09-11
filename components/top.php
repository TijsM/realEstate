<?php
session_start();

$isLogedIn = ($_SESSION) ? 'true' : 'false';

// echo $isLogedIn;
$isAgent = 'false';
if ($isLogedIn == 'true') {
  $isAgent = $_SESSION['jUser']->isAgent;
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>properties</title>
  <link rel="stylesheet" href="app.css" class="css">


  <script src='https://api.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.js'></script>
  <link href='https://api.mapbox.com/mapbox-gl-js/v1.3.1/mapbox-gl.css' rel='stylesheet' />

</head>

<body>


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark  ">
    <a class="navbar-brand" href="#">Houser</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <?php
        if ($isLogedIn == 'false') {
          echo "
          <li class='nav-item '>
            <a class='nav-link' href='./login-register.php'>login or sign up<span class='sr-only'>(current)</span></a>
          </li>
        ";
        }


        if ($isLogedIn == 'true') {
          echo "
          <li class='nav-item'>
            <a class='nav-link' href='./profile.php'>profile</a>
          </li>
          ";
        }


        if ($isLogedIn == 'true') {
          echo "
          <li class='nav-item' id='linkLogout'>
            <a class='nav-link' href='#'>logout</a>
          </li>
          ";
        }


        if ($isAgent == 'true') {
          echo "
            <li class='nav-item'>
              <a class='nav-link' href='./add-properties.php'>add properties</a>
            </li>
            ";
        }
        ?>
      </ul>
  </nav>