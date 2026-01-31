<?php
include "db.php";

$id     = $_POST['id'];
$name   = $_POST['name'];
$class  = $_POST['class'];
$mobile = $_POST['mobile'];

$sql = "INSERT INTO students (student_id, name, class, mobile)
        VALUES ('$id', '$name', '$class', '$mobile')";

if(mysqli_query($conn, $sql)){
  echo "success";
}else{
  echo "error";
}
?>




