<?php 
/**
* Affiche le premier formulaire qui contient
* deux listes déroulantes : Formation précédente + formation souhaitée
*/

ob_start();
?>


<fieldset>
<legend><h2>Formation souhaitée</h2></legend>

<div class="form-group">    
    <label for="liste1">Sélectionnez votre dernière formation effectuée</label> 
    <div class="row">
        <div class="col-xs-2">
            
            <select class="form-control" name="liste1">
                <optgroup label="Licence">
                    <option>L1 AES</option>
                    <option>L2 AES</option>
                    <option>L3 Parcours Travail et Ressources Humaines (TRH)</option>
                    <option>L3 Parcours Gestion des Entreprises (GE)</option>
                </optgroup>
                <optgroup label="Master">
                    <option>M1 Administration des Institutions Culturelles (AIC)</option>
                    <option>M1 Aix Marseille Sciences Economiques</option>
                    <option>M1 Aix Marseille Sciences Economiques parcours Magistere</option>
                </optgroup>
            </select>

        </div><!-- /col-xs-2 -->
    </div><!-- /row -->
</div><!-- /form-group -->

<div class="form-group">   
    <label for="liste2">Sélectionnez la formation souhaitée pour l'année scolaire 2014-2015</label> 
    <div class="row">
        <div class="col-xs-2">
            
            <select class="form-control" name="liste2">
                 <optgroup label="Licence">
                    <option>L1 AES</option>
                    <option>L2 AES</option>
                    <option>L3 Parcours Travail et Ressources Humaines (TRH)</option>
                    <option>L3 Parcours Gestion des Entreprises (GE)</option>
                </optgroup>
                <optgroup label="Master">
                    <option>M1 Administration des Institutions Culturelles (AIC)</option>
                    <option>M1 Aix Marseille Sciences Economiques</option>
                    <option>M1 Aix Marseille Sciences Economiques parcours Magistere</option>
                </optgroup>
            </select>

        </div><!-- /col-xs-2 -->            
    </div><!-- /row -->
</div><!-- /form-group -->

<button type="submit" class="btn btn-primary">Suivant</button>

<div id="result_form1"></div>
</fieldset>

<?php $content = ob_get_clean(); ?>

<?php 
    $title = "Etape 1 sur 4 : Parcours de l'étudiant"; 
    $path = "./controllers/form.formation.controller.php";
    require './views/form.template.php';
?>





