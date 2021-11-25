const addButton = document.querySelector('#add_detail');
const removeButton = document.querySelector('#remove_detail');
const body = document.querySelector('#detail_body');
const textTotal = document.querySelector('#text-total');

addButton.addEventListener('click', () => {
    const number = parseInt(body.dataset.number);
    const content = `
    <tr>
        <td>
            <select data-number="${number}" class="form-control product-select" id="product" name="products[${number}][product_id]">
                <option value="">Chọn sản phẩm</option>
                ${products.map(
                    (product) =>
                        `<option value="${product.id}">${product.name}</option>`
                )}
            </select>
        </td>
        <td>
            <input type="number" value="1" data-number=${number} name="products[${number}][quantity]" class="form-control product-quantity" placeholder="Điền số lượng" />
        </td>
    </tr>
    `;
    body.insertAdjacentHTML('beforeend', content);
    body.dataset.number = number + 1;
    updatePrice();
});

removeButton.addEventListener('click', () => {
    const number = parseInt(body.dataset.number);
    if (number > 1) {
        body.removeChild(body.lastElementChild);
        body.dataset.number = number - 1;
    }
    updatePrice();
});

let productsList = [];

const updatePrice = () => {
    let total = 0;
    productsList.forEach((product) => {
        total += product.quantity * product.price;
    });
    $('#text-total').text(
        new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
        }).format(total)
    );
};

$(document).on('change', 'select.product-select', (e) => {
    const select = $(e.target);
    const number = select.data('number');
    const productId = select.val();
    const product = products.find((product) => product.id == productId);
    const quantityInput = $(`input[data-number=${number}]`);
    const quantity = quantityInput.val() ? parseInt(quantityInput.val()) : 0;
    product.quantity = quantity;
    productsList[number] = product;
    updatePrice();
});

$(document).on('input', 'input.product-quantity', (e) => {
    const quantityInput = $(e.target);
    const quantity = quantityInput.val() ? parseInt(quantityInput.val()) : 0;
    const number = quantityInput.data('number');
    productsList[number].quantity = quantity;
    updatePrice();
});

$('#add-trans-form').on('submit', (e) => {
    e.preventDefault();
    const formData = new FormData(e.target);
    // http://ptit-web-php.local/actions/add-transaction.php
    $.ajax({
        url: 'http://ptit-web-php.local/actions/add-transaction.php',
        data: $(e.target).serialize(),
        type: 'POST',
        processData: false,
        success: (data) => {
            const result = JSON.parse(data);
            if (parseInt(result.code) === 200) {
                toastr.success('Tạo đơn hàng thành công', 'Hệ thống');
                window.location.href = 'http://ptit-web-php.local/index.php';
            } else {
                toastr.error('Tạo đơn hàng thất bại', 'Hệ thống');
            }
        },
    });
});
