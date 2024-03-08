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

    // print($uri);
    ?>
    <!-- css -->
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .cashin {
            color: green;
        }

        .cashout {
            color: red;
        }
    </style>


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
            include "./App/db/db_connect.php";

            if($_GET['u']){

            $sql = "SELECT 'CashIn' AS transaction_type, deposit_amount, added_time, username FROM deposits WHERE username = ?
        UNION ALL
        SELECT 'CashOut', cashoutamount, timestamp, username FROM cashOut WHERE username = ?";
                    $username = $_GET['u'];

            } elseif($_GET['a']){
                $sql = "SELECT 'CashIn' AS transaction_type, deposit_amount, added_time, username FROM deposits WHERE by_username = ?
                UNION ALL
                SELECT 'CashOut', cashoutamount, timestamp, username FROM cashOut WHERE by_username = ?";
                            $username = $_GET['a'];
        
            }

            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ss', $username, $username); 
            $stmt->execute();
            $result = $stmt->get_result();
            $results = $result->fetch_all(MYSQLI_ASSOC);
            // print_r($results);
            $stmt->close();
            $conn->close();
            usort($results, function ($a, $b) {
                return strtotime($b['added_time']) - strtotime($a['added_time']);
            });
            
            ?>

<table>
        <thead>
            <tr>
                <th>Transaction Type</th>
                <th>Amount</th>
                <th>Timestamp</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $row): ?>
                <tr>
                    <td class="<?= ($row['transaction_type'] === 'CashIn') ? 'cashin' : 'cashout' ?>">
                        <?= $row['transaction_type'] ?>
                    </td>
                    <td><?= $row['deposit_amount'] ?></td>
                    <td><?= $row['added_time'] ?></td>
                    <td><?= $row['username'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


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