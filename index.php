<?php
session_start();
if (!isset($_SESSION['user']) || !$_SESSION['user'] && count($_SESSION['user']) < 1) {
    header("Location:login.php");
}
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="wrapper rounded">
        <nav class="navbar navbar-expand-lg navbar-dark dark d-lg-flex align-items-lg-start"><a class="navbar-brand" href="index.html">LONGEE <p class="text-muted pl-1">Quản lý đơn hàng của Longee Shop</p></a>
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
                    <div class="text-white ml-4 money">50.000.000 VND</div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3">
            <ul class="nav nav-tabs w-75">
                <li class="nav-item"><a class="nav-link active" href="#" onclick="changeTab(event,'all')">Tất cả</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="changeTab(event,'waiting')">Chờ xác nhận</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="changeTab(event,'waiting2')">Chờ lấy hàng</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="changeTab(event,'shipping')">Đang giao</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="changeTab(event,'success')">Thành công</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="changeTab(event,'failed')">Thất bại</a></li>
                <li class="nav-item"><a class="nav-link" href="#" onclick="changeTab(event,'import')">Nhập hàng</a></li>
            </ul>
            <a class="btn btn-primary" href="add.php">Thêm mới đơn hàng</a>
        </div>
        <div class="table-responsive mt-3" id="transactionTables">
            <div class="table-wrapper" id="allWrapper">
                <table class="table table-dark table-borderless" id="allTransactionsTable">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Phân loại</th>
                            <th class="text-right" scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-cc-visa"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>


                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>


                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>


                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>

                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row">Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
            <div class="table-wrapper" id="waitingWrapper">
                <table class="table table-dark table-border-less" id="waitingConfirmTable">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Phân loại</th>
                            <th class="text-right" scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-cc-visa"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Airforce 1 All White</td>
                            <td><span class="fa fa-cc-mastercard"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                1.500.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ xác nhận</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-wrapper" id="waiting2Wrapper">
                <table class="table table-dark table-border-less" id="waitingShipTable">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Phân loại</th>
                            <th class="text-right" scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Chờ lấy hàng</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
            <div class="table-wrapper" id="shippingWrapper">
                <table class="table table-dark table-border-less" id="shippingTable">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Phân loại</th>
                            <th class="text-right" scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-wrapper" id="successWrapper">
                <table class="table table-dark table-borderless" id="successTable">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Phân loại</th>
                            <th class="text-right" scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thành công</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-wrapper" id="failedWrapper">
                <table class="table table-dark table-borderless" id="failedTable">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Phân loại</th>
                            <th class="text-right" scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Thất bại</td>
                            <td scope="row">1</td>
                            <td scope="row">Khách mua</td>
                            <td class="d-flex justify-content-end align-items-center"> <span class="fa fa-long-arrow-down mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="table-wrapper" id="importWrapper">
                <table class="table table-dark table-borderless" id="importTable">
                    <thead>
                        <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Thanh toán</th>
                            <th scope="col">Thời gian</th>
                            <th scope="col">Trạng thái</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Phân loại</th>
                            <th class="text-right" scope="col">Tổng tiền</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air Jordan 1 Hi FlyEase</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Air force 1 All White</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom Pegasus</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row"> Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                        <tr>
                            <td scope="row"><span class="fa fa-shopping-cart mr-1"></span> Nike Air Zoom GTRun</td>
                            <td><span class="fa fa-money"></span></td>
                            <td class="text-muted">12 Jul 2020, 12:30 PM</td>
                            <td scope="row">Đang giao</td>
                            <td scope="row">1</td>
                            <td scope="row">Nhập hàng</td>
                            <td class="d-flex justify-content-end align-items-center"><span class="fa fa-long-arrow-up mr-1"></span>
                                4.000.000 VND
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="./script.js">
    </script>
</body>

</html>