<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="tmp/upload/brandFL.ico"/>
    <title>Future Life</title>
    <?php include 'actor/admin/module/manage_account/manage_account.php' ?>
    <?php
    // Library css
        include 'lib/lib.php';
    // Create session
        session_start();
    // logout admin
        $account_admin = new account_admin();
        if ($_GET['action'] == 'logout'){
            $logout_admin = $account_admin->logout_admin();
        }
    ?>
</head>

<body>
    <div class="nav-bar">
        <h3><i class="fa fa-envira"></i> Future Life</h3>
        <div class="user">
            <li class="menu">
                <a href = "#"><p>Chào Admin</p> <img src="tmp/img/tải xuống.jpg" alt=""></a>
                <ul class="sub-menu">
                    <li><a href="#">Thông tin cá nhân</a></li>
                    <li><a href="admin_cp.php?action=logout">Đăng xuất</a></li>
                </ul>
            </li>
        </div>
    </div>
    <div class="admin_cp">
        <div class="wrapper">
            <div class="menu_admin">
            <h3 class="title_admin_cp"><i class="fa fa-envira"></i> Future Life ADMIN</h3>
                <?php include 'template/views/admin/menu_admin.php' ?>
            </div>
            <div class="funtion_admin">
                <div class="sub_funtion_admin">
                <h1><i class="fa fa-desktop"></i> <?php include 'actor/admin/module/title_screen_admin.php' ?></h1>
                <?php
                    include("route/route.php");
                ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>