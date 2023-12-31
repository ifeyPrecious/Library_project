<?php
include('header.php');

// Ensure that the user is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}

// Check if the form for issuing the book is submitted
if (isset($_POST['issue_status'])) {
    $book_id = $_POST['book_id'];
    $isbn = $_POST['isbn'];
    $author = $_POST['author'];
    $book_title = $_POST['book_title'];

    // Save the book information to session variables
    $_SESSION['book_issue_info'] = array(
        'book_id' => $book_id,
        'isbn' => $isbn,
        'author' => $author,
        'book_title' => $book_title,
    );
}

// Check if the form for checking out a book is submitted
if (isset($_POST['issue_book'])) {
    // Retrieve the book information from session variables
    $book_issue_info = isset($_SESSION['book_issue_info']) ? $_SESSION['book_issue_info'] : null;

    if (!$book_issue_info) {
        echo "Error: Book information not available.";
        exit;
    }

    // Initialize member credentials
    $member_id = $_POST['member_id'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT user_password FROM users WHERE member_id = ? LIMIT 1");
    $stmt->bind_param('s', $member_id);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if ($hashed_password && password_verify($password, $hashed_password)) {
        $issued_date = date('Y-m-d H:i:s'); // Current date and time

        $due_date = date('Y-m-d H:i:s', strtotime('+7 days'));

        $stmt_insert = $conn->prepare("INSERT INTO issued_books (member_id, book_title, isbn, author, date, due_date) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt_insert->bind_param('ssssss', $member_id, $book_issue_info['book_title'], $book_issue_info['isbn'], $book_issue_info['author'], $issued_date, $due_date);

        if ($stmt_insert->execute()) {
            // Set a session variable to indicate book has been issued
            $_SESSION['book_issued'] = true;
            header('location:copies.php?book_issued=Book Has Been Issued Successfully');
        } else {
            echo "Error issuing book";
        }

        $stmt_insert->close();
    } else {
        // Member credentials are incorrect, display an error message or redirect
        header('location: issue_check_form.php?error=Invalid credentials');
        exit;
    }

    // Clear the session variable
    unset($_SESSION['book_issue_info']);
}
?>

<body>

    <div id="main-content">
        <div class="navbar-brand ">
            <h2 class="">PRESH LIB</h2>
        </div>

        <h1 class=" offset-2"></h1>
        <div class="container ">
            <form action="" method="post">
                <p class="text-center"><?php if (isset($_GET['error'])) {  ?></p>
                <p class="text-center text-danger"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <div class="row ">
                    <div class="col-md-6 my-2">
                        <label for="inputPassword4" class="form-label ">member id</label>
                        <input type="text" class="form-control" placeholder="Member id" aria-label="name" name="member_id">
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-6 my-2">
                        <label for="inputEmail4" class="form-label">password</label>
                        <input type="text" class="form-control" placeholder="password" aria-label="password" name="password">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary" name="issue_book" id="issueButton" <?php if (isset($_GET['issueButtonDisabled']) && $_GET['issueButtonDisabled']) echo 'disabled'; ?>>Issue</button>

            </form>

        </div>

    </div>


    </body>

<!-- =======================FOOTER======================= -->
<div class="footer">
    &copy; <?php echo date('Y'); ?>
</div>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
