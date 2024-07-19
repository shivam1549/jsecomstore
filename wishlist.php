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


        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        loadWishlist().then(() => {
            console.log("Wishlist loaded successfully");
        }).catch((error) => {
            console.error("Error loading wishlist:", error);
        });


        function loadWishlist() {
            var html = '';
            return new Promise((resolve, reject) => {


                var xhr = new XMLHttpRequest();
                xhr.open("POST", "codes/load-wishlist.php", true);

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var response = JSON.parse(xhr.response);
                            if (response.msg) {
                                html += `<h4>My Wishlist</h4>`
                                var jsonArray = Object.values(response.data);
                                console.log(jsonArray)

                                jsonArray.forEach(vals => {

                                    html += `<div class="row">

                                <div class="col-md-4">
                                    <a href="product.html?id=${vals.id}"> 
                                    <img class="productimg" width="100px" src="${vals.image}">

                                    <h5>${vals.title}</h5>
                                    </a>
                                    `


                                    html += `
                                </div>


                                 <div class="col-md-3">
                                   <a class="removecart" data-key="${vals.id}" href="javascript:void(0)">Remove</a>
                                </div>
                                </div>
                                `;
                                });

                                document.querySelector("#cartitems").innerHTML = html;
                                resolve(true);
                                var removewishlist = document.querySelectorAll(".removecart");
                                removewishlist.forEach(elem => {
                                    elem.addEventListener("click", function(e) {
                                        var productid = e.target.getAttribute("data-key");
                                        console.log(productid)
                                        removeWishlist(productid);
                                    })
                                })


                            } else {
                                resolve(false);
                                document.querySelector("#cartitems").innerHTML = "No products in cart";
                            }
                        } else {
                            reject(new Error('Request failed'));
                        }
                    }
                };

                xhr.send();
            });
        }

        function removeWishlist(productid) {
            if (productid) {
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "codes/removewishlist.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // console.log(xhr.response + "De;eyed");
                            var response = JSON.parse(xhr.response);
                            // console.log(response)
                            if (response.msg) {
                                // alert("Deleted Successfully");
                                loadWishlist().then(() => {
                                    console.log("Wishlist loaded successfully");
                                }).catch((error) => {
                                    console.error("Error loading wishlist:", error);
                                });

                            } else {
                                alert(response.data);
                            }

                        }

                    }
                }
                xhr.send("productid=" + encodeURIComponent(productid));
            }
        }
    </script>
</body>

</html>