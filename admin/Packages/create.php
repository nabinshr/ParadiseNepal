<?php
ob_start();
session_start();

include '../../database.php';

require_once '../../init.php';
require_once ROOT . "admin/header.php";
require_once ROOT . "helper.php";
include_once ROOT . "admin/sidebar.php";

?>
<div class="col-md-10 content">
        <?php
if (isset($_POST['submit'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);
    $extensions = array("jpeg", "jpg", "png");
    $package = $_POST['name'];
    $destination = $_POST['destination'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $createdDate = date('Y/m/d');
    $createdBy = $_SESSION['uid'];

    if (empty($file_name)) {
        $errors[] = "Image is required";
    }

    if (empty($package)) {
        $errors[] = "Tour name cannot be empty.";
    }

    if (empty($destination)) {
        $errors[] = "Destination cannot be empty.";
    }

    if (empty($price)) {
        $errors[] = "Price cannot be empty.";
    }

    if (empty($type)) {
        $errors[] = "Type cannot be empty.";
    }

    if (empty($duration)) {
        $errors[] = "Duration cannot be empty.";
    }

    if (empty($_POST['activity'])) {
        $errors[] = "Activity cannot be empty.";
    } else {
        $activityList = $_POST['activity'];

    }

    if (empty($status)) {
        $errors[] = "Status cannot be empty.";
    }

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        $upload = move_uploaded_file($file_tmp, ROOT . "assets/images/slider/" . $file_name);
        if ($upload) {
            $query = "INSERT INTO packages (`Name`, `Destination`, `Duration`, `Price`, `Type`, `Description`, `images`, `Status`, `CreatedBy`, `CreatedAt`) 
                        VALUES ('$package', '$destination', '$duration','$price','$type','$description','$file_name','$status', '$createdBy', '$createdDate')";
            $execute = mysqli_query($con, $query);
            if ($execute) {
                $tourId = mysqli_insert_id($con);
                foreach($activityList as $activity){
                    $query = "INSERT INTO `package_activity`(`ActivityId`, `PackageId`) VALUES ($activity,$tourId)";
                    $execute = mysqli_query($con, $query);
                }
                echo alertMessage("alert-success", array("Successfully inserted"));
            } else {
                echo alertMessage("alert-danger", array("There was an error when inserting data."));
            }
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
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Package Name</label>
                            <input type="text" class="form-control" id="name" placeholder="name" name="name">
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Destination</label>
                            <input type="text" class="form-control" id="destination" placeholder="destination"
                                name="destination">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Price</label>
                            <input type="text" class="form-control" id="price" placeholder="Price" name="price">
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Duration</label>
                            <input type="text" class="form-control" id="duration" placeholder="duration"
                                name="duration">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Activities</label>

                            <select class="form-control select2" name="activity[]" multiple>
                                <?php
$query = "SELECT * FROM `activities` WHERE Status = 1";
$execute = mysqli_query($con, $query);
$data = mysqli_fetch_all($execute, MYSQLI_ASSOC);
if ($data != null) {
    foreach ($data as $item) {
        ?>
                                <option value="<?=$item['Id']?>"><?=$item['Activity']?></option>
                                <?php }
}
?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Type</label>
                            <select class="form-control" name="type">
                                <option value="">Select Type</option>
                                <option value="1">Featured</option>
                                <option value="2">Popular</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Image</label>
                            <input type="file" class="form-control" id="image" placeholder="Image" name="image">
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Status</label>
                            <select class="form-control" name="status">
                                <option value="1">Published</option>
                                <option value="0">Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea type="text" class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once "../footer.php";