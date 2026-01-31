<?php
session_start(); 
include "db.php";

if(isset($_POST['login'])){

  $role = $_POST['role'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM users WHERE email='$email' AND role='$role'";
  $res = mysqli_query($conn, $sql);

  if(mysqli_num_rows($res) == 1){
    $row = mysqli_fetch_assoc($res);

    if(password_verify($password, $row['password'])){
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['name'] = $row['name'];
      $_SESSION['role'] = $row['role'];

      if($role == "teacher"){
        header("Location: /zoology/teacher/teacher.php");
        exit();
      }else{
        header("Location: /zoology/student/student_dashboard.php");
        exit();
      }
    }else{
      echo "<script>alert('Wrong Password');</script>";
    }
  }else{
    echo "<script>alert('User not found');</script>";
  }
}
?>
