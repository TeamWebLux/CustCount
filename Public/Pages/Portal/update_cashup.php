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
            $sql = "SELECT * FROM cashups WHERE cashup_name = '$username'";

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
   
    // Output column headers
    echo '<tr>
            <th scope="col">CashApp Unique ID</th>
            <th scope="col">Start Date</th>
            <th scope="col">End Date</th>
            <th scope="col">Opening Balance</th>
            <th scope="col">Page Allocation ID</th>
            <th scope="col">CashApp Name</th>
            <th scope="col">Cash Tag</th>
            <th scope="col">Email Address</th>
            <th scope="col">Status</th>
            <th scope="col">Remarks</th>
          </tr>';

    // Fetch and display each row of data
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row['cashup_unique_id']."</td>";
        echo "<td>".$row['start_date']."</td>";
        echo "<td>".$row['end_date']."</td>";
        echo "<td>".$row['opening_balance']."</td>";
        echo "<td>".$row['page_allocation_id']."</td>";
        echo "<td>".$row['cashup_name']."</td>";
        echo "<td>".$row['cash_tag']."</td>";
        echo "<td>".$row['email_address']."</td>";
        echo "<td>".$row['status']."</td>";
        echo "<td>".$row['remarks']."</td>";
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