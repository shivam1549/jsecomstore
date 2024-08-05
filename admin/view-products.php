<?php
include('header.php');
?>

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Manage Products</h4>
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
                            <tbody id="producttable">
                               

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
        fetch("codes/get-products.php")
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if(data.msg == 'success'){
                    var i = 1;
                    data.data.forEach(elem =>{
                        html += `
                         <tr>
                                    <td>${i}</td>
                                    <td>${elem.title}</td>
                                    <td><img src="../${elem.image}"></td>
                                    <td><span class="badge badge-${elem.status == '1' ? "danger": "success"}">${elem.status == "1" ? "Draft": "Published"}</span></td>
                                    <td><a href="${elem.id}">Edit</a></td>
                                </tr>
                        `;
                        i++;
                    })

                    document.querySelector("#producttable").innerHTML = html;
                }
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }
</script>

<?php
include('script.php');
?>