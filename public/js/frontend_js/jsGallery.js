! function(a) {
    function b(b, d) {
        function e() {
            i("onInit")
        }

        function f() {}

        function g(a, b) {
            return b ? void(d[a] = b) : d[a]
        }

        function h() {
            k.each(function() {
                var b = a(this);
                i("onDestroy"), b.removeData("plugin_" + c)
            })
        }

        function i(a) {
            void 0 !== d[a] && d[a].call(j)
        }
        var j = b,
            k = a(b);
        return d = a.extend({}, a.fn[c].defaults, d), e(), {
            option: g,
            destroy: h,
            fooPublic: f
        }
    }
    var c = "demoplugin";
    a.fn[c] = function(d) {
        if ("string" == typeof arguments[0]) {
            var e, f = arguments[0],
                g = Array.prototype.slice.call(arguments, 1);
            return this.each(function() {
                if (!a.data(this, "plugin_" + c) || "function" != typeof a.data(this, "plugin_" + c)[f]) throw new Error("Method " + f + " does not exist on jQuery." + c);
                e = a.data(this, "plugin_" + c)[f].apply(this, g)
            }), void 0 !== e ? e : this
        }
        if ("object" == typeof d || !d) return this.each(function() {
            a.data(this, "plugin_" + c) || a.data(this, "plugin_" + c, new b(this, d))
        })
    }, a.fn[c].defaults = {
        onInit: function() {},
        onDestroy: function() {}
    }
}(jQuery),
function(a) {
    function b(b, f) {
        function g() {
            var b = 1,
                d = {},
                e = "album-" + f.defaultAlbumName.jsgHashCode();
            d[e] = {
                title: f.defaultAlbumName,
                images: {},
                count: 0
            }, x.find("[" + f.imageLinkAttr + "]").each(function(g, h) {
                var i = a(h).attr(f.albumNameAttr),
                    j = {
                        url: a(h).attr(f.imageLinkAttr),
                        thumbnail: a(h).attr(f.thumbnailLinkAttr),
                        altText: a(h).attr(f.altTextAttr)
                    },
                    k = "image-" + j.url.jsgHashCode(),
                    l = c(i) ? e : "album-" + i.jsgHashCode();
                d.hasOwnProperty(l) || (d[l] = {
                    title: i,
                    images: {},
                    count: 0,
                    index: F.length
                }, b++, F.push(l)), j.index = d[l].count, d[l].images[k] = j, d[l].count++
            }), 0 === d[e].count && (delete d[e], b--), y = {
                albums: d,
                count: b,
                title: x.attr(f.galleryTitleAttr),
                id: z
            }, window.console.log(y, f.galleryParent), h(), v("onInit")
        }

        function h() {
            var b, c = "";
            if (f.showAlbums && y.count > 0) {
                c = '<div class="jsg-albums">';
                for (b in y.albums) y.albums.hasOwnProperty(b) && (c += '<span class="jsg-album" id="' + b + '" data-count="' + y.albums[b].count + '" data-title="' + y.albums[b].title + '">' + y.albums[b].title + "</span>");
                c += "</div>"
            }
            var d = '<div class="js-gallery" id="' + z + '" style="z-index: ' + f.zIndex + '"><div class="jsg-topbar"><div class="jsg-title"><div class="jsg-name">' + y.title + '</div><div class="jsg-btns"><i class="fas fa-search-plus"></i>  <i class="fas fa-times jsg-close"></i></div>' + c + '<div class="clearfix"></div></div></div><div class="jsg-content"><div class="jsg-images"></div><div class="jsg-thumbnails"></div><div class="jsg-nav"><div class="jsg-prev"><i class="fas fa-chevron-circle-left"></i></div><div class="jsg-next"><i class="fas fa-chevron-circle-right"></i></div></div><div class="clearfix"></div></div></div>';
            A = a(d), a(f.galleryParent).append(A), B = A.find(".jsg-album"), a("#" + z + " .jsg-close").click(function() {
                j()
            }), B.click(function() {
                q(a(this).text())
            }), m(), window.console.log(F)
        }

        function i(a, b) {
            A.show(), c(a) && (a = B.eq(0).text()), ("number" != typeof b || b < 0) && (b = 0), q(a, function() {
                var a = "album-" + C.jsgHashCode();
                y.albums[a].count <= b && (b = 0), p(b)
            })
        }

        function j() {
            A.hide()
        }

        function k(a) {
            A.find(".jsg-images").html(""), A.find(".jsg-images div.preloader").remove(), A.find(".jsg-images").append('<img src="' + a.url + '" class="jsg-image ' + (a.landscape ? "jsg-landscape" : "jsg-portrait") + '" data-height="' + a.height + '" data-width="' + a.width + '" data-image-index="' + a.index + '"/>'), l(), f.connectAlbums || (A.find(".jsg-prev, .jsg-next").show(), 0 === a.index && A.find(".jsg-prev").hide(), a.index === y.albums["album-" + C.jsgHashCode()].count - 1 && A.find(".jsg-next").hide());
            var b = A.find(".jsg-thumb-item");
            b.removeClass("active").eq(a.index).addClass("active");
            var c = 0,
                d = 0;
            for (d = 0; d < a.index - 1; d++) c += b.eq(d).outerHeight(!0);
            A.find(".jsg-thumbnails").animate({
                scrollTop: c
            })
        }

        function l() {
            var a = A.find(".jsg-images .jsg-image"),
                b = (a.hasClass("jsg-landscape"), a.attr("data-height"), a.attr("data-width"), A.find(".jsg-images")),
                c = b.innerHeight(),
                d = b.innerWidth();
            a.css("max-height", Math.round(9 * c / 10) + "px").css("max-width", Math.round(9 * d / 10) + "px")
        }

        function m() {
            a(window).resize(function() {
                s(), l()
            }), a(document).on("click", "#" + z + " .jsg-prev", function() {
                n()
            }), a(document).on("click", "#" + z + " .jsg-next", function() {
                o()
            }), a(document).on("click", "#" + z + " .jsg-album", function() {
                q(a(this).attr("data-title")), p(0)
            }), a(document).on("click", "#" + z + " .jsg-thumb-item", function() {
                var b = a(this).parent().attr("data-album"),
                    c = a(".jsg-thumb-item").index(a(this));
                q(b), p(c)
            })
        }

        function n() {
            var a = A.find(".jsg-images .jsg-image"),
                b = parseInt(a.attr("data-image-index")),
                c = y.albums["album-" + C.jsgHashCode()];
            if (b > 0) p(b - 1);
            else if (f.connectAlbums) {
                var d = c.index - 1;
                d < 0 && (d = F.length - 1), q(y.albums[F[d]].title), p(y.albums[F[d]].count - 1)
            }
        }

        function o() {
            var a = A.find(".jsg-images .jsg-image"),
                b = parseInt(a.attr("data-image-index")),
                c = y.albums["album-" + C.jsgHashCode()];
            if (b < c.count - 1) p(b + 1);
            else if (f.connectAlbums) {
                var d = c.index + 1;
                d >= F.length && (d = 0), q(y.albums[F[d]].title), p(0)
            }
        }

        function p(a) {
            var b, c = y.albums["album-" + C.jsgHashCode()],
                d = c.images,
                e = !1;
            for (b in d) d.hasOwnProperty(b) && d[b].index === a && (e = d[b], D = b);
            if (e === !1) return void(D = !1);
            if (A.find(".jsg-images").html(""), E.indexOf(D) < 0) {
                A.find(".jsg-images").append('<div class="preloader"><div class="spinner-grow text-warning" role="status"><span class="sr-only">Loading...</span></div></div>');
                var f = new Image;
                f.onload = function() {
                    E.push(D), e.height = f.height, e.width = f.width, e.landscape = e.width / e.height > 1, k(e)
                }, f.src = e.url
            } else k(e)
        }

        function q(a, b) {
            var c = "album-" + a.jsgHashCode();
            if (!y.albums.hasOwnProperty(c)) throw new Error("No such album exists: " + c);
            var d = A.find("#" + c);
            B.index(d);
            B.removeClass("active"), d.addClass("active"), C = a, s(), r(y.albums[c]), "function" == typeof b && b()
        }

        function r(b) {
            if (!(window.outerWidth < 768)) {
                var d, e, f = a("#" + z + " .jsg-thumbnails");
                f.html("");
                var g = "";
                for (d in b.images) b.images.hasOwnProperty(d) && (e = b.images[d].thumbnail, c(e) && (e = b.images[d].url), g += '<div class="jsg-thumb-item" data-image-id="' + d + '" style=\'background-image: url("' + e + "\")'></div>");
                f.html(g), f.attr("data-album", b.title)
            }
        }

        function s() {
            var a, b = B.closest(".active"),
                c = B.index(b),
                d = 0;
            for (a = 0; a < c - 1; a++) d += B.eq(a).outerWidth(!0);
            A.find(".jsg-albums").animate({
                scrollLeft: d
            }, 300)
        }

        function t(a, b) {
            return b ? void(f[a] = b) : f[a]
        }

        function u() {
            x.each(function() {
                var b = a(this);
                a("#" + z).remove(), v("onDestroy"), b.removeData("plugin_" + e)
            })
        }

        function v(a) {
            void 0 !== f[a] && f[a].call(w)
        }
        var w = b,
            x = a(b),
            y = !1,
            z = "jsgallery-" + d(),
            A = !1,
            B = !1,
            C = !1,
            D = !1,
            E = [],
            F = [];
        return f = a.extend({}, a.fn[e].defaults, f), g(), {
            option: t,
            destroy: u,
            show: i,
            hide: j,
            showNext: o,
            showPrev: n,
            selectAlbum: q
        }
    }

    function c(a) {
        return "string" != typeof a || !a || 0 === a.trim().length
    }

    function d() {
        for (var a = "0123456789".split(""), b = ""; b.length < 8;) b += a[Math.floor(Math.random() * a.length)];
        return b
    }
    var e = "jsGallery";
    a.fn[e] = function(c) {
        if ("string" == typeof arguments[0]) {
            var d, f = arguments[0],
                g = Array.prototype.slice.call(arguments, 1);
            return this.each(function() {
                if (!a.data(this, "plugin_" + e) || "function" != typeof a.data(this, "plugin_" + e)[f]) throw new Error("Method " + f + " does not exist on jQuery." + e);
                d = a.data(this, "plugin_" + e)[f].apply(this, g)
            }), void 0 !== d ? d : this
        }
        if ("object" == typeof c || !c) return this.each(function() {
            a.data(this, "plugin_" + e) || a.data(this, "plugin_" + e, new b(this, c))
        })
    }, String.prototype.jsgHashCode = function() {
        var a, b, c, d = 0;
        if (0 === this.length) return d;
        var e = this.toLowerCase();
        for (a = 0, c = e.length; a < c; a++) b = e.charCodeAt(a), d = (d << 5) - d + b, d |= 0;
        return Math.abs(d)
    }, a.fn[e].defaults = {
        galleryTitleAttr: "data-title",
        albumNameAttr: "data-album-name",
        imageLinkAttr: "data-src",
        thumbnailLinkAttr: "data-thumbnail",
        altTextAttr: "data-alt",
        showAlbums: !0,
        defaultAlbumName: "Default Album",
        connectAlbums: !0,
        zIndex: 100,
        debug: !0,
        galleryParent: "body",
        onInit: function() {},
        onDestroy: function() {}
    }
}(jQuery);
//# sourceMappingURL=jsGallery.js.map