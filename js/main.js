/**
 * Created by ChengYa on 2016/6/18.
 */

//判断手机类型
window.onload = function () {
    //alert($(window).height());
    var u = navigator.userAgent;
    if (u.indexOf('Android') > -1 || u.indexOf('Linux') > -1) {//安卓手机
    } else if (u.indexOf('iPhone') > -1) {//苹果手机
        //屏蔽ios下上下弹性
        $(window).on('scroll.elasticity', function (e) {
            e.preventDefault();
        }).on('touchmove.elasticity', function (e) {
            e.preventDefault();
        });
    } else if (u.indexOf('Windows Phone') > -1) {//winphone手机
    }
    //预加载
    loading();
}

var date_start;
var date_end;
date_start = getNowFormatDate();
//加载图片
var loading_img_url = [
    "wp-content/themes/phoneMagazine/image/0001.jpg",
    "wp-content/themes/phoneMagazine/image/0002.jpg",
    "wp-content/themes/phoneMagazine/image/0003.jpg",
    "wp-content/themes/phoneMagazine/image/0004.jpg",
    "wp-content/themes/phoneMagazine/image/0005.jpg",
    "wp-content/themes/phoneMagazine/image/0006.jpg",
    "wp-content/themes/phoneMagazine/image/0007.jpg",
    "wp-content/themes/phoneMagazine/image/0008.jpg",
    "wp-content/themes/phoneMagazine/image/0009.jpg",
    "wp-content/themes/phoneMagazine/image/0010.jpg",
    "wp-content/themes/phoneMagazine/image/0011.jpg",
    "wp-content/themes/phoneMagazine/image/0012.jpg",
    "wp-content/themes/phoneMagazine/image/0013.jpg",
    "wp-content/themes/phoneMagazine/image/0014.jpg",
    "wp-content/themes/phoneMagazine/image/0015.jpg",
    "wp-content/themes/phoneMagazine/image/0016.jpg",
    "wp-content/themes/phoneMagazine/image/0017.jpg",
    "wp-content/themes/phoneMagazine/image/0018.jpg",
    "wp-content/themes/phoneMagazine/image/0019.jpg",
    "wp-content/themes/phoneMagazine/image/0020.jpg",
    "wp-content/themes/phoneMagazine/image/0021.jpg",
    "wp-content/themes/phoneMagazine/image/0022.jpg",
    "wp-content/themes/phoneMagazine/image/0023.jpg",
    "wp-content/themes/phoneMagazine/image/0024.jpg",
    "wp-content/themes/phoneMagazine/image/0025.jpg",
    "wp-content/themes/phoneMagazine/image/0026.jpg",
    "wp-content/themes/phoneMagazine/image/0027.jpg",
    "wp-content/themes/phoneMagazine/image/0028.jpg",
    "wp-content/themes/phoneMagazine/image/0029.jpg",
    "wp-content/themes/phoneMagazine/image/0030.jpg",
    "wp-content/themes/phoneMagazine/image/0031.jpg",
    "wp-content/themes/phoneMagazine/image/0032.jpg",
    "wp-content/themes/phoneMagazine/image/0033.jpg",
    "wp-content/themes/phoneMagazine/image/0034.jpg",
    "wp-content/themes/phoneMagazine/image/0035.jpg",
    "wp-content/themes/phoneMagazine/image/0036.jpg",
    "wp-content/themes/phoneMagazine/image/0037.jpg",
    "wp-content/themes/phoneMagazine/image/0038.jpg",
    "wp-content/themes/phoneMagazine/image/0039.jpg",
    "wp-content/themes/phoneMagazine/image/0040.jpg",
    "wp-content/themes/phoneMagazine/image/0041.jpg",
];

//加载页面
function loading() {
    var numbers = 0;
    var length = loading_img_url.length;

    for (var i = 0; i < length; i++) {
        var img = new Image();
        img.src = loading_img_url[i];
        img.onerror = function () {
            numbers += (1 / length) * 100;
        }
        img.onload = function () {
            numbers += (1 / length) * 100;
            $('.number').html(parseInt(numbers) + "%");
            console.log(numbers);
            if (Math.round(numbers) == 100) {
                //$('.number').hide();
                date_end = getNowFormatDate();
                var loading_time = date_end - date_start;
                //预加载图片
                $(function progressbar() {
                    //拼接图片
                    $('.shade').hide();
                    var tagHtml = "";
                    for (var i = 1; i <= 41; i++) {
                        if (i == 1) {
                            tagHtml += ' <div id="first" style="background:url(image/00' + (i < 10 ? '0' + i : i) + '.jpg) center top no-repeat;background-size:100%"></div>';
                        } else if (i == 41) {
                            tagHtml += ' <div id="end" style="background:url(image/00' + (i < 10 ? '0' + i : i) + '.jpg) center top no-repeat;background-size:100%"></div>';
                        } else {
                            tagHtml += ' <div style="background:url(image/00' + (i < 10 ? '0' + i : i) + '.jpg) center top no-repeat;background-size:100%"></div>';
                        }
                    }
                    $(".flipbook").append(tagHtml);
                    var w = $(".graph").width();
                    $(".flipbook-viewport").show();
                });
                //配置turn.js
                function loadApp() {
                    var w = $(window).width();
                    var h = $(window).height();
                    $('.flipboox').width(w).height(h);
                    $(window).resize(function () {
                        w = $(window).width();
                        h = $(window).height();
                        $('.flipboox').width(w).height(h);
                    });
                    $('.flipbook').turn({
                        // Width
                        width: w,
                        // Height
                        height: h,
                        // Elevation
                        elevation: 50,
                        display: 'single',
                        // Enable gradients
                        gradients: true,
                        // Auto center this flipbook
                        autoCenter: true,
                        when: {
                            turning: function (e, page, view) {
                                if (page == 1) {
                                    $(".btnImg").css("display", "none");
                                    $(".mark").css("display", "block");
                                } else {
                                    $(".btnImg").css("display", "block");
                                    $(".mark").css("display", "none");
                                }
                                if (page == 41) {
                                    $(".nextPage").css("display", "none");
                                } else {
                                    $(".nextPage").css("display", "block");
                                }
                            },
                            turned: function (e, page, view) {
                                console.log(page);
                                var total = $(".flipbook").turn("pages");//总页数
                                if (page == 1) {
                                    $(".return").css("display", "none");
                                    $(".btnImg").css("display", "none");
                                } else {
                                    $(".return").css("display", "block");
                                    $(".btnImg").css("display", "block");
                                }
                                if (page == 2) {
                                    $(".catalog").css("display", "block");
                                } else {
                                    $(".catalog").css("display", "none");
                                }
                            }
                        }
                    })
                }
                yepnope({
                    test: Modernizr.csstransforms,
                    yep: ['js/turn.js'],
                    complete: loadApp
                });
            }
            ;
        }
    }
}

function getNowFormatDate() {
    var date = new Date();
    var seperator1 = "";
    var seperator2 = "";
    var month = date.getMonth() + 1;
    var strDate = date.getDate();
    if (month >= 1 && month <= 9) {
        month = "0" + month;
    }
    if (strDate >= 0 && strDate <= 9) {
        strDate = "0" + strDate;
    }
    var currentdate = date.getFullYear() + seperator1 + month + seperator1 + strDate
        + "" + date.getHours() + seperator2 + date.getMinutes()
        + seperator2 + date.getSeconds();
    return currentdate;
}
