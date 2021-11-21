$(document).ready(function () {
    $('.table-wrapper').hide();
    const allTransTable = $('#allTransactionsTable');
    $('#allWrapper').show();
    const waitingConfirmTable = $('#waitingConfirmTable');
    const waitingShipTable = $('#waitingShipTable');
    const shippingTable = $('#shippingTable');
    const successTable = $('#successTable');
    const failedTable = $('#failedTable');
    const importTable = $('#importTable');
    allTransTable.DataTable({
        paging: true,
        searching: false,
        bLengthChange: false,
        ordering: false,
        language: {
            info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng',
            paginate: {
                previous: '<',
                next: '>',
            },
        },
        pagingType: 'simple',
    });
    waitingConfirmTable.DataTable({
        paging: true,
        searching: false,
        bLengthChange: false,
        ordering: false,
        language: {
            info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng',
            paginate: {
                previous: '<',
                next: '>',
            },
        },
        pagingType: 'simple',
    });
    waitingShipTable.DataTable({
        paging: true,
        searching: false,
        bLengthChange: false,
        ordering: false,
        language: {
            info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng',
            paginate: {
                previous: '<',
                next: '>',
            },
        },
        pagingType: 'simple',
    });
    shippingTable.DataTable({
        paging: true,
        searching: false,
        bLengthChange: false,
        ordering: false,
        language: {
            info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng',
            paginate: {
                previous: '<',
                next: '>',
            },
        },
        pagingType: 'simple',
    });
    successTable.DataTable({
        paging: true,
        searching: false,
        bLengthChange: false,
        ordering: false,
        language: {
            info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng',
            paginate: {
                previous: '<',
                next: '>',
            },
        },
        pagingType: 'simple',
    });
    failedTable.DataTable({
        paging: true,
        searching: false,
        bLengthChange: false,
        ordering: false,
        language: {
            info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng',
            paginate: {
                previous: '<',
                next: '>',
            },
        },
        pagingType: 'simple',
    });
    importTable.DataTable({
        paging: true,
        searching: false,
        bLengthChange: false,
        ordering: false,
        language: {
            info: 'Hiển thị từ _START_ đến _END_ của _TOTAL_ đơn hàng',
            paginate: {
                previous: '<',
                next: '>',
            },
        },
        pagingType: 'simple',
    });

    allTransTable.on('click', 'tr', function () {
        window.location.href = '/bootstrap-transaction/detail.html';
    });
    waitingConfirmTable.on('click', 'tr', function () {
        window.location.href = '/bootstrap-transaction/detail.html';
    });
    waitingShipTable.on('click', 'tr', function () {
        window.location.href = '/bootstrap-transaction/detail.html';
    });
    shippingTable.on('click', 'tr', function () {
        window.location.href = '/bootstrap-transaction/detail.html';
    });
    successTable.on('click', 'tr', function () {
        window.location.href = '/bootstrap-transaction/detail.html';
    });
    failedTable.on('click', 'tr', function () {
        window.location.href = '/bootstrap-transaction/detail.html';
    });
    importTable.on('click', 'tr', function () {
        window.location.href = '/bootstrap-transaction/detail.html';
    });
});

const changeTab = (e, name) => {
    e.preventDefault();
    $('.nav-link').removeClass('active');
    $(e.target).addClass('active');
    $('.table-wrapper').hide();
    $(`#${name}Wrapper`).show();
};
