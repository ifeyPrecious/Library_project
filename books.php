<?php
include('header.php');

if (!isset($_SESSION['admin_logged_in'])) {
  header('location: login.php');
  exit;
}

// Pagination settings
$records_per_page = 5; // Number of records to display per page

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$start_from = ($page - 1) * $records_per_page;

// Prepare and execute the SELECT query using a prepared statement
// $sql = "SELECT id, book_title, book_description, author, image FROM books LIMIT ?, ?";
$stmt = $conn->prepare("SELECT * FROM books LIMIT ?, ?");
$stmt->bind_param("ii", $start_from, $records_per_page);
$stmt->execute();
$results = $stmt->get_result();
?>

<body>

  <?php include('side_bar.php'); ?>

  <div id="main-content">

    <form action="">
      <p class="text-center"><?php if (isset($_GET['book_added'])) {  ?></p>
      <p class="text-center text-success"><?php echo $_GET['book_added']; ?></p>
    <?php } ?>
    <p class="text-center"><?php if (isset($_GET['book_failed'])) {  ?></p>
    <p class="text-center text-danger"><?php echo $_GET['book_failed']; ?></p>
  <?php } ?>
  <?php if (isset($_GET['edit_success_message'])) {  ?>
    <p class="text-center text-success"><?php echo $_GET['edit_success_message'];  ?></p>
  <?php } ?>

  <?php if (isset($_GET['edit_error_message'])) { ?>

    <p class="text-center text-danger"> <?php echo $_GET['edit_error_message']  ?></p>
  <?php } ?>

  <?php if (isset($_GET['deleted_successfully'])) {  ?>
    <p class="text-center text-success"><?php echo $_GET['deleted_successfully'];  ?></p>
  <?php } ?>

  <?php if (isset($_GET['failed_to_delete'])) {  ?>
    <p class="text-center text-success"><?php echo $_GET['failed_to_delete'];  ?></p>
  <?php } ?>

  <p class="text-center"><?php if (isset($_GET['images_updated'])) {  ?></p>
  <p class="text-center text-success"><?php echo $_GET['images_updated']; ?></p>
<?php } ?>

<p class="text-center"><?php if (isset($_GET['images_failed'])) {  ?></p>
<p class="text-center text-danger"><?php echo $_GET['images_failed']; ?></p>
<?php } ?>


    </form>
    <table class="cute-table">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Author</th>
          <th scope="col">Image</th>
          <th scope="col">Edit Book</th>
          <th scope="col">Delete</th>
          <th scope="col">Details</th>
          <th scope="col">Edit Image</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $result) {
        ?>
          <tr>
            <th scope='row'><?php echo $result['id']; ?></th>
            <td><?php echo $result['book_title']; ?></td>
            <td><?php echo $result['book_description']; ?></td>
            <td><?php echo $result['author']; ?></td>
            <td>
              <img alt="images" src='./assects/imgs/<?php echo $result['image']; ?>' style='width: 130px; height: 120px;'>

            </td>

            <td>
              <a class="btn btn-primary" href="edit_books.php?id=<?php echo $result['id']; ?>">Edit books</a> </span>
            </td>


            <!-- <td>
        <a class="btn btn-danger" href="delete_books.php?id=<?php // echo $result['id']; 
                                                            ?>"
>Delete book</a>
    </td> -->

            <td>
              <a class="btn btn-danger" href="#" onclick="confirmDelete(<?php echo $result['id']; ?>)">Delete book</a>
            </td>

            <td>
              <form action="book_details.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $result['id']; ?>" name="book_id">

                <input class="btn btn-info" type="submit" name="book_btn" value="Details">
              </form>
            </td>


            <td>
              <a class="btn btn-success" href="edit_image.php?id=<?php echo $result['id']; ?>&book_title=<?php echo $result['book_title']; ?>">Edit image</a>
            </td>







            <!--=================the script============= -->




          </tr>
        <?php
        }
        ?>
      </tbody>


    </table>

    <!-- Pagination links -->
    <?php
    $sql = "SELECT COUNT(*) AS total_records FROM books";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total_records'];
    $total_pages = ceil($total_records / $records_per_page);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
      echo "<a href='books.php?page=" . $i . "'>" . $i . "</a> ";
    }
    echo "</div>";
    ?>
  </div>


  <!-- =======================FOOTER======================= -->
  <div class="footer">
    &copy; <?php echo date('Y') ?>
  </div>
  <script src="script.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>