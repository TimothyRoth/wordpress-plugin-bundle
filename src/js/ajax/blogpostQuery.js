'use strict';

const {inputLimiter} = require("../lib/inputLimiter");
const initBlogpostQuery = () => {
    const ajaxButton = jQuery('.fab-blogposts-archive .fab-button.show-more-blogposts');
    console.log(ajaxButton)
    if (ajaxButton.length === 0) return;

    let displayedPosts = parseInt(jQuery('.fab-blogposts-archive .fab-blogposts-container').attr('displayed-posts'));
    const posts_to_add = parseInt(ajaxButton.attr('posts-to-add'));
    const posts_order = ajaxButton.attr('post-order');
    const totalPosts = parseInt(jQuery('.fab-blogposts-archive .fab-blogposts-container').attr('total-posts'));
    const excerptLength = parseInt(ajaxButton.attr('excerpt_length'));

    ajaxButton.on('click', function () {
        displayedPosts += posts_to_add;
        console.log(excerptLength)
        const args = {
            posts_per_page: displayedPosts,
            order: posts_order,
            excerpt_length: excerptLength
        };

        fab_blogpost_query(args);

        if (displayedPosts >= totalPosts) {
            jQuery(this).hide();
        }

    });

    const searchBar = jQuery('.fab-blogposts-archive .fab-search-bar input');
    if (searchBar.length === 0) return;
    searchBar.on('keyup', inputLimiter(function () {
        const args = {
            posts_per_page: displayedPosts,
            order: posts_order,
            search_query: jQuery(this).val(),
            excerpt_length: excerptLength
        };

        fab_blogpost_query(args);
    }, 300));
}

const fab_blogpost_query = args => {
    jQuery.ajax({
        url: ajax.url, method: 'POST', dataType: 'json', data: {
            action: 'fab_blogpost_query', args: args
        }, beforeSend: function () {
            // ...
        }, success: function (posts) {
            const container = jQuery('.fab-blogposts-archive .fab-blogposts-container');
            container.html(posts);

        }, complete: function () {
            // ...
        }
    });
}

module.exports = {
    initBlogpostQuery
}

