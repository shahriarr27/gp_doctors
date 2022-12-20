<?php 
    session_start();
    include_once 'db_con.php';
    $doctor_id = $_SESSION['name'];
  
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
    <link rel="stylesheet" href="./assets/css/admin-panel.css">
</head>
<body>
    <section class="admin-panel-wrapper">
        <div class="admin-panel">
            <div class="sidebar">
                <div class="sidebar-inner-wrapper">
                    <a href="./index.html">
                        <div class="admin-panel-logo">
                            <img src="./assets/img/logo/logo.png" alt="logo">
                        </div>                                
                    </a>
                    <ul>
                        <li>
                            <a role="button" onclick="openTab('tab-3')">Appointments</a>
                        </li>
                        <li>
                            <a href="javascript:void(0);">
                                <form action="logout.php">
                                <button type="submit">Log out</button>
                                </form>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="main">
                <div class="main-inner-wrapper">
                    <!-- Tab 3 -->
                    <div class="tab" id="tab-3">
                        <h2 class="title">Awaiting Appointments</h2>
                        <div class="main-grid-container" >
                            <?php 
                              $sql = "SELECT * FROM appointments WHERE doctor_id = '$doctor_id' and status = 0";
                              $result = $conn->query($sql);
                              if ($result->num_rows > 0) {
                                // output data of each row
                              while($row = $result->fetch_assoc()) { ?>

                              <!-- Appointment One -->
                              <div class="appointments-grid-item">
                                <div class="appointment" style="text-align: left;">
                                  <p><b>Appointment Type:</b> <?php echo $row['appointment_type']?></p>
                                  <p><b>Service Type:</b> <?php echo $row['service_type']?></p>
                                  <p><b>Doctor:</b> <?php echo $row['doctor_id']?></p>
                                  <p><b>Time:</b> <?php echo $row['appointment_time']?></p>
                                  <p><b>Date:</b> <?php echo date("d/m/Y",strtotime($row['appointment_date']));?></p>
                                </div> <br>
                                <div>
                                  <button><a href="appointment-details.php?id=<?= $row['id']?>" style="text-decoration: none;">View Details</a></button>
                                </div>
                              </div>
                              <?php
                                  }
                                } else {
                                  echo "0 appointments";
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Tab 4 -->
                    
                </div>
            </div>
        </div>
    </section>


    <!-- sidebar tab script -->
    <script>
        function openTab(tabNumber) {
          var i;
          var x = document.getElementsByClassName("tab");
          for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";  
          }
          document.getElementById(tabNumber).style.display = "grid";  
        }
    </script>
</body>
</html>