function bat() {
    var element = document.getElementById('sidebar');
    if (document.getElementById('tat').style.visibility.match('visible')) {
        document.getElementById('tat').style.visibility = 'hidden';
        document.getElementById('bat').style.visibility = 'visible';
        element.style.transform = 'translate(0px)';
    }
    console.log(element.innerHTML);
}

function tat() {
    var element = document.getElementById('sidebar');
    if (document.getElementById('bat').style.visibility.match('visible')) {
        document.getElementById('tat').style.visibility = 'visible';
        document.getElementById('bat').style.visibility = 'hidden';
        element.style.transform = 'translate(-230px)';
    }
}

function look1() {
    var element1 = document.getElementById('eye1');
    if (element1.classList.contains('fa-eye-slash')) {
        element1.classList.remove('fa-eye-slash');
        element1.classList.add('fa-eye');
        document.getElementById('look_eye1').type = "text";
    } else {
        element1.classList.remove('fa-eye');
        element1.classList.add('fa-eye-slash');
        document.getElementById('look_eye1').type = "password";
    }
}

function look2() {
    var element1 = document.getElementById('eye2');
    if (element1.classList.contains('fa-eye-slash')) {
        element1.classList.remove('fa-eye-slash');
        element1.classList.add('fa-eye');
        document.getElementById('look_eye2').type = "text";
    } else {
        element1.classList.remove('fa-eye');
        element1.classList.add('fa-eye-slash');
        document.getElementById('look_eye2').type = "password";
    }
}

function look3() {
    var element1 = document.getElementById('eye3');
    if (element1.classList.contains('fa-eye-slash')) {
        element1.classList.remove('fa-eye-slash');
        element1.classList.add('fa-eye');
        document.getElementById('look_eye3').type = "text";
    } else {
        element1.classList.remove('fa-eye');
        element1.classList.add('fa-eye-slash');
        document.getElementById('look_eye3').type = "password";
    }
}