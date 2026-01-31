<?php
$conn = mysqli_connect("localhost","root","","zoology");

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$sql = "INSERT INTO contact_messages (name,email,message)
        VALUES ('$name','$email','$message')";
mysqli_query($conn,$sql);

header("Location: contact.html");
?>
