<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body>

    <div class="container p-4">
        <div class="row">
            <div class="col-md-8" id="cartitems">

            </div>

            <div class="col-md-4" id="sidecart">

            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        loadcart();

        function loadcart() {
            var html = '';
            var attributes = '';
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "load-cart.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.response);
                        if (response.success) {
                            html += `<h4>My Cart</h4>`
                            var jsonArray = Object.values(response.data);
                            console.log(jsonArray)
                            var totalprice = 0;
                            jsonArray.forEach(vals => {
                                totalprice += (parseInt(vals.qty)*parseInt(vals.price));
                                html += `<div class="row">
                                <div class="col-md-4">
                                    <img class="productimg" width="100px" src="${vals.img}">

                                    <h5>${vals.title}</h5>
                                    `
                                    attributes = vals.attributes;
                                    for(var attr in attributes){
                                    html += `<span>${attr} - ${attributes[attr]} </span><br>`;    
                                    }

                                html += `
                                </div>

                                <div class="col-md-3">
                                    
                                    <p class="text-success bold">${vals.qty} x $${vals.price}</p>
                                    <p>Subtotal: $${parseInt(vals.qty)*parseInt(vals.price)}  </p>
                                </div>

                                 <div class="col-md-2">
                                    <input class="qtycart w-50" data-key="${vals.cartkey.trim()}" min="1" value="${vals.qty}" type="number">
                                </div>

                                 <div class="col-md-3">
                                   <a class="removecart" data-key="${vals.cartkey.trim()}" href="javascript:void(0)">Remove</a>
                                </div>
                                </div>
                                `;
                            });

                            document.querySelector("#cartitems").innerHTML = html;

                            var sidebar = '';
                            sidebar = `
                            <div class="card">
                            
                            <div class="card-body">
                            <h4>Cart Summary</h4>
                            <div style="justify-content:space-between" class="d-flex mb-3 border-bottom">
                            <strong>Subtotal:</strong>
                             <span>$${totalprice}</span>
                            </div>
                             <div style="justify-content:space-between" class="d-flex mb-3 border-bottom">
                            <strong>Shipping:</strong>
                             <span>$0</span>
                            </div>
                               <div style="justify-content:space-between" class="d-flex border-bottom">
                            <strong>Total:</strong>
                             <span>${totalprice}</span>
                            </div>
                            <div class="">
                                <a class="btn btn-dark mt-2 btn-block" href="checkout.php">Proceed to checkout</a>
                            </div>
                            </div>
                            </div>
                            `;

                            document.querySelector("#sidecart").innerHTML = sidebar;

                            var cartremove = document.querySelectorAll(".removecart");
                            cartremove.forEach(elem => {
                                elem.addEventListener("click", function() {


                                    var cartkey = elem.getAttribute("data-key");
                                    removeCart(cartkey);
                                })

                            })

                            var cartmanage = document.querySelectorAll(".qtycart");
                            cartmanage.forEach(elem => {
                                elem.addEventListener("change", function() {

                                    var quantity = elem.value;
                                    var cartkey = elem.getAttribute("data-key");
                                    manageCartqty(cartkey, quantity);
                                })

                            })

                        } else {
                            document.querySelector("#cartitems").innerHTML = "No products in cart";
                        }
                    }
                }
            };

            xhr.send();
        }

        function removeCart(cartkey) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "remove-cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.response);
                        if (response.success) {
                            loadcart();
                        }
                    }
                }
            }
            xhr.send("id=" + encodeURIComponent(cartkey));
        }

        function manageCartqty(cartkey, quantity){
            // alert(cartkey + quantity);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "manage-cart.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.response);
                        if (response.success) {
                            loadcart();
                        }
                    }
                }
            }
            xhr.send("id=" + encodeURIComponent(cartkey) + "&qty=" + encodeURIComponent(quantity));
        }
    </script>
</body>

</html>