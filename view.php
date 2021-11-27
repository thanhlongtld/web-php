<?php
session_start();
if (!isset($_SESSION['user']) || !$_SESSION['user'] && count($_SESSION['user']) < 1) {
    header("Location:login.php");
}
include_once './includes/db.php';

$sql = "SELECT * FROM products";

$products = [];

$productsQueryRes = $con->query($sql);

if ($productsQueryRes->num_rows > 0) {
    while ($row = $productsQueryRes->fetch_assoc()) {
        $products[] = $row;
    }
}

$tranId = isset($_GET['id']) && $_GET['id'] ? $_GET['id'] : null;
if (!$tranId) {
    echo '<h1>Ma đơn hàng không tồn tại</h1>';
    die();
}

$tranQuery = "SELECT * FROM transactions INNER JOIN transaction_details ON transactions.id = transaction_details.transaction_id INNER JOIN products ON transaction_details.product_id = products.id WHERE transactions.id={$tranId}";
$tranQueryRes = $con->query($tranQuery);

$transaction = [];

if ($tranQueryRes->num_rows > 0) {
    $data = $tranQueryRes->fetch_all(MYSQLI_ASSOC);

    foreach ($data as $item) {
        $transaction['id'] = $item['transaction_id'];
        $transaction['customer_name'] = $item['customer_name'];
        $transaction['customer_phone'] = $item['customer_phone'];
        $transaction['customer_address'] = $item['customer_address'];
        $transaction['customer_email'] = $item['customer_email'];
        $transaction['customer_note'] = $item['customer_note'];
        $transaction['payment_method'] = $item['payment_method'];
        $transaction['status'] = $item['status'];
        $transaction['type'] = $item['type'];
        $transaction['total_price'] = $item['total_price'];
        $transaction['details'][] = [
            'name' => $item['name'],
            'price' => $item['price'],
            'quantity' => $item['quantity'],
            'avatar' => $item['avatar'],

        ];
    }
}

$queryIncome = 'SELECT SUM(total_price) as total_income FROM transactions WHERE status <> 5';
$resIncome = $con->query($queryIncome);
$income = $resIncome->fetch_assoc()['total_income'];

$queryTotalTrans = 'SELECT COUNT(id) as total_trans FROM transactions';
$resTotalTrans = $con->query($queryTotalTrans);
$totalTrans = $resTotalTrans->fetch_assoc()['total_trans'];

