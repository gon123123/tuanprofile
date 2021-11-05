<?php
db_connect();
$sql = "SELECT * FROM taikhoan";
$num_acc = getData($sql);
dis_db_connect();
$quantity_account = count($num_acc);     // lay ra so lượng bản ghi 
$number_acc_page = ceil($quantity_account / 11);  // lay ra so trang 

// xu ly pagination
$trang_hien_tai = 1;
if (isset($trang)) {
    $trang_hien_tai = $trang;
}
$index = ($trang_hien_tai - 1) * 11;
db_connect();
$sql = "SELECT * FROM taikhoan limit " . $index . ",11";
$tai_khoan = getData($sql);
dis_db_connect();
?>
<section>
    <div class="content_account table-responsive">
        <table class="content__account-table table table-hover table-bordered">
            <tr>
                <th style="width:50px ;">STT</th>
                <th style="min-width:150px ;">Name</th>
                <th style="min-width:200px ;">Email</th>
                <th>Permission</th>
                <th>Number LogIn</th>
                <th>Number Exam</th>
                <th>Grade</th>
                <th>del</th>
            </tr>
            <?php foreach ($tai_khoan as $key => $tk) : ?>
                <form action="" method="POST">
                    <input type="hidden" name="ten" value="<?php echo $tk['tentk']; ?>">
                    <tr>
                        <td><?php echo ($key + 1); ?></td>
                        <td><?php echo $tk['tentk']; ?></td>
                        <td><?php echo $tk['email']; ?></td>

                        <!-- không được phep xóa tài khoản đang đăng nhập -->
                        <?php
                        if ($tk['Quyen'] == 0) {
                        ?>
                            <?php
                            if ($tk['tentk'] == $name) { // lấy từ SESSION name 
                            ?>
                                <td><input style="padding: 0px 10px;" class="btn btn-sm btn-outline-danger" type="submit" name="submit" value="admin" disabled></td>
                            <?php
                            } else {
                            ?>
                                <td><input style="padding: 0px 10px;" class="btn btn-sm btn-outline-danger" type="submit" name="submit" value="admin"></td>
                            <?php } ?>
                        <?php
                        } else {
                        ?>
                            <td><input style="padding: 0px 15px;" class="btn btn-sm btn-outline-primary" type="submit" name="submit" value="user"></td>
                        <?php
                        }
                        ?>
                        <td><?php echo $tk['so_lan_dn']; ?></td>
                        <td><?php echo $tk['so_lan_lam']; ?></td>
                        <td><?php echo $tk['diem']; ?></td>
                        <?php
                        if ($tk['tentk'] == $name) {        // lấy từ SESSION name
                        ?>
                            <td><input onclick="return confirm('Bạn có chắc muốn xóa không ?');" class="btn btn-sm btn-warning button_submit" type="submit" name="submit" value="Del" disabled></td>
                        <?php
                        } else {
                        ?>
                            <td><input onclick="return confirm('Bạn có chắc muốn xóa không ?');" class="btn btn-sm btn-warning button_submit" type="submit" name="submit" value="Del"></td>
                        <?php } ?>
                    </tr>
                </form>
            <?php endforeach; ?>
        </table>
    </div>
    <ul class="pagination">
        <?php
        for ($i = 1; $i <= $number_acc_page; $i++) : ?>
            <form action="" method="GET">
                <input type="hidden" name="pages" value="<?php echo $i; ?>">
                <input type="hidden" name="submit" value="page">
                <li class="page-item"><input class="page-link" type="submit" value="<?php echo $i; ?>"></li>
            </form>
        <?php endfor; ?>
    </ul>
</section>