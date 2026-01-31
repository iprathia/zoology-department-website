<?php
include "db.php";

if(isset($_POST['register'])){

  $role = $_POST['role'];
  $student_id = $_POST['student_id'] ?? null;
  $teacher_id = $_POST['teacher_id'] ?? null;
  $name = $_POST['name'];
  $email = $_POST['email'];
  $mobile = $_POST['mobile'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if($password !== $cpassword){
    echo "<script>alert('Password mismatch');</script>";
    exit;
  }

  $hash = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users 
  (role, student_id, teacher_id, name, email, mobile, password)
  VALUES
  ('$role','$student_id','$teacher_id','$name','$email','$mobile','$hash')";

  if(mysqli_query($conn, $sql)){
    echo "<script>
      alert('Registration Successful');
      window.location.href='index.html';
    </script>";
  }else{
    echo "<script>alert('Email already exists');</script>";
  }
}
?>
