<?php 

session_start(); 

include "db_con.php";

if (isset($_POST['submit'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $email = validate($_POST['email']);

    $pass = validate($_POST['password']);

    if (empty($email)) {

        header("Location: login.php?error=User email is required");
        // echo "email is required";
        exit();

    }else if(empty($pass)){

        header("Location: login.php?error=Password is required");
        // echo "password is required";
        exit();

    }else{

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['email'] === $email && $row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['email'] = $row['email'];

                $_SESSION['name'] = $row['name'];

                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];

                if($row['role'] === '1'){
                    header("Location: admin-panel.php");
                }
                else if($row['role'] === '2'){
                    header("Location:appointments-booking.php");
                }
                else if($row['role'] === '3'){
                    header("Location: doctor-dashboard.php");
                }

                exit();

            }else{

                header("Location: login.php?error=Incorect User name or password");

                exit();

            }

        }else{

            header("Location: login.php?error=Incorect User name or password");

            exit();

        }

    }

}
else{

    // header("Location: index.html");
    echo "error";
    exit();

}