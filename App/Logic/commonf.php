<?php
class Commonf
{
    public function status()
    {
        include "./db_connect.php";
        $response = array('success' => false, 'message' => '');

        if (isset($_POST['id'], $_POST['table'], $_POST['field'])) {
            $cid=$_POST['cid'];
            $id = $_POST['id'];
            $table = $_POST['table'];
            $field = $_POST['field'];

            $sql = "SELECT $field FROM $table WHERE $cid=$id"; // Change 'id' to your actual primary key column name
            $result = $conn->query($sql);

            if ($result) {
                $row = $result->fetch_assoc();
                $currentStatus = $row[$field];

                if ($currentStatus == 1) {
                    $updatesql = "UPDATE $table SET $field = 0 WHERE $cid = $id"; // Change 'id' to your actual primary key column name
                    if ($conn->query($updatesql) === TRUE) {
                        $response['success'] = true;
                        $response['message'] = "Item removed from the cart successfully!";
                    } else {
                        $response['message'] = "Error updating status: " . $conn->error;
                    }
                } elseif ($currentStatus == 0 || $currentStatus == null) {
                    $updatesql = "UPDATE $table SET $field = 1 WHERE $cid = $id"; // Change 'id' to your actual primary key column name
                    if ($conn->query($updatesql) === TRUE) {
                        $response['success'] = true;
                        $response['message'] = "Item updated successfully!";
                    } else {
                        $response['message'] = "Error updating status: " . $conn->error;
                    }
                }
            } else {
                $response['message'] = "Error in SQL query: " . $conn->error;
            }
        } else {
            $response['message'] = "Missing required parameters (id, table, field)";
        }

        // Clear any unwanted output before sending JSON response
        ob_clean();

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    public function delete()
    {
        include "./db_connect.php";
        $response = array('success' => false, 'message' => '');
    
        if (isset($_POST['id'], $_POST['table'])) {
            $id = $_POST['id'];
            $table = $_POST['table'];
            $field=$_POST['field'];
    
            $deletesql = "DELETE FROM $table WHERE $field = $id"; // Change 'bid' to your actual primary key column name
    
            if ($conn->query($deletesql) === TRUE) {
                $response['success'] = true;
                $response['message'] = "Item deleted successfully!";
            } else {
                $response['message'] = "Error deleting item: " . $conn->error;
            }
        } else {
            $response['message'] = "Missing required parameters (id, table)";
        }
    
        // Clear any unwanted output before sending JSON response
        ob_clean();
    
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}

$com = new Commonf;
if (isset($_GET['action']) && $_GET['action'] == "status") {
    $com->status();
}else if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $com->delete();
}

?>
