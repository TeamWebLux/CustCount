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

            <div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12">

                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <div class="header-title">
                                    <h4 class="card-title">Add Deposit</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="../App/Logic/deposit_db.php" method="post">
                                    <div class="form-group">
                                        <label for="inputname" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="inputname" name="inputname" placeholder="Your Name" value="<?php echo isset($_SESSION['form_values']['inputname']) ? htmlspecialchars($_SESSION['form_values']['inputname']) : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputid" class="form-label">ID</label>
                                        <input type="text" class="form-control" id="inputid" name="inputid" placeholder="fbid instaid" value="<?php echo isset($_SESSION['form_values']['inputid']) ? htmlspecialchars($_SESSION['form_values']['inputid']) : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputreflect" class="form-label">Reflect</label>
                                        <input type="number" class="form-control" id="inputreflect" name="inputreflect" placeholder="Reflect amount" value="<?php echo isset($_SESSION['form_values']['inputreflect']) ? htmlspecialchars($_SESSION['form_values']['inputreflect']) : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBonus" class="form-label">Bonus</label>
                                        <input type="number" class="form-control" id="inputBonus" name="inputBonus" placeholder="Bonus Amount" value="<?php echo isset($_SESSION['form_values']['inputBonus']) ? htmlspecialchars($_SESSION['form_values']['inputBonus']) : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPlatform" class="form-label">Platform</label>
                                        <select id="inputPlatform" class="form-select" name="inputPlatform">
                                            <option selected>Choose...</option>
                                            <option value="Option 1" <?php echo (isset($_SESSION['form_values']['inputPlatform']) && $_SESSION['form_values']['inputPlatform'] == 'Option 1') ? 'selected' : ''; ?>>Option 1</option>
                                            <option value="Option 2" <?php echo (isset($_SESSION['form_values']['inputPlatform']) && $_SESSION['form_values']['inputPlatform'] == 'Option 2') ? 'selected' : ''; ?>>Option 2</option>
                                            <option value="Option 3" <?php echo (isset($_SESSION['form_values']['inputPlatform']) && $_SESSION['form_values']['inputPlatform'] == 'Option 3') ? 'selected' : ''; ?>>Option 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4" class="form-label">Password</label>
                                        <input type="password" class="form-control" id="inputPassword4" name="inputPassword4" placeholder="Password">
                                        <!-- Password fields generally shouldn't retain values for security purposes -->
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Money</label>
                                        <input type="number" class="form-control" name="money" placeholder="Enter money" value="<?php echo isset($_SESSION['form_values']['money']) ? htmlspecialchars($_SESSION['form_values']['money']) : ''; ?>">
                                        <span class="fs-13 text-muted">e.g "Your money in Rupees - ₹"</span>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-danger">Clear</button> <!-- Changed type to 'reset' for the Cancel button -->
                                </form>

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