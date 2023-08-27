
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootsrap/bootstrap.min.css">
    <script src="assets/bootsrap/bootstrap.bundle.min.js"></script>
    <script src="assets/bootsrap/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../assets/bootstrap/bootstrap-icons.css">
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css">

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="assets/bootsrap/fontawsome-all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">
    <link rel="manifest" href="manifest.json">
    <link rel="manifest" href="../manifest.json">
    <title>BABTSC</title>
    <style>
        .footer {
            position: relative;
            left: 0;
            bottom: 0;
            /* background-color: red; */
            color: rgb(7, 7, 7);
            text-align: left;
        }
    
        .custom-card {
            width: 200px; /* Adjust the width as per your preference */
            max-height: 150px;
        }

        a {
            text-decoration: none;
        }

        .btn-light.active {
            background-color: skyblue !important;
        }

        .nav_class {
            display: flex;
            justify-content: space-between;
          }

        .nav_item {
            padding: 0.5em;
        }
        .nav-item {
          margin-right: 2%;
        }

        /* Media query for smaller screens */
        @media screen and (max-width: 400px) {
            .nav_item {
                font-size: 14px; /* Reduce the text size for smaller screens */
            }
        }
    </style>
</head>
<body style="background-color: white;">
    <ul class="nav justify-content-end navbar-dark bg-dark" style="width: 100%;">
        <?php
        if ($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'Super Admin') {
            echo "<li class='nav_class'>";
            echo "<div class='nav_item'>";
            echo "<ul class='nav'>";
            echo "<li class='nav-item'>";
            echo "<div class='btn-group'>";
            echo "<a class='btn btn-light" . (basename($_SERVER['PHP_SELF']) == 'admin.php' ? ' active' : '') . "' href='../admin/admin.php'>Home</a>";
            echo "<a class='btn btn-light" . (basename($_SERVER['PHP_SELF']) == 'drivers.php' ? ' active' : '') . "' href='../admin/drivers.php'>Drivers</a>";
            echo "<a class='btn btn-light" . (basename($_SERVER['PHP_SELF']) == 'users.php' ? ' active' : '') . "' href='../admin/users.php'>Users</a>";
            echo "<a class='btn btn-light" . (basename($_SERVER['PHP_SELF']) == 'bus.php' ? ' active' : '') . "' href='../admin/bus.php'>Bus</a>";
            echo "<a class='btn btn-light" . (basename($_SERVER['PHP_SELF']) == 'route.php' ? ' active' : '') . "' href='../admin/route.php'>Routes</a>";
            echo "<a class='btn btn-light" . (basename($_SERVER['PHP_SELF']) == 'reports.php' ? ' active' : '') . "' href='../admin/reports.php'>Reports</a>";
            echo "</div>";
            echo "</li>";
            echo "</ul>";
            echo "</div>";
            echo "</li>";
        }
        ?>
        <?php if ($_SESSION['usertype'] == 'admin' || $_SESSION['usertype'] == 'Super Admin') {
            if (isset($_SESSION["username"])) {
                echo "<li style='color: white;'>", "<p style='padding: 0.5em; margin-right: 2em'>" . $_SESSION["username"] . "</p>", "</li>";
                echo "<li class='nav_item'>";
                echo "<a class='btn btn-danger' href='../logout.php'>", "<center>", "<strong>", 'Logout', "</strong>", "</center>", "</a>";
                echo "</li>";
                echo "</div>";
            }
        } 
                  elseif (($_SESSION['usertype']=='user') ||  ($_SESSION['usertype']=='super user'))  {
                    if (isset($_SESSION["username"]))
                    {
                        echo "<li style='color: white;'>","<p style='padding: 0.5em 3em'>". $_SESSION["username"] . "</p>", "</li>"; 
                        //echo "<li><a class='nav-link' href='../logout.php'><strong><input type='button' value='logout'></strong></a></li>";
                    }                   
                    echo "<div style='padding: 0.5em'>";
                    echo "<li class='nav-item'>";
                  
                      echo  "<div class='dropdown'>";
                                      echo  "<button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false' style='background-color: rgba(170, 165, 165, 0.842); cursor: pointer; margin-right: 4em;''>";
                                      echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='white' class='bi bi-person-circle' viewBox='0 0 16 16'>";
                                echo "<path d='M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z'/>";
                                echo "<path fill-rule='evenodd' d='M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z'/>";
                                echo "</svg>";
                                      echo  "</button>";
                                      echo  "<div class='dropdown-menu' aria-labelledby='dropdownMenuButton2' style='background-color: white; margin-right: 4em;'>";
                                      
                                        echo  "<a class='dropdown-item' onclick='resetFieldValue()' href='logout.php'>Log out</a>";
                                        echo  "</div>";
                                        echo  "</div>";  
                    echo "</li>";
                    echo "</div>";
                  }
                    ?>
</ul>
                    