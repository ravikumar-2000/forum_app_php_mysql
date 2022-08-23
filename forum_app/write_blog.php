<?php include 'include/header.php' ?>


<?php 

  if (isset($_GET['blog_id'])){
    $sql = "SELECT * from blogs where blog_id=" . $_GET['blog_id'];
    $res = mysqli_query($conn, $sql);
    $blog = mysqli_fetch_assoc($res);
    $_SESSION['is_updating'] = 1;
    $_SESSION['updating_blog'] = $blog;
   }
?>

<?php 
  
  $title = $blog_body = '';
  $titleErr = $blog_body_Err = '';

  if (isset($_POST['submit'])) {
    if (empty($_POST['title'])) {
      $titleErr = 'title is required';
    } else {
      $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
      $titleErr = '';
    }
    
    if (empty($_POST['blog_body'])) {
      $blog_body_Err = 'need your thoughts here';
    } else {
      $blog_body = filter_input(INPUT_POST, 'blog_body', FILTER_SANITIZE_SPECIAL_CHARS);
      $userId = $_SESSION['user_id'];
      if (!isset($_SESSION['is_updating'])){
        $sql = "INSERT INTO blogs (title, body, user_id, is_deleted) values ('$title', '$blog_body', $userId, 0)";
        // echo $sql;
      } else {
        $sql = "UPDATE blogs set title = '$title', body = '$blog_body', created_on = '" . $_SESSION['updating_blog']['created_on'] . "', modified_on = current_timestamp() where blog_id = " . $_SESSION['updating_blog']['blog_id'];
        echo $sql;
        unset($_SESSION['is_updating']);
        unset($_SESSION['updating_blog']);
      }
      $result = mysqli_query($conn, $sql);
      $blog_body_Err = '';
      header('Location: /ravi_prac/forum_app/blogs.php');
    }
  } elseif(isset($_POST['cancel'])) {
      header('Location: /ravi_prac/forum_app/blogs.php');
  }

?>

<img src="/ravi_prac/forum_app/img/blog.png" class="w-25 mb-3" alt="">
<h2>Please Write</h2>
<p class="lead text-center text-primary">Kindly avoid grammetical mistakes!</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"class="mt-4 w-75">
  <div class="mb-3">
    <label for="title" class="form-label">Blog Title</label>
    <input type="text" class="form-control <?php echo $titleErr ? 'is-invalid' : null; ?>" id="name" name="title" placeholder="Enter title" value="<?php echo isset($_SESSION['is_updating']) ? $_SESSION['updating_blog']['title'] : null; ?>">
    <div class="invalid-feedback">
      <?php echo $titleErr ?? null;  ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="blog_body" class="form-label">Your Thoughts</label>
    <textarea class="form-control <?php echo $blog_body_Err ? 'is-invalid' : null; ?>" id="blog_body" name="blog_body" placeholder="Write your thoughts"><?php echo isset($_SESSION['is_updating']) ? $_SESSION['updating_blog']['body'] : null; ?></textarea>
    <div class="invalid-feedback">
      <?php echo $blog_body_Err ?? null; ?>
    </div>
  </div>
  
  <div class="d-flex justify-content-center mb-3">
    <input type="submit" name="submit" value="Save Blog" class="btn btn-success w-50">
  </div>
  <div class="d-flex justify-content-center mb-3">
    <input type="submit" name="cancel" value="Cancel Thought" class="btn btn-danger w-50">
  </div>

</form>