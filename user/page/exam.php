<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://github.com/gon123123/gon123123/blob/master/LOGO.JPG?raw=true" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Audiowide">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    :root {
        --color_white: #ffff;
        --color_white2: rgb(231, 226, 226);
        --color_white3: rgb(201, 187, 187);
        /* --color_white4: rgb(71, 65, 65); */
        --color_yellow: #ffe800;
        --color_orange: orange;
        --color_gray: rgba(143, 143, 143, 0.432);
        --color_gray2: #6c757d;
        --color_cyan: #61a6ab;
        --color_black2: rgba(17, 17, 17, 0.925);
        --tranparent: rgba(66, 66, 66, 0.7);
        --color_green: rgb(95, 233, 32);
        --color_violet: rgb(156, 10, 156);
        --color_blue: rgb(53, 53, 196);
        --color_blue2: rgb(93, 93, 226);
        --color_red: red;

    }

    .nav_bar_question {
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 2;
    }

    .nav_bar_question a {
        display: block;
        padding: 5px 10px;
        padding-left: 20px;
        text-decoration: none;
        font-size: 25px;
    }

    .link__back {
        position: relative;
        top: 0;
        left: 0;
        width: 200px;
        background-color: var(--color_yellow);
        border-top-right-radius: 1rem;
        border-bottom-right-radius: 1rem;
        z-index: 1;
    }

    .link__back a {
        text-decoration: none;
        color: #fff;
        font-size: 1.3rem;
        width: 200px;
    }

    .link__back i {
        margin-right: 5px;
        padding-right: 0px;
        font-size: 1.2rem;
    }

    .navbar {
        position: absolute;
        top: 0;
        right: 0;
        background-color: var(--color_cyan);
        width: calc(100% - 180px);
        min-height: 40px;
    }

    .navbar {
        display: flex;
        justify-content: flex-end;
    }

    .navbar span {
        height: 1.3rem;
        font-size: 1.2rem;
        font-weight: 500;
        margin-top: -5px;
        font-family: "Audiowide", sans-serif;
        color: var(--color_white);
    }

    .blur {
        position: absolute;
        top: 0px;
        left: 0px;
        display: block;
        min-width: 100%;
        min-height: 100%;
        background-color: var(--color_white);
        z-index: 2;
    }

    .describe {
        animation-name: display;
        animation-duration: 1s;
        animation-timing-function: linear;
        animation-iteration-count: 1;
    }

    .describe {
        /* display: none; */
        position: absolute;
        top: 30%;
        left: 30%;
        bottom: 30%;
        right: 30%;
        filter: brightness(100%);
        filter: blur(0%);
        z-index: 3;
        padding: 50px 30px;
        box-shadow: 0 7.5px 15px rgba(0, 0, 0, .15);
        transition: 0.35s;
    }

    @keyframes display {
        0% {
            transform: scale(0);
        }

        20% {
            transform: scale(0.2);
        }

        40% {
            transform: scale(0.4);
        }

        60% {
            transform: scale(0.6);
        }

        80% {
            transform: scale(0.8);
        }

        100% {
            transform: scale(1);
        }
    }

    .content_title {
        font-size: 2rem;
        text-align: center;
        color: var(--color_yellow);
    }

    .back_manager {
        background-color: orangered;
        padding: 3px 20px;
        color: var(--color_white);
    }

    .btn_exam {
        background-color: var(--color_yellow);
        padding: 3px 20px;
        color: var(--color_white);
    }

    .btn_hover:hover {
        transition: .3s;
        opacity: 0.7;
        color: var(--color_white);
    }

    .button {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        margin-top: 50px;
    }

    .content_box span {
        color: var(--color_orange);
        font-size: 25px;
    }

    .container h3 {
        text-align: center;
        margin-top: 100px;
        font-size: 2.5rem;
        color: var(--color_cyan);
    }

    .question {
        width: 100%;
        height: 100%;
        margin-top: 50px;
        display: flex;
        flex-direction: column;
    }

    .question form {
        display: flex;
        flex-direction: column;
    }

    .question label {
        margin: 10px 0px;
        font-size: 20px;
    }

    .form-check input[type='radio'] {
        margin: 5px;
        margin-bottom: 0px;
        margin-top: 10px;
    }

    .btn_next {
        float: right;
        color: var(--color_white);
        margin: 0px 10px;
        transition: .35s;
    }

    .btn_next:hover {
        opacity: 0.8;
        color: var(--color_white);
    }


    @media screen and (min-width: 768px) and (max-width:1024px) {
        .describe {
            max-height: 550px;
            position: absolute;
            top: 20%;
            left: 20%;
            right: 20%;
            bottom: 25%;
        }
    }

    @media screen and (max-width: 768px) {
        .describe {
            max-height: 450px;
            position: absolute;
            top: 20%;
            left: 20%;
            right: 20%;
        }
    }

    @media screen and (min-width: 414px) and (max-width:736px) {

        /* thông báo  */
        .describe {
            max-height: 500px;
            position: absolute;
            top: 10%;
            left: 10%;
            right: 10%;
            bottom: 10%;
        }

        /* back manager  */
        .link__back a {
            font-size: 1rem;
            width: 150px;
            padding: 0;
            padding-top: 3px;
        }

        .link__back i {
            /* margin-top: px; */
            font-size: 1rem;
        }

        .link__back {
            width: 140px;
            min-height: 30px !important;
        }

        .nav_bar_question a {
            padding-left: 10px;
        }

        /* time  */
        .navbar {
            min-height: 30px !important;
            width: calc(100% - 120px);
        }

        .navbar span {
            font-size: 1rem;
            height: 1rem;
        }

        /* question  */
        .container h3 {
            margin-top: 70px;
            font-size: 2rem;
        }

        .question {
            margin-top: 30px;
        }

        .question label {
            font-size: 0.9rem;
        }
    }


    @media screen and (max-width: 736px) {
        .describe {
            /* max-height: 450px; */
            position: absolute;
            top: 10%;
            left: 10%;
            right: 10%;
            bottom: 5%;
            padding: 20px 30px;
        }
    }

    #disable {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 250%;
        z-index: 10;
        background-color: rgba(0, 0, 0, 0.5);
    }

    #disable_button {
        display: none;
        z-index: 11;
    }
