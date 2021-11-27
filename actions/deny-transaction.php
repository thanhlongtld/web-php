<?php

include_once '../includes/db.php';

$id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null;

if (!$id) {
    echo json_encode([
        'code' => 400,
        'message' => 'Thiếu thông tin gửi lên'
    ]);
    return 0;
}

$sql = "UPDATE transactions SET status='5' WHERE id={$id}";

if ($con->query($sql) === TRUE) {
    echo json_encode([
        'code' => 200,
        'message' => 'Thành công'
    ]);
    return 0;
} else {
    echo json_encode([
        'code' => 500,
        'message' => 'Thất bại'
    ]);
    return 0;
}

$con->close();
