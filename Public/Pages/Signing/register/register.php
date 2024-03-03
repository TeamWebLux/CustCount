<!DOCTYPE html>
<html lang="en">

<head>
    <?php

    include "./Public/Pages/Common/header.php";
    ?>
    <?php
    session_start(); // Ensure session is started

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
    ?>
    <title>REGISTER PAGE</title>
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body ">
                <img src="https://templates.iqonic.design/product/qompac-ui/html/dist/assets/images/loader.webp" alt="loader" class="image-loader img-fluid ">
            </div>
        </div>
    </div>
    <!-- loader END -->
    <div class="wrapper">
        <section class="login-content overflow-hidden">
            <div class="row no-gutters align-items-center bg-white">
                <div class="col-md-12 col-lg-6 align-self-center">
                    <div class="row justify-content-center">
                        <div class="col-md-12 col-lg-6 align-self-center">
                            <a href="../index.html" class="navbar-brand d-flex align-items-center mb-3 justify-content-center text-primary">
                                <div class="logo-normal">
                                    <svg class="" viewBox="0 0 32 32" width="80px" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M7.25333 2H22.0444L29.7244 15.2103L22.0444 28.1333H7.25333L0 15.2103L7.25333 2ZM11.2356 9.32316H18.0622L21.3334 15.2103L18.0622 20.9539H11.2356L8.10669 15.2103L11.2356 9.32316Z" fill="currentColor" />
                                        <path d="M23.751 30L13.2266 15.2103H21.4755L31.9999 30H23.751Z" fill="#3FF0B9" />
                                    </svg>
                                </div>
                                <h2 class="logo-title ms-3 mb-0" data-setting="app_name">Qompac UI</h2>
                            </a>
                        </div>
                        <div class="col-md-9">
                            <div class="card auth-card  d-flex justify-content-center mb-0">
                                <div class="card-body">
                                    <h2 class="mb-2 text-center">Sign Up</h2>
                                    <p class="text-center">Create your Qompac UI account.</p>
                                    <form action="../App/Logic/register.php" method="POST">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="fullname" class="form-label">Full Name</label>
                                                    <input class="form-control" type="text" id="fullname" name="fullname" placeholder="Enter your name" required="" value="<?php echo isset($_SESSION['form_values']['fullname']) ? htmlspecialchars($_SESSION['form_values']['fullname']) : ''; ?>">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="username" class="form-label">User Name</label>
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
                                                <label for="role" class="form-label">Role</label>
                                                <select class="form-select" id="role" name="role" required="">
                                                    <option value="">Select your role</option>
                                                    <option value="User" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'User') ? 'selected' : ''; ?>>User</option>
                                                    <option value="Agent" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Agent') ? 'selected' : ''; ?>>Agent</option>
                                                    <option value="Supervisor" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Supervisor') ? 'selected' : ''; ?>>Supervisor</option>
                                                    <option value="Manager" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Manager') ? 'selected' : ''; ?>>Manager</option>
                                                    <option value="Admin" <?php echo (isset($_SESSION['form_values']['role']) && $_SESSION['form_values']['role'] == 'Admin') ? 'selected' : ''; ?>>Admin</option>
                                                </select>
                                            </div>

                                            <div class="col-lg-12 d-flex justify-content-center">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="checkbox-signup" name="terms" <?php echo (isset($_SESSION['form_values']['terms']) && $_SESSION['form_values']['terms'] == 'on') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="checkbox-signup">I accept <a href="javascript: void(0);" class="text-muted">Terms and Conditions</a></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">Sign Up</button>
                                        </div>
                                        <p class="text-center my-3">or sign in with other accounts?</p>
                                        <div class="d-flex justify-content-center">
                                            <ul class="list-group list-group-horizontal list-group-flush">
                                                <li class="list-group-item border-0 pb-0">
                                                    <a href="#"><img src="https://templates.iqonic.design/product/qompac-ui/html/dist/assets/images/brands/gm.svg" alt="gm" loading="lazy"></a>
                                                </li>
                                                <li class="list-group-item border-0 pb-0">
                                                    <a href="#"><img src="https://templates.iqonic.design/product/qompac-ui/html/dist/assets/images/brands/fb.svg" alt="fb" loading="lazy"></a>
                                                </li>
                                                <li class="list-group-item border-0 pb-0">
                                                    <a href="#"><img src="https://templates.iqonic.design/product/qompac-ui/html/dist/assets/images/brands/im.svg" alt="im" loading="lazy"></a>
                                                </li>
                                                <li class="list-group-item border-0 pb-0">
                                                    <a href="#"><img src="https://templates.iqonic.design/product/qompac-ui/html/dist/assets/images/brands/li.svg" alt="li" loading="lazy"></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <p class="mt-3 text-center">
                                            Already have an Account <a href="./Login_to_CustCount" class="text-underline">Sign In</a>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-block d-none bg-primary p-0  overflow-hidden">
                    <img src="../assets/images/auth/01.png" class="img-fluid gradient-main" alt="images" loading="lazy">
                </div>
            </div>
        </section>
    </div>
    <!-- end page -->

    <!-- end page -->


    <?php include "./Public/Pages/Common/scripts.php" ?>

</body>

</html>