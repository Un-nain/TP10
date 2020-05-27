<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>Admin Panel</title>
</head>
<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="index.php">TP n°10 langage PHP & SQL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
    </button>

</nav>
<main>
    <!-- Contact -->
<?php
session_start();
if(!isset($_SESSION['adminId'])) {
    header('Location: index.php');
}
$user_id = $_SESSION["adminId"];
$user_nom = $_SESSION["adminNom"];
$user_prenom = $_SESSION["adminPrenom"];
include "controller.php";



echo '
<div class="container col-sm-9 jumbotron" id="contact">
    <h2 style="display: inline;">Admin Panel of '.$user_prenom .' '. $user_nom.'</h2>
        <a style="float: right;" href="controller.php?func=Deconnexion" class="button-pe-connect is-blue" data-toggle="tooltip" data-placement="bottom" title="">
            <button class="btn btn-info">Deconnexion</button>
        </a>
    <hr>';

echo'<br>
    <h3>Liste des étudiants</h3>';
echo'<table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User_Id</th>
                <th scope="col">Nom</th>
                <th scope="col">Prénom</th>
                <th scope="col">Note</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>';
listEtudiant();
echo '<br>
    <div>
        <a href="view-newetudiant.php" class="button-pe-connect is-blue" data-toggle="tooltip" data-placement="bottom" title="">
            <button class="btn btn-info">Ajouter un étudiant</button>
        </a>
    </div>';

echo'<br>
    <h3>Moyenne des étudiants</h3><hr>';
echo'<h2>';
NotesMoyenne();
echo '</h3></div></main></html>';