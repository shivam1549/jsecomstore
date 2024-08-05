<?php
include('header.php');
?>

<div class="content-wrapper">
    <form id="formdata" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add a product</h4>
                        <p class="card-description">

                        </p>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" value="Black Men T Shirts" name="title" placeholder="Enter product title" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_price">Regular Price</label>
                            <input type="number" class="form-control" id="reg_price" value="60" name="reg_price" placeholder="Enter regular price" required>
                        </div>
                        <div class="form-group">
                            <label for="sale_price">Sale Price</label>
                            <input type="number" class="form-control" id="sale_price" value="40" name="sale_price" placeholder="Enter sale price" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter short description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!</textarea>
                        </div>
                        <div class="form-group">
                            <label for="long_description">Long Description</label>
                            <textarea class="form-control" id="long_description" name="long_description" rows="5" placeholder="Enter detailed description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores vel sit quidem. Iste reiciendis at, reprehenderit accusantium nobis, culpa pariatur cupiditate a ex aliquam nisi harum? Ex laudantium quos exercitationem!</textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="image">Image </label>
                            <input class="form-control" type="file" name="mainimages">
                        </div>
                        <div class="form-group mt-2">
                            <label for="gallery">Gallery</label>
                            <input class="form-control" type="file" multiple name="galleryimages[]">
                        </div>
                        <h4 class="card-title">Attributes</h4>
                        <div class="form-group mb-2">

                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm" id="add-variations">Add New</a>
                            <div id="addatributes">

                            </div>
                        </div>
                        <h4 class="card-title">Variations</h4>
                        <div class="form-group">

                            <a href="javascript:void(0)" class="btn btn-secondary btn-sm" id="add-variations">Add New</a>
                            <!-- <textarea class="form-control" id="variations" name="variations" rows="3" placeholder="Enter variations"></textarea> -->
                        </div>
                        <div id="variation-results" class="mt-4"></div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Add Product</button>
                        </div>


                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Status</h4>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <h4 class="card-title">Categories</h4>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <input type="text" class="form-control" value="Men, Black" id="category" name="category" placeholder="Enter category">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>




<?php
include('footer.php');
?>

<script>
    document.querySelector("#add-variations").addEventListener("click", function() {
        var html = `<div class="row">
    <div class="col-md-4">
    <label>Name:</label>
        <input class="form-control attributename"  placeholder="f.e. size or color">
    </div>
      <div class="col-md-8">
        <label>Values:</label>
  <textarea class="form-control attributevalue"  placeholder="Enter options for customers to choose from, f.e. “Blue” or “Large”. Use “|” to separate different options."></textarea>
    </div>
    </div>
    `
        document.querySelector("#addatributes").insertAdjacentHTML('beforeend', html);


    })



    function generateCombinations(attributes) {
        if (attributes.length === 0) {
            return [
                []
            ];
        }
        const combinations = generateCombinations(attributes.slice(1));
        return attributes[0].values.flatMap(value =>
            combinations.map(combination => [attributes[0].name + ": " + value, ...combination])
        );
    }

    document.querySelector("#addatributes").addEventListener("change", function() {
        const attributeNames = Array.from(document.querySelectorAll(".attributename")).map(el => el.value.trim());
        const attributeValues = Array.from(document.querySelectorAll(".attributevalue")).map(el => el.value.trim().split('|'));
        console.log(attributeNames, attributeValues + "A");
        const attributes = attributeNames.map((name, i) => ({
            name,
            values: attributeValues[i]
        }));


        console.log(attributes + "B")
        const combinations = generateCombinations(attributes);

        const resultsDiv = document.querySelector("#variation-results");
        resultsDiv.innerHTML = '';

        combinations.forEach(combination => {
            const combinationStr = combination.join(', ');
            resultsDiv.insertAdjacentHTML('beforeend', `
            <div class="form-group mt-2">
                <label>Variation: ${combinationStr}</label>
                <input type="text" class="combinationsname form-control mb-2" value="${combination}">
                <div class="row">
                
                    <div class="col-md-3">
                    <label>Price</label>
                        <input type="number" class="attibutecomb_price form-control" placeholder="Price" value="10" >
                    </div>
                    <div class="col-md-3">
                      <label>Single Image</label>
                        <input type="file" class="attibutecomb_img form-control" placeholder="Image URL">
                    </div>
                    <div class="col-md-3">
                     <label>Gallery Images</label>
                        <input type="file" multiple class="attibutecomb_gallery form-control" placeholder="Gallery URL">
                    </div>
                    <div class="col-md-3">
                      <label>Product Quantity</label>
                        <input type="number" class="attibutecomb_qty form-control" value="10" placeholder="Quantity" >
                    </div>
                </div>
            </div>
        `);
        });
    });


    document.querySelector("#formdata").addEventListener("submit", function(e) {
        e.preventDefault();
        var formData = new FormData(document.querySelector("#formdata"));

        // Iterate over formData and log each key-value pair
        // for (let [key, value] of formData.entries()) {
        //     console.log(key, value);
        // }
        var attributes = {};


        const attributeNames = Array.from(document.querySelectorAll(".attributename"));
        const attributeValues = Array.from(document.querySelectorAll(".attributevalue"));

        attributeNames.map((element, i) => {
            const key = element.value.trim();
            const value = attributeValues[i].value.trim().split('|');

            if (!attributes[key]) {
                attributes[key] = new Set();
            }

            value.forEach(val => attributes[key].add(val));
        });

        // Convert sets back to arrays
        Object.keys(attributes).forEach(key => {
            attributes[key] = Array.from(attributes[key]);
        });

        // console.log(attributes)

        var combinationvalues = [];
        var attibutecombPrice = document.querySelectorAll(".attibutecomb_price");
        var attibutecombImg = document.querySelectorAll(".attibutecomb_img");
        var attibutecombGallery = document.querySelectorAll(".attibutecomb_gallery");
        var attibutecombQty = document.querySelectorAll(".attibutecomb_qty");
        var combinations = Array.from(document.querySelectorAll(".combinationsname"));
        combinations.map((element, i) => {
            const myarray = element.value.split(",");
            const combination = {
                price: attibutecombPrice[i].value,
                img: attibutecombImg[i].files[0], // Correct property is `files`
                gallery: Array.from(attibutecombGallery[i].files), // Correct property is `files`
                qty: attibutecombQty[i].value
            };

            myarray.forEach(item => {
                let parts = item.split(": ");
                combination[parts[0].trim()] = parts[1];
            });

            console.log(combination)

            combinationvalues.push(combination);
        });

        console.log(combinationvalues)

        var formdata = new FormData(document.querySelector("#formdata"));
        formdata.append("attributes", JSON.stringify(attributes));
        formdata.append("variations", JSON.stringify(combinationvalues.map((combination, index) => {
            // Append files to FormData
            formdata.append(`img_${index}`, combination.img);
            combination.gallery.forEach((file, fileIndex) => {
                formdata.append(`gallery_${index}_${fileIndex}`, file);
            });

            // Remove the file objects from the combination for JSON serialization
            return {
                ...combination,
                img: `img_${index}`,
                gallery: combination.gallery.map((_, fileIndex) => `gallery_${index}_${fileIndex}`)
            };
        })));
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "codes/add-product.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {

                }
            }
        };

        xhr.send(formdata);






    })
</script>

<?php
include('script.php');
?>