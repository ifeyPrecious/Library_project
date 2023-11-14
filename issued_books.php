<?php
include('header.php');

$stmt = $conn->prepare("SELECT member_id, book_title, isbn, author,date FROM issued_books");

if ($stmt) {
    $stmt->execute();
    $stmt->bind_result($member_id, $book_title, $isbn, $author,$date);
    $results = $stmt->get_result();
}
?>


<body>
    <?php include('side_bar.php'); ?>



    <div id="main-content">
    <p class="text-center"><?php if (isset($_GET['book_issued'])) {  ?></p>
      <p class="text-center text-success"><?php echo $_GET['book_issued']; ?></p>
    <?php } ?>
    
        <table class="cute-table">
            <h2 class="text-center border-bottom">ISSUED BOOKS</h2>
            <thead>
                <tr>
                    <th scope="col">MEMBER ID</th>
                    <th scope="col">BOOK TITLE</th>
                    <th scope="col">ISBN</th>
                    <th scope="col">AUTHOR</th>
                   <th scope="col">DATE</th>
                   <!-- <th scope="col">DUE DATE</th>   -->
                </tr>
            </thead>

            <tbody>
                <?php
                if ($results) {
                    foreach ($results as $row) {
                ?>
                        <tr>
                            <th scope='row'><?php echo $row['member_id']; ?></th>
                            <td><?php echo $row['book_title']; ?></td>
                            <td><?php echo $row['isbn']; ?></td>
                            <td><?php echo $row['author'] ?></td> 
                            <td><?php echo $row['date'] ?></td> 
                        </tr>

                <?php
                    }
                }
                ?>
                
            </tbody>
           
        </table>
       <a href="copies.php" class="btn confirm-button my-3">Back</a> 
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
