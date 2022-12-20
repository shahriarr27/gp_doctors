<?php 
    session_start();
    include 'db_con.php';
    if(isset($_GET['id'])){
     $app_id = $_GET['id'];
    };

    if(isset($_POST['add-note'])){
      $user_id = $_POST['user_id'];
      $doctor = $_POST['doctor'];
      $appointment_id = $_POST['appointment_id'];
      $note_title = $_POST['note_title'];
      $note_description = $_POST['note_description'];
      $remind_date = $_POST['remind_date'];
      $medicines = $_POST['medicines'];

      $sql = "INSERT INTO notes(user_id,  appointment_id, doctor, note_title, note_description, remind_date, medicines) VALUES ('$user_id',  '$appointment_id','$doctor', '$note_title', '$note_description', '$remind_date', '$medicines')";

      if (mysqli_query($conn, $sql)) {
        $successmessage = "Note created successfully";
        $sql = "UPDATE appointments SET status = 1 where id = $appointment_id";
        mysqli_query($conn, $sql);
        header("location: doctor-dashboard.php");
      } else {
        echo "Error: " . $sql . " " . mysqli_error($conn);
      }

  mysqli_close($conn);
  }

?>