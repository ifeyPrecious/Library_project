<?php
include('header.php');
$sql = "SELECT copies.*, copies.isbn,copies.author,copies.book_title, books.no_copies
        FROM copies
        LEFT JOIN books ON books.id = copies.book_id";
$result = mysqli_query($conn, $sql);

?>

<body>
  <?php include('side_bar.php'); ?>

  <div id="main-content">
    <table class="cute-table">
      <h2  class="text-center border-bottom">THE BOOK STATUS</h2>
      <thead>
        <tr>
          <th scope="col">no</th>
          <th scope="col">ISBN</th>
          <th scope="col">NO OF COPIES</th>
          <th scope="col">BOOK ID</th>
          <th scope="col">AUTHOR</th>
          <th scope="col">TITLE</th>
          <th scope="col">STATUS</th>
        </tr>
      </thead>

      <tbody>
        <?php
        if ($result) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
              <th scope='row'><?php echo $row['id']; ?></th>
              <td><?php echo $row['isbn']; ?></td>
              <td><?php echo $row['no_copies']; ?></td>
              <td><?php echo $row['book_id'] ?></td>
              <td><?php echo $row['author']; ?></td>
              <td><?php echo $row['book_title']; ?></td>
              <td>
              <form method="POST" action="issue_check_form.php">
                
              <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
                    <input type="hidden" name="isbn" value="<?php echo $row['isbn']; ?>">
                    <input type="hidden" name="author" value="<?php echo $row['author']; ?>">
                    <input type="hidden" name="book_title" value="<?php echo $row['book_title']; ?>">

                    <button  type="submit" name="issue_status" id="issue-status" class="btn btn-primary">Issue</button> 
                </form>
              </td>
            
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
    <a href="books.php" class="btn confirm-button my-3">Back</a> 
  </div>
</body>

<!-- =======================FOOTER======================= -->
<div  class= "footer">
  &copy; <?php echo date('Y'); ?>
</div>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
