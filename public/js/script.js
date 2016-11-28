(function (window) {
    var lucky = null;
    var isRun = false;
    var document = window.document;
    var btnStart = document.getElementById('btn-start');
    var btnStartText = '';
    window.onresize = function () {
        document.body.style.height = window.innerHeight + 'px';
        document.getElementsByTagName('html')[0].style.fontSize = window.innerHeight + 'px';
    };
    window.onresize();
    window.init = function (userList) {
        lucky = new Lucky(document.getElementById('container'), userList, 'box', 'box-big', 'box-final');
    };
    btnStart.addEventListener('click', function () {
        if (isRun) {
            btnStart.textContent = btnStartText;
            lucky.stop();
        } else {
            btnStartText = btnStart.textContent;
            lucky.start(16);
            btnStart.textContent = '停止';
        }
        isRun = !isRun;
    });
})(window);