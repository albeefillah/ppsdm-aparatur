/*
 Template Name: Neon - Bootstrap + Laravel + PHP Admin Dashboard Template
 Website: http://themesbox.in/admin-templates/neon
 Author: Themesbox17
 File: Main JS File
 */

"use strict";
$(document).ready(function() {       

    /* -----  Menu JS ----- */
    $.sidebarMenu($('.xp-vertical-menu'));      

    $(function() {
        for (var x = window.location, xp = $(".xp-vertical-menu a").filter(function() {
            return this.href == x;
        }).addClass("active").parent().addClass("active"); ;) {
            if (!xp.is("li")) break;
            xp = xp.parent().addClass("in").parent().addClass("active");
        }
    }), 

    /* -----  Menu Hamburger ----- */
    $(".xp-menu-hamburger").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("xp-toggle-menu");

        // Memeriksa apakah class xp-toggle-menu aktif atau tidak
        var isMenuActive = $("body").hasClass("xp-toggle-menu");

        // Menetapkan properti CSS display: none atau block pada elemen dengan kelas xp-logo
        $(".logo-center").css("display", isMenuActive ? "block" : "none");
    });   

    /* -----  Bootstrap Popover ----- */
    $('[data-toggle="popover"]').popover();

    /* -----  Bootstrap Tooltip ----- */
    $('[data-toggle="tooltip"]').tooltip();

});