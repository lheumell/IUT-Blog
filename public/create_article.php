<?php
session_start();
require_once '../includes/config.php';

    if(!empty($_POST['bouton'])){
        $title = $_POST['title'] ;
        $content = $_POST['Content'] ;  
        create_article($title,$content,$_SESSION['id']) ;
        header("location:index.php") ;
        
    }


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

    <br>
    <br>
    <br>
    <br>
    <form method="POST">
        <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-4">
                <label for="title">Title</label><br>
                <input type="text" name="title"> <br>       
                <label for="Content">Content</label><br>
                <textarea name="Content" id="Content" cols="50" rows="5"></textarea><br>
                <input type="submit" name="bouton" value="créer">
            </div>
        </div>
    </form>
    </body>
</html>
