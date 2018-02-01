<?php
  require_once 'core/init.php';
  $errors = array();
  if (Input::get('submit')) {

      // memvalidasi
      $validation = new Validation();

      // metode chek
      $validation = $validation->check(array(
        'username' => array(
                      'require' => true,
                      'min'     => 3,
                      'max'     => 50
                    ),
        'password' => array(
                      'require' => true,
                      'min'     => 3,
                    )
      ));

      if ($validation->passed()) {
        $user->register_user(array(
        'username' => Input::get('username'),
        'password' => password_hash( Input::get('password'), PASSWORD_DEFAULT)
        ));

        Session::set('username', Input::get('username'));
        header('Location: profile.php');

      }else {
        $errors = ($validation->errors());
      }
  }

  require_once 'templates/header.php';
 ?>

 <h2>Daftar Disini</h2>

 <form action="register.php" method="post">
   <label for="username">Username</label>
   <input type="text" name="username"><br>
   <label for="password">Password</label>
   <input type="password" name="password"><br>
   <input type="submit" name="submit" value="daftar sekarang"><br>

      <?php
      if (!empty($errors)): ?>
        <div id="errors">
       <?php  foreach ($errors as $error) {  ?>
          <li><?php echo $error; ?></li>
       <?php } ?>
       </div>
     <?php endif; ?>


 </form>

 <?php require_once 'templates/footer.php';?>
