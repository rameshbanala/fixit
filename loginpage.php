<?php
session_start();
if (!isset($_SESSION['signup'])) {
    $_SESSION['signup'] = false;
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSnCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Fixit</title>
    <link rel="stylesheet" href="loginpage.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light top-nav-section">
        <a class="navbar-brand" href="#">FixIt</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a id="navSignUpOption" class="nav-link <?php if ($_SESSION['signup']) { echo 'd-none'; } ?>" href="#">Signup <span class="sr-only">(current)</span></a>
                    <a id="navLoginOption" class="nav-link <?php if (!$_SESSION['signup']) { echo 'd-none'; } ?>" href="#">Login <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="bottom-section">
        <div class="wrapper">
            <div class="login-form <?php if ($_SESSION['signup']) { echo 'd-none'; } ?>" id="loginform">
                <form action="validate.php" method="post">
                    <h1>Login</h1>
                    <div class="input-box">
                        <input type="text" name="email" placeholder="Email" id="exampleInputEmail1">
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" placeholder="Password" id="exampleInputPassword1">
                        <i class='bx bxs-lock-alt'></i>
                    </div>
                    <button type="submit" id="submitBtn" class="btn">Login</button>
                    <div class="register-link">
                        <p>Dont have an account? <a href="#" id="signupToggler">Register</a></p>
                    </div>
                </form>
            </div>
            <div class="login-form <?php if (!$_SESSION['signup']) { echo 'd-none'; } ?>" id="signupform">
                <form action="signuppage.php" method="post">
                    <h1>Signup</h1>
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" name="name" class="form-control" id="inputName" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" name="email" class="form-control" id="inputEmail4" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword4" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputAddress">Address</label>
                        <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main St" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="inputCity">City</label>
                            <input type="text" name="city" class="form-control" id="inputCity" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputZip">Pin</label>
                            <input type="text" name="pincode" class="form-control" id="inputZip" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="inputState">Type</label>
                            <select id="inputState" name="userType" class="form-control">
                                <option selected>User</option>
                                <option>Worker</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="phno">phonenumber</label>
                        <input type="number" name="phNo" class="form-control" id="phno" required>
                    </div>
                    <div class="form-group">
                        <label for="img">image</label>
                        <input type="file" name="imgUrl" class="form-control" id="img" required>
                    </div>
                    <button type="submit" class="btn">Signup</button>
                    <div class="register-link">
                        <p>have an account? <a href="#" id="logintoggler">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="loginpage.js"></script>
</body>
</html>
