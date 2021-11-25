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

$con->close();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Thêm mới đơn hàng</title>
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
                        <form action="search.html" method="GET">
                            <a href="#"><span class="fa fa-search"></span></a> <input class="dark" name="name" placeholder="Tìm kiếm" type="search">
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="row mt-2 pt-2">
            <div class="col-md-6" id="income">
                <div class="d-flex justify-content-start align-items-center">
                    <p class="fa fa-long-arrow-down"></p>
                    <p class="text mx-3">Thu nhập</p>
                    <p class="text-white ml-4 money">150.000.000 VND</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-md-end align-items-center">
                    <div class="fa fa-long-arrow-up"></div>
                    <div class="text mx-3">Chi trả</div>
                    <div class="text-white ml-4 money">50.000.000</div>
                </div>
            </div>
        </div>
        <form id="add-trans-form" method="POST">
            <div class="row mt-5">
                <h1 class="text-white text-center w-100 mt-2">Thêm mới đơn hàng</h1>
                <div class="col-12 col-lg-6 mt-3">
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="customer">Tên khách hàng</label>
                        <input class="form-control w-50" id="customer_name" name="customer_name" placeholder="Nhập tên khách hàng" type="text" />
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="address">Địa chỉ</label>
                        <input class="form-control w-50" id="customer_address" name="customer_address" placeholder="Nhập địa chỉ khách hàng" type="text" />
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="tel">Số điện thoại</label>
                        <input class="form-control w-50" id="tel" name="customer_phone" placeholder="Nhập số điện thoại khách hàng" type="tel" />
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="email">Email</label>
                        <input class="form-control w-50" id="email" name="customer_email" placeholder="Nhập số email khách hàng" type="email" />
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="note">Lưu ý của khách</label>
                        <textarea class="form-control w-50" id="note" name="customer_note" placeholder="Nhập lưu ý" rows="4"></textarea>
                    </div>

                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted" for="payment_method">Hình thức thanh toán</label>
                        <select class="form-control w-50" id="payment_method" name="payment_method">
                            <option value="visa">Visa</option>
                            <option value="master">Mastercard</option>
                            <option value="cod">Thanh toán khi nhận hàng</option>
                        </select>
                    </div>
                    <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3">
                        <label class="text-muted w-50">Phân loại</label>
                        <div class="form-check">
                            <input class="form-check-input" id="type1" name="type" type="radio" value="1">
                            <label class="form-check-label text-white" for="type1">
                                Mua online
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" id="type2" name="type" type="radio" value="2">
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
                            <table id="detail_table" class="table table-dark table-borderless">
                                <thead>
                                    <tr>
                                        <th class="text-white">Sản phẩm</th>
                                        <th class="text-white">Số lượng</th>
                                    </tr>
                                </thead>
                                <tbody id="detail_body" data-number="1">
                                    <tr>
                                        <td>
                                            <select data-number="0" class="form-control product-select" id="product" name="products[0][product_id]">
                                                <option value="">Chọn sản phẩm</option>
                                                <?php
                                                foreach ($products as $product) {
                                                    echo '<option value="' . $product['id'] . '">' . $product['name'] . '</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" value="1" data-number="0" name="products[0][quantity]" class="form-control product-quantity" placeholder="Điền số lượng" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button type="button" id="add_detail" class="btn btn-success ml-2">Thêm</button>
                            <button type="button" id="remove_detail" class="btn btn-danger">Xóa</button>
                        </div>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between pr-lg-5 mb-3 mx-auto">
                    <label class="text-muted" for="total">Tổng tiền: </label>
                    <h4 id="text-total" class="text-white ml-2">0</h4>
                </div>
                <div class="text-center w-100">
                    <a class="btn btn-secondary m-auto text-center mt-3" href="index.html">Hủy</a>
                    <button class="btn btn-success m-auto text-center mt-3">Xác nhận</button>
                </div>

            </div>
        </form>

    </div>
    <script>
        let products = <?php echo json_encode($products); ?>;
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="./js/add_transaction.js"></script>
</body>

</html>