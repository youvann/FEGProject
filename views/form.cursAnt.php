<?php 
/**
 * Formulaire qui recupere le cursus anterieur du candidat
 * 
 */
    
ob_start();
?>

<fieldset>
    <legend><h2>Cursus antérieur</h2></legend>

    <h4>1. Cursus post-bac</h4>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="year1">Année</label>
                <input type="text" class="form-control" id="year1" name="year1" placeholder="Ex : 2013/2014 " />
            </div>
            <div class="col-md-4">
                <label for="etab1">Etablissement</label>
                <input type="text" class="form-control" id="etab1" name="etab1" placeholder="Etablissement fréquenté" />
            </div>
            <div class="col-md-4">
                <label for="course1">Cursus suivi</label>
                <input type="text" class="form-control" id="course1" name="course1" placeholder="Votre cursus" />
            </div>
            <div class="col-md-2">
                <label for="mark1">Note/Mention</label>
                <input type="text" class="form-control" id="mark1" name="mark1" placeholder="Votre note/mention" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="year2">Année</label>
                <input type="text" class="form-control" id="year2" name="year2" placeholder="Ex : 2012/2013 " />
            </div>
            <div class="col-md-4">
                <label for="etab2">Etablissement</label>
                <input type="text" class="form-control" id="etab2" name="etab2" placeholder="Etablissement fréquenté" />
            </div>
            <div class="col-md-4">
                <label for="course2">Cursus suivi</label>
                <input type="text" class="form-control" id="course2" name="course2" placeholder="Votre cursus" />
            </div>
            <div class="col-md-2">
                <label for="mark2">Note/Mention</label>
                <input type="text" class="form-control" id="mark2" name="mark2" placeholder="Votre note/mention" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="year3">Année</label>
                <input type="text" class="form-control" id="year3" name="year3" placeholder="Ex : 2011/2012 " />
            </div>
            <div class="col-md-4">
                <label for="etab3">Etablissement</label>
                <input type="text" class="form-control" id="etab3" name="etab3" placeholder="Etablissement fréquenté" />
            </div>
            <div class="col-md-4">
                <label for="course3">Cursus suivi</label>
                <input type="text" class="form-control" id="course3" name="course3" placeholder="Votre cursus" />
            </div>
            <div class="col-md-2">
                <label for="mark3">Note/Mention</label>
                <input type="text" class="form-control" id="mark3" name="mark3" placeholder="Votre note/mention" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="year4">Année</label>
                <input type="text" class="form-control" id="year4" name="year4" placeholder="Ex : 2010/2011 " />
            </div>
            <div class="col-md-4">
                <label for="etab4">Etablissement</label>
                <input type="text" class="form-control" id="etab4" name="etab4" placeholder="Etablissement fréquenté" />
            </div>
            <div class="col-md-4">
                <label for="course4">Cursus suivi</label>
                <input type="text" class="form-control" id="course4" name="course4" placeholder="Votre cursus" />
            </div>
            <div class="col-md-2">
                <label for="mark4">Note/Mention</label>
                <input type="text" class="form-control" id="mark4" name="mark4" placeholder="Votre note/mention" />
            </div>
        </div>
    </div>
    
    <br />
    <h4>2. Expérience professionnelle (emplois, stages)</h4>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="period1">Période</label>
                <input type="text" class="form-control" id="period1" name="period1" placeholder="Ex : 01/01/13 au 01/02/13 " />
            </div>
            <div class="col-md-4">
                <label for="company1">Entreprise</label>
                <input type="text" class="form-control" id="company1" name="company1" placeholder="Entreprise fréquenté" />
            </div>
            <div class="col-md-4">
                <label for="job1">Emploi occupé</label>
                <input type="text" class="form-control" id="job1" name="job1" placeholder="Votre poste" />
            </div>
            <div class="col-md-2">
                <label for="duration1">Durée</label>
                <input type="text" class="form-control" id="duration1" name="duration1" placeholder="Durée" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="period2">Période</label>
                <input type="text" class="form-control" id="period2" name="period2" placeholder="Ex : 01/01/13 au 01/02/13 " />
            </div>
            <div class="col-md-4">
                <label for="company2">Entreprise</label>
                <input type="text" class="form-control" id="company2" name="company2" placeholder="Entreprise fréquenté" />
            </div>
            <div class="col-md-4">
                <label for="job2">Emploi occupé</label>
                <input type="text" class="form-control" id="job2" name="job2" placeholder="Votre poste" />
            </div>
            <div class="col-md-2">
                <label for="duration2">Durée</label>
                <input type="text" class="form-control" id="duration2" name="duration2" placeholder="Durée" />
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-2">
                <label for="period3">Période</label>
                <input type="text" class="form-control" id="period3" name="period3" placeholder="Ex : 01/01/13 au 01/02/13 " />
            </div>
            <div class="col-md-4">
                <label for="company3">Entreprise</label>
                <input type="text" class="form-control" id="company3" name="company3" placeholder="Entreprise fréquenté" />
            </div>
            <div class="col-md-4">
                <label for="job3">Emploi occupé</label>
                <input type="text" class="form-control" id="job3" name="job3" placeholder="Votre poste" />
            </div>
            <div class="col-md-2">
                <label for="duration3">Durée</label>
                <input type="text" class="form-control" id="duration3" name="duration3" placeholder="Durée" />
            </div>
        </div>
    </div>

</fieldset>
<button type="submit" class="btn btn-primary">Terminez</button>

<?php $content = ob_get_clean(); ?>

<?php 
    $title = "Etape 4 sur 4 : Candidature/Pré-inscription pour la formation ...";
    $path ="#";
    require './views/form.template.php';
?>

