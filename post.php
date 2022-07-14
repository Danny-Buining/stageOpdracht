<?php
include'connect.php';

$postCheck = true;
$content = $_POST['mytextarea'];
$username = $_POST['username'];

$query = $conn->prepare('INSERT INTO allposts (messages, username) VALUES (?, ?)');

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(empty($_POST['mytextarea'])) {
        $postCheck = false;
        echo "Fill in all fields!" ;
    }
    elseif(empty($_POST['username'])) {
        $postCheck = false;
        echo "Fill in all fields!" ;
    }
    elseif($postCheck != false) {
        $query->execute([$content, $username]);
        header("Location: ./index.php");
    }
}
?>