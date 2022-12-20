<?php 
  include "db_con.php";

  session_start(); 

  $sql = "SELECT * FROM users WHERE role = '3'";
  $result = $conn->query($sql);


  if(isset($_POST['create-appointment']))
  {	 
    $user_id = $_SESSION['id'];
    $doctor_id = $_POST['doctor'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mobile = $_POST['mobile'];
    $appointment_type = $_POST['appointment_type'];
    $service_type = $_POST['service_type'];
    $appointment_time = $_POST['appointment_time'];
    $appointment_date = $_POST['appointment_date'];

    $sql = "INSERT INTO appointments(user_id,doctor_id,firstname,lastname,mobile, appointment_type, service_type, appointment_time, appointment_date)
    VALUES ('$user_id','$doctor_id','$firstname','$lastname', '$mobile', '$appointment_type', '$service_type', '$appointment_time', '$appointment_date')";
    if (mysqli_query($conn, $sql)) {
      $successmessage = "Appointment created successfully";
      header("location: appointments-list.php");
    } else {
      echo "Error: " . $sql . "
  " . mysqli_error($conn);
    }
    mysqli_close($conn);
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
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@200;300;400;600;700;900&display=swap" rel="stylesheet">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="./assets/css/style.css">
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



  <!-- Appointments Section Begin -->
    <section class="appointments">
        <div class="make-appointments-wrapper">
            <h2 class="title">Appointments</h2>
            <h3 class="sub-title">How to Make an Appointment</h3>
            <p style="text-align: center;">
              <?php if(isset($successmessage)){
                echo $successmessage;
              }?>
            </p>
            <hr class="title-underline-center">
            <div class="make-appointments-form-wrapper">
                <div class="container">
                    <form action="appointments-booking.php" method="POST" class="appointments-form">
                        <fieldset>
                            <legend>Make your Appointment</legend>
                            <div class="make-appointments-inner-wrapper">

                                <!-- Appointment Types -->
                                <label for="appointment-type" class="form-title">Appointment Types</label><br><br>
                                <select id="appointment-type" name="appointment_type">
                                    <option>Appointment Types</option>
                                    <option value="Routine appointments and Clinics">Routine appointments and Clinics</option>
                                    <option value="Saturday morning/Commuter appointments">Saturday morning/Commuter appointments</option>
                                    <option value="Same day emergency appointments">Same day emergency appointments</option>
                                </select><br><br>

                                <!-- Service or Condition -->
                                <label for="service" class="form-title">Service or Condition</label><br><br>
                                <select id="service" name="service_type">
                                    <option>Select the Service or Condition You Require</option>
                                    <option value="Abdominal Pain">Abdominal Pain</option>
                                    <option value="Acute Asthma">Acute Asthma</option>
                                    <option value="Anxiety">Anxiety</option>
                                    <option value="Blood Tests">Blood Tests</option>
                                    <option value="Burns">Burns</option>
                                    <option value="Cervical Smears">Cervical Smears</option>
                                    <option value="Diarrhoea">Diarrhoea</option>
                                    <option value="Eczema">Eczema</option>
                                    <option value="Stings">Stings</option>
                                    <option value="Travel Vaccinations">Travel Vaccinations</option>
                                    <option value="Urine Infections">Urine Infections</option>
                                    <option value="Warts">Warts</option>
                                </select><br><br>

                                <!-- Doctor -->
                                <label for="select-doctor" class="form-title">Doctor</label><br><br>
                                <select id="select-doctor" name="doctor">
                                    <option value="">Select Doctor</option>
                                  <?php 
                                    if ($result->num_rows > 0) {
                                      while ($doctor = mysqli_fetch_assoc($result)) {?>
                                      <option value="<?php echo $doctor['name']?>"><?php echo $doctor['name']?></option>
                                    <?php } }?>
                                </select><br><br>

                                <!-- Time -->
                                <label for="select-time" class="form-title">Time</label><br><br>
                                <select id="select-time" name="appointment_time">
                                    <option>Opening Times</option>
                                    <option value="08:00 - 10:00">08:00 - 10:00</option>
                                    <option value="10:00 - 12:00">10:00 - 12:00</option>
                                    <option value="13:00 - 15:00">13:00 - 15:00</option>
                                    <option value="16:00 - 18:00">16:00 - 18:00</option>
                                    <option value="18:00 - 20:00">18:00 - 20:00</option>
                                </select><br><br>

                                <!-- Your Date -->
                                <label for="date" class="form-title">Your Date</label><br><br>
                                <input type="date" id="date" name="appointment_date"><br><br>
                            </div>
                        </fieldset>
                        <br><br>
                        <fieldset>
                            <legend>Personal Details</legend>
                            <div class="personal-details-inner-wrapper">
                                <label for="fname" class="form-title">First name</label><br><br>
                                <input type="text" id="fname" name="firstname"><br><br>

                                <label for="lname" class="form-title">Last name</label><br><br>
                                <input type="text" id="lname" name="lastname"><br><br>

                                <label for="mobile" class="form-title">Mobile Number</label><br><br>
                                <input type="text" id="mobile" name="mobile"><br><br>
                            </div>
                          
                           
                        </fieldset>

                        <input type="submit" value="Submit Your Appointment" name="create-appointment" class="submit-button">
                    </form>
                </div>
            </div>
        </div>

    </section>

    <section class="view-Appointment">
      <div class="container">
        <div class="button">
          <a href="appointments-list.php">View Your Appointment</a>
        </div>
      </div>
    </section>

  <!-- Appointments Section End -->


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
                <a href="#">Make an Appointment</a>
                <a href="./appointments-list.html">Cancel an Appointment</a>
                <a href="./admin-panel.html">Admin Panel</a>
                <a href="#">Privacy policy</a>
                <a href="#">Terms and Conditions</a>
              </div>
            </div>
          </div>
          <div class="footer-bottom">
            <div class="copyright-text">
              <span><a href="./index.html">gphealthchannel</a> © Copyright 2022.&nbsp;&nbsp;&nbsp;All rights reserved.</span>
            </div>
          </div>
        </div>
      </div>
    </footer>
  <!-- Footer Begin -->
</body>
</html>