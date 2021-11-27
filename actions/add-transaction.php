
<?php

$data = $_POST;
include_once '../includes/db.php';

session_start();

// Status: 1: thanh cong 2: cho xac nhan, 3: chờ lấy hàng, 4: đang giao, 5:thất bại
// Type: 1:online, 2: offline


if (
    !$data['customer_address'] || !isset($data['customer_address'])
    || !$data['customer_name'] || !isset($data['customer_name'])
    || !$data['customer_email'] || !isset($data['customer_email'])
    || !$data['customer_phone'] || !isset($data['customer_phone'])
    || !$data['type'] || !isset($data['type'])
    || !$data['products'] || !isset($data['products']) || count($data['products']) <= 0
) {
    echo json_encode([
        'code' => 400,
        'message' => 'Thiếu thông tin gửi lên'
    ]);
    return 0;
}

// echo json_encode([
//     'code' => 200,
//     'data' => $data
// ]);

// return 0;

$user = $_SESSION['user'];
$totalPrice = 0;

foreach ($data['products'] as $product) {
    $productQuery = "SELECT * FROM products WHERE id = {$product['product_id']} LIMIT 1";
    $productQueryRes = $con->query($productQuery);
    $productObj = $productQueryRes->fetch_assoc();
    $totalPrice += $productObj['price'] * $product['quantity'];
}

$note =  isset($data['note']) && $data['note']  ? $data['note'] : '';

$sql = "INSERT INTO transactions (payment_method, status, type, total_price,user_id, customer_name, customer_address, customer_phone, customer_email, customer_note) VALUES ('{$data['payment_method']}','2','{$data['type']}','{$totalPrice}','{$user['id']}','{$data['customer_name']}','{$data['customer_address']}','{$data['customer_phone']}','{$data['customer_email']}','{$note}')";

if ($con->query($sql) === TRUE) {
    $tranId = $con->insert_id;
    foreach ($data['products'] as $product) {
        $insertProductQueryString = "INSERT INTO transaction_details (product_id,transaction_id,quantity) VALUES ('{$product['product_id']}', '{$tranId}', '{$product['quantity']}')";
        $con->query($insertProductQueryString);
    }
    $con->close();
    echo json_encode([
        'code' => 200,
        'message' => 'Thành công'
    ]);
} else {
    $con->close();
    echo json_encode([
        'code' => 500,
        'message' => 'Thất bại'
    ]);
    return 0;
}
