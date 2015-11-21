window.onload = function () {
    var t = document.getElementsByTagName('textarea')[0];
    var offset = !window.opera ? (t.offsetHeight - t.clientHeight) : (t.offsetHeight + parseInt(window.getComputedStyle(t, null).getPropertyValue('border-top-width')));

    /**
     * The following three code clocks are for proper resizing of the input textarea
     */
    var resize = function (t) {
        t.style.height = 'auto';
        t.style.height = (t.scrollHeight + offset ) + 'px';
    }

    t.addEventListener && t.addEventListener('input', function (event) {
        resize(t);
    });

    t['attachEvent'] && t.attachEvent('onkeyup', function () {
        resize(t);
    });
}