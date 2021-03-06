/*!
 * Dropdownhover v1.0.0 (http://bs-dropdownhover.kybarg.com)
 */
+ function(a) {
    "use strict";

    function c(c) {
        return this.each(function() {
            var d = a(this),
                e = d.data("bs.dropdownhover"),
                f = d.data();
            void 0 !== d.data("animations") && null !== d.data("animations") && (f.animations = a.isArray(f.animations) ? f.animations : f.animations.split(" "));
            var g = a.extend({}, b.DEFAULTS, f, "object" == typeof c && c);
            e || d.data("bs.dropdownhover", e = new b(this, g))
        })
    }
    var b = function(b, c) {
        this.options = c, this.$element = a(b);
        var d = this;
        this.dropdowns = this.$element.hasClass("dropdown-toggle") ? this.$element.parent().find(".dropdown-menu").parent(".dropdown") : this.$element.find(".dropdown"), this.dropdowns.each(function() {
            a(this).on("mouseenter.bs.dropdownhover", function() {
                d.show(a(this).children("a, button"))
            })
        }), this.dropdowns.each(function() {
            a(this).on("mouseleave.bs.dropdownhover", function() {
                d.hide(a(this).children("a, button"))
            })
        })
    };
    b.TRANSITION_DURATION = 300, b.DELAY = 150, b.TIMEOUT, b.DEFAULTS = {
        animations: ["fadeInDown", "fadeInRight", "fadeInUp", "fadeInLeft"]
    }, b.prototype.show = function(c) {
        var d = a(c);
        window.clearTimeout(b.TIMEOUT), a(".dropdown").not(d.parents()).each(function() {
            a(this).removeClass("open")
        });
        var e = this.options.animations[0];
        if (!d.is(".disabled, :disabled")) {
            var f = d.parent(),
                g = f.hasClass("open");
            if (!g) {
                var h = d.next(".dropdown-menu");
                f.addClass("open");
                var j = this.position(h);
                e = "top" == j ? this.options.animations[2] : "right" == j ? this.options.animations[3] : "left" == j ? this.options.animations[1] : this.options.animations[0], h.addClass("animated " + e);
                var k = a.support.transition && h.hasClass("animated");
                k ? h.one("bsTransitionEnd", function() {
                    h.removeClass("animated " + e)
                }).emulateTransitionEnd(b.TRANSITION_DURATION) : h.removeClass("animated " + e)
            }
            return !1
        }
    }, b.prototype.hide = function(c) {
        var e = a(c),
            f = e.parent();
        b.TIMEOUT = window.setTimeout(function() {
            f.removeClass("open")
        }, b.DELAY)
    }, b.prototype.position = function(b) {
        var c = a(window);
        b.css({
            bottom: "",
            left: "",
            top: "",
            right: ""
        }).removeClass("dropdownhover-top");
        var d = {
            top: c.scrollTop(),
            left: c.scrollLeft()
        };
        d.right = d.left + c.width(), d.bottom = d.top + c.height();
        var e = b.offset();
        e.right = e.left + b.outerWidth(), e.bottom = e.top + b.outerHeight();
        var f = b.position();
        f.right = e.left + b.outerWidth(), f.bottom = e.top + b.outerHeight();
        var g = "",
            h = b.parents(".dropdown-menu").length;
        if (h) f.left < 0 ? (g = "left", b.removeClass("dropdownhover-right").addClass("dropdownhover-left")) : (g = "right", b.addClass("dropdownhover-right").removeClass("dropdownhover-left")), e.left < d.left ? (g = "right", b.css({
            left: "100%",
            right: "auto"
        }).addClass("dropdownhover-right").removeClass("dropdownhover-left")) : e.right > d.right && (g = "left", b.css({
            left: "auto",
            right: "100%"
        }).removeClass("dropdownhover-right").addClass("dropdownhover-left")), e.bottom > d.bottom ? b.css({
            bottom: "auto",
            top: -(e.bottom - d.bottom)
        }) : e.top < d.top && b.css({
            bottom: -(d.top - e.top),
            top: "auto"
        });
        else {
            var i = b.parent(".dropdown"),
                j = i.offset();
            j.right = j.left + i.outerWidth(), j.bottom = j.top + i.outerHeight(), e.right > d.right && b.css({
                left: -(e.right - d.right),
                right: "auto"
            }), e.bottom > d.bottom && j.top - d.top > d.bottom - j.bottom || b.position().top < 0 ? (g = "top", b.css({
                bottom: "100%",
                top: "auto"
            }).addClass("dropdownhover-top").removeClass("dropdownhover-bottom")) : (g = "bottom", b.addClass("dropdownhover-bottom"))
        }
        return g
    };
    var d = a.fn.dropdownhover;
    a.fn.dropdownhover = c, a.fn.dropdownhover.Constructor = b, a.fn.dropdownhover.noConflict = function() {
        return a.fn.dropdownhover = d, this
    };
    var e;
    a(document).ready(function() {
        a('[data-hover="dropdown"]').each(function() {
            var b = a(this);
            c.call(b, b.data())
        })
    }), a(window).on("resize", function() {
        clearTimeout(e), e = setTimeout(function() {
            a(window).width() >= 768 ? a('[data-hover="dropdown"]').each(function() {
                var b = a(this);
                c.call(b, b.data())
            }) : a('[data-hover="dropdown"]').each(function() {
                a(this).removeData("bs.dropdownhover"), a(this).hasClass("dropdown-toggle") ? a(this).parent(".dropdown").find(".dropdown").andSelf().off("mouseenter.bs.dropdownhover mouseleave.bs.dropdownhover") : a(this).find(".dropdown").off("mouseenter.bs.dropdownhover mouseleave.bs.dropdownhover")
            })
        }, 200)
    })
}(jQuery);