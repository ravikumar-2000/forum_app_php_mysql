<?php include 'include/header.php' ?>

<?php 

  $name = $email = $pass = $hashed_pass = '';
  $nameErr = $emailErr = $passErr = '';

  if (isset($_POST['submit'])) {
    if (empty($_POST['username'])) {
      $nameErr = 'username is required';
    } else {
      $name = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_SPECIAL_CHARS);
      $nameErr = '';
    }
    if (empty($_POST['email_address'])) {
      $emailErr = 'email address is required';
    } else {
      $email = filter_input(INPUT_POST, 'email_address', FILTER_SANITIZE_EMAIL);
      $emailErr = '';
    }
    if (empty($_POST['password'])) {
      $passErr = 'password is required';
    } else {
      $pass = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);
      $hashed_pass = password_hash($pass, PASSWORD_BCRYPT);
      $passErr = '';
    }

    if (empty($nameErr) && empty($emailErr) && empty($passErr)) {
      $sql = "INSERT INTO users (username, email_address, password, is_deleted) values ('$name', '$email', '$hashed_pass', 0)";
      if (mysqli_query($conn, $sql)) {
        header('Location: login.php');
      } else {
        echo 'ERROR: ' . mysqli_error($conn);
      }
    }
  }

?>

<img src="/ravi_prac/forum_app/img/user.png" class="w-25 mb-3" alt="">
<h2>User Registeration Form</h2>
<p class="lead text-center text-primary">Be nice with everyone in Forum!</p>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"class="mt-4 w-75">
  <div class="mb-3">
    <label for="username" class="form-label">User Name</label>
    <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null; ?>" id="name" name="username" placeholder="Enter your username">
    <div class="invalid-feedback">
      <?php echo $nameErr ?? null;  ?>
    </div>
  </div>
  <div class="mb-3">
    <label for="email_address" class="form-label">Email Address</label>
    <input type="email" class="form-control <?php echo $emailErr ? 'is-invalid' : null; ?>" id="email" name="email_address" placeholder="Enter your email address">
    <div class="invalid-feedback">
      <?php echo $emailErr ?? null;  ?>
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
    <input type="submit" name="submit" value="Create User" class="btn btn-dark w-100">
  </div>
  <br/>
  <div class="mb-3">
    <p>Alredy have an account? <a href='login.php'>Sign In</a></p>
  </div>
</form>

<?php include 'include/footer.php' ?>