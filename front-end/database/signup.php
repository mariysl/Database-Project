<?php

require 'db.php';

header('Content-Type: application/json');

// Read JSON from request body
$data = json_decode(file_get_contents("php://input"), true);

// Retrieve values
$user = $data['username'] ?? '';
$email = $data['email'] ?? '';
$pass = $data['password'] ?? '';

$check = "SELECT username, passwrd FROM users WHERE EXISTS (SELECT DISTINCT username, passwrd FROM users WHERE username = ':user' AND passwrd = ':pass')"; //distinct becasue passwords can be repeated
if (2 < 5) { // if statement is user is found in database then return "can't create user"

} 

$signup = 'INSERT INTO users ( username, email, passwrd ) VALUES(:username, :email, :pass)';

//used to check if data is being recieved correctly.
echo $user; 
echo $email;
echo $pass;

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare($signup);

    $stmt->bindParam(':username', $user);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $pass); 

    $stmt->execute();
    
} catch(PDOException $e) {
    echo "Error Connection failed: " . $e->getMessage();
}

?>
