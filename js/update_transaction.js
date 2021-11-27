const updateButton = $('#update-tran-button');
const confirmTranButton = $('#confirm-tran-button');
const form = $('#update-trans-form');

updateButton.on('click', (e) => {
    form.submit();
});

form.on('submit', (e) => {
    e.preventDefault();
    $.ajax({
        url: `http://ptit-web-php.local/actions/update-transaction.php?id=${id}`,
        data: $(e.target).serialize(),
        type: 'POST',
        processData: false,
        success: (data) => {
            const result = JSON.parse(data);
            if (parseInt(result.code) === 200) {
                toastr.success('Chỉnh sửa đơn hàng thành công', 'Hệ thống');
                setTimeout(function () {
                    window.location.href =
                        'http://ptit-web-php.local/index.php';
                }, 500);
            } else if (parseInt(result.code) === 400) {
                toastr.error('Dữ liệu không hợp lệ', 'Hệ thống');
            } else {
                toastr.error('Chỉnh sửa đơn hàng thất bại', 'Hệ thống');
            }
        },
    });
});

confirmTranButton.on('click', (e) => {
    $.ajax({
        url: `http://ptit-web-php.local/actions/confirm-transaction.php?id=${id}`,
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
