<?php
include '../../database.php';

require_once '../../init.php';
require_once "../header.php";
require_once "../../helper.php";
include_once "../sidebar.php";

?>
<div class="col-md-10 content">
    <div class="panel panel-default">
        <div class="panel-heading">
            Slider List
            <a href="<?=URL . "admin/Packages/create.php"?>" class="pull-right btn btn-primary btn-xs">Create</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Destination</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$query = "SELECT * FROM `packages`";
$execute = mysqli_query($con, $query);
$data = mysqli_fetch_all($execute, MYSQLI_ASSOC);

$count = 1;
if ($data != null) {
    foreach ($data as $item) {
        ?>
                    <tr>
                        <td><?=$count++?></td>
                        <td><?=$item["Name"]?></td>
                        <td><?=$item["Destination"]?></td>
                        <td><?=$item["Duration"]?></td>
                        <td><?=$item["Price"]?></td>
                        <td><?=$item["Duration"]?></td>
                        <td><?=Status($item["Status"])?></td>
                        <td>
                            <a href="<?=URL . "admin/packages/Edit.php?id=" . $item["Id"]?>">Edit</a>
                            <a href="<?=URL . "admin/packages/delete.php?id=" . $item["Id"]?>">Delete</a>
                        </td>
                    </tr>
                    <?php
}
} else {
    ?>
                    <tr>
                        <td>
                            <p>No data found!!</p>
                        </td>
                    </tr>
                    <?php
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require_once "../footer.php";
?>