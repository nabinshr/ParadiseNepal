<?php
require_once "header.php";
$queryActivity = "SELECT * FROM `activities` WHERE Status = 1";
$executeActivity = mysqli_query($con, $queryActivity);
$data = mysqli_fetch_all($executeActivity, MYSQLI_ASSOC);

if (isset($_POST["destination"])) {
    $destination = $_POST["destination"];
}
if (isset($_POST["activity"])) {
    $activity = $_POST["activity"];
}

if (isset($_POST["submit"])) {
    $destination = (isset($_POST["destination"])) ? $_POST["destination"] : '';
    $activity = (!empty($_POST["activity"])) ? $_POST["activity"] : null;
    $duration = (!empty($_POST["duration"])) ? $_POST["duration"] : null;
    $price = (!empty($_POST["price"])) ? $_POST["price"] : null;
    $query = "call GetFilterPackages('$destination', '$activity', '$duration', '$price')";
} else {
    $query = "call GetFilterPackages('', null, '', null)";
}

$execute = mysqli_query($con, $query);
$selectedList = mysqli_fetch_all($execute, MYSQLI_ASSOC);

?>
<section id="header" class="mb-10">
    <img src="<?="img/Gumba.jpg"?>" alt="" Width="100%" height="300px">
</section>
<section id="content">
    <div class="panel panel-default">
        <div class="panel-heading">
            Plan your Trip
        </div>
        <div class="panel-body">
            <form method="post">
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Destination</label>
                        <input type="text" class="form-control" id="destination" placeholder="search"
                            name="destination">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Activities</label>
                        <select class="form-control" name="activity">
                            <?php
if ($data != null) {
    foreach ($data as $activity) {
        ?>
                            <option value="<?=$activity['Activity']?>"><?=$activity['Activity']?></option>
                            <?php }
}
?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="exampleInputEmail1">Duration</label>
                        <input type="text" class="form-control" id="destination" placeholder="search" name="duration">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="formControlRange">Price range</label>
                        <span id="showPrice"></span>
                        <input type="range" class="form-control-range" id="formControlRange" name="price" max="50000">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-default" type="submit" name="submit">filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <?php
if ($selectedList != null) {
    foreach ($selectedList as $item) {
        ?>
        <div class="col-sm-6 col-md-3">
            <div class="thumbnail">
                <img src="img/Gumba.jpg" alt="...">
                <div class="caption">
                    <h3><?=$item["Name"]?></h3>
                    <p>Destination: <?=$item["Destination"]?></p>
                    <p>Price: <?=$item["Price"]?></p>
                    <p>Duration: <?=$item["Duration"]?></p>
                    <p><a href="<?=URL . "TourDetail.php?id=" . $item["Id"]?>" class="btn btn-primary"
                            role="button">Detail</a></p>
                </div>
            </div>
        </div>
        <?php
}
} else {
    ?>
        <div class="alert alert-danger">No data found!!</div>
        <?php
}
?>
    </div>
</section>
<script>
$("#formControlRange").on("change", function() {
    $("#showPrice").html("Rs." + $(this).val());
});
</script>
<?php
require_once "footer.php";