let voprosi = [];

document.addEventListener('DOMContentLoaded', function () {
    // Добавление блоков с вопросами
    let parent1 = document.getElementById('questions');
    let parent2 = document.getElementById('btn-group me-2');
    let elem1 = parent2.querySelector('#kn_1');
    let elem = parent1.querySelector('#vopros1');
    for (let i = 2; i < n + 1; i++) {
        let clone = elem.cloneNode(true);
        clone.style.display = "none";
        clone.setAttribute("id", "vopros" + i);
        clone.children[0].innerHTML = 'Вопрос ' + i;
        clone.querySelector('#v_1').setAttribute("id", "v_" + i);
        clone.querySelector('#z_1').setAttribute("id", "z_" + i);
        if (id == 3){
            clone.querySelector('#f_1').setAttribute("id", "f_" + i);
        }
        parent1.appendChild(clone);
    }
    for(let i = 2; i < n + 1; i++){
        let clone1 = elem1.cloneNode(true);
        clone1.setAttribute("onclick", "vopr("+i+");");
        clone1.setAttribute("id", "kn_" + i);
        clone1.innerHTML = i;
        parent2.appendChild(clone1);
    }
    // Вставляем сами вопросы или изображения
    for (let i = 0; i < n; i++) {
        if (vop[i][1] == "1" ) {
            img = vop[i][0];
            vop[i][0] = "<img src=" + img + " class='rounded mx-auto d-block' style='max-height: 100%;max-width: 100%;'><br>"; 
        }
        if (id == 1) {
            voprosi.push([vop[i][0], vop[i][1]]);
        }else if(id == 3 && vop[i][2] != ''){
            document.getElementById('f_' + (i + 1)).setAttribute("href", vop[i][2]);
            document.getElementById('f_' + (i + 1)).style.display = "block";
            voprosi.push([vop[i][0]]);
        }
        else{
            voprosi.push([vop[i][0]]);
        }
        document.getElementById('v_' + (i + 1)).innerHTML = voprosi[i][0];
    }
});

let iter = 1;

function vopr(nom) {
    document.getElementById('vopros' + iter).style.display = "none";
    iter = nom;
    document.getElementById('vopros' + iter).style.display = "block";
}

function proverit() {
    let otv = [];
    for(let i = 0; i < n; i++){
        otv.push(document.getElementById('z_'+(i+1)).value);
    }
    $.post("records.php", { otv: otv, id: id});
    window.location.href = "../profile.php";
}

function proverit2() {
    let otv = [];
    let ball = 0;
    document.getElementById('vopros' + iter).style.display = "none";
    document.getElementById('kn_pr').style.display = "none";
    document.getElementById('btn-toolbar').style.display = "none";
    document.getElementById('again').style.display = "block";
    document.getElementById('out').style.display = "block";
    otveti = "<table class='table'><tr class='table-active'><td>№</td><td>Вопрос</td><td>Ответ</td></tr>";

    for (let i = 0; i < n; i++) {
        otv[i] = document.getElementById('z_' + (i + 1)).value;
        if (otv[i] == voprosi[i][1]) {
            ball += 1;
            otveti += "<tr class='table-success'><td>" + (i + 1) + "</td><td>" + voprosi[i][0] + "</td><td>Вы ответили верно. Ваш ответ: " + otv[i] + "</td></tr>";
        } else {
            otveti += "<tr class='table-danger'><td>" + (i + 1) + "</td><td>" + voprosi[i][0] + "</td><td>Вы ответили не верно. Ваш ответ: " + otv[i] + "</td></tr>";
        }
    }
    
    procent_vip = ball / n * 100;
    procent_vip = procent_vip.toFixed();
    document.getElementById('rezultat').innerHTML = "<p style='font-weight:bold;'>Тест. Тема - '<span id='tema2'></span>'.</p><span id='ot'>Задания выполнены верно на " + procent_vip + "%.</span><br><div class='progress'><div class='progress-bar' role='progressbar' style='width: " + procent_vip + "%' aria-valuenow='" + procent_vip + "' aria-valuemin='0' aria-valuemax='100'></div></div><br>" + otveti;
    document.getElementById('tema2').innerHTML = test;
}
function proverit3(){
    let otv = [];
    for (let i = 0; i < n; i++) {
        otv.push(document.getElementById('z_' + (i + 1)).value);
    }
    $.post("records.php", { otv: otv, id: id});
    let files = e.originalEvent.dataTransfer.files;
    sendFiles(files);
    function sendFiles(files) {
        let Data = new FormData();
        $(files).each(function (index, file) {
            Data.append('z[]', file);
        });
        $.ajax({
            url: dropZone.attr('action'),
            type: dropZone.attr('method'),
            data: Data,
            contentType: false,
            processData: false,
            success: function (data) {
                alert('Файлы были успешно загружены');
            }
        });
    };
    window.location.href = "../profile.php";
}
document.addEventListener('DOMContentLoaded', function () {
    if (id != 1) {
        var deadline = 10800000;
    setTimeout(proverit, deadline);
    // конечная дата
    
    // id таймера
    let timerId = null;
    // склонение числительных
    function declensionNum(num, words) {
        return words[(num % 100 > 4 && num % 100 < 20) ? 2 : [2, 0, 1, 1, 1, 2][(num % 10 < 5) ? num % 10 : 5]];
    }
    // вычисляем разницу дат и устанавливаем оставшееся времени в качестве содержимого элементов
    function countdownTimer() {
        const diff = deadline;
        if (diff <= 0) {
            clearInterval(timerId);
        }
        //const days = diff > 0 ? Math.floor(diff / 1000 / 60 / 60 / 24) : 0;
        const hours = diff > 0 ? Math.floor(diff / 1000 / 60 / 60) % 24 : 0;
        const minutes = diff > 0 ? Math.floor(diff / 1000 / 60) % 60 : 0;
        const seconds = diff > 0 ? Math.floor(diff / 1000) % 60 : 0;
        //$days.textContent = days < 10 ? '0' + days : days;
        $hours.textContent = hours < 10 ? '0' + hours : hours;
        $minutes.textContent = minutes < 10 ? '0' + minutes : minutes;
        $seconds.textContent = seconds < 10 ? '0' + seconds : seconds;
        //$days.dataset.title = declensionNum(days, ['день', 'дня', 'дней']);
        $hours.dataset.title = declensionNum(hours, ['час', 'часа', 'часов']);
        $minutes.dataset.title = declensionNum(minutes, ['минута', 'минуты', 'минут']);
        $seconds.dataset.title = declensionNum(seconds, ['секунда', 'секунды', 'секунд']);
        deadline = deadline - 1000;
    }
    // получаем элементы, содержащие компоненты даты
    //const $days = document.querySelector('.timer__days');
    const $hours = document.querySelector('.timer__hours');
    const $minutes = document.querySelector('.timer__minutes');
    const $seconds = document.querySelector('.timer__seconds');
    // вызываем функцию countdownTimer
    countdownTimer();
    // вызываем функцию countdownTimer каждую секунду

    timerId = setInterval(countdownTimer, 1000);}
});

document.getElementById("kn_pr").addEventListener("click", function () {
    let flag = 0;
    for (let x = 1; x < n + 1; x++) {
        if (document.getElementById("z_" + x).value == '') {
            flag = 1;
        }
    }
    if (flag == 1) {
        document.getElementById("modal_p").innerHTML = 'Вы ответили не на все вопросы!<br>Вы уверены, что хотите завершить тестирование?';
    } else {
        document.getElementById("modal_p").innerHTML = 'Вы уверены, что хотите завершить тестирование?';
    }
});

