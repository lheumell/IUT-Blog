<?php
session_start();
require_once '../includes/config.php';

$posts = get_all_posts();

if(!empty($_GET['deco'])){
    session_destroy();
    header('location:index.php');
}

if (!empty($_GET['id'])) {
    $getid = $_GET['id'];
    supprimer_article($getid);
    header("location:index.php");
}

if (!empty($_POST['subinscription'])) {
    $nom =  $_POST['nom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    inscription($email, $password, $nom);
}

if(!empty($_POST['subconnexion'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $req = connexion($email, $password);
    $nb = $req->rowcount() ;
    if($nb == 1){
        $req = $req->fetch() ;
        $_SESSION['email'] = $req['email'] ;
        $_SESSION['nom'] = $req['nom'] ;
        $_SESSION['id'] = $req['id'] ;

        
    }
    else{
        echo 'L\'utlisateur n\'existe pas' ;
    }

}

?>

<!DOCTYPE html>
<html lang="en">

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
                        <?php if(!empty($_SESSION['nom'])){?>
                        <li class="nav-item">
                            <a class="nav-link" href="create_article.php">Créer un article</a>
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

    <!----------------DECONNEXION--------------------------->
    <form action="" method="POST">
<!-- Modal -->
<div class="modal fade right" id="exampleModalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalPreviewLabel" aria-hidden="true">
  <div class="modal-dialog modal-side modal-top-right" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalPreviewLabel">Etes-vous sûr de vouloir vous déconnecter ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NON</button>
        <a href="index.php?deco=1" class="btn btn-primary">OUI</a>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Modal -->
    <!------------INSCRIPTION-------------------------->
    <form action="" method="POST">

    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
          <i class="fas fa-user prefix grey-text"></i>
          <input type="text" id="orangeForm-name" class="form-control validate" name="nom">
          <label data-error="wrong" data-success="right" for="orangeForm-name" >Votre nom</label>
        </div>
        <div class="md-form mb-5">
          <i class="fas fa-envelope prefix grey-text"></i>
          <input type="email" id="orangeForm-email" class="form-control validate" name="email">
          <label data-error="wrong" data-success="right" for="orangeForm-email" >Votre email</label>
        </div>

        <div class="md-form mb-4">
          <i class="fas fa-lock prefix grey-text"></i>
          <input type="password" id="orangeForm-pass" class="form-control validate" name="password">
          <label data-error="wrong" data-success="right" for="orangeForm-pass">Votre mot de passe</label>
        </div>

      </div>
      <div class="modal-footer d-flex justify-content-center">
        <input type="submit" class="btn btn-deep-orange" name="subinscription" value="S'inscrire">
      </div>
    </div>
  </div>
</div>


    </form>

<!------------CONNEXION-------------------------->
    <form action="" method="POST">

<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Connexion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body mx-3">
                <div class="md-form mb-5">
                    <i class="fas fa-envelope prefix grey-text"></i>
                    <input type="email" name="email" id="defaultForm-email" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="defaultForm-email">Votre Email</label>
                </div>

                <div class="md-form mb-4">
                    <i class="fas fa-lock prefix grey-text"></i>
                    <input type="password" name="password" id="defaultForm-pass" class="form-control validate">
                    <label data-error="wrong" data-success="right" for="defaultForm-pass">Votre mot de passe</label>
                </div>

            </div>
            <div class="modal-footer d-flex justify-content-center">
                <input type="submit" class="btn btn-default" name="subconnexion" id="subconnexion" value="Se connecter">
            </div>
        </div>
    </div>
</div>


</form>

    <div class="container">
        <h1 class="text-center mt-5 mb-5">Blog</h1>

        <form method="POST">
            <!-- Card deck -->
            <div class="row">
                <?php foreach ($posts as $post) : ?>
                    <div class="col-md-4">
                        <div class="card-deck">


                            <!-- Card -->
                            <div class="card mb-4">

                                <!--Card content-->
                                <div class="card-body">
                                    <!--Title-->
                                    <h4 class="card-title"><?= $post['title'] ?></h4>
                                    <!--Text-->
                                    <p class="card-text" style="font-weight: bold"><?= $post['content'] ?></p>
                                    <p><?= recuperer_nom($post['iduser']) ;  ?></p>
                                    <?php if(isset($_SESSION['nom'])){ ?>
                                    <a href="index.php?id=<?= $post['id'] ?>" class="btn btn-danger btn-rounded">supprimer</a>
                                    <a href="modifier_article.php?id=<?= $post['id'] ?>" class="btn btn-warning btn-rounded">Modifier</a>
                                    <?php } ?>
                                    <a href="recuperer.php?id=<?= $post['id'] ?>" class="btn btn-info btn-rounded">..plus</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </form>

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