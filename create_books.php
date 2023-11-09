<?php
include('header.php');

 

$length = 13; 

function randomNumber($length) {
    $number = '';
    
    for ($i = 0; $i < $length; $i++) {
        $number .= random_int(0, 9); 
    }

    return $number;
}

if (isset($_POST['create_book'])) {
    $book_title = $_POST['title'];
    $book_description = $_POST['description'];
    $author = $_POST['author'];
    $no_copies = $_POST['no_of_copies'];

    // Temporary name of the image (the file itself)
    $image_tmp = $_FILES['image']['tmp_name'];

    // The image name
    $image_name1 = $book_title . ".jpg";

    // Upload the image
    move_uploaded_file($image_tmp, "./assects/imgs/" . $image_name1);

    // Create a new book
    $stmt = $conn->prepare("INSERT INTO books (book_title, book_description, author, image, no_copies) VALUES (?,?,?,?,?)");
    $stmt->bind_param('ssssi', $book_title, $book_description, $author, $image_name1, $no_copies);

    if ($stmt->execute()) {
        // Get the ID of the newly inserted book
        $book_id = mysqli_insert_id($conn);

        // Generate and insert ISBNs for each copy
        for ($i = 1; $i <= $no_copies; $i++) {
            // Generate a unique ISBN
            // $isbn = 'ISBN-' . $book_id . '-' . $i;
            
            $isbn = 'ISBN-' . randomNumber($length);

            // Insert each copy with its ISBN into the "no_copies" table
            $stmt = $conn->prepare("INSERT INTO copies (book_id, isbn) VALUES (?, ?)");
            $stmt->bind_param('is', $book_id, $isbn);

            if ($stmt->execute()) {
                // Insertion was successful
            } else {
                // Handle the insertion error
            }
        }

        header('location:books.php?book_added=Your book has been added successfully');
    } else {
        header('location:books.php?book_failed=Error occurred, try again');
    }
}
?>
