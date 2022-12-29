<?php
include '../../database.php';

$id = $_GET['id'];
if (isset($id)) {
    $query = "DELETE FROM `sliders` WHERE id = $id";
    $execute = mysqli_query($con, $query);
    if ($execute) {
        header('location:index.php');
    }
}