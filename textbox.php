<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FEGProject</title>
    <link rel="stylesheet" href="./public/css/bootstrap.css" />
</head>

<body>

    <div class="container">

        <h1>TEXT BOX MOTHA FUCKA</h1>
        <br>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group">
                <button type="button" class="btn btn-primary" id="add"><span class="glyphicon glyphicon-plus-sign"></span> Ajouter</button>
                <button type="button" class="btn btn-danger" id="remove"><span class="glyphicon glyphicon-trash"></span> Supprimer</button>
            </div>
        </div>
        <br>
        <div id="textbox-group">
            <label for="tb1">Choix 1</label>
            <input type="text" class="form-control" id="tb1" name="tb1"/>
            <label for="tb2">Choix 2</label>
            <input type="text" class="form-control" id="tb2" name="tb2"/>
        </div>
        <div id="error"></div>

    </div>

    <script type="text/javascript" src="./public/js/jquery-2.0.3.min.js"></script>
	<script type="text/javascript" src="./public/js/jquery-form-validator/jquery.form-validator.min.js"></script>
    <script type="text/javascript" src="./public/js/feg.js"></script>
</body>
</html>