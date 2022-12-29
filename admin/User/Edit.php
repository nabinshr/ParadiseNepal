<?php
include '../../database.php';
session_start();

require_once '../../init.php';
require_once "../header.php";
require_once "../../helper.php";
include_once "../sidebar.php";

$id = $_GET['id'];
if (isset($id)) {
    $query = "SELECT * FROM `users` WHERE id = $id";
    $execute = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($execute);
}

?>
<div class="col-md-10 content">
    <?php
if (isset($_POST['submit'])) {
    $errors = array();
    $Name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $pass = $_POST['pass'];
    if (empty($Name)) {
        $errors[] = 'Name cannot be empty';
    }

    if (empty($email)) {
        $errors[] = 'Email cannot be empty';
    }

    if (empty($username)) {
        $errors[] = 'Username cannot be empty';
    }

    if (empty($password) && empty($pass)) {
        $errors[] = 'Password cannot be empty';
    }

    if (empty($errors) == true) {
        if (!empty($password)) {
            $encryptPassword = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $encryptPassword = $pass;
        }

        $query = "UPDATE `users` SET `username`='$username',`password`='$encryptPassword',`e_mail`='$email',`fullname`='$Name' WHERE `id` = '$id'";
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
            Edit User
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
                            <input type="text" class="form-control" name="name" value="<?=$data["fullname"]?>">

                        </div>
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                Email
                            </label>
                            <input type="text" class="form-control" name="email" value="<?=$data["e_mail"]?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="name">
                            <abbr title="required">*</abbr>
                            username
                        </label>
                        <input type="text" class="form-control" name="username" value="<?=$data["username"]?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="name">
                            <abbr title="required">*</abbr>
                            Password
                        </label>
                        <input type="password" class="form-control" name="password" />
                        <input type="hidden" value="<?=$data["password"]?>" name="pass">
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