<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$tender = '';
$description = '';

if(isset($_POST['save'])){
    $tender = $_POST['tender'];
    $description = $_POST['description'];
    $mysqli->query("INSERT INTO mytable (tender, description) VALUES('$tender', '$description')") or die($mysqli->error);
    
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
    
    header("location: index.php");
}

if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM mytable WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
    
    header("location: index.php");
}

if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM mytable WHERE id=$id") or die($mysqli->error());
    if(count($result)==1){
        $row = $result->fetch_array();
        $tender = $row['tender'];
        $description = $row['description'];
        }
    }

if(isset($_POST['update'])){
    $id = $_POST['id'];
    $tender = $_POST['tender'];
    $description = $_POST['description'];
    $mysqli->query("UPDATE mytable SET tender='$tender', description='$description' WHERE id=$id") or die($mysqli->error());
    
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
    
    header("location: index.php");
}
