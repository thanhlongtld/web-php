const input = $('#search');
const suggestion = $('#suggestion');

input.on('input', function (e) {
    const search = $(e.target).val();
    $.ajax({
        url: `http://ptit-web-php.local/actions/search.php?search=${search}`,
        type: 'GET',
        processData: false,
        success: (data) => {
            const result = JSON.parse(data);
            if (result.length > 0) {
                suggestion.empty();
                result.forEach((item) => {
                    suggestion.append(
                        `<p class="p-3 mt-0 mb-0"><a class="text-light" href="http://ptit-web-php.local/view.php?id=${item.id}">Đơn hàng ${item.id} - ${item.customer_name}</a></p>`
                    );
                });
            } else {
                suggestion.empty();
            }
        },
    });
});

input.on('focusout', () => {
    suggestion.empty();
});
