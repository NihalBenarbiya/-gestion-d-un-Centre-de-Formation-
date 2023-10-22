<?php
include "config/session-check.php";
$page = [
    "title"=>"Formateurs",
    "url_path"=>"gestion-des-formateurs.php",
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
                        <h3 class="mb-0">Formateurs</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="">Nom</th>
                                <th scope="col" class="sort" data-sort="">Prénom</th>
                                <th scope="col" class="sort" data-sort="">CIN</th>
                                <th scope="col" class="sort" data-sort="">Email</th>
                                <th scope="col" class="sort" data-sort="">Téléphone</th>
                                <th scope="col" class="sort" data-sort="">Adresse</th>
                                <th scope="col" class="sort" data-sort="">Actions</th>
                            </tr>
                            </thead>
                            <tbody class="list" id="ae_tbody"></tbody>
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
                        <label class="col-sm-2 col-form-label">Nom</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="form_control_NOM" onchange="handleChange(this, 'NOM')"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Prénom</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="form_control_PRENOM" onchange="handleChange(this, 'PRENOM')"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">CIN</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="form_control_CIN" onchange="handleChange(this, 'CIN')"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="form_control_EMAIL" onchange="handleChange(this, 'EMAIL')"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Téléphone</label>
                        <div class="col-sm-10">
                            <input type="tel" class="form-control" id="form_control_TEL" onchange="handleChange(this, 'TEL')"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Adresse</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="form_control_ADRESSE" onchange="handleChange(this, 'ADRESSE')"/>
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
<script src="assets/js/pages/gestion-des-formateurs.js"></script>
</body>

</html>
