<?php
include "db.php";

$class = $_POST['class'];
$message = $_POST['message'];

// Fetch students of selected class
$sql = "SELECT mobile FROM students WHERE class='$class'";
$result = mysqli_query($conn, $sql);

$numbers = [];

while($row = mysqli_fetch_assoc($result)){
  $numbers[] = $row['mobile'];
}

$mobileNumbers = implode(",", $numbers);

// Fast2SMS API
$apiKey = "YOUR_FAST2SMS_API_KEY";

$curl = curl_init();

curl_setopt_array($curl, [
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulkV2",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_POSTFIELDS => http_build_query([
    "sender_id" => "FSTSMS",
    "message" => $message,
    "language" => "english",
    "route" => "q",
    "numbers" => $mobileNumbers,
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: $apiKey",
    "Content-Type: application/x-www-form-urlencoded"
  ],
]);

$response = curl_exec($curl);
curl_close($curl);

echo "<script>alert('SMS Sent Successfully');</script>";
echo "<script>window.location='dashboard.php';</script>";
?>
