<?php 
/**
 * Affiche le deuxième formulaire qui va permettre de récolter
 * les informations sur les candidats
 */
?>

<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title">Etape 2 sur 4 : Candidature/Pré-inscription pour la formation ... </h3>
    </div><!-- /panel-heading -->

    <div class="panel-body">

    <form role="form">
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
                        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Votre nom" />
                    </div>
                    <div class="col-md-6">
                        <label for="firstName">Prénom</label>
                        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Votre prenom" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="birthDate">Date de naissance</label>
                        <input type="date" class="form-control" id="birthDate" name="birthDate"/>
                    </div>
                    <div class="col-md-4">
                        <label for="birthPlace">Lieu de naissance</label>
                        <input type="text" class="form-control" id="birthPlace" name="birthPlace" placeholder="Votre lieu de naissance"/>
                    </div>
                    <div class="col-md-4">
                        <label for="nationality">Nationalité</label>
                        <input type="text" class="form-control" id="nationality" name="nationality" placeholder="Votre nationalité"/>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <div class="row">
                    <div class="col-md-8    ">
                        <label for="ineNum">N° INE (pour étudiants en France)</label>
                        <input type="text" class="form-control" id="ineNum" name="ineNum" placeholder="Votre numéro INE"/>
                    </div>
                </div>
            </div>  

        </fieldset>

        <fieldset>
            <legend><h2>Coordonnées & contact</h2></legend>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="adress">Adresse</label>
                        <input type="text" class="form-control" id="adress" name="adress" placeholder="Votre adresse"/>
                    </div>
                    <div class="col-md-4">
                        <label for="adressBis">Complément d'adresse</label>
                        <input type="text" class="form-control" id="adressBis" name="adressBis" placeholder="Bâtiment, étage, appartement ..."/>
                    </div>
                    <div class="col-md-4">
                        <label for="postalCode">Code postal</label>
                        <input type="text" class="form-control" id="postalCode" name="postalCode" placeholder="Votre code postal"/>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-8">
                        <label for="city">Ville</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Votre ville"/>
                    </div>
                </div>    
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="homePhone">Téléphone fixe</label>
                        <input type="tel" class="form-control" id="homePhone" name="homePhone" placeholder="Votre numéro" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/>
                    </div>
                    <div class="col-md-4">
                        <label for="mobilePhone">Téléphone mobile</label>
                        <input type="tel" class="form-control" id="mobilePhone" name="mobilePhone" placeholder="Votre numéro"/ pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$">
                    </div>
                    <div class="col-md-4">
                        <label for="postalCode">Adresse électronique</label>
                        <input type="email" class="form-control" id="mail" name="mail" placeholder="Votre mail"/>
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
                        <input type="text" class="form-control" id="currentActivity" name="currentActivity" placeholder="étudiant, salarié, demandeur d'emploi, autre"/>
                    </div>
                </div>
            </div>
            
        </fieldset>        

        <button type="submit" class="btn btn-primary">Suivant</button>
    </form>

    </div><!-- /panel-body -->
</div><!-- /panel panel-primary -->