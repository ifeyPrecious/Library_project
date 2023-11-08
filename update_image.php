<?php include('header.php'); ?>

<?php

// if (isset($_POST['update_image'])) {
//     $book_id = $_POST['book_id'];
//     $book_title = $_POST['book_title'];

//     // Check if a file was uploaded
    
//         // Temporary name of the image (the file itself)
//         $image1 = $_FILES['image1']['tmp_name'];

//         // The image name
//         $image_name1 = $book_title . "1.jpg";

//         // Upload the image
//         move_uploaded_file($image1, "./assets/imgs/" . $image_name1);

//         // Update the image in the database
//         $stmt = $conn->prepare("UPDATE books SET image = ? WHERE id = ?");
//         $stmt->bind_param('si', $image_name1, $book_id);

//         if ($stmt->execute()) {
//             header('location: books.php?images_updated=Image updated successfully');
//         } else {
//             header('location: books.php?images_failed=Error occurred while updating image');
//         }
//     } else {
//         header('location: books.php?images_failed=No file uploaded');
//     }


 
// Include your database connection (e.g., include('db_connection.php');)

if (isset($_POST['update_image'])) {
    $book_id = $_POST['book_id'];
    $book_title = $_POST['book_title'];

    // Check if a file was uploaded
    if (isset($_FILES['image1']) && $_FILES['image1']['error'] === UPLOAD_ERR_OK) {
        // Temporary name of the image (the file itself)
        $image1_tmp = $_FILES['image1']['tmp_name'];

        // The image name
        $image_name1 = $book_title . "1.jpg";

        // Upload the image
        if (move_uploaded_file($image1_tmp, "./assects/imgs/" . $image_name1)) {
            // Include your database connection here
            // Create a database connection if not already included

            // Update the image in the database
            $stmt = $conn->prepare("UPDATE books SET image = ? WHERE id = ?");
            $stmt->bind_param('si', $image_name1, $book_id);

            if ($stmt->execute()) {
                header('location: books.php?images_updated=Image updated successfully');
                exit; // Stop further script execution
            } else {
                $error = "Error occurred while updating image in the database.";
            }
        } else {
            $error = "Error occurred while moving the uploaded file.";
        }
    } else {
        $error = "No file uploaded or upload error occurred.";
    }

    // Redirect with error message
    header("location: books.php?error=" . urlencode($error));
}
 
?>
