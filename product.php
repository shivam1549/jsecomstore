<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 p-4">
        <h2>Add Product</h2>
        <form id="formdata" enctype="multipart/form-data">
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
                <input type="file" name="mainimages">
            </div>
            <div class="form-group mt-2">
                <label for="gallery">Gallery</label>
                <input type="file" multiple name="galleryimages[]">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" class="form-control" value="Men, Black" id="category" name="category" placeholder="Enter category">
            </div>
            <div class="form-group mb-2">
                <label for="attributes">Attributes</label>
                <a href="javascript:void(0)" class="btn btn-info" id="add-variations">Add New</a>
                <div id="addatributes">

                </div>
            </div>
            <div class="form-group">
                <label for="variations">Variations</label>
                <a href="javascript:void(0)" class="btn btn-info" id="add-variations">Add New</a>
                <!-- <textarea class="form-control" id="variations" name="variations" rows="3" placeholder="Enter variations"></textarea> -->
            </div>
            <div id="variation-results" class="mt-4"></div>
            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status">
                    <option value="0" selected>Inactive</option>
                    <option value="1">Active</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Product</button>
        </form>
    </div>
</body>

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
                <div class="row">
                <input type="text" class="combinationsname" value="${combination}">
                    <div class="col-md-3">
                        <input type="number" class="attibutecomb_price" placeholder="Price" value="10" >
                    </div>
                    <div class="col-md-3">
                        <input type="file" class="attibutecomb_img" placeholder="Image URL">
                    </div>
                    <div class="col-md-3">
                        <input type="file" multiple class="attibutecomb_gallery" placeholder="Gallery URL">
                    </div>
                    <div class="col-md-3">
                        <input type="number" class="attibutecomb_qty" value="10" placeholder="Quantity" >
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
        // console.log(attributeNames, attributeValues  + "A");
        // const attributes = attributeNames.map((name, i) => ({ name, values: attributeValues[i] }));

        attributeNames.map((element, i) => {
            if (!attributes[element.value.trim()]) {
                attributes[element.value.trim()] = [];
            }
            attributes[element.value.trim()].push(attributeValues[i].value.trim().split('|'))
        })

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
        xhr.open("POST", "add-product.php", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {

                }
            }
        };

        xhr.send(formdata);



      


    })
</script>

</html>