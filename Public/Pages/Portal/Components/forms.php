<?php 
include "./Public/Pages/Portal/Components/formcomp.php";
$title = "Add User";

$segments = explode('/', rtrim($uri, '/'));
$lastSegment = end($segments);

// Replace underscores with spaces and capitalize the first letter of each word
$action = strtoupper($lastSegment);

if (isset($action)) {
    if ($action == 'ADD_USER') {
        global $title;
        $title = "Add User";
        $heading="Fill the User details ";
        echo fhead($title,$heading,'./add_user');
        echo '<br>';
        echo $name;
        echo $email_id;
        echo $Submit;
        echo $Cancel;
        echo $formend;
    }else if ($action == 'EDIT_USER') {
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
