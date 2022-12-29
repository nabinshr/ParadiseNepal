<?php
ob_start();
session_start();

include '../../database.php';

require_once '../../init.php';
require_once ROOT . "admin/header.php";
require_once ROOT . "helper.php";
include_once ROOT . "admin/sidebar.php";

$id = $_GET['id'];
if (isset($id)) {
    $query = "SELECT * FROM `activities` WHERE id = $id";
    $execute = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($execute);
}

?>
<div class="col-md-10 content">
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Activity
        </div>
        <div class="panel-body">
            <?php
if (isset($_POST['submit'])) {
    $errors = array();
    $activityName = $_POST['name'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $modifiedBy = $_SESSION['uid'];
    $modifiedDate = date('Y-m-d');
    //var_dump($createdDate);
    if (empty($activityName)) {
        $errors[] = 'Activity Name cannot be empty';
    }

    if (empty($status)) {
        $errors[] = 'Status cannot be empty';
    }

    if (empty($errors) == true) {
        $query = "UPDATE `activities` SET `Activity`= '$activityName',`Description`='$description',`Status`='$status',`ModifiedBy`='$modifiedBy',`ModifiedAt`='$modifiedDate' WHERE id='$id'";
        $execute = mysqli_query($con, $query);
        if ($execute) {
            alertMessage("alert-success", array("Successfully inserted"));

            header('location:index.php');

        } else {
            echo alertMessage("alert-danger", array("There was an error when inserting data."));
        }
    } else {
        echo alertMessage("alert-danger", $errors);
    }
}

?>
            <form action="" Method="Post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                Activity Name
                            </label>
                            <input type="text" class="form-control" name="name" value="<?=$data['Activity']?>">

                        </div>
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                Status
                            </label>
                            <select class="form-control" name="status">
                                <option value="1" <?=($data['Status'] == 1) ? "selected='true'" : ""?>>Publish</option>
                                <option value="0" <?=($data['Status'] == 0) ? "selected='true'" : ""?>>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">
                        <abbr title="required">*</abbr>
                        Description
                    </label>
                    <textarea type="text" class="form-control" name="description"><?=$data['Description']?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once "../footer.php";?>