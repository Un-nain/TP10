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

</body>
<!-- Contact -->

<?php
include "controller.php";
$tab=acctuelNomEdt();
echo $tab;
foreach ($tab as $data) {
    $id = $data['id'];
    $user_id = $data['user_id'];
    $nom = $data['nom'];
    $prenom = $data['prenom'];
    $note = $data['note'];
}


echo '<div class="container col-sm-8" id="contact">
    <h2>Modification de l\'étudiant <br></b>'.$id.' '.$note.' '.$nom.' '.$prenom.' '.$user_id.'</b></h2>
    <hr><br>
    <form method="POST" action="controller.php?func=updateEtudiant">
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><span class="material-icons">
                      perm_identity
                      </span></div>
            </div>
            <input name="user_id" class="form-control" type="text" placeholder="User id" required>
        </div>


        <br />
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><span class="material-icons">
                      contact_mail
                      </span></div>
            </div>
            <input name="nom" class="form-control" type="text" placeholder="Nom" required>
        </div>

        <br />
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><span class="material-icons">
                      contact_mail
                      </span></div>
            </div>
            <input name="prenom" class="form-control" type="text" placeholder="Prénom" required>
        </div>

        <br />

        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text"><span class="material-icons">
                      contact_mail
                      </span></div>
            </div>
            <input name="note" class="form-control" type="text" placeholder="Note" required>
        </div>
        <br />

        <button class="btn btn-primary" name="etudiantId" value="'.$id.'" type="submit">Envoyer</button>
    </form>
</div>';


?>

</html>

