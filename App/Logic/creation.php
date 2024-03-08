<?php
include "../db/db_connect.php";
session_start();
class Creation
{
    private $susername,$srole;
    private $conn; 

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->susername = $_SESSION['username'];
        $this->srole = $_SESSION['role'];

    }

    public function addUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitize input data
            $name = $this->sanitizeInput($_POST['name']);
            $username = $this->sanitizeInput($_POST['username']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $rawpass = $this->sanitizeInput($_POST['password']);
            $role = $this->sanitizeInput($_POST['role']);
            $managerid = isset($_POST['managerid']) ? $this->sanitizeInput($_POST['managerid']) : null;
            $agentid = isset($_POST['agentid']) ? $this->sanitizeInput($_POST['agentid']) : null;
            $branchId = isset($_POST['branch_id']) ? $this->sanitizeInput($_POST['branch_id']) : null;
            $pageId = isset($_POST['page_id']) ? $this->sanitizeInput($_POST['page_id']) : null;

            // Check if the username is unique
            if ($this->isUsernameUnique($username)) {
                $query = "INSERT INTO users (fullname, username, password, role, rawpass, branchid, pageid) VALUES (  ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($this->conn, $query);
                mysqli_stmt_bind_param($stmt, "sssssss", $name, $username, $password, $role, $rawpass, $branchId, $pageId);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    echo "User added successfully.";
                    $newUserId = mysqli_insert_id($this->conn);
                    $this->addToTree($newUserId, $role,$managerid,$agentid);


                } else {
                    echo "Error adding user: " . mysqli_error($this->conn);
                }
                mysqli_stmt_close($stmt);
            } else {
                echo "Username is not unique. Please choose another username.";
            }
        }
    }
    public function addPlatform(){
        if(isset($_POST)){
            $name=$_POST['platformname'];
            $sql="Insert into platform (name) VALUES (?)";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $name);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "User added successfully.";
            }

        }

    }
    public function CashUpAdd(){
        if(isset($_POST)){
            $name=$_POST['name'];
            $cashtag=$_POST['cashtag'];
            $number=$_POST['openingbalance'];
            $pageid=$_POST['pageid'];
            $branchid=$_POST['branchid'];
            $withdrawl=$_POST['withdrawl'];
            $sql="Insert into cashupadd (name,cashtag,openingbalance,pageid,branchid,withdrawl) VALUES (?,?,?,?,?,?)";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "sssiis", $name,$cashtag,$number,$pageid,$branchid,$withdrawl);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "User added successfully.";
            }

        }

    }

    public function CashOut(){
        if(isset($_POST)){
            $cashoutamount=$_POST['cashoutamount'];
            $fbid=$_POST['fbid'];
            $accessamount=$_POST['accessamount'];
            $cashupname=$_POST['cashupname'];
            $platformname=$_POST['platformname'];
            $tip=$_POST['tip'];
            $sql="Insert into cashOut (cashoutamount,fbid,accessamount,cashupname,platformname,tip) VALUES (?,?,?,?,?,?)";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "iiisss", $cashoutamount,$fbid,$accessamount,$cashupname,$platformname,$tip);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "Cash Out added successfully.";
            }

        }

    }

    //pending
    public function Deposit(){
        if(isset($_POST)){
            $username = $_POST['username'];
            $depositAmount = $_POST['depositamount'];
            $fbId = $_POST['fbid'];
            $platformName = ($_POST['platformname'] !== 'other') ? $_POST['platformname'] : $_POST['platformname_other'];
            $cashupName = ($_POST['cashupname'] !== 'other') ? $_POST['cashupname'] : $_POST['cashupname_other'];
            $bonusAmount = $_POST['bonusamount'];
            $remark = $_POST['remark'];
            $by_role=$this->srole;
            $by_username=$this->susername;
    
            $sql = "INSERT INTO deposits (username, deposit_amount, fb_id, platform_name, cashup_name, bonus_amount, remark,by_username,by_role) VALUES (?, ?, ?, ?, ?, ?, ?,?,?)";
            $stmt = mysqli_prepare($this->conn, $sql);
            
            mysqli_stmt_bind_param($stmt, "sdsssssss", $username, $depositAmount, $fbId, $platformName, $cashupName, $bonusAmount, $remark,$by_username,$by_role);
            $result = mysqli_stmt_execute($stmt);
    
            if ($result) {
                echo "Deposit added successfully.";
            } else {
                echo "Error adding deposit: " . mysqli_stmt_error($stmt);
            }
    
            mysqli_stmt_close($stmt);
        }
    }
    public function Redeem(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $name = $_POST['username'] ?? '';
        $platformName = $_POST['platformname'] === 'other' ? $_POST['platformname_other'] : $_POST['platformname'];
        $cashupName = $_POST['cashupname'] === 'other' ? $_POST['cashupname_other'] : $_POST['cashupname'];
        $cashtag = $_POST['cashtag'] ?? '';
        $amount = $_POST['amount'] ?? 0;
        $remark = $_POST['remark'] ?? '';
        $by_role=$this->srole;
        $by_username=$this->susername;

        
        // Prepare an SQL statement to insert the form data into the database
        $sql = "INSERT INTO withdrawl (username, platformname, cashupname, cashtag, amount, remark,by_username) VALUES (?, ?, ?, ?, ?, ?,?)";
        
        try {
            // Prepare the SQL statement
            $stmt = mysqli_prepare($this->conn, $sql);
    
            // Bind parameters to the prepared statement
            // 's' specifies the variable type => 'string'
            $stmt->bind_param("ssssiss", $name, $platformName, $cashupName, $cashtag, $amount, $remark,$by_username);
    
            // Execute the statement
            $stmt->execute();
    
            // Close statement
            $stmt->close();
    
            // Redirect or inform the user of success
            echo "Record added successfully.";
            // Optionally, redirect to another page
            // header('Location: success_page.php');
        } catch(Exception $e) {
            // Close statement if it's set
            if (isset($stmt)) {
                $stmt->close();
            }
            die("Error: " . $e->getMessage());
        }
    } else {
        // Handle incorrect access or display a specific error message
        echo "Invalid request.";
    }
}

   

    public function CashupAction(){
        if(isset($_POST)){
            $cashupname=$_POST['cashupname'];
            $cashuptag=$_POST['cashuptag'];
            $active=$_POST['active']?1:0;
            $currentbalance=$_POST['currentbalance'];
            $sql="Insert into CashupAction (cashupname,cashuptag,active,currentbalance) VALUES (?,?,?,?)";
            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssii", $cashupname,$cashuptag,$active,$currentbalance);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "CashupAction added successfully.";
            }

        }

    }

    private function addToTree($newUserId, $role,$managerid,$agentid)
    {
        $id=$_SESSION['userid'];
        if($newUserId!=null&&$role!=null&&$managerid!=null&&$agentid!=null&&$id!=null){
            $query = "INSERT INTO tree (agentid, adminid, managerid,userid	) VALUES (?, ?, ?,?)";
            $stmt = mysqli_prepare($this->conn, $query);
            mysqli_stmt_bind_param($stmt, "iiii", $agentid, $id,$managerid, $newUserId);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
    

        }
        $parentId = 0; // Default to 0 or a suitable default parent ID
        $currentUserRole = $_SESSION['role'] ?? 'Admin'; // Defaulting to Admin if session role is not set
        $currentUserId = $_SESSION['user_id'] ?? 1; // Defaulting to 1 or a suitable admin ID if session user_id is not set
        
        // Determine the parent ID based on the current user's role and the new user's role
        if ($role == 'User') {
            if ($currentUserRole == 'Admin') {
                $parentId = $currentUserId; // The admin themselves are the parent
            } elseif ($currentUserRole == 'Manager' || $currentUserRole == 'Agent') {
                $parentId = $this->findParentId($currentUserId, $currentUserRole);
            }
            // For users, the parent could be an Admin, Manager, or Agent
        } elseif ($role == 'Manager' || $role == 'Agent') {
            // For managers and agents, the parent is assumed to be an Admin or higher level manager
            $parentId = $this->findParentId($currentUserId, $currentUserRole);
        }
        
        // Insert into the tree table
        // $query = "INSERT INTO tree (user_id, parent_id, role) VALUES (?, ?, ?)";
        // $stmt = mysqli_prepare($this->conn, $query);
        // mysqli_stmt_bind_param($stmt, "iis", $newUserId, $parentId, $role);
        // mysqli_stmt_execute($stmt);
        // mysqli_stmt_close($stmt);
    }
    
    private function findParentId($userId, $userRole)
    {
        // Logic to find the parent ID based on current user role and ID
        // This could involve querying the tree table to find the appropriate parent
        // For simplicity, return a default or queried parent ID
        return $userId; // Placeholder return
    }
    
    private function isUsernameUnique($username)
    {
        $query = "SELECT COUNT(*) FROM users WHERE username = ?";
        $stmt = mysqli_prepare($this->conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $count);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        return $count == 0; // If count is 0, the username is unique
    }

    private function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags(trim($input)));
    }
}

$creation = new Creation($conn);
if (isset($_GET['action']) && $_GET['action'] == "UserAdd") {
    $creation->addUser();
}else if (isset($_GET['action']) && $_GET['action'] == "platform"){
    $creation->addPlatform();

}else if (isset($_GET['action']) && $_GET['action'] == "CashUpAdd"){
    $creation->CashUpAdd();

}else if (isset($_GET['action']) && $_GET['action'] == "CashOut"){
    $creation->CashOut();
}
else if (isset($_GET['action']) && $_GET['action'] == "Deposit"){
    $creation->Deposit();
}
else if (isset($_GET['action']) && $_GET['action'] == "CashupAction"){
    $creation->CashupAction();
}else if (isset($_GET['action']) && $_GET['action'] == "Withdrawl"){
    $creation->Redeem();
}



// Close the database connection
mysqli_close($conn);
?>
