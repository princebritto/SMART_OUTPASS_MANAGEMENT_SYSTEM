<?php
include("db.php");

//raise outpass apply 
if (isset($_POST['save_user'])) {
    try {
        $user_id = mysqli_real_escape_string($conn, $_POST['userid']);
        $outPassType = mysqli_real_escape_string($conn, $_POST['outPass']);
        $dateTime = mysqli_real_escape_string($conn, $_POST['time']);
        $reason = mysqli_real_escape_string($conn, $_POST['reason']);

        $query = "INSERT INTO leaveapply (user_id, category, date, reason) VALUES ('$user_id', '$outPassType', '$dateTime', '$reason')";

        if (mysqli_query($conn, $query)) {
            $res = [
                'status' => 200,
                'message' => 'Details added successfully'
            ];
            echo json_encode($res);
        } else {
            throw new Exception('Query Failed: ' . mysqli_error($conn));
        }
    } catch (Exception $e) {
        $res = [
            'status' => 500,
            'message' => 'Error: ' . $e->getMessage()
        ];
        echo json_encode($res);
    }
}

//class advisior approval
if (isset($_POST['approve_user'])) {
    $apid = mysqli_real_escape_string($conn, $_POST['ids']);
    $sql = "UPDATE leaveapply SET status ='2' WHERE id='$apid'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        mysqli_commit($conn);
        echo json_encode(['status' => 200]);
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
//class rejected tab

if (isset($_POST['reject_user'])) {
    $apid = mysqli_real_escape_string($conn, $_POST['ids']);
    $sql = "UPDATE leaveapply SET status ='5' WHERE id='$apid'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        mysqli_commit($conn);
        echo json_encode(['status' => 200]);
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}
//hod approval tab

if (isset($_POST['approve'])) {
    $apid = mysqli_real_escape_string($conn, $_POST['ids']);
    $sql = "UPDATE leaveapply SET status ='3' WHERE id='$apid'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        mysqli_commit($conn);
        echo json_encode(['status' => 200]);
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

//Hod Rejected
if (isset($_POST['reject'])) {
    $apid = mysqli_real_escape_string($conn, $_POST['ids']);
    $sql = "UPDATE leaveapply SET status ='6' WHERE id='$apid'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        mysqli_commit($conn);
        echo json_encode(['status' => 200]);
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
}

if (isset($_POST['update_status'])) {
    $apid = mysqli_real_escape_string($conn, $_POST['ids']);
    $sql = "UPDATE leaveapply SET status ='4' WHERE id='$apid'";
    $res = mysqli_query($conn, $sql);
    if ($res) {
        mysqli_commit($conn);
        echo json_encode(['status' => 200]);
    }
    else {
        $res = [
            'status' => 500,
            'message' => 'Details Not Deleted'
        ];
        echo json_encode($res);
        return;
    }
} 
 // Include your database connection file here

if (isset($_POST['fetch_details'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $query = "SELECT category,reason,date FROM leaveapply WHERE id = '$userid'";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $User_data = mysqli_fetch_assoc($query_run); // Fetch associative array
        if ($User_data) {
            $res = [
                'status' => 200,
                'message' => 'Details fetched successfully by ID',
                'data' => $User_data
            ];
        } else {
            $res = [
                'status' => 404,
                'message' => 'No data found for this ID'
            ];
        }
    } else {
        $res = [
            'status' => 500,
            'message' => 'Database query failed'
        ];
    }
    
    echo json_encode($res);
    return;
}
?>





