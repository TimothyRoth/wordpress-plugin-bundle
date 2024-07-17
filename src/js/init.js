'use strict';

/*
* Import Modules
* */

const {initBlogpostQuery, initWPQuery} = require("./ajax/blogpostQuery");
const {initFAQ} = require("./functions/faq");

/*
* Execute App
* */

jQuery(document).ready(function () {
    initBlogpostQuery();
    initFAQ();
})
