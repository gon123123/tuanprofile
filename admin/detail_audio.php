<?php
require_once './admin/layout/header.php';
?>
<div class="container">
    <div class="ADD_question">
        <h3>ADD QUESTIONS</h3>
        <br>
        <form action="" class="was-validated" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="email">ID : <?php echo $data_one_audio[0]['idAudio']; ?> </label>
                <input type="hidden" name="id_question_audio" value="<?php echo $data_one_audio[0]['idAudio']; ?>">
            </div>

            <div class="form-group">
                <label for="email">File Audio :</label> <br>
                <input type="file" name="file_audio">
                <audio class="audio" controls>
                    <source src="http://localhost/dacs2/uploads/<?php echo $data_one_audio[0]['tieu_de']; ?>" type="audio/mpeg">
                </audio>
            </div>
            <span class="error"><?php echo (isset($error)) ? $error : ""; ?></span>
            <div class="form-group">
                <label for="email">Answer True: </label>
                <input type="text" class="form-control" name="dapan_dung" placeholder="answer true" value="<?php echo $data_one_audio[0]['dapan_dung']; ?>" required value="">
            </div>
            <div class="form-group">
                <label for="email">Answer False 1: </label>
                <input type="text" class="form-control" name="dapan_1" placeholder="Answer False 1:" value="<?php echo $data_one_audio[0]['dapan1']; ?>" required value="">
            </div>
            <div class="form-group">
                <label for="email">Answer False 2: </label>
                <input type="text" class="form-control" name="dapan_2" placeholder="Answer False 2:" value="<?php echo $data_one_audio[0]['dapan2']; ?>" required value="">
            </div>
            <div class="form-group">
                <label for="email">Answer False 3: </label>
                <input type="text" class="form-control" name="dapan_3" placeholder="Answer False 3:" value="<?php echo $data_one_audio[0]['dapan3']; ?>" required value="">
            </div>
            <!--  lấy lại tên file_audio cũ -->
            <input type="hidden" name="name_file_current" value="<?php echo $data_one_audio[0]['tieu_de']; ?>">
            <input type="hidden" name="submit" value="update_audio_quest">
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