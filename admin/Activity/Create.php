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
    $activityName = $_POST['name'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $createdBy = $_SESSION['uid'];
    $createdDate = date('Y-m-d');
    //var_dump($createdDate);
    if (empty($activityName)) {
        $errors[] = 'Activity Name cannot be empty';
    }

    if (empty($status)) {
        $errors[] = 'Status cannot be empty';
    }

    if (empty($errors) == true) {
        $query = "INSERT INTO `activities` (`Activity`, `Description`, `Status`, `CreatedBy`, `CreatedAt`) VALUES ('$activityName', '$description', '$status', '$createdBy', '$createdDate')";
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
            Create Tour Package
        </div>
        <div class="panel-body">
            <form action="" Method="Post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                Activity Name
                            </label>
                            <input type="text" class="form-control" name="name">

                        </div>
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                Status
                            </label>
                            <select class="form-control" name="status">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">
                        <abbr title="required">*</abbr>
                        Description
                    </label>
                    <textarea type="text" class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once "../footer.php";?>