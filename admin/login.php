<?php
include '../database.php';
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {
        $query = "SELECT * FROM `users` where `username` = '$username'";
        $execute = mysqli_query($con, $query);
        if (mysqli_num_rows($execute) > 0) {
            $data = mysqli_fetch_assoc($execute);

            if (password_verify($password, $data['password'])) {
                session_start();
                $_SESSION['uid'] = $data['id'];
                $_SESSION['username'] = $data['username'];
                header('location:/paradisenepal/admin/dashboard.php');
            }
        } else {
            ?>
<script>
alert('username or password incorrect !');
window.open('login.php', '_self');
</script>
<?php
}
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
</head>

<body>
    <form action="" method="post">
        <div class="col-md-4 col-md-offset-4" style="padding-top:10%;">
            <div class=" panel panel-default">
                <div class="panel-heading">
                    Login
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label for="username">username</label>
                        <input type="text" class="form-control" id="username" placeholder="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="password" placeholder="Password"
                            name="password">
                    </div>
                    <button type="submit" class="btn btn-default" name="login">Submit</button>
                </div>
            </div>
        </div>
    </form>
</body>

</html>