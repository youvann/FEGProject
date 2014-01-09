<?php 
/**
 * Formulaire qui permet de recolter les informations principales du candidat
 * 
 */

ob_start();
?>
<fieldset>
    <legend><h2>Informations personnelles</h2></legend>

    <div class="radio">
        <label>
            <input type="radio" name="sex" id="woman" value="man" checked>
            Madame
        </label>
    </div>  
    <div class="radio">
        <label>
            <input type="radio" name="sex" id="man" value="woman">
            Monsieur
        </label>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label for="lastName">Nom</label>
                <input type="text" class="form-control required" id="lastName" name="lastName" placeholder="Votre nom" data-validation="required" />
            </div>
            <div class="col-md-6">
                <label for="firstName">Prénom</label>
                <input type="text" class="form-control required" id="firstName" name="firstName" placeholder="Votre prenom" data-validation="required" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="birthDate">Date de naissance</label>
                <input type="text" class="form-control required" id="birthDate" name="birthDate" placeholder="jj/mm/aaaa" data-validation="custom" data-validation-regexp="(^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$)" data-validation-error-msg="Veuillez entrer une date valide"/>
            </div>
            <div class="col-md-4">
                <label for="birthPlace">Lieu de naissance</label>
                <input type="text" class="form-control required" id="birthPlace" name="birthPlace" placeholder="Votre lieu de naissance" data-validation="required"/>
            </div>
            <div class="col-md-4">
                <label for="nationality">Nationalité</label>
                <input type="text" class="form-control required" id="nationality" name="nationality" placeholder="Votre nationalité" data-validation="required"/>
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <label for="ineNum">N° INE (pour étudiants en France)</label>
                <input type="text" class="form-control required" id="ineNum" name="ineNum" placeholder="Ex : 1234567891A" data-validation="custom" data-validation-regexp="(^[0-9]{10}[a-zA-Z]$)" data-validation-error-msg="Veuillez entrer un numéro d'INE valide"/>
            </div>
        </div>
    </div>  

</fieldset>

<fieldset>
    <legend>Coordonnées & contact</legend>

    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="adress">Adresse</label>
                <input type="text" class="form-control required" id="adress" name="adress" placeholder="Votre adresse" data-validation="required"/>
            </div>
            <div class="col-md-4">
                <label for="adressBis">Complément d'adresse</label>
                <input type="text" class="form-control" id="adressBis" name="adressBis" placeholder="Bâtiment, étage, appartement ..."/>
            </div>
            <div class="col-md-4">
                <label for="postalCode">Code postal</label>
                <input type="text" class="form-control required" id="postalCode" name="postalCode" placeholder="Votre code postal" data-validation="custom" data-validation-regexp="(^[0-9]{5}$)" data-validation-error-msg="Veuillez entrer un code postal valide"/>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <label for="city">Ville</label>
                <input type="text" class="form-control required" id="city" name="city" placeholder="Votre ville" data-validation="required"/>
            </div>
        </div>    
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-4">
                <label for="homePhone">Téléphone fixe</label>
                <input type="tel" class="form-control" id="homePhone" name="homePhone" placeholder="Votre numéro"/>
            </div>
            <div class="col-md-4">
                <label for="mobilePhone">Téléphone mobile</label>
                <input type="tel" class="form-control required" id="mobilePhone" name="mobilePhone"  placeholder="Votre numéro" data-validation="custom" data-validation-regexp="(^(06|07)[0-9]{8}$)" data-validation-error-msg="Veuillez entrer un numéro valide"/>
            </div>
            <div class="col-md-4">
                <label for="postalCode">Adresse électronique</label>
                <input type="email" class="form-control required" id="mail" name="mail" placeholder="Votre mail" data-validation="email"/>
            </div>
        </div>
    </div>
</fieldset>    

<fieldset>
    <legend><h2>Autres</h2></legend>
    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <label for="currentActivity">Activité actuelle</label>
                <input type="text" class="form-control required" id="currentActivity" name="currentActivity" placeholder="étudiant, salarié, demandeur d'emploi, autre" data-validation="required" />
            </div>
        </div>
    </div>
</fieldset>        

<button type="submit" class="btn btn-primary">Suivant</button>

<?php $content = ob_get_clean(); ?>

<?php 
    $title   = "Etape 2 sur 4 : Candidature/Pré-inscription pour la formation ..."; 
    $path    = "#";
    $id_form = "formInfoPerso";

    require './templates/form.template.php'; 
?>
   
