<?php
$name=$_POST['fullname'];
$number=$_POST['mobileno'];
$email=$_POST['emailid'];
$age=$_POST['age'];
$gender=$_POST['gender'];
$blood_group=$_POST['blood'];
$address=$_POST['address'];

// Optional advanced fields
$latitude = isset($_POST['latitude']) && $_POST['latitude'] !== '' ? $_POST['latitude'] : null;
$longitude = isset($_POST['longitude']) && $_POST['longitude'] !== '' ? $_POST['longitude'] : null;
$last_donation_date = isset($_POST['last_donation_date']) && $_POST['last_donation_date'] !== '' ? $_POST['last_donation_date'] : null;
$availability_score = isset($_POST['availability_score']) && $_POST['availability_score'] !== '' ? (int)$_POST['availability_score'] : null;

$conn=mysqli_connect("localhost","root","","blood_donation") or die("Connection error");

// Use prepared statement to safely handle optional fields
$sql = "INSERT INTO donor_details
  (donor_name, donor_number, donor_mail, donor_age, donor_gender, donor_blood, donor_address, latitude, longitude, last_donation_date, availability_score)
  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param(
  "sssisssddsi",
  $name,
  $number,
  $email,
  $age,
  $gender,
  $blood_group,
  $address,
  $latitude,
  $longitude,
  $last_donation_date,
  $availability_score
);
$ok = $stmt->execute();

if ($ok) {
    header("Location: add_donor.php?success=1");
    exit;
}

mysqli_close($conn);
?>
