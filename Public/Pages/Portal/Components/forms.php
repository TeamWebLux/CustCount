<?php
include "./Public/Pages/Portal/Components/formcomp.php";
include "./App/db/db_connect.php";

$title = "Add User";
$segments = explode('/', rtrim($uri, '/'));
$lastSegment = end($segments);

$action = strtoupper($lastSegment);

if (isset($action)) {
    // print_r($_POST);
    global $title;
    $heading = "Fill the User details";
    $role = $_SESSION['role'];
    // echo $role;

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
    }else if($action =="CASH_UP_ADD" && $role=("Admin" || "Manager")){
        $title = "Cash Up Add Details ";
        $heading="Enter the Details Correctly";
        $action="../App/Logic/creation.php?action=CashUpAdd";
        echo fhead($title,$heading,$action);
        echo field("Name","text","name","Enter The name");
        echo field("Cash Tag","text","cashtag","Enter the Cash Tag");
        echo field("Opening Balance","number","openingbalance","Enter The Opening Balance");
        echo field("Page ID","number","pageid","Enter Your Page ID");
        echo field("Branch ID","number","branchid","Enter Your Branch Id");
        echo field("Withdrawl ","number","withdrawl","Enter the Withdrawl");
        echo $Submit;
        echo $Cancel;
        echo $formend;
        


    }else if ($action == "CASH_OUT" && ($role == "Agent" || $role == "Supervisor" || $role=="Admin")) {
        $title = "Cash Out Details";
        $heading = "Enter the Details Correctly";
        $action = "../App/Logic/creation.php?action=CashOut";
    
        echo fhead($title, $heading, $action);
        if (isset($_GET['u'])) {
            $depositID = $_GET['u'];
            echo field("Enter the User Name","text","username","Enter the Username",$depositID,"readonly");
        } else{  
        echo field("Enter the User Name","text","username","Enter the Username");}

        echo field("Cash Out Amount", "number", "cashoutamount", "Enter the Cash Out Amount");
        echo field("FB ID", "text", "fbid", "Enter the Facebook ID");
        echo field("Access Amount", "number", "accessamount", "Enter the Access Amount");
        $platformOptions = "<option value=''>Select Platform</option>";
        $result = $conn->query("SELECT name FROM platform");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $platformOptions .= "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
            }
        }
        $platformOptions .= "<option value='other'>Other</option>";
        echo '<label for="platformname">Platform Name</label>';
        echo '<select class="form-select" id="platformname" name="platformname" onchange="showOtherField(this, \'platformname-other\')">' . $platformOptions . '</select>';
        echo '<input type="text" id="platformname-other" name="platformname_other" style="display:none;" placeholder="Enter Platform Name">';

       // echo field("Cashup Name", "text", "cashupname", "Enter the Cashup Name");
       $cashupOptions = "<option value=''>Select CashUp</option>";
       $result = $conn->query("SELECT * FROM cashups");
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
               $cashupOptions .= "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
           }
       }
       $cashupOptions .= "<option value='other'>Other</option>";
       echo '<label for="cashupname">Cashup Name</label>';
       echo '<select class="form-select" id="cashupname" name="cashupname" onchange="showOtherField(this, \'cashupname-other\')">' . $cashupOptions . '</select>';
       echo '<input type="text" id="cashupname-other" name="cashupname_other" style="display:none;" placeholder="Enter cashup Name">';
        echo field("Tip", "number", "tip", "Enter the Tip Amount");
    
        echo $Submit;
        echo $Cancel;
        echo $formend;
    }else if ($action == "DEPOSIT" && ($role != "User")) {
        $title = "Deposit Details";
        $heading = "Fill in the Deposit Details";
        $actionUrl = "../App/Logic/creation.php?action=Deposit";
        echo fhead($title, $heading, $actionUrl);
        if (isset($_GET['u'])) {
            // Fetch the corresponding value from the database based on the ID
            $depositID = $_GET['u'];
            echo field("Enter the User Name","text","username","Enter the Username",$depositID,"readonly");

            // Replace with your database fetching logic
        } else{  
        echo field("Enter the User Name","text","username","Enter the Username");}
        echo field("Deposit Amount", "number", "depositamount", "Enter the Deposit Amount");
        echo field("FB ID", "text", "fbid", "Enter the Facebook ID");
        $platformOptions = "<option value=''>Select Platform</option>";
        $result = $conn->query("SELECT name FROM platform");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $platformOptions .= "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
            }
        }
        $platformOptions .= "<option value='other'>Other</option>";
        echo '<label for="platformname">Platform Name</label>';
        echo '<select class="form-select" id="platformname" name="platformname" onchange="showOtherField(this, \'platformname-other\')">' . $platformOptions . '</select>';
        echo '<input type="text" id="platformname-other" name="platformname_other" style="display:none;" placeholder="Enter Platform Name">';

       // echo field("Cashup Name", "text", "cashupname", "Enter the Cashup Name");
       $cashupOptions = "<option value=''>Select CashUp</option>";
       $result = $conn->query("SELECT * FROM cashups");
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
               $cashupOptions .= "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
           }
       }
       $cashupOptions .= "<option value='other'>Other</option>";
       echo '<label for="cashupname">Cashup Name</label>';
       echo '<select class="form-select" id="cashupname" name="cashupname" onchange="showOtherField(this, \'cashupname-other\')">' . $cashupOptions . '</select>';
       echo '<input type="text" id="cashupname-other" name="cashupname_other" style="display:none;" placeholder="Enter cashup Name">';

        echo field("Bonus Amount", "number", "bonusamount", "Enter the Bonus Amount");
        echo field("Remark", "text", "remark", "Enter the Remark ");
    
        echo $Submit;
        echo $Cancel;
        echo $formend;
    }else if ($action == "PLATFORM" && ($role == "Admin")) {
        $title = "Add Platform Name";
        $heading = "Enter the Platform Name Below";
        $actionUrl = "../App/Logic/creation.php?action=platform"; // Adjust the action as needed
    
        echo fhead($title, $heading, $actionUrl);
        // Single field for Platform Name
        echo field("Platform Name", "text", "platformname", "Enter the Platform Name");
    
        echo $Submit;
        echo $Cancel;
        echo $formend;
    }else if ($action == "CASHUP_DETAIL" && ($role == "Admin")) {
        $title = "Cashup Details";
        $heading = "Enter Cashup Information";
        $actionUrl = "../App/Logic/creation.php?action=CashupAction"; // Adjust the action as needed
    
        echo fhead($title, $heading, $actionUrl);
        // Fields for Cashup Details
        echo field("Cashup Name", "text", "cashupname", "Enter the Cashup Name");
        echo field("Cashup Tag", "text", "cashuptag", "Enter the Cashup Tag");
    
        // Using a checkbox as a workaround for the active/inactive button
        echo '<div class="form-group">
                <label for="active">Active</label>
                <input type="checkbox" id="active" name="active" value="1">
              </div>';
    
        echo field("Current Balance", "number", "currentbalance", "Enter the Current Balance");
    
        echo $Submit;
        echo $Cancel;
        echo $formend;
    }else if ($action == "WITHDRAWL" && ($role == "Admin")) {
              // Fetch platform names from the database
  $title = "Withdrawl Action Details";
        $heading = "Fill in the Details";
        $actionUrl = "../App/Logic/creation.php?action=Withdrawl"; // Adjust the action URL as needed
    
        echo fhead($title, $heading, $actionUrl);
    
        // Assume $conn is your database connection
        $platformOptions = "<option value=''>Select Platform</option>";
        $result = $conn->query("SELECT name FROM platform");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $platformOptions .= "<option value='" . htmlspecialchars($row['name']) . "'>" . htmlspecialchars($row['name']) . "</option>";
            }
        }
        $platformOptions .= "<option value='other'>Other</option>";
    
        // Fetch cashup names from the database
        $cashupOptions = "<option value=''>Select Cashup Name</option>";
        $result = $conn->query("SELECT * FROM cashups");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $cashupOptions .= "<option value='" . htmlspecialchars($row['cashup_name']) . "'>" . htmlspecialchars($row['cashup_name']) . "</option>";
            }
        }
        $cashupOptions .= "<option value='other'>Other</option>";
            if (isset($_GET['u'])) {
            $depositID = $_GET['u'];
            echo field("Enter the User Name","text","username","Enter the Username",$depositID,"readonly");
        } else{  
        echo field("Enter the User Name","text","username","Enter the Username");}
        
        // Platform Name dropdown with "Other" option
        echo '<label for="platformname">Platform Name</label>';
        echo '<select class="form-select" id="platformname" name="platformname" onchange="showOtherField(this, \'platformname-other\')">' . $platformOptions . '</select>';
        echo '<input type="text" id="platformname-other" name="platformname_other" style="display:none;" placeholder="Enter Platform Name">';
    
        // Cashup Name dropdown with "Other" option
        echo '<label for="cashupname">Cashup Name</label>';
        echo '<select class="form-select" id="cashupname" name="cashupname" onchange="showOtherField(this, \'cashupname-other\')">' . $cashupOptions . '</select>';
        echo '<input type="text" id="cashupname-other" name="cashupname_other" style="display:none;" placeholder="Enter Cashup Name">';
    
        // Remaining fields
        echo field("Cashtag", "text", "cashtag", "Enter the Cashtag");
        echo field("Amount", "number", "amount", "Enter the Amount");
        echo field("Remark", "text", "remark", "Enter any remarks");
    
        echo $Submit;
        echo $Cancel;
        echo $formend;
    }
    
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
function showOtherField(select, otherFieldId) {
    var otherField = document.getElementById(otherFieldId);
    if(select.value === 'other') {
        otherField.style.display = 'block';
    } else {
        otherField.style.display = 'none';
    }
}
</script>

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