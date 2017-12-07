/**
 * Created by user on 20.11.2017.
 */
$('.toggle-icon').click(function () {
    $('.nav-container').toggleClass('pushed');
    if ($('*').is('.nav-content-container')) {
        $('.nav-content-container').toggleClass('close');
        $('.nav-content-container').toggleClass('open');
    }
});