$con->close();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Chi tiết đơn hàng</title>
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./css/style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="wrapper rounded">
        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start">
            <a class="navbar-brand" href="index.php">LONGEE <p class="text-muted pl-1">Quản lý đơn hàng của Longee Shop</p></a>
            <button aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarNav" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-lg-auto">
                    <li class="nav-item">
                        <div class="dropdown show">
                            <a aria-expanded="false" aria-haspopup="true" class="btn nav-link dropdown-toggle" data-toggle="dropdown" href="#" id="dropdownNotification" role="button"><span class="fa fa-bell-o font-weight-bold"></span>
                                <span class="notify">Notifications</span> </a>
                            <div aria-labelledby="dropdownNotification" class="dropdown-menu">
                                <a class="dropdown-item d-flex flex-column" href="#">
                                    <span>Air force 1 all white vừa hết hàng</span>
                                    <small class="text-muted">15/10/2021 15:00</small>
                                </a>
                                <a class="dropdown-item d-flex flex-column" href="#">
                                    <span>Lô Jordan 1 mới đã về kho</span>
                                    <small class="text-muted">15/10/2021 15:00</small>
                                </a>
                                <a class="dropdown-item d-flex flex-column" href="#">
                                    <span>Nike vừa gửi một hóa đơn</span>
                                    <small class="text-muted">15/10/2021 15:00</small>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item ">
                        <form autocomplete="off">
                            <a href="#"><span class="fa fa-search"></span></a> <input id="search" class="dark" name="name" placeholder="Tìm kiếm" type="search">
                            <div id="suggestion" class="text-light position-absolute rounded" style="min-width: 200px;z-index:1000; background-color: #444;">
                            </div>
                        </form>
                    </li>
                    <li class="nav-item ">
                        <a href="./logout.php" class="btn btn-danger" style="white-space: nowrap;">Đăng xuất</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row mt-2 pt-2">
            <div class="col-md-6" id="income">
                <div class="d-flex justify-content-start align-items-center">
                    <p class="fa fa-long-arrow-down"></p>
                    <p class="text mx-3">Thu nhập</p>
                    <p class="text-white ml-4 money"><?php echo number_format($income) . ' đ' ?></p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end align-items-center">
                    <div class="fa fa-long-arrow-up"></div>
                    <div class="text mx-3">Số đon hàng</div>
                    <div class="text-white ml-4 money"><?php echo $totalTrans ?></div>
                </div>
            </div>
        </div>
        <form id="update-trans-form" method="POST">
            <h1 class="text-white text-center w-100 mt-2">Chi tiết đơn hàng đơn hàng</h1>
            <?php if ($transaction['status'] == 5) { ?>
                <div class="text-center">
                    <i class="fa fa-times fa-3x text-danger"></i>
                    <p class="text-danger">Đơn hàng không thành công</p>
                </div>
            <?php } else { ?>
                <div class="progress mt-3" style="height: 50px;">
                    <div class="d-flex align-items-center justify-content-center progress-bar <?php switch ($transaction['status']) {
                                                                                                    case 2:
                                                                                                        echo 'bg-warning';
                                                                                                        break;
                                                                                                    case 3:
                                                                                                        echo 'bg-primary';
                                                                                                        break;
                                                                                                    case 4:
                                                                                                        echo 'bg-info';
                                                                                                        break;
                                                                                                    case 1:
                                                                                                        echo 'bg-success';
                                                                                                        break;
                                                                                                    default:
                                                                                                        echo 'bg-danger';
                                                                                                        break;
                                                                                                } ?>" role="progressbar" style="width: <?php switch ($transaction['status']) {
                                                                                                                                            case 2:
                                                                                                                                                echo '25%';
                                                                                                                                                break;
                                                                                                                                            case 3:
                                                                                                                                                echo '50%';
                                                                                                                                                break;
                                                                                                                                            case 4:
                                                                                                                                                echo '75%';
                                                                                                                                                break;
                                                                                                                                            case 1:
                                                                                                                                                echo '100%';
                                                                                                                                                break;
                                                                                                                                            default:
                                                                                                                                                echo '0%';
                                                                                                                                                break;
                                                                                                                                        } ?>;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php switch ($transaction['status']) {
                                                                                                                                                                                                            case 2:
                                                                                                                                                                                                                echo '<i class="fa fa-clock-o fa-2x text-dark" aria-hidden="true"></i><p class="text-dark font-weight-bold mt-0 mb-0">Chờ xác nhận</p>';
                                                                                                                                                                                                                break;
                                                                                                                                                                                                            case 3:
                                                                                                                                                                                                                echo '<i class="fa fa-shopping-bag fa-2x text-light" aria-hidden="true"></i><p class="text-light font-weight-bold mt-0 mb-0">Chờ lấy hàng</p>';
                                                                                                                                                                                                                break;
                                                                                                                                                                                                            case 4:
                                                                                                                                                                                                                echo '<i class="fa fa-truck fa-2x text-light" aria-hidden="true"></i><p class="text-light font-weight-bold mt-0 mb-0">Đang giao</p>';
                                                                                                                                                                                                                break;
                                                                                                                                                                                                            case 1:
                                                                                                                                                                                                                echo '<i class="fa fa-check fa-2x text-light" aria-hidden="true"></i><p class="text-light font-weight-bold mt-0 mb-0">Thành công</p>';
                                                                                                                                                                                                                break;
                                                                                                                                                                                                            default:
                                                                                                                                                                                                                echo '0%';
                                                                                                                                                                                                                break;
                                                                                                                                                                                                        } ?></div>
                </div>
            <?php } ?>

            <div class="row mt-5">

                <div class="col-12 col-lg-6 mt-3">
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="customer">Tên khách hàng</label>
                        <input value="<?php echo $transaction['customer_name'] ?>" class="form-control w-50" id="customer_name" name="customer_name" placeholder="Nhập tên khách hàng" type="text" required />
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="address">Địa chỉ</label>
                        <input value="<?php echo $transaction['customer_address'] ?>" class="form-control w-50" id="customer_address" name="customer_address" placeholder="Nhập địa chỉ khách hàng" type="text" / required>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="tel">Số điện thoại</label>
                        <input value="<?php echo $transaction['customer_phone'] ?>" class="form-control w-50" id="tel" name="customer_phone" placeholder="Nhập số điện thoại khách hàng" type="tel" required />
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="email">Email</label>
                        <input value="<?php echo $transaction['customer_email'] ?>" class="form-control w-50" id="email" name="customer_email" placeholder="Nhập số email khách hàng" type="email" required />
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="note">Lưu ý của khách</label>
                        <textarea class="form-control w-50" id="note" name="customer_note" placeholder="Nhập lưu ý" rows="4" required><?php echo $transaction['customer_note'] ?></textarea>
                    </div>

                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="payment_method">Hình thức thanh toán</label>
                        <select class="form-control w-50" id="payment_method" name="payment_method" required>
                            <option <?php echo $transaction['payment_method'] == 'visa' ? 'selected' : null ?> value="visa">Visa</option>
                            <option <?php echo $transaction['payment_method'] == 'master' ? 'selected' : null ?> value="master">Mastercard</option>
                            <option <?php echo $transaction['payment_method'] == 'cod' ? 'selected' : null ?> value="cod">Thanh toán khi nhận hàng</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted w-50">Phân loại</label>
                        <div class="form-check">
                            <input <?php echo $transaction['type'] == 1 ? 'checked' : null ?> class="form-check-input" id="type1" name="type" type="radio" value="1" required>
                            <label class="form-check-label text-white" for="type1">
                                Mua online
                            </label>
                        </div>
                        <div class="form-check">
                            <input <?php echo $transaction['type'] == 2 ? 'checked' : null ?> class="form-check-input" id="type2" name="type" type="radio" value="2" required>
                            <label class="form-check-label text-white" for="type2">
                                Mua tại store
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 mt-3">
                    <h3 class="text-white">Danh sách sản phẩm</h3>
                    <div class="table-responsive mt-3" id="transaction_details_table">
                        <div class="table-wrapper">
                            <table class="table table-dark table-borderless border-info">
                                <thead>
                                    <tr>
                                        <th class="border border-light" scope="col">Tên sản phẩm</th>
                                        <th class="border border-light" scope="col">Ảnh</th>
                                        <th class="border border-light" scope="col">Giá tiền</th>
                                        <th class="border border-light" scope="col">Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($transaction['details'] as $item) { ?>
                                        <tr>
                                            <td class="border border-light"><?php echo $item['name'] ?></td>
                                            <td class="border border-light"><img class="img-thumbnail" src="<?php echo $item['avatar'] ?>" /></td>
                                            <td class="border border-light"><?php echo number_format($item['price']) . ' đ' ?></td>
                                            <td class="border border-light"><?php echo $item['quantity'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3 mx-auto">
                    <label class="text-muted" for="total">Tổng tiền: </label>
                    <h4 id="text-total" class="text-white ml-2"><?php echo number_format($transaction['total_price']) . ' đ' ?></h4>
                </div>
                <div class="text-center w-100">
                    <a class="btn btn-secondary m-auto text-center mt-3" href="./index.php">Quay lại</a>
                    <?php if ($transaction['status'] == 2) { ?>
                        <button type="button" id="confirm-tran-button" class="btn btn-info m-auto text-center mt-3">Xác nhận đơn hàng</button>
                    <?php } ?>
                    <button type="button" id='update-tran-button' class="btn btn-success m-auto text-center mt-3">Cập nhật</button>
                </div>

            </div>
        </form>

    </div>
    <script>
        let id = <?php echo $transaction['id']; ?>;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="./js/update_transaction.js"></script>
    <script src="./js/search.js"></script>
</body>

</html>