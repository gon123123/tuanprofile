<?php
require_once './admin/layout/header.php';
?>
<div class="container">
    <div class="ADD_question">
        <h3>QUESTIONS DETAILS WRITE</h3>
        <br>
        <form action="" method="post">
            <!-- id_question_write -->
            <input type="hidden" name="id_question_write" value=" <?php echo $data_one_write[0]['idWrite']; ?>">
            <label for="">ID : <?php echo $data_one_write[0]['idWrite']; ?></label>
            <div class="form-group">
                <label for="">TITLE :</label>
                <textarea class="form-control" name="tieude_question" cols="20" rows="5"><?php echo $data_one_write[0]['tieu_de']; ?></textarea>
            </div>
            <span class="error"><?php echo (isset($error)) ? $error : ""; ?></span>
            <div class="form-group">
                <label for="">Answer True: </label>
                <input type="text" class="form-control" name="dapan_dung" placeholder="answer true" value="<?php echo $data_one_write[0]['dapan_dung']; ?>" required>
            </div>

            <input type="hidden" name="submit" value="update_question_write">
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