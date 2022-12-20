<?php
  session_start();
  include 'db_con.php';
  $user_id = $_SESSION['id'];
  $doctor_id = $_SESSION['name'];
  if(isset($_GET['id'])){
   $app_id = $_GET['id'];
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GP Doctors</title>

  <!-- Favicon -->
  <link rel="shortcut icon" type="image/png" href="./assets/img/logo/favicon.png">

  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap"
    rel="stylesheet">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="./assets/css/style.css">
  <link rel="stylesheet" href="./assets/css/appointments-list.css">
  <link rel="stylesheet" href="./assets/css/appointments-booking.css">
</head>

<body>

  <!-- Header Section Begin -->
  <header>
    <div class="container">
      <div class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <div class="nav-title">
            <a href="./index.html">
              <img src="./assets/img/logo/logo.png" alt="logo">
            </a>
          </div>
        </div>
        <div class="nav-btn">
          <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
          </label>
        </div>
        <div class="nav-links">
          <a href="./#info">Practice Info</a>
          <a href="./#online">Online Services</a>
          <a href="appointments-booking.php">Make Appointments</a>
          <a href="appointments-list.php">My Appointments</a>
          <a href="./#contact">Contact Us</a>
          <a href="javascript:void(0);">
            <form action="logout.php">
              <input type="submit" value="Logout">
            </form>
          </a>
        </div>
      </div>
    </div>
  </header>
  <!-- Header Section End -->

  <section >
            <div class="show-note-wrapper">
              <h2 class="title" style="margin: 30px 0px;">Your Medical Note</h2>
              <div class="appointments-form" style="margin-bottom: 25px;">
                <h2>Your Details</h2>
                <?php 
                  $sql = "SELECT * FROM appointments WHERE id = $app_id";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $user_id = $row['user_id'];
                      ?>
                      <b><small>Name</small></b>
                      <p><?= $row['firstname']?> <?= $row['lastname']?></p><br>
                      <b><small>Appointment Type</small></b>
                      <p><?= $row['appointment_type']?></p><br>
                      <b><small>Service Type</small></b>
                      <p><?= $row['service_type']?></p><br>
                      <b><small>Appointment Time</small></b>
                      <p><?= $row['appointment_time']?></p><br>
                      <b><small>Appointment Date</small></b>
                      <p><?= $row['appointment_date']?></p>
                  <?php
                      }
                    } else {
                      echo "0 appointments";
                    }
                ?>
              </div>
              <div class="appointments-form" style="margin-bottom: 25px;">
                <h2>Note</h2>
                <?php 
                  $sql = "SELECT * FROM notes WHERE appointment_id = $app_id";
                  $result = $conn->query($sql);
                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $user_id = $row['user_id'];
                      ?>

                  <b><small>Title</small></b>
                  <p><?= $row['note_title']?></p><br>
                  <b><small>Description</small></b>
                  <p><?= $row['note_description']?></p><br>
                  <b><small>Remind Date</small></b>
                  <p><?= $row['remind_date']?></p><br>
                <h2>Medicines</h2>
                  <b><small>Medicines</small></b>
                  <p><?= $row['medicines']?></p><br>
                  <?php
                      }
                    } else {
                      echo "Not reviewed yet";
                    }
                ?>
            </div>
  </section>

  <!-- Footer Begin -->
  <footer>
    <div class="container">
      <div class="footer-wrapper">
        <div class="footer-top">
          <div class="footer-logo">
            <div class="logo-image">
              <a href="./index.html">
                <img src="./assets/img/logo/logo.png" alt="logo">
              </a>
            </div>
          </div>
          <div class="site-map">
            <div class="site-map-wrapper">
              <span>Site Map</span>
              <a href="./#info">Practice Info</a>
              <a href="./#services">Our Services</a>
              <a href="./#online">Online Services</a>
              <a href="./#our-team">Practice Staff</a>
              <a href="./#contact">Contact Us</a>
            </div>
          </div>
          <div class="quick-links">
            <div class="quick-links-wrapper">
              <span>Quick Links</span>
              <a href="appointments-booking.php">Make an Appointment</a>
              <a href="#">Cancel an Appointment</a>
              <a href="./admin-panel.html">Admin Panel</a>
              <a href="#">Privacy policy</a>
              <a href="#">Terms and Conditions</a>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <div class="copyright-text">
            <span><a href="./index.html">gphealthchannel</a> © Copyright 2022.&nbsp;&nbsp;&nbsp;All rights
              reserved.</span>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer Begin -->



</body>

</html>