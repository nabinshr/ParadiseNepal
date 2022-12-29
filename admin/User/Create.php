<?php
include '../../database.php';
session_start();

require_once '../../init.php';
require_once "../header.php";
require_once "../../helper.php";
include_once "../sidebar.php";

?>
<div class="col-md-10 content">
    <?php
if (isset($_POST['submit'])) {
    $errors = array();
    $Name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    //var_dump($createdDate);
    if (empty($Name)) {
        $errors[] = 'Name cannot be empty';
    }

    if (empty($email)) {
        $errors[] = 'Email cannot be empty';
    }

    if (empty($username)) {
        $errors[] = 'Username cannot be empty';
    }

    if (empty($password)) {
        $errors[] = 'Password cannot be empty';
    }

    if (empty($errors) == true) {
        $encryptPassword = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO `users`(`username`, `password`, `e_mail`, `fullname`) VALUES ('$username','$encryptPassword','$email','$Name')";
        $execute = mysqli_query($con, $query);
        if ($execute) {
            echo alertMessage("alert-success", array("Successfully inserted"));
        } else {
            echo alertMessage("alert-danger", array("There was an error when inserting data."));
        }
    } else {
        echo alertMessage("alert-danger", $errors);
    }
}

?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Create User
        </div>
        <div class="panel-body">
            <form action="" Method="Post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                FullName
                            </label>
                            <input type="text" class="form-control" name="name">

                        </div>
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                Email
                            </label>
                            <input type="text" class="form-control" name="email" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">
                            <abbr title="required">*</abbr>
                            username
                        </label>
                        <input type="text" class="form-control" name="username" />
                    </div>
                    <div class="col-md-6">
                        <label for="name">
                            <abbr title="required">*</abbr>
                            Password
                        </label>
                        <input type="password" class="form-control" name="password" />
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once "../footer.php";?>