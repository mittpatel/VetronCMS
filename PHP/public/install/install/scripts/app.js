/**
 * Created by LONG JIN WEN on 2017/7/6.
 */
$(function () {

//定位loading
    $(".spinner").css({
        left: $(window).width() / 2 - 75 + "px",
    })
    $(window).resize(function () {
        $(".spinner").css({
            left: $(window).width() / 2 - 75 + "px"
        })
    });
});
