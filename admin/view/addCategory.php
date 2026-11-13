<?php
session_start();

// echo "<pre>";
// print_r($_SESSION['categories']);
// echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addCategory'])) {
  // fetch , validate , store

  $title = trim(htmlspecialchars($_POST['name']));

  $errors = [];

  if (empty($title)) {
    $errors[] = 'title is required';
  } elseif (strlen($title) < 3) {
    $errors[] = 'title must be at least 3 chars';
  }

  //check if session already exist

  if (!isset($_SESSION['categories'])) {
    $_SESSION['categories'] = [];
  }

  //check errors

  if (empty($errors)) {
    $_SESSION['categories'][] =[
      'title' => $title
    ];


    $_SESSION['success'] = ['Cat added success'];
    header('location:addCategory.php');
    exit();
  } else {
    $_SESSION['errors'] = $errors;
    $_SESSION['title'] = $title;
    header('location:addCategory.php');
    exit();
  }
}

include "../view/header.php";
include "../view/sidebar.php";
include "../view/navbar.php";

?>


<div class="container-fluid page-body-wrapper full-page-wrapper">
  <div class="row w-100 m-0">
    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
      <div class="card col-lg-4 mx-auto">

      <?php 
      include '../../inc/errors.php';
      include '../../inc/success.php';
      ?>
        <div class="card-body px-5 py-5">
          <h3 class="card-title text-left mb-3">Add Category</h3>
          <form method="POST" action="addCategory.php">
            <div class="form-group">
              <label>Title</label>
              <input type="text" name="name" class="form-control p_input">
            </div>
            <div class="text-center">
              <button type="submit" name="addCategory" class="btn btn-primary btn-block enter-btn">Add</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
  </div>
  <!-- row ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<?php
include "../view/footer.php";
?>