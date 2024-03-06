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
    // print_r($_SESSION);
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

    // print($uri);
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


            <?php
            include './App/db/db_connect.php';

            print_r($_POST);
            $user = $_POST['state'];
            echo $user;
            $username = $conn->real_escape_string($_POST['state']);

            // Prepare the SQL statement
            $sql = "SELECT * FROM pages WHERE page_name = '$username'";

            // Execute the query
            $result = $conn->query($sql);

            // Check if query was successful

            ?>

<div class="content-inner container-fluid pb-0" id="page_layout">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0"><?php echo $user; ?> Details</h4>
                        </div>
                        <div class="card-body">
                        <div class="custom-table-effect table-responsive  border rounded">
                            <?php

                            if ($result) {
                                // Fetch the results
                                echo '<table class="table mb-0">';
                               
                                echo '<tr>
                                <th scope="col">ID</th>
                                            <th scope="col">Page Name</th>
                                            <th scope="col">Added By</th>
                                            <th scope="col">Page Unique Id</th>
                                            <th scope="col">Created At</th>
                                </tr>';
                                while ($row = $result->fetch_assoc()) {
                                    // Output column names as table headers
                                    
                                   
                                    echo "<tr>";
                                    echo "<td>".$row['page_id']."</td>";
                                    echo "<td>".$row['page_name']."</td>";
                                    echo "<td>".$row['added_by']."</td>";
                                    echo "<td>".$row['page_unique_id']."</td>";
                                    echo "<td>".$row['createdAt']."</td>";
                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "Error: " . $conn->error;
                            }
                            ?>
                        </div>
<br>
<br>

                            <button type="button" class="btn btn-danger rounded-pill mt-2">Delete Page</button>
                            <button type="button" class="btn btn-success rounded-pill mt-2">Allocate Page</button>
                            <button type="button" class="btn btn-warning rounded-pill mt-2">Edit Page</button>
                            <button type="button" class="btn btn-light rounded-pill mt-2">Page Record</button>
                            <button type="button" class="btn btn-success rounded-pill mt-2">Page is Active</button>
                            <button type="button" class="btn btn-secondary rounded-pill mt-2">Page History</button>
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