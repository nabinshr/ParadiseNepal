<?php

ob_start(); 
include '../../database.php';

require_once '../../init.php';
require_once "../header.php";
require_once "../../helper.php";
include_once "../sidebar.php";

$id = $_GET['id'];
if (isset($id)) {
    $query = "SELECT * FROM `sliders` WHERE id = $id";
    $execute = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($execute);
}

?>
<div class="col-md-10 content">
    <div class="panel panel-default">
        <div class="panel-heading">
            Create Tour Package
        </div>
        <div class="panel-body">
            <?php
if (isset($_POST['submit'])) {
    $errors = array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $old_img = $_POST['save_image'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];
    $tmp = explode('.', $file_name);
    $file_ext = end($tmp);
    $extensions = array("jpeg", "jpg", "png");

    $status = $_POST['status'];
    $caption = $_POST['caption'];
    $date = date('Y/m/d');
    if (empty($file_name) && empty($old_img)) {
        $errors[] = "Image is required";

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
        }

    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be excately 2 MB';
    }

    if (empty($errors) == true) {
        if (!empty($file_name)) {
            $upload = move_uploaded_file($file_tmp, ROOT . "assets/images/slider/" . $file_name);
            if ($upload) {
                $query = "UPDATE `sliders` SET `slider_image`='$file_name',`caption`='$caption',`status`='$status',`added_date`='$date' WHERE id='$id'";
            }
        } else {
            $query = "UPDATE `sliders` SET `slider_image`='$old_img',`caption`='$caption',`status`='$status',`added_date`='$date' WHERE id='$id'";
        }
        $execute = mysqli_query($con, $query);
        if ($execute) {
            header('location:index.php');
            echo alertMessage("alert-success", array("Successfully inserted"));
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
                                Image
                            </label>
                            <input type="file" class="form-control" name="image" value="<?=$data['slider_image']?>">
                            <input type="hidden" value="<?=$data['slider_image']?>" name="save_image">
                        </div>
                        <div class="col-md-6">
                            <label for="name">
                                <abbr title="required">*</abbr>
                                Status
                            </label>
                            <select class="form-control" name="status">
                                <option value="1" <?=($data['status'] == 1) ? "selected='true'" : ""?>>Publish</option>
                                <option value="0" <?=($data['status'] == 0) ? "selected='true'" : ""?>>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">
                        <abbr title="required">*</abbr>
                        Caption
                    </label>
                    <textarea type="text" class="form-control" name="caption"><?=$data['caption']?></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php 
    require_once "../footer.php";
    ob_flush();
    
?>