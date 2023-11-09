<?php
include('header.php');

$sql = "SELECT copies.*, copies.isbn, books.no_copies
        FROM copies
        LEFT JOIN books ON books.id = copies.book_id";
$result = mysqli_query($conn, $sql);

?>

<body>
  <?php include('side_bar.php'); ?>

  <div id="main-content">
    <table class="cute-table">
      <thead>
        <tr>
          <th scope="col">no</th>
          <th scope="col">ISBN</th>
          <th scope="col">NO OF COPIES</th>
          <th scope="col">Book ID</th>
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
              <td><?php echo $row['status']; ?></td>
            </tr>
        <?php
          }
        }
        ?>
      </tbody>
    </table>
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
