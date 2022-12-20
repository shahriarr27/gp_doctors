<?php 
    session_start();
    include_once 'db_con.php';
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
                            <a role="button" onclick="openTab('tab-4')">Patient</a>
                        </li>
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
                    <!-- Tab 4 -->
                    <div class="tab" id="tab-4">
                        <div class="new-note-wrapper">
                            <h2 class="title">All Pateint</h2>
                            <?php
                                $sql = "SELECT * FROM users WHERE role= 2";
                                if($result = mysqli_query($conn, $sql)){
                                    if(mysqli_num_rows($result) > 0){
                            ?>
                            <table width=100% class="admin-panel-form">
                                <thead style="text-align: left;">
                                    <th>Name</th>
                                    <th>Adress</th>
                                    <th>Birth Date</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php
                                    while($patient = mysqli_fetch_array($result)){ 
                                    ?>
                                    <tr>
                                        <td><?php echo $patient['name']?></td>
                                        <td><?php echo $patient['address']?></td>
                                        <td><?php echo $patient['date_of_birth']?></td>
                                        <td>
                                            <button><a style="text-decoration: none;" href="edit-patient.php?id=<?php echo $patient['id'];?>">Edit</a></button>
                                            <form action="edit-patient.php" method="POST" style="display: inline-block;">
                                                <button onclick="return confirm('Are you sure you want to delete this item?');" type="submit" value="<?= $patient['id']?>" name="delete-patient">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <?php }
                                else{
                                    echo "No records matching your query were found.";
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