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
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['timezone'])) {
        $selectedTimezone = $_POST['timezone'];
        // Set the default timezone to the selected timezone
        date_default_timezone_set($selectedTimezone);
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
                    <form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <!-- Include $u in a hidden input field -->
                        <input type="hidden" name="u" value="<?php echo isset($_GET['u']) ? htmlspecialchars($_GET['u']) : ''; ?>">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="start_date" class="col-form-label">Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date">
                            </div>
                            <div class="col-auto">
                                <label for="end_date" class="col-form-label">End Date:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <label for="timezone">Select Timezone:</label>
                        <select name="timezone" id="timezone">
                            <option value="America/New_York">EST (America/New York)</option>
                            <option value="America/Chicago">CST (America/Chicago)</option>
                            <option value="Asia/Kolkata">IST (Asia/Kolkata)</option>
                            <!-- Add more timezone options as needed -->
                        </select>
                        <button type="submit">Set Timezone</button>
                    </form>


                    <div class="card">
                        <div class="card-header">
                            <h4 class="mb-0">User List</h4>

                        </div>
                        <?php
                        include './App/db/db_connect.php';
                        $segments = explode('/', rtrim($uri, '/'));
                        $lastSegment = end($segments);
                        $action = strtoupper($lastSegment);
                        // echo $action;
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (isset($_POST['start_date']) && isset($_POST['end_date'])) {
                                $_SESSION['start_date'] = $_POST['start_date'];
                                $_SESSION['end_date'] = $_POST['end_date'];
                            }
                        }

                        if ($action = "PLATFORMREC" && isset($_GET['r'])) {
                            $u = $_GET['r'];
                            $sql = "select * from platformRecord where platform='$u'";
                            // $result = $conn->query($sql);
                        } elseif ($action = "PLATFORMREC" && isset($_GET['u'])) {
                            $u = $_GET['u'];
                            $sql = "select * from cashappRecord where name='$u'";
                            // $result = $conn->query($sql);
                        }
                        if ($_SERVER["REQUEST_METHOD"] == "GET") {
                            if (isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['start_date'] !== '' && $_GET['end_date'] !== '') {
                                // Both start and end dates are provided
                                $start_date = $_GET['start_date'];
                                $end_date = $_GET['end_date'];
                                $sql .= " AND created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
                            } elseif (isset($_GET['start_date']) && !isset($_GET['end_date']) && $_GET['start_date'] !== '') {
                                // Only start date is provided
                                $start_date = $_GET['start_date'];
                                $sql .= " AND created_at >= '$start_date 00:00:00'";
                            } elseif (!isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['end_date'] !== '') {
                                // Only end date is provided
                                $end_date = $_GET['end_date'];
                                $sql .= " AND created_at <= '$end_date 23:59:59'";
                            } elseif (isset($_GET['start_date']) && isset($_GET['end_date']) && $_GET['start_date'] !== '' && $_GET['end_date'] === '') {
                                // Only start date is provided and end date is empty
                                $start_date = $_GET['start_date'];
                                $sql .= " AND created_at >= '$start_date 00:00:00'";
                            }
                        }


                        $result = $conn->query($sql);

                        // if (isset($_POST)) {
                        //     print_r($_POST);
                        //     $condition = $_POST['field'];
                        //     $query = $_POST['condtion'];
                        //     $sql = "select * from transaction where $condition='$query'";
                        //     $result = $conn->query($sql);
                        // }

                        if ($result->num_rows > 0) {
                        ?>
                            <div class="card-body">
                                <div class="custom-table-effect table-responsive  border rounded">
                                    <table class="table mb-0" id="example">
                                        <thead>
                                            <tr class="bg-white">
                                                <?php
                                                echo '<tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Amount</th>

                                            <th scope="col">By Name</th>
                                            <th scope="col">Created At</th>
                                            </tr>';
                                                ?>
                                                <thead>
                                                <tbody>
                                                    <?php
                                                    while ($row = $result->fetch_assoc()) {
                                                        // Convert timestamp to selected timezone
                                                        $createdAt = new DateTime($row['created_at'], new DateTimeZone('UTC'));
                                                        $createdAt->setTimezone(new DateTimeZone($selectedTimezone));
                                                        $createdAtFormatted = $createdAt->format('Y-m-d H:i:s');

                                                        // Output the table row with the converted timestamp
                                                        echo "<tr> 
        <td>" . (isset($row['prid']) ? $row['prid'] : $row['crid']) . "</td>
        <td>{$row['type']}</td>
        <td>{$row['amount']}</td>
        <td>{$row['by_name']}</td>
        <td>{$createdAtFormatted}</td>
    </tr>";
                                                    }
                                                    ?> </tbody>
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