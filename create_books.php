 <?php include('header.php')  ?>

 <?php
if (isset($_POST['create_book'])) {
    $book_title = $_POST['title'];
    $book_description = $_POST['description'];
    $author = $_POST['author'];
    $no_copies=$_POST['no_of_copies'];
    // $image = $_FILES['image']['name'];

    // Temporary name of the image (the file itself)
    $image_tmp = $_FILES['image']['tmp_name'];

    // The image name
    $image_name1 = $book_title.".jpg";

    // Upload the image
    move_uploaded_file($image_tmp,"./assects/imgs/". $image_name1);

    // Create a new book
    $stmt = $conn->prepare("INSERT INTO books (book_title, book_description, author, image,no_copies) VALUES (?,?,?,?,?)");
    $stmt->bind_param('ssssi', $book_title, $book_description, $author, $image_name1,$no_copies);

    if ($stmt->execute()) {
        header('location:books.php?book_added=Your book has been added successfully');
    } else {
        header('location:books.php?book_failed=Error occurred, try again');
    }
}
?>
