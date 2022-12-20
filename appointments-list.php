<?php
  session_start();
  include 'db_con.php';
  $user_id = $_SESSION['id'];

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

  <!-- Appointments List Begin -->
  <section class="appointments">
    <div class="appointments-list">
      <h2 class="title">Appointments</h2>
      <h3 class="sub-title">Cancelling Your Appointment</h3>
      <hr class="title-underline-center">
      <div class="container">
        <div class="appointments-list-text-wrapper">
          <p>
            We realize that occasionally you forget your appointment or that other significant life events occur and you
            no longer require the appointment. We do ask that if you are unable to attend your appointment, you cancel
            it or tell the office as soon as possible.
          </p>
        </div>
        <div class="appointments-list--wrapper">
          <div class="appointments-grid-container">
            <?php 
              $sql = "SELECT * FROM appointments WHERE user_id = $user_id";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  if($row['user_id'] == $_SESSION['id']) {
                  ?>

            <!-- Appointment One -->
            <div class="appointments-grid-item">
              <div class="appointment" style="text-align: left;">
                <p><b>Appointment Type:</b> <?php echo $row['appointment_type']?></p>
                <p><b>Service Type:</b> <?php echo $row['service_type']?></p>
                <p><b>Doctor:</b> <?php echo $row['doctor_id']?></p>
                <p><b>Time:</b> <?php echo $row['appointment_time']?></p>
                <p><b>Date:</b> <?php echo date("d/m/Y",strtotime($row['appointment_date']));?></p>
              </div>
              <div style="margin: 20px 0px;">
                <button style="display: inline-block;">
                  <a href="show-notes.php?id=<?= $row['id']?>" style="text-decoration: none; color:black">View Note</a>
                </button>
              </div>
              <!-- <div class="button" onclick="document.getElementById('id01').style.display='block'">
                Cancel Your Appointment
              </div> -->

              <!-- <div id="id01" class="modal">
                <form class="modal-content" action="/action_page.php">
                  <span onclick="document.getElementById('id01').style.display='none'" class="close"
                    title="Close Modal">×</span>
                  <div class="container">
                    <h1>Delete Appointment</h1>
                    <p>Are you sure you want to delete your appointment?</p>

                    <div class="clearfix">
                      <div class="clearfix-inner-wrapper">
                        <button type="button" onclick="document.getElementById('id01').style.display='none'"
                          class="cancelbtn">Cancel</button>
                        <button type="button" onclick="document.getElementById('id01').style.display='none'"
                          class="deletebtn">Delete</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div> -->
            </div>
            <?php
                  }
                }
              } else {
                echo "0 appointments";
              }
          ?>
          </div>
        </div>
      </div>
    </div>

    </div>
  </section>
  <!-- Appointments List End -->


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


  <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>

</html>