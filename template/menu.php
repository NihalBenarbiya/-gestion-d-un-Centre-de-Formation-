<?php

    $menu_secretaire = $_SESSION['userRole'] == "secretaire" ?
        [
            ["title"=>"Gestion des formations", "url"=>"gestion-des-formations.php", "icon"=>"ni ni-paper-diploma"],
            ["title"=>"Gestion des formateurs", "url"=>"gestion-des-formateurs.php", "icon"=>"ni ni-badge"],
            ["title"=>"Gestion d'apprenants", "url"=>"gestion-d-apprenants.php", "icon"=>"ni ni-hat-3"],
            ["title"=>"Inscriptions", "url"=>"inscriptions.php", "icon"=>"ni ni-check-bold"],
            ["title"=>"Gestion des secretaires", "url"=>"gestion-des-secretaires.php", "icon"=>"ni ni-ui-04 "],

            ["title"=>"Mon profile", "url"=>"mon-profile.php", "icon"=>"ni ni-circle-08"],

            ["title"=>"Creation d'emploi", "url"=>"creation-d-emploi.php", "icon"=>"ni ni-calendar-grid-58"],
        ]:
        [
            ["title"=>"Emploie", "url"=>"consulter-emploie.php", "icon"=>"ni ni-tv-2"],
            //["title"=>"Demande de certificat", "url"=>"demande-de-certificat.php", "icon"=>"ni ni-hat-3"],
            ["title"=>"Mon profile", "url"=>"mon-profile.php", "icon"=>"ni ni-circle-08"],
        ];

?>

<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <h1>ERP</h1>
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <?php
                        foreach ($menu_secretaire as $menu){
                            echo '
                                <li class="nav-item">
                                    <a class="nav-link" href="'.$menu['url'].'">
                                        <i class="'.$menu['icon'].' text-primary"></i>
                                        <span class="nav-link-text">'.$menu['title'].'</span>
                                    </a>
                                </li>
                            ';
                        }
                    ?>

                </ul>

            </div>
        </div>
    </div>
</nav>