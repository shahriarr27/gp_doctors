<?php 
    include_once 'db_con.php';
    session_start();
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
          <!-- Tab 1 -->
          <div class="tab" id="tab-1">
            <div class="new-note-wrapper">
              <h2 class="title">Add Medical Note</h2>
              <div  class="admin-panel-form" style="margin-bottom: 25px;">
                <h2>Patient Details</h2>
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
              <form action="add-notes.php" class="admin-panel-form" method="POST">
                <h2>Add note</h2>
                <label for="note-title">Title</label><br>
                <input type="text" id="note-title" name="note_title"><br><br>
                <label for="description">Description</label><br>
                <textarea name="note_description" data-gramm="false" wt-ignore-input="true"
                  data-quillbot-element="afQ_9PwZahp9sg7J2t9nQ"></textarea><br><br>
                <label for="remind_date">Remind Date</label><br>
                <input type="date" id="remind_date" name="remind_date"><br><br>
                <h2>Add Medicines</h2>
                <label for="description">Medicines</label><br>
                <textarea name="medicines" data-gramm="false" wt-ignore-input="true"
                  data-quillbot-element="afQ_9PwZahp9sg7J2t9nQ"></textarea><br><br>
                  <input type="hidden" name="user_id" value="<?= $user_id?>">
                  <input type="hidden" name="appointment_id" value="<?= $app_id?>">
                  <input type="hidden" name="doctor" value="<?= $doctor_id?>">
                <input type="submit" name="add-note" value="Save" class="submit-button">
              </form>
            </div>
          </div>

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