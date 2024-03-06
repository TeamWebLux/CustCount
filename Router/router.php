<?php


$uri = parse_url($_SERVER['REQUEST_URI'])['path'];



if ($uri == "/CustCount/" || $uri == "/CustCount/index.php") {
    echo '<script type="text/JavaScript"> 
    window.location.replace("./index.php/Login_to_CustCount");
    </script>';
    die();
} else {

    $prefix = "/CustCount";
    $root = "/index.php";
    $routes = [

        //? This is Routes which will automatically routed when index page is loaded..

        $prefix . $root . '/Login_to_CustCount'                    => './Public/Pages/Signing/login/login.php',
        $prefix . $root . '/Register_to_CustCount'                 => './Public/Pages/Signing/register/register.php',
        $prefix . $root . '/Forgot_pass'                           => './Public/Pages/Signing/forgot/forgot.php',

        //? AGENT DASHBOARD
        $prefix . $root . '/Portal'                                       => './Public/Pages/Portal/main_dashboard.php',
        $prefix . $root . '/Portal_Add_Deposit'                           => './Public/Pages/Portal/add_deposit.php',
        $prefix . $root . '/Portal_Add_Users'                             => './Public/Pages/Portal/add_users.php',
        $prefix . $root . '/Portal_Add_Withdrawal'                         => './Public/Pages/Portal/add_withdrawal.php',
        $prefix . $root . '/Portal_See_Users'                             => './Public/Pages/Portal/see_users.php',
        $prefix . $root . '/Portal_See_Deposits'                          => './Public/Pages/Portal/see_deposits.php',
        
        $prefix . $root . '/Portal_User_Management'               => './Public/Pages/Portal/manage_user.php',
        $prefix . $root . '/update_user'                          => './Public/Pages/Portal/update_user.php',
        $prefix . $root . '/update_agent'                         => './Public/Pages/Portal/update_agent.php',
        $prefix . $root . '/update_manager'                       => './Public/Pages/Portal/update_manager.php',
        $prefix . $root . '/update_supervisor'                    => './Public/Pages/Portal/update_supervisor.php',
        $prefix . $root . '/update_user'                          => './Public/Pages/Portal/update_user.php',
        $prefix . $root . '/Portal_Agent_Management'              => './Public/Pages/Portal/manage_agent.php',
        $prefix . $root . '/Portal_Supervisor_Management'         => './Public/Pages/Portal/manage_supervisor.php',
        $prefix . $root . '/Portal_Manager_Management'            => './Public/Pages/Portal/manage_manager.php',

    ];

    function routeToController($uri, $routes)
    {
        if (array_key_exists($uri, $routes)) {
            require $routes[$uri];
        } else {
            abort();
        }
    }

    function abort()
    {

        require  "./Public/Pages/Error/404.php";
        die();
    }
    routeToController($uri, $routes);
}


?>