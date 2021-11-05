<?php
session_start();
require_once "models/helper.php";
$submit = filter_input(INPUT_POST, 'submit');
if ($submit === NULL) {
    $submit = filter_input(INPUT_GET, 'submit');
    if ($submit === NULL) {
        $submit = "show";
    }
}
// thông tin của các người đứng đầu về điểm 
db_connect();
$sql = "SELECT * FROM taikhoan ORDER BY diem DESC";
$oder = getData($sql);
dis_db_connect();
if (isset($oder)) {
    $_SESSION['diem_max_ten'] = $oder[0]['tentk'];
    $_SESSION['diem_max_so_lan_lam'] = $oder[0]['so_lan_lam'];
    $_SESSION['diem_max_diem'] = $oder[0]['diem'];
    $_SESSION['diem_max_email'] = $oder[0]['email'];
    $diem_max_ten = $_SESSION['diem_max_ten'];
    $diem_max_so_lan_lam = $_SESSION['diem_max_so_lan_lam'];
    $diem_max_diem = $_SESSION['diem_max_diem'];
    $diem_max_email = $_SESSION['diem_max_email'];
}
// thông tin của các người đứng đầu về số lần làm bài thi 
db_connect();
$sql = "SELECT * FROM taikhoan ORDER BY so_lan_lam DESC";
$oder2 = getData($sql);
dis_db_connect();
if (isset($oder2)) {
    $_SESSION['lam_max_ten'] = $oder2[0]['tentk'];
    $_SESSION['lam_max_so_lan_lam'] = $oder2[0]['so_lan_lam'];
    $_SESSION['lam_max_diem'] = $oder2[0]['diem'];
    $_SESSION['lam_max_email'] = $oder2[0]['email'];
    $lam_max_ten = $_SESSION['lam_max_ten'];
    $lam_max_so_lan_lam = $_SESSION['lam_max_so_lan_lam'];
    $lam_max_diem = $_SESSION['lam_max_diem'];
    $lam_max_email = $_SESSION['lam_max_email'];
}
// thông tin của các người toàn diện dang nhap 
db_connect();
$sql = "SELECT * FROM taikhoan ORDER BY so_lan_dn DESC";
$oder3 = getData($sql);
dis_db_connect();
if (isset($oder3)) {
    $_SESSION['dn_max_ten'] = $oder3[0]['tentk'];
    $_SESSION['dn_max_so_lan_dn'] = $oder3[0]['so_lan_dn'];
    $_SESSION['dn_max_diem'] = $oder3[0]['diem'];
    $_SESSION['dn_max_email'] = $oder3[0]['email'];
    $dn_max_ten = $_SESSION['dn_max_ten'];
    $dn_max_so_lan_dn = $_SESSION['dn_max_so_lan_dn'];
    $dn_max_diem = $_SESSION['dn_max_diem'];
    $dn_max_email = $_SESSION['dn_max_email'];
}
switch ($submit) {
    case "show":
        include_once "taikhoan/view.php";
        break;
    case "dang nhap":       // di den
        require_once "taikhoan/dangnhap.php";
        break;
    case "dang ky":         // di den
        require_once "taikhoan/dangky.php";
        break;
    case "registration":
        $name = $_POST['name'];
        $email = $_POST['email'];
        $p1 = $_POST['pass'];
        $p2 = $_POST['CFpass'];
        if ($p1 != $p2) {
            $errorP2 = "password incorrect";
        } else {
            $errorP2 = "";      // kt tinh hop le 

            // kiem tra trung tai khoan
            db_connect();
            $sql = "SELECT * FROM taikhoan";
            $nametk = getData($sql);
            dis_db_connect();
            // echo "7";
            if (!empty($nametk)) {
                $flag = 1;
                foreach ($nametk as $key => $value) {
                    if ($value['tentk'] == $name || $value['email'] == $email) {
                        $flag = 0;
                        $errorName = "Account name or email already exists ";
                        break;
                    }
                }
                // dung bien flag lam co 
                if ($flag == 1) {
                    // them tai khoan 
                    $errorP2 = "Account added successfully ";
                    // echo "them thanh cong";
                    db_connect();
                    add_taikhoan($name, $email, 1, 1, 0, 0, $p1);
                    dis_db_connect();

                    // THANH CONG DANG KY THI CHUYEN DEN TRANG DICH 
                    // require_once den trang dich

                }
            } else {
                // truong hop chua co tai khoan nao
                // them tai khoan 
                $errorP2 = "tai khoan da them thanh cong";
                // echo "them thanh cong";
                db_connect();
                add_taikhoan($name, $email, 1, 1, 0, 0, $p1);
                dis_db_connect();
                // require_once den trang dich
            }
        }
        require_once "taikhoan/dangky.php";
        break;

    case "Log In":
        $email = $_POST['emaildn'];
        $pas = $_POST['passdn'];
        $_SESSION['email'] = $email;
        $_SESSION['pas'] = $pas;
        db_connect();
        $sql = "SELECT * FROM taikhoan";
        $nametk2 = getData($sql);
        dis_db_connect();

        $Quyen = 1;
        $Account = 0;
        if (!empty($nametk2)) {                                             // kiểm trâ xem co tai khoản nào chưa 
            foreach ($nametk2 as $key => $value) {
                if ($value['email'] == $email) {                              // kiem tra khớp email 
                    if (password_verify($pas, $value['mk'])) {                // kiem tra mat khau
                        $Account = 1;
                        // đăng nhập thành công cập nhật số lần đăng nhập 
                        db_connect();
                        $number_dn = (int) $value['so_lan_dn'] + 1;
                        // update_so_lan_dn($value['tentk'], $number_dn);
                        $tentk = $value['tentk'];
                        $sql = "UPDATE `taikhoan` SET `so_lan_dn`=$number_dn WHERE tentk='$tentk'";
                        update($sql);
                        dis_db_connect();
                        // lay thong tin de hien thi trong trang 
                        $_SESSION['name'] = $value['tentk'];  // lấy tên cho trang manager.php
                        // $name =  $value['tentk'];
                        $_SESSION['so_lan_dn'] = $value['so_lan_dn'];
                        $_SESSION['so_lan_lam'] = $value['so_lan_lam'];
                        $_SESSION['diem'] = $value['diem'];   // lây số điểm  
                        if ($value['Quyen'] == 0) {                            // kiem tra quyen 
                            $Quyen = 0;
                        }
                    }
                }
            }
        }
        if ($Account == 1) {     // thành công đăng nhập 
            $so_lan_dn =  $_SESSION['so_lan_dn'];
            $so_lan_lam =  $_SESSION['so_lan_lam'];
            $diem = $_SESSION['diem'];
            $name = $_SESSION['name'];
            $_SESSION['quyen'] = $Quyen;
            // lấy ảnh đại diện
            $level = 0;
            if ($diem == 100) {
                $level = 5; // king
            } else if ($diem <= 99 && $diem >= 90) {
                $level = 4; // dai tuong 
            } else if ($diem < 90 && $diem >= 80) {
                $level = 3; // trung tuong 
            } else if ($diem < 80 && $diem >= 50) {
                $level = 2; // ha si 
            } else if ($diem < 50 && $diem >= 0) {
                $level = 1;
            }
            $_SESSION['level'] = $level;
            $cap_do = $_SESSION['level'];

            // lấy số lượng account 
            db_connect();
            $count = count($nametk2);
            dis_db_connect();
            $_SESSION['so_luong_acc'] = $count;
            $number_acc = $_SESSION['so_luong_acc'];
            // require_once den trang admin
            require_once "./admin/manager.php";
        } else {
            $errorP1dn = "sai mat khau";
            require_once "taikhoan/dangnhap.php";
        }
        break;
    case 'page':
        //  data người dùng 
        $so_lan_dn =  $_SESSION['so_lan_dn'];
        $so_lan_lam =  $_SESSION['so_lan_lam'];
        $diem = $_SESSION['diem'];
        $Quyen = $_SESSION['quyen'];
        $name = $_SESSION['name'];
        $number_acc = $_SESSION['so_luong_acc'];
        $cap_do = $_SESSION['level'];
        $trang = $_GET['pages'];
        include_once "./admin/manager.php";
        break;
    case 'manager':
        //  data người dùng 
        $so_lan_dn =  $_SESSION['so_lan_dn'];
        $so_lan_lam =  $_SESSION['so_lan_lam'];
        $diem = $_SESSION['diem'];
        $Quyen = $_SESSION['quyen'];
        $name = $_SESSION['name'];
        $number_acc = $_SESSION['so_luong_acc'];
        $cap_do = $_SESSION['level'];
        $number_acc = $_SESSION['so_luong_acc'];
        require_once './admin/manager.php';
        break;
    case 'admin':                                                       // chuyển đổi admin về user
        $so_lan_dn =  $_SESSION['so_lan_dn'];
        $so_lan_lam =  $_SESSION['so_lan_lam'];
        $diem = $_SESSION['diem'];
        $name = $_SESSION['name'];
        $number_acc = $_SESSION['so_luong_acc'];
        $cap_do = $_SESSION['level'];
        $Quyen = $_SESSION['quyen'];
        $ten = $_POST['ten'];
        db_connect();
        $sql = "UPDATE `taikhoan` SET `Quyen`=1 WHERE tentk='$ten'";
        update($sql);
        dis_db_connect();
        if (isset($name)) {
            include_once "./admin/manager.php";
        } else {
            require_once './error.php';
        }
        // include_once "./admin/manager.php";
        break;
    case 'user':                                                     // chuyển đổi user về admin
        $so_lan_dn =  $_SESSION['so_lan_dn'];
        $so_lan_lam =  $_SESSION['so_lan_lam'];
        $diem = $_SESSION['diem'];
        $name = $_SESSION['name'];
        $number_acc = $_SESSION['so_luong_acc'];
        $cap_do = $_SESSION['level'];
        $Quyen = $_SESSION['quyen'];

        $ten = $_POST['ten'];
        db_connect();
        $sql = "UPDATE `taikhoan` SET `Quyen`=0 WHERE tentk='$ten'";
        update($sql);
        dis_db_connect();

        include_once "./admin/manager.php";
        break;
    case 'Del':                                                   // xóa tài khoản người dùng 
        $so_lan_dn =  $_SESSION['so_lan_dn'];
        $so_lan_lam =  $_SESSION['so_lan_lam'];
        $diem = $_SESSION['diem'];
        $Quyen = $_SESSION['quyen'];
        $name = $_SESSION['name'];
        $number_acc = $_SESSION['so_luong_acc'];
        $cap_do = $_SESSION['level'];
        // SAU KHI XÓA TÀI KHOẢN BỞI QUẢN LÝ TỪ TRANG MANAGER THÌ PHẢI UPDATE LẠI CÁC TOP 

        // thông tin của các người đứng đầu về điểm 
        db_connect();
        $sql = "SELECT * FROM taikhoan ORDER BY diem DESC";
        $oder = getData($sql);
        dis_db_connect();
        if (isset($oder)) {
            $_SESSION['diem_max_ten'] = $oder[0]['tentk'];
            $_SESSION['diem_max_so_lan_lam'] = $oder[0]['so_lan_lam'];
            $_SESSION['diem_max_diem'] = $oder[0]['diem'];
            $_SESSION['diem_max_email'] = $oder[0]['email'];
            $diem_max_ten = $_SESSION['diem_max_ten'];
            $diem_max_so_lan_lam = $_SESSION['diem_max_so_lan_lam'];
            $diem_max_diem = $_SESSION['diem_max_diem'];
            $diem_max_email = $_SESSION['diem_max_email'];
        }
        // thông tin của các người đứng đầu về số lần làm bài thi 
        db_connect();
        $sql = "SELECT * FROM taikhoan ORDER BY so_lan_lam DESC";
        $oder2 = getData($sql);
        dis_db_connect();
        if (isset($oder2)) {
            $_SESSION['lam_max_ten'] = $oder2[0]['tentk'];
            $_SESSION['lam_max_so_lan_lam'] = $oder2[0]['so_lan_lam'];
            $_SESSION['lam_max_diem'] = $oder2[0]['diem'];
            $_SESSION['lam_max_email'] = $oder2[0]['email'];
            $lam_max_ten = $_SESSION['lam_max_ten'];
            $lam_max_so_lan_lam = $_SESSION['lam_max_so_lan_lam'];
            $lam_max_diem = $_SESSION['lam_max_diem'];
            $lam_max_email = $_SESSION['lam_max_email'];
        }
        // thông tin của các người toàn diện dang nhap 
        db_connect();
        $sql = "SELECT * FROM taikhoan ORDER BY so_lan_dn DESC";
        $oder3 = getData($sql);
        dis_db_connect();
        if (isset($oder3)) {
            $_SESSION['dn_max_ten'] = $oder3[0]['tentk'];
            $_SESSION['dn_max_so_lan_dn'] = $oder3[0]['so_lan_dn'];
            $_SESSION['dn_max_diem'] = $oder3[0]['diem'];
            $_SESSION['dn_max_email'] = $oder3[0]['email'];
            $dn_max_ten = $_SESSION['dn_max_ten'];
            $dn_max_so_lan_dn = $_SESSION['dn_max_so_lan_dn'];
            $dn_max_diem = $_SESSION['dn_max_diem'];
            $dn_max_email = $_SESSION['dn_max_email'];
        }

        $ten = $_POST['ten'];
        db_connect();
        delete_account($ten);
        dis_db_connect();
        include_once "./admin/manager.php";
        break;
    case 'Log out':
        unset($_SESSION['quyen']);
        unset($_SESSION['pas']);
        unset($_SESSION['email']);
        unset($_SESSION['so_lan_dn']);
        unset($_SESSION['so_lan_lam']);
        unset($_SESSION['diem']);
        unset($_SESSION['name']);
        unset($_SESSION['level']);

        // unset cua top 
        unset($_SESSION['diem_max_ten']);
        unset($_SESSION['diem_max_so_lan_lam']);
        unset($_SESSION['diem_max_diem']);

        unset($_SESSION['lam_max_ten']);
        unset($_SESSION['lam_max_so_lan_lam']);
        unset($_SESSION['lam_max_diem']);

        unset($_SESSION['dn_max_ten']);
        unset($_SESSION['dn_max_so_lan_dn']);
        unset($_SESSION['dn_max_diem']);
        require_once "taikhoan/dangnhap.php";
        break;
    case 'OK':                                                                 // setting password
        $so_lan_dn =  $_SESSION['so_lan_dn'];
        $so_lan_lam =  $_SESSION['so_lan_lam'];
        $diem = $_SESSION['diem'];
        $Quyen = $_SESSION['quyen'];
        $name = $_SESSION['name'];
        $number_acc = $_SESSION['so_luong_acc'];
        $cap_do = $_SESSION['level'];

        $curr_pass = $_POST['current_password'];
        $new_pass = $_POST['new_password'];
        $cf_new_pass = $_POST['cf_new_password'];
        $name_acc = $_POST['set_name_acc'];
        if (!isset($name)) {                                                 // kiem tra co session hay chua
            require_once './error.php';
        }
        db_connect();
        $sql = "SELECT * FROM taikhoan";
        $kt_taikhoan = getData($sql);
        dis_db_connect();
        $kt = 0;
        foreach ($kt_taikhoan as $key => $value) {
            if ($value['tentk'] == $name_acc) {
                $kt = 1;
                $mk = $value['mk'];
            }
        }
        $curr_pass_error = "";
        $new_pass_error = "";
        $new_pass_null = "";
        // echo password_hash('12345', PASSWORD_DEFAULT);
        // echo "<br>";
        // echo password_hash('12345', PASSWORD_DEFAULT);
        if (password_verify($curr_pass, $mk)) {                              // kiểm tra ăn khắp mật khẩu cũ 
            if ($new_pass != '') {
                if ($new_pass == $cf_new_pass) {
                    // điều kiện đúng hết
                    $new_password = password_hash($new_pass, PASSWORD_DEFAULT);
                    db_connect();
                    $sql = "UPDATE `taikhoan` SET `mk`='$new_password' WHERE tentk='$name_acc'";
                    update($sql);
                    dis_db_connect();
                    require_once './taikhoan/dangnhap.php';
                } else {
                    $new_pass_error = "password incorrect";                 //kiểm tra ăn khớp với với 2 pass new  
                    require_once './admin/manager.php';
                }
            } else {
                $new_pass_null = "not be empty";                            // kiêm tra mk mới có bị null
                require_once './admin/manager.php';
            }
        } else {
            $curr_pass_error = "wrong password";                            // kiểm tra ăn khớp với mật khẩu cũ 
            require_once './admin/manager.php';
        }
        break;

        //  xử lý bài tập điền từ còn thiếu
    case 'list_question_choose':
        db_connect();
        $sql = "SELECT * FROM question_choose";
        $question = getData($sql);
        dis_db_connect();
        if (!empty($question)) {                                             // kiểm tra xem đã có dữ liệu chưa nếu chưa thì 
            $title_website  = "List question choose";
            require_once './admin/list_question_choose.php';
        } else {
            $error = "No questions have been added , or more questions have been added before . ";
            $title_website  = "Add question choose";
            require_once './admin/add_question_choose.php';
        }
        break;
    case 'page_question_choose':
        $pages = $_GET['pages'];
        $title_website  = "List question choose";
        require_once './admin/list_question_choose.php';
        break;
    case 'detail_question_choose':
        $id_detail = $_POST['id_detail'];
        db_connect();
        $sql = "SELECT * FROM question_choose WHERE idChoose LIKE $id_detail";
        $data_one_choose = getData($sql);
        dis_db_connect();

        $title_website  = "Detail question choose";
        require_once './admin/detail_choose.php';
        break;
    case 'update_question_choose':
        $id = $_POST['id_question_choose'];
        "<br>";
        $tieu_de = $_POST['tieude_question'];
        "<br>";
        $dapan_dung = $_POST['dapan_dung'];
        "<br>";
        $dapan1 = $_POST['dapan_1'];
        "<br>";
        $dapan2 = $_POST['dapan_2'];
        "<br>";
        $dapan3 = $_POST['dapan_3'];

        db_connect();
        $sql = "UPDATE `question_choose` SET `tieu_de`='$tieu_de',`dapan_dung`='$dapan_dung',`dapan1`='$dapan1',`dapan2`='$dapan2',`dapan3`='$dapan3' WHERE idChoose = $id";
        update($sql);
        $sql = "SELECT * FROM question_choose WHERE idChoose LIKE $id";
        $data_one_choose = getData($sql);
        dis_db_connect();
        $error = "successfully added question";
        $title_website  = "Detail question choose";
        require_once './admin/detail_choose.php';
        break;
    case 'BACK_question_choose':                                        // trở về trang danh sách các câu hỏi điền từ 
        db_connect();
        $sql = "SELECT * FROM question_choose";
        $data_choose = getData($sql);
        dis_db_connect();
        $title_website  = "List question choose";
        require_once './admin/list_question_choose.php';
        break;
    case 'del_question_choose':
        $id = $_POST['id_detail'];

        db_connect();
        $sql1 = "DELETE FROM `question_choose` WHERE idChoose = $id";
        delete($sql1);

        $sql2 = "SELECT * FROM question_choose";
        $data_choose = getData($sql2);
        dis_db_connect();

        $title_website  = "List question choose";
        require_once './admin/list_question_choose.php';
        break;

    case 'add_question_choose':                                            // di chuyển đến trang thêm câu hỏi điền từ 
        $title_website  = "Add question choose";
        require_once './admin/add_question_choose.php';
        break;
    case 'add_choose_quest':
        $tieu_de = $_POST['tieude_question'];
        $dapan_dung = $_POST['dapan_dung'];
        $dapan_1 = $_POST['dapan_1'];
        $dapan_2 = $_POST['dapan_2'];
        $dapan_3 = $_POST['dapan_3'];
        db_connect();
        $sql = "SELECT * FROM question_choose";
        $question = getData($sql);
        dis_db_connect();
        $kt_trunglap = 0;
        if (empty($question)) {                                                 // kiểm tra trùng lặp 
            db_connect();
            add_question_choose($tieu_de, $dapan_dung, $dapan_1, $dapan_2, $dapan_3);
            dis_db_connect();
            $error = "successfully added question";
            $title_website  = "Add question choose";
            require_once './admin/add_question_choose.php';
        } else {
            foreach ($question as $key => $value) {
                if ($tieu_de == $value['tieu_de']) {
                    $kt_trunglap = 1;
                }
            }
            if ($kt_trunglap == 1) { //                                           // trùng 
                $error = "Duplicate question, re-enter another question";
                $title_website  = "Add question choose";
                require_once './admin/add_question_choose.php';
            } else {
                db_connect();
                add_question_choose($tieu_de, $dapan_dung, $dapan_1, $dapan_2, $dapan_3);
                dis_db_connect();
                $error = "successfully added question";
                $title_website  = "Add question choose";
                require_once './admin/add_question_choose.php';
            }
        }
        break;
        // xử lý bài tập nghe 
    case 'list_question_audio':
        db_connect();
        $sql = "SELECT * FROM question_audio";
        $question = getData($sql);
        dis_db_connect();
        if (!empty($question)) {                                             // kiểm tra trên CSDL có data chưa
            $title_website  = "List question audio";
            require_once './admin/list_question_audio.php';
        } else {
            $error = "No questions have been added , or more questions have been added before .";
            $title_website  = "Add question audio";
            require_once './admin/add_question_audio.php';
        }
        break;
    case 'add_question_audio':                                              // di chuyênr đến trang thêm câu hỏi nghe 
        $title_website  = "Add question audio";
        require_once './admin/add_question_audio.php';
        break;
    case 'page_question_audio':
        $pages = $_GET['pages'];
        $title_website  = "List question audio";
        require_once './admin/list_question_audio.php';
        break;
    case 'detail_question_audio':
        $id = $_POST['id_detail'];
        db_connect();
        $sql = "SELECT * FROM question_audio WHERE idAudio LIKE $id";
        $data_one_audio = getData($sql);
        dis_db_connect();
        $title_website  = "Detail question audio";
        require_once './admin/detail_audio.php';
        break;
    case 'update_audio_quest':
        $id = $_POST['id_question_audio'];
        $name_file = $_FILES['file_audio']['name'];               // tên file mới 
        $name_file_current = $_POST['name_file_current'];         //  tên file lúc chưa đổi 
        $dapan_dung = $_POST['dapan_dung'];
        $dapan1 = $_POST['dapan_1'];
        $dapan2 = $_POST['dapan_2'];
        $dapan3 = $_POST['dapan_3'];
        $cap_nhat_hay_khong  =  1;
        if (empty($name_file)) {                                  // nếu không muốn cập nhật lại file audio 
            $cap_nhat_hay_khong = 0;
        }
        // xử lý cập nhật 
        if ($cap_nhat_hay_khong == 0) {                          // nếu không cập nhật file nghe 
            db_connect();
            $sql = "UPDATE `question_audio` SET `tieu_de`='$name_file_current',`dapan_dung`='$dapan_dung',`dapan1`='$dapan1',`dapan2`='$dapan2',`dapan3`='$dapan3' WHERE idAudio = $id";
            update($sql);
            $sql = "SELECT * FROM question_audio WHERE idAudio LIKE $id";
            $data_one_audio = getData($sql);
            dis_db_connect();
            $error = "successfully added file";
            $title_website  = "Detail question audio";
            require_once './admin/detail_audio.php';
        } else {                                                  // nếu cập nhật file nghe 
            // xóa file cũ 
            $path = "uploads/" . $name_file_current;               // đường dẫn file hiện tại 
            unlink($path);
            // 1024B = 1 kb 
            $maxsize = 1024 * 1024 * 5; //5MB
            // định dạng file cho phep 
            $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg", "mp3");
            // lưu file vào thư muc uploads
            $target_dir = "./uploads/";
            $new_name_file  = rand(0, 9999999999999) . $name_file;
            $target_file = $target_dir . $new_name_file;           // đường dẫn file mới 
            $duoi_mo_rong = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));;
            if (in_array($duoi_mo_rong, $extensions_arr)) {
                if ($_FILES['file_audio']['size'] < $maxsize) {
                    // tmp_name vị trí lưu tạm thời 
                    if (move_uploaded_file($_FILES['file_audio']['tmp_name'], $target_file)) {
                        $error = "successfully added file";
                        db_connect();
                        $sql = "UPDATE `question_audio` SET `tieu_de`='$new_name_file',`dapan_dung`='$dapan_dung',`dapan1`='$dapan1',`dapan2`='$dapan2',`dapan3`='$dapan3' WHERE idAudio = $id";
                        update($sql);
                        $sql = "SELECT * FROM question_audio WHERE idAudio LIKE $id";
                        $data_one_audio = getData($sql);
                        dis_db_connect();
                        $title_website  = "Detail question audio";
                        require_once './admin/detail_audio.php';
                    } else {
                        $error = "add file failed ";
                        $title_website  = "Detail question audio";
                        require_once './admin/detail_audio.php';
                    }
                } else {
                    $error = "file is too big choose smaller file  ";
                    $title_website  = "Detail question audio";
                    require_once './admin/detail_audio.php';
                }
            } else {
                $error = "Invalid extension ";
                $title_website  = "Detail question audio";
                require_once './admin/detail_audio.php';
            }
        }
        break;
    case 'BACK_question_audio':                                        // trở về trang danh sách các câu hỏi điền từ 
        db_connect();
        $sql = "SELECT * FROM question_audio";
        $data_one_audio = getData($sql);
        dis_db_connect();
        $title_website  = "List question audio";
        require_once './admin/list_question_audio.php';
        break;
    case 'del_question_audio':
        $id = $_POST['id_audio'];
        $name_file = $_POST['name_file'];
        $path = "uploads/" . $name_file;               // đường dẫn file hiện tại 
        unlink($path);                                         // xóa file nghe 
        db_connect();
        $sql1 = "DELETE FROM `question_audio` WHERE idAudio = $id";
        delete($sql1);
        dis_db_connect();
        $title_website  = "List question audio";
        require_once './admin/list_question_audio.php';
        break;
    case 'add_audio_quest':
        $name_file = $_FILES['file_audio']['name'];                         // tên file kèm phần mở rộng 
        $dapan_dung = $_POST['dapan_dung'];
        $dapan1 = $_POST['dapan_1'];
        $dapan2 = $_POST['dapan_2'];
        $dapan3 = $_POST['dapan_3'];
        db_connect();
        $sql = "SELECT * FROM question_audio ";
        $list_question = getData($sql);
        dis_db_connect();
        $kt_trunglap = 0;
        if (!empty($list_question)) {                                          // kiểm tra xem có bị trùng hay không 
            foreach ($list_question as $key => $value) {
                if ($name_file == $value['tieu_de']) {
                    $kt_trunglap = 1;
                }
            }
        }
        if ($kt_trunglap == 0) {
            // 1024B = 1 kb 
            $maxsize = 1024 * 1024 * 5; //5MB
            // định dạng file cho phep 
            $extensions_arr = array("mp4", "avi", "3gp", "mov", "mpeg", "mp3");
            // lưu file vào thư muc uploads
            $target_dir = "./uploads/";
            $new_name_file  = rand(0, 9999999999999) . $name_file;
            $target_file = $target_dir . $new_name_file;
            $duoi_mo_rong = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));;
            if (!empty($_FILES)) {
                if (in_array($duoi_mo_rong, $extensions_arr)) {
                    if ($_FILES['file_audio']['size'] < $maxsize) {
                        // tmp_name vị trí lưu tạm thời 
                        if (move_uploaded_file($_FILES['file_audio']['tmp_name'], $target_file)) {
                            $error = "successfully added file";

                            db_connect();
                            add_question_audio($new_name_file, $dapan_dung, $dapan1, $dapan2, $dapan3);
                            dis_db_connect();
                            $title_website  = "Add question audio";
                            require_once './admin/add_question_audio.php';
                        } else {
                            $error = "add file failed ";
                            $title_website  = "Add question audio";
                            require_once './admin/add_question_audio.php';
                        }
                    } else {
                        $error = "file is too big choose smaller file  ";
                        $title_website  = "Add question audio";
                        require_once './admin/add_question_audio.php';
                    }
                } else {
                    $error = "Invalid extension ";
                    $title_website  = "Add question audio";
                    require_once './admin/add_question_audio.php';
                }
            } else {
                $error =  "file not selected";
                $title_website  = "Add question audio";
                require_once './admin/add_question_audio.php';
            }
        } else {
            $error = "error file please choose again ";
            $title_website  = "Add question audio";
            require_once './admin/add_question_audio.php';
        }
        break;
        // xử lý question writen  
    case 'list_question_write':
        db_connect();
        $sql = "SELECT * FROM question_write";
        $question = getData($sql);
        dis_db_connect();
        if (!empty($question)) {                                // kiểm tra trên CSDL có data chưa
            $title_website  = "List question write";
            require_once './admin/list_question_write.php';
        } else {
            $error = "No questions have been added , or more questions have been added before .";
            $title_website  = "Add question write";
            require_once './admin/add_question_write.php';
        }
        break;
    case 'page_question_write':
        $pages = $_GET['pages'];
        $title_website  = "List question write";
        require_once './admin/list_question_write.php';
        break;
    case 'detail_question_write':
        $id = $_POST['id_detail'];
        db_connect();
        $sql = "SELECT * FROM question_write WHERE idWrite LIKE $id";
        $data_one_write = getData($sql);
        dis_db_connect();
        $title_website  = "Detail question write";
        require_once './admin/detail_write.php';
        break;
    case 'BACK_question_write':                                        // trở về trang danh sách các câu hỏi viết
        db_connect();
        $sql = "SELECT * FROM question_write";
        $data_one_audio = getData($sql);
        dis_db_connect();
        $title_website  = "List question write";
        require_once './admin/list_question_write.php';
        break;
    case 'update_question_write':
        $id = $_POST['id_question_write'];
        $tieu_de = $_POST['tieude_question'];
        $dapan_dung = $_POST['dapan_dung'];
        db_connect();
        $sql = "UPDATE `question_write` SET `tieu_de`='$tieu_de',`dapan_dung`='$dapan_dung' WHERE idWrite = $id";
        update($sql);

        $sql = "SELECT * FROM question_write WHERE idWrite LIKE $id";
        $data_one_write = getData($sql);
        dis_db_connect();
        $error = "uploads successfully";
        $title_website  = "Detail question write";
        require_once './admin/detail_write.php';
        break;
    case 'del_question_write':
        $id = $_POST['id_detail'];

        db_connect();
        $sql1 = "DELETE FROM `question_write` WHERE idWrite = $id";
        delete($sql1);
        dis_db_connect();

        $title_website  = "List question write";
        require_once './admin/list_question_write.php';
        break;
    case 'add_question_write':
        $title_website  = "Add question write";
        require_once './admin/add_question_write.php';
        break;
    case 'add_write_quest':
        $tieu_de = $_POST['tieude_question'];
        $dapan_dung = $_POST['dapan_dung'];
        db_connect();
        $sql = "SELECT * FROM question_write";
        $question = getData($sql);
        dis_db_connect();
        $kt_data_co_trung = 0;
        if (!empty($question)) {
            foreach ($question as $key => $value) {                             // kiểm tra xem có bị trùng câu hỏi không 
                if ($tieu_de == $value['tieu_de']) {
                    $kt_data_co_trung = 1;
                }
            }
            if ($kt_data_co_trung == 1) {
                $error = "Duplicate question, re-enter another question";
                $title_website  = "Add question write";
                require_once './admin/add_question_write.php';
            } else {
                db_connect();
                $dapan_dung = $i;
                add_question_write($tieu_de, $dapan_dung);
                dis_db_connect();
                $error = "successfully added question";
                $title_website  = "Add question write";
                require_once './admin/add_question_write.php';
            }
        } else {
            db_connect();
            add_question_write($tieu_de, $dapan_dung);
            dis_db_connect();
            $error = "successfully added question";
            $title_website  = "Add question write";
            require_once './admin/add_question_write.php';
        }
        break;

        // phần thi của user
    case 'START NOW':
        $t = 0;
        echo $t + 1;
        $name = $_SESSION['name'];                                              // người làm bài 
        db_connect();
        $sql = "SELECT * FROM  question_choose";
        $question_choose = getData($sql);                                      // lấy toàn bộ câu hỏi 
        dis_db_connect();
        shuffle($question_choose);

                                                                               // lấy số đúng 15 câu hỏi 
        $number_question = array();
        for ($i = 0; $i  < 2; $i++) {
            $number_question[$i] = $question_choose[$i];
        }

        echo "<br> id cua cac phan tu <br>";                                   // id cua các câu hỏi 
        for ($i = 0; $i < 2; $i++) {
            echo  $number_question[$i]['idChoose'] . "<br>";
        }
        $dap_an = array();                                                    // lấy đáp án của câu hỏi  , mảng đa chiều , 1 mảng con chứa đáp án (đúng/sai) của một câu hỏi
        for ($i = 0; $i < 2; $i++) {
            $dap_an[$i][] = $question_choose[$i]['dapan_dung'];
            $dap_an[$i][] = $question_choose[$i]['dapan1'];
            $dap_an[$i][] = $question_choose[$i]['dapan2'];
            $dap_an[$i][] = $question_choose[$i]['dapan3'];
        }
        echo "<pre>";
        print_r($dap_an);
        echo "</pre>";
        for ($i = 0; $i < 2; $i++) {                                         // tráo phần tử của mảng con ($i)          
            shuffle($dap_an[$i]);
        }
        echo "<pre>";
        print_r($dap_an);
        echo "</pre>";
                                                                            // lưu các câu hỏi của người kiểm tra bằng session để sau này kiểm tra 
        $_SESSION['question'] = $number_question;

        echo "session";
        echo "<pre>";
        print_r($_SESSION['question']);
        echo "</pre>";

        require_once './user/page/exam.php';
        break;
    case 'BACK_manager': //
        //  data người dùng 
        $so_lan_dn =  $_SESSION['so_lan_dn'];
        $so_lan_lam =  $_SESSION['so_lan_lam'];
        $diem = $_SESSION['diem'];
        $Quyen = $_SESSION['quyen'];
        $name = $_SESSION['name'];
        $number_acc = $_SESSION['so_luong_acc'];
        $cap_do = $_SESSION['level'];
        $number_acc = $_SESSION['so_luong_acc'];
        require_once './admin/manager.php';
        break;

    case 'phan_choose':
        echo "session";
        echo "<pre>";
        print_r($_SESSION['question']);
        echo "</pre>";
        break;
}
