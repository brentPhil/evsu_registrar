
$('.hmbrgr.four').hmbrgr({
    width     : 20,
    barHeight : 2,
    height    : 16,
    barRadius : 2,
    barColor : '#fffffff',
});

$(document).ready(function(){
    $('.hmbrgr').click(function() {
        if($('.tlink').is(":visible")){
            $('.tlink').hide();
            $('.sideNav , .sidebar').removeClass('open');
        } else{
            $('.sideNav , .sidebar').addClass('open');
            $('.tlink').delay(500).fadeIn(500);
        }
    });
});
// $(document).ready(function() {
//     if ($(window).width() >= 600) {
//         $('.sideNav').addClass('open');
//         $('.tlink').fadeIn();
//     }
//     else {
//         $('.sideNav').removeClass('open');
//         $('.tlink').fadeOut();
//     }
// });

// $('.links').click(function() {
//     if($(this).siblings().hasClass('active')){
//         $(this).siblings().removeClass('active');
//         $(this).addClass('active');
//     }
// });