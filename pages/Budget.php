<!-- Contenu de la page -->
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Gérer les budgets</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Paramètres du budget
                </div>
                <div class="panel-body">
                    <form role="form">
                        <fieldset>
                            <div class="form-group pull-left">
                                <label for="name">Catégorie</label>
                                <select name="month" class="form-control">
                                    <option>Janvier</option>
                                </select>
                            </div>
                            <div class="form-group pull-right">
                                <label for="amount">Montant</label>
                                <input class="form-control" required placeholder="montant" width="10" name="amount" type="text" value="">
                            </div>
                            <hr class="clearbothh">
                            <div class="form-group pull-left clearbothh">
                                <label for="month">Mois</label>
                                <select name="month" class="form-control">
                                    <option>Janvier</option>
                                    <option>Février</option>
                                    <option>Mars</option>
                                    <option>Avril</option>
                                    <option>Mai</option>
                                    <option>Juin</option>
                                    <option>Juillet</option>
                                    <option>Août</option>
                                    <option>Septembre</option>
                                    <option>Octobre</option>
                                    <option>Novembre</option>
                                    <option>Décembre</option>
                                </select>
                            </div>
                            <div class="form-group pull-left">
                                <label for="year">Année</label>
                                <select name="year" class="form-control">
                                    <option></option>
                                    <option>2014</option>
                                    <option>2015</option>
                                    <option>2016</option>
                                </select>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="panel-footer">
                    <button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-log-in"></span>  Enregistrer le budget</button>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="panel panel-green">
                <div class="panel-heading">
                    Budget basé sur un graphique
                </div>
                <div class="panel-body">
                    <p>Veuillez ajouter votre budget avec votre catégorie, mois et année.</p>
                </div>
                <div class="panel-footer">
                    <!-- Ajoutez le contenu du pied de page ici -->
                </div>
            </div>
        </div>
    </div>
</div>
