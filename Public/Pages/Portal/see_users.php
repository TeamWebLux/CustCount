
?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <?php
    include("./Public/Pages/Common/header.php");
    include "./Public/Pages/Common/auth_user.php";

    // Function to echo the script for toastr
    function echoToastScript($type, $message)
    {
        echo "<script type='text/javascript'>document.addEventListener('DOMContentLoaded', function() { toastr['$type']('$message'); });</script>";
    }

    // Check if there's a toast message set in session, display it, then unset
    print_r($_SESSION);
    if (isset($_SESSION['toast'])) {
        $toast = $_SESSION['toast'];
        echoToastScript($toast['type'], $toast['message']);
        unset($_SESSION['toast']); // Clear the toast message from session
    }

    if (session_status() !== PHP_SESSION_ACTIVE) session_start();

    // Display error message if available
    if (isset($_SESSION['login_error'])) {
        echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
        unset($_SESSION['login_error']); // Clear the error message
    }

    ?>
                   

<?php
$role = $_SESSION['role'];
if (in_array($role, ['Agent', 'Supervisor', 'Manager', 'Admin'])) {
    // The user is a manager, let them stay on the page
     // You can continue to load the rest of the page here
} else {
    // The user is not a manager, redirect them to the login page
    header('Location: ./Login_to_CustCount'); // Replace 'login.php' with the path to your login page
    exit(); // Prevent further execution of the script
}
?>
</head>

<body class="  ">
    <!-- loader Start -->
    <?php
    // include("./Public/Pages/Common/loader.php");

    ?>
    <!-- loader END -->

    <!-- sidebar  -->
    <?php
    include("./Public/Pages/Common/sidebar.php");

    ?>

    <main class="main-content">
        <?php
        include("./Public/Pages/Common/main_content.php");
        ?>


        <div class="content-inner container-fluid pb-0" id="page_layout">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">User List</h4>
                        </div>
                        <?php
                        include './App/db/db_connect.php';
                        if ($role === 'Admin') {
                            $sql = "SELECT * FROM user";
                            // No parameters needed for Admin
                        } elseif ($role === 'Manager') {
                            $sql = "SELECT * FROM user WHERE Role IN ('Agent', 'User', 'Supervisor')";
                            $params = [];
                        } elseif ($role === 'Supervisor') {
                            $sql = "SELECT * FROM user WHERE Role IN ('Agent', 'User')";
                            $params = [];
                        } elseif ($role === 'Agent') {
                            $sql = "SELECT * FROM user WHERE Role = 'User'";
                            $params = [];
                        }
                        

                        $result = $conn->query($sql);


                        if ($result->num_rows > 0) {
                            ?>
                        <div class="card-body">
                            <div class="custom-table-effect table-responsive  border rounded">
                                <table class="table mb-0" id="datatable" data-toggle="data-table">
                                    <thead>
                                        <tr class="bg-white">
                                            <?php 
                                            echo '<tr>
                                            
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Last Login</th>
                                            </tr>';
                        ?>
                        <thead>
                        <tbody>
                        <?php
                                            while ($row = $result->fetch_assoc()) {
                                                echo "<tr>
                                                    
                                                    <td>{$row['id']}</td>
                                                    <td>{$row['username']}</td>
                                                    <td>{$row['name']}</td>
                                                    <td>{$row['password']}</td>
                                                    <td>{$row['role']}</td>
                                                    <td>{$row['created_at']}</td> <!-- Consider if you really want to display passwords -->
                                                    <td>{$row['last_login']}</td>
                                                   
                                                  </tr>";
                                            }
                                            ?>
                        
                        </tbody>
                        <?php
                
                                            // End table
                                            echo '</table>';
                                        } else {
                                            echo "0 results";
                                        }
                
                                        // Close connection
                                        $conn->close();
                                        ?>
                                      
                                        
                                    
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
       






            <?
            include("./Public/Pages/Common/footer.php");
            // print_r($_SESSION);
            ?>

    </main>
    <!-- Wrapper End-->
    <!-- Live Customizer start -->
    <!-- Setting offcanvas start here -->
    <?php
    include("./Public/Pages/Common/theme_custom.php");

    ?>

    <!-- Settings sidebar end here -->

    <?php
    include("./Public/Pages/Common/settings_link.php");

    ?>
    <!-- Live Customizer end -->

    <!-- Library Bundle Script -->
    <?php
    include("./Public/Pages/Common/scripts.php");

    ?>

</body>

</html>