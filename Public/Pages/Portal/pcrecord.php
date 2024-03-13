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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    // Store GET parameters in session
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        foreach ($_GET as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }
    if (isset($_SESSION['timezone'])) {
        $selectedTimezone = $_SESSION['timezone'];
        // Set the default timezone to the selected timezone
        date_default_timezone_set($selectedTimezone);
    }

    // foreach ($_SESSION as $key => $value) {
    //     echo "$key => $value<br>";
    // }


    $role = $_SESSION['role'];
    if (in_array($role, ['Agent', 'Supervisor', 'Manager', 'Admin'])) {
    } else {
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
                    <form method="GET" action="#">
                        <input type="hidden" name="u" value="<?php echo isset($_SESSION['u']) ? htmlspecialchars($_SESSION['u']) : ''; ?>">
                        <input type="hidden" name="r" value="<?php echo isset($_SESSION['r']) ? htmlspecialchars($_SESSION['r']) : ''; ?>">

                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <label for="start_date" class="col-form-label">Start Date:</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo isset($_SESSION['start_date']) ? htmlspecialchars($_SESSION['start_date']) : ''; ?>">
                            </div>
                            <div class="col-auto">
                                <label for="end_date" class="col-form-label">End Date:</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo isset($_SESSION['end_date']) ? htmlspecialchars($_SESSION['end_date']) : ''; ?>">
                            </div>
                            <label for="timezone">Select Timezone:</label>
                            <select name="timezone" id="timezone">
                                <option value="America/New_York" <?php echo ($_SESSION['timezone'] ?? '') === 'America/New_York' ? 'selected' : ''; ?>>EST (America/New York)</option>
                                <option value="America/Chicago" <?php echo ($_SESSION['timezone'] ?? '') === 'America/Chicago' ? 'selected' : ''; ?>>CST (America/Chicago)</option>
                                <option value="Asia/Kolkata" <?php echo ($_SESSION['timezone'] ?? '') === 'Asia/Kolkata' ? 'selected' : ''; ?>>IST (Asia/Kolkata)</option>
                                <!-- Add more timezone options as needed -->
                            </select>

                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>

                        </div>
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

                        if ($action = "PLATFORMREC") {
                            $u =  $_SESSION['r'];
                            $sql = "select * from platformRecord where platform='$u'";
                            // $result = $conn->query($sql);
                        } elseif ($action = "PLATFORMREC"  || $_SESSION['u']) {
                            $u =  $_SESSION['u'];
                            $sql = "select * from cashappRecord where name='$u'";
                             echo $sql;
                            // $result = $conn->query($sql);
                        }
                        // if ($_SERVER["REQUEST_METHOD"] == "GET") {
                        if (isset($_SESSION['start_date']) && isset($_SESSION['end_date']) && $_SESSION['start_date'] !== '' && $_SESSION['end_date'] !== '') {
                            // Both start and end dates are provided
                            $start_date = $_SESSION['start_date'];
                            $end_date = $_SESSION['end_date'];
                            $sql .= " AND created_at BETWEEN '$start_date 00:00:00' AND '$end_date 23:59:59'";
                        } elseif (isset($_SESSION['start_date']) && !isset($_SESSION['end_date']) && $_SESSION['start_date'] !== '') {
                            // Only start date is provided
                            $start_date = $_SESSION['start_date'];
                            $sql .= " AND created_at >= '$start_date 00:00:00'";
                        } elseif (!isset($_SESSION['start_date']) && isset($_SESSION['end_date']) && $_SESSION['end_date'] !== '') {
                            // Only end date is provided
                            $end_date = $_SESSION['end_date'];
                            $sql .= " AND created_at <= '$end_date 23:59:59'";
                        } elseif (isset($_SESSION['start_date']) && isset($_SESSION['end_date']) && $_SESSION['start_date'] !== '' && $_SESSION['end_date'] === '') {
                            // Only start date is provided and end date is empty
                            $start_date = $_SESSION['start_date'];
                            $sql .= " AND created_at >= '$start_date 00:00:00'";
                        }
                        // }
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