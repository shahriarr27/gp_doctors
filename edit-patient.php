<?php 
    session_start();
    include_once 'db_con.php';
    if(isset($_POST['update-user']))
    {	 
      $user_id = $_POST['user_id'];
      $name = $_POST['name'];
      $address = $_POST['address'];
      $date_of_birth = $_POST['date_of_birth'];

      $sql = "UPDATE users SET name = '$name', address = '$address', date_of_birth = '$date_of_birth' where id = '$user_id'";
      if (mysqli_query($conn, $sql)) {
        $successmessage = "Appointment updated successfully";
        header("location: admin-panel.php");
      } else {
        echo "Error: " . $sql . "
    " . mysqli_error($conn);
      }
      mysqli_close($conn);
    }

    if(isset($_POST['delete-patient']))
    {   
      $user_id = $_POST['delete-patient'];
      $sql = "DELETE FROM users WHERE id = '$user_id'";
      if (mysqli_query($conn, $sql)) {
        $successmessage = "Patient deleted successfully";
        header("location: admin-panel.php");
      }
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
              <a href="#" onclick="openTab('tab-4')">Patient</a>
            </li>
          </ul>
        </div>
      </div>

      <div class="main">
        <div class="main-inner-wrapper">
          <!-- Tab 4 -->
          <div class="tab" id="tab-4">
            <div class="new-note-wrapper">
              <h2 class="title">Edit patient</h2>
              <?php 
                if(isset($_GET['id'])){
                  $user_id = $_GET['id'];
                  $patient = "SELECT * FROM users WHERE id = $user_id";
                  $query_run = mysqli_query($conn,$patient); 

                  if(mysqli_num_rows($query_run) > 0){
                    foreach($query_run as $single_patient){ ?>
                    <form action="edit-patient.php" class="admin-panel-form" method="POST">
                      <input type="text" name="user_id" value="<?= $single_patient['id']?>" hidden>
                        <label for="name">Name</label><br>
                        <input type="text" id="name" name="name" value="<?= $single_patient['name']?>"><br><br>
                        <label for="address">Address</label><br>
                        <textarea name="address" data-gramm="false" wt-ignore-input="true" data-quillbot-element="afQ_9PwZahp9sg7J2t9nQ"><?= $single_patient['address']?></textarea><br><br>
                        <label for="birthday">Birth date</label><br>
                        <input type="date" id="birthday" name="date_of_birth" value="<?= $single_patient['date_of_birth']?>"><br><br>
                        <input type="submit" value="Update Info" name="update-user" class="submit-button">
                    </form> 
                  <?php  }
                  }
                  else{
                    echo 'User not found!';
                  }
                }
              ?>
              
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