/**
 * Created by Hayk on 30/10/2017.
 */

var spinOnPost = function (e) {
    var $fa = $(this).find('i');
    if ($fa !== undefined) {
        $fa.removeClass().addClass('fa fa-fw fa-spinner fa-pulse');
    }
};

var disableControlsOnSubmit = function (e) {
    $('button[data-type="disable-on-submit"]').prop('disabled', true);
    $('button[data-type="spin-on-post"]').prop('disabled', true);
    $('a[data-type="disable-on-submit"]').addClass('disabled');
};

var init = function () {
    $('button[data-type="spin-on-post"]').on('click', spinOnPost);
    $('[data-toggle="tooltip"]').tooltip();
    $('form').on('submit', disableControlsOnSubmit);
};

$(document).ready(init);