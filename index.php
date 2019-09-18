<?php get_header(); ?>

<div class="shade">
    <div class="sk-fading-circle">
        <div class="sk-circle1 sk-circle"></div>
        <div class="sk-circle2 sk-circle"></div>
        <div class="sk-circle3 sk-circle"></div>
        <div class="sk-circle4 sk-circle"></div>
        <div class="sk-circle5 sk-circle"></div>
        <div class="sk-circle6 sk-circle"></div>
        <div class="sk-circle7 sk-circle"></div>
        <div class="sk-circle8 sk-circle"></div>
        <div class="sk-circle9 sk-circle"></div>
        <div class="sk-circle10 sk-circle"></div>
        <div class="sk-circle11 sk-circle"></div>
        <div class="sk-circle12 sk-circle"></div>
    </div>
    <div class="number"></div>
</div>
<div class="mainTitle" style="text-align:center;">
  <!--<div id="header_title" style="font-size:7vw; text-align: center;"> 星星生活周刊 </div>-->
  <img src="<?php echo get_bloginfo('stylesheet_directory').'/image/title.png';?>" style="width:100%;" alt="星星生活周刊首页">
</div>

<div class = "magazine_select_zone" style="width:100%; text-align:center;"  >

          <?php
              $current_issue=get_newest_id();       
           
              if ( isset( $_POST['magazine_select_submit'] ) ) {

              // Check the nonce
                check_admin_referer( 'magazine_id_select' );
                $current_issue = $_POST['magazine_select'];

              }
              echo ' 正在查看第 ' . $current_issue .'期';
              
              $magazine_fold=get_magazine_fold($current_issue);
          ?>

				<form action="" method="post" id="magazine_select_form" name="magazine_select_form" class = "magazine_select_form fr" role="complementary">
    				<select name = "magazine_select" id = "magazine_select" class = "magazine_select fl">
    				<?php for($j = $current_issue ;$j > 0 ;$j--){?>
    					<?php if ($current_issue == $j){?>
    						<option value = "<?php echo $j;?>" selected="selected"><?php echo $j;?></option>
    					<?php }else{?>
    						<option value = "<?php echo $j;?>"><?php echo $j;?></option>
    					<?php }?>
    					<?php }?>
    				</select>
    				<?php wp_nonce_field( 'magazine_id_select' ); ?>
    				<input type = "submit" name = "magazine_select_submit" id="magazine_select_submit" value = "往期回顾" class ="button fr"/>
				</form>
</div>


<div class="flipbook-viewport" style="display:none;">
    <div class="previousPage"></div>
    <div class="nextPage"></div>
    <div class="return"></div>
    <img class="btnImg" src="<?php echo get_bloginfo('stylesheet_directory').'/image/btn.gif';?>" style="display: none"/>
    <div class="container">
        <div class="flipbook">
        </div>
    </div>
</div>

<script>

