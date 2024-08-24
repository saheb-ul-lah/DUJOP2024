<?php
include('includes/db_connect.php');

$id = $_GET['id'];

$sql = "DELETE FROM journals WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    header('Location: view_journals.php');
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
