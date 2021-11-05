<?php
require_once './admin/layout/header.php';
?>
<div class="container">
    <div class="ADD_question">
        <h3>QUESTIONS DETAILS</h3>
        <br>
        <form action="" method="post">
            <!-- id_question_choose -->
            <input type="hidden" name="id_question_choose" value=" <?php echo $data_one_choose[0]['idChoose']; ?>">
            <label for="">ID : <?php echo $data_one_choose[0]['idChoose']; ?></label>
            <div class="form-group">
                <label for="email">TITLE :</label>
                <textarea class="form-control" name="tieude_question" cols="20" rows="5"><?php echo $data_one_choose[0]['tieu_de']; ?></textarea>
            </div>
            <span class="error"><?php echo (isset($error)) ? $error : ""; ?></span> <br>
            <div class="form-group">
                <label for="email">Answer True: </label>
                <input type="text" class="form-control" name="dapan_dung" placeholder="answer true" value="<?php echo $data_one_choose[0]['dapan_dung']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Answer False 1: </label>
                <input type="text" class="form-control" name="dapan_1" placeholder="Answer False 1:" value="<?php echo $data_one_choose[0]['dapan1']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Answer False 2: </label>
                <input type="text" class="form-control" name="dapan_2" placeholder="Answer False 2:" value="<?php echo $data_one_choose[0]['dapan2']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Answer False 3: </label>
                <input type="text" class="form-control" name="dapan_3" placeholder="Answer False 3:" value="<?php echo $data_one_choose[0]['dapan3']; ?>" required>
            </div>
            <input type="hidden" name="submit" value="update_question_choose">
            <input class="btn btn_form_update" type="submit" value="Update">
        </form>
    </div>
</div>
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