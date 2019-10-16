<?php
    session_start() ;
    require_once '../includes/config.php';
    $getid = $_GET['id'] ;
   $rec = recuperer_article($getid) ;
?>

<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Mini-Blog</title>
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
<!-- Bootstrap core CSS -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<!-- Material Design Bootstrap -->
<link href="css/mdb.min.css" rel="stylesheet">
<!-- Your custom styles (optional) -->
<link href="css/style.css" rel="stylesheet">


<title>Blog</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
    <body>
    <div class="row ">
        <div class="col-md-12">
            <!-- Start your project here-->
            <!--Navbar-->
            <nav class="navbar navbar-expand-lg navbar-dark primary-color">

                <!-- Navbar brand -->
                <a class="navbar-brand" href="index.php">Blog</a>

                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav" aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="basicExampleNav">

                    <!-- Links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Accueil
                            </a>
                        </li>
                        <?php if(empty($_SESSION['nom'])){?>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#modalRegisterForm">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="modal" data-target="#modalLoginForm">Connexion</a>
                        </li>
                        <?php }?>
                    </ul>
                 <?php if(isset($_SESSION['nom'])) {
                     ?>
                    <span class="navbar-text white-text">
                       Vous êtes connecté en tant que <?= $_SESSION['nom']  ?> 
                       <a class="btn btn-outline-danger btn-rounded waves-effect" data-toggle="modal" data-target="#exampleModalPreview">Se deconnecter</a>
                    </span> 
                     <?php
                 } 
                 ?>
                </div>
                <!-- Collapsible content -->

            </nav>
            <!--/.Navbar-->

        </div>
    </div>
    <div class="container">
        <div class="row-mt-50">
            <p><?= $rec['title'] ?></p>
            <p><?= $rec['content'] ?></p>
        </div>
    </div>
           <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    </body>
</html>