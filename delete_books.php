 <?php include('header.php');  ?>

<?php

if (!isset($_SESSION['admin_logged_in'])) {
    header('location:login.php');
    exit;
}


if (isset($_GET['id'])) {
    $books_id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM books WHERE id = ?");
    $stmt->bind_param('i', $books_id);

    if ($stmt->execute()) {

        header('location:books.php?deleted_successfully=book has been deleted successfully');
    } else {
        header('location: products.php?failed_to_delete=could not delete this product');
    }
}

 