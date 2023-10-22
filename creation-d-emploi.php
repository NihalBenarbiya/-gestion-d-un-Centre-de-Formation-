<?php
include "config/session-check.php";
$page = [
    "title"=>"Emplois",
    "url_path"=>"creation-d-emploi.php.php",
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

<body>
<?php include 'template/menu.php';?>

<!-- Main content -->
<div class="main-content" id="panel">
    <?php include 'template/header.php';?>

    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="<?php echo $page['url_path']?>"><?php echo $page['title']?></a></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral" onclick="openModal()">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header border-0">
                        <h3 class="mb-0">Emplois</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="">Jour</th>
                                <th scope="col" class="sort" data-sort="">08:00 à 10:00</th>
                                <th scope="col" class="sort" data-sort="">10:00 à 12:00</th>
                                <th scope="col" class="sort" data-sort="">14:00 à 16:00</th>
                                <th scope="col" class="sort" data-sort="">16:00 à 18:00</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                                <tr id="ae_lundi"><th>Lundi</th></tr>
                                <tr id="ae_mardi"><th>Mardi</th></tr>
                                <tr id="ae_mercredi"><th>Mercredi</th></tr>
                                <tr id="ae_jeudi"><th>Jeudi</th></tr>
                                <tr id="ae_vendredi"><th>Vendredi</th></tr>
                                <tr id="ae_samedi"><th>Samedi</th></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'template/footer.php';?>
</div>

<div class="modal fade" id="ae_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <!--                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>-->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Formation</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="form_control_ID_FORMATION" onchange="handleChange(this, 'ID_FORMATION')"></select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">Heure</label>
                        <div class="col-sm-8">
                            <select class="form-control" id="form_control_ID_EMPLOIE" onchange="handleChange(this, 'ID_EMPLOIE')">
<!--                                <option value="8">08:00 à 10:00</option>-->
<!--                                <option value="10">10:00 à 12:00</option>-->
<!--                                <option value="14">14:00 à 16:00</option>-->
<!--                                <option value="16">16:00 à 18:00</option>-->
                            </select>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModal()">Fermer</button>
                <button type="button" class="btn btn-primary" onclick="save()">Enregistrer</button>
            </div>
        </div>
    </div>
</div>



<?php include "template/scripts.php"?>
<script src="assets/js/pages/emplois.js"></script>
</body>

</html>
