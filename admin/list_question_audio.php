<?php

db_connect();
$sql = "SELECT * FROM question_audio";
$result = getData($sql);
dis_db_connect();
if (!empty($result)) {
    $number_question = count($result);

    $number_page = ceil($number_question / 17);

    $current_page = 1;

    if (isset($pages)) {
        $current_page = $pages;
    }
    $index = ($current_page - 1) * 17;

    db_connect();
    $sql = "SELECT * FROM question_audio LIMIT $index , 17";
    $question = getData($sql);
    dis_db_connect();
}
?>
<?php
require_once './admin/layout/header.php';
?>
<section>
    <div class="list_question">
        <h2>QUESTION LIST AUDIO</h2>
        <br>
        <div class="content_detail table-responsive">
            <table class="content__account-table table table-hover table-bordered">
                <tr>
                    <th style="width: 50px ; ">STT</th>
                    <th>Name File Audio</th>
                    <th>ANSWER TRUE</th>
                    <th style="width: 150px ; ">DETAIL</th>
                    <th style="width: 150px ; ">DEL</th>
                </tr>
                <?php foreach ($question as $key => $value) : ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value['tieu_de']; ?></td>
                        <td><?php echo $value['dapan_dung'] ?></td>
                        <form action="" method="post">
                            <input type="hidden" name="id_detail" value="<?php echo $value['idAudio']; ?>">
                            <input type="hidden" name="submit" value="detail_question_audio">
                            <td><input class="btn btn-sm btn-primary button_submit" type="submit" value="Detail"></td>
                        </form>
                        <form action="" method="post">
                            <input type="hidden" name="id_audio" value="<?php echo $value['idAudio']; ?>">
                            <input type="hidden" name="name_file" value="<?php echo $value['tieu_de']; ?>">
                            <input class="btn btn-sm btn-warning button_submit" type="hidden" name="submit" value="del_question_audio">
                            <td><input class="btn btn-sm btn-warning button_submit" type="submit" value="Del"></td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
</section>
<ul class="pagination">

    <?php for ($i = 1; $i <= $number_page; $i++) : ?>
        <form action="" method="GET">
            <input type="hidden" name="pages" value="<?php echo $i; ?>">
            <input type="hidden" name="submit" value="page_question_audio">
            <li class="page-item"><input class="page-link" type="submit" value="<?php echo $i; ?>"></li>
        </form>
    <?php endfor; ?>
</ul>
<div>
    <?php
    require_once './admin/layout/sidebar.php';
    ?>
    <?php
    require_once "./admin/layout/footer.php";
    ?>
</div>
</body>
<script src="http://localhost/dacs2/public/js/footer.js"></script>
<script src="http://localhost/dacs2/public/js/manager.js" type="text/javascript"></script>
</html>