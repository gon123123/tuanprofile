<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="https://github.com/gon123123/gon123123/blob/master/LOGO.JPG?raw=true" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/dacs2/public/css/manager.css">
    <link rel="stylesheet" href="http://localhost/dacs2/public/css/footer1.css">
    <title>Manager</title>
</head>
<style>

</style>

<body>
    <header>
        <div class="nav__bar">
            <div class="bar">
                <p><?php if ($Quyen == 0) {
                        echo "ADMIN";
                    } else {
                        echo "USER";
                    } ?></p>
                <i onclick="bat()" id="tat" style="visibility: visible;" class="fas fa-chevron-right bar__function"></i>
                <i onclick="tat();" id="bat" style="visibility: hidden;" class="fas fa-chevron-left bar__function"></i>
            </div>
            <div class="navbar_admin">
                <div class="box__account">
                    <div class="box__image">
                        <img src="https://github.com/gon123123/gon123123/blob/master/logo-removebg-preview.png?raw=true" alt="">
                    </div>
                    <div class="box__account-name dropdown">
                        <p class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo  $name ?>
                        </p>
                        <div class="dropdown-menu menu_account">
                            <a class="dropdown-item" data-toggle="modal" data-target="#myModal" href="#"><i class="fas fa-address-card"></i> Profile</a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#myModal2" href="#"><i class="fas fa-cog"></i>Setting Pass</a>
                            <a class="dropdown-item" href="?submit=Log out"><i class="fas fa-sign-out-alt"></i>Log out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- sidebar -->
    <?php
    require_once './admin/layout/sidebar.php';
    ?>
    <!-- /sidebar -->
    <!-- content -->
    <div class="content" id="content">
        <?php
        require_once "./admin/layout/UserTop.php";
        ?>
        <?php
        if ($Quyen == 0) {
            require_once "layout/Account.php";
        } else {
            require_once "./user/user.php";
        }
        ?>
        <div>
            <?php
            require_once "./admin/layout/footer.php";
            ?>
        </div>
    </div>
    <!-- The Modal -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title">PROFILE</h5>
                    <button class="outline_button" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <div class="modal__body-left">
                        <img class="img_profile" src="<?php
                                                        if ($Quyen == 0) {
                                                            echo 'https://github.com/gon123123/gon123123/blob/master/chihuy.jpg?raw=true';
                                                        } else {
                                                            if ($cap_do == 1) {
                                                                echo  'https://github.com/gon123123/gon123123/blob/master/tot0.jpg?raw=true';
                                                            } else if ($cap_do == 2) {
                                                                echo  'https://github.com/gon123123/gon123123/blob/master/tot.jpg?raw=true';
                                                            } else if ($cap_do == 3) {
                                                                echo  'https://github.com/gon123123/gon123123/blob/master/trungtuong.jpg?raw=true';
                                                            } else if ($cap_do == 4) {
                                                                echo  'https://github.com/gon123123/gon123123/blob/master/daituong.jpg?raw=true';
                                                            } else if ($cap_do == 5) {
                                                                echo  'https://github.com/gon123123/gon123123/blob/master/king.jpg?raw=true';
                                                            }
                                                        }
                                                        ?>" alt="">
                    </div>
                    <div class="modal__body-right">
                        <p>Name :<?php echo $name; ?></p>
                        <p>Appellation :
                            <?php
                            if ($Quyen == 0) {
                                echo 'ADMIN';
                            } else {
                                if ($cap_do == 1) {
                                    echo  'Soldier';
                                } else if ($cap_do == 2) {
                                    echo  'Commissioned';
                                } else if ($cap_do == 3) {
                                    echo  'Lieutenant-General';
                                } else if ($cap_do == 4) {
                                    echo  'General';
                                } else if ($cap_do == 5) {
                                    echo  'KING';
                                }
                            }
                            ?>
                            <i style="color: orange" class="fas fa-star"></i>
                        </p>
                        <?php
                        if ($Quyen == 0) {
                            echo 'kkkk';
                        ?>
                        <?php
                        } else {
                        ?>
                            <p>Number Exam: <?php echo $so_lan_lam; ?></p>
                            <p>Grade Highest : <?php echo $diem; ?></p>
                            <p>Number Login : <?php echo $so_lan_dn; ?></p>
                        <?php
                        }
                        ?>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    <!-- / The Modal 1 -->
    <div class="modal fade" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Setting PassWord</h4>
                    <button class="outline_button" type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="setting__pass_left">
                        <form action="" method="post">
                            <input type="hidden" name="set_name_acc" value="<?php echo $name ?>">
                            <input id="look_eye1" type="password" name="current_password" required placeholder="Current password">
                            <span>* <?php echo (!empty($curr_pass_error)) ? $curr_pass_error : ""; ?></span>
                            <input id="look_eye2" type="password" name="new_password" required placeholder="New password">
                            <span>* <?php echo (!empty($new_pass_null)) ? $new_pass_null : ""; ?></span>
                            <input id="look_eye3" type="password" name="cf_new_password" required placeholder="Confirm new password">
                            <span>* <?php echo (!empty($new_pass_error)) ? $new_pass_error : ""; ?></span>
                            <input type="submit" name="submit" value="OK">
                        </form>
                    </div>
                    <div class="setting__pas_right">
                        <i id="eye1" onclick="look1();" class="far fa-eye-slash"></i>
                        <i id="eye2" onclick="look2();" class="far fa-eye-slash"></i>
                        <i id="eye3" onclick="look3();" class="far fa-eye-slash"></i>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button style="padding: 0px auto;" type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>
    </div>
</body>
<script src="http://localhost/dacs2/public/js/footer.js"></script>
<script src="http://localhost/dacs2/public/js/manager.js" type="text/javascript"></script>

</html>