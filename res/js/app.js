/* 
 * The MIT License
 *
 * Copyright 2015 mmk2410.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

var main = function () {

    var fabActive = false;
    $('.fabmenu').click(function () {
        if (!(fabActive)) {
            fabFadeIn();
            fabActive = true;
        } else {
            fabFadeOut();
            fabActive = false;
        }
    });

    var navOpen = false;
    $('.nav-img, .overlay').click(function () {
        if (!(navOpen)) {
            openNav();
            navOpen = true;
        } else {
            closeNav();
            navOpen = false;
        }
    });


};

$(document).ready(main);

function goBack() {
    history.go(-1);
}

function fabFadeIn() {
    $('.subfab').fadeIn(125);
    $('.fab-img').fadeOut(60, function callback() {
        $('.fab-img').attr("src", "./res/img/close.svg");
    });
    $('.fab-img').fadeIn(60);
}

function fabFadeOut() {
    $('.subfab').fadeOut(125);
    $('.fab-img').fadeOut(60, function callback() {
        $('.fab-img').attr("src", "./res/img/share.svg");
    });
    $('.fab-img').fadeIn(60);
}

function openNav() {
    $('.nav').animate({"left": "0px"}, 125);
    $('.overlay').show();
    $('.overlay').animate({"opacity": "0.4"}, 125);
}

function closeNav() {
    $('.nav').animate({"left": "-300px"}, 125);
    $('.overlay').animate({"opacity": "0.0"}, 125, function () {
        $('.overlay').hide();
    });
}