<?php

include_once '../includes/db.php';

$search = isset($_GET['search']) && $_GET['search'] ? $_GET['search'] : '';


$sql = "SELECT id,customer_name FROM transactions WHERE customer_name LIKE '%{$search}%'";
$result = $con->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);


$con->close();
return 0;
