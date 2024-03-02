<?php include '../../../../actor/admin/module/login_admin/login_admin.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" type="image/png" href="../../../../tmp/upload/brandFL.ico"/>
  <title>Đăng nhập admin Future Life</title>
  <!-- css login admin -->
  <link rel="stylesheet" type="text/css" href="../../../../tmp/css/login_admin.css">
  <!-- check login admin -->
  <script src="..\..\..\..\actor\admin\validate\check_login.js"></script>
</head>
<?php
// Login admin
  $login_admin = new login_admin();
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $check_login = $login_admin->login_user_admin($user_name, $password);
  }
?>
<body>
  <div class="form-login">
    <form action="" name = "login_form" onsubmit = "return(check_login());" method="post">
      <h2><i class="fa fa-flag-checkered"></i> Đăng nhập Future Life</h2>
      <div class="input-group">
        <label for="user_name">Tên đăng nhập</label>
        <input type="text" name="user_name" value="">
        <label for="password">Mật khẩu</label>
        <input type="password" name="password" value="">
      </div>
      <p id="error-text" style="width: 236.27px; font-weight:bold; margin-top: 5px; color: red;"></p>
      <button type="submit">Đăng nhập</button>
    </form>
  </div>
</body>

</html>