</style>

<body>
    <header>
        <div class="nav_bar_question">
            <div class="link__back">
                <a class="nav-link" href="?submit=BACK_manager"><i class="fas fa-caret-left"></i>Back Manager</a>
            </div>
            <div class="navbar navbar-expand-sm">
                <span id="demo" class="time">00</span><span class="time">:</span><span id="demo2" class="time">00</span>
            </div>
        </div>
    </header>
    <div id="disable"></div>
    <!-- blur -->
    <div class="blur" id="blur">
    </div>
    <div class="describe" id="describe">
        <div class="content_title">
            <p>QUESTION CHOOSE <i class="fas fa-check"></i></p>
        </div>
        <div class="content_box">
            <p><span>&#45;</span> time for this round 10 minutes <i style="color:orange ;" class="far fa-clock"></i></p>
            <p><span>&#45;</span> In this there are 5 questions, choose the correct answer <i style="color:rgb(95, 233, 32);" class="fas fa-check"></i> </p>
            <p><span>&#45;</span> Note that when the time expires, it will automatically lock itself, not allowing any
                more replies</p>
            <div class="button">
                <a class="btn btn-sm back_manager btn_hover" href="?submit=manager">Back</a>
                <button class="btn btn-sm btn_exam btn_hover" onclick="Thoi_Gian();">Exam now</button>
            </div>
        </div>
    </div>
    <div class="container">
        <h3>Fill In The Blanks</h3>
        <div class="question">
            <form action="#">
                <?php for ($i = 0; $i < 2; $i++) : ?>
                    <input type="hidden" name="" value="<?php echo $number_question[$i]['idChoose']; ?>">
                    <label class="title" for="">Question <?php echo $i + 1 . " : " .  $number_question[$i]['tieu_de']; ?></label>
                    <div class="rand">
                        <?php foreach ($dap_an[$i] as $key => $value) : ?>
                            <div class="form-check">
                                <input type="radio" name="<?php echo $i + 1; ?>" value="<?php echo $value; ?>"><label for=""><?php echo $value; ?></label>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endfor; ?>
                <div id="disable_button">
                    <input type="hidden" name="submit" value="phan_choose">
                    <input style="background-color: orange;" class="btn btn-sm btn_next" type="submit" value="Next question" />
                </div>
                <br>
                <br>
            </form>
        </div>
    </div>
</body>
<script>
    function Thoi_Gian(a) {
        document.getElementById('blur').style.display = 'none';
        document.getElementById('describe').style.transform = 'scale(0)';
        var elem = document.getElementById('demo');
        var elem2 = document.getElementById('demo2');
        var t1 = 0;
        var t2 = 0;
        var id = setInterval(frame, 100);

        function frame() {
            if (t1 == 1) {
                document.getElementById('disable').style.display = "block";
                document.getElementById('disable_button').style.display = "block";
                clearInterval(id);
            } else {
                t2++;
                if (t2 < 60) {
                    if (t2 < 10) {
                        elem2.innerHTML = "0" + t2;
                    } else {
                        elem2.innerHTML = t2;
                    }
                } else {
                    t1++;
                    t2 = 0;
                    elem2.innerHTML = "00";
                    elem.innerHTML = "0" + t1;
                }
            }
        }
    }
</script>

</html>