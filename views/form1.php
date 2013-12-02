<div class="panel panel-primary">

    <div class="panel-heading">
        <h3 class="panel-title">Inscription pour l'année scolaire 2013-2014</h3>
    </div><!-- /panel-heading -->

    <div class="panel-body">

    <form role="form" id="form_liste" action="controllers/form1.controller.php" method="post">
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

            <br/>
            
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
            
            <br/>

            <button type="submit" class="btn btn-primary">Valider</button>
            <div id="result_form1"></div>
        </div>
    </form>

        </div><!-- /panel-body -->
    </div><!-- /form-group -->
</div><!-- /panel panel-primary -->


