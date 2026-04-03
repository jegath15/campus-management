<?php
session_start();
if(!isset($_SESSION['uid']) || $_SESSION['role'] !== 'parent'){
   header("Location: ../index.php");
   exit();
}
include('../assets/config.php');

$user_id = $_SESSION['uid'];

$q = mysqli_query($conn,"SELECT student_id FROM parents WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($q);
$student_id = $row['student_id'];

$file = $_FILES['payment_proof']['name'];
$tmp = $_FILES['payment_proof']['tmp_name'];

$path = "../parentUploads/".$file;
move_uploaded_file($tmp, $path);

mysqli_query($conn,"
INSERT INTO payments (student_id, proof_image, status)
VALUES ('$student_id','$file','pending')
");

echo "<script>alert('Payment proof uploaded successfully');window.location='payment.php';</script>";
