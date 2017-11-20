jQuery(document).ready(function(a) {
    "use strict";
    var b = a(window),
        c = a(".header-top");
    a(window).on("load resize", function() {
        b.width() < 1024 ? c.addClass("mobile") : c.removeClass("mobile").addClass("header-top")
    }), a(function() {
        var b = a(".header-top");
        a(window).on("scroll", function() {
            var c = a(window).scrollTop();
            c >= 50 ? b.removeClass("header-top").addClass("header-top-dark") : b.removeClass("header-top-dark").addClass("header-top")
        })
    }), a(".grid").fitVids();
    var d = a(window).width();
    d > 1024 && a(window).scroll(function() {
        var b = a(".custom-headings, .custom-header-image"),
            c = a(this).scrollTop();
        b.css({
            "margin-top": -(c / 0) + "px",
            opacity: 1 - c / 720
        })
    })
}), ! function(a) {
    "use strict";
    a.fn.fitVids = function(b) {
        var c = {
            customSelector: null,
            ignore: null
        };
        if (!document.getElementById("fit-vids-style")) {
            var d = document.head || document.getElementsByTagName("head")[0],
                e = ".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}",
                f = document.createElement("div");
            f.innerHTML = '<p>x</p><style id="fit-vids-style">' + e + "</style>", d.appendChild(f.childNodes[1])
        }
        return b && a.extend(c, b), this.each(function() {
            var b = ['iframe[src*="player.vimeo.com"]', 'iframe[src*="youtube.com"]', 'iframe[src*="youtube-nocookie.com"]', 'iframe[src*="kickstarter.com"][src*="video.html"]', "object", "embed"];
            c.customSelector && b.push(c.customSelector);
            var d = ".fitvidsignore";
            c.ignore && (d = d + ", " + c.ignore);
            var e = a(this).find(b.join(","));
            e = e.not("object object"), e = e.not(d), e.each(function() {
                var b = a(this);
                if (!(b.parents(d).length > 0 || "embed" === this.tagName.toLowerCase() && b.parent("object").length || b.parent(".fluid-width-video-wrapper").length)) {
                    b.css("height") || b.css("width") || !isNaN(b.attr("height")) && !isNaN(b.attr("width")) || (b.attr("height", 9), b.attr("width", 16));
                    var c = "object" === this.tagName.toLowerCase() || b.attr("height") && !isNaN(parseInt(b.attr("height"), 10)) ? parseInt(b.attr("height"), 10) : b.height(),
                        e = isNaN(parseInt(b.attr("width"), 10)) ? b.width() : parseInt(b.attr("width"), 10),
                        f = c / e;
                    if (!b.attr("name")) {
                        var g = "fitvid" + a.fn.fitVids._count;
                        b.attr("name", g), a.fn.fitVids._count++
                    }
                    b.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top", 100 * f + "%"), b.removeAttr("height").removeAttr("width")
                }
            })
        })
    }, a.fn.fitVids._count = 0
}(window.jQuery || window.Zepto), ! function(a, b) {
    function c(a, b) {
        var c = a.createElement("p"),
            d = a.getElementsByTagName("head")[0] || a.documentElement;
        return c.innerHTML = "x<style>" + b + "</style>", d.insertBefore(c.lastChild, d.firstChild)
    }

    function d() {
        var a = t.elements;
        return "string" == typeof a ? a.split(" ") : a
    }

    function e(a, b) {
        var c = t.elements;
        "string" != typeof c && (c = c.join(" ")), "string" != typeof a && (a = a.join(" ")), t.elements = c + " " + a, j(b)
    }

    function f(a) {
        var b = r[a[p]];
        return b || (b = {}, q++, a[p] = q, r[q] = b), b
    }

    function g(a, c, d) {
        if (c || (c = b), s) return c.createElement(a);
        d || (d = f(c));
        var e;
        return e = d.cache[a] ? d.cache[a].cloneNode() : n.test(a) ? (d.cache[a] = d.createElem(a)).cloneNode() : d.createElem(a), !e.canHaveChildren || m.test(a) || e.tagUrn ? e : d.frag.appendChild(e)
    }

    function h(a, c) {
        if (a || (a = b), s) return a.createDocumentFragment();
        c = c || f(a);
        for (var e = c.frag.cloneNode(), g = 0, h = d(), i = h.length; i > g; g++) e.createElement(h[g]);
        return e
    }

    function i(a, b) {
        b.cache || (b.cache = {}, b.createElem = a.createElement, b.createFrag = a.createDocumentFragment, b.frag = b.createFrag()), a.createElement = function(c) {
            return t.shivMethods ? g(c, a, b) : b.createElem(c)
        }, a.createDocumentFragment = Function("h,f", "return function(){var n=f.cloneNode(),c=n.createElement;h.shivMethods&&(" + d().join().replace(/[\w\-:]+/g, function(a) {
            return b.createElem(a), b.frag.createElement(a), 'c("' + a + '")'
        }) + ");return n}")(t, b.frag)
    }

    function j(a) {
        a || (a = b);
        var d = f(a);
        return !t.shivCSS || o || d.hasCSS || (d.hasCSS = !!c(a, "article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}mark{background:#FF0;color:#000}template{display:none}")), s || i(a, d), a
    }
    var o, s, k = "3.7.3",
        l = a.html5 || {},
        m = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i,
        n = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i,
        p = "_html5shiv",
        q = 0,
        r = {};
    ! function() {
        try {
            var a = b.createElement("a");
            a.innerHTML = "<xyz></xyz>", o = "hidden" in a, s = 1 == a.childNodes.length || function() {
                b.createElement("a");
                var a = b.createDocumentFragment();
                return "undefined" == typeof a.cloneNode || "undefined" == typeof a.createDocumentFragment || "undefined" == typeof a.createElement
            }()
        } catch (a) {
            o = !0, s = !0
        }
    }();
    var t = {
        elements: l.elements || "abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output picture progress section summary template time video",
        version: k,
        shivCSS: l.shivCSS !== !1,
        supportsUnknownElements: s,
        shivMethods: l.shivMethods !== !1,
        type: "default",
        shivDocument: j,
        createElement: g,
        createDocumentFragment: h,
        addElements: e
    };
    a.html5 = t, j(b), "object" == typeof module && module.exports && (module.exports = t)
}("undefined" != typeof window ? window : this, document), ! function() {
    var a = navigator.userAgent.toLowerCase().indexOf("webkit") > -1,
        b = navigator.userAgent.toLowerCase().indexOf("opera") > -1,
        c = navigator.userAgent.toLowerCase().indexOf("msie") > -1;
    (a || b || c) && document.getElementById && window.addEventListener && window.addEventListener("hashchange", function() {
        var b, a = location.hash.substring(1);
        /^[A-z0-9_-]+$/.test(a) && (b = document.getElementById(a), b && (/^(?:a|select|input|button|textarea)$/i.test(b.tagName) || (b.tabIndex = -1), b.focus(), window.scrollBy(0, -53)))
    }, !1)
}(), ! function(a) {
    function b(b) {
        var c = a("<button />", {
            class: "dropdown-toggle",
            "aria-expanded": !1
        }).append(a("<span />", {
            class: "screen-reader-text",
            text: screenReaderText.expand
        }));
        b.find(".menu-item-has-children > a").after(c), b.find(".current-menu-ancestor > button").addClass("toggled-on"), b.find(".current-menu-ancestor > .sub-menu").addClass("toggled-on"), b.find(".menu-item-has-children").attr("aria-haspopup", "true"), b.find(".dropdown-toggle").click(function(b) {
            var c = a(this),
                d = c.find(".screen-reader-text");
            b.preventDefault(), c.toggleClass("toggled-on"), c.next(".children, .sub-menu").toggleClass("toggled-on"), c.attr("aria-expanded", "false" === c.attr("aria-expanded") ? "true" : "false"), d.text(d.text() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand)
        })
    }

    function c() {
        window.innerWidth < 910 ? (g.hasClass("toggled-on") ? g.attr("aria-expanded", "true") : g.attr("aria-expanded", "false"), j.hasClass("toggled-on") ? (h.attr("aria-expanded", "true"), i.attr("aria-expanded", "true")) : (h.attr("aria-expanded", "false"), i.attr("aria-expanded", "false")), g.attr("aria-controls", "site-navigation social-navigation")) : (g.removeAttr("aria-expanded"), h.removeAttr("aria-expanded"), i.removeAttr("aria-expanded"), g.removeAttr("aria-controls"))
    }

    function d(b) {
        e.hasClass("page") || e.hasClass("search") || e.hasClass("single-attachment") || e.hasClass("error404") || a(".entry-content").find(b).each(function() {
            var c, d = a(this),
                e = d.offset(),
                f = e.top,
                g = d.closest("article").find(".entry-footer"),
                h = g.offset(),
                i = h.top + (g.height() + 28),
                j = d.closest("figure");
            f > i ? "img.size-full" === b ? (c = new Image, c.src = d.attr("src"), a(c).on("load.molecule", function() {
                c.width >= 840 && (d.addClass("below-entry-meta"), j.hasClass("wp-caption") && (j.addClass("below-entry-meta"), j.removeAttr("style")))
            })) : d.addClass("below-entry-meta") : (d.removeClass("below-entry-meta"), j.removeClass("below-entry-meta"))
        })
    }
    var e, f, g, h, i, j, k;
    b(a(".main-navigation")), f = a("#masthead"), g = f.find("#menu-toggle"), j = f.find("#site-header-menu"), h = f.find("#site-navigation"), i = f.find("#social-navigation"),
        function() {
            g.length && (g.add(h).add(i).attr("aria-expanded", "false"), g.on("click.molecule", function() {
                a(this).add(j).toggleClass("toggled-on"), a(this).add(h).add(i).attr("aria-expanded", "false" === a(this).add(h).add(i).attr("aria-expanded") ? "true" : "false")
            }))
        }(),
        function() {
            function b() {
                window.innerWidth >= 910 ? (a(document.body).on("touchstart.molecule", function(b) {
                    a(b.target).closest(".main-navigation li").length || a(".main-navigation li").removeClass("focus")
                }), h.find(".menu-item-has-children > a").on("touchstart.molecule", function(b) {
                    var c = a(this).parent("li");
                    c.hasClass("focus") || (b.preventDefault(), c.toggleClass("focus"), c.siblings(".focus").removeClass("focus"))
                })) : h.find(".menu-item-has-children > a").unbind("touchstart.molecule")
            }
            h.length && h.children().length && ("ontouchstart" in window && (a(window).on("resize.molecule", b), b()), h.find("a").on("focus.molecule blur.molecule", function() {
                a(this).parents(".menu-item").toggleClass("focus")
            }))
        }(), a(document).ready(function() {
            e = a(document.body), a(window).on("load.molecule", c).on("resize.molecule", function() {
                clearTimeout(k), k = setTimeout(function() {
                    d("img.size-full"), d("blockquote.alignleft, blockquote.alignright")
                }, 300), c()
            }), d("img.size-full"), d("blockquote.alignleft, blockquote.alignright")
        })
}(jQuery);