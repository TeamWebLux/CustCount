<?php

include "./Public/Pages/Portal/Components/formcomp.php";

$title = "Add User";
$segments = explode('/', rtrim($uri, '/'));
$lastSegment = end($segments);

// Replace underscores with spaces and capitalize the first letter of each word
$action = strtoupper($lastSegment);

if (isset($action)) {
    if ($action == 'ADD_USER') {
        print_r($_POST);
        global $title;
        $title = "Add User";
        $heading = "Fill the User details ";
        echo fhead($title, $heading, './add_user');
        echo '<br>';
        echo $name = field("Name", "text", "name", "Enter Your Name", isset($_POST['name']) ? $_POST['name'] : '');
        echo $username = field("User Name", "text", "username", "Enter Your Username", isset($_POST['username']) ? $_POST['username'] : '');
        echo $password = field("Password", "password", "password", "Enter Your Password", isset($_POST['password']) ? $_POST['password'] : '');

        echo $Submit;
        echo $Cancel;
        echo $formend;
    } else if ($action == 'EDIT_USER') {
        global $title;
        $title = "Edit User";
        $heading = "Fill the User details ";
        echo fhead($title, $heading, './edit_user');
        echo '<br>';
        echo $name = field("Name", "text", "name", "Enter Your Name", isset($_POST['name']) ? $_POST['name'] : '');
        echo $email_id = field("Email", "email", "email_id", "Enter Your Email", isset($_POST['email_id']) ? $_POST['email_id'] : '');

        echo $Submit;
        echo $Cancel;
        echo $formend;

    }else if ($action == 'EDIT_MANAGER') {
        global $title;
        $title = "Edit Manager";
        $heading="Fill the Manager details ";
        echo fhead($title,$heading,'./edit_manager');
        echo '<br>';
        echo $name;
        echo $email_id;
        echo $Password;
        echo $Submit;
        echo $Cancel;
        echo $formend;
        
    }else if ($action == 'EDIT_') {
        global $title;
        $title = "Edit User";
        $heading="Fill the User details ";
        echo fhead($title,$heading,'./edit_user');
        echo '<br>';
        echo $name;
        echo $email_id;
        echo $Submit;
        echo $Cancel;
        echo $formend;
        
    }
}
?>
