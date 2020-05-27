<!DOCTYPE html>
<html lang="fr">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <title>Site</title>
</head>

<body>
<!-- Contact -->

<?php

include "controller.php";

echo "<div class=\"container col-sm-8\" id=\"contact\">
    <h2>Connexion</h2>
    <hr><br>
    <form method='POST' action='controller.php?func=VerifiedAuthentification'>
        <div class=\"input-group\">
            <div class=\"input-group-prepend\">
                <div class=\"input-group-text\"><span class=\"material-icons\">
                      perm_identity
                      </span></div>
            </div>
            <input name='login' class=\"form-control\" type=\"text\" placeholder=\"Login\" required>
        </div>

        <br/>

        <div class=\"input-group\">
            <div class=\"input-group-prepend\">
                <div class=\"input-group-text\"><span class=\"material-icons\">
                      contact_mail
                      </span></div>
            </div>
            <input name='password' class=\"form-control\" type='password' placeholder=\"Password\" required>
        </div>

        <br />
        <button class=\"btn btn-primary\" type=\"submit\">Envoyer</button>
    </form>
</div>";

?>

</body>

</html>
