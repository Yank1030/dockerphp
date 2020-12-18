var targetTime = 10; // 目標時間
var time = 0;       // 経過時間
var timer = null     // タイマー

var toggle = document.getElementById('toggle');
toggle.addEventListener('click', function (event) {
    // トグルボタンの状態判定
    status = toggle.value;
    if (status === 'start') {
        timerStart();
        toggle.value = 'stop';
        toggle.classList.add('stop');
    } else {
        timerEnd();
        getResult();
        status = 'start';
    }
});

function timerStart() {
    // 経過時間を更新する
    startTime = new Date().getTime();
    timer = setInterval(function () {
        time = (new Date().getTime() - startTime) / 1000;
        document.getElementById('timer').textContent = time.toFixed(3);
    }, 10);
}

function timerEnd() {
    clearInterval(timer);
    timer = null;
}

function getResult() {
    alert(time + ' 秒でした！');
}