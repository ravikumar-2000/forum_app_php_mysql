<?php include 'include/header.php' ?>

<h2>USERS</h2>

<?php 

  // $feedbacks = [['body' => 'hello this is a feedback from ravikumar pande', 'name' => 'Ravikumar Pande']]; 
  $sql = 'SELECT * FROM users where is_deleted = 0';
  $result = mysqli_query($conn, $sql);
  $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>


<?php if(empty($users)): ?>
  <p class="lead mt-3 text-danger">there is no user available right now</p>
<?php endif; ?>

<?php foreach($users as $user): ?>
  <div class="card my-3 w-75">
    <div class="card-body text-center">
       <?php echo "<p style='color: blue';>" . $user['username'] . "</p>"; ?>
       <div class="text-secondary mt-2">
        <?php echo "<b>${user['email_address']}</b>" . " Activated on " . $user['created_on']; ?>
       </div>
    </div>
  </div>
<?php endforeach; ?>

<?php include 'include/footer.php' ?>