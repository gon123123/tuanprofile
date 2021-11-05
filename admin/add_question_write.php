<?php
require_once './admin/layout/header.php';
?>
    <div class="container">
        <div class="ADD_question">
            <h3>ADD QUESTIONS WRITING</h3>
            <br>
            <form action="" class="was-validated" method="post">
                <div class="form-group">
                    <label for="email">TITLE :</label>
                    <textarea class="form-control" name="tieude_question" cols="20" rows="5" required></textarea>
                    <span class="error"><?php echo (isset($error)) ? $error : ""; ?></span>
                </div>
                <div class="form-group">
                    <label for="email">Answer True: </label>
                    <input type="text" class="form-control" name="dapan_dung" placeholder="answer true" required value="">
                </div>
                <input type="hidden" name="submit" value="add_write_quest">
                <input class="btn btn_form_update" type="submit" value="Add question">
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