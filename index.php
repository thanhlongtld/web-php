<?php
session_start();
include_once './includes/db.php';
include_once './includes/statuses.php';

if (!isset($_SESSION['user']) || !$_SESSION['user'] && count($_SESSION['user'])) {
    header("Location:login.php");
}

$queryStatus = isset($_GET['status']) && $_GET['status'] ? (int)$_GET['status'] : 0;

$query = 'SELECT * FROM transactions INNER JOIN transaction_details ON transactions.id = transaction_details.transaction_id INNER JOIN products ON transaction_details.product_id = products.id';

if ($queryStatus !== 0) {
    $query = "SELECT * FROM transactions INNER JOIN transaction_details ON transactions.id = transaction_details.transaction_id INNER JOIN products ON transaction_details.product_id = products.id  WHERE transactions.status='{$queryStatus}'";
}

$res = $con->query($query);

$transactions = [];

if ($res->num_rows > 0) {
    $transactionsQueryRes = $res->fetch_all(MYSQLI_ASSOC);
    foreach ($transactionsQueryRes as $transaction) {
        $transactions[$transaction['transaction_id']][] = $transaction;
    }
}

// echo '<pre>';
// print_r($transactions);
// echo '</pre>';
// die();

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
    <title>Quản lí đơn hàng</title>
    <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="wrapper rounded">
        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start"><a class="navbar-brand" href="./index.php">LONGEE <p class="text-muted pl-1">Quản lý đơn hàng của Longee Shop</p></a>
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
                    <div class="text mx-3">Tổng đơn hàng</div>
                    <div class="text-white ml-4 money"><?php echo $totalTrans ?></div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <ul class="nav nav-tabs w-75">
                <li class="nav-item"><a class="nav-link <?php echo !isset($_GET['status']) || !$_GET['status'] ? 'active' : null ?>" href="index.php">Tất cả</a></li>
                <li class="nav-item"><a class="nav-link <?php echo isset($_GET['status']) && (int)$_GET['status'] == 2 ? 'active' : null ?>" href="./index.php?status=2">Chờ xác nhận</a></li>
                <li class="nav-item"><a class="nav-link <?php echo isset($_GET['status']) && (int)$_GET['status'] == 3 ? 'active' : null ?>" href="./index.php?status=3">Chờ lấy hàng</a>
                </li>
                <li class="nav-item"><a class="nav-link <?php echo isset($_GET['status']) && (int)$_GET['status'] == 4 ? 'active' : null ?>" href="./index.php?status=4">Đang giao</a></li>
                <li class="nav-item"><a class="nav-link <?php echo isset($_GET['status']) && (int)$_GET['status'] == 1 ? 'active' : null ?>" href="./index.php?status=1">Thành công</a></li>
                <li class="nav-item"><a class="nav-link <?php echo isset($_GET['status']) && (int)$_GET['status'] == 5 ? 'active' : null ?>" href="./index.php?status=5">Thất bại</a></li>
            </ul>
            <a class="btn btn-primary" href="add.php">Thêm mới đơn hàng</a>
        </div>
        <div class="table-responsive mt-3" id="transactionTables">
            <div class="table-wrapper" id="allWrapper">
                <table class="table table-dark table-borderless" id="allTransactionsTable">
                    <thead>
                        <tr>
                            <th class="border-bottom border-light" scope="col">Khách hàng</th>
                            <th class="border-bottom border-light" scope="col">Số điện thoại</th>
                            <th class="border-bottom border-light" scope="col">Trạng thái</th>
                            <th class="border-bottom border-light" scope="col">Hình thức</th>
                            <th class="border-bottom border-light" scope="col">Thanh toán</th>
                            <th class="border-bottom border-light" scope="col">Sản phẩm</th>
                            <th class="border-bottom border-light" class="text-right" scope="col">Thành tiền</th>
                            <th class="border-bottom border-light" scope="col" class="text-right">Hành động</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach ($transactions as $id => $transaction) {
                        ?>
                            <tr>
                                <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> <?php echo $transaction[0]['customer_name'] ?></td>
                                <td scope="row"><?php echo $transaction[0]['customer_phone'] ?></td>
                                <td class="<?php
                                            switch ($transaction[0]['status']) {
                                                case 1:
                                                    echo 'text-success';
                                                    break;
                                                case 2:
                                                    echo 'text-warning';
                                                    break;
                                                case 3:
                                                    echo 'text-info';
                                                    break;
                                                case 4:
                                                    echo 'text-primary';
                                                    break;
                                                case 5:
                                                    echo 'text-danger';
                                                    break;
                                            }
                                            ?>" scope="row"><?php echo $statuses[(int)$transaction[0]['status']] ?></td>
                                <td class="<?php
                                            switch ($transaction[0]['type']) {
                                                case 1:
                                                    echo 'text-success';
                                                    break;
                                                case 2:
                                                    echo 'text-light';
                                                    break;
                                            }
                                            ?> scope=" row"><?php echo $transaction[0]['type'] == 1 ? 'Online' : 'Offline' ?></td>
                                <td scope="row"><?php echo $transaction[0]['payment_method'] ?></td>
                                <td scope="row">
                                    <table class="table table-dark table-borderless border-info">
                                        <thead>
                                            <tr>
                                                <th class="border border-light" scope="col">Tên sản phẩm</th>
                                                <th class="border border-light" scope="col">Giá tiền</th>
                                                <th class="border border-light" scope="col">Số lượng</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($transaction as $item) { ?>
                                                <tr>
                                                    <td class="border border-light"><?php echo $item['name'] ?></td>
                                                    <td class="border border-light"><?php echo number_format($item['price']) . ' đ' ?></td>
                                                    <td class="border border-light"><?php echo $item['quantity'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                    <?php echo number_format($transaction[0]['total_price']) . ' đ' ?>
                                </td>
                                <td class="text-right">
                                    <a href="./view.php?id=<?php echo $item['transaction_id'] ?>" class="btn btn-primary">Xem</a>
                                    <?php if ($transaction[0]['status'] == 2) { ?>
                                        <button data-id="<?php echo $id ?>" class="btn btn-success confirm-transaction-button">Xác nhận</button>
                                        <button data-id="<?php echo $id ?>" class="btn btn-danger deny-transaction-button">Hủy</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="./js/script.js"></script>
    <script src="./js/search.js"></script>
</body>

</html>