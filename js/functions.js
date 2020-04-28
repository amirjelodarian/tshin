$(window).load(function () {
    $("#room_person_count,#room_main_price,#room_off_price").keypress(function (e) {
        var ew = e.which || e.keyCode;
        if (ew == 37 || ew == 39 || ew == 8 || ew == 46 || ew == 9 || ew == 33 || ew == 34 || ew == 35 || ew == 36)
            return true;
        if (ew >= 48 && ew <= 57)
            return true;
        if (e.ctrlKey || e.metaKey || e.altKey)
            return true;
        return false;
    });
    $("#submit_publish,.pic_food_details_submit").hide();
    $(".publish select,#sort_rating,#sort_price").change(function () {
        $("#submit_publish,.btn_map").click();
    });
    $("#published,#unpublished,#higher_rate,#lower_rate,#higher_price,#lower_price,#picture-himself").click(function () {
        $("#submit_publish,.btn_map,.pic_food_details_submit").click();
    });
    if($(".publish select").val() == "published"){
        $(".publish select").css({"background-image":"linear-gradient(to bottom,#161616,green)"});
    }
    if($(".publish select").val() == "unpublished"){
        $(".publish select").css({"background-image":"linear-gradient(to bottom,#161616,red)"});
    }
    $("#published").click(function () {
        $(".publish select").css(
            {"background-image":"-webkit-linear-gradient(to bottom,#161616,green)",
            "background-image":"-moz-linear-gradient(to bottom,#161616,green)",
            "background-image":"-ms-linear-gradient(to bottom,#161616,green)",
            "background-image":"-o-linear-gradient(to bottom,#161616,green)",
            "background-image":"linear-gradient(to bottom,#161616,green)"}
        );
        $("#published").select();
    });
    $("#unpublished").click(function () {
        $(".publish select").css(
            {"background-image":"-webkit-linear-gradient(to bottom,#161616,red)",
            "background-image":"-moz-linear-gradient(to bottom,#161616,red)",
            "background-image":"-ms-linear-gradient(to bottom,#161616,red)",
            "background-image":"-o-linear-gradient(to bottom,#161616,red)",
            "background-image":"linear-gradient(to bottom,#161616,red)"}
        );
        $("#unpublished").select();
    });
    setInterval(function () {
        $(".room_error_message").fadeOut(1000);
    },20000);
    $(".room_error_message").click(function () {
        $(".room_error_message").fadeOut(3000);
    });
    $("#url-image-input").hide();
    $("#select-input-image").change(function () {
        if($(this).val() === 'browse-file'){
            $("#browse-file-input").show();
            $("#url-image-input").hide();
        }
        if($(this).val() === 'url-image'){
            $("#browse-file-input").hide();
            $("#url-image-input").show();
        }
    });
    if($.trim($("#room_error_message_inside").html()).length==0){
        $(".room_error_message").hide();
    }else{
        $(".room_error_message").show();
    }
    $(".delete_room_btn").click(function () {
        return window.confirm("Are You Sure ?");
    });
    $("#status").fadeOut(), $("#preloader").delay(350).fadeOut("slow"), $("body").delay(350).css({overflow: "visible"}), $(window).scroll()
}), $(window).scroll(function () {
    "use strict";
    $(this).scrollTop() > 1 ? $("header").addClass("sticky") : $("header").removeClass("sticky")
}), $("a.open_close").on("click", function () {
    $(".main-menu").toggleClass("show"), $(".layer").toggleClass("layer-is-visible")
}), $("a.show-submenu").on("click", function () {
    $(this).next().toggleClass("show_normal")
}), $("a.show-submenu-mega").on("click", function () {
    $(this).next().toggleClass("show_mega")
}), $(window).width() <= 480 && $("a.open_close").on("click", function () {
    $(".cmn-toggle-switch").removeClass("active")
}), $(window).bind("resize load", function () {
    $(this).width() < 991 ? ($(".collapse#collapseFilters").removeClass("in"), $(".collapse#collapseFilters").addClass("out")) : ($(".collapse#collapseFilters").removeClass("out"), $(".collapse#collapseFilters").addClass("in"))
}), $(".expose").on("click", function (e) {
    "use strict";
    $(this).css("z-index", "2"), $("#overlay").fadeIn(300)
}), $("#overlay").click(function (e) {
    "use strict";
    $("#overlay").fadeOut(300, function () {
        $(".expose").css("z-index", "1")
    })
}), (new WOW).init(), $(function () {
    "use strict";
    $(".video").magnificPopup({type: "iframe"}), $(".parallax-window").parallax({}), $(".magnific-gallery").each(function () {
        $(this).magnificPopup({delegate: "a", type: "image", gallery: {enabled: !0}})
    }), $(".dropdown-menu").on("click", function (e) {
        e.stopPropagation()
    }), $("ul#top_tools li .dropdown").hover(function () {
        $(this).find(".dropdown-menu").stop(!0, !0).delay(50).fadeIn(50)
    }, function () {
        $(this).find(".dropdown-menu").stop(!0, !0).delay(50).fadeOut(50)
    });
    for (var e = document.querySelectorAll(".cmn-toggle-switch"), t = e.length - 1; t >= 0; t--) o(e[t]);

    function o(e) {
        e.addEventListener("click", function (e) {
            e.preventDefault(), !0 === this.classList.contains("active") ? this.classList.remove("active") : this.classList.add("active")
        })
    }
    $(window).scroll(function () {
        0 != $(this).scrollTop() ? $("#toTop").fadeIn() : $("#toTop").fadeOut()
    }), $("#toTop").on("click", function () {
        $("body,html").animate({scrollTop: 0}, 500)
    }), $(".numbers-row").append('<div class="inc button_inc">+</div><div class="dec button_inc">-</div>'), $(".button_inc").on("click", function () {
        var e = $(this), t = e.parent().find("input").val();
        if ("+" == e.text()) var o = parseFloat(t) + 1; else o = t > 1 ? parseFloat(t) - 1 : 0;
        e.parent().find("input").val(o)
    })
}), $("ul#cat_nav li a").on("click", function () {
    $("ul#cat_nav li a.active").removeClass("active"), $(this).addClass("active")
}), $("#map_filter ul li a").on("click", function () {
    $("#map_filter ul li a.active").removeClass("active"), $(this).addClass("active")
}), $(function () {
    "use strict";
    $("#range").ionRangeSlider({
        hide_min_max: !0,
        keyboard: !0,
        min: 0,
        max: 150,
        from: 30,
        to: 100,
        type: "double",
        step: 1,
        prefix: "Rial",
        grid: !0
    })
})/*, window.onload = function () {
    function e(e) {
        return e.stopPropagation ? e.stopPropagation() : window.event && (window.event.cancelBubble = !0), e.preventDefault(), !1
    }

    document.addEventListener("contextmenu", function (e) {
        e.preventDefault()
    }, !1), document.addEventListener("keydown", function (t) {
        t.ctrlKey && t.shiftKey && 73 == t.keyCode && e(t), 83 == t.keyCode && (navigator.platform.match("Mac") ? t.metaKey : t.ctrlKey) && e(t), 123 == event.keyCode && e(t)
    }, !1)
}*/;
function search(){
    $(document).ready(function () {
        var min_length = 1;
        $(".after-search").hide();
        var keyword = $("#keyword").val();
        if (keyword.length != ""){
            $.ajax({
                url: 'users_show.php',
                type: 'POST',
                data: {keyword:keyword},
                success:function (data) {
                    $("#TABLE_ADMINS").hide();
                    $(".after-search").show();
                    $(".after-search").html(data);
                }
            });
        }else{
            $("#TABLE_ADMINS").show();
            $(".after-search").hide();
        }
    });
}


