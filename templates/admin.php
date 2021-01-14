<div class="wrap">
    <h1>Robotique Concept</h1>
    <?php settings_errors(); ?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab-1">Accueil</a></li>
        <li><a href="#tab-2">Annonces</a></li>
        <li><a href="#tab-3">Pupitres</a></li>
        <li><a href="#tab-4">Pièces détachéess</a></li>
        <li><a href="#tab-5">Robots industriels</a></li>
        <!-- <li><a href="#tab-3">Pipedrive</a></li> -->
        <li><a href="#tab-7">Paramètres</a></li>
    </ul>

    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">    
            <h3>Accueil</h3>
        </div>

        <div id="tab-2" class="tab-pane">    
            <h3>Annonces</h3>
            <ul>
                <li>Voir les différents contrôleurs enregistrés</li>
            </ul>
        </div>

        <div id="tab-3" class="tab-pane">    
            <h3>Pupitres</h3>
        </div>

        <div id="tab-4" class="tab-pane">    
            <h3>Pièces détachées</h3>
        </div>

        <div id="tab-5" class="tab-pane">    
            <h3>Robots industriels</h3>
        </div>

        <div id="tab-7" class="tab-pane">    
            <h3>Réglages & Paramètres</h3>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'robotique_concept_plugin_settings' );
                    do_settings_sections( 'robotique_concept_plugin' );
                    submit_button();
                ?>
            </form>
        </div>
        

    </div>
    
</div>



