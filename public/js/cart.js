function update_row(btn_element, product_price, decrease) {
    let parent = btn_element.parentElement;

    /**
     * Fetch the element that holds the current item total price
     * and update it to reflect the current item total
    **/ 
    let price_element = parent.parentElement.querySelector(".price");
    let current_price = parseFloat(price_element.innerText);
    if (decrease)
        current_price -= product_price;
    else
        current_price += product_price;
    price_element.innerText = current_price;

    /**
     * Fetch the element that holds the current item quantity and reflect the change made
    **/
    let quantity_element = parent.querySelector("strong")
    let quantity = parseInt(quantity_element.innerText)
    if (decrease)
        quantity--;
    else
        quantity++;
    quantity_element.innerText = quantity;
}