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

    ?>

</head>

<body class="  ">
    <!-- loader Start -->
    <?php
    include("./Public/Pages/Common/loader.php");

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

            <br>
            <br>
            <div class="col-md-9">
                <div class="card auth-card  d-flex justify-content-center mb-0">
                    <div class="card-body">
                        <h2 class="mb-2 text-center">Create Users</h2>
                        <p class="text-center">Create your users account.</p>
                        <form action="../App/Logic/add_users.php" method="POST">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fullname" class="form-label">Facebook Name</label>
                                        <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Enter your name" required="" value="<?php echo isset($_SESSION['form_values']['fullname']) ? htmlspecialchars($_SESSION['form_values']['fullname']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="username" class="form-label">Userid</label>
                                        <input class="form-control" type="text" id="username" name="username" placeholder="Enter your user-name" required="" value="<?php echo isset($_SESSION['form_values']['username']) ? htmlspecialchars($_SESSION['form_values']['username']) : ''; ?>">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <input class="form-control" type="password" id="password" name="password" placeholder="Enter your password" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="referal" class="form-label">Referal</label>
                                        <input class="form-control" type="text" id="referal" name="password" placeholder="Enter Referal code" required="">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-select" id="role" name="role" required="">
                                        <!-- <option value="">Select your role</option> -->
                                        <?php 
                                        if ($_SESSION['role']=='User') {
                                            
                                            ?>

                                     
                                            
                                            
                                            
                                            <?php 
                                        }elseif ($_SESSION['role']=='Agent') {
                                            ?>
                                            <option value="User" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'User') ? 'selected' : ''; ?>>User</option>
                                        
                                            <?php 
                                        }
                                        elseif ($_SESSION['role']=='Supervisor') {
                                            ?>
                                            <option value="User" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'User') ? 'selected' : ''; ?>>User</option>
                                        <option value="Agent" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Agent') ? 'selected' : ''; ?>>Agent</option>
                                        
                                            <?php 
                                            
                                        }
                                        elseif ($_SESSION['role']=='Manager') {
                                            ?>
                                            <option value="User" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'User') ? 'selected' : ''; ?>>User</option>
                                        <option value="Agent" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Agent') ? 'selected' : ''; ?>>Agent</option>
                                        <option value="Supervisor" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                                        
                                            <?php 
                                            
                                        }
                                        elseif ($_SESSION['role']=='Admin') {
                                            ?>
                                            <option value="User" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'User') ? 'selected' : ''; ?>>User</option>
                                        <option value="Agent" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Agent') ? 'selected' : ''; ?>>Agent</option>
                                        <option value="Supervisor" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                                        <option value="Manager" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Manager') ? 'selected' : ''; ?>>Manager</option>
                                        
                                            <?php 
                                            
                                        }
                                        ?>
                                    </select>
                                </div>
                                

                                <div class="col-lg-12 d-flex justify-content-center">
                                    
                                </div>
                            </div>
                            
                            <br>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Sign Up</button>
                            </div>

                        </form>
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