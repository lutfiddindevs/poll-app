<?php

function pdo_connect_mysql() {
    // connect to the database
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $dbname = 'phppoll';

    $options = [
       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
       PDO::ATTR_EMULATE_PREPARES => false,
    ];


    try {
        return new PDO('mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8', $user, $password, $options);
    } catch (PDOException $exception) {
        // If there is an error with the connection, stop the script and display the error.
        die ('Connection failed!' . $e->getMessage);
    }
}
// header template 
function template_header($title) {
    echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Voting & Poll System</h1>
            <a href="index.php"><i class="fas fa-poll-h"></i>Polls</a>
    	</div>
    </nav>
EOT;
}

// footer template
function template_footer() {
    echo <<<EOT
    </body>
</html>
EOT;
}