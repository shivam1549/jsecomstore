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
            <div class="col-md-8">
                <h2 class="mb-4">Checkout Form</h2>
                <form id="checkoutform">
                    <div class="row">
                        <!-- Billing Information -->
                        <div class="col-md-12">
                            <h4 class="mb-3">Billing Information</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billingFirstName">First Name</label>
                                        <input type="text" class="form-control" value="Shivam" name="billingFirstName" id="billingFirstName" placeholder="First Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billingLastName">Last Name</label>
                                        <input type="text" class="form-control" value="Verma" name="billingLastName" id="billingLastName" placeholder="Last Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billingPhone">Phone </label>
                                        <input type="number" class="form-control" value="6395741369" name="billingPhone" id="billingPhone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="billingEmail">Email</label>
                                        <input type="email" class="form-control" value="sv708128@gmail.com" name="billingEmail" id="billingEmail" placeholder="Email">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="billingAddress">Address</label>
                                <input type="text" class="form-control" name="billingAddress" id="billingAddress" value="12 C Mall Road" placeholder="Address">
                            </div>
                            <div class="form-group">
                                <label for="billingCity">City</label>
                                <input type="text" class="form-control" name="billingCity" id="billingCity" value="Kanpur" placeholder="City">
                            </div>
                            <div class="form-group">
                                <label for="billingState">State</label>
                                <input type="text" class="form-control" name="billingState" id="billingState" value="Uttar Pradesh" placeholder="State">
                            </div>
                            <div class="form-group">
                                <label for="billingZip">Zip Code</label>
                                <input type="text" class="form-control" name="billingZip" id="billingZip" value="909011" placeholder="Zip Code">
                            </div>
                            <div class="form-group">
                                <label for="billingCountry">Country</label>
                                <input type="text" class="form-control" name="billingCountry" id="billingCountry" value="India" placeholder="Country">
                            </div>
                        </div>
                        <!-- Shipping Information -->


                        <div class="col-md-12">

                            <a class="" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                Shipping Information
                            </a>
                            <div class="form-check mb-3">
                                <input type="checkbox" class="form-check-input" id="sameAsBilling">
                                <label class="form-check-label" for="sameAsBilling">Same as Billing Information</label>
                            </div>
                            <div class="collapse" id="collapseExample">


                                <div class="form-group">
                                    <label for="shippingFirstName">First Name</label>
                                    <input type="text" class="form-control" name="shippingFirstName" id="shippingFirstName" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                    <label for="shippingLastName">Last Name</label>
                                    <input type="text" class="form-control" name="shippingLastName" id="shippingLastName" placeholder="Last Name">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shippingPhone">Phone </label>
                                            <input type="number" class="form-control" name="shippingPhone" id="shippingPhone" placeholder="Phone">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="shippingEmail">Email</label>
                                            <input type="email" class="form-control" name="shippingEmail" id="shippingEmail" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="shippingAddress">Address</label>
                                    <input type="text" class="form-control" name="shippingAddress" id="shippingAddress" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <label for="shippingCity">City</label>
                                    <input type="text" class="form-control" name="shippingCity" id="shippingCity" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <label for="shippingState">State</label>
                                    <input type="text" class="form-control" name="shippingState" id="shippingState" placeholder="State">
                                </div>
                                <div class="form-group">
                                    <label for="shippingZip">Zip Code</label>
                                    <input type="text" class="form-control" name="shippingZip" id="shippingZip" placeholder="Zip Code">
                                </div>
                                <div class="form-group">
                                    <label for="shippingCountry">Country</label>
                                    <input type="text" class="form-control" name="shippingCountry" id="shippingCountry" placeholder="Country">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Payment Information -->
                    <button class="btn btn-dark mt-2" type="submit">Place Order</button>
                </form>
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
                                totalprice += (parseInt(vals.qty) * parseInt(vals.price));
                                html += `<div class="row">
                                <div class="col-md-4">
                                    <img class="productimg" width="100px" src="${vals.img}">

                                    <h5>${vals.title}</h5>
                                    `
                                attributes = vals.attributes;
                                for (var attr in attributes) {
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

                            // document.querySelector("#cartitems").innerHTML = html;

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

        function manageCartqty(cartkey, quantity) {
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

        function validateForm() {
            var lettersOnly = /^[A-Za-z\s]+$/;
            var numbersOnly = /^[0-9]+$/;
            var phonePattern = /^[0-9]{8,}$/;

            var billingFirstName = document.getElementById("billingFirstName").value;
            var billingLastName = document.getElementById("billingLastName").value;
            var billingPhone = document.getElementById("billingPhone").value;
            var billingCity = document.getElementById("billingCity").value;
            var billingState = document.getElementById("billingState").value;
            var billingCountry = document.getElementById("billingCountry").value;
            var billingZip = document.getElementById("billingZip").value;

            var shippingFirstName = document.getElementById("shippingFirstName").value;
            var shippingLastName = document.getElementById("shippingLastName").value;
            var shippingPhone = document.getElementById("shippingPhone").value;
            var shippingCity = document.getElementById("shippingCity").value;
            var shippingState = document.getElementById("shippingState").value;
            var shippingCountry = document.getElementById("shippingCountry").value;
            var shippingZip = document.getElementById("shippingZip").value;

            if (!billingFirstName.match(lettersOnly) || !billingLastName.match(lettersOnly)) {
                alert("Billing First Name and Last Name should contain only letters.");
                return false;
            }

            if (!billingCity.match(lettersOnly) || !billingState.match(lettersOnly) || !billingCountry.match(lettersOnly)) {
                alert("Billing City, State, and Country should contain only letters.");
                return false;
            }

            if (!billingZip.match(numbersOnly)) {
                alert("Billing Zip Code should be numeric.");
                return false;
            }

            if (!billingPhone.match(phonePattern)) {
                alert("Billing Phone Number should be at least 8 digits.");
                return false;
            }

            if (document.getElementById("collapseExample").classList.contains("show")) {
                if (!shippingFirstName.match(lettersOnly) || !shippingLastName.match(lettersOnly)) {
                    alert("Shipping First Name and Last Name should contain only letters.");
                    return false;
                }

                if (!shippingCity.match(lettersOnly) || !shippingState.match(lettersOnly) || !shippingCountry.match(lettersOnly)) {
                    alert("Shipping City, State, and Country should contain only letters.");
                    return false;
                }

                if (!shippingZip.match(numbersOnly)) {
                    alert("Shipping Zip Code should be numeric.");
                    return false;
                }

                if (!shippingPhone.match(phonePattern)) {
                    alert("Shipping Phone Number should be at least 8 digits.");
                    return false;
                }
            }

            return true;
        }

        document.getElementById("checkoutform").addEventListener("submit", function(e) {
            // var formdata = document.getElementById("checkoutform");
            var formDatat = new FormData(document.getElementById("checkoutform"));
            // console.log(formDatat);
            e.preventDefault();
            if (validateForm()) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "checkout-submit.php", true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.response);
                            if (response.success) {
                                location.href = response.success;
                            }
                        }
                    }
                }
                xhr.send(formDatat);
            }

        })

        document.getElementById("sameAsBilling").addEventListener("change", function() {
            if (this.checked) {
                document.getElementById("shippingFirstName").value = document.getElementById("billingFirstName").value;
                document.getElementById("shippingLastName").value = document.getElementById("billingLastName").value;
                document.getElementById("shippingPhone").value = document.getElementById("billingPhone").value;
                document.getElementById("shippingEmail").value = document.getElementById("billingEmail").value;
                document.getElementById("shippingAddress").value = document.getElementById("billingAddress").value;
                document.getElementById("shippingCity").value = document.getElementById("billingCity").value;
                document.getElementById("shippingState").value = document.getElementById("billingState").value;
                document.getElementById("shippingZip").value = document.getElementById("billingZip").value;
                document.getElementById("shippingCountry").value = document.getElementById("billingCountry").value;
            } else {
                document.getElementById("shippingFirstName").value = "";
                document.getElementById("shippingLastName").value = "";
                document.getElementById("shippingPhone").value = "";
                document.getElementById("shippingEmail").value = "";
                document.getElementById("shippingAddress").value = "";
                document.getElementById("shippingCity").value = "";
                document.getElementById("shippingState").value = "";
                document.getElementById("shippingZip").value = "";
                document.getElementById("shippingCountry").value = "";
            }
        });
    </script>
</body>

</html>