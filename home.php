<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

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
<div class="header">
<?php
$active="home";
include('head.php'); ?>

</div>


  <div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;   ">
    <div class="container">
    <div id="content-wrap"style="padding-bottom:75px;">
  <!-- Banner Image -->
  <div class="banner-img-wrapper mb-4">
    <img src="image/bloodX_1.jpg" alt="Donate Blood Save Life" class="img-fluid w-100 rounded banner-img">
  </div>
<br>
        <h1 class="main-title">Welcome to BloodX</h1>
<br>
        <div class="row">
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">The need for blood</h4>
                    <p class="card-body card-section-text">
                      There are many reasons patients need blood. A common misunderstanding about blood usage is that accident victims are the patients who use the most blood. Actually, people needing the most blood include those:<br><br>
                      1) Being treated for cancer<br>
                      2) Undergoing orthopedic surgeries<br>
                      3) Undergoing cardiovascular surgeries<br>
                      4) Being treated for inherited blood disorders
                     </p>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">Blood Tips</h4>
                    <p class="card-body card-section-text">
                      1) You must be in good health.<br>
                      2) Hydrate and eat a healthy meal before your donation.<br>
                      3) You're never too old to donate blood.<br>
                      4) Rest and relaxed.<br>
                      5) Don't forget your FREE post-donation snack.
                     </p>

                        </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card">
                    <h4 class="card-header card bg-info text-white">Who you could Help</h4>
                    <p class="card-body card-section-text">
                      Every 2 seconds, someone in the World needs blood. Donating blood can help:<br><br>
                      1) People who go through disasters or emergency situations.<br>
                      2) People who lose blood during major surgeries.<br>
                      3) People who have lost blood because of a gastrointestinal bleed.<br>
                      4) Women who have serious complications during pregnancy or childbirth.<br>
                      5) People with cancer or severe anemia sometimes caused by thalassemia or sickle cell disease.
                     </p>


                        </div>
            </div>
</div>
 <!-- Hospital Names Section -->
 <h2 class="section-title mt-5">Our Partner Hospitals</h2>
        <div class="row">
          <?php
            include 'conn.php';
            $sql = "SELECT * FROM hospitals ORDER BY name ASC";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
            <div class="col-md-4 col-sm-6 mb-3">
              <div class="card shadow-sm hospital-card">
                <div class="card-body text-center">
                  <img src="image/bloodX_5.png" alt="Hospital" style="width:64px;height:64px;border-radius:50%;margin-bottom:10px;box-shadow:0 2px 8px rgba(0,0,0,0.08);background:#e3f2fd;object-fit:cover;">
                  <h5 class="card-title text-danger font-weight-bold mb-0">
                    <?php echo htmlspecialchars($row['name']); ?>
                  </h5>
                </div>
                <a href="#" class="btn btn-danger btn-block mt-3 reserve-btn" data-hospital-id="<?php echo $row['id']; ?>" data-hospital-name="<?php echo htmlspecialchars($row['name']); ?>">Reserve Now</a>
              </div>
            </div>
          <?php
              }
            } else {
              echo '<div class="col-12"><div class="alert alert-info">No hospitals found.</div></div>';
            }
          ?>
        </div>
        <!-- Features Section -->
        <div class="row">
            <div class="col-lg-6">
                <h2 class="section-title" style="font-size:2.5rem;font-weight:900;color:#b1001a;letter-spacing:1px;">BLOOD GROUPS</h2>
                <p class="lead" style="font-size:1.25rem;">Blood group of any human being will mainly fall in any one of the following groups.</p>
                <ul style="font-size:1.15rem; margin-bottom:1.5rem;">
                  <li>A positive or A negative</li>
                  <li>B positive or B negative</li>
                  <li>O positive or O negative</li>
                  <li>AB positive or AB negative.</li>
                </ul>
                <p style="font-size:1.15rem;">Your blood group is determined by the genes you inherit from your parents.<br>
                A healthy diet helps ensure a successful blood donation, and also makes you feel better!</p>

            </div>
            <div class="col-lg-6">
                <img class="img-fluid rounded blood-cover-img" src="image\blood_donationcover.jpeg" alt="">
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Call to Action Section -->
        <div class="row mb-4">
            <div class="col-md-8">
            <h4 style="font-size:2rem;font-weight:900;color:#b1001a;letter-spacing:1px;">UNIVERSAL DONORS AND RECIPIENTS</h4>
            <p style="font-size:1.15rem;">
              The most common blood type is O, followed by type A. Type O individuals are often called "universal donors" since their blood can be transfused into persons with any blood type. Those with type AB blood are called "universal recipients" because they can receive blood of any type.
            </p>
            <p style="font-size:1.15rem;">
              For emergency transfusions, blood group type O negative blood is the variety of blood that has the lowest risk of causing serious reactions for most people who receive it. Because of this, it's sometimes called the universal blood donor type.
            </p>
              </div>
            <div class="col-md-4">
                <a class="btn btn-lg btn-secondary btn-block become-donor-btn" href="donate_blood.php">Become a Donor </a>
            </div>
        </div>

     
    </div>
  </div>
  <?php include('footer.php');?>
