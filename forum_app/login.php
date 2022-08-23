<?php include 'include/header.php' ?>

<?php 
  
  $username_email = $pass = $hashed_pass = '';
  $username_email_Err = $passErr = $mainErr = '';

  if (isset($_POST['submit'])) {
    if (empty($_POST['username_email'])) {
      $username_email_Err = 'username or email address is required';
    } else {
      $username_email = filter_input(INPUT_POST, 'username_email', FILTER_SANITIZE_SPECIAL_CHARS);
      $username_email_Err = '';
    }
    
    if (empty($_POST['password'])) {
      $passErr = 'password is required';
    } else {
      $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
      $sql = "SELECT * from users where username = '$username_email' or email_address = '$username_email'";
      $result = mysqli_query($conn, $sql);
      $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
      if (!empty($user[0])){
        $hashed_pass = $user[0]['password'];
      }
      if (password_verify($pass, $hashed_pass)) {
        // echo "valid user";
        $_SESSION['user'] = $user[0]['username'];
        $_SESSION['user_id'] = $user[0]['id'];
        header('Location: /ravi_prac/forum_app/blogs.php');
      } else {
        $mainErr = 'wrong credentials';
      }
      $passErr = '';
    }
  }

?>

<img src="/ravi_prac/forum_app/img/user.png" class="w-25 mb-3" alt="">
<h2>User Login Form</h2>
<?php 
    if (empty($mainErr)){
        echo '<p class="lead text-center text-primary">Please provide right credentials!</p>';
    } else {
        echo "<p class='lead text-center text-danger'>${mainErr}!</p>";
    }
?>


<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"class="mt-4 w-75">
  <div class="mb-3">
    <label for="username_email" class="form-label">User Name or Email Address</label>
    <input type="text" class="form-control <?php echo $username_email_Err ? 'is-invalid' : null; ?>" id="name" name="username_email" placeholder="Enter your username">
    <div class="invalid-feedback">
      <?php echo $username_email_Err ?? null;  ?>
    </div>
  </div>
  
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control <?php echo $passErr ? 'is-invalid' : null; ?>" id="password" name="password" placeholder="Enter your password">
    <div class="invalid-feedback">
      <?php echo $passErr ?? null;  ?>
    </div>
  </div>
  <div class="mb-3">
    <input type="submit" name="submit" value="Login User" class="btn btn-dark w-100">
  </div>
  <br/>
  <div class="mb-3">
    <p>Don't have an account? <a href='home.php'>Sign Up</a></p>
  </div>
</form>

<?php include 'include/footer.php' ?>