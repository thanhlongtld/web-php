<?php

include_once '../includes/db.php';

$data = $_POST;

$id = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null;

if (!$id) {
    echo json_encode([
        'code' => 400,
        'message' => 'Thiếu thông tin gửi lên'
    ]);
    return 0;
}

if (
    !$data['customer_address'] || !isset($data['customer_address'])
    || !$data['customer_name'] || !isset($data['customer_name'])
    || !$data['customer_email'] || !isset($data['customer_email'])
    || !$data['customer_phone'] || !isset($data['customer_phone'])
    || !$data['type'] || !isset($data['type'])
) {
    echo json_encode([
        'code' => 400,
        'message' => 'Thiếu thông tin gửi lên'
    ]);
    return 0;
}

$sql = "UPDATE transactions SET customer_name='{$data['customer_name']}', customer_address='{$data['customer_address']}', customer_phone='{$data['customer_phone']}', customer_email='{$data['customer_email']}', customer_note='{$data['customer_note']}', payment_method='{$data['payment_method']}', type='{$data['type']}' WHERE id={$id}";

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
