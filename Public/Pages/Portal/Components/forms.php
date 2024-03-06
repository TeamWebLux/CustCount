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
    }
}
?>
