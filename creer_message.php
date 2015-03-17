<!DOCTYPE html>
<html>
    <head>  
        <meta charset="utf-8"/>    
        <title>Mystereetbouledenerf</title>
        <link href='http://fonts.googleapis.com/css?family=Shadows+Into+Light' rel='stylesheet' type='text/css'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
      
        <link href="css/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
	  	<section class="message">
		<!-- Formulaire message-->
    	  	<form action="traitement.php" method="post" enctype="multipart/form-data">
        		<div class="form-group">
            		<label for="objet">Objet :</label>
            		<input type="text" class="form-control" id="objet" name="objet" required/>
        		</div>
                <div class="form-group">
                    <label for="dest">Pseudo du destinataire :</label>
                    <input type="text" class="form-control" id="dest" name="dest" required/>
                </div>
       			<div class="form-group">
            		<label for="message">Message :</label>
            		<textarea id="message" class="form-control" name="message" required></textarea>
        		</div>
        		<div class="button">
           			 <button type="submit" type="button" class="btn btn-info">Envoyer</button>
        		</div>
    		</form>
	  	</section>
	</body>

</html>

