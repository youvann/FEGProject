<?php
/**
 * Formulaire pour choisir la spécialite de la formation (voeux)
 * 
 */

ob_start(); 
?>
<fieldset>
<legend><h2>Choix de la spécialité</h2></legend>

    <div class="form-group">

        <label for="wish1">Sélectionnez votre voeu n°1</label> 
        <div class="row">
            <div class="col-xs-6">
                <select multiple class="form-control" name="wish1">
                    <optgroup label="Recherche">
                        <option>L1 AES</option>
                        <option>L2 AES</option>
                        <option>L3 Parcours Travail et Ressources Humaines (TRH)</option>
                        <option>L3 Parcours Gestion des Entreprises (GE)</option>
                    </optgroup>
                    <optgroup label="Professionnel">
                        <option>M1 Administration des Institutions Culturelles (AIC)</option>
                        <option>M1 Aix Marseille Sciences Economiques</option>
                        <option>M1 Aix Marseille Sciences Economiques parcours Magistere</option>
                    </optgroup>
                </select>
            </div><!-- /col-xs-2 -->
        </div><!-- /row -->

        <div class="row">
            <div class="col-md-2">
                <div class="radio">
                    <label>
                        <input type="radio" name="city" value="aix" checked>
                        Aix-en-Provence
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="radio">
                    <label>
                        <input type="radio" name="city" value="mars">
                        Marseille
                    </label>
                </div>
            </div>
        </div>

        <label for="wish2">Sélectionnez votre voeu n°2</label> 
        <div class="row">
            <div class="col-xs-6">
                <select multiple class="form-control" name="wish2">
                    <optgroup label="Recherche">
                        <option>L1 AES</option>
                        <option>L2 AES</option>
                        <option>L3 Parcours Travail et Ressources Humaines (TRH)</option>
                        <option>L3 Parcours Gestion des Entreprises (GE)</option>
                    </optgroup>
                    <optgroup label="Professionnel">
                        <option>M1 Administration des Institutions Culturelles (AIC)</option>
                        <option>M1 Aix Marseille Sciences Economiques</option>
                        <option>M1 Aix Marseille Sciences Economiques parcours Magistere</option>
                    </optgroup>
                </select>
            </div><!-- /col-xs-2 -->
        </div><!-- /row -->

        <div class="row">
            <div class="col-md-2">
                <div class="radio">
                    <label>
                        <input type="radio" name="city" value="aix" checked>
                        Aix-en-Provence
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="radio">
                    <label>
                        <input type="radio" name="city" value="mars">
                        Marseille
                    </label>
                </div>
            </div>
        </div>

        <label for="wish3">Sélectionnez votre voeu n°3</label> 
        <div class="row">
            <div class="col-xs-6">
                <select multiple class="form-control" name="wish3">
                    <optgroup label="Recherche">
                        <option>L1 AES</option>
                        <option>L2 AES</option>
                        <option>L3 Parcours Travail et Ressources Humaines (TRH)</option>
                        <option>L3 Parcours Gestion des Entreprises (GE)</option>
                    </optgroup>
                    <optgroup label="Professionnel">
                        <option>M1 Administration des Institutions Culturelles (AIC)</option>
                        <option>M1 Aix Marseille Sciences Economiques</option>
                        <option>M1 Aix Marseille Sciences Economiques parcours Magistere</option>
                    </optgroup>
                </select>
            </div><!-- /col-xs-2 -->
        </div><!-- /row -->

        <div class="row">
            <div class="col-md-2">
                <div class="radio">
                    <label>
                        <input type="radio" name="city" value="aix" checked>
                        Aix-en-Provence
                    </label>
                </div>
            </div>
            <div class="col-md-2">
                <div class="radio">
                    <label>
                        <input type="radio" name="city" value="mars">
                        Marseille
                    </label>
                </div>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Suivant</button>
    </fieldset>
<div id="result_form1"></div>

<?php $content = ob_get_clean(); ?>

<?php
    $title   = "Etape 3 sur 4 : Candidature/Pré-inscription pour la formation ...";
    $path    = "#";
    $id_form = "formChoixSpe";

    require './views/form.template.php';
?>      


