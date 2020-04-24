!function (t) {
    var n = 0;
    t.fn.mobileMenu = function (e) {
        var o = {switchWidth: 767, topOptionText: "Filter by category", indentString: "&nbsp;&nbsp;&nbsp;"};

        function l() {
            return t(window).width() < o.switchWidth
        }

        function r(i) {
            return i.attr("id") ? t("#mobileMenu_" + i.attr("id")).length > 0 : (n++, i.attr("id", "mm" + n), t("#mobileMenu_mm" + n).length > 0)
        }

        function a(n) {
            n.css("display", "none"), t("#mobileMenu_" + n.attr("id")).show()
        }

        function u(n) {
            if (function (t) {
                return t.is("ul, ol")
            }(n)) {
                var e = '<div class="styled-select-cat"><select id="mobileMenu_' + n.attr("id") + '" class="mobileMenu">';
                e += '<option value="">' + o.topOptionText + "</option>", n.find("li").each(function () {
                    var n = "", l = t(this).parents("ul, ol").length;
                    for (i = 1; i < l; i++) n += o.indentString;
                    var r = t(this).find("a:first-child").attr("href"),
                        a = n + t(this).clone().children("ul, ol").remove().end().text();
                    e += '<option value="' + r + '">' + a + "</option>"
                }), e += "</select></div>", n.parent().append(e), t("#mobileMenu_" + n.attr("id")).change(function () {
                    var n;
                    null !== (n = t(this)).val() && (document.location.href = n.val())
                }), a(n)
            } else alert("mobileMenu will only work with UL or OL elements!")
        }

        function c(n) {
            l() && !r(n) ? u(n) : l() && r(n) ? a(n) : !l() && r(n) && function (n) {
                n.css("display", ""), t("#mobileMenu_" + n.attr("id")).hide()
            }(n)
        }

        return this.each(function () {
            e && t.extend(o, e);
            var n = t(this);
            t(window).resize(function () {
                c(n)
            }), c(n)
        })
    }
}(jQuery);