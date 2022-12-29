<?php
session_start();
include '../../database.php';
require_once '../../init.php';
require_once "../header.php";
require_once "../../helper.php";
include_once "../sidebar.php";
?>
<div class="col-md-10 content">
    <div class="panel panel-default">
        <div class="panel-heading">
            Activity List
            <a href="<?=URL . "admin/User/create.php"?>" class="pull-right btn btn-primary btn-xs">Create</a>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>username</th>
                        <th>Email</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$query = "SELECT * FROM `users`";
$execute = mysqli_query($con, $query);
$data = mysqli_fetch_all($execute, MYSQLI_ASSOC);

$count = 1;
if ($data != null) {
    foreach ($data as $item) {
        ?>
                    <tr>
                        <td><?=$count++?></td>
                        <td><?=$item["username"]?></td>
                        <td><?=$item["e_mail"]?></td>
                        <td><?=$item["fullname"]?></td>
                        <td>
                            <a href="<?=URL . "admin/user/Edit.php?id=" . $item["id"]?>">Edit</a>
                            <a href="<?=URL . "admin/user/delete.php?id=" . $item["id"]?>">Delete</a>
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