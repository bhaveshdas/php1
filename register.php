<?php
require_once 'connection.php';

// check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}

if ($stmt = $con->prepare('INSERT INTO accounts (username, passward, email) VALUES (?, ?, ?)')) {
	// We do not want to expose passwords in our database, so hash the passward and use password_verify when a user logs in.
	// $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
	$stmt->bind_param('sss', $_POST['username'], $_POST['password'], $_POST['email']);
	$stmt->execute();
	echo 'You have successfully registered! You can now login!';
} else {
	// Something is wrong with the SQL statement, so you must check to make sure your accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}