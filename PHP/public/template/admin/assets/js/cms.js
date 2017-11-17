function goTop() {
    $('html,body').animate({'scrollTop': 0}, 600);
}
if ($(document).scrollTop() > 1000) {
    $(".goTop").show();
}
$(window).bind("scroll", function () {
    if ($(document).scrollTop() > 1000) {
        $(".goTop").show();
    } else {
        $(".goTop").hide();
    }
});
function checkLangKeyOnly(key, m,e) {
    $.ajax({
        type: 'GET',
        url: site_root + "/admin/setting/setting/check/onlykey",
        data: {
            key: key,
            m: m
        },
        success: function (data) {

            if($(e).attr('val')==$(e).val()) return;
            data=$.parseJSON(data);
            if(data.status==2){
                $(e).css({
                    'border':'red 1px solid'
                });
                $(e).prev().text(data.msg);
            }else{
                $(e).css({
                    'border':'#ddd 2px solid'
                });
                $(e).prev().text(' ');
            }
        },
        error: function () {
        }
    });
}