$(document).ready(function() {
    $('.js-like-article').on('click', function(e) {
        e.preventDefault();

        var $link = $(e.currentTarget);
        $link.toggleClass('far fa-heart').toggleClass('fas fa-heart');

        $('.js-like-article-count').html('TEST');

    });
});
