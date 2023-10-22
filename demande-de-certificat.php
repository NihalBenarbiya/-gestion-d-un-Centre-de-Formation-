<?php
include "config/session-check.php";
$page = [
    "title"=>"Demande de certificat",
    "url_path"=>"demande-de-certificat.php",
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
                        <a href="#" class="btn btn-neutral" onclick="save()">Demande</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid mt--6">
        <div class="card pt-5 pb-4 pl-3 pr-3">
            <!-- Card header -->
            <div class="container">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Mes Formation</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="form_control_ID_FORMATION" onchange="handleChange(this, 'ID_FORMATION')"></select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php include 'template/footer.php';?>
</div>

<?php include "template/scripts.php"?>
<script src="assets/js/pages/demande-de-certificat.js"></script>
</body>

</html>
