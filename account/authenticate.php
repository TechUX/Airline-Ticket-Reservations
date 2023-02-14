<?php
session_start();

require '../includes/dbconfig.php' ;

if ( !isset($_POST['username'], $_POST['password']) ) {
	exit('Please fill both the username and password fields!');
}

if ($stmt = $conn->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
	$stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        if (password_verify($_POST['password'], $password)) {
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['name'] = $_POST['username'];
            $_SESSION['id'] = $id;
            header('Location: index.php');
        } else {
            echo '<center><h1>Incorrect username and/or password!</h1></center>';
        }
    } else {
        echo '<center><h1>Incorrect username and/or password!</h1></center>';
    }
	$stmt->close();
}
?>