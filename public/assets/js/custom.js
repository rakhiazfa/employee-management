/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const pageLoader = document.querySelector(".page-loader");

$(document).ready(function () {
    /**
     * Preload
     *
     */

    setTimeout(function () {
        pageLoader.remove();
    }, 500);
});