jQuery(document ).ready(function ($){

  //自定义仿iphone弹出层
  (function ($) {
      //ios confirm box
      jQuery.fn.confirm = function (title, option, okCall, cancelCall) {
          var defaults = {
              title: null, //what text
              cancelText: '取消', //the cancel btn text
              okText: '确定' //the ok btn text
          };

          if (undefined === option) {
              option = {};
          }
          if ('function' != typeof okCall) {
              okCall = $.noop;
          }
          if ('function' != typeof cancelCall) {
              cancelCall = $.noop;
          }

          var o = $.extend(defaults, option, {title: title, okCall: okCall, cancelCall: cancelCall});

          var $dom = $(this);

          var dom = $('<div class="g-plugin-confirm">');
          var dom1 = $('<div>').appendTo(dom);
          var dom_content = $('<div>').html(o.title).appendTo(dom1);
          var dom_btn = $('<div>').appendTo(dom1);
          var btn_cancel = $('<a href="#"></a>').html(o.cancelText).appendTo(dom_btn);
          var btn_ok = $('<a href="#"></a>').html(o.okText).appendTo(dom_btn);
          btn_cancel.on('click', function (e) {
              o.cancelCall();
              dom.remove();
              e.preventDefault();
          });
          btn_ok.on('click', function (e) {
              o.okCall();
              dom.remove();
              e.preventDefault();
          });

          dom.appendTo($('body'));
          return $dom;
      };
  })(jQuery);

  //上一页
  $(".previousPage").bind("touchend", function () {
      var pageCount = $(".flipbook").turn("pages");//总页数
      var currentPage = $(".flipbook").turn("page");//当前页
      if (currentPage >= 2) {
          $(".flipbook").turn('page', currentPage - 1);
      } else {
      }
  });
  // 下一页
  $(".nextPage").bind("touchend", function () {
      var pageCount = $(".flipbook").turn("pages");//总页数
      var currentPage = $(".flipbook").turn("page");//当前页
      if (currentPage <= pageCount) {
          $(".flipbook").turn('page', currentPage + 1);
      } else {
      }
  });
  //返回到目录页
  $(".return").bind("touchend", function () {
      $(document).confirm('您确定要返回首页吗?', {}, function () {
          $(".flipbook").turn('page', 1); //跳转页数
      }, function () {
      });
  });
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

var numberOfPages = 48;

var folder= <?php echo '"' .  $magazine_fold. '"';?>;
//加载图片
var loading_img_url = [
    folder+"/01.jpg",
    folder+"/02.jpg",
    folder+"/03.jpg",
    folder+"/04.jpg",
    folder+"/05.jpg",
    folder+"/06.jpg",
    folder+"/07.jpg",
    folder+"/08.jpg",
    folder+"/09.jpg",
    folder+"/10.jpg",
    folder+"/11.jpg",
    folder+"/12.jpg",
    folder+"/13.jpg",
    folder+"/14.jpg",
    folder+"/15.jpg",
    folder+"/16.jpg",
    folder+"/17.jpg",
    folder+"/18.jpg",
    folder+"/19.jpg",
    folder+"/20.jpg",
    folder+"/21.jpg",
    folder+"/22.jpg",
    folder+"/23.jpg",
    folder+"/24.jpg",
    folder+"/25.jpg",
    folder+"/26.jpg",
    folder+"/27.jpg",
    folder+"/28.jpg",
    folder+"/29.jpg",
    folder+"/30.jpg",
    folder+"/31.jpg",
    folder+"/32.jpg",
    folder+"/33.jpg",
    folder+"/34.jpg",
    folder+"/35.jpg",
    folder+"/36.jpg",
    folder+"/37.jpg",
    folder+"/38.jpg",
    folder+"/39.jpg",
    folder+"/40.jpg",
    folder+"/41.jpg",
    folder+"/42.jpg",
    folder+"/43.jpg",
    folder+"/44.jpg",
    folder+"/45.jpg",
    folder+"/46.jpg",
    folder+"/47.jpg",
    folder+"/48.jpg",
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
                    for (var i = 1; i <= 48; i++) {
                        if (i == 1) {
                            tagHtml += ' <div id="first" style="background:url('+folder+'/' + (i < 10 ? '0' + i : i) + '.jpg) center top no-repeat;background-size:100%"></div>';
                        } else if (i == 48) {
                            tagHtml += ' <div id="end" style="background:url('+folder+'/' + (i < 10 ? '0' + i : i) + '.jpg) center top no-repeat;background-size:100%"></div>';
                        } else {
                            tagHtml += ' <div style="background:url('+folder+'/' + (i < 10 ? '0' + i : i) + '.jpg) center top no-repeat;background-size:100%"></div>';
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
                                if (page == 48) {
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
                    yep: ["<?php echo get_bloginfo('stylesheet_directory').'/js/turn.js';?>"],
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



})

</script>


<?php get_footer(); ?>
