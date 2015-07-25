/*
 * Rangitaki Project
 *
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

var main = function () { // main function; called below

    var fabActive = false; // fab hidden at begin
    $('.fabmenu').click( // action on fab click
        function () {
            if (!(fabActive)) { // if fab is hidden
                fabFadeIn(); // fade fab in
                fabActive = true; // fab = active
            } else { // if fab is shown
                fabFadeOut(); // fade fab out
                fabActive = false; // fab = hidden
            }
        }
    );

    var navOpen = false; // nav hidden at begin
    $('.nav-img, .overlay').click( // action on hamburger click
        function () {
            if (!(navOpen)) { // if nav is hidden
                openNav(); // open the nav drawer
                navOpen = true; // nav = open
            } else { // if nav is closed
                closeNav(); // close the nav drawer
                navOpen = false; // nav = closed
            }
        }
    );


};

$(document).ready(main); // run if document is loaded

function goBack() { // go back function
    history.go(-1);
}

function fabFadeIn() { // fade fab in
    $('.subfab').fadeIn(125); // fade subfabs in
    $('.fab-img').fadeOut( // fade fab share image out
        60, function callback() {
        $('.fab-img').attr("src", "./res/img/close.svg"); // change to fab close image
        }
    );
    $('.fab-img').fadeIn(60); // fade fab close image in
}

function fabFadeOut() { // fade fab out
    $('.subfab').fadeOut(125); // fade subfabs out
    $('.fab-img').fadeOut( // fade fab close image out
        60, function callback() {
        $('.fab-img').attr("src", "./res/img/share.svg"); // change to fab share image
        }
    );
    $('.fab-img').fadeIn(60); // fade fab share image in
}

function openNav() { // fade navigation drawer in
    $('.nav').animate({"left": "0px"}, 125); // slide in
    $('.overlay').show(); // set overlay to show ...
    $('.overlay').animate({"opacity": "0.4"}, 125); // ... and fade to a darker transparent color
}

function closeNav() { // fade navigation drawer out
    $('.nav').animate({"left": "-300px"}, 125); // slide out
    $('.overlay').animate(
        {"opacity": "0.0"}, 125, function () { // fade the overlay to complete transparency
            $('.overlay').hide(); // hide it then
        }
    );
}
