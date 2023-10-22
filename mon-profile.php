<?php
include "config/session-check.php";
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();


$user = null;
$query = "";
if($_SESSION['userRole'] == 'secretaire'){
    $query = "SELECT * FROM secretaire WHERE ID_SECRETAIRE = :id LIMIT 1";
}else{
    $query = "SELECT * FROM apprenant WHERE ID_APPRENANT = :id LIMIT 1";
}
$stmt = $db->prepare($query);
$stmt->bindParam(":id", $_SESSION['userID']);

$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    $user = $row;
    break;
}

//var_dump($stmt->debugDumpParams()); exit();

$page = [
    "title"=>"Mon Profile",
];
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>ERP | <?php echo $page['title']?></title>
    <?php include "template/styles.php"?>
</head>

<body class="bg-default">
<?php include 'template/menu.php';?>
<div class="main-content" id="panel">
    <?php include 'template/header.php';?>
    <div class="header pb-6 d-flex align-items-center" style="min-height: 350px; ; background-size: cover; background-position: center top;">
        <!-- Mask -->
        <span class="mask bg-gradient-default opacity-8"></span>
        <!-- Header container -->
        <div class="container-fluid">
            <div class="col-8">
                <h1 class="display-2 text-white">Bonjour, <?php echo $user['PRENOM']. " " . $user['NOM']?></h1>
                <!--                    <p class="text-white mt-0 mb-5">--><?php //echo $user['NOM']. " " . $user['NOM']?><!--</p>-->

            </div>
            <div class="col-4">
                <a href="#!" class="btn btn-neutral" onclick="updateProfile()">Modifier le profil</a>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Modifier le profil </h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form>
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label class="form-control-label">Nom</label>
                                <input type="text" class="form-control" placeholder="Nom" value="<?php echo $user['NOM']?>" id="form_control_NOM">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Prénom</label>
                                <input type="text" class="form-control" placeholder="Nom" value="<?php echo $user['PRENOM']?>" id="form_control_PRENOM">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Téléphone</label>
                                <input type="tel" class="form-control" placeholder="Nom" value="<?php echo $user['TEL']?>" id="form_control_TEL">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Email</label>
                                <input type="email" class="form-control" placeholder="Nom" value="<?php echo $user['EMAIL']?>" id="form_control_EMAIL">
                            </div><div class="form-group">
                                <label class="form-control-label">Adresse</label>
                                <input type="text" class="form-control" placeholder="Nom" value="<?php echo $user['ADRESSE']?>" id="form_control_ADRESSE">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">Mot de passe</label>
                                <input type="password" class="form-control" placeholder="Nom" value="<?php echo $user['MDP']?>" id="form_control_MDP">
                            </div>



                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Footer -->
    </div>
</div>


<?php include "template/scripts.php"?>
<script src="assets/js/pages/mon-profile.js"></script>
</body>

</html>
