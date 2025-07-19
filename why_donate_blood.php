<?php session_start(); ?>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/home.css">
  <link rel="stylesheet" href="css/footer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>

<body>


<?php 
$active ='why';
include('head.php');
?>

<div id="page-container">
  <div class="container">
    <div id="content-wrap">
      <div class="row align-items-center">
        <div class="col-lg-6 mb-4">
          <h1 class="section-title">Why Should I Donate Blood?</h1>
          Blood is the most precious gift that anyone can give to another person — the gift of life. A decision to donate your blood can save a life, or even several if your blood is separated into its components — red cells, platelets and plasma — which can be used individually for patients with specific conditions. Safe blood saves lives and improves health. Blood transfusion is needed for:
          <ul><li>women with complications of pregnancy, such as ectopic pregnancies and haemorrhage before, during or after childbirth.
          </li><li>children with severe anaemia often resulting from malaria or malnutrition.
          </li><li>people with severe trauma following man-made and natural disasters.
          </li><li>many complex medical and surgical procedures and cancer patients.</li></ul>
          <br>It is also needed for regular transfusions for people with conditions such as thalassaemia and sickle cell disease and is used to make products such as clotting factors for people with haemophilia. There is a constant need for regular blood supply because blood can be stored for only a limited time before use. Regular blood donations by a sufficient number of healthy people are needed to ensure that safe blood will be available whenever and wherever it is needed.
        </div>
        <div class="col-lg-6 mb-4">
          <img class="img-fluid rounded blood-cover-img" src="image/08f2fccc45d2564f74ead4a6d5086871.png" alt="Why Donate Blood">
        </div>
      </div>
    </div>
  </div>
  <?php include('footer.php') ?>
</div>
</body>

</html>
