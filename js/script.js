const confirmTranButtons = $('.confirm-transaction-button');

confirmTranButtons.on('click', function (e) {
    const button = $(e.target);
    const id = button.data('id');
    $.ajax({
        url: `http://ptit-web-php.local/actions/confirm-transaction.php?id=${id}`,
        data: $(e.target).serialize(),
        type: 'POST',
        processData: false,
        success: (data) => {
            const result = JSON.parse(data);
            if (parseInt(result.code) === 200) {
                toastr.success('Xác nhận đơn hàng thành công', 'Hệ thống');
                setTimeout(function () {
                    location.reload();
                }, 500);
            } else if (parseInt(result.code) === 400) {
                toastr.error('Dữ liệu không hợp lệ', 'Hệ thống');
            } else {
                toastr.error('Xác nhận đơn hàng thất bại', 'Hệ thống');
            }
        },
    });
});

const denyTranButtons = $('.deny-transaction-button');

denyTranButtons.on('click', function (e) {
    const button = $(e.target);
    const id = button.data('id');
    $.ajax({
        url: `http://ptit-web-php.local/actions/deny-transaction.php?id=${id}`,
        data: $(e.target).serialize(),
        type: 'POST',
        processData: false,
        success: (data) => {
            const result = JSON.parse(data);
            if (parseInt(result.code) === 200) {
                toastr.success('Hủy đơn hàng thành công', 'Hệ thống');
                setTimeout(function () {
                    location.reload();
                }, 500);
            } else if (parseInt(result.code) === 400) {
                toastr.error('Dữ liệu không hợp lệ', 'Hệ thống');
            } else {
                toastr.error('Hủy đơn hàng thất bại', 'Hệ thống');
            }
        },
    });
});