</div>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.reserve-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    e.preventDefault();
    <?php if (!isset($_SESSION['user_id'])): ?>
      Swal.fire({
        icon: 'warning',
        title: 'Login Required',
        text: 'Please log in to reserve blood.',
        confirmButtonText: 'OK',
        customClass: { popup: 'themed-popup' }
      });
      return;
    <?php endif; ?>
    const hospitalId = this.getAttribute('data-hospital-id');
    const hospitalName = this.getAttribute('data-hospital-name');
    Swal.fire({
      title: 'Reserve Blood at ' + hospitalName,
      html:
        `<input id="swal-input1" class="swal2-input themed-input" placeholder="Your Name">\n` +
        `<input id="swal-input2" class="swal2-input themed-input" placeholder="Contact Number">\n` +
        `<select id="swal-input4" class="swal2-input themed-input"><option value="">Select Blood Group</option><option value="A+">A+</option><option value="A-">A-</option><option value="B+">B+</option><option value="B-">B-</option><option value="AB+">AB+</option><option value="AB-">AB-</option><option value="O+">O+</option><option value="O-">O-</option></select>` +
        `<input id="swal-input3" class="swal2-input themed-input" type="date" placeholder="Reservation Date">`,
      focusConfirm: false,
      customClass: {
        confirmButton: 'themed-confirm-btn',
        popup: 'themed-popup',
      },
      preConfirm: () => {
        return [
          document.getElementById('swal-input1').value,
          document.getElementById('swal-input2').value,
          document.getElementById('swal-input3').value,
          document.getElementById('swal-input4').value
        ]
      }
    }).then((result) => {
      if (result.isConfirmed) {
        const [name, contact, date, blood_group] = result.value;
        if (!name || !contact || !date || !blood_group) {
          Swal.fire('Error', 'All fields are required.', 'error');
          return;
        }
        <?php $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>
        fetch('save_reservation.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
          body: `hospital_id=${encodeURIComponent(hospitalId)}&name=${encodeURIComponent(name)}&contact=${encodeURIComponent(contact)}&date=${encodeURIComponent(date)}&blood_group=${encodeURIComponent(blood_group)}<?php if ($user_id) { echo '&user_id=' . $user_id; } ?>`
        })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            Swal.fire('Success', 'Reservation saved!', 'success');
          } else {
            Swal.fire('Error', data.message || 'Failed to save reservation.', 'error');
          }
        })
        .catch(() => Swal.fire('Error', 'Failed to save reservation.', 'error'));
      }
    });
  });
});

document.querySelectorAll('.become-donor-btn').forEach(btn => {
  btn.addEventListener('click', function(e) {
    <?php if (!isset($_SESSION['user_id'])): ?>
      e.preventDefault();
      Swal.fire({
        icon: 'warning',
        title: 'Login Required',
        text: 'Please log in to become a donor.',
        confirmButtonText: 'OK',
        customClass: { popup: 'themed-popup' }
      });
      return;
    <?php endif; ?>
  });
});
</script>

<style>
/* Themed input styles for reservation popup */
.swal2-popup.themed-popup {
  border-radius: 18px !important;
  box-shadow: 0 4px 32px rgba(220,53,69,0.15);
}
.swal2-input.themed-input, .swal2-select.themed-input {
  border: 2px solid #dc3545 !important;
  border-radius: 8px !important;
  font-size: 1.1em;
  margin-bottom: 10px;
  box-shadow: none !important;
  transition: border-color 0.2s;
}
.swal2-input.themed-input:focus, .swal2-select.themed-input:focus {
  border-color: #b71c1c !important;
  outline: none !important;
}
.swal2-confirm.themed-confirm-btn {
  background: linear-gradient(90deg, #dc3545 0%, #b71c1c 100%) !important;
  color: #fff !important;
  border-radius: 6px !important;
  font-size: 1.1em !important;
  padding: 0.7em 2.5em !important;
  box-shadow: 0 2px 8px rgba(220,53,69,0.12);
}
</style>

</body>

</html>
