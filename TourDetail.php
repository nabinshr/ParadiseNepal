<?php
require_once "header.php";

$id = $_GET['id'];
if (isset($id)) {
    $query = "SELECT * FROM `packages` WHERE id = $id";
    $execute = mysqli_query($con, $query);
    $data = mysqli_fetch_assoc($execute);
}

$query = "SELECT p.Activity, p.Id FROM `package_activity`
          INNER JOIN activities p ON ActivityId = p.Id
          where PackageId = '$id'";
$executeActivities = mysqli_query($con, $query);
$Activities = mysqli_fetch_all($executeActivities, MYSQLI_ASSOC);
?>
<div class="row">
    <div class="col-md-8">

        <img src="<?=ASSET . "/images/slider/" . $data['images']?>" alt="" height="300px" width="100%">
        <div class="mt-10">
            <h4 class="text-primary">Trip Description</h4>
            <p><?=$data['Description']?></p>
        </div>

        <div class="panel panel-default mt-10">
            <?php
if (isset($_POST['submit'])) {
    $errors = array();
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $date = date('Y/m/d');

    if (empty($email)) {
        $errors[] = "Image is required";
    }

    if (empty($comment)) {
        $errors[] = "Tour name cannot be empty.";
    }
    if (empty($errors) == true) {

        $queryInsert = "INSERT INTO `comments`(`PackageId`, `Comments`, `Email`, `PostedAt`) VALUES ('$id','$comment','$email','$date')";
        $executeInsert = mysqli_query($con, $queryInsert);
        if ($executeInsert) {
            echo alertMessage("alert-success", array("Successfully Commented"));
        }
    }
}

?>
            <div class="panel-body">
                <form class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-10">
                            <Textarea class="form-control" placeholder="Add Comment..." name="comment"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" name="submit">Comment</button>
                        </div>
                    </div>
                </form>

                <?php
$queryComments = "SELECT * FROM `comments` WHERE PackageId = $id";
$executeComments = mysqli_query($con, $queryComments);
$selectedList = mysqli_fetch_all($executeComments, MYSQLI_ASSOC);

foreach ($selectedList as $item) {
    ?>
                <div class="media well">
                    <div class="media-left pull-left">
                        <a href="#">
                            <img class="media-object" src="img/user-img.png" alt="..." height="64px" width="64px">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><?=$item["Email"]?></h4>
                        <?=$item["Comments"]?>
                    </div>
                </div>
                <?php
}
?>
            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">Trip Information</div>
            <div class="panel-body p-0">
                <ul class="list-group">
                    <li class="list-group-item">
                        <strong>Name: </strong>
                        <?=$data['Name']?>
                    </li>
                    <li class="list-group-item">
                        <strong>Destination: </strong>
                        <?=$data['Destination']?>
                    </li>
                    <li class="list-group-item">
                        <strong>Duration: </strong>
                        <?=$data['Duration']?>
                    </li>
                    <li class="list-group-item">
                        <strong>Price: </strong>
                        <?=$data['Price']?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Trip Activities</div>
            <div class="panel-body p-0">
                <ul class="list-group">
                    <?php
foreach ($executeActivities as $activity) {
    ?>
                    <li class="list-group-item">
                        <?=$activity['Activity']?>
                    </li>
                    <?php
}
?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
require_once "footer.php";