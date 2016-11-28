/**
 * 抽奖类构造器
 * @param container HtmlDivElement 容器
 * @param userList Array 用户列表，有name和avatar属性的对象的数组
 * @param className string 每个用户的div的类名
 * @param classNameRunning string 每个用户的div抽奖过程中被选中的类名
 * @param classNameStop string 每个用户的div最终被选中的类名
 * @constructor
 */
function Lucky(container, userList, className, classNameRunning, classNameStop) {
    this.container = container;
    this.wrapper = this.container.parentElement;
    this.className = className;
    this.classNameRunning = classNameRunning;
    this.classNameStop = classNameStop;
    this.userBoxes = [];
    container.innerHTML = '';
    for (var i = 0; i < userList.length; ++i) {
        var user = userList[i];
        var userBox = document.createElement('div');
        this.addClass(userBox, className);
        userBox.innerHTML = '<p>' + user.name + '</p><img src="' + user.avatar + '">';
        this.userBoxes.push(userBox);
        container.appendChild(userBox);
    }
    this.current = 0;
}
Lucky.prototype.removeClass = function (element, className) {
    element.className = element.className.replace(new RegExp(' ?' + className + ' ?'), ' ');
};
Lucky.prototype.addClass = function (element, className) {
    element.className += className + ' ';
};
Lucky.prototype.next = function () {
    this.removeClass(this.userBoxes[this.current], this.classNameRunning);
    this.removeClass(this.userBoxes[this.current], this.classNameStop);
    ++this.current;
    if (this.current >= this.userBoxes.length) {
        this.current = 0;
    }
    var currentBox = this.userBoxes[this.current];
    this.removeClass(currentBox, this.classNameRunning);
    this.addClass(currentBox, this.classNameRunning);
    currentBox.scrollIntoView();
    this.wrapper.scrollTop  = (currentBox.offsetTop - this.container.offsetTop) + currentBox.offsetHeight / 2 - this.wrapper.clientHeight / 2;
};
Lucky.prototype.start = function (interval) {
    interval = interval || 1;
    this.next();
    this.timerId = setInterval(this.next.bind(this), interval);
};
Lucky.prototype.stop = function () {
    clearInterval(this.timerId);
    var currentBox = this.userBoxes[this.current];
    this.removeClass(currentBox, this.classNameRunning);
    this.addClass(currentBox, this.classNameStop);
};
