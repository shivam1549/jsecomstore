<?php
include('header.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Categories</h4>
                    <p class="card-description">

                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Title</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="categorytable">


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
include('footer.php');
?>

<script>
    loadProducts();

    function loadProducts() {
        var html = '';
        fetch("codes/get-categories.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.msg == 'success') {
                    var i = 1;
                    data.data.forEach(elem => {
                        html += `
                         <tr>
                                    <td>${i}</td>
                                    <td>${elem.name}</td>
                                    <td><img src="../uploads/${elem.image}"></td>
                                    <td><span class="badge badge-${elem.status == '1' ? "danger": "success"}">${elem.status == "1" ? "Draft": "Published"}</span></td>
                                    <td><a href="edit-category.php?id=${elem.id}">Edit</a> <a data-id="${elem.id}" class="removecategory" href="javascript:void(0)">Delete</a></td>
                                </tr>
                        `;
                        i++;
                    })

                    document.querySelector("#categorytable").innerHTML = html;
                    var removecategory = document.querySelectorAll(".removecategory");
                    removecategory.forEach(elem => {
                        elem.addEventListener("click", function() {
                            var id = elem.getAttribute("data-id");
                            deletecategory(id);
                        })
                    })
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    function deletecategory(id) {
        var userConfirmed = confirm("Are you sure you want to delete this category?");
        if (userConfirmed) {
            var formData = new FormData();
            formData.append("categoryid", id);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "codes/remove-category.php", true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log(response);
                        var response = JSON.parse(xhr.response);
                        if (response.msg) {
                            loadProducts();
                        } else {
                            alert("Something went wrong");
                        }
                    }
                }
            };

            xhr.send(formData);
        }
    }
</script>

<?php
include('script.php');
?>