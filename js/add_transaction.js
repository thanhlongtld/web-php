const addButton = document.querySelector("#add_detail");
const removeButton = document.querySelector("#remove_detail");
const body = document.querySelector("#detail_body");
const textTotal = document.querySelector("#text-total");

addButton.addEventListener("click", () => {
    const number = parseInt(body.dataset.number);
    const content = `
    <tr>
        <td>
            <select class="form-control" id="product" name="products[${number}][product_id]">
                <option value="">Chọn sản phẩm</option>
                <?php
                foreach ($products as $product) {
                    echo '<option value="' . $product['id'] . '">' . $product['name'] . '</option>';
                }
                ?>

            </select>
        </td>
        <td>
            <input name="products[${number}][quantity]" class="form-control" placeholder="Điền số lượng" />
        </td>
    </tr>
    `;
    body.insertAdjacentHTML("beforeend", content);
    body.dataset.number = number + 1;
});

removeButton.addEventListener("click", () => {
    const number = parseInt(body.dataset.number);
    if (number > 1) {
        body.removeChild(body.lastElementChild);
        body.dataset.number = number - 1;
    }
});


document.addEventListener('change', (e)=>{
    
})