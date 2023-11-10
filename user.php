<?php
include('header.php');

if (!isset($_SESSION['admin_logged_in'])) {
  header('location: login.php');
  exit;
}

 
$records_per_page = 10; 
 
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
  $page = $_GET['page'];
} else {
  $page = 1;
}

$start_from = ($page - 1) * $records_per_page;

 
$stmt = $conn->prepare("SELECT * FROM users LIMIT ?, ?");
$stmt->bind_param("ii", $start_from, $records_per_page);
$stmt->execute();
$results = $stmt->get_result();
?>

<body>

  <?php include('side_bar.php'); ?>

  <div id="main-content">

    <form action="user.php">
      <p class="text-center"><?php if (isset($_GET['user_added'])) {  ?></p>
      <p class="text-center text-success"><?php echo $_GET['user_added']; ?></p>
    <?php } ?>
    <p class="text-center"><?php if (isset($_GET['failed'])) {  ?></p>
    <p class="text-center text-danger"><?php echo $_GET['failed']; ?></p>
  <?php } ?>
 

 


    </form>
    <table class="cute-table">
      <thead>
        <tr>
          <th scope="col">Member id</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Address</th>
          <th scope="col">Gender</th>
          <th scope="col">Image</th>
          <th scope="col">Number</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $result) {
        ?>
          <tr>
            <th scope='row'><?php echo $result['member_id']; ?></th>
            <td><?php echo $result['user_name']; ?></td>
            <td><?php echo $result['user_email']; ?></td>
            <td><?php echo $result['user_address']; ?></td>
            <td><?php echo $result['user_gender']; ?></td>
            <td>
              <img alt="images" src='./assects/imgs/<?php echo $result['image']; ?>' style='width: 130px; height: 120px;'>

            </td>
            <td><?php echo $result['user_number']; ?></td>
            
            <!-- <td>
        <a class="btn btn-danger" href="delete_books.php?id=<?php // echo $result['id']; 
                                                            ?>"
>Delete book</a>
    </td> -->
            <!--=================the script============= -->
          </tr>
        <?php
        }
        ?>
      </tbody>


    </table>

    <!-- Pagination links -->
    <?php
    $sql = "SELECT COUNT(*) AS total_records FROM users";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total_records'];
    $total_pages = ceil($total_records / $records_per_page);

    echo "<div class='pagination'>";
    for ($i = 1; $i <= $total_pages; $i++) {
      echo "<a href='user.php?page=" . $i . "'>" . $i . "</a> ";
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