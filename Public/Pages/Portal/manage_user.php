?>
<!doctype html>
<html lang="en" dir="ltr">

<>
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
            <?php
            include './App/db/db_connect.php';
            $sql = "SELECT * FROM users";

            $result = $conn->query($sql);

            // Check if there are results

            if ($result->num_rows > 0) {

            ?>


                <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userModalLabel">User Details</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p id="userDetails">Select a user to see more details.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-inner container-fluid pb-0" id="page_layout">


                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between">
                                    <div class="header-title">
                                        <h4 class="card-title">Search User</h4>
                                        <p>User by name</p>
                                    </div>
                                </div>

                                <!-- Select Dropdown -->


                                <div class="card-body">
                                    <!-- <form action="" method="POST"> -->
                                    <select class="select2-basic-single js-states form-select form-control" name="state" id="userSelect" style="width: 100%;">
                                        <option value="#">Select User</option>
                                        <?php
                                        while ($row = $result->fetch_assoc()) {

                                        ?>

                                            <option value="<?php echo $row['Username'] ?>"> <?php echo $row['Username'] ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                    </select>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">User List</h4>
                                </div>
                                <?php
                                // include './App/db/db_connect.php';
                                $sql = "SELECT * FROM users";

                                $result = $conn->query($sql);

                                // Check if there are results

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
                                            <th scope="col">Update</th>
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
                                                    
                                                    <td>{$row['UserID']}</td>
                                                    <td> <button type=\"button\" class=\"btn btn-outline-success rounded-pill mt-2\">Upadate</button> </td>
                                                    <td>{$row['Username']}</td>
                                                    <td>{$row['fullname']}</td>
                                                    <td>{$row['rawpass']}</td>
                                                    <td>{$row['Role']}</td>
                                                    <td>{$row['CreatedAt']}</td> <!-- Consider if you really want to display passwords -->
                                                    <td>{$row['LastLogin']}</td>
                                                   
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
        <script>
            $(document).ready(function() {
                $('#userSelect').on('change', function() {
                    var selectedValue = $(this).val();
                    if (selectedValue != '#') {
                        // AJAX request to fetch user details
                        $.ajax({
                            url: '../Public/Pages/Portal/get_user_details_on_modal.php', // Path to your PHP script to fetch user details
                            type: 'POST',
                            data: {
                                username: selectedValue
                            },
                            success: function(response) {
                                $('#userDetails').html(response); // Insert fetched user details into modal body
                                $('#userModal').modal('show'); // Show modal
                            }
                        });
                    }
                });
                $('#updateForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'update_user_details.php', // Path to your PHP script to update user details
            type: 'POST',
            data: formData,
            success: function(response) {
                alert(response); // Display success/error message
                $('#userModal').modal('hide'); // Close modal after update
            }
        });
    });
            });
        </script>


        <!-- Library Bundle Script -->
        <script src="../assets/js/core/libs.min.js"></script>
        <!-- Plugin Scripts -->





        <!-- Select2 Script -->
        <script src="../assets/js/plugins/select2.js" defer></script>




        <!-- Slider-tab Script -->
        <script src="../assets/js/plugins/slider-tabs.js"></script>





        <!-- Lodash Utility -->
        <script src="../assets/vendor/lodash/lodash.min.js"></script>
        <!-- Utilities Functions -->
        <script src="../assets/js/iqonic-script/utility.min.js"></script>
        <!-- Settings Script -->
        <script src="../assets/js/iqonic-script/setting.min.js"></script>
        <!-- Settings Init Script -->
        <script src="../assets/js/setting-init.js"></script>
        <!-- External Library Bundle Script -->
        <script src="../assets/js/core/external.min.js"></script>
        <!-- Widgetchart Script -->
        <script src="../assets/js/charts/widgetchartsf700.js?v=1.0.1" defer></script>
        <!-- Dashboard Script -->
        <script src="../assets/js/charts/dashboardf700.js?v=1.0.1" defer></script>
        <!-- qompacui Script -->
        <script src="../assets/js/qompac-uif700.js?v=1.0.1" defer></script>
        <script src="../assets/js/sidebarf700.js?v=1.0.1" defer></script>
        <?php

        // include("./Public/Pages/Common/scripts.php");

        ?>

    </body>

</html>