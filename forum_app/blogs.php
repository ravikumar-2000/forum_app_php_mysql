<?php include 'include/header.php' ?>

<h2>BLOGS</h2>

<?php 
  $sql = 'SELECT * FROM blogs join users on users.id = blogs.user_id where blogs.is_deleted = 0 and users.is_deleted = 0';
  $result = mysqli_query($conn, $sql);
  $blogs = mysqli_fetch_all($result, MYSQLI_ASSOC);

  if (isset($_POST['update'])){
    updateBlog($_POST['id']);
  } elseif(isset($_POST['delete'])) {
    deleteBlog($_POST['id']);
  }

  function updateBlog($blog_id){
    global $conn;
    header('Location: write_blog.php?blog_id=' . $blog_id);
  }

  function deleteBlog($blog_id){
    global $conn;
    $sql = "UPDATE blogs set is_deleted = 1 where blog_id = $blog_id";
    $res = mysqli_query($conn, $sql);
    header('Location: blogs.php');
  };

?>


<?php if(empty($blogs)): ?>
  <p class="lead mt-3 text-danger">there is no blog available right now</p>
<?php endif; ?>

<div class="d-flex justify-content-center mb-3">
    <a href='write_blog.php'><button type="button" class="btn btn-dark m5">Write Blog</button></a>
</div>

<?php foreach($blogs as $blog): ?>
  <div class="card my-3 w-75">
    <div class="card-body text-center">
       <?php echo "<b>${blog['title']}</b>"; ?>
       <br>
       <?php echo $blog['body']; ?>
       <div class="text-secondary mt-2">
        Written By <?php echo "<b>${blog['username']}</b>" . " on " . $blog['created_on']; ?>
       </div>
       <br/>
       <?php if ($_SESSION['user'] == $blog['username']): ?>
          <form method="POST" action="blogs.php">
            <div class="container">
                <input type="submit" value="Update" class="btn btn-success mr-5" name="update">
                <input type="submit" value="Delete" class="btn btn-danger ml-5" name="delete">
                <input type="hidden" name="id" value="<?php echo $blog["blog_id"]; ?>"> 
             </div>
          </form>
       <?php endif ?>
       <?php if (!($_SESSION['user'] == $blog['username'])): ?> 
        <p style="color: red;">You do not have permission to update and delete this blog.</p>
        <?php endif ?>
    </div>
  </div>
<?php endforeach; ?>

<?php include 'include/footer.php' ?>