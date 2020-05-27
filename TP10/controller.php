<?php
include "connexpdo.php";
if(isset($_GET['func']))
{
    if($_GET['func']=="VerifiedAuthentification")
    {
        VerifiedAuthentification($_POST['login'], $_POST['password']);
    }

    if ($_GET['func'] == "createUser"){
        if(createUser($_POST['login'], $_POST['password'], $_POST['mail'], $_POST['nom'], $_POST['prenom'])){
            header("Location: index.php");
        }
        else{
            echo "Champ incorrect !";
        }
    }

    if($_GET['func']== "createEtudiant"){
        if(createEtudiant($_POST['nom'], $_POST['prenom'], $_POST['note'])){
            header("Location: viewadmin.php");
        }
        else{
            echo "Champ incorrect !";
        }
    }

    if($_GET['func']== "deleteEtudiant"){
        if(deleteEtudiant($_POST['Delete'])){
            header("Location: viewadmin.php");
        }
        else{
            echo "Champ incorrect !";
        }
    }

    if($_GET['func']== "pageEditEtudiant"){
        if (isset($_POST['etudiantId']))
        {
            header("Location: view-editetudiant.php");
        }
        else{
            header("Location: viewadmin.php");

        }

    }

    if($_GET['func']== "updateEtudiant"){
        if(updateEtudiant($_POST['etudiantId'], $_POST['user_id'], $_POST['nom'], $_POST['prenom'], $_POST['note'])){
            header("Location: viewadmin.php");
        }
        else{
            echo "Champ incorrect !";
        }
    }

    if($_GET['func']== "Deconnexion"){

        Deconnexion();

    }
}

function Deconnexion(){
    session_start();
    session_unset();
    header('Location: index.php');
    exit;
}

function connectBDDetudiant(){
    echo "Start connexion !<br><br>";
    $base = 'pgsql:dbname=etudiants;host=localhost;port=5432';
    $user = 'postgres';
    $password = 'azerty123';

    try{
        $db=connexpdo($base, $user, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //pour activer l'affichage des erreurs pdo
    } catch(PDOException $e){
        echo 'ERROR: ' . $e->getMessage();
    }
    return $db;
}


function listEtudiant() {
    $db = connectBDDetudiant();

    $query0 = "SELECT nom FROM etudiant";
    $nbr = $db->query($query0);
    $nbr_student=sizeof($nbr);

    if($nbr_student>=1) {
        $query1 = "SELECT id, user_id, nom, prenom, note FROM etudiant WHERE user_id =".$_SESSION["adminId"];
        $sth = $db->prepare($query1);
        $sth->execute();
        $result=$sth->fetchAll();

        $nbr_student = sizeof($result);
        for ($k = 0; $k < $nbr_student; $k++) {
            echo '<tr>';
            echo '<th id="etudiantId" scope="row">'.$result[$k]['id'].'</th>';
            echo '<td>' . $result[$k]['user_id'] . '</td>';
            echo '<td>' . $result[$k]['nom'] . '</td>';
            echo '<td>' . $result[$k]['prenom'] . '</td>';
            echo '<td>' . $result[$k]['note'] . '</td>';
            echo '<td><form method="POST" action="view-editetudiant.php?id='.$result[$k]['id'].'"><button style="float: right" type="submit" class="btn btn-primary">Update</button></form></td>';
            echo '<td><form method="POST" action="controller.php?func=deleteEtudiant"><button style="float: right" name="Delete" value="'.$result[$k]['id'].'" type="submit" class="btn btn-danger">Delete</button></form></td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    }
}

function createEtudiant($nomEtudiant, $prenomEtudiant,$note ){

    $db=connectBDDetudiant();
    session_start();
    $user_id = $_SESSION["adminId"];
    $query = "SELECT count(*) FROM etudiant";
    $numero = $db->query($query);
    $numero->execute();

    $sql1 = "INSERT INTO etudiant (user_id, nom, prenom, note) VALUES (?, ?, ?, ?)";
    $sqlR1 = $db->prepare($sql1);
    $sqlR1->execute([$user_id, $nomEtudiant, $prenomEtudiant, $note]);
    return true;
}




function VerifiedAuthentification($loginUser, $passwordUser){
    $db=connectBDDetudiant();
    $q = "SELECT id, nom, prenom, password FROM utilisateur WHERE login = '$loginUser'";
    $sth = $db->prepare($q);
    $sth->execute();
    $r=$sth->fetchAll();

    if (password_verify($passwordUser, $r[0]['password'])){

        header("Location: viewadmin.php");
    }
    else {
        echo "Wrong Login or Password";
    }
    session_start();
    $_SESSION["adminId"] = $r[0]['id'];
    $_SESSION["adminPrenom"] = $r[0]['prenom'];
    $_SESSION["adminNom"] = $r[0]['nom'];

}

function NotesMoyenne(){
    $db = connectBDDetudiant();

    //session_start();
    $sommeNotes = 0;
    $nbr_students = 0;

    $q = "SELECT note FROM etudiant WHERE user_id=".$_SESSION["adminId"];
    $r = $db->query($q);
    foreach ($r as $data) {
        $sommeNotes+=$data['note'];
        $nbr_students++;
    }

    if($nbr_students <=0)
    {
        $nbr_students=1;
    }
    $moyenne=$sommeNotes/$nbr_students;
    echo $moyenne;

}

function createUser($loginUser, $passwordUser, $mailUser, $nomUser, $prenomUser)
{
    $db=connectBDDetudiant();

    $sql1 = "INSERT INTO utilisateur (login, password, mail, nom, prenom) VALUES ( ?, ?, ?, ?, ?)";
    $sqlR1 = $db->prepare($sql1);
    $passwordUser=password_hash($passwordUser,PASSWORD_DEFAULT);
    $sqlR1->execute([$loginUser, $passwordUser, $mailUser, $nomUser, $prenomUser]);
    return true;

}



function updateEtudiant($idEt, $user_id, $nomEtudiant, $prenomEtudiant, $note){

    $db=connectBDDetudiant();

    $sql = "UPDATE etudiant SET user_id='".$user_id."', nom='".$nomEtudiant."', prenom ='".$prenomEtudiant."', note ='".$note."' WHERE id=".$idEt;
    $stmt = $db->prepare($sql);
    $stmt->execute();

    return true;
}

function deleteEtudiant($idEtudiant){
    $db=connectBDDetudiant();
    echo $idEtudiant;
    $db->exec("DELETE FROM etudiant WHERE id=" . $idEtudiant);
    return true;

}

function acctuelNomEdt(){
    $db=connectBDDetudiant();


    $id = $_GET['id'];
    $sql = "SELECT id, user_id, nom, prenom, note FROM etudiant WHERE id =" . $id;
    $r = $db->query($sql);


    return $r;


}

?>