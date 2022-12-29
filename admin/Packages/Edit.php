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
    $query = "SELECT * FROM `packages` WHERE id = $id";
    $execute = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($execute);

    $query = "SELECT * FROM `package_activity` WHERE PackageId = $id";
    $execute = mysqli_query($con, $query);
    $selectedActivity = mysqli_fetch_all($execute, MYSQLI_ASSOC);
}

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
    $old_img = $_POST['save_image'];

    $package = $_POST['name'];
    $destination = $_POST['destination'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $duration = $_POST['duration'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $createdDate = date('Y/m/d');
    $createdBy = $_SESSION['uid'];

    if (empty($file_name) && empty($old_img)) {
        $errors[] = "Image is required";
        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

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

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    try {
        if (empty($errors) == true) {
            if (!empty($file_name)) {
                $upload = move_uploaded_file($file_tmp, ROOT . "assets/images/slider/" . $file_name);
                if ($upload) {
                    $query = "UPDATE `packages`
                      SET `Name`='$package',`Destination`='$destination',`Duration`='$duration',`Price`='$price',`Type`='$type',`Description`='$description',`images`='$file_name',`Status`='$status',
                     `ModifiedBy`='$createdBy',`ModifiedAt`='$createdDate' WHERE id = '$id'";
                } //$execute = mysqli_query($con, $query);
            } else {
                $query = "UPDATE `packages`
                      SET `Name`='$package',`Destination`='$destination',`Duration`='$duration',`Price`='$price',`Type`='$type',`Description`='$description',`images`='$old_img',`Status`='$status',
                     `ModifiedBy`='$createdBy',`ModifiedAt`='$createdDate' WHERE id = '$id'";
                     var_dump($query);

            }
            $execute = mysqli_query($con, $query);
           
            if ($execute) {
                foreach ($activityList as $activity) {
                    foreach ($selectedActivity as $selected) {
                        if ($selected["ActivityId"] != $activity) {
                            $query = "DELETE FROM `package_activity` WHERE `PackageId` = '$id' AND `ActivityId` = '$activity'";
                            $execute = mysqli_query($con, $query);

                            $query = "INSERT INTO `package_activity` (`ActivityId`, `PackageId`) VALUES ('$activity','$id')";
                            $execute = mysqli_query($con, $query);
                        }

                    }
                }
                echo alertMessage("alert-success", array("Successfully inserted"));
            } else {
                echo alertMessage("alert-danger", array("Cannot Edit"));
            }
        }
    } catch (Exception $ex) {
        var_dump($ex);
    }
}
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            Edit Tour Package
        </div>
        <div class="panel-body">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Package Name</label>
                            <input type="text" class="form-control" id="name" placeholder="name" name="name"
                                value="<?=$data['Name']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Destination</label>
                            <input type="text" class="form-control" id="destination" placeholder="destination"
                                name="destination" value="<?=$data['Destination']?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Price</label>
                            <input type="text" class="form-control" id="price" placeholder="Price" name="price"
                                value="<?=$data['Price']?>">
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Duration</label>
                            <input type="text" class="form-control" id="duration" placeholder="duration" name="duration"
                                value="<?=$data['Duration']?>">
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
$Activitydata = mysqli_fetch_all($execute, MYSQLI_ASSOC);
if ($Activitydata != null) {
    foreach ($Activitydata as $item) {
        foreach ($selectedActivity as $activity) {

            ?>
                                <option value="<?=$item['Id']?>"
                                    <?=($item['Id'] == $activity['ActivityId']) ? "selected='true'" : ""?>>
                                    <?=$item['Activity']?></option>
                                <?php }
    }}
?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Type</label>
                            <select class="form-control" name="type">
                                <option value="" <?=(empty($data['Status'])) ? "selected='true'" : ""?>>Select Type
                                </option>
                                <option value="1" <?=($data['Status'] == 1) ? "selected='true'" : ""?>>Featured</option>
                                <option value="2" <?=($data['Status'] == 2) ? "selected='true'" : ""?>>Featured</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="name">Image</label>
                            <input type="file" class="form-control" id="image" placeholder="Image" name="image"
                                value="<?=$data['images']?>">
                            <input type="hidden" value="<?=$data['images']?>" name="save_image">
                        </div>
                        <div class="col-md-6">
                            <label for="destination">Status</label>
                            <select class="form-control" name="status">
                                <option value="1" <?=($data['Status'] == 1) ? "selected='true'" : ""?>>Publish</option>
                                <option value="0" <?=($data['Status'] == 0) ? "selected='true'" : ""?>>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Description</label>
                    <textarea type="text" class="form-control" name="description"><?=$data['Description']?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once "../footer.php";