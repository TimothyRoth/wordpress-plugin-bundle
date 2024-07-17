'use strict';

const renderWPQuery = (posts) => {
    let html = [];
    const postsContainer = jQuery('.base-plugin-wrapper .posts-container');

    posts.forEach(post => {
        console.log(post);
        html += `<p>${post.post_title}</p>`;
    });

    postsContainer.html(html);
}

module.exports = {
    renderWPQuery
}