<?php
 include "config/session-check.php";
$page = [
        "title"=>"Formations",
        "url_path"=>"gestion-des-formations.php",
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
                        <h3 class="mb-0">Formations</h3>
                    </div>
                    <!-- Light table -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="">Formation</th>
                                <th scope="col" class="sort" data-sort="">Debut</th>
                                <th scope="col" class="sort" data-sort="">Fin</th>
                                <th scope="col" class="sort" data-sort="">Formateur</th>
                                <th scope="col" class="sort" data-sort="">Status</th>
                                <th scope="col" class="sort" data-sort="">Prix</th>
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
                        <label class="col-sm-2 col-form-label">Date Debut</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="form_control_DATE_DEBUT" onchange="handleChange(this, 'DATE_DEBUT')"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Date Fin</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="form_control_DATE_FIN" onchange="handleChange(this, 'DATE_FIN')"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Prix</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="form_control_PRIX" onchange="handleChange(this, 'PRIX')"/>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Formateur</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="form_control_ID_FORMATEUR" onchange="handleChange(this, 'ID_FORMATEUR')"></select>
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
<script src="assets/js/pages/gestion-des-formations.js"></script>
</body>

</html>
