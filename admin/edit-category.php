<?php
include('header.php');
?>

<div class="content-wrapper">
    <form id="formdata" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add a category</h4>
                        <div class="card-description"></div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" value="Black Men T Shirts" name="title" placeholder="Enter product title" required>
                            <div class="error" id="title-error"></div>
                        </div>

                        <div class="form-group">
                            <label for="url">Slug</label>
                            <input type="text" class="form-control" id="url" value="" name="url" placeholder="Enter product title" required>
                            <div class="error" id="url-error"></div>
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter short description">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Officia quibusdam ipsum libero, necessitatibus assumenda quidem nulla. Tempore facere iste cupiditate a, nostrum harum quibusdam, dolor, suscipit ducimus velit consequuntur eius!</textarea>
                        </div>

                        <div class="form-group mt-2">
                            <label for="image">Image </label>
                            <input class="form-control" type="file" name="mainimages">

                            <div id="catimg"></div>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="0" selected>Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>

                        <div class="text-right">
                            <button type="submit" class="btn btn-primary">Update Catgeory</button>
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
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id');
    loadCategories(id);

    function loadCategories(id) {
        var html = '';
        fetch("codes/get-editcategories.php?id="+id)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.msg == 'success') {

                        document.querySelector("#title").value = data.data.name;
                        document.querySelector("#url").value = data.data.url;
                        document.querySelector("#description").value = data.data.description;
                        document.querySelector("#status").value = data.data.status;
                        document.querySelector("#catimg").innerHTML = data.data.image ? `<img width='100px' src='../uploads/${data.data.image}'>` : "";
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }


    function convertToSlug(text) {
        return text
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters
            .trim()
            .replace(/\s+/g, '-') // Replace spaces with dashes
            .replace(/-+/g, '-'); // Replace multiple dashes with single dash
    }

    function validateField(value) {
        return /^[a-zA-Z0-9\s]+$/.test(value); // Only alphanumeric characters and spaces are allowed
    }

    document.getElementById('title').addEventListener('input', function() {
        const titleValue = this.value;
        const slugValue = convertToSlug(titleValue);

        document.getElementById('url').value = slugValue;

        if (!validateField(titleValue)) {
            document.getElementById('title-error').innerText = 'No special characters allowed.';
        } else {
            document.getElementById('title-error').innerText = '';
        }

       
    });

    function validateUrlField(value) {
    return /^[a-zA-Z0-9-]+$/.test(value); // Allow alphanumeric characters and dashes
}


    document.getElementById('formdata').addEventListener('submit', function(e) {
        e.preventDefault();
        const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const id = urlParams.get('id');

        const titleValue = document.getElementById('title').value;
        const urlValue = document.getElementById('url').value;

        let isValid = true;

        if (!validateField(titleValue)) {
            document.getElementById('title-error').innerText = 'No special characters allowed.';
            isValid = false;
        } else {
            document.getElementById('title-error').innerText = '';
        }

        if (!validateUrlField(urlValue)) {
            document.getElementById('url-error').innerText = 'No special characters allowed.';
            isValid = false;
        } else {
            document.getElementById('url-error').innerText = '';
        }

        var msg = document.querySelector(".card-description");
        var formdata = new FormData(document.querySelector("#formdata"));
        formdata.append("categoryid", id);

        if (isValid) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "codes/update-category.php", true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var respsone = JSON.parse(xhr.response);
                        console.log(respsone)
                            if(respsone.success){
                                msg.innerHTML = respsone.success;
                            }
                            else{
                                msg.innerHTML = respsone.error; 
                            }
                        } 
                    }
                };
                xhr.send(formdata);
            }

           
        
        
    });
</script>

<?php
include('script.php');
?>