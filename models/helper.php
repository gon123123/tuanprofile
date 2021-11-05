<?php
$dsn = "mysql:host=localhost;dbname=dacs2";
$username = "root";
$pass = "";
$connect = null;

function db_connect()
{
    global $dsn, $username, $pass, $connect;
    try {
        if (is_null($connect)) {
            $connect = new PDO($dsn, $username, $pass);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "ket noi thanh cong ";
        }
    } catch (PDOException $e) {
        echo "ket noi khong thanh cong  $e->getMessage() ";
        include_once('error.php');
        // die();
    }
}
function dis_db_connect()
{
    global $connect;
    if (!is_null($connect)) {
        $connect =  null;
    }
}
function getData($sql = "")
{
    global $connect;
    if (!is_null($connect)) {           // kiểm trâ xem đã kết nối hay chưa 
        $result = $connect->prepare($sql);
        $result->execute();
        if ($result->rowCount() > 0) {
            // $result->setFetchMode(PDO::FETCH_ASSOC);  // khai báo fetch kiểu mảng kết hợp  
            $rows = $result->fetchAll();    // lấy danh sach ket qủa
            $result->closeCursor();         // đóng con trỏ cho phép thức thi lại câu lệnh 
            return $rows;
        }
    }
    return false;
}
function add_taikhoan($ten, $email, $Quyen = 1, $so_lan_dn = 1, $so_lan_lam = 0, $diem = 0, $pass)
{
    global $connect;
    if (!is_null($connect)) {
        $stmt = $connect->prepare("INSERT INTO `taikhoan`(`tentk`, `email`, `Quyen`, `so_lan_dn`, `so_lan_lam`, `diem`, `mk`) VALUES (:tentk,:email,:Quyen,:so_lan_dn,:so_lan_lam,:diem,:matkhau)");  // coi chung dau huyền 

        // du lieu
        $ten1 = $ten;
        $email1 = $email;
        $Quyen1 = $Quyen;           // 1 la user
        $so_lan_dn1 = $so_lan_dn;
        $so_lan_lam1 = $so_lan_lam;
        $diem1 = $diem;
        $pass1 = password_hash($pass, PASSWORD_DEFAULT);

        $stmt->bindParam(':tentk', $ten1);
        $stmt->bindParam(':email', $email1);     // ẩn dấu data
        $stmt->bindParam(':Quyen', $Quyen1);
        $stmt->bindParam(':so_lan_dn', $so_lan_dn1);
        $stmt->bindParam(':so_lan_lam', $so_lan_lam1);
        $stmt->bindParam(':diem', $diem1);
        $stmt->bindParam(':matkhau', $pass1);

        $stmt->execute();
    }
}
function update($sql)           // cập nhật số lần đăng nhập, cập nhật quyền , cập nhật mật khẩu , cập nhật điểm  
{
    global $connect;
    if (!is_null($connect)) {
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    }
}
function delete_account($ten)
{
    global $connect;
    if (!is_null($connect)) {
        // echo "cap nhap dang nhap ";
        $stmt = $connect->prepare("DELETE FROM `taikhoan` WHERE tentk='$ten'");
        $stmt->execute();
    }
}
function delete($sql)
{
    global $connect;
    if (!is_null($connect)) {
        // echo "cap nhap dang nhap ";
        $stmt = $connect->prepare($sql);
        $stmt->execute();
    }
}
function add_question_choose($tieu_de, $dapan_dung, $dapan_1, $dapan_2, $dapan_3)
{
    global $connect;
    if (!is_null($connect)) {
        $stmt = $connect->prepare("INSERT INTO `question_choose`(`tieu_de`, `dapan_dung`, `dapan1`, `dapan2`, `dapan3`) VALUES (:tieu_de,:dapan_dung,:dapan_1,:dapan_2,:dapan_3)");

        $tieu_de1 = $tieu_de;
        $dapan_dung1 = $dapan_dung;
        $dapan_11 = $dapan_1;
        $dapan_12 = $dapan_2;
        $dapan_13 = $dapan_3;

        $stmt->bindParam(':tieu_de', $tieu_de1);
        $stmt->bindParam(':dapan_dung', $dapan_dung1);
        $stmt->bindParam(':dapan_1', $dapan_11);
        $stmt->bindParam(':dapan_2', $dapan_12);
        $stmt->bindParam(':dapan_3', $dapan_13);

        $stmt->execute();
    }
}
function add_question_audio($name_file, $dapan_dung, $dapan_1, $dapan_2, $dapan_3)
{
    global $connect;
    if (!is_null($connect)) {
        $stmt = $connect->prepare("INSERT INTO `question_audio`(`tieu_de`, `dapan_dung`, `dapan1`, `dapan2`, `dapan3`) VALUES (:name_file,:dapan_dung,:dapan_1,:dapan_2,:dapan_3)");

        $name_file1 = $name_file;
        $dapan_dung1 = $dapan_dung;
        $dapan_11 = $dapan_1;
        $dapan_12 = $dapan_2;
        $dapan_13 = $dapan_3;

        $stmt->bindParam(':name_file',  $name_file1);
        $stmt->bindParam(':dapan_dung', $dapan_dung1);
        $stmt->bindParam(':dapan_1', $dapan_11);
        $stmt->bindParam(':dapan_2', $dapan_12);
        $stmt->bindParam(':dapan_3', $dapan_13);

        $stmt->execute();
    }
}
function add_question_write($tieu_de, $dapan_dung)
{
    global $connect;
    if (!is_null($connect)) {
        $stmt = $connect->prepare("INSERT INTO `question_write`(`tieu_de`, `dapan_dung`) VALUES (:tieu_de,:dapan_dung)");
        $tieu_de1 = $tieu_de;
        $dapan_dung1 = $dapan_dung;

        $stmt->bindParam(':tieu_de', $tieu_de1);
        $stmt->bindParam(':dapan_dung', $dapan_dung1);

        $stmt->execute();
    }
}
