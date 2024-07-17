'use strict';

const initFAQ = () => {
    // ...
    const trigger = jQuery('.fab-faq-container .faq-title');
    const container = jQuery('.fab-faq-container .single-faq');

    trigger.on('click', function () {
        const singleFAQ = jQuery(this).parent('.single-faq');
        container.not(singleFAQ).removeClass('active');
        singleFAQ.toggleClass('active');
    })
};

module.exports = {
    initFAQ
}