<?php 
	require_once('lib/rb.php');
	
	setlocale(LC_ALL,"it_IT");
	date_default_timezone_set('Europe/Rome');
	
	R::setup('mysql:host=127.0.0.1;dbname=ricevute','mine', 'mine');
	R::freeze(FALSE);
	
	$pg=(empty($_REQUEST['p'])) ? 'home' : $_REQUEST['p'];
        
	$pg='pgs/'.$pg.'.php';


        
?>
<html lang="it">
  <head>
    <title>Ricevute</title>
	<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
  <body>
	<div id="all" class="all">
		<?php if (file_exists($pg)) include($pg); ?>
	</div>
  </body>
</html>
