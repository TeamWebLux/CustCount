<?php
include "./Public/Pages/Portal/Components/formcomp.php";

$title = "Add User";
$segments = explode('/', rtrim($uri, '/'));
$lastSegment = end($segments);

$action = strtoupper($lastSegment);

if (isset($action)) {
    print_r($_POST);
    global $title;
    $heading = "Fill the User details";
    $role = $_SESSION['role'];
    echo $role;

    if ($role == "Admin") {
        $option = ["Select Role", "Admin", "User", "Agent", "Manager"];
    } elseif ($role == "Agent") {
        $option = ["Select Role",  "User"];
    } elseif ($role == "Manager") {
        $option = ["Select Role", "User", "Agent", "Manager"];
    }
    if ($action == 'ADD_USER' || $action == 'EDIT_USER') {
        $title = $action == 'ADD_USER' ? "Add User" : "Edit User";
        $postUrl = $action == 'ADD_USER' ? "../App/Logic/creation.php?action=UserAdd" : './edit_user';

        echo fhead($title, $heading, $postUrl);
        echo '<br>';
        echo $name = field("Name", "text", "name", "Enter Your Name", isset($_POST['name']) ? $_POST['name'] : '');
        if ($action == 'ADD_USER') {
            echo $username = field("User Name", "text", "username", "Enter Your Username", isset($_POST['username']) ? $_POST['username'] : '');
            echo $password = field("Password", "password", "password", "Enter Your Password", isset($_POST['password']) ? $_POST['password'] : '');
        } elseif ($action == 'EDIT_USER') {
            echo $email = field("Email", "email", "email", "Enter Your Email", isset($_POST['email']) ? $_POST['email'] : '');
        }

        echo $selectRole = select("Select Role To Create", "role", "role", $option, isset($_POST['role']) ? $_POST['role'] : '');

        // Additional fields hidden by default
        echo '<div id="agentadd" style="display:none;">';
        echo $pageId = field("Page ID", "text", "page_id", "Enter Page ID");
        echo '</div>';
        echo '<div id="mageradd" style="display:none;">';
        echo $branchId = field("Branch ID", "text", "branch_id", "Enter Branch ID");
        echo '</div>';
        echo '<div id="useradd" style="display:none;">';
        include "./App/db/db_connect.php";
        // Your SQL query to select managers
        $sql = "SELECT UserID,username FROM users WHERE role='Manager'";
        $result = $conn->query($sql);

        // Check if the query was successful and there are rows returned
        if ($result->num_rows > 0) {
            // Start building the select element directly
            $selectHTML = '<label for="managerid">Select a manager</label>';
            $selectHTML .= '<select class="form-select" id="managerid" name="managerid">';

            // Iterate over each row to fetch manager details and add options
            while ($row = $result->fetch_assoc()) {
                // Check if this option should be selected based on a possibly submitted form
                $selected = (isset($_POST['managerid']) && $_POST['managerid'] == $row['UserID']) ? 'selected' : '';
                $selectHTML .= "<option value='" . htmlspecialchars($row['UserID']) . "' $selected>" . htmlspecialchars($row['username']) . "</option>";
            }

            // Close the select element
            $selectHTML .= '</select>';
        } else {
            $selectHTML = '<label for="managerid">Select a manager</label>';
            $selectHTML .= '<select class="form-select" id="managerid" name="managerid">';
            $selectHTML .= "<option value=''>No managers found</option>";
            $selectHTML .= '</select>';
        }

        echo $selectHTML;
        include "./App/db/db_connect.php";
        // Your SQL query to select managers
        $sql = "SELECT UserID,username FROM users WHERE role='Agent'";
        $result = $conn->query($sql);

        // Check if the query was successful and there are rows returned
        if ($result->num_rows > 0) {
            // Start building the select element directly
            $selectHTML = '<label for="agentid">Select a Agent</label>';
            $selectHTML .= '<select class="form-select" id="agentid" name="agentid">';

            // Iterate over each row to fetch manager details and add options
            while ($row = $result->fetch_assoc()) {
                // Check if this option should be selected based on a possibly submitted form
                $selected = (isset($_POST['agentid']) && $_POST['agentid'] == $row['UserID']) ? 'selected' : '';
                $selectHTML .= "<option value='" . htmlspecialchars($row['UserID']) . "' $selected>" . htmlspecialchars($row['username']) . "</option>";
            }

            // Close the select element
            $selectHTML .= '</select>';
        } else {
            $selectHTML = '<label for="agentid">Select a manager</label>';
            $selectHTML .= '<select class="form-select" id="agentid" name="agentid">';
            $selectHTML .= "<option value=''>No managers found</option>";
            $selectHTML .= '</select>';
        }

        echo $selectHTML;
        echo '</div>';

        echo $Submit;
        echo $Cancel;
        echo $formend;
    }
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $('#role').change(function() {
            var isManager = $(this).val() === 'Manager';
            $('#mageradd').toggle(isManager);


        });
        $('#role').change(function() {
            var isManager = $(this).val() === 'Agent';
            $('#agentadd').toggle(isManager);


        });
        $('#role').change(function() {
            var isManager = $(this).val() === 'User';
            $('#useradd').toggle(isManager);


        });
    });
</script>