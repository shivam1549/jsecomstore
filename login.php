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
            <div class="col-md-6">
            <form id="loginForm">
              <div class="mb-3">
                <label for="loginEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="loginEmail" >
                <div id="emailError" class="text-danger"></div> <!-- Error message container -->
              </div>
              <input type="hidden" id="logintest" value="">
              <div class="mb-3">
                <label for="loginPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="loginPassword" >
                <div id="passwordError" class="text-danger"></div> <!-- Error message container -->
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </form>
            </div>

            <div class="col-md-6" >
            <form id="registerForm">
              <div class="mb-3">
              <input type="hidden" id="registertest" value="">
                <label for="registerEmail" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname">
                <span class="text-danger nameerr"></span>
              </div>
              <div class="mb-3">
                <label for="registerEmail" class="form-label">Email address</label>
                <input type="email" class="form-control" id="registerEmail">
                <span class="text-danger emailerr"></span>
              </div>
              <div class="mb-3">
                <label for="registerPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="registerPassword">
                <span class="text-danger passworderr"></span>
              </div>
              <div class="mb-3">
                <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="registerConfirmPassword">
                <span class="text-danger confpassworderr"></span>
              </div>
              <button type="submit" class="btn btn-primary">Register</button>
            </form>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
       
  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('registerForm').addEventListener('submit', function(event) {
      event.preventDefault();

      // Clear previous error messages
      document.querySelector('.nameerr').textContent = '';
      document.querySelector('.emailerr').textContent = '';
      document.querySelector('.passworderr').textContent = '';
      document.querySelector('.confpassworderr').textContent = '';

      // Get form data
      const fullName = document.getElementById('fullname').value;
      const email = document.getElementById('registerEmail').value;
      const password = document.getElementById('registerPassword').value;
      const confirmPassword = document.getElementById('registerConfirmPassword').value;
      const testid = document.querySelector("#registertest").value


      // Basic validation
      let hasError = false;
      if (fullName === '') {
        document.querySelector('.nameerr').textContent = 'Full name is required';
        hasError = true;
      }
      if (email === '') {
        document.querySelector('.emailerr').textContent = 'Email is required';
        hasError = true;
      }
      if (password === '') {
        document.querySelector('.passworderr').textContent = 'Password is required';
        hasError = true;
      }
      if (confirmPassword !== password) {
        document.querySelector('.confpassworderr').textContent = 'Passwords do not match';
        hasError = true;
      }

      if (hasError) {
        return;
      }

      // Prepare data for submission
      const formData = new FormData();
      formData.append('fullname', fullName);
      formData.append('email', email);
      formData.append('password', password);
      

      // AJAX request to submit form data
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'codes/register.php', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {

            const response = JSON.parse(xhr.response);
            console.log(response);
            if (response.message == 'Account Created Successfully') {
              // Registration successful, handle success (e.g., redirect to login page)
              // alert(response.message);
              window.location.href = `index.html`;
              // alert('Registration successful!');
              // location.reload();
            } else {
              // Handle server-side validation errors
              alert(response.message);
              // if (response.errors.name) {
              //   document.querySelector('.nameerr').textContent = response.errors.name;
              // }
              // if (response.errors.email) {
              //   document.querySelector('.emailerr').textContent = response.errors.email;
              // }
              // if (response.errors.password) {
              //   document.querySelector('.passworderr').textContent = response.errors.password;
              // }
            }
          } else {
            console.error('Error: ' + xhr.status);
          }
        }
      };
      xhr.send(formData);
    });
  });


  document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
      event.preventDefault();

      // Clear previous error messages
      document.getElementById('emailError').textContent = '';
      document.getElementById('passwordError').textContent = '';

      // Get form data
      const email = document.getElementById('loginEmail').value;
      const password = document.getElementById('loginPassword').value;
      const testid = document.querySelector("#logintest").value

      // Validate email
      if (!isValidEmail(email)) {
        document.getElementById('emailError').textContent = 'Invalid email format';
        return;
      }

      // Validate password
      if (password.length <= 0) {
        document.getElementById('passwordError').textContent = 'Password required';
        return;
      }

      // Prepare data for submission
      const formData = new FormData();
      formData.append('email', email);
      formData.append('password', password);

      // AJAX request to submit form data
      const xhr = new XMLHttpRequest();
      xhr.open('POST', 'codes/login.php', true);
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            const response = JSON.parse(xhr.response);
            if (response.message == 'Login success') {
              window.location.href = `index.html`;
              // Login successful, redirect to dashboard or homepage
              // alert('Login successful!');
              // window.location.href = 'dashboard.php'; 
            } else {
              // Login failed, display error message
              alert(response.message);
            }
          } else {
            console.error('Error: ' + xhr.status);
          }
        }
      };
      xhr.send(formData);
    });
  });

  // Function to validate email format
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }
    </script>
</body>

</html>