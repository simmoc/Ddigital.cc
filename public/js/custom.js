/*
[Custom Script] Copyright © 2016
Theme Name : digi
Version    : 1.0
Author     : Conquerors Market Team
Author URI : https://conquerorsmarket.com
Support    : conquerorsmarket@gmail.com
*/
/*jslint browser: true*/
/*global $, jQuery, alert*/

/* Document Ready */
$(document).ready(function () {

    "use strict";
    /* Page Pre Loading */
    $(window).load(function () { // makes sure the whole site is loaded
        $('#status').fadeOut(); // will first fade out the loading animation
        $('#preloader').delay(250).fadeOut('slow'); // will fade out the white DIV that covers the website.
    });
    /* end Page Pre Loading */



    /*for the back-to-top-button*/
    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('#back-to-top').fadeIn();
        } else {
            $('#back-to-top').fadeOut();
        }
    });
    // scroll body to 0px on click
    $('#back-to-top').click(function () {
        $('#back-to-top').tooltip('hide');
        $('body,html').animate({
            scrollTop: 0
        }, 800);
        return false;
    });




    /*for modal page popup*/

    $("#side").click(function () {
        $("#myModal").modal();
    });


});


/*for count down timer*/
if ($('#countdowner').length) {
    // set the date we're counting down to
    var target_date = new Date($('#target_date').val()).getTime();

    // variables for time units
    var days, hours, minutes, seconds;

    // get tag element
    var countdown = document.getElementById('countdowner');

    // update the tag with id "countdown" every 1 second
    setInterval(function () {

        // find the amount of "seconds" between now and target
        var current_date = new Date().getTime();
        var seconds_left = (target_date - current_date) / 1000;

        // do some time calculations
        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;

        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);

        // format countdown string + set tag value

        countdown.innerHTML = '<span class="days">' + days + ' </span> <span class="hours">' + hours + ' </span> <span class="minutes">' + minutes + ' </span> <span class="seconds">' + seconds + ' </span>';

    }, 000);
}
