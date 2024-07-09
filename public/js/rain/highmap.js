/*
 Highmaps JS v9.0.1 (2021-02-15)

 (c) 2011-2021 Torstein Honsi

 License: www.highcharts.com/license
*/
(function(V, J) {
    "object" === typeof module && module.exports ? (J["default"] = J, module.exports = V.document ? J(V) : J) : "function" === typeof define && define.amd ? define("highcharts/highmaps", function() {
        return J(V)
    }) : (V.Highcharts && V.Highcharts.error(16, !0), V.Highcharts = J(V))
})("undefined" !== typeof window ? window : this, function(V) {
    function J(w, l, b, y) {
        w.hasOwnProperty(l) || (w[l] = y.apply(null, b))
    }
    var b = {};
    J(b, "Core/Globals.js", [], function() {
        var w = "undefined" !== typeof V ? V : "undefined" !== typeof window ? window : {},
            l = w.document,
            b = w.navigator && w.navigator.userAgent || "",
            y = l && l.createElementNS && !!l.createElementNS("http://www.w3.org/2000/svg", "svg").createSVGRect,
            z = /(edge|msie|trident)/i.test(b) && !w.opera,
            C = -1 !== b.indexOf("Firefox"),
            v = -1 !== b.indexOf("Chrome"),
            t = C && 4 > parseInt(b.split("Firefox/")[1], 10),
            q = function() {};
        return {
            product: "Highcharts",
            version: "9.0.1",
            deg2rad: 2 * Math.PI / 360,
            doc: l,
            hasBidiBug: t,
            hasTouch: !!w.TouchEvent,
            isMS: z,
            isWebKit: -1 !== b.indexOf("AppleWebKit"),
            isFirefox: C,
            isChrome: v,
            isSafari: !v && -1 !== b.indexOf("Safari"),
            isTouchDevice: /(Mobile|Android|Windows Phone)/.test(b),
            SVG_NS: "http://www.w3.org/2000/svg",
            chartCount: 0,
            seriesTypes: {},
            supportsPassiveEvents: function() {
                var h = !1;
                if (!z) {
                    var c = Object.defineProperty({}, "passive", {
                        get: function() {
                            h = !0
                        }
                    });
                    w.addEventListener && w.removeEventListener && (w.addEventListener("testPassive", q, c), w.removeEventListener("testPassive", q, c))
                }
                return h
            }(),
            symbolSizes: {},
            svg: y,
            win: w,
            marginNames: ["plotTop", "marginRight", "marginBottom", "plotLeft"],
            noop: q,
            charts: [],
            dateFormats: {}
        }
    });
    J(b, "Core/Utilities.js",
        [b["Core/Globals.js"]],
        function(w) {
            function l(d, g, M, m) {
                var F = g ? "Highcharts error" : "Highcharts warning";
                32 === d && (d = F + ": Deprecated member");
                var W = c(d),
                    O = W ? F + " #" + d + ": www.highcharts.com/errors/" + d + "/" : d.toString();
                F = function() {
                    if (g) throw Error(O);
                    a.console && -1 === l.messages.indexOf(O) && console.warn(O)
                };
                if ("undefined" !== typeof m) {
                    var f = "";
                    W && (O += "?");
                    n(m, function(d, a) {
                        f += "\n - " + a + ": " + d;
                        W && (O += encodeURI(a) + "=" + encodeURI(d))
                    });
                    O += f
                }
                M ? e(M, "displayError", {
                    code: d,
                    message: O,
                    params: m
                }, F) : F();
                l.messages.push(O)
            }

            function b() {
                var d, a = arguments,
                    M = {},
                    e = function(a, d) {
                        "object" !== typeof a && (a = {});
                        n(d, function(F, D) {
                            "__proto__" !== D && "constructor" !== D && (!t(F, !0) || h(F) || q(F) ? a[D] = d[D] : a[D] = e(a[D] || {}, F))
                        });
                        return a
                    };
                !0 === a[0] && (M = a[1], a = Array.prototype.slice.call(a, 2));
                var F = a.length;
                for (d = 0; d < F; d++) M = e(M, a[d]);
                return M
            }

            function y(a, d) {
                var e = {};
                n(a, function(M, F) {
                    if (t(a[F], !0) && !a.nodeType && d[F]) M = y(a[F], d[F]), Object.keys(M).length && (e[F] = M);
                    else if (t(a[F]) || a[F] !== d[F]) e[F] = a[F]
                });
                return e
            }

            function z(a, d) {
                return parseInt(a,
                    d || 10)
            }

            function C(a) {
                return "string" === typeof a
            }

            function v(a) {
                a = Object.prototype.toString.call(a);
                return "[object Array]" === a || "[object Array Iterator]" === a
            }

            function t(a, d) {
                return !!a && "object" === typeof a && (!d || !v(a))
            }

            function q(a) {
                return t(a) && "number" === typeof a.nodeType
            }

            function h(a) {
                var d = a && a.constructor;
                return !(!t(a, !0) || q(a) || !d || !d.name || "Object" === d.name)
            }

            function c(a) {
                return "number" === typeof a && !isNaN(a) && Infinity > a && -Infinity < a
            }

            function p(a) {
                return "undefined" !== typeof a && null !== a
            }

            function k(a,
                d, e) {
                var M;
                C(d) ? p(e) ? a.setAttribute(d, e) : a && a.getAttribute && ((M = a.getAttribute(d)) || "class" !== d || (M = a.getAttribute(d + "Name"))) : n(d, function(d, e) {
                    a.setAttribute(e, d)
                });
                return M
            }

            function G(a, d) {
                var e;
                a || (a = {});
                for (e in d) a[e] = d[e];
                return a
            }

            function f() {
                for (var a = arguments, d = a.length, e = 0; e < d; e++) {
                    var g = a[e];
                    if ("undefined" !== typeof g && null !== g) return g
                }
            }

            function H(a, d) {
                w.isMS && !w.svg && d && "undefined" !== typeof d.opacity && (d.filter = "alpha(opacity=" + 100 * d.opacity + ")");
                G(a.style, d)
            }

            function x(a, e, M, g, F) {
                a =
                    d.createElement(a);
                e && G(a, e);
                F && H(a, {
                    padding: "0",
                    border: "none",
                    margin: "0"
                });
                M && H(a, M);
                g && g.appendChild(a);
                return a
            }

            function K(a, d) {
                return parseFloat(a.toPrecision(d || 14))
            }

            function L(a, d, e, g) {
                a = +a || 0;
                d = +d;
                var F = w.defaultOptions.lang,
                    M = (a.toString().split(".")[1] || "").split("e")[0].length,
                    m = a.toString().split("e"),
                    n = d;
                if (-1 === d) d = Math.min(M, 20);
                else if (!c(d)) d = 2;
                else if (d && m[1] && 0 > m[1]) {
                    var D = d + +m[1];
                    0 <= D ? (m[0] = (+m[0]).toExponential(D).split("e")[0], d = D) : (m[0] = m[0].split(".")[0] || 0, a = 20 > d ? (m[0] * Math.pow(10,
                        m[1])).toFixed(d) : 0, m[1] = 0)
                }
                var O = (Math.abs(m[1] ? m[0] : a) + Math.pow(10, -Math.max(d, M) - 1)).toFixed(d);
                M = String(z(O));
                D = 3 < M.length ? M.length % 3 : 0;
                e = f(e, F.decimalPoint);
                g = f(g, F.thousandsSep);
                a = (0 > a ? "-" : "") + (D ? M.substr(0, D) + g : "");
                a = 0 > +m[1] && !n ? "0" : a + M.substr(D).replace(/(\d{3})(?=\d)/g, "$1" + g);
                d && (a += e + O.slice(-d));
                m[1] && 0 !== +a && (a += "e" + m[1]);
                return a
            }

            function r(a, d) {
                if (!a) return d;
                var e = a.split(".").reverse();
                if (1 === e.length) return d[a];
                for (a = e.pop();
                    "undefined" !== typeof a && "undefined" !== typeof d && null !==
                    d;) d = d[a], a = e.pop();
                return d
            }

            function n(a, d, e) {
                for (var M in a) Object.hasOwnProperty.call(a, M) && d.call(e || a[M], a[M], M, a)
            }

            function u(a, d, e) {
                function M(d, F) {
                    var e = a.removeEventListener || w.removeEventListenerPolyfill;
                    e && e.call(a, d, F, !1)
                }

                function F(F) {
                    var e;
                    if (a.nodeName) {
                        if (d) {
                            var g = {};
                            g[d] = !0
                        } else g = F;
                        n(g, function(a, d) {
                            if (F[d])
                                for (e = F[d].length; e--;) M(d, F[d][e].fn)
                        })
                    }
                }
                var g = "function" === typeof a && a.prototype || a;
                if (Object.hasOwnProperty.call(g, "hcEvents")) {
                    var m = g.hcEvents;
                    d ? (g = m[d] || [], e ? (m[d] = g.filter(function(a) {
                        return e !==
                            a.fn
                    }), M(d, e)) : (F(m), m[d] = [])) : (F(m), delete g.hcEvents)
                }
            }

            function e(a, e, M, g) {
                M = M || {};
                if (d.createEvent && (a.dispatchEvent || a.fireEvent)) {
                    var F = d.createEvent("Events");
                    F.initEvent(e, !0, !0);
                    G(F, M);
                    a.dispatchEvent ? a.dispatchEvent(F) : a.fireEvent(e, F)
                } else if (a.hcEvents) {
                    M.target || G(M, {
                        preventDefault: function() {
                            M.defaultPrevented = !0
                        },
                        target: a,
                        type: e
                    });
                    F = [];
                    for (var m = a, n = !1; m.hcEvents;) Object.hasOwnProperty.call(m, "hcEvents") && m.hcEvents[e] && (F.length && (n = !0), F.unshift.apply(F, m.hcEvents[e])), m = Object.getPrototypeOf(m);
                    n && F.sort(function(a, d) {
                        return a.order - d.order
                    });
                    F.forEach(function(d) {
                        !1 === d.fn.call(a, M) && M.preventDefault()
                    })
                }
                g && !M.defaultPrevented && g.call(a, M)
            }
            var g = w.charts,
                d = w.doc,
                a = w.win;
            "";
            (l || (l = {})).messages = [];
            var m;
            Math.easeInOutSine = function(a) {
                return -.5 * (Math.cos(Math.PI * a) - 1)
            };
            var E = Array.prototype.find ? function(a, d) {
                return a.find(d)
            } : function(a, d) {
                var e, g = a.length;
                for (e = 0; e < g; e++)
                    if (d(a[e], e)) return a[e]
            };
            n({
                map: "map",
                each: "forEach",
                grep: "filter",
                reduce: "reduce",
                some: "some"
            }, function(a, d) {
                w[d] =
                    function(e) {
                        var g;
                        l(32, !1, void 0, (g = {}, g["Highcharts." + d] = "use Array." + a, g));
                        return Array.prototype[a].apply(e, [].slice.call(arguments, 1))
                    }
            });
            var I, A = function() {
                    var a = Math.random().toString(36).substring(2, 9) + "-",
                        d = 0;
                    return function() {
                        return "highcharts-" + (I ? "" : a) + d++
                    }
                }(),
                N = w.getOptions = function() {
                    return w.defaultOptions
                },
                R = w.setOptions = function(a) {
                    w.defaultOptions = b(!0, w.defaultOptions, a);
                    (a.time || a.global) && w.time.update(b(w.defaultOptions.global, w.defaultOptions.time, a.global, a.time));
                    return w.defaultOptions
                };
            a.jQuery && (a.jQuery.fn.highcharts = function() {
                var a = [].slice.call(arguments);
                if (this[0]) return a[0] ? (new(w[C(a[0]) ? a.shift() : "Chart"])(this[0], a[0], a[1]), this) : g[k(this[0], "data-highcharts-chart")]
            });
            return {
                addEvent: function(a, d, e, g) {
                    void 0 === g && (g = {});
                    var F = "function" === typeof a && a.prototype || a;
                    Object.hasOwnProperty.call(F, "hcEvents") || (F.hcEvents = {});
                    F = F.hcEvents;
                    w.Point && a instanceof w.Point && a.series && a.series.chart && (a.series.chart.runTrackerClick = !0);
                    var m = a.addEventListener || w.addEventListenerPolyfill;
                    m && m.call(a, d, e, w.supportsPassiveEvents ? {
                        passive: void 0 === g.passive ? -1 !== d.indexOf("touch") : g.passive,
                        capture: !1
                    } : !1);
                    F[d] || (F[d] = []);
                    F[d].push({
                        fn: e,
                        order: "number" === typeof g.order ? g.order : Infinity
                    });
                    F[d].sort(function(a, d) {
                        return a.order - d.order
                    });
                    return function() {
                        u(a, d, e)
                    }
                },
                arrayMax: function(a) {
                    for (var d = a.length, e = a[0]; d--;) a[d] > e && (e = a[d]);
                    return e
                },
                arrayMin: function(a) {
                    for (var d = a.length, e = a[0]; d--;) a[d] < e && (e = a[d]);
                    return e
                },
                attr: k,
                clamp: function(a, d, e) {
                    return a > d ? a < e ? a : e : d
                },
                cleanRecursively: y,
                clearTimeout: function(a) {
                    p(a) && clearTimeout(a)
                },
                correctFloat: K,
                createElement: x,
                css: H,
                defined: p,
                destroyObjectProperties: function(a, d) {
                    n(a, function(e, g) {
                        e && e !== d && e.destroy && e.destroy();
                        delete a[g]
                    })
                },
                discardElement: function(a) {
                    m || (m = x("div"));
                    a && m.appendChild(a);
                    m.innerHTML = ""
                },
                erase: function(a, d) {
                    for (var e = a.length; e--;)
                        if (a[e] === d) {
                            a.splice(e, 1);
                            break
                        }
                },
                error: l,
                extend: G,
                extendClass: function(a, d) {
                    var e = function() {};
                    e.prototype = new a;
                    G(e.prototype, d);
                    return e
                },
                find: E,
                fireEvent: e,
                format: function(a,
                    d, e) {
                    var g = "{",
                        F = !1,
                        m = [],
                        M = /f$/,
                        n = /\.([0-9])/,
                        D = w.defaultOptions.lang,
                        f = e && e.time || w.time;
                    for (e = e && e.numberFormatter || L; a;) {
                        var u = a.indexOf(g);
                        if (-1 === u) break;
                        var E = a.slice(0, u);
                        if (F) {
                            E = E.split(":");
                            g = r(E.shift() || "", d);
                            if (E.length && "number" === typeof g)
                                if (E = E.join(":"), M.test(E)) {
                                    var k = parseInt((E.match(n) || ["", "-1"])[1], 10);
                                    null !== g && (g = e(g, k, D.decimalPoint, -1 < E.indexOf(",") ? D.thousandsSep : ""))
                                } else g = f.dateFormat(E, g);
                            m.push(g)
                        } else m.push(E);
                        a = a.slice(u + 1);
                        g = (F = !F) ? "}" : "{"
                    }
                    m.push(a);
                    return m.join("")
                },
                getMagnitude: function(a) {
                    return Math.pow(10, Math.floor(Math.log(a) / Math.LN10))
                },
                getNestedProperty: r,
                getOptions: N,
                getStyle: function(d, e, g) {
                    if ("width" === e) return e = Math.min(d.offsetWidth, d.scrollWidth), g = d.getBoundingClientRect && d.getBoundingClientRect().width, g < e && g >= e - 1 && (e = Math.floor(g)), Math.max(0, e - w.getStyle(d, "padding-left") - w.getStyle(d, "padding-right"));
                    if ("height" === e) return Math.max(0, Math.min(d.offsetHeight, d.scrollHeight) - w.getStyle(d, "padding-top") - w.getStyle(d, "padding-bottom"));
                    a.getComputedStyle ||
                        l(27, !0);
                    if (d = a.getComputedStyle(d, void 0)) d = d.getPropertyValue(e), f(g, "opacity" !== e) && (d = z(d));
                    return d
                },
                inArray: function(a, d, e) {
                    l(32, !1, void 0, {
                        "Highcharts.inArray": "use Array.indexOf"
                    });
                    return d.indexOf(a, e)
                },
                isArray: v,
                isClass: h,
                isDOMElement: q,
                isFunction: function(a) {
                    return "function" === typeof a
                },
                isNumber: c,
                isObject: t,
                isString: C,
                keys: function(a) {
                    l(32, !1, void 0, {
                        "Highcharts.keys": "use Object.keys"
                    });
                    return Object.keys(a)
                },
                merge: b,
                normalizeTickInterval: function(a, d, e, g, F) {
                    var m = a;
                    e = f(e, 1);
                    var n = a /
                        e;
                    d || (d = F ? [1, 1.2, 1.5, 2, 2.5, 3, 4, 5, 6, 8, 10] : [1, 2, 2.5, 5, 10], !1 === g && (1 === e ? d = d.filter(function(a) {
                        return 0 === a % 1
                    }) : .1 >= e && (d = [1 / e])));
                    for (g = 0; g < d.length && !(m = d[g], F && m * e >= a || !F && n <= (d[g] + (d[g + 1] || d[g])) / 2); g++);
                    return m = K(m * e, -Math.round(Math.log(.001) / Math.LN10))
                },
                numberFormat: L,
                objectEach: n,
                offset: function(e) {
                    var g = d.documentElement;
                    e = e.parentElement || e.parentNode ? e.getBoundingClientRect() : {
                        top: 0,
                        left: 0,
                        width: 0,
                        height: 0
                    };
                    return {
                        top: e.top + (a.pageYOffset || g.scrollTop) - (g.clientTop || 0),
                        left: e.left + (a.pageXOffset ||
                            g.scrollLeft) - (g.clientLeft || 0),
                        width: e.width,
                        height: e.height
                    }
                },
                pad: function(a, d, e) {
                    return Array((d || 2) + 1 - String(a).replace("-", "").length).join(e || "0") + a
                },
                pick: f,
                pInt: z,
                relativeLength: function(a, d, e) {
                    return /%$/.test(a) ? d * parseFloat(a) / 100 + (e || 0) : parseFloat(a)
                },
                removeEvent: u,
                setOptions: R,
                splat: function(a) {
                    return v(a) ? a : [a]
                },
                stableSort: function(a, d) {
                    var e = a.length,
                        g, F;
                    for (F = 0; F < e; F++) a[F].safeI = F;
                    a.sort(function(a, e) {
                        g = d(a, e);
                        return 0 === g ? a.safeI - e.safeI : g
                    });
                    for (F = 0; F < e; F++) delete a[F].safeI
                },
                syncTimeout: function(a,
                    d, e) {
                    if (0 < d) return setTimeout(a, d, e);
                    a.call(0, e);
                    return -1
                },
                timeUnits: {
                    millisecond: 1,
                    second: 1E3,
                    minute: 6E4,
                    hour: 36E5,
                    day: 864E5,
                    week: 6048E5,
                    month: 24192E5,
                    year: 314496E5
                },
                uniqueKey: A,
                useSerialIds: function(a) {
                    return I = f(a, I)
                },
                wrap: function(a, d, e) {
                    var g = a[d];
                    a[d] = function() {
                        var a = Array.prototype.slice.call(arguments),
                            d = arguments,
                            m = this;
                        m.proceed = function() {
                            g.apply(m, arguments.length ? arguments : d)
                        };
                        a.unshift(g);
                        a = e.apply(this, a);
                        m.proceed = null;
                        return a
                    }
                }
            }
        });
    J(b, "Core/Renderer/HTML/AST.js", [b["Core/Globals.js"],
        b["Core/Utilities.js"]
    ], function(w, l) {
        var b = w.SVG_NS,
            y = l.attr,
            z = l.createElement,
            C = l.discardElement,
            v = l.error,
            t = l.isString,
            q = l.objectEach,
            h = l.splat;
        "";
        var c = !1;
        try {
            c = !!(new DOMParser).parseFromString("", "text/html")
        } catch (p) {}
        return function() {
            function p(k) {
                this.nodes = "string" === typeof k ? this.parseMarkup(k) : k
            }
            p.filterUserAttributes = function(k) {
                q(k, function(c, f) {
                    var h = !0; - 1 === p.allowedAttributes.indexOf(f) && (h = !1); - 1 !== ["background", "dynsrc", "href", "lowsrc", "src"].indexOf(f) && (h = t(c) && p.allowedReferences.some(function(f) {
                        return 0 ===
                            c.indexOf(f)
                    }));
                    h || (v("Highcharts warning: Invalid attribute '" + f + "' in config"), delete k[f])
                });
                return k
            };
            p.setElementHTML = function(k, c) {
                k.innerHTML = "";
                c && (new p(c)).addToDOM(k)
            };
            p.prototype.addToDOM = function(k) {
                function c(f, k) {
                    var x;
                    h(f).forEach(function(f) {
                        var h = f.tagName,
                            r = f.textContent ? w.doc.createTextNode(f.textContent) : void 0;
                        if (h)
                            if ("#text" === h) var n = r;
                            else if (-1 !== p.allowedTags.indexOf(h)) {
                            h = w.doc.createElementNS("svg" === h ? b : k.namespaceURI || b, h);
                            var u = f.attributes || {};
                            q(f, function(e, g) {
                                "tagName" !==
                                g && "attributes" !== g && "children" !== g && "textContent" !== g && (u[g] = e)
                            });
                            y(h, p.filterUserAttributes(u));
                            r && h.appendChild(r);
                            c(f.children || [], h);
                            n = h
                        } else v("Highcharts warning: Invalid tagName '" + h + "' in config");
                        n && k.appendChild(n);
                        x = n
                    });
                    return x
                }
                return c(this.nodes, k)
            };
            p.prototype.parseMarkup = function(k) {
                var h = [];
                if (c) k = (new DOMParser).parseFromString(k, "text/html");
                else {
                    var f = z("div");
                    f.innerHTML = k;
                    k = {
                        body: f
                    }
                }
                var H = function(f, k) {
                    var c = f.nodeName.toLowerCase(),
                        h = {
                            tagName: c
                        };
                    if ("#text" === c) {
                        c = f.textContent ||
                            "";
                        if (/^[\s]*$/.test(c)) return;
                        h.textContent = c
                    }
                    if (c = f.attributes) {
                        var n = {};
                        [].forEach.call(c, function(e) {
                            n[e.name] = e.value
                        });
                        h.attributes = n
                    }
                    if (f.childNodes.length) {
                        var u = [];
                        [].forEach.call(f.childNodes, function(e) {
                            H(e, u)
                        });
                        u.length && (h.children = u)
                    }
                    k.push(h)
                };
                [].forEach.call(k.body.childNodes, function(f) {
                    return H(f, h)
                });
                f && C(f);
                return h
            };
            p.allowedTags = "a b br button caption circle clipPath code dd defs div dl dt em feComponentTransfer feFuncA feFuncB feFuncG feFuncR feGaussianBlur feOffset feMerge feMergeNode filter h1 h2 h3 h4 h5 h6 hr i img li linearGradient marker ol p path pattern pre rect small span stop strong style sub sup svg table text thead tbody tspan td th tr ul #text".split(" ");
            p.allowedAttributes = "aria-controls aria-describedby aria-expanded aria-haspopup aria-hidden aria-label aria-labelledby aria-live aria-pressed aria-readonly aria-roledescription aria-selected class clip-path color colspan cx cy d dx dy disabled fill height href id in markerHeight markerWidth offset opacity orient padding paddingLeft patternUnits r refX refY role scope slope src startOffset stdDeviation stroke stroke-linecap stroke-width style result rowspan summary target tabindex text-align textAnchor textLength type valign width x x1 xy y y1 y2 zIndex".split(" ");
            p.allowedReferences = "https:// http:// mailto: / ../ ./ #".split(" ");
            return p
        }()
    });
    J(b, "Core/Color/Color.js", [b["Core/Globals.js"], b["Core/Utilities.js"]], function(w, l) {
        var b = l.isNumber,
            y = l.merge,
            z = l.pInt;
        "";
        l = function() {
            function l(v) {
                this.parsers = [{
                    regex: /rgba\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]?(?:\.[0-9]+)?)\s*\)/,
                    parse: function(t) {
                        return [z(t[1]), z(t[2]), z(t[3]), parseFloat(t[4], 10)]
                    }
                }, {
                    regex: /rgb\(\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*,\s*([0-9]{1,3})\s*\)/,
                    parse: function(t) {
                        return [z(t[1]),
                            z(t[2]), z(t[3]), 1
                        ]
                    }
                }];
                this.rgba = [];
                if (w.Color !== l) return new w.Color(v);
                if (!(this instanceof l)) return new l(v);
                this.init(v)
            }
            l.parse = function(v) {
                return new l(v)
            };
            l.prototype.init = function(v) {
                var t, q;
                if ((this.input = v = l.names[v && v.toLowerCase ? v.toLowerCase() : ""] || v) && v.stops) this.stops = v.stops.map(function(c) {
                    return new l(c[1])
                });
                else {
                    if (v && v.charAt && "#" === v.charAt()) {
                        var h = v.length;
                        v = parseInt(v.substr(1), 16);
                        7 === h ? t = [(v & 16711680) >> 16, (v & 65280) >> 8, v & 255, 1] : 4 === h && (t = [(v & 3840) >> 4 | (v & 3840) >> 8, (v & 240) >>
                            4 | v & 240, (v & 15) << 4 | v & 15, 1
                        ])
                    }
                    if (!t)
                        for (q = this.parsers.length; q-- && !t;) {
                            var c = this.parsers[q];
                            (h = c.regex.exec(v)) && (t = c.parse(h))
                        }
                }
                this.rgba = t || []
            };
            l.prototype.get = function(v) {
                var t = this.input,
                    q = this.rgba;
                if ("undefined" !== typeof this.stops) {
                    var h = y(t);
                    h.stops = [].concat(h.stops);
                    this.stops.forEach(function(c, p) {
                        h.stops[p] = [h.stops[p][0], c.get(v)]
                    })
                } else h = q && b(q[0]) ? "rgb" === v || !v && 1 === q[3] ? "rgb(" + q[0] + "," + q[1] + "," + q[2] + ")" : "a" === v ? q[3] : "rgba(" + q.join(",") + ")" : t;
                return h
            };
            l.prototype.brighten = function(v) {
                var t,
                    q = this.rgba;
                if (this.stops) this.stops.forEach(function(h) {
                    h.brighten(v)
                });
                else if (b(v) && 0 !== v)
                    for (t = 0; 3 > t; t++) q[t] += z(255 * v), 0 > q[t] && (q[t] = 0), 255 < q[t] && (q[t] = 255);
                return this
            };
            l.prototype.setOpacity = function(v) {
                this.rgba[3] = v;
                return this
            };
            l.prototype.tweenTo = function(v, t) {
                var q = this.rgba,
                    h = v.rgba;
                h.length && q && q.length ? (v = 1 !== h[3] || 1 !== q[3], t = (v ? "rgba(" : "rgb(") + Math.round(h[0] + (q[0] - h[0]) * (1 - t)) + "," + Math.round(h[1] + (q[1] - h[1]) * (1 - t)) + "," + Math.round(h[2] + (q[2] - h[2]) * (1 - t)) + (v ? "," + (h[3] + (q[3] - h[3]) * (1 -
                    t)) : "") + ")") : t = v.input || "none";
                return t
            };
            l.names = {
                white: "#ffffff",
                black: "#000000"
            };
            return l
        }();
        w.Color = l;
        w.color = l.parse;
        return l
    });
    J(b, "Core/Color/Palette.js", [], function() {
        return {
            colors: "#7cb5ec #434348 #90ed7d #f7a35c #8085e9 #f15c80 #e4d354 #2b908f #f45b5b #91e8e1".split(" "),
            backgroundColor: "#ffffff",
            neutralColor100: "#000000",
            neutralColor80: "#333333",
            neutralColor60: "#666666",
            neutralColor40: "#999999",
            neutralColor20: "#cccccc",
            neutralColor10: "#e6e6e6",
            neutralColor5: "#f2f2f2",
            neutralColor3: "#f7f7f7",
            highlightColor100: "#003399",
            highlightColor80: "#335cad",
            highlightColor60: "#6685c2",
            highlightColor20: "#ccd6eb",
            highlightColor10: "#e6ebf5",
            indicatorPositiveLine: "#06b535",
            indicatorNegativeLine: "#f21313"
        }
    });
    J(b, "Core/Animation/Fx.js", [b["Core/Globals.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = b.win,
            y = l.isNumber,
            z = l.objectEach;
        l = function() {
            function l(l, t, q) {
                this.pos = NaN;
                this.options = t;
                this.elem = l;
                this.prop = q
            }
            l.prototype.dSetter = function() {
                var l = this.paths,
                    t = l && l[0];
                l = l && l[1];
                var q = [],
                    h = this.now ||
                    0;
                if (1 !== h && t && l)
                    if (t.length === l.length && 1 > h)
                        for (var c = 0; c < l.length; c++) {
                            for (var p = t[c], k = l[c], G = [], f = 0; f < k.length; f++) {
                                var H = p[f],
                                    x = k[f];
                                y(H) && y(x) && ("A" !== k[0] || 4 !== f && 5 !== f) ? G[f] = H + h * (x - H) : G[f] = x
                            }
                            q.push(G)
                        } else q = l;
                    else q = this.toD || [];
                this.elem.attr("d", q, void 0, !0)
            };
            l.prototype.update = function() {
                var l = this.elem,
                    t = this.prop,
                    q = this.now,
                    h = this.options.step;
                if (this[t + "Setter"]) this[t + "Setter"]();
                else l.attr ? l.element && l.attr(t, q, null, !0) : l.style[t] = q + this.unit;
                h && h.call(l, q, this)
            };
            l.prototype.run =
                function(v, t, q) {
                    var h = this,
                        c = h.options,
                        p = function(f) {
                            return p.stopped ? !1 : h.step(f)
                        },
                        k = w.requestAnimationFrame || function(f) {
                            setTimeout(f, 13)
                        },
                        G = function() {
                            for (var f = 0; f < l.timers.length; f++) l.timers[f]() || l.timers.splice(f--, 1);
                            l.timers.length && k(G)
                        };
                    v !== t || this.elem["forceAnimate:" + this.prop] ? (this.startTime = +new Date, this.start = v, this.end = t, this.unit = q, this.now = this.start, this.pos = 0, p.elem = this.elem, p.prop = this.prop, p() && 1 === l.timers.push(p) && k(G)) : (delete c.curAnim[this.prop], c.complete && 0 === Object.keys(c.curAnim).length &&
                        c.complete.call(this.elem))
                };
            l.prototype.step = function(l) {
                var t = +new Date,
                    q = this.options,
                    h = this.elem,
                    c = q.complete,
                    p = q.duration,
                    k = q.curAnim;
                if (h.attr && !h.element) l = !1;
                else if (l || t >= p + this.startTime) {
                    this.now = this.end;
                    this.pos = 1;
                    this.update();
                    var G = k[this.prop] = !0;
                    z(k, function(f) {
                        !0 !== f && (G = !1)
                    });
                    G && c && c.call(h);
                    l = !1
                } else this.pos = q.easing((t - this.startTime) / p), this.now = this.start + (this.end - this.start) * this.pos, this.update(), l = !0;
                return l
            };
            l.prototype.initPath = function(l, t, q) {
                function h(f, k) {
                    for (; f.length <
                        K;) {
                        var n = f[0],
                            u = k[K - f.length];
                        u && "M" === n[0] && (f[0] = "C" === u[0] ? ["C", n[1], n[2], n[1], n[2], n[1], n[2]] : ["L", n[1], n[2]]);
                        f.unshift(n);
                        G && f.push(f[f.length - 1])
                    }
                }

                function c(k, c) {
                    for (; k.length < K;)
                        if (c = k[k.length / f - 1].slice(), "C" === c[0] && (c[1] = c[5], c[2] = c[6]), G) {
                            var n = k[k.length / f].slice();
                            k.splice(k.length / 2, 0, c, n)
                        } else k.push(c)
                }
                var p = l.startX,
                    k = l.endX;
                t = t && t.slice();
                q = q.slice();
                var G = l.isArea,
                    f = G ? 2 : 1;
                if (!t) return [q, q];
                if (p && k) {
                    for (l = 0; l < p.length; l++)
                        if (p[l] === k[0]) {
                            var H = l;
                            break
                        } else if (p[0] === k[k.length -
                            p.length + l]) {
                        H = l;
                        var x = !0;
                        break
                    } else if (p[p.length - 1] === k[k.length - p.length + l]) {
                        H = p.length - l;
                        break
                    }
                    "undefined" === typeof H && (t = [])
                }
                if (t.length && y(H)) {
                    var K = q.length + H * f;
                    x ? (h(t, q), c(q, t)) : (h(q, t), c(t, q))
                }
                return [t, q]
            };
            l.prototype.fillSetter = function() {
                l.prototype.strokeSetter.apply(this, arguments)
            };
            l.prototype.strokeSetter = function() {
                this.elem.attr(this.prop, b.color(this.start).tweenTo(b.color(this.end), this.pos), null, !0)
            };
            l.timers = [];
            return l
        }();
        b.Fx = l;
        b.timers = l.timers;
        return l
    });
    J(b, "Core/Animation/AnimationUtilities.js",
        [b["Core/Animation/Fx.js"], b["Core/Globals.js"], b["Core/Utilities.js"]],
        function(b, l, B) {
            var w = B.defined,
                z = B.getStyle,
                C = B.isArray,
                v = B.isNumber,
                t = B.isObject,
                q = B.merge,
                h = B.objectEach,
                c = B.pick;
            B = l.setAnimation = function(f, k) {
                k.renderer.globalAnimation = c(f, k.options.chart.animation, !0)
            };
            var p = l.animObject = function(f) {
                    return t(f) ? q({
                        duration: 500,
                        defer: 0
                    }, f) : {
                        duration: f ? 500 : 0,
                        defer: 0
                    }
                },
                k = l.getDeferredAnimation = function(f, k, c) {
                    var h = p(k),
                        x = 0,
                        r = 0;
                    (c ? [c] : f.series).forEach(function(n) {
                        n = p(n.options.animation);
                        x = k && w(k.defer) ? h.defer : Math.max(x, n.duration + n.defer);
                        r = Math.min(h.duration, n.duration)
                    });
                    f.renderer.forExport && (x = 0);
                    return {
                        defer: Math.max(0, x - r),
                        duration: Math.min(x, r)
                    }
                },
                G = l.stop = function(f, k) {
                    for (var c = b.timers.length; c--;) b.timers[c].elem !== f || k && k !== b.timers[c].prop || (b.timers[c].stopped = !0)
                };
            return {
                animate: function(f, k, c) {
                    var x, p = "",
                        r, n;
                    if (!t(c)) {
                        var u = arguments;
                        c = {
                            duration: u[2],
                            easing: u[3],
                            complete: u[4]
                        }
                    }
                    v(c.duration) || (c.duration = 400);
                    c.easing = "function" === typeof c.easing ? c.easing : Math[c.easing] ||
                        Math.easeInOutSine;
                    c.curAnim = q(k);
                    h(k, function(e, g) {
                        G(f, g);
                        n = new b(f, c, g);
                        r = null;
                        "d" === g && C(k.d) ? (n.paths = n.initPath(f, f.pathArray, k.d), n.toD = k.d, x = 0, r = 1) : f.attr ? x = f.attr(g) : (x = parseFloat(z(f, g)) || 0, "opacity" !== g && (p = "px"));
                        r || (r = e);
                        r && r.match && r.match("px") && (r = r.replace(/px/g, ""));
                        n.run(x, r, p)
                    })
                },
                animObject: p,
                getDeferredAnimation: k,
                setAnimation: B,
                stop: G
            }
        });
    J(b, "Core/Renderer/SVG/SVGElement.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Renderer/HTML/AST.js"], b["Core/Color/Color.js"], b["Core/Globals.js"],
        b["Core/Color/Palette.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C) {
        var v = b.animate,
            t = b.animObject,
            q = b.stop,
            h = y.deg2rad,
            c = y.doc,
            p = y.hasTouch,
            k = y.noop,
            G = y.svg,
            f = y.SVG_NS,
            H = y.win,
            x = C.attr,
            K = C.createElement,
            L = C.css,
            r = C.defined,
            n = C.erase,
            u = C.extend,
            e = C.fireEvent,
            g = C.isArray,
            d = C.isFunction,
            a = C.isNumber,
            m = C.isString,
            E = C.merge,
            I = C.objectEach,
            A = C.pick,
            N = C.pInt,
            R = C.syncTimeout,
            w = C.uniqueKey;
        "";
        b = function() {
            function b() {
                this.height = this.element = void 0;
                this.opacity = 1;
                this.renderer = void 0;
                this.SVG_NS = f;
                this.symbolCustomAttribs = "x y width height r start end innerR anchorX anchorY rounded".split(" ");
                this.width = void 0
            }
            b.prototype._defaultGetter = function(a) {
                a = A(this[a + "Value"], this[a], this.element ? this.element.getAttribute(a) : null, 0);
                /^[\-0-9\.]+$/.test(a) && (a = parseFloat(a));
                return a
            };
            b.prototype._defaultSetter = function(a, d, e) {
                e.setAttribute(d, a)
            };
            b.prototype.add = function(a) {
                var d = this.renderer,
                    e = this.element;
                a && (this.parentGroup = a);
                this.parentInverted = a && a.inverted;
                "undefined" !== typeof this.textStr &&
                    "text" === this.element.nodeName && d.buildText(this);
                this.added = !0;
                if (!a || a.handleZ || this.zIndex) var g = this.zIndexSetter();
                g || (a ? a.element : d.box).appendChild(e);
                if (this.onAdd) this.onAdd();
                return this
            };
            b.prototype.addClass = function(a, d) {
                var e = d ? "" : this.attr("class") || "";
                a = (a || "").split(/ /g).reduce(function(a, d) {
                    -1 === e.indexOf(d) && a.push(d);
                    return a
                }, e ? [e] : []).join(" ");
                a !== e && this.attr("class", a);
                return this
            };
            b.prototype.afterSetters = function() {
                this.doTransform && (this.updateTransform(), this.doTransform = !1)
            };
            b.prototype.align = function(a, d, e) {
                var F, g = {};
                var f = this.renderer;
                var D = f.alignedObjects;
                var k, M;
                if (a) {
                    if (this.alignOptions = a, this.alignByTranslate = d, !e || m(e)) this.alignTo = F = e || "renderer", n(D, this), D.push(this), e = void 0
                } else a = this.alignOptions, d = this.alignByTranslate, F = this.alignTo;
                e = A(e, f[F], f);
                F = a.align;
                f = a.verticalAlign;
                D = (e.x || 0) + (a.x || 0);
                var E = (e.y || 0) + (a.y || 0);
                "right" === F ? k = 1 : "center" === F && (k = 2);
                k && (D += (e.width - (a.width || 0)) / k);
                g[d ? "translateX" : "x"] = Math.round(D);
                "bottom" === f ? M = 1 : "middle" ===
                    f && (M = 2);
                M && (E += (e.height - (a.height || 0)) / M);
                g[d ? "translateY" : "y"] = Math.round(E);
                this[this.placed ? "animate" : "attr"](g);
                this.placed = !0;
                this.alignAttr = g;
                return this
            };
            b.prototype.alignSetter = function(a) {
                var d = {
                    left: "start",
                    center: "middle",
                    right: "end"
                };
                d[a] && (this.alignValue = a, this.element.setAttribute("text-anchor", d[a]))
            };
            b.prototype.animate = function(a, d, e) {
                var F = this,
                    g = t(A(d, this.renderer.globalAnimation, !0));
                d = g.defer;
                A(c.hidden, c.msHidden, c.webkitHidden, !1) && (g.duration = 0);
                0 !== g.duration ? (e && (g.complete =
                    e), R(function() {
                    F.element && v(F, a, g)
                }, d)) : (this.attr(a, void 0, e), I(a, function(a, d) {
                    g.step && g.step.call(this, a, {
                        prop: d,
                        pos: 1,
                        elem: this
                    })
                }, this));
                return this
            };
            b.prototype.applyTextOutline = function(a) {
                var d = this.element; - 1 !== a.indexOf("contrast") && (a = a.replace(/contrast/g, this.renderer.getContrast(d.style.fill)));
                var e = a.split(" ");
                a = e[e.length - 1];
                if ((e = e[0]) && "none" !== e && y.svg) {
                    this.fakeTS = !0;
                    this.ySetter = this.xSetter;
                    e = e.replace(/(^[\d\.]+)(.*?)$/g, function(a, d, e) {
                        return 2 * Number(d) + e
                    });
                    this.removeTextOutline();
                    var g = c.createElementNS(f, "tspan");
                    x(g, {
                        "class": "highcharts-text-outline",
                        fill:a ,
                        stroke: '#ffffff',
                        "stroke-width": 5,
                        "stroke-linejoin": "round"
                    });
                    [].forEach.call(d.childNodes, function(a) {
                        var d = a.cloneNode(!0);
                        d.removeAttribute && ["fill", "stroke", "stroke-width", "stroke"].forEach(function(a) {
                            return d.removeAttribute(a)
                        });
                        g.appendChild(d)
                    });
                    a = c.createElementNS(f, "tspan");
                    a.textContent = "\u200b";
                    x(a, {
                        x: d.getAttribute("x"),
                        y: d.getAttribute("y")
                    });
                    g.appendChild(a);
                    d.insertBefore(g, d.firstChild)
                }
            };
            b.prototype.attr = function(a,
                d, e, g) {
                var F = this.element,
                    m, D = this,
                    n, f, k = this.symbolCustomAttribs;
                if ("string" === typeof a && "undefined" !== typeof d) {
                    var E = a;
                    a = {};
                    a[E] = d
                }
                "string" === typeof a ? D = (this[a + "Getter"] || this._defaultGetter).call(this, a, F) : (I(a, function(d, e) {
                    n = !1;
                    g || q(this, e);
                    this.symbolName && -1 !== k.indexOf(e) && (m || (this.symbolAttr(a), m = !0), n = !0);
                    !this.rotation || "x" !== e && "y" !== e || (this.doTransform = !0);
                    n || (f = this[e + "Setter"] || this._defaultSetter, f.call(this, d, e, F), !this.styledMode && this.shadows && /^(width|height|visibility|x|y|d|transform|cx|cy|r)$/.test(e) &&
                        this.updateShadows(e, d, f))
                }, this), this.afterSetters());
                e && e.call(this);
                return D
            };
            b.prototype.clip = function(a) {
                return this.attr("clip-path", a ? "url(" + this.renderer.url + "#" + a.id + ")" : "none")
            };
            b.prototype.crisp = function(a, d) {
                d = d || a.strokeWidth || 0;
                var e = Math.round(d) % 2 / 2;
                a.x = Math.floor(a.x || this.x || 0) + e;
                a.y = Math.floor(a.y || this.y || 0) + e;
                a.width = Math.floor((a.width || this.width || 0) - 2 * e);
                a.height = Math.floor((a.height || this.height || 0) - 2 * e);
                r(a.strokeWidth) && (a.strokeWidth = d);
                return a
            };
            b.prototype.complexColor =
                function(a, d, F) {
                    var m = this.renderer,
                        n, f, D, k, u, c, M, O, h, A, x = [],
                        p;
                    e(this.renderer, "complexColor", {
                        args: arguments
                    }, function() {
                        a.radialGradient ? f = "radialGradient" : a.linearGradient && (f = "linearGradient");
                        if (f) {
                            D = a[f];
                            u = m.gradients;
                            c = a.stops;
                            h = F.radialReference;
                            g(D) && (a[f] = D = {
                                x1: D[0],
                                y1: D[1],
                                x2: D[2],
                                y2: D[3],
                                gradientUnits: "userSpaceOnUse"
                            });
                            "radialGradient" === f && h && !r(D.gradientUnits) && (k = D, D = E(D, m.getRadialAttr(h, k), {
                                gradientUnits: "userSpaceOnUse"
                            }));
                            I(D, function(a, d) {
                                "id" !== d && x.push(d, a)
                            });
                            I(c, function(a) {
                                x.push(a)
                            });
                            x = x.join(",");
                            if (u[x]) A = u[x].attr("id");
                            else {
                                D.id = A = w();
                                var e = u[x] = m.createElement(f).attr(D).add(m.defs);
                                e.radAttr = k;
                                e.stops = [];
                                c.forEach(function(a) {
                                    0 === a[1].indexOf("rgba") ? (n = B.parse(a[1]), M = n.get("rgb"), O = n.get("a")) : (M = a[1], O = 1);
                                    a = m.createElement("stop").attr({
                                        offset: a[0],
                                        "stop-color": M,
                                        "stop-opacity": O
                                    }).add(e);
                                    e.stops.push(a)
                                })
                            }
                            p = "url(" + m.url + "#" + A + ")";
                            F.setAttribute(d, p);
                            F.gradient = x;
                            a.toString = function() {
                                return p
                            }
                        }
                    })
                };
            b.prototype.css = function(a) {
                var d = this.styles,
                    e = {},
                    g = this.element,
                    m = "",
                    n = !d,
                    D = ["textOutline", "textOverflow", "width"];
                a && a.color && (a.fill = a.color);
                d && I(a, function(a, F) {
                    d && d[F] !== a && (e[F] = a, n = !0)
                });
                if (n) {
                    d && (a = u(d, e));
                    if (a)
                        if (null === a.width || "auto" === a.width) delete this.textWidth;
                        else if ("text" === g.nodeName.toLowerCase() && a.width) var f = this.textWidth = N(a.width);
                    this.styles = a;
                    f && !G && this.renderer.forExport && delete a.width;
                    if (g.namespaceURI === this.SVG_NS) {
                        var k = function(a, d) {
                            return "-" + d.toLowerCase()
                        };
                        I(a, function(a, d) {
                            -1 === D.indexOf(d) && (m += d.replace(/([A-Z])/g, k) + ":" +
                                a + ";")
                        });
                        m && x(g, "style", m)
                    } else L(g, a);
                    this.added && ("text" === this.element.nodeName && this.renderer.buildText(this), a && a.textOutline && this.applyTextOutline(a.textOutline))
                }
                return this
            };
            b.prototype.dashstyleSetter = function(a) {
                var d = this["stroke-width"];
                "inherit" === d && (d = 1);
                if (a = a && a.toLowerCase()) {
                    var e = a.replace("shortdashdotdot", "3,1,1,1,1,1,").replace("shortdashdot", "3,1,1,1").replace("shortdot", "1,1,").replace("shortdash", "3,1,").replace("longdash", "8,3,").replace(/dot/g, "1,3,").replace("dash", "4,3,").replace(/,$/,
                        "").split(",");
                    for (a = e.length; a--;) e[a] = "" + N(e[a]) * A(d, NaN);
                    a = e.join(",").replace(/NaN/g, "none");
                    this.element.setAttribute("stroke-dasharray", a)
                }
            };
            b.prototype.destroy = function() {
                var a = this,
                    d = a.element || {},
                    e = a.renderer,
                    g = e.isSVG && "SPAN" === d.nodeName && a.parentGroup || void 0,
                    m = d.ownerSVGElement;
                d.onclick = d.onmouseout = d.onmouseover = d.onmousemove = d.point = null;
                q(a);
                if (a.clipPath && m) {
                    var f = a.clipPath;
                    [].forEach.call(m.querySelectorAll("[clip-path],[CLIP-PATH]"), function(a) {
                        -1 < a.getAttribute("clip-path").indexOf(f.element.id) &&
                            a.removeAttribute("clip-path")
                    });
                    a.clipPath = f.destroy()
                }
                if (a.stops) {
                    for (m = 0; m < a.stops.length; m++) a.stops[m].destroy();
                    a.stops.length = 0;
                    a.stops = void 0
                }
                a.safeRemoveChild(d);
                for (e.styledMode || a.destroyShadows(); g && g.div && 0 === g.div.childNodes.length;) d = g.parentGroup, a.safeRemoveChild(g.div), delete g.div, g = d;
                a.alignTo && n(e.alignedObjects, a);
                I(a, function(d, e) {
                    a[e] && a[e].parentGroup === a && a[e].destroy && a[e].destroy();
                    delete a[e]
                })
            };
            b.prototype.destroyShadows = function() {
                (this.shadows || []).forEach(function(a) {
                        this.safeRemoveChild(a)
                    },
                    this);
                this.shadows = void 0
            };
            b.prototype.destroyTextPath = function(a, d) {
                var e = a.getElementsByTagName("text")[0];
                if (e) {
                    if (e.removeAttribute("dx"), e.removeAttribute("dy"), d.element.setAttribute("id", ""), this.textPathWrapper && e.getElementsByTagName("textPath").length) {
                        for (a = this.textPathWrapper.element.childNodes; a.length;) e.appendChild(a[0]);
                        e.removeChild(this.textPathWrapper.element)
                    }
                } else if (a.getAttribute("dx") || a.getAttribute("dy")) a.removeAttribute("dx"), a.removeAttribute("dy");
                this.textPathWrapper &&
                    (this.textPathWrapper = this.textPathWrapper.destroy())
            };
            b.prototype.dSetter = function(a, d, e) {
                g(a) && ("string" === typeof a[0] && (a = this.renderer.pathToSegments(a)), this.pathArray = a, a = a.reduce(function(a, d, e) {
                    return d && d.join ? (e ? a + " " : "") + d.join(" ") : (d || "").toString()
                }, ""));
                /(NaN| {2}|^$)/.test(a) && (a = "M 0 0");
                this[d] !== a && (e.setAttribute(d, a), this[d] = a)
            };
            b.prototype.fadeOut = function(a) {
                var d = this;
                d.animate({
                    opacity: 0
                }, {
                    duration: A(a, 150),
                    complete: function() {
                        d.attr({
                            y: -9999
                        }).hide()
                    }
                })
            };
            b.prototype.fillSetter =
                function(a, d, e) {
                    "string" === typeof a ? e.setAttribute(d, a) : a && this.complexColor(a, d, e)
                };
            b.prototype.getBBox = function(a, e) {
                var g, m = this.renderer,
                    n = this.element,
                    f = this.styles,
                    D = this.textStr,
                    k = m.cache,
                    E = m.cacheKeys,
                    c = n.namespaceURI === this.SVG_NS;
                e = A(e, this.rotation, 0);
                var O = m.styledMode ? n && b.prototype.getStyle.call(n, "font-size") : f && f.fontSize;
                if (r(D)) {
                    var I = D.toString(); - 1 === I.indexOf("<") && (I = I.replace(/[0-9]/g, "0"));
                    I += ["", e, O, this.textWidth, f && f.textOverflow, f && f.fontWeight].join()
                }
                I && !a && (g = k[I]);
                if (!g) {
                    if (c || m.forExport) {
                        try {
                            var x = this.fakeTS && function(a) {
                                var d = n.querySelector(".highcharts-text-outline");
                                d && L(d, {
                                    display: a
                                })
                            };
                            d(x) && x("none");
                            g = n.getBBox ? u({}, n.getBBox()) : {
                                width: n.offsetWidth,
                                height: n.offsetHeight
                            };
                            d(x) && x("")
                        } catch (ca) {
                            ""
                        }
                        if (!g || 0 > g.width) g = {
                            width: 0,
                            height: 0
                        }
                    } else g = this.htmlGetBBox();
                    m.isSVG && (a = g.width, m = g.height, c && (g.height = m = {
                        "11px,17": 14,
                        "13px,20": 16
                    } [f && f.fontSize + "," + Math.round(m)] || m), e && (f = e * h, g.width = Math.abs(m * Math.sin(f)) + Math.abs(a * Math.cos(f)), g.height = Math.abs(m *
                        Math.cos(f)) + Math.abs(a * Math.sin(f))));
                    if (I && 0 < g.height) {
                        for (; 250 < E.length;) delete k[E.shift()];
                        k[I] || E.push(I);
                        k[I] = g
                    }
                }
                return g
            };
            b.prototype.getStyle = function(a) {
                return H.getComputedStyle(this.element || this, "").getPropertyValue(a)
            };
            b.prototype.hasClass = function(a) {
                return -1 !== ("" + this.attr("class")).split(" ").indexOf(a)
            };
            b.prototype.hide = function(a) {
                a ? this.attr({
                    y: -9999
                }) : this.attr({
                    visibility: "hidden"
                });
                return this
            };
            b.prototype.htmlGetBBox = function() {
                return {
                    height: 0,
                    width: 0,
                    x: 0,
                    y: 0
                }
            };
            b.prototype.init =
                function(a, d) {
                    this.element = "span" === d ? K(d) : c.createElementNS(this.SVG_NS, d);
                    this.renderer = a;
                    e(this, "afterInit")
                };
            b.prototype.invert = function(a) {
                this.inverted = a;
                this.updateTransform();
                return this
            };
            b.prototype.on = function(a, d) {
                var e, g, m = this.element,
                    n;
                p && "click" === a ? (m.ontouchstart = function(a) {
                    e = a.touches[0].clientX;
                    g = a.touches[0].clientY
                }, m.ontouchend = function(a) {
                    e && 4 <= Math.sqrt(Math.pow(e - a.changedTouches[0].clientX, 2) + Math.pow(g - a.changedTouches[0].clientY, 2)) || d.call(m, a);
                    n = !0;
                    !1 !== a.cancelable &&
                        a.preventDefault()
                }, m.onclick = function(a) {
                    n || d.call(m, a)
                }) : m["on" + a] = d;
                return this
            };
            b.prototype.opacitySetter = function(a, d, e) {
                this.opacity = a = Number(Number(a).toFixed(3));
                e.setAttribute(d, a)
            };
            b.prototype.removeClass = function(a) {
                return this.attr("class", ("" + this.attr("class")).replace(m(a) ? new RegExp("(^| )" + a + "( |$)") : a, " ").replace(/ +/g, " ").trim())
            };
            b.prototype.removeTextOutline = function() {
                var a = this.element.querySelector("tspan.highcharts-text-outline");
                a && this.safeRemoveChild(a)
            };
            b.prototype.safeRemoveChild =
                function(a) {
                    var d = a.parentNode;
                    d && d.removeChild(a)
                };
            b.prototype.setRadialReference = function(a) {
                var d = this.element.gradient && this.renderer.gradients[this.element.gradient];
                this.element.radialReference = a;
                d && d.radAttr && d.animate(this.renderer.getRadialAttr(a, d.radAttr));
                return this
            };
            b.prototype.setTextPath = function(d, e) {
                var g = this.element,
                    m = this.text ? this.text.element : g,
                    n = {
                        textAnchor: "text-anchor"
                    },
                    f = !1,
                    D = this.textPathWrapper,
                    u = !D;
                e = E(!0, {
                        enabled: !0,
                        attributes: {
                            dy: -5,
                            startOffset: "50%",
                            textAnchor: "middle"
                        }
                    },
                    e);
                var c = l.filterUserAttributes(e.attributes);
                if (d && e && e.enabled) {
                    D && null === D.element.parentNode ? (u = !0, D = D.destroy()) : D && this.removeTextOutline.call(D.parentGroup);
                    this.options && this.options.padding && (c.dx = -this.options.padding);
                    D || (this.textPathWrapper = D = this.renderer.createElement("textPath"), f = !0);
                    var h = D.element;
                    (e = d.element.getAttribute("id")) || d.element.setAttribute("id", e = w());
                    if (u)
                        for (m.setAttribute("y", 0), a(c.dx) && m.setAttribute("x", -c.dx), d = [].slice.call(m.childNodes), u = 0; u < d.length; u++) {
                            var A =
                                d[u];
                            A.nodeType !== Node.TEXT_NODE && "tspan" !== A.nodeName || h.appendChild(A)
                        }
                    f && D && D.add({
                        element: m
                    });
                    h.setAttributeNS("http://www.w3.org/1999/xlink", "href", this.renderer.url + "#" + e);
                    r(c.dy) && (h.parentNode.setAttribute("dy", c.dy), delete c.dy);
                    r(c.dx) && (h.parentNode.setAttribute("dx", c.dx), delete c.dx);
                    I(c, function(a, d) {
                        h.setAttribute(n[d] || d, a)
                    });
                    g.removeAttribute("transform");
                    this.removeTextOutline.call(D);
                    this.text && !this.renderer.styledMode && this.attr({
                        fill: "none",
                        "stroke-width": 0
                    });
                    this.applyTextOutline =
                        this.updateTransform = k
                } else D && (delete this.updateTransform, delete this.applyTextOutline, this.destroyTextPath(g, d), this.updateTransform(), this.options && this.options.rotation && this.applyTextOutline(this.options.style.textOutline));
                return this
            };
            b.prototype.shadow = function(a, d, e) {
                var g = [],
                    m = this.element,
                    F = !1,
                    D = this.oldShadowOptions;
                var n = {
                    color: z.neutralColor100,
                    offsetX: 1,
                    offsetY: 1,
                    opacity: .15,
                    width: 3
                };
                var f;
                !0 === a ? f = n : "object" === typeof a && (f = u(n, a));
                f && (f && D && I(f, function(a, d) {
                        a !== D[d] && (F = !0)
                    }), F &&
                    this.destroyShadows(), this.oldShadowOptions = f);
                if (!f) this.destroyShadows();
                else if (!this.shadows) {
                    var k = f.opacity / f.width;
                    var E = this.parentInverted ? "translate(-1,-1)" : "translate(" + f.offsetX + ", " + f.offsetY + ")";
                    for (n = 1; n <= f.width; n++) {
                        var c = m.cloneNode(!1);
                        var h = 2 * f.width + 1 - 2 * n;
                        x(c, {
                            stroke: a.color || z.neutralColor100,
                            "stroke-opacity": k * n,
                            "stroke-width": h,
                            transform: E,
                            fill: "none"
                        });
                        c.setAttribute("class", (c.getAttribute("class") || "") + " highcharts-shadow");
                        e && (x(c, "height", Math.max(x(c, "height") - h, 0)),
                            c.cutHeight = h);
                        d ? d.element.appendChild(c) : m.parentNode && m.parentNode.insertBefore(c, m);
                        g.push(c)
                    }
                    this.shadows = g
                }
                return this
            };
            b.prototype.show = function(a) {
                return this.attr({
                    visibility: a ? "inherit" : "visible"
                })
            };
            b.prototype.strokeSetter = function(a, d, e) {
                this[d] = a;
                this.stroke && this["stroke-width"] ? (b.prototype.fillSetter.call(this, this.stroke, "stroke", e), e.setAttribute("stroke-width", this["stroke-width"]), this.hasStroke = !0) : "stroke-width" === d && 0 === a && this.hasStroke ? (e.removeAttribute("stroke"), this.hasStroke = !1) : this.renderer.styledMode && this["stroke-width"] && (e.setAttribute("stroke-width", this["stroke-width"]), this.hasStroke = !0)
            };
            b.prototype.strokeWidth = function() {
                if (!this.renderer.styledMode) return this["stroke-width"] || 0;
                var a = this.getStyle("stroke-width"),
                    d = 0;
                if (a.indexOf("px") === a.length - 2) d = N(a);
                else if ("" !== a) {
                    var e = c.createElementNS(f, "rect");
                    x(e, {
                        width: a,
                        "stroke-width": 0
                    });
                    this.element.parentNode.appendChild(e);
                    d = e.getBBox().width;
                    e.parentNode.removeChild(e)
                }
                return d
            };
            b.prototype.symbolAttr =
                function(a) {
                    var d = this;
                    "x y r start end width height innerR anchorX anchorY clockwise".split(" ").forEach(function(e) {
                        d[e] = A(a[e], d[e])
                    });
                    d.attr({
                        d: d.renderer.symbols[d.symbolName](d.x, d.y, d.width, d.height, d)
                    })
                };
            b.prototype.textSetter = function(a) {
                a !== this.textStr && (delete this.textPxLength, this.textStr = a, this.added && this.renderer.buildText(this))
            };
            b.prototype.titleSetter = function(a) {
                var d = this.element,
                    e = d.getElementsByTagName("title")[0] || c.createElementNS(this.SVG_NS, "title");
                d.insertBefore ? d.insertBefore(e,
                    d.firstChild) : d.appendChild(e);
                e.textContent = String(A(a, "")).replace(/<[^>]*>/g, "").replace(/&lt;/g, "<").replace(/&gt;/g, ">")
            };
            b.prototype.toFront = function() {
                var a = this.element;
                a.parentNode.appendChild(a);
                return this
            };
            b.prototype.translate = function(a, d) {
                return this.attr({
                    translateX: a,
                    translateY: d
                })
            };
            b.prototype.updateShadows = function(a, d, e) {
                var g = this.shadows;
                if (g)
                    for (var m = g.length; m--;) e.call(g[m], "height" === a ? Math.max(d - (g[m].cutHeight || 0), 0) : "d" === a ? this.d : d, a, g[m])
            };
            b.prototype.updateTransform =
                function() {
                    var a = this.translateX || 0,
                        d = this.translateY || 0,
                        e = this.scaleX,
                        g = this.scaleY,
                        m = this.inverted,
                        n = this.rotation,
                        D = this.matrix,
                        f = this.element;
                    m && (a += this.width, d += this.height);
                    a = ["translate(" + a + "," + d + ")"];
                    r(D) && a.push("matrix(" + D.join(",") + ")");
                    m ? a.push("rotate(90) scale(-1,1)") : n && a.push("rotate(" + n + " " + A(this.rotationOriginX, f.getAttribute("x"), 0) + " " + A(this.rotationOriginY, f.getAttribute("y") || 0) + ")");
                    (r(e) || r(g)) && a.push("scale(" + A(e, 1) + " " + A(g, 1) + ")");
                    a.length && f.setAttribute("transform",
                        a.join(" "))
                };
            b.prototype.visibilitySetter = function(a, d, e) {
                "inherit" === a ? e.removeAttribute(d) : this[d] !== a && e.setAttribute(d, a);
                this[d] = a
            };
            b.prototype.xGetter = function(a) {
                "circle" === this.element.nodeName && ("x" === a ? a = "cx" : "y" === a && (a = "cy"));
                return this._defaultGetter(a)
            };
            b.prototype.zIndexSetter = function(a, d) {
                var e = this.renderer,
                    g = this.parentGroup,
                    m = (g || e).element || e.box,
                    n = this.element,
                    D = !1;
                e = m === e.box;
                var f = this.added;
                var k;
                r(a) ? (n.setAttribute("data-z-index", a), a = +a, this[d] === a && (f = !1)) : r(this[d]) &&
                    n.removeAttribute("data-z-index");
                this[d] = a;
                if (f) {
                    (a = this.zIndex) && g && (g.handleZ = !0);
                    d = m.childNodes;
                    for (k = d.length - 1; 0 <= k && !D; k--) {
                        g = d[k];
                        f = g.getAttribute("data-z-index");
                        var E = !r(f);
                        if (g !== n)
                            if (0 > a && E && !e && !k) m.insertBefore(n, d[k]), D = !0;
                            else if (N(f) <= a || E && (!r(a) || 0 <= a)) m.insertBefore(n, d[k + 1] || null), D = !0
                    }
                    D || (m.insertBefore(n, d[e ? 3 : 0] || null), D = !0)
                }
                return D
            };
            return b
        }();
        b.prototype["stroke-widthSetter"] = b.prototype.strokeSetter;
        b.prototype.yGetter = b.prototype.xGetter;
        b.prototype.matrixSetter = b.prototype.rotationOriginXSetter =
            b.prototype.rotationOriginYSetter = b.prototype.rotationSetter = b.prototype.scaleXSetter = b.prototype.scaleYSetter = b.prototype.translateXSetter = b.prototype.translateYSetter = b.prototype.verticalAlignSetter = function(a, d) {
                this[d] = a;
                this.doTransform = !0
            };
        y.SVGElement = b;
        return y.SVGElement
    });
    J(b, "Core/Renderer/SVG/SVGLabel.js", [b["Core/Renderer/SVG/SVGElement.js"], b["Core/Utilities.js"]], function(b, l) {
        function w(c, h) {
            v(c) ? c !== this[h] && (this[h] = c, this.updateTextPadding()) : this[h] = void 0
        }
        var y = this && this.__extends ||
            function() {
                var c = function(h, k) {
                    c = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(k, f) {
                        k.__proto__ = f
                    } || function(k, f) {
                        for (var c in f) f.hasOwnProperty(c) && (k[c] = f[c])
                    };
                    return c(h, k)
                };
                return function(h, k) {
                    function p() {
                        this.constructor = h
                    }
                    c(h, k);
                    h.prototype = null === k ? Object.create(k) : (p.prototype = k.prototype, new p)
                }
            }(),
            z = l.defined,
            C = l.extend,
            v = l.isNumber,
            t = l.merge,
            q = l.pick,
            h = l.removeEvent;
        return function(c) {
            function p(k, h, f, H, x, K, q, r, n, u) {
                var e = c.call(this) || this;
                e.paddingSetter = w;
                e.paddingLeftSetter =
                    w;
                e.paddingRightSetter = w;
                e.init(k, "g");
                e.textStr = h;
                e.x = f;
                e.y = H;
                e.anchorX = K;
                e.anchorY = q;
                e.baseline = n;
                e.className = u;
                "button" !== u && e.addClass("highcharts-label");
                u && e.addClass("highcharts-" + u);
                e.text = k.text("", 0, 0, r).attr({
                    zIndex: 1
                });
                if ("string" === typeof x) {
                    var g = /^url\((.*?)\)$/.test(x);
                    if (e.renderer.symbols[x] || g) e.symbolKey = x
                }
                e.bBox = p.emptyBBox;
                e.padding = 3;
                e.baselineOffset = 0;
                e.needsBox = k.styledMode || g;
                e.deferredAttr = {};
                e.alignFactor = 0;
                return e
            }
            y(p, c);
            p.prototype.alignSetter = function(k) {
                k = {
                    left: 0,
                    center: .5,
                    right: 1
                } [k];
                k !== this.alignFactor && (this.alignFactor = k, this.bBox && v(this.xSetting) && this.attr({
                    x: this.xSetting
                }))
            };
            p.prototype.anchorXSetter = function(k, c) {
                this.anchorX = k;
                this.boxAttr(c, Math.round(k) - this.getCrispAdjust() - this.xSetting)
            };
            p.prototype.anchorYSetter = function(k, c) {
                this.anchorY = k;
                this.boxAttr(c, k - this.ySetting)
            };
            p.prototype.boxAttr = function(k, c) {
                this.box ? this.box.attr(k, c) : this.deferredAttr[k] = c
            };
            p.prototype.css = function(k) {
                if (k) {
                    var c = {};
                    k = t(k);
                    p.textProps.forEach(function(f) {
                        "undefined" !==
                        typeof k[f] && (c[f] = k[f], delete k[f])
                    });
                    this.text.css(c);
                    var f = "width" in c;
                    "fontSize" in c || "fontWeight" in c ? this.updateTextPadding() : f && this.updateBoxSize()
                }
                return b.prototype.css.call(this, k)
            };
            p.prototype.destroy = function() {
                h(this.element, "mouseenter");
                h(this.element, "mouseleave");
                this.text && this.text.destroy();
                this.box && (this.box = this.box.destroy());
                b.prototype.destroy.call(this)
            };
            p.prototype.fillSetter = function(k, c) {
                k && (this.needsBox = !0);
                this.fill = k;
                this.boxAttr(c, k)
            };
            p.prototype.getBBox = function() {
                var k =
                    this.bBox,
                    c = this.padding,
                    f = q(this.paddingLeft, c);
                return {
                    width: this.width,
                    height: this.height,
                    x: k.x - f,
                    y: k.y - c
                }
            };
            p.prototype.getCrispAdjust = function() {
                return this.renderer.styledMode && this.box ? this.box.strokeWidth() % 2 / 2 : (this["stroke-width"] ? parseInt(this["stroke-width"], 10) : 0) % 2 / 2
            };
            p.prototype.heightSetter = function(k) {
                this.heightSetting = k
            };
            p.prototype.on = function(k, c) {
                var f = this,
                    h = f.text,
                    x = h && "SPAN" === h.element.tagName ? h : void 0;
                if (x) {
                    var p = function(h) {
                        ("mouseenter" === k || "mouseleave" === k) && h.relatedTarget instanceof
                        Element && (f.element.compareDocumentPosition(h.relatedTarget) & Node.DOCUMENT_POSITION_CONTAINED_BY || x.element.compareDocumentPosition(h.relatedTarget) & Node.DOCUMENT_POSITION_CONTAINED_BY) || c.call(f.element, h)
                    };
                    x.on(k, p)
                }
                b.prototype.on.call(f, k, p || c);
                return f
            };
            p.prototype.onAdd = function() {
                var k = this.textStr;
                this.text.add(this);
                this.attr({
                    text: z(k) ? k : "",
                    x: this.x,
                    y: this.y
                });
                this.box && z(this.anchorX) && this.attr({
                    anchorX: this.anchorX,
                    anchorY: this.anchorY
                })
            };
            p.prototype.rSetter = function(k, c) {
                this.boxAttr(c,
                    k)
            };
            p.prototype.shadow = function(k) {
                k && !this.renderer.styledMode && (this.updateBoxSize(), this.box && this.box.shadow(k));
                return this
            };
            p.prototype.strokeSetter = function(k, c) {
                this.stroke = k;
                this.boxAttr(c, k)
            };
            p.prototype["stroke-widthSetter"] = function(k, c) {
                k && (this.needsBox = !0);
                this["stroke-width"] = k;
                this.boxAttr(c, k)
            };
            p.prototype["text-alignSetter"] = function(k) {
                this.textAlign = k
            };
            p.prototype.textSetter = function(k) {
                "undefined" !== typeof k && this.text.attr({
                    text: k
                });
                this.updateTextPadding()
            };
            p.prototype.updateBoxSize =
                function() {
                    var k = this.text.element.style,
                        c = {},
                        f = this.padding,
                        h = this.bBox = v(this.widthSetting) && v(this.heightSetting) && !this.textAlign || !z(this.text.textStr) ? p.emptyBBox : this.text.getBBox();
                    this.width = this.getPaddedWidth();
                    this.height = (this.heightSetting || h.height || 0) + 2 * f;
                    this.baselineOffset = f + Math.min(this.renderer.fontMetrics(k && k.fontSize, this.text).b, h.height || Infinity);
                    this.needsBox && (this.box || (k = this.box = this.symbolKey ? this.renderer.symbol(this.symbolKey) : this.renderer.rect(), k.addClass(("button" ===
                        this.className ? "" : "highcharts-label-box") + (this.className ? " highcharts-" + this.className + "-box" : "")), k.add(this)), k = this.getCrispAdjust(), c.x = k, c.y = (this.baseline ? -this.baselineOffset : 0) + k, c.width = Math.round(this.width), c.height = Math.round(this.height), this.box.attr(C(c, this.deferredAttr)), this.deferredAttr = {})
                };
            p.prototype.updateTextPadding = function() {
                var c = this.text;
                this.updateBoxSize();
                var h = this.baseline ? 0 : this.baselineOffset,
                    f = q(this.paddingLeft, this.padding);
                z(this.widthSetting) && this.bBox &&
                    ("center" === this.textAlign || "right" === this.textAlign) && (f += {
                        center: .5,
                        right: 1
                    } [this.textAlign] * (this.widthSetting - this.bBox.width));
                if (f !== c.x || h !== c.y) c.attr("x", f), c.hasBoxWidthChanged && (this.bBox = c.getBBox(!0)), "undefined" !== typeof h && c.attr("y", h);
                c.x = f;
                c.y = h
            };
            p.prototype.widthSetter = function(c) {
                this.widthSetting = v(c) ? c : void 0
            };
            p.prototype.getPaddedWidth = function() {
                var c = this.padding,
                    h = q(this.paddingLeft, c);
                c = q(this.paddingRight, c);
                return (this.widthSetting || this.bBox.width || 0) + h + c
            };
            p.prototype.xSetter =
                function(c) {
                    this.x = c;
                    this.alignFactor && (c -= this.alignFactor * this.getPaddedWidth(), this["forceAnimate:x"] = !0);
                    this.xSetting = Math.round(c);
                    this.attr("translateX", this.xSetting)
                };
            p.prototype.ySetter = function(c) {
                this.ySetting = this.y = Math.round(c);
                this.attr("translateY", this.ySetting)
            };
            p.emptyBBox = {
                width: 0,
                height: 0,
                x: 0,
                y: 0
            };
            p.textProps = "color direction fontFamily fontSize fontStyle fontWeight lineHeight textAlign textDecoration textOutline textOverflow width".split(" ");
            return p
        }(b)
    });
    J(b, "Core/Renderer/SVG/TextBuilder.js",
        [b["Core/Globals.js"], b["Core/Utilities.js"], b["Core/Renderer/HTML/AST.js"]],
        function(b, l, B) {
            var w = b.doc,
                z = b.SVG_NS,
                C = l.attr,
                v = l.isString,
                t = l.objectEach,
                q = l.pick;
            return function() {
                function h(c) {
                    var h = c.styles;
                    this.renderer = c.renderer;
                    this.svgElement = c;
                    this.width = c.textWidth;
                    this.textLineHeight = h && h.lineHeight;
                    this.textOutline = h && h.textOutline;
                    this.ellipsis = !(!h || "ellipsis" !== h.textOverflow);
                    this.noWrap = !(!h || "nowrap" !== h.whiteSpace);
                    this.fontSize = h && h.fontSize
                }
                h.prototype.buildSVG = function() {
                    var c =
                        this.svgElement,
                        h = c.element,
                        k = c.renderer,
                        b = q(c.textStr, "").toString(),
                        f = -1 !== b.indexOf("<"),
                        H = h.childNodes,
                        x = H.length;
                    k = this.width && !c.added && k.box;
                    var K = /<br.*?>/g;
                    var l = [b, this.ellipsis, this.noWrap, this.textLineHeight, this.textOutline, this.fontSize, this.width].join();
                    if (l !== c.textCache) {
                        c.textCache = l;
                        for (delete c.actualWidth; x--;) h.removeChild(H[x]);
                        f || this.ellipsis || this.width || -1 !== b.indexOf(" ") && (!this.noWrap || K.test(b)) ? "" !== b && (k && k.appendChild(h), b = new B(b), this.modifyTree(b.nodes), b.addToDOM(c.element),
                            this.modifyDOM(), this.ellipsis && -1 !== (h.textContent || "").indexOf("\u2026") && c.attr("title", this.unescapeEntities(c.textStr || "", ["&lt;", "&gt;"])), k && k.removeChild(h)) : h.appendChild(w.createTextNode(this.unescapeEntities(b)));
                        v(this.textOutline) && c.applyTextOutline && c.applyTextOutline(this.textOutline)
                    }
                };
                h.prototype.modifyDOM = function() {
                    var c = this,
                        h = this.svgElement,
                        k = C(h.element, "x");
                    [].forEach.call(h.element.querySelectorAll("tspan.highcharts-br"), function(f) {
                        f.nextSibling && f.previousSibling && C(f, {
                            dy: c.getLineHeight(f.nextSibling),
                            x: k
                        })
                    });
                    var b = this.width || 0;
                    if (b) {
                        var f = function(f, p) {
                                var x = f.textContent || "",
                                    r = x.replace(/([^\^])-/g, "$1- ").split(" "),
                                    n = !c.noWrap && (1 < r.length || 1 < h.element.childNodes.length),
                                    u = c.getLineHeight(p),
                                    e = 0,
                                    g = h.actualWidth;
                                if (c.ellipsis) x && c.truncate(f, x, void 0, 0, Math.max(0, b - parseInt(c.fontSize || 12, 10)), function(d, a) {
                                    return d.substring(0, a) + "\u2026"
                                });
                                else if (n) {
                                    x = [];
                                    for (n = []; p.firstChild && p.firstChild !== f;) n.push(p.firstChild), p.removeChild(p.firstChild);
                                    for (; r.length;) r.length &&
                                        !c.noWrap && 0 < e && (x.push(f.textContent || ""), f.textContent = r.join(" ").replace(/- /g, "-")), c.truncate(f, void 0, r, 0 === e ? g || 0 : 0, b, function(d, a) {
                                            return r.slice(0, a).join(" ").replace(/- /g, "-")
                                        }), g = h.actualWidth, e++;
                                    n.forEach(function(d) {
                                        p.insertBefore(d, f)
                                    });
                                    x.forEach(function(d) {
                                        p.insertBefore(w.createTextNode(d), f);
                                        d = w.createElementNS(z, "tspan");
                                        d.textContent = "\u200b";
                                        C(d, {
                                            dy: u,
                                            x: k
                                        });
                                        p.insertBefore(d, f)
                                    })
                                }
                            },
                            H = function(c) {
                                [].slice.call(c.childNodes).forEach(function(k) {
                                    k.nodeType === Node.TEXT_NODE ? f(k,
                                        c) : (-1 !== k.className.baseVal.indexOf("highcharts-br") && (h.actualWidth = 0), H(k))
                                })
                            };
                        H(h.element)
                    }
                };
                h.prototype.getLineHeight = function(c) {
                    var h;
                    c = c.nodeType === Node.TEXT_NODE ? c.parentElement : c;
                    this.renderer.styledMode || (h = c && /(px|em)$/.test(c.style.fontSize) ? c.style.fontSize : this.fontSize || this.renderer.style.fontSize || 12);
                    return this.textLineHeight ? parseInt(this.textLineHeight.toString(), 10) : this.renderer.fontMetrics(h, c || this.svgElement.element).h
                };
                h.prototype.modifyTree = function(c) {
                    var h = this,
                        k = function(p,
                            f) {
                            var H = p.tagName,
                                x = h.renderer.styledMode,
                                b = p.attributes || {};
                            if ("b" === H || "strong" === H) x ? b["class"] = "highcharts-strong" : b.style = "font-weight:bold;" + (b.style || "");
                            else if ("i" === H || "em" === H) x ? b["class"] = "highcharts-emphasized" : b.style = "font-style:italic;" + (b.style || "");
                            v(b.style) && (b.style = b.style.replace(/(;| |^)color([ :])/, "$1fill$2"));
                            "br" === H && (b["class"] = "highcharts-br", p.textContent = "\u200b", (f = c[f + 1]) && f.textContent && (f.textContent = f.textContent.replace(/^ +/gm, "")));
                            "#text" !== H && "a" !== H && (p.tagName =
                                "tspan");
                            p.attributes = b;
                            p.children && p.children.filter(function(f) {
                                return "#text" !== f.tagName
                            }).forEach(k)
                        };
                    for (c.forEach(k); c[0] && "tspan" === c[0].tagName && !c[0].children;) c.splice(0, 1)
                };
                h.prototype.truncate = function(c, h, k, b, f, H) {
                    var x = this.svgElement,
                        p = x.renderer,
                        q = x.rotation,
                        r = [],
                        n = k ? 1 : 0,
                        u = (h || k || "").length,
                        e = u,
                        g, d = function(a, d) {
                            d = d || a;
                            var e = c.parentNode;
                            if (e && "undefined" === typeof r[d])
                                if (e.getSubStringLength) try {
                                    r[d] = b + e.getSubStringLength(0, k ? d + 1 : d)
                                } catch (A) {
                                    ""
                                } else p.getSpanWidth && (c.textContent =
                                    H(h || k, a), r[d] = b + p.getSpanWidth(x, c));
                            return r[d]
                        };
                    x.rotation = 0;
                    var a = d(c.textContent.length);
                    if (b + a > f) {
                        for (; n <= u;) e = Math.ceil((n + u) / 2), k && (g = H(k, e)), a = d(e, g && g.length - 1), n === u ? n = u + 1 : a > f ? u = e - 1 : n = e;
                        0 === u ? c.textContent = "" : h && u === h.length - 1 || (c.textContent = g || H(h || k, e))
                    }
                    k && k.splice(0, e);
                    x.actualWidth = a;
                    x.rotation = q
                };
                h.prototype.unescapeEntities = function(c, h) {
                    t(this.renderer.escapes, function(k, p) {
                        h && -1 !== h.indexOf(k) || (c = c.toString().replace(new RegExp(k, "g"), p))
                    });
                    return c
                };
                return h
            }()
        });
    J(b, "Core/Renderer/SVG/SVGRenderer.js",
        [b["Core/Color/Color.js"], b["Core/Globals.js"], b["Core/Color/Palette.js"], b["Core/Renderer/SVG/SVGElement.js"], b["Core/Renderer/SVG/SVGLabel.js"], b["Core/Renderer/HTML/AST.js"], b["Core/Renderer/SVG/TextBuilder.js"], b["Core/Utilities.js"]],
        function(b, l, B, y, z, C, v, t) {
            var q = t.addEvent,
                h = t.attr,
                c = t.createElement,
                p = t.css,
                k = t.defined,
                G = t.destroyObjectProperties,
                f = t.extend,
                H = t.isArray,
                x = t.isNumber,
                K = t.isObject,
                L = t.isString,
                r = t.merge,
                n = t.pick,
                u = t.pInt,
                e = t.uniqueKey,
                g = l.charts,
                d = l.deg2rad,
                a = l.doc,
                m = l.isFirefox,
                E = l.isMS,
                I = l.isWebKit;
            t = l.noop;
            var A = l.SVG_NS,
                N = l.symbolSizes,
                R = l.win,
                w, T = function() {
                    function A(a, d, e, g, m, f, n) {
                        this.width = this.url = this.style = this.isSVG = this.imgCount = this.height = this.gradients = this.globalAnimation = this.defs = this.chartIndex = this.cacheKeys = this.cache = this.boxWrapper = this.box = this.alignedObjects = void 0;
                        this.init(a, d, e, g, m, f, n)
                    }
                    A.prototype.init = function(d, e, g, f, n, D, c) {
                        var F = this.createElement("svg").attr({
                            version: "1.1",
                            "class": "highcharts-root"
                        });
                        c || F.css(this.getStyle(f));
                        f = F.element;
                        d.appendChild(f);
                        h(d, "dir", "ltr"); - 1 === d.innerHTML.indexOf("xmlns") && h(f, "xmlns", this.SVG_NS);
                        this.isSVG = !0;
                        this.box = f;
                        this.boxWrapper = F;
                        this.alignedObjects = [];
                        this.url = this.getReferenceURL();
                        this.createElement("desc").add().element.appendChild(a.createTextNode("Created with Highcharts 9.0.1"));
                        this.defs = this.createElement("defs").add();
                        this.allowHTML = D;
                        this.forExport = n;
                        this.styledMode = c;
                        this.gradients = {};
                        this.cache = {};
                        this.cacheKeys = [];
                        this.imgCount = 0;
                        this.setSize(e, g, !1);
                        var k;
                        m && d.getBoundingClientRect &&
                            (e = function() {
                                p(d, {
                                    left: 0,
                                    top: 0
                                });
                                k = d.getBoundingClientRect();
                                p(d, {
                                    left: Math.ceil(k.left) - k.left + "px",
                                    top: Math.ceil(k.top) - k.top + "px"
                                })
                            }, e(), this.unSubPixelFix = q(R, "resize", e))
                    };
                    A.prototype.definition = function(a) {
                        return (new C([a])).addToDOM(this.defs.element)
                    };
                    A.prototype.getReferenceURL = function() {
                        if ((m || I) && a.getElementsByTagName("base").length) {
                            if (!k(w)) {
                                var d = e();
                                d = (new C([{
                                    tagName: "svg",
                                    attributes: {
                                        width: 8,
                                        height: 8
                                    },
                                    children: [{
                                        tagName: "defs",
                                        children: [{
                                            tagName: "clipPath",
                                            attributes: {
                                                id: d
                                            },
                                            children: [{
                                                tagName: "rect",
                                                attributes: {
                                                    width: 4,
                                                    height: 4
                                                }
                                            }]
                                        }]
                                    }, {
                                        tagName: "rect",
                                        attributes: {
                                            id: "hitme",
                                            width: 8,
                                            height: 8,
                                            "clip-path": "url(#" + d + ")",
                                            fill: "rgba(0,0,0,0.001)"
                                        }
                                    }]
                                }])).addToDOM(a.body);
                                p(d, {
                                    position: "fixed",
                                    top: 0,
                                    left: 0,
                                    zIndex: 9E5
                                });
                                var g = a.elementFromPoint(6, 6);
                                w = "hitme" === (g && g.id);
                                a.body.removeChild(d)
                            }
                            if (w) return R.location.href.split("#")[0].replace(/<[^>]*>/g, "").replace(/([\('\)])/g, "\\$1").replace(/ /g, "%20")
                        }
                        return ""
                    };
                    A.prototype.getStyle = function(a) {
                        return this.style = f({
                            fontFamily: '"Lucida Grande", "Lucida Sans Unicode", Arial, Helvetica, sans-serif',
                            fontSize: "12px"
                        }, a)
                    };
                    A.prototype.setStyle = function(a) {
                        this.boxWrapper.css(this.getStyle(a))
                    };
                    A.prototype.isHidden = function() {
                        return !this.boxWrapper.getBBox().width
                    };
                    A.prototype.destroy = function() {
                        var a = this.defs;
                        this.box = null;
                        this.boxWrapper = this.boxWrapper.destroy();
                        G(this.gradients || {});
                        this.gradients = null;
                        a && (this.defs = a.destroy());
                        this.unSubPixelFix && this.unSubPixelFix();
                        return this.alignedObjects = null
                    };
                    A.prototype.createElement = function(a) {
                        var d = new this.Element;
                        d.init(this, a);
                        return d
                    };
                    A.prototype.getRadialAttr =
                        function(a, d) {
                            return {
                                cx: a[0] - a[2] / 2 + d.cx * a[2],
                                cy: a[1] - a[2] / 2 + d.cy * a[2],
                                r: d.r * a[2]
                            }
                        };
                    A.prototype.buildText = function(a) {
                        (new v(a)).buildSVG()
                    };
                    A.prototype.getContrast = function(a) {
                        a = b.parse(a).rgba;
                        a[0] *= 1;
                        a[1] *= 1.2;
                        a[2] *= .5;
                        return 459 < a[0] + a[1] + a[2] ? "#000000" : "#FFFFFF"
                    };
                    A.prototype.button = function(a, d, e, g, m, n, c, k, u, h) {
                        var F = this.label(a, d, e, u, void 0, void 0, h, void 0, "button"),
                            D = 0,
                            W = this.styledMode,
                            A = m ? r(m) : {};
                        a = A && A.style || {};
                        A = C.filterUserAttributes(A);
                        F.attr(r({
                            padding: 8,
                            r: 2
                        }, A));
                        if (!W) {
                            A = r({
                                fill: B.neutralColor3,
                                stroke: B.neutralColor20,
                                "stroke-width": 1,
                                style: {
                                    color: B.neutralColor80,
                                    cursor: "pointer",
                                    fontWeight: "normal"
                                }
                            }, {
                                style: a
                            }, A);
                            var P = A.style;
                            delete A.style;
                            n = r(A, {
                                fill: B.neutralColor10
                            }, C.filterUserAttributes(n || {}));
                            var I = n.style;
                            delete n.style;
                            c = r(A, {
                                fill: B.highlightColor10,
                                style: {
                                    color: B.neutralColor100,
                                    fontWeight: "bold"
                                }
                            }, C.filterUserAttributes(c || {}));
                            var x = c.style;
                            delete c.style;
                            k = r(A, {
                                style: {
                                    color: B.neutralColor20
                                }
                            }, C.filterUserAttributes(k || {}));
                            var S = k.style;
                            delete k.style
                        }
                        q(F.element, E ? "mouseover" :
                            "mouseenter",
                            function() {
                                3 !== D && F.setState(1)
                            });
                        q(F.element, E ? "mouseout" : "mouseleave", function() {
                            3 !== D && F.setState(D)
                        });
                        F.setState = function(a) {
                            1 !== a && (F.state = D = a);
                            F.removeClass(/highcharts-button-(normal|hover|pressed|disabled)/).addClass("highcharts-button-" + ["normal", "hover", "pressed", "disabled"][a || 0]);
                            W || F.attr([A, n, c, k][a || 0]).css([P, I, x, S][a || 0])
                        };
                        W || F.attr(A).css(f({
                            cursor: "default"
                        }, P));
                        return F.on("click", function(a) {
                            3 !== D && g.call(F, a)
                        })
                    };
                    A.prototype.crispLine = function(a, d, e) {
                        void 0 === e &&
                            (e = "round");
                        var g = a[0],
                            m = a[1];
                        g[1] === m[1] && (g[1] = m[1] = Math[e](g[1]) - d % 2 / 2);
                        g[2] === m[2] && (g[2] = m[2] = Math[e](g[2]) + d % 2 / 2);
                        return a
                    };
                    A.prototype.path = function(a) {
                        var d = this.styledMode ? {} : {
                            fill: "none"
                        };
                        H(a) ? d.d = a : K(a) && f(d, a);
                        return this.createElement("path").attr(d)
                    };
                    A.prototype.circle = function(a, d, e) {
                        a = K(a) ? a : "undefined" === typeof a ? {} : {
                            x: a,
                            y: d,
                            r: e
                        };
                        d = this.createElement("circle");
                        d.xSetter = d.ySetter = function(a, d, e) {
                            e.setAttribute("c" + d, a)
                        };
                        return d.attr(a)
                    };
                    A.prototype.arc = function(a, d, e, g, m, f) {
                        K(a) ?
                            (g = a, d = g.y, e = g.r, a = g.x) : g = {
                                innerR: g,
                                start: m,
                                end: f
                            };
                        a = this.symbol("arc", a, d, e, e, g);
                        a.r = e;
                        return a
                    };
                    A.prototype.rect = function(a, d, e, g, m, f) {
                        m = K(a) ? a.r : m;
                        var n = this.createElement("rect");
                        a = K(a) ? a : "undefined" === typeof a ? {} : {
                            x: a,
                            y: d,
                            width: Math.max(e, 0),
                            height: Math.max(g, 0)
                        };
                        this.styledMode || ("undefined" !== typeof f && (a.strokeWidth = f, a = n.crisp(a)), a.fill = "none");
                        m && (a.r = m);
                        n.rSetter = function(a, d, e) {
                            n.r = a;
                            h(e, {
                                rx: a,
                                ry: a
                            })
                        };
                        n.rGetter = function() {
                            return n.r
                        };
                        return n.attr(a)
                    };
                    A.prototype.setSize = function(a, d,
                        e) {
                        var g = this.alignedObjects,
                            m = g.length;
                        this.width = a;
                        this.height = d;
                        for (this.boxWrapper.animate({
                                width: a,
                                height: d
                            }, {
                                step: function() {
                                    this.attr({
                                        viewBox: "0 0 " + this.attr("width") + " " + this.attr("height")
                                    })
                                },
                                duration: n(e, !0) ? void 0 : 0
                            }); m--;) g[m].align()
                    };
                    A.prototype.g = function(a) {
                        var d = this.createElement("g");
                        return a ? d.attr({
                            "class": "highcharts-" + a
                        }) : d
                    };
                    A.prototype.image = function(a, d, e, g, m, n) {
                        var D = {
                                preserveAspectRatio: "none"
                            },
                            F = function(a, d) {
                                a.setAttributeNS ? a.setAttributeNS("http://www.w3.org/1999/xlink",
                                    "href", d) : a.setAttribute("hc-svg-href", d)
                            },
                            c = function(d) {
                                F(k.element, a);
                                n.call(k, d)
                            };
                        1 < arguments.length && f(D, {
                            x: d,
                            y: e,
                            width: g,
                            height: m
                        });
                        var k = this.createElement("image").attr(D);
                        n ? (F(k.element, "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="), D = new R.Image, q(D, "load", c), D.src = a, D.complete && c({})) : F(k.element, a);
                        return k
                    };
                    A.prototype.symbol = function(d, e, m, u, E, D) {
                        var F = this,
                            h = /^url\((.*?)\)$/,
                            A = h.test(d),
                            W = !A && (this.symbols[d] ? d : "circle"),
                            I = W && this.symbols[W],
                            x;
                        if (I) {
                            "number" ===
                            typeof e && (x = I.call(this.symbols, Math.round(e || 0), Math.round(m || 0), u || 0, E || 0, D));
                            var r = this.path(x);
                            F.styledMode || r.attr("fill", "none");
                            f(r, {
                                symbolName: W,
                                x: e,
                                y: m,
                                width: u,
                                height: E
                            });
                            D && f(r, D)
                        } else if (A) {
                            var b = d.match(h)[1];
                            r = this.image(b);
                            r.imgwidth = n(N[b] && N[b].width, D && D.width);
                            r.imgheight = n(N[b] && N[b].height, D && D.height);
                            var H = function() {
                                r.attr({
                                    width: r.width,
                                    height: r.height
                                })
                            };
                            ["width", "height"].forEach(function(a) {
                                r[a + "Setter"] = function(a, d) {
                                    var e = {},
                                        g = this["img" + d],
                                        m = "width" === d ? "translateX" :
                                        "translateY";
                                    this[d] = a;
                                    k(g) && (D && "within" === D.backgroundSize && this.width && this.height && (g = Math.round(g * Math.min(this.width / this.imgwidth, this.height / this.imgheight))), this.element && this.element.setAttribute(d, g), this.alignByTranslate || (e[m] = ((this[d] || 0) - g) / 2, this.attr(e)))
                                }
                            });
                            k(e) && r.attr({
                                x: e,
                                y: m
                            });
                            r.isImg = !0;
                            k(r.imgwidth) && k(r.imgheight) ? H() : (r.attr({
                                width: 0,
                                height: 0
                            }), c("img", {
                                onload: function() {
                                    var d = g[F.chartIndex];
                                    0 === this.width && (p(this, {
                                        position: "absolute",
                                        top: "-999em"
                                    }), a.body.appendChild(this));
                                    N[b] = {
                                        width: this.width,
                                        height: this.height
                                    };
                                    r.imgwidth = this.width;
                                    r.imgheight = this.height;
                                    r.element && H();
                                    this.parentNode && this.parentNode.removeChild(this);
                                    F.imgCount--;
                                    if (!F.imgCount && d && !d.hasLoaded) d.onload()
                                },
                                src: b
                            }), this.imgCount++)
                        }
                        return r
                    };
                    A.prototype.clipRect = function(a, d, g, m) {
                        var n = e() + "-",
                            f = this.createElement("clipPath").attr({
                                id: n
                            }).add(this.defs);
                        a = this.rect(a, d, g, m, 0).add(f);
                        a.id = n;
                        a.clipPath = f;
                        a.count = 0;
                        return a
                    };
                    A.prototype.text = function(a, d, e, g) {
                        var m = {};
                        if (g && (this.allowHTML || !this.forExport)) return this.html(a,
                            d, e);
                        m.x = Math.round(d || 0);
                        e && (m.y = Math.round(e));
                        k(a) && (m.text = a);
                        a = this.createElement("text").attr(m);
                        g || (a.xSetter = function(a, d, e) {
                            var g = e.getElementsByTagName("tspan"),
                                m = e.getAttribute(d),
                                n;
                            for (n = 0; n < g.length; n++) {
                                var f = g[n];
                                f.getAttribute(d) === m && f.setAttribute(d, a)
                            }
                            e.setAttribute(d, a)
                        });
                        return a
                    };
                    A.prototype.fontMetrics = function(a, d) {
                        a = !this.styledMode && /px/.test(a) || !R.getComputedStyle ? a || d && d.style && d.style.fontSize || this.style && this.style.fontSize : d && y.prototype.getStyle.call(d, "font-size");
                        a = /px/.test(a) ? u(a) : 12;
                        d = 24 > a ? a + 3 : Math.round(1.2 * a);
                        return {
                            h: d,
                            b: Math.round(.8 * d),
                            f: a
                        }
                    };
                    A.prototype.rotCorr = function(a, e, g) {
                        var m = a;
                        e && g && (m = Math.max(m * Math.cos(e * d), 4));
                        return {
                            x: -a / 3 * Math.sin(e * d),
                            y: m
                        }
                    };
                    A.prototype.pathToSegments = function(a) {
                        for (var d = [], e = [], g = {
                                A: 8,
                                C: 7,
                                H: 2,
                                L: 3,
                                M: 3,
                                Q: 5,
                                S: 5,
                                T: 3,
                                V: 2
                            }, m = 0; m < a.length; m++) L(e[0]) && x(a[m]) && e.length === g[e[0].toUpperCase()] && a.splice(m, 0, e[0].replace("M", "L").replace("m", "l")), "string" === typeof a[m] && (e.length && d.push(e.slice(0)), e.length = 0), e.push(a[m]);
                        d.push(e.slice(0));
                        return d
                    };
                    A.prototype.label = function(a, d, e, g, m, n, f, c, k) {
                        return new z(this, a, d, e, g, m, n, f, c, k)
                    };
                    return A
                }();
            T.prototype.Element = y;
            T.prototype.SVG_NS = A;
            T.prototype.draw = t;
            T.prototype.escapes = {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                "'": "&#39;",
                '"': "&quot;"
            };
            T.prototype.symbols = {
                circle: function(a, d, e, g) {
                    return this.arc(a + e / 2, d + g / 2, e / 2, g / 2, {
                        start: .5 * Math.PI,
                        end: 2.5 * Math.PI,
                        open: !1
                    })
                },
                square: function(a, d, e, g) {
                    return [
                        ["M", a, d],
                        ["L", a + e, d],
                        ["L", a + e, d + g],
                        ["L", a, d + g],
                        ["Z"]
                    ]
                },
                triangle: function(a,
                    d, e, g) {
                    return [
                        ["M", a + e / 2, d],
                        ["L", a + e, d + g],
                        ["L", a, d + g],
                        ["Z"]
                    ]
                },
                "triangle-down": function(a, d, e, g) {
                    return [
                        ["M", a, d],
                        ["L", a + e, d],
                        ["L", a + e / 2, d + g],
                        ["Z"]
                    ]
                },
                diamond: function(a, d, e, g) {
                    return [
                        ["M", a + e / 2, d],
                        ["L", a + e, d + g / 2],
                        ["L", a + e / 2, d + g],
                        ["L", a, d + g / 2],
                        ["Z"]
                    ]
                },
                arc: function(a, d, e, g, m) {
                    var f = [];
                    if (m) {
                        var D = m.start || 0,
                            c = m.end || 0,
                            F = m.r || e;
                        e = m.r || g || e;
                        var u = .001 > Math.abs(c - D - 2 * Math.PI);
                        c -= .001;
                        g = m.innerR;
                        u = n(m.open, u);
                        var E = Math.cos(D),
                            h = Math.sin(D),
                            A = Math.cos(c),
                            I = Math.sin(c);
                        D = n(m.longArc, .001 > c - D - Math.PI ? 0 : 1);
                        f.push(["M", a + F * E, d + e * h], ["A", F, e, 0, D, n(m.clockwise, 1), a + F * A, d + e * I]);
                        k(g) && f.push(u ? ["M", a + g * A, d + g * I] : ["L", a + g * A, d + g * I], ["A", g, g, 0, D, k(m.clockwise) ? 1 - m.clockwise : 0, a + g * E, d + g * h]);
                        u || f.push(["Z"])
                    }
                    return f
                },
                callout: function(a, d, e, g, m) {
                    var f = Math.min(m && m.r || 0, e, g),
                        n = f + 6,
                        c = m && m.anchorX;
                    m = m && m.anchorY || 0;
                    var k = [
                        ["M", a + f, d],
                        ["L", a + e - f, d],
                        ["C", a + e, d, a + e, d, a + e, d + f],
                        ["L", a + e, d + g - f],
                        ["C", a + e, d + g, a + e, d + g, a + e - f, d + g],
                        ["L", a + f, d + g],
                        ["C", a, d + g, a, d + g, a, d + g - f],
                        ["L", a, d + f],
                        ["C", a, d, a, d, a + f, d]
                    ];
                    if (!x(c)) return k;
                    a +
                        c >= e ? m > d + n && m < d + g - n ? k.splice(3, 1, ["L", a + e, m - 6], ["L", a + e + 6, m], ["L", a + e, m + 6], ["L", a + e, d + g - f]) : k.splice(3, 1, ["L", a + e, g / 2], ["L", c, m], ["L", a + e, g / 2], ["L", a + e, d + g - f]) : 0 >= a + c ? m > d + n && m < d + g - n ? k.splice(7, 1, ["L", a, m + 6], ["L", a - 6, m], ["L", a, m - 6], ["L", a, d + f]) : k.splice(7, 1, ["L", a, g / 2], ["L", c, m], ["L", a, g / 2], ["L", a, d + f]) : m && m > g && c > a + n && c < a + e - n ? k.splice(5, 1, ["L", c + 6, d + g], ["L", c, d + g + 6], ["L", c - 6, d + g], ["L", a + f, d + g]) : m && 0 > m && c > a + n && c < a + e - n && k.splice(1, 1, ["L", c - 6, d], ["L", c, d - 6], ["L", c + 6, d], ["L", e - f, d]);
                    return k
                }
            };
            l.SVGRenderer =
                T;
            l.Renderer = l.SVGRenderer;
            return l.Renderer
        });
    J(b, "Core/Renderer/HTML/HTMLElement.js", [b["Core/Globals.js"], b["Core/Renderer/SVG/SVGElement.js"], b["Core/Utilities.js"]], function(b, l, B) {
        var w = B.css,
            z = B.defined,
            C = B.extend,
            v = B.pick,
            t = B.pInt,
            q = b.isFirefox;
        C(l.prototype, {
            htmlCss: function(h) {
                var c = "SPAN" === this.element.tagName && h && "width" in h,
                    b = v(c && h.width, void 0);
                if (c) {
                    delete h.width;
                    this.textWidth = b;
                    var k = !0
                }
                h && "ellipsis" === h.textOverflow && (h.whiteSpace = "nowrap", h.overflow = "hidden");
                this.styles = C(this.styles,
                    h);
                w(this.element, h);
                k && this.htmlUpdateTransform();
                return this
            },
            htmlGetBBox: function() {
                var h = this.element;
                return {
                    x: h.offsetLeft,
                    y: h.offsetTop,
                    width: h.offsetWidth,
                    height: h.offsetHeight
                }
            },
            htmlUpdateTransform: function() {
                if (this.added) {
                    var h = this.renderer,
                        c = this.element,
                        b = this.translateX || 0,
                        k = this.translateY || 0,
                        q = this.x || 0,
                        f = this.y || 0,
                        H = this.textAlign || "left",
                        x = {
                            left: 0,
                            center: .5,
                            right: 1
                        } [H],
                        l = this.styles,
                        L = l && l.whiteSpace;
                    w(c, {
                        marginLeft: b,
                        marginTop: k
                    });
                    !h.styledMode && this.shadows && this.shadows.forEach(function(e) {
                        w(e, {
                            marginLeft: b + 1,
                            marginTop: k + 1
                        })
                    });
                    this.inverted && [].forEach.call(c.childNodes, function(e) {
                        h.invertChild(e, c)
                    });
                    if ("SPAN" === c.tagName) {
                        l = this.rotation;
                        var r = this.textWidth && t(this.textWidth),
                            n = [l, H, c.innerHTML, this.textWidth, this.textAlign].join(),
                            u;
                        (u = r !== this.oldTextWidth) && !(u = r > this.oldTextWidth) && ((u = this.textPxLength) || (w(c, {
                            width: "",
                            whiteSpace: L || "nowrap"
                        }), u = c.offsetWidth), u = u > r);
                        u && (/[ \-]/.test(c.textContent || c.innerText) || "ellipsis" === c.style.textOverflow) ? (w(c, {
                            width: r + "px",
                            display: "block",
                            whiteSpace: L || "normal"
                        }), this.oldTextWidth = r, this.hasBoxWidthChanged = !0) : this.hasBoxWidthChanged = !1;
                        n !== this.cTT && (L = h.fontMetrics(c.style.fontSize, c).b, !z(l) || l === (this.oldRotation || 0) && H === this.oldAlign || this.setSpanRotation(l, x, L), this.getSpanCorrection(!z(l) && this.textPxLength || c.offsetWidth, L, x, l, H));
                        w(c, {
                            left: q + (this.xCorr || 0) + "px",
                            top: f + (this.yCorr || 0) + "px"
                        });
                        this.cTT = n;
                        this.oldRotation = l;
                        this.oldAlign = H
                    }
                } else this.alignOnAdd = !0
            },
            setSpanRotation: function(h, c, b) {
                var k = {},
                    p = this.renderer.getTransformKey();
                k[p] = k.transform = "rotate(" + h + "deg)";
                k[p + (q ? "Origin" : "-origin")] = k.transformOrigin = 100 * c + "% " + b + "px";
                w(this.element, k)
            },
            getSpanCorrection: function(h, c, b) {
                this.xCorr = -h * b;
                this.yCorr = -c
            }
        });
        return l
    });
    J(b, "Core/Renderer/HTML/HTMLRenderer.js", [b["Core/Globals.js"], b["Core/Renderer/HTML/AST.js"], b["Core/Renderer/SVG/SVGElement.js"], b["Core/Renderer/SVG/SVGRenderer.js"], b["Core/Utilities.js"]], function(b, l, B, y, z) {
        var w = b.isFirefox,
            v = b.isMS,
            t = b.isWebKit,
            q = b.win,
            h = z.attr,
            c = z.createElement,
            p = z.extend,
            k = z.pick;
        p(y.prototype, {
            getTransformKey: function() {
                return v && !/Edge/.test(q.navigator.userAgent) ? "-ms-transform" : t ? "-webkit-transform" : w ? "MozTransform" : q.opera ? "-o-transform" : ""
            },
            html: function(b, f, H) {
                var x = this.createElement("span"),
                    q = x.element,
                    L = x.renderer,
                    r = L.isSVG,
                    n = function(f, e) {
                        ["opacity", "visibility"].forEach(function(g) {
                            f[g + "Setter"] = function(d, a, m) {
                                var n = f.div ? f.div.style : e;
                                B.prototype[g + "Setter"].call(this, d, a, m);
                                n && (n[a] = d)
                            }
                        });
                        f.addedSetters = !0
                    };
                x.textSetter = function(f) {
                    f !== this.textStr && (delete this.bBox,
                        delete this.oldTextWidth, l.setElementHTML(this.element, k(f, "")), this.textStr = f, x.doTransform = !0)
                };
                r && n(x, x.element.style);
                x.xSetter = x.ySetter = x.alignSetter = x.rotationSetter = function(f, e) {
                    "align" === e ? x.alignValue = x.textAlign = f : x[e] = f;
                    x.doTransform = !0
                };
                x.afterSetters = function() {
                    this.doTransform && (this.htmlUpdateTransform(), this.doTransform = !1)
                };
                x.attr({
                    text: b,
                    x: Math.round(f),
                    y: Math.round(H)
                }).css({
                    position: "absolute"
                });
                L.styledMode || x.css({
                    fontFamily: this.style.fontFamily,
                    fontSize: this.style.fontSize
                });
                q.style.whiteSpace = "nowrap";
                x.css = x.htmlCss;
                r && (x.add = function(f) {
                    var e = L.box.parentNode,
                        g = [];
                    if (this.parentGroup = f) {
                        var d = f.div;
                        if (!d) {
                            for (; f;) g.push(f), f = f.parentGroup;
                            g.reverse().forEach(function(a) {
                                function m(d, e) {
                                    a[e] = d;
                                    "translateX" === e ? u.left = d + "px" : u.top = d + "px";
                                    a.doTransform = !0
                                }
                                var f = h(a.element, "class"),
                                    k = a.styles || {};
                                d = a.div = a.div || c("div", f ? {
                                    className: f
                                } : void 0, {
                                    position: "absolute",
                                    left: (a.translateX || 0) + "px",
                                    top: (a.translateY || 0) + "px",
                                    display: a.display,
                                    opacity: a.opacity,
                                    cursor: k.cursor,
                                    pointerEvents: k.pointerEvents
                                }, d || e);
                                var u = d.style;
                                p(a, {
                                    classSetter: function(a) {
                                        return function(d) {
                                            this.element.setAttribute("class", d);
                                            a.className = d
                                        }
                                    }(d),
                                    on: function() {
                                        g[0].div && x.on.apply({
                                            element: g[0].div
                                        }, arguments);
                                        return a
                                    },
                                    translateXSetter: m,
                                    translateYSetter: m
                                });
                                a.addedSetters || n(a)
                            })
                        }
                    } else d = e;
                    d.appendChild(q);
                    x.added = !0;
                    x.alignOnAdd && x.htmlUpdateTransform();
                    return x
                });
                return x
            }
        });
        return y
    });
    J(b, "Core/Time.js", [b["Core/Globals.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = b.win,
            y = l.defined,
            z = l.error,
            C = l.extend,
            v = l.isObject,
            t = l.merge,
            q = l.objectEach,
            h = l.pad,
            c = l.pick,
            p = l.splat,
            k = l.timeUnits;
        "";
        l = function() {
            function l(f) {
                this.options = {};
                this.variableTimezone = this.useUTC = !1;
                this.Date = w.Date;
                this.getTimezoneOffset = this.timezoneOffsetFunction();
                this.update(f)
            }
            l.prototype.get = function(f, c) {
                if (this.variableTimezone || this.timezoneOffset) {
                    var k = c.getTime(),
                        h = k - this.getTimezoneOffset(c);
                    c.setTime(h);
                    f = c["getUTC" + f]();
                    c.setTime(k);
                    return f
                }
                return this.useUTC ? c["getUTC" + f]() : c["get" + f]()
            };
            l.prototype.set =
                function(f, c, k) {
                    if (this.variableTimezone || this.timezoneOffset) {
                        if ("Milliseconds" === f || "Seconds" === f || "Minutes" === f && 0 === this.getTimezoneOffset(c) % 36E5) return c["setUTC" + f](k);
                        var h = this.getTimezoneOffset(c);
                        h = c.getTime() - h;
                        c.setTime(h);
                        c["setUTC" + f](k);
                        f = this.getTimezoneOffset(c);
                        h = c.getTime() + f;
                        return c.setTime(h)
                    }
                    return this.useUTC ? c["setUTC" + f](k) : c["set" + f](k)
                };
            l.prototype.update = function(f) {
                var k = c(f && f.useUTC, !0);
                this.options = f = t(!0, this.options || {}, f);
                this.Date = f.Date || w.Date || Date;
                this.timezoneOffset =
                    (this.useUTC = k) && f.timezoneOffset;
                this.getTimezoneOffset = this.timezoneOffsetFunction();
                this.variableTimezone = k && !(!f.getTimezoneOffset && !f.timezone)
            };
            l.prototype.makeTime = function(f, k, h, p, q, r) {
                if (this.useUTC) {
                    var n = this.Date.UTC.apply(0, arguments);
                    var u = this.getTimezoneOffset(n);
                    n += u;
                    var e = this.getTimezoneOffset(n);
                    u !== e ? n += e - u : u - 36E5 !== this.getTimezoneOffset(n - 36E5) || b.isSafari || (n -= 36E5)
                } else n = (new this.Date(f, k, c(h, 1), c(p, 0), c(q, 0), c(r, 0))).getTime();
                return n
            };
            l.prototype.timezoneOffsetFunction =
                function() {
                    var f = this,
                        c = this.options,
                        k = c.moment || w.moment;
                    if (!this.useUTC) return function(f) {
                        return 6E4 * (new Date(f.toString())).getTimezoneOffset()
                    };
                    if (c.timezone) {
                        if (k) return function(f) {
                            return 6E4 * -k.tz(f, c.timezone).utcOffset()
                        };
                        z(25)
                    }
                    return this.useUTC && c.getTimezoneOffset ? function(f) {
                        return 6E4 * c.getTimezoneOffset(f.valueOf())
                    } : function() {
                        return 6E4 * (f.timezoneOffset || 0)
                    }
                };
            l.prototype.dateFormat = function(f, k, x) {
                var p;
                if (!y(k) || isNaN(k)) return (null === (p = b.defaultOptions.lang) || void 0 === p ? void 0 :
                    p.invalidDate) || "";
                f = c(f, "%Y-%m-%d %H:%M:%S");
                var l = this;
                p = new this.Date(k);
                var r = this.get("Hours", p),
                    n = this.get("Day", p),
                    u = this.get("Date", p),
                    e = this.get("Month", p),
                    g = this.get("FullYear", p),
                    d = b.defaultOptions.lang,
                    a = null === d || void 0 === d ? void 0 : d.weekdays,
                    m = null === d || void 0 === d ? void 0 : d.shortWeekdays;
                p = C({
                    a: m ? m[n] : a[n].substr(0, 3),
                    A: a[n],
                    d: h(u),
                    e: h(u, 2, " "),
                    w: n,
                    b: d.shortMonths[e],
                    B: d.months[e],
                    m: h(e + 1),
                    o: e + 1,
                    y: g.toString().substr(2, 2),
                    Y: g,
                    H: h(r),
                    k: r,
                    I: h(r % 12 || 12),
                    l: r % 12 || 12,
                    M: h(this.get("Minutes",
                        p)),
                    p: 12 > r ? "AM" : "PM",
                    P: 12 > r ? "am" : "pm",
                    S: h(p.getSeconds()),
                    L: h(Math.floor(k % 1E3), 3)
                }, b.dateFormats);
                q(p, function(a, d) {
                    for (; - 1 !== f.indexOf("%" + d);) f = f.replace("%" + d, "function" === typeof a ? a.call(l, k) : a)
                });
                return x ? f.substr(0, 1).toUpperCase() + f.substr(1) : f
            };
            l.prototype.resolveDTLFormat = function(f) {
                return v(f, !0) ? f : (f = p(f), {
                    main: f[0],
                    from: f[1],
                    to: f[2]
                })
            };
            l.prototype.getTimeTicks = function(f, h, b, p) {
                var x = this,
                    r = [],
                    n = {};
                var u = new x.Date(h);
                var e = f.unitRange,
                    g = f.count || 1,
                    d;
                p = c(p, 1);
                if (y(h)) {
                    x.set("Milliseconds",
                        u, e >= k.second ? 0 : g * Math.floor(x.get("Milliseconds", u) / g));
                    e >= k.second && x.set("Seconds", u, e >= k.minute ? 0 : g * Math.floor(x.get("Seconds", u) / g));
                    e >= k.minute && x.set("Minutes", u, e >= k.hour ? 0 : g * Math.floor(x.get("Minutes", u) / g));
                    e >= k.hour && x.set("Hours", u, e >= k.day ? 0 : g * Math.floor(x.get("Hours", u) / g));
                    e >= k.day && x.set("Date", u, e >= k.month ? 1 : Math.max(1, g * Math.floor(x.get("Date", u) / g)));
                    if (e >= k.month) {
                        x.set("Month", u, e >= k.year ? 0 : g * Math.floor(x.get("Month", u) / g));
                        var a = x.get("FullYear", u)
                    }
                    e >= k.year && x.set("FullYear",
                        u, a - a % g);
                    e === k.week && (a = x.get("Day", u), x.set("Date", u, x.get("Date", u) - a + p + (a < p ? -7 : 0)));
                    a = x.get("FullYear", u);
                    p = x.get("Month", u);
                    var m = x.get("Date", u),
                        E = x.get("Hours", u);
                    h = u.getTime();
                    !x.variableTimezone && x.useUTC || !y(b) || (d = b - h > 4 * k.month || x.getTimezoneOffset(h) !== x.getTimezoneOffset(b));
                    h = u.getTime();
                    for (u = 1; h < b;) r.push(h), h = e === k.year ? x.makeTime(a + u * g, 0) : e === k.month ? x.makeTime(a, p + u * g) : !d || e !== k.day && e !== k.week ? d && e === k.hour && 1 < g ? x.makeTime(a, p, m, E + u * g) : h + e * g : x.makeTime(a, p, m + u * g * (e === k.day ? 1 : 7)),
                        u++;
                    r.push(h);
                    e <= k.hour && 1E4 > r.length && r.forEach(function(a) {
                        0 === a % 18E5 && "000000000" === x.dateFormat("%H%M%S%L", a) && (n[a] = "day")
                    })
                }
                r.info = C(f, {
                    higherRanks: n,
                    totalRange: e * g
                });
                return r
            };
            return l
        }();
        b.Time = l;
        return b.Time
    });
    J(b, "Core/Options.js", [b["Core/Globals.js"], b["Core/Color/Color.js"], b["Core/Color/Palette.js"], b["Core/Time.js"], b["Core/Utilities.js"]], function(b, l, B, y, z) {
        var w = b.isTouchDevice,
            v = b.svg;
        l = l.parse;
        z = z.merge;
        "";
        b.defaultOptions = {
            colors: B.colors,
            symbols: ["circle", "diamond", "square",
                "triangle", "triangle-down"
            ],
            lang: {
                loading: "Loading...",
                months: "January February March April May June July August September October November December".split(" "),
                shortMonths: "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" "),
                weekdays: "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "),
                decimalPoint: ".",
                numericSymbols: "kMGTPE".split(""),
                resetZoom: "Reset zoom",
                resetZoomTitle: "Reset zoom level 1:1",
                thousandsSep: " "
            },
            global: {},
            time: {
                Date: void 0,
                getTimezoneOffset: void 0,
                timezone: void 0,
                timezoneOffset: 0,
                useUTC: !0
            },
            chart: {
                styledMode: !1,
                borderRadius: 0,
                colorCount: 10,
                defaultSeriesType: "line",
                ignoreHiddenSeries: !0,
                spacing: [10, 10, 15, 10],
                resetZoomButton: {
                    theme: {
                        zIndex: 6
                    },
                    position: {
                        align: "right",
                        x: -10,
                        y: 10
                    }
                },
                zoomBySingleTouch: !1,
                width: null,
                height: null,
                borderColor: B.highlightColor80,
                backgroundColor: B.backgroundColor,
                plotBorderColor: B.neutralColor20
            },
            title: {
                text: "",
                align: "center",
                margin: 15,
                widthAdjust: -100
            },
            subtitle: {
                text: "",
                align: "center",
                widthAdjust: -44
            },
            caption: {
                margin: 0,
                text: "",
                align: "left",
                verticalAlign: "bottom"
            },
            plotOptions: {},
            labels: {
                style: {
                    position: "absolute",
                    color: B.neutralColor80
                }
            },
            legend: {
                enabled: !0,
                align: "center",
                alignColumns: !0,
                layout: "horizontal",
                labelFormatter: function() {
                    return this.name
                },
                borderColor: B.neutralColor40,
                borderRadius: 0,
                navigation: {
                    activeColor: B.highlightColor100,
                    inactiveColor: B.neutralColor20
                },
                itemStyle: {
                    color: B.neutralColor80,
                    cursor: "pointer",
                    fontSize: "12px",
                    fontWeight: "bold",
                    textOverflow: "ellipsis"
                },
                itemHoverStyle: {
                    color: B.neutralColor100
                },
                itemHiddenStyle: {
                    color: B.neutralColor20
                },
                shadow: !1,
                itemCheckboxStyle: {
                    position: "absolute",
                    width: "13px",
                    height: "13px"
                },
                squareSymbol: !0,
                symbolPadding: 5,
                verticalAlign: "bottom",
                x: 0,
                y: 0,
                title: {
                    style: {
                        fontWeight: "bold"
                    }
                }
            },
            loading: {
                labelStyle: {
                    fontWeight: "bold",
                    position: "relative",
                    top: "45%"
                },
                style: {
                    position: "absolute",
                    backgroundColor: B.backgroundColor,
                    opacity: .5,
                    textAlign: "center"
                }
            },
            tooltip: {
                enabled: !0,
                animation: v,
                borderRadius: 3,
                dateTimeLabelFormats: {
                    millisecond: "%A, %b %e, %H:%M:%S.%L",
                    second: "%A, %b %e, %H:%M:%S",
                    minute: "%A, %b %e, %H:%M",
                    hour: "%A, %b %e, %H:%M",
                    day: "%A, %b %e, %Y",
                    week: "Week from %A, %b %e, %Y",
                    month: "%B %Y",
                    year: "%Y"
                },
                footerFormat: "",
                padding: 8,
                snap: w ? 25 : 10,
                headerFormat: '<span style="font-size: 10px">{point.key}</span><br/>',
                pointFormat: '<span style="color:{point.color}">\u25cf</span> {series.name}: <b>{point.y}</b><br/>',
                backgroundColor: l(B.neutralColor3).setOpacity(.85).get(),
                borderWidth: 1,
                shadow: !0,
                style: {
                    color: B.neutralColor80,
                    cursor: "default",
                    fontSize: "12px",
                    whiteSpace: "nowrap"
                }
            },
            credits: {
                enabled: !0,
                href: "https://www.highcharts.com?credits",
                position: {
                    align: "right",
                    x: -10,
                    verticalAlign: "bottom",
                    y: -5
                },
                style: {
                    cursor: "pointer",
                    color: B.neutralColor40,
                    fontSize: "9px"
                },
                text: "Highcharts.com"
            }
        };
        b.defaultOptions.chart.styledMode = !1;
        "";
        b.time = new y(z(b.defaultOptions.global, b.defaultOptions.time));
        b.dateFormat = function(l, q, h) {
            return b.time.dateFormat(l, q, h)
        };
        return {
            dateFormat: b.dateFormat,
            defaultOptions: b.defaultOptions,
            time: b.time
        }
    });
    J(b, "Core/Axis/Tick.js", [b["Core/Globals.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = b.deg2rad,
            y = l.clamp,
            z =
            l.correctFloat,
            C = l.defined,
            v = l.destroyObjectProperties,
            t = l.extend,
            q = l.fireEvent,
            h = l.isNumber,
            c = l.merge,
            p = l.objectEach,
            k = l.pick;
        "";
        l = function() {
            function b(f, c, k, h, b) {
                this.isNewLabel = this.isNew = !0;
                this.axis = f;
                this.pos = c;
                this.type = k || "";
                this.parameters = b || {};
                this.tickmarkOffset = this.parameters.tickmarkOffset;
                this.options = this.parameters.options;
                q(this, "init");
                k || h || this.addLabel()
            }
            b.prototype.addLabel = function() {
                var f = this,
                    c = f.axis,
                    h = c.options,
                    b = c.chart,
                    p = c.categories,
                    r = c.logarithmic,
                    n = c.names,
                    u = f.pos,
                    e = k(f.options && f.options.labels, h.labels),
                    g = c.tickPositions,
                    d = u === g[0],
                    a = u === g[g.length - 1];
                n = this.parameters.category || (p ? k(p[u], n[u], u) : u);
                var m = f.label;
                p = (!e.step || 1 === e.step) && 1 === c.tickInterval;
                g = g.info;
                var E, I;
                if (c.dateTime && g) {
                    var A = b.time.resolveDTLFormat(h.dateTimeLabelFormats[!h.grid && g.higherRanks[u] || g.unitName]);
                    var l = A.main
                }
                f.isFirst = d;
                f.isLast = a;
                f.formatCtx = {
                    axis: c,
                    chart: b,
                    isFirst: d,
                    isLast: a,
                    dateTimeLabelFormat: l,
                    tickPositionInfo: g,
                    value: r ? z(r.lin2log(n)) : n,
                    pos: u
                };
                h = c.labelFormatter.call(f.formatCtx,
                    this.formatCtx);
                if (I = A && A.list) f.shortenLabel = function() {
                    for (E = 0; E < I.length; E++)
                        if (m.attr({
                                text: c.labelFormatter.call(t(f.formatCtx, {
                                    dateTimeLabelFormat: I[E]
                                }))
                            }), m.getBBox().width < c.getSlotWidth(f) - 2 * k(e.padding, 5)) return;
                    m.attr({
                        text: ""
                    })
                };
                p && c._addedPlotLB && f.moveLabel(h, e);
                C(m) || f.movedLabel ? m && m.textStr !== h && !p && (!m.textWidth || e.style && e.style.width || m.styles.width || m.css({
                    width: null
                }), m.attr({
                    text: h
                }), m.textPxLength = m.getBBox().width) : (f.label = m = f.createLabel({
                    x: 0,
                    y: 0
                }, h, e), f.rotation = 0)
            };
            b.prototype.createLabel =
                function(f, k, h) {
                    var b = this.axis,
                        x = b.chart;
                    if (f = C(k) && h.enabled ? x.renderer.text(k, f.x, f.y, h.useHTML).add(b.labelGroup) : null) x.styledMode || f.css(c(h.style)), f.textPxLength = f.getBBox().width;
                    return f
                };
            b.prototype.destroy = function() {
                v(this, this.axis)
            };
            b.prototype.getPosition = function(f, c, k, h) {
                var b = this.axis,
                    r = b.chart,
                    n = h && r.oldChartHeight || r.chartHeight;
                f = {
                    x: f ? z(b.translate(c + k, null, null, h) + b.transB) : b.left + b.offset + (b.opposite ? (h && r.oldChartWidth || r.chartWidth) - b.right - b.left : 0),
                    y: f ? n - b.bottom + b.offset -
                        (b.opposite ? b.height : 0) : z(n - b.translate(c + k, null, null, h) - b.transB)
                };
                f.y = y(f.y, -1E5, 1E5);
                q(this, "afterGetPosition", {
                    pos: f
                });
                return f
            };
            b.prototype.getLabelPosition = function(f, c, k, h, b, r, n, u) {
                var e = this.axis,
                    g = e.transA,
                    d = e.isLinked && e.linkedParent ? e.linkedParent.reversed : e.reversed,
                    a = e.staggerLines,
                    m = e.tickRotCorr || {
                        x: 0,
                        y: 0
                    },
                    E = b.y,
                    I = h || e.reserveSpaceDefault ? 0 : -e.labelOffset * ("center" === e.labelAlign ? .5 : 1),
                    A = {};
                C(E) || (E = 0 === e.side ? k.rotation ? -8 : -k.getBBox().height : 2 === e.side ? m.y + 8 : Math.cos(k.rotation * w) *
                    (m.y - k.getBBox(!1, 0).height / 2));
                f = f + b.x + I + m.x - (r && h ? r * g * (d ? -1 : 1) : 0);
                c = c + E - (r && !h ? r * g * (d ? 1 : -1) : 0);
                a && (k = n / (u || 1) % a, e.opposite && (k = a - k - 1), c += e.labelOffset / a * k);
                A.x = f;
                A.y = Math.round(c);
                q(this, "afterGetLabelPosition", {
                    pos: A,
                    tickmarkOffset: r,
                    index: n
                });
                return A
            };
            b.prototype.getLabelSize = function() {
                return this.label ? this.label.getBBox()[this.axis.horiz ? "height" : "width"] : 0
            };
            b.prototype.getMarkPath = function(f, c, k, h, b, r) {
                return r.crispLine([
                    ["M", f, c],
                    ["L", f + (b ? 0 : -k), c + (b ? k : 0)]
                ], h)
            };
            b.prototype.handleOverflow =
                function(f) {
                    var c = this.axis,
                        h = c.options.labels,
                        b = f.x,
                        p = c.chart.chartWidth,
                        r = c.chart.spacing,
                        n = k(c.labelLeft, Math.min(c.pos, r[3]));
                    r = k(c.labelRight, Math.max(c.isRadial ? 0 : c.pos + c.len, p - r[1]));
                    var u = this.label,
                        e = this.rotation,
                        g = {
                            left: 0,
                            center: .5,
                            right: 1
                        } [c.labelAlign || u.attr("align")],
                        d = u.getBBox().width,
                        a = c.getSlotWidth(this),
                        m = a,
                        E = 1,
                        I, A = {};
                    if (e || "justify" !== k(h.overflow, "justify")) 0 > e && b - g * d < n ? I = Math.round(b / Math.cos(e * w) - n) : 0 < e && b + g * d > r && (I = Math.round((p - b) / Math.cos(e * w)));
                    else if (p = b + (1 - g) * d, b - g *
                        d < n ? m = f.x + m * (1 - g) - n : p > r && (m = r - f.x + m * g, E = -1), m = Math.min(a, m), m < a && "center" === c.labelAlign && (f.x += E * (a - m - g * (a - Math.min(d, m)))), d > m || c.autoRotation && (u.styles || {}).width) I = m;
                    I && (this.shortenLabel ? this.shortenLabel() : (A.width = Math.floor(I) + "px", (h.style || {}).textOverflow || (A.textOverflow = "ellipsis"), u.css(A)))
                };
            b.prototype.moveLabel = function(f, c) {
                var k = this,
                    h = k.label,
                    b = !1,
                    r = k.axis,
                    n = r.reversed;
                h && h.textStr === f ? (k.movedLabel = h, b = !0, delete k.label) : p(r.ticks, function(e) {
                    b || e.isNew || e === k || !e.label || e.label.textStr !==
                        f || (k.movedLabel = e.label, b = !0, e.labelPos = k.movedLabel.xy, delete e.label)
                });
                if (!b && (k.labelPos || h)) {
                    var u = k.labelPos || h.xy;
                    h = r.horiz ? n ? 0 : r.width + r.left : u.x;
                    r = r.horiz ? u.y : n ? r.width + r.left : 0;
                    k.movedLabel = k.createLabel({
                        x: h,
                        y: r
                    }, f, c);
                    k.movedLabel && k.movedLabel.attr({
                        opacity: 0
                    })
                }
            };
            b.prototype.render = function(f, c, h) {
                var b = this.axis,
                    p = b.horiz,
                    r = this.pos,
                    n = k(this.tickmarkOffset, b.tickmarkOffset);
                r = this.getPosition(p, r, n, c);
                n = r.x;
                var u = r.y;
                b = p && n === b.pos + b.len || !p && u === b.pos ? -1 : 1;
                h = k(h, 1);
                this.isActive = !0;
                this.renderGridLine(c, h, b);
                this.renderMark(r, h, b);
                this.renderLabel(r, c, h, f);
                this.isNew = !1;
                q(this, "afterRender")
            };
            b.prototype.renderGridLine = function(f, c, h) {
                var b = this.axis,
                    p = b.options,
                    r = this.gridLine,
                    n = {},
                    u = this.pos,
                    e = this.type,
                    g = k(this.tickmarkOffset, b.tickmarkOffset),
                    d = b.chart.renderer,
                    a = e ? e + "Grid" : "grid",
                    m = p[a + "LineWidth"],
                    E = p[a + "LineColor"];
                p = p[a + "LineDashStyle"];
                r || (b.chart.styledMode || (n.stroke = E, n["stroke-width"] = m, p && (n.dashstyle = p)), e || (n.zIndex = 1), f && (c = 0), this.gridLine = r = d.path().attr(n).addClass("highcharts-" +
                    (e ? e + "-" : "") + "grid-line").add(b.gridGroup));
                if (r && (h = b.getPlotLinePath({
                        value: u + g,
                        lineWidth: r.strokeWidth() * h,
                        force: "pass",
                        old: f
                    }))) r[f || this.isNew ? "attr" : "animate"]({
                    d: h,
                    opacity: c
                })
            };
            b.prototype.renderMark = function(f, c, h) {
                var b = this.axis,
                    p = b.options,
                    r = b.chart.renderer,
                    n = this.type,
                    u = n ? n + "Tick" : "tick",
                    e = b.tickSize(u),
                    g = this.mark,
                    d = !g,
                    a = f.x;
                f = f.y;
                var m = k(p[u + "Width"], !n && b.isXAxis ? 1 : 0);
                p = p[u + "Color"];
                e && (b.opposite && (e[0] = -e[0]), d && (this.mark = g = r.path().addClass("highcharts-" + (n ? n + "-" : "") + "tick").add(b.axisGroup),
                    b.chart.styledMode || g.attr({
                        stroke: p,
                        "stroke-width": m
                    })), g[d ? "attr" : "animate"]({
                    d: this.getMarkPath(a, f, e[0], g.strokeWidth() * h, b.horiz, r),
                    opacity: c
                }))
            };
            b.prototype.renderLabel = function(f, c, b, p) {
                var x = this.axis,
                    r = x.horiz,
                    n = x.options,
                    u = this.label,
                    e = n.labels,
                    g = e.step;
                x = k(this.tickmarkOffset, x.tickmarkOffset);
                var d = !0,
                    a = f.x;
                f = f.y;
                u && h(a) && (u.xy = f = this.getLabelPosition(a, f, u, r, e, x, p, g), this.isFirst && !this.isLast && !k(n.showFirstLabel, 1) || this.isLast && !this.isFirst && !k(n.showLastLabel, 1) ? d = !1 : !r || e.step ||
                    e.rotation || c || 0 === b || this.handleOverflow(f), g && p % g && (d = !1), d && h(f.y) ? (f.opacity = b, u[this.isNewLabel ? "attr" : "animate"](f), this.isNewLabel = !1) : (u.attr("y", -9999), this.isNewLabel = !0))
            };
            b.prototype.replaceMovedLabel = function() {
                var f = this.label,
                    c = this.axis,
                    k = c.reversed;
                if (f && !this.isNew) {
                    var h = c.horiz ? k ? c.left : c.width + c.left : f.xy.x;
                    k = c.horiz ? f.xy.y : k ? c.width + c.top : c.top;
                    f.animate({
                        x: h,
                        y: k,
                        opacity: 0
                    }, void 0, f.destroy);
                    delete this.label
                }
                c.isDirty = !0;
                this.label = this.movedLabel;
                delete this.movedLabel
            };
            return b
        }();
        b.Tick = l;
        return b.Tick
    });
    J(b, "Core/Axis/Axis.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Color/Color.js"], b["Core/Globals.js"], b["Core/Color/Palette.js"], b["Core/Options.js"], b["Core/Axis/Tick.js"], b["Core/Utilities.js"]], function(b, l, B, y, z, C, v) {
        var t = b.animObject,
            q = z.defaultOptions,
            h = v.addEvent,
            c = v.arrayMax,
            p = v.arrayMin,
            k = v.clamp,
            G = v.correctFloat,
            f = v.defined,
            H = v.destroyObjectProperties,
            x = v.erase,
            w = v.error,
            L = v.extend,
            r = v.fireEvent,
            n = v.format,
            u = v.getMagnitude,
            e = v.isArray,
            g = v.isFunction,
            d = v.isNumber,
            a = v.isString,
            m = v.merge,
            E = v.normalizeTickInterval,
            I = v.objectEach,
            A = v.pick,
            N = v.relativeLength,
            R = v.removeEvent,
            Q = v.splat,
            T = v.syncTimeout;
        "";
        var M = B.deg2rad;
        b = function() {
            function b(a, d) {
                this.zoomEnabled = this.width = this.visible = this.userOptions = this.translationSlope = this.transB = this.transA = this.top = this.ticks = this.tickRotCorr = this.tickPositions = this.tickmarkOffset = this.tickInterval = this.tickAmount = this.side = this.series = this.right = this.positiveValuesOnly = this.pos = this.pointRangePadding = this.pointRange =
                    this.plotLinesAndBandsGroups = this.plotLinesAndBands = this.paddedTicks = this.overlap = this.options = this.offset = this.names = this.minPixelPadding = this.minorTicks = this.minorTickInterval = this.min = this.maxLabelLength = this.max = this.len = this.left = this.labelFormatter = this.labelEdge = this.isLinked = this.height = this.hasVisibleSeries = this.hasNames = this.coll = this.closestPointRange = this.chart = this.categories = this.bottom = this.alternateBands = void 0;
                this.init(a, d)
            }
            b.prototype.init = function(a, d) {
                var e = d.isX,
                    m = this;
                m.chart =
                    a;
                m.horiz = a.inverted && !m.isZAxis ? !e : e;
                m.isXAxis = e;
                m.coll = m.coll || (e ? "xAxis" : "yAxis");
                r(this, "init", {
                    userOptions: d
                });
                m.opposite = A(d.opposite, m.opposite);
                m.side = A(d.side, m.side, m.horiz ? m.opposite ? 0 : 2 : m.opposite ? 1 : 3);
                m.setOptions(d);
                var c = this.options,
                    n = c.type;
                m.labelFormatter = c.labels.formatter || m.defaultLabelFormatter;
                m.userOptions = d;
                m.minPixelPadding = 0;
                m.reversed = A(c.reversed, m.reversed);
                m.visible = !1 !== c.visible;
                m.zoomEnabled = !1 !== c.zoomEnabled;
                m.hasNames = "category" === n || !0 === c.categories;
                m.categories =
                    c.categories || m.hasNames;
                m.names || (m.names = [], m.names.keys = {});
                m.plotLinesAndBandsGroups = {};
                m.positiveValuesOnly = !!m.logarithmic;
                m.isLinked = f(c.linkedTo);
                m.ticks = {};
                m.labelEdge = [];
                m.minorTicks = {};
                m.plotLinesAndBands = [];
                m.alternateBands = {};
                m.len = 0;
                m.minRange = m.userMinRange = c.minRange || c.maxZoom;
                m.range = c.range;
                m.offset = c.offset || 0;
                m.max = null;
                m.min = null;
                m.crosshair = A(c.crosshair, Q(a.options.tooltip.crosshairs)[e ? 0 : 1], !1);
                d = m.options.events; - 1 === a.axes.indexOf(m) && (e ? a.axes.splice(a.xAxis.length, 0, m) :
                    a.axes.push(m), a[m.coll].push(m));
                m.series = m.series || [];
                a.inverted && !m.isZAxis && e && "undefined" === typeof m.reversed && (m.reversed = !0);
                m.labelRotation = m.options.labels.rotation;
                I(d, function(a, d) {
                    g(a) && h(m, d, a)
                });
                r(this, "afterInit")
            };
            b.prototype.setOptions = function(a) {
                this.options = m(b.defaultOptions, "yAxis" === this.coll && b.defaultYAxisOptions, [b.defaultTopAxisOptions, b.defaultRightAxisOptions, b.defaultBottomAxisOptions, b.defaultLeftAxisOptions][this.side], m(q[this.coll], a));
                r(this, "afterSetOptions", {
                    userOptions: a
                })
            };
            b.prototype.defaultLabelFormatter = function() {
                var a = this.axis,
                    e = d(this.value) ? this.value : NaN,
                    g = a.chart.time,
                    m = a.categories,
                    c = this.dateTimeLabelFormat,
                    f = q.lang,
                    k = f.numericSymbols;
                f = f.numericSymbolMagnitude || 1E3;
                var h = k && k.length,
                    b = a.options.labels.format;
                a = a.logarithmic ? Math.abs(e) : a.tickInterval;
                var u = this.chart,
                    E = u.numberFormatter;
                if (b) var A = n(b, this, u);
                else if (m) A = "" + this.value;
                else if (c) A = g.dateFormat(c, e);
                else if (h && 1E3 <= a)
                    for (; h-- && "undefined" === typeof A;) g = Math.pow(f, h + 1), a >= g && 0 === 10 * e % g && null !==
                        k[h] && 0 !== e && (A = E(e / g, -1) + k[h]);
                "undefined" === typeof A && (A = 1E4 <= Math.abs(e) ? E(e, -1) : E(e, -1, void 0, ""));
                return A
            };
            b.prototype.getSeriesExtremes = function() {
                var a = this,
                    e = a.chart,
                    g;
                r(this, "getSeriesExtremes", null, function() {
                    a.hasVisibleSeries = !1;
                    a.dataMin = a.dataMax = a.threshold = null;
                    a.softThreshold = !a.isXAxis;
                    a.stacking && a.stacking.buildStacks();
                    a.series.forEach(function(m) {
                        if (m.visible || !e.options.chart.ignoreHiddenSeries) {
                            var c = m.options,
                                n = c.threshold;
                            a.hasVisibleSeries = !0;
                            a.positiveValuesOnly && 0 >= n &&
                                (n = null);
                            if (a.isXAxis) {
                                if (c = m.xData, c.length) {
                                    c = a.logarithmic ? c.filter(a.validatePositiveValue) : c;
                                    g = m.getXExtremes(c);
                                    var k = g.min;
                                    var h = g.max;
                                    d(k) || k instanceof Date || (c = c.filter(d), g = m.getXExtremes(c), k = g.min, h = g.max);
                                    c.length && (a.dataMin = Math.min(A(a.dataMin, k), k), a.dataMax = Math.max(A(a.dataMax, h), h))
                                }
                            } else if (m = m.applyExtremes(), d(m.dataMin) && (k = m.dataMin, a.dataMin = Math.min(A(a.dataMin, k), k)), d(m.dataMax) && (h = m.dataMax, a.dataMax = Math.max(A(a.dataMax, h), h)), f(n) && (a.threshold = n), !c.softThreshold ||
                                a.positiveValuesOnly) a.softThreshold = !1
                        }
                    })
                });
                r(this, "afterGetSeriesExtremes")
            };
            b.prototype.translate = function(a, e, g, m, c, f) {
                var n = this.linkedParent || this,
                    k = 1,
                    h = 0,
                    b = m && n.old ? n.old.transA : n.transA;
                m = m && n.old ? n.old.min : n.min;
                var D = n.minPixelPadding;
                c = (n.isOrdinal || n.brokenAxis && n.brokenAxis.hasBreaks || n.logarithmic && c) && n.lin2val;
                b || (b = n.transA);
                g && (k *= -1, h = n.len);
                n.reversed && (k *= -1, h -= k * (n.sector || n.len));
                e ? (a = (a * k + h - D) / b + m, c && (a = n.lin2val(a))) : (c && (a = n.val2lin(a)), a = d(m) ? k * (a - m) * b + h + k * D + (d(f) ? b * f : 0) :
                    void 0);
                return a
            };
            b.prototype.toPixels = function(a, d) {
                return this.translate(a, !1, !this.horiz, null, !0) + (d ? 0 : this.pos)
            };
            b.prototype.toValue = function(a, d) {
                return this.translate(a - (d ? 0 : this.pos), !0, !this.horiz, null, !0)
            };
            b.prototype.getPlotLinePath = function(a) {
                function e(a, d, e) {
                    if ("pass" !== E && a < d || a > e) E ? a = k(a, d, e) : N = !0;
                    return a
                }
                var g = this,
                    m = g.chart,
                    c = g.left,
                    f = g.top,
                    n = a.old,
                    h = a.value,
                    b = a.translatedValue,
                    u = a.lineWidth,
                    E = a.force,
                    F, p, I, x, l = n && m.oldChartHeight || m.chartHeight,
                    q = n && m.oldChartWidth || m.chartWidth,
                    N, t = g.transB;
                a = {
                    value: h,
                    lineWidth: u,
                    old: n,
                    force: E,
                    acrossPanes: a.acrossPanes,
                    translatedValue: b
                };
                r(this, "getPlotLinePath", a, function(a) {
                    b = A(b, g.translate(h, null, null, n));
                    b = k(b, -1E5, 1E5);
                    F = I = Math.round(b + t);
                    p = x = Math.round(l - b - t);
                    d(b) ? g.horiz ? (p = f, x = l - g.bottom, F = I = e(F, c, c + g.width)) : (F = c, I = q - g.right, p = x = e(p, f, f + g.height)) : (N = !0, E = !1);
                    a.path = N && !E ? null : m.renderer.crispLine([
                        ["M", F, p],
                        ["L", I, x]
                    ], u || 1)
                });
                return a.path
            };
            b.prototype.getLinearTickPositions = function(a, d, e) {
                var g = G(Math.floor(d / a) * a);
                e = G(Math.ceil(e /
                    a) * a);
                var m = [],
                    c;
                G(g + a) === g && (c = 20);
                if (this.single) return [d];
                for (d = g; d <= e;) {
                    m.push(d);
                    d = G(d + a, c);
                    if (d === f) break;
                    var f = d
                }
                return m
            };
            b.prototype.getMinorTickInterval = function() {
                var a = this.options;
                return !0 === a.minorTicks ? A(a.minorTickInterval, "auto") : !1 === a.minorTicks ? null : a.minorTickInterval
            };
            b.prototype.getMinorTickPositions = function() {
                var a = this.options,
                    d = this.tickPositions,
                    e = this.minorTickInterval,
                    g = [],
                    m = this.pointRangePadding || 0,
                    c = this.min - m;
                m = this.max + m;
                var f = m - c;
                if (f && f / e < this.len / 3) {
                    var n = this.logarithmic;
                    if (n) this.paddedTicks.forEach(function(a, d, m) {
                        d && g.push.apply(g, n.getLogTickPositions(e, m[d - 1], m[d], !0))
                    });
                    else if (this.dateTime && "auto" === this.getMinorTickInterval()) g = g.concat(this.getTimeTicks(this.dateTime.normalizeTimeTickInterval(e), c, m, a.startOfWeek));
                    else
                        for (a = c + (d[0] - c) % e; a <= m && a !== g[0]; a += e) g.push(a)
                }
                0 !== g.length && this.trimTicks(g);
                return g
            };
            b.prototype.adjustForMinRange = function() {
                var a = this.options,
                    d = this.min,
                    e = this.max,
                    g = this.logarithmic,
                    m = 0,
                    n, k, h, b;
                this.isXAxis && "undefined" === typeof this.minRange &&
                    !g && (f(a.min) || f(a.max) ? this.minRange = null : (this.series.forEach(function(a) {
                        h = a.xData;
                        b = a.xIncrement ? 1 : h.length - 1;
                        if (1 < h.length)
                            for (n = b; 0 < n; n--)
                                if (k = h[n] - h[n - 1], !m || k < m) m = k
                    }), this.minRange = Math.min(5 * m, this.dataMax - this.dataMin)));
                if (e - d < this.minRange) {
                    var E = this.dataMax - this.dataMin >= this.minRange;
                    var u = this.minRange;
                    var I = (u - e + d) / 2;
                    I = [d - I, A(a.min, d - I)];
                    E && (I[2] = this.logarithmic ? this.logarithmic.log2lin(this.dataMin) : this.dataMin);
                    d = c(I);
                    e = [d + u, A(a.max, d + u)];
                    E && (e[2] = g ? g.log2lin(this.dataMax) : this.dataMax);
                    e = p(e);
                    e - d < u && (I[0] = e - u, I[1] = A(a.min, e - u), d = c(I))
                }
                this.min = d;
                this.max = e
            };
            b.prototype.getClosest = function() {
                var a;
                this.categories ? a = 1 : this.series.forEach(function(d) {
                    var e = d.closestPointRange,
                        g = d.visible || !d.chart.options.chart.ignoreHiddenSeries;
                    !d.noSharedTooltip && f(e) && g && (a = f(a) ? Math.min(a, e) : e)
                });
                return a
            };
            b.prototype.nameToX = function(a) {
                var d = e(this.categories),
                    g = d ? this.categories : this.names,
                    m = a.options.x;
                a.series.requireSorting = !1;
                f(m) || (m = !1 === this.options.uniqueNames ? a.series.autoIncrement() :
                    d ? g.indexOf(a.name) : A(g.keys[a.name], -1));
                if (-1 === m) {
                    if (!d) var c = g.length
                } else c = m;
                "undefined" !== typeof c && (this.names[c] = a.name, this.names.keys[a.name] = c);
                return c
            };
            b.prototype.updateNames = function() {
                var a = this,
                    d = this.names;
                0 < d.length && (Object.keys(d.keys).forEach(function(a) {
                    delete d.keys[a]
                }), d.length = 0, this.minRange = this.userMinRange, (this.series || []).forEach(function(d) {
                    d.xIncrement = null;
                    if (!d.points || d.isDirtyData) a.max = Math.max(a.max, d.xData.length - 1), d.processData(), d.generatePoints();
                    d.data.forEach(function(e,
                        g) {
                        if (e && e.options && "undefined" !== typeof e.name) {
                            var m = a.nameToX(e);
                            "undefined" !== typeof m && m !== e.x && (e.x = m, d.xData[g] = m)
                        }
                    })
                }))
            };
            b.prototype.setAxisTranslation = function() {
                var d = this,
                    e = d.max - d.min,
                    g = d.axisPointRange || 0,
                    m = 0,
                    c = 0,
                    f = d.linkedParent,
                    n = !!d.categories,
                    k = d.transA,
                    h = d.isXAxis;
                if (h || n || g) {
                    var b = d.getClosest();
                    f ? (m = f.minPointOffset, c = f.pointRangePadding) : d.series.forEach(function(e) {
                        var f = n ? 1 : h ? A(e.options.pointRange, b, 0) : d.axisPointRange || 0,
                            k = e.options.pointPlacement;
                        g = Math.max(g, f);
                        if (!d.single ||
                            n) e = e.is("xrange") ? !h : h, m = Math.max(m, e && a(k) ? 0 : f / 2), c = Math.max(c, e && "on" === k ? 0 : f)
                    });
                    f = d.ordinal && d.ordinal.slope && b ? d.ordinal.slope / b : 1;
                    d.minPointOffset = m *= f;
                    d.pointRangePadding = c *= f;
                    d.pointRange = Math.min(g, d.single && n ? 1 : e);
                    h && (d.closestPointRange = b)
                }
                d.translationSlope = d.transA = k = d.staticScale || d.len / (e + c || 1);
                d.transB = d.horiz ? d.left : d.bottom;
                d.minPixelPadding = k * m;
                r(this, "afterSetAxisTranslation")
            };
            b.prototype.minFromRange = function() {
                return this.max - this.range
            };
            b.prototype.setTickInterval = function(a) {
                var e =
                    this,
                    g = e.chart,
                    m = e.logarithmic,
                    c = e.options,
                    n = e.isXAxis,
                    k = e.isLinked,
                    h = c.maxPadding,
                    b = c.minPadding,
                    p = c.tickInterval,
                    I = c.tickPixelInterval,
                    F = e.categories,
                    x = d(e.threshold) ? e.threshold : null,
                    l = e.softThreshold;
                e.dateTime || F || k || this.getTickAmount();
                var q = A(e.userMin, c.min);
                var N = A(e.userMax, c.max);
                if (k) {
                    e.linkedParent = g[e.coll][c.linkedTo];
                    var t = e.linkedParent.getExtremes();
                    e.min = A(t.min, t.dataMin);
                    e.max = A(t.max, t.dataMax);
                    c.type !== e.linkedParent.options.type && w(11, 1, g)
                } else {
                    if (l && f(x))
                        if (e.dataMin >= x) t =
                            x, b = 0;
                        else if (e.dataMax <= x) {
                        var R = x;
                        h = 0
                    }
                    e.min = A(q, t, e.dataMin);
                    e.max = A(N, R, e.dataMax)
                }
                m && (e.positiveValuesOnly && !a && 0 >= Math.min(e.min, A(e.dataMin, e.min)) && w(10, 1, g), e.min = G(m.log2lin(e.min), 16), e.max = G(m.log2lin(e.max), 16));
                e.range && f(e.max) && (e.userMin = e.min = q = Math.max(e.dataMin, e.minFromRange()), e.userMax = N = e.max, e.range = null);
                r(e, "foundExtremes");
                e.beforePadding && e.beforePadding();
                e.adjustForMinRange();
                !(F || e.axisPointRange || e.stacking && e.stacking.usePercentage || k) && f(e.min) && f(e.max) && (g = e.max -
                    e.min) && (!f(q) && b && (e.min -= g * b), !f(N) && h && (e.max += g * h));
                d(e.userMin) || (d(c.softMin) && c.softMin < e.min && (e.min = q = c.softMin), d(c.floor) && (e.min = Math.max(e.min, c.floor)));
                d(e.userMax) || (d(c.softMax) && c.softMax > e.max && (e.max = N = c.softMax), d(c.ceiling) && (e.max = Math.min(e.max, c.ceiling)));
                l && f(e.dataMin) && (x = x || 0, !f(q) && e.min < x && e.dataMin >= x ? e.min = e.options.minRange ? Math.min(x, e.max - e.minRange) : x : !f(N) && e.max > x && e.dataMax <= x && (e.max = e.options.minRange ? Math.max(x, e.min + e.minRange) : x));
                d(e.min) && d(e.max) &&
                    !this.chart.polar && e.min > e.max && (f(e.options.min) ? e.max = e.min : f(e.options.max) && (e.min = e.max));
                e.tickInterval = e.min === e.max || "undefined" === typeof e.min || "undefined" === typeof e.max ? 1 : k && !p && I === e.linkedParent.options.tickPixelInterval ? p = e.linkedParent.tickInterval : A(p, this.tickAmount ? (e.max - e.min) / Math.max(this.tickAmount - 1, 1) : void 0, F ? 1 : (e.max - e.min) * I / Math.max(e.len, I));
                n && !a && e.series.forEach(function(a) {
                    var d, g;
                    a.processData(e.min !== (null === (d = e.old) || void 0 === d ? void 0 : d.min) || e.max !== (null ===
                        (g = e.old) || void 0 === g ? void 0 : g.max))
                });
                e.setAxisTranslation();
                r(this, "initialAxisTranslation");
                e.pointRange && !p && (e.tickInterval = Math.max(e.pointRange, e.tickInterval));
                a = A(c.minTickInterval, e.dateTime && !e.series.some(function(a) {
                    return a.noSharedTooltip
                }) ? e.closestPointRange : 0);
                !p && e.tickInterval < a && (e.tickInterval = a);
                e.dateTime || e.logarithmic || p || (e.tickInterval = E(e.tickInterval, void 0, u(e.tickInterval), A(c.allowDecimals, .5 > e.tickInterval || void 0 !== this.tickAmount), !!this.tickAmount));
                this.tickAmount ||
                    (e.tickInterval = e.unsquish());
                this.setTickPositions()
            };
            b.prototype.setTickPositions = function() {
                var a = this.options,
                    d = a.tickPositions;
                var e = this.getMinorTickInterval();
                var g = a.tickPositioner,
                    m = this.hasVerticalPanning(),
                    c = "colorAxis" === this.coll,
                    n = (c || !m) && a.startOnTick;
                m = (c || !m) && a.endOnTick;
                this.tickmarkOffset = this.categories && "between" === a.tickmarkPlacement && 1 === this.tickInterval ? .5 : 0;
                this.minorTickInterval = "auto" === e && this.tickInterval ? this.tickInterval / 5 : e;
                this.single = this.min === this.max && f(this.min) &&
                    !this.tickAmount && (parseInt(this.min, 10) === this.min || !1 !== a.allowDecimals);
                this.tickPositions = e = d && d.slice();
                !e && (this.ordinal && this.ordinal.positions || !((this.max - this.min) / this.tickInterval > Math.max(2 * this.len, 200)) ? e = this.dateTime ? this.getTimeTicks(this.dateTime.normalizeTimeTickInterval(this.tickInterval, a.units), this.min, this.max, a.startOfWeek, this.ordinal && this.ordinal.positions, this.closestPointRange, !0) : this.logarithmic ? this.logarithmic.getLogTickPositions(this.tickInterval, this.min, this.max) :
                    this.getLinearTickPositions(this.tickInterval, this.min, this.max) : (e = [this.min, this.max], w(19, !1, this.chart)), e.length > this.len && (e = [e[0], e.pop()], e[0] === e[1] && (e.length = 1)), this.tickPositions = e, g && (g = g.apply(this, [this.min, this.max]))) && (this.tickPositions = e = g);
                this.paddedTicks = e.slice(0);
                this.trimTicks(e, n, m);
                this.isLinked || (this.single && 2 > e.length && !this.categories && !this.series.some(function(a) {
                    return a.is("heatmap") && "between" === a.options.pointPlacement
                }) && (this.min -= .5, this.max += .5), d || g || this.adjustTickAmount());
                r(this, "afterSetTickPositions")
            };
            b.prototype.trimTicks = function(a, d, e) {
                var g = a[0],
                    m = a[a.length - 1],
                    c = !this.isOrdinal && this.minPointOffset || 0;
                r(this, "trimTicks");
                if (!this.isLinked) {
                    if (d && -Infinity !== g) this.min = g;
                    else
                        for (; this.min - c > a[0];) a.shift();
                    if (e) this.max = m;
                    else
                        for (; this.max + c < a[a.length - 1];) a.pop();
                    0 === a.length && f(g) && !this.options.tickPositions && a.push((m + g) / 2)
                }
            };
            b.prototype.alignToOthers = function() {
                var a = {},
                    d, e = this.options;
                !1 === this.chart.options.chart.alignTicks || !1 === e.alignTicks || !1 ===
                    e.startOnTick || !1 === e.endOnTick || this.logarithmic || this.chart[this.coll].forEach(function(e) {
                        var g = e.options;
                        g = [e.horiz ? g.left : g.top, g.width, g.height, g.pane].join();
                        e.series.length && (a[g] ? d = !0 : a[g] = 1)
                    });
                return d
            };
            b.prototype.getTickAmount = function() {
                var a = this.options,
                    d = a.tickAmount,
                    e = a.tickPixelInterval;
                !f(a.tickInterval) && !d && this.len < e && !this.isRadial && !this.logarithmic && a.startOnTick && a.endOnTick && (d = 2);
                !d && this.alignToOthers() && (d = Math.ceil(this.len / e) + 1);
                4 > d && (this.finalTickAmt = d, d = 5);
                this.tickAmount =
                    d
            };
            b.prototype.adjustTickAmount = function() {
                var a = this.options,
                    e = this.tickInterval,
                    g = this.tickPositions,
                    m = this.tickAmount,
                    c = this.finalTickAmt,
                    n = g && g.length,
                    k = A(this.threshold, this.softThreshold ? 0 : null);
                if (this.hasData() && d(this.min) && d(this.max)) {
                    if (n < m) {
                        for (; g.length < m;) g.length % 2 || this.min === k ? g.push(G(g[g.length - 1] + e)) : g.unshift(G(g[0] - e));
                        this.transA *= (n - 1) / (m - 1);
                        this.min = a.startOnTick ? g[0] : Math.min(this.min, g[0]);
                        this.max = a.endOnTick ? g[g.length - 1] : Math.max(this.max, g[g.length - 1])
                    } else n > m && (this.tickInterval *=
                        2, this.setTickPositions());
                    if (f(c)) {
                        for (e = a = g.length; e--;)(3 === c && 1 === e % 2 || 2 >= c && 0 < e && e < a - 1) && g.splice(e, 1);
                        this.finalTickAmt = void 0
                    }
                }
            };
            b.prototype.setScale = function() {
                var a, d, e, g, m, c, f = !1,
                    n = !1;
                this.series.forEach(function(a) {
                    var d;
                    f = f || a.isDirtyData || a.isDirty;
                    n = n || (null === (d = a.xAxis) || void 0 === d ? void 0 : d.isDirty) || !1
                });
                this.setAxisSize();
                (c = this.len !== (null === (a = this.old) || void 0 === a ? void 0 : a.len)) || f || n || this.isLinked || this.forceRedraw || this.userMin !== (null === (d = this.old) || void 0 === d ? void 0 : d.userMin) ||
                    this.userMax !== (null === (e = this.old) || void 0 === e ? void 0 : e.userMax) || this.alignToOthers() ? (this.stacking && this.stacking.resetStacks(), this.forceRedraw = !1, this.getSeriesExtremes(), this.setTickInterval(), this.isDirty || (this.isDirty = c || this.min !== (null === (g = this.old) || void 0 === g ? void 0 : g.min) || this.max !== (null === (m = this.old) || void 0 === m ? void 0 : m.max))) : this.stacking && this.stacking.cleanStacks();
                f && this.panningState && (this.panningState.isDirty = !0);
                r(this, "afterSetScale")
            };
            b.prototype.setExtremes = function(a,
                d, e, g, m) {
                var c = this,
                    f = c.chart;
                e = A(e, !0);
                c.series.forEach(function(a) {
                    delete a.kdTree
                });
                m = L(m, {
                    min: a,
                    max: d
                });
                r(c, "setExtremes", m, function() {
                    c.userMin = a;
                    c.userMax = d;
                    c.eventArgs = m;
                    e && f.redraw(g)
                })
            };
            b.prototype.zoom = function(a, d) {
                var e = this,
                    g = this.dataMin,
                    m = this.dataMax,
                    c = this.options,
                    n = Math.min(g, A(c.min, g)),
                    k = Math.max(m, A(c.max, m));
                a = {
                    newMin: a,
                    newMax: d
                };
                r(this, "zoom", a, function(a) {
                    var d = a.newMin,
                        c = a.newMax;
                    if (d !== e.min || c !== e.max) e.allowZoomOutside || (f(g) && (d < n && (d = n), d > k && (d = k)), f(m) && (c < n && (c = n),
                        c > k && (c = k))), e.displayBtn = "undefined" !== typeof d || "undefined" !== typeof c, e.setExtremes(d, c, !1, void 0, {
                        trigger: "zoom"
                    });
                    a.zoomed = !0
                });
                return a.zoomed
            };
            b.prototype.setAxisSize = function() {
                var a = this.chart,
                    d = this.options,
                    e = d.offsets || [0, 0, 0, 0],
                    g = this.horiz,
                    m = this.width = Math.round(N(A(d.width, a.plotWidth - e[3] + e[1]), a.plotWidth)),
                    c = this.height = Math.round(N(A(d.height, a.plotHeight - e[0] + e[2]), a.plotHeight)),
                    f = this.top = Math.round(N(A(d.top, a.plotTop + e[0]), a.plotHeight, a.plotTop));
                d = this.left = Math.round(N(A(d.left,
                    a.plotLeft + e[3]), a.plotWidth, a.plotLeft));
                this.bottom = a.chartHeight - c - f;
                this.right = a.chartWidth - m - d;
                this.len = Math.max(g ? m : c, 0);
                this.pos = g ? d : f
            };
            b.prototype.getExtremes = function() {
                var a = this.logarithmic;
                return {
                    min: a ? G(a.lin2log(this.min)) : this.min,
                    max: a ? G(a.lin2log(this.max)) : this.max,
                    dataMin: this.dataMin,
                    dataMax: this.dataMax,
                    userMin: this.userMin,
                    userMax: this.userMax
                }
            };
            b.prototype.getThreshold = function(a) {
                var d = this.logarithmic,
                    e = d ? d.lin2log(this.min) : this.min;
                d = d ? d.lin2log(this.max) : this.max;
                null ===
                    a || -Infinity === a ? a = e : Infinity === a ? a = d : e > a ? a = e : d < a && (a = d);
                return this.translate(a, 0, 1, 0, 1)
            };
            b.prototype.autoLabelAlign = function(a) {
                var d = (A(a, 0) - 90 * this.side + 720) % 360;
                a = {
                    align: "center"
                };
                r(this, "autoLabelAlign", a, function(a) {
                    15 < d && 165 > d ? a.align = "right" : 195 < d && 345 > d && (a.align = "left")
                });
                return a.align
            };
            b.prototype.tickSize = function(a) {
                var d = this.options,
                    e = d["tick" === a ? "tickLength" : "minorTickLength"],
                    g = A(d["tick" === a ? "tickWidth" : "minorTickWidth"], "tick" === a && this.isXAxis && !this.categories ? 1 : 0);
                if (g && e) {
                    "inside" ===
                    d[a + "Position"] && (e = -e);
                    var m = [e, g]
                }
                a = {
                    tickSize: m
                };
                r(this, "afterTickSize", a);
                return a.tickSize
            };
            b.prototype.labelMetrics = function() {
                var a = this.tickPositions && this.tickPositions[0] || 0;
                return this.chart.renderer.fontMetrics(this.options.labels.style && this.options.labels.style.fontSize, this.ticks[a] && this.ticks[a].label)
            };
            b.prototype.unsquish = function() {
                var a = this.options.labels,
                    d = this.horiz,
                    e = this.tickInterval,
                    g = e,
                    m = this.len / (((this.categories ? 1 : 0) + this.max - this.min) / e),
                    c, n = a.rotation,
                    k = this.labelMetrics(),
                    h, b = Number.MAX_VALUE,
                    u, E = Math.max(this.max - this.min, 0),
                    p = function(a) {
                        var d = a / (m || 1);
                        d = 1 < d ? Math.ceil(d) : 1;
                        d * e > E && Infinity !== a && Infinity !== m && E && (d = Math.ceil(E / e));
                        return G(d * e)
                    };
                d ? (u = !a.staggerLines && !a.step && (f(n) ? [n] : m < A(a.autoRotationLimit, 80) && a.autoRotation)) && u.forEach(function(a) {
                    if (a === n || a && -90 <= a && 90 >= a) {
                        h = p(Math.abs(k.h / Math.sin(M * a)));
                        var d = h + Math.abs(a / 360);
                        d < b && (b = d, c = a, g = h)
                    }
                }) : a.step || (g = p(k.h));
                this.autoRotation = u;
                this.labelRotation = A(c, n);
                return g
            };
            b.prototype.getSlotWidth = function(a) {
                var e,
                    g = this.chart,
                    m = this.horiz,
                    c = this.options.labels,
                    f = Math.max(this.tickPositions.length - (this.categories ? 0 : 1), 1),
                    n = g.margin[3];
                if (a && d(a.slotWidth)) return a.slotWidth;
                if (m && c && 2 > (c.step || 0)) return c.rotation ? 0 : (this.staggerLines || 1) * this.len / f;
                if (!m) {
                    a = null === (e = null === c || void 0 === c ? void 0 : c.style) || void 0 === e ? void 0 : e.width;
                    if (void 0 !== a) return parseInt(a, 10);
                    if (n) return n - g.spacing[3]
                }
                return .33 * g.chartWidth
            };
            b.prototype.renderUnsquish = function() {
                var d = this.chart,
                    e = d.renderer,
                    g = this.tickPositions,
                    m =
                    this.ticks,
                    c = this.options.labels,
                    f = c && c.style || {},
                    n = this.horiz,
                    k = this.getSlotWidth(),
                    h = Math.max(1, Math.round(k - 2 * (c.padding || 5))),
                    b = {},
                    u = this.labelMetrics(),
                    E = c.style && c.style.textOverflow,
                    A = 0;
                a(c.rotation) || (b.rotation = c.rotation || 0);
                g.forEach(function(a) {
                    a = m[a];
                    a.movedLabel && a.replaceMovedLabel();
                    a && a.label && a.label.textPxLength > A && (A = a.label.textPxLength)
                });
                this.maxLabelLength = A;
                if (this.autoRotation) A > h && A > u.h ? b.rotation = this.labelRotation : this.labelRotation = 0;
                else if (k) {
                    var p = h;
                    if (!E) {
                        var I = "clip";
                        for (h = g.length; !n && h--;) {
                            var r = g[h];
                            if (r = m[r].label) r.styles && "ellipsis" === r.styles.textOverflow ? r.css({
                                textOverflow: "clip"
                            }) : r.textPxLength > k && r.css({
                                width: k + "px"
                            }), r.getBBox().height > this.len / g.length - (u.h - u.f) && (r.specificTextOverflow = "ellipsis")
                        }
                    }
                }
                b.rotation && (p = A > .5 * d.chartHeight ? .33 * d.chartHeight : A, E || (I = "ellipsis"));
                if (this.labelAlign = c.align || this.autoLabelAlign(this.labelRotation)) b.align = this.labelAlign;
                g.forEach(function(a) {
                    var d = (a = m[a]) && a.label,
                        e = f.width,
                        g = {};
                    d && (d.attr(b), a.shortenLabel ?
                        a.shortenLabel() : p && !e && "nowrap" !== f.whiteSpace && (p < d.textPxLength || "SPAN" === d.element.tagName) ? (g.width = p + "px", E || (g.textOverflow = d.specificTextOverflow || I), d.css(g)) : d.styles && d.styles.width && !g.width && !e && d.css({
                            width: null
                        }), delete d.specificTextOverflow, a.rotation = b.rotation)
                }, this);
                this.tickRotCorr = e.rotCorr(u.b, this.labelRotation || 0, 0 !== this.side)
            };
            b.prototype.hasData = function() {
                return this.series.some(function(a) {
                    return a.hasData()
                }) || this.options.showEmpty && f(this.min) && f(this.max)
            };
            b.prototype.addTitle =
                function(a) {
                    var d = this.chart.renderer,
                        e = this.horiz,
                        g = this.opposite,
                        c = this.options.title,
                        f, n = this.chart.styledMode;
                    this.axisTitle || ((f = c.textAlign) || (f = (e ? {
                        low: "left",
                        middle: "center",
                        high: "right"
                    } : {
                        low: g ? "right" : "left",
                        middle: "center",
                        high: g ? "left" : "right"
                    })[c.align]), this.axisTitle = d.text(c.text, 0, 0, c.useHTML).attr({
                        zIndex: 7,
                        rotation: c.rotation || 0,
                        align: f
                    }).addClass("highcharts-axis-title"), n || this.axisTitle.css(m(c.style)), this.axisTitle.add(this.axisGroup), this.axisTitle.isNew = !0);
                    n || c.style.width ||
                        this.isRadial || this.axisTitle.css({
                            width: this.len + "px"
                        });
                    this.axisTitle[a ? "show" : "hide"](a)
                };
            b.prototype.generateTick = function(a) {
                var d = this.ticks;
                d[a] ? d[a].addLabel() : d[a] = new C(this, a)
            };
            b.prototype.getOffset = function() {
                var a = this,
                    d = this,
                    e = d.chart,
                    g = e.renderer,
                    m = d.options,
                    c = d.tickPositions,
                    n = d.ticks,
                    k = d.horiz,
                    h = d.side,
                    b = e.inverted && !d.isZAxis ? [1, 0, 3, 2][h] : h,
                    u, E = 0,
                    p = 0,
                    x = m.title,
                    l = m.labels,
                    q = 0,
                    N = e.axisOffset;
                e = e.clipOffset;
                var t = [-1, 1, 1, -1][h],
                    R = m.className,
                    H = d.axisParent;
                var v = d.hasData();
                d.showAxis =
                    u = v || A(m.showEmpty, !0);
                d.staggerLines = d.horiz && l.staggerLines;
                if (!d.axisGroup) {
                    var G = function(d, e, m) {
                        return g.g(d).attr({
                            zIndex: m
                        }).addClass("highcharts-" + a.coll.toLowerCase() + e + " " + (a.isRadial ? "highcharts-radial-axis" + e + " " : "") + (R || "")).add(H)
                    };
                    d.gridGroup = G("grid", "-grid", m.gridZIndex || 1);
                    d.axisGroup = G("axis", "", m.zIndex || 2);
                    d.labelGroup = G("axis-labels", "-labels", l.zIndex || 7)
                }
                v || d.isLinked ? (c.forEach(function(a, e) {
                    d.generateTick(a, e)
                }), d.renderUnsquish(), d.reserveSpaceDefault = 0 === h || 2 === h || {
                    1: "left",
                    3: "right"
                } [h] === d.labelAlign, A(l.reserveSpace, "center" === d.labelAlign ? !0 : null, d.reserveSpaceDefault) && c.forEach(function(a) {
                    q = Math.max(n[a].getLabelSize(), q)
                }), d.staggerLines && (q *= d.staggerLines), d.labelOffset = q * (d.opposite ? -1 : 1)) : I(n, function(a, d) {
                    a.destroy();
                    delete n[d]
                });
                if (x && x.text && !1 !== x.enabled && (d.addTitle(u), u && !1 !== x.reserveSpace)) {
                    d.titleOffset = E = d.axisTitle.getBBox()[k ? "height" : "width"];
                    var w = x.offset;
                    p = f(w) ? 0 : A(x.margin, k ? 5 : 10)
                }
                d.renderLine();
                d.offset = t * A(m.offset, N[h] ? N[h] + (m.margin ||
                    0) : 0);
                d.tickRotCorr = d.tickRotCorr || {
                    x: 0,
                    y: 0
                };
                x = 0 === h ? -d.labelMetrics().h : 2 === h ? d.tickRotCorr.y : 0;
                p = Math.abs(q) + p;
                q && (p = p - x + t * (k ? A(l.y, d.tickRotCorr.y + 8 * t) : l.x));
                d.axisTitleMargin = A(w, p);
                d.getMaxLabelDimensions && (d.maxLabelDimensions = d.getMaxLabelDimensions(n, c));
                k = this.tickSize("tick");
                N[h] = Math.max(N[h], d.axisTitleMargin + E + t * d.offset, p, c && c.length && k ? k[0] + t * d.offset : 0);
                m = m.offset ? 0 : 2 * Math.floor(d.axisLine.strokeWidth() / 2);
                e[b] = Math.max(e[b], m);
                r(this, "afterGetOffset")
            };
            b.prototype.getLinePath = function(a) {
                var d =
                    this.chart,
                    e = this.opposite,
                    g = this.offset,
                    m = this.horiz,
                    c = this.left + (e ? this.width : 0) + g;
                g = d.chartHeight - this.bottom - (e ? this.height : 0) + g;
                e && (a *= -1);
                return d.renderer.crispLine([
                    ["M", m ? this.left : c, m ? g : this.top],
                    ["L", m ? d.chartWidth - this.right : c, m ? g : d.chartHeight - this.bottom]
                ], a)
            };
            b.prototype.renderLine = function() {
                this.axisLine || (this.axisLine = this.chart.renderer.path().addClass("highcharts-axis-line").add(this.axisGroup), this.chart.styledMode || this.axisLine.attr({
                    stroke: this.options.lineColor,
                    "stroke-width": this.options.lineWidth,
                    zIndex: 7
                }))
            };
            b.prototype.getTitlePosition = function() {
                var a = this.horiz,
                    d = this.left,
                    e = this.top,
                    g = this.len,
                    m = this.options.title,
                    c = a ? d : e,
                    f = this.opposite,
                    n = this.offset,
                    k = m.x || 0,
                    h = m.y || 0,
                    b = this.axisTitle,
                    u = this.chart.renderer.fontMetrics(m.style && m.style.fontSize, b);
                b = Math.max(b.getBBox(null, 0).height - u.h - 1, 0);
                g = {
                    low: c + (a ? 0 : g),
                    middle: c + g / 2,
                    high: c + (a ? g : 0)
                } [m.align];
                d = (a ? e + this.height : d) + (a ? 1 : -1) * (f ? -1 : 1) * this.axisTitleMargin + [-b, b, u.f, -b][this.side];
                a = {
                    x: a ? g + k : d + (f ? this.width : 0) + n + k,
                    y: a ? d + h - (f ? this.height :
                        0) + n : g + h
                };
                r(this, "afterGetTitlePosition", {
                    titlePosition: a
                });
                return a
            };
            b.prototype.renderMinorTick = function(a) {
                var d = this.chart.hasRendered && this.old,
                    e = this.minorTicks;
                e[a] || (e[a] = new C(this, a, "minor"));
                d && e[a].isNew && e[a].render(null, !0);
                e[a].render(null, !1, 1)
            };
            b.prototype.renderTick = function(a, d) {
                var e, g = this.ticks,
                    m = this.chart.hasRendered && this.old;
                if (!this.isLinked || a >= this.min && a <= this.max || (null === (e = this.grid) || void 0 === e ? 0 : e.isColumn)) g[a] || (g[a] = new C(this, a)), m && g[a].isNew && g[a].render(d,
                    !0, -1), g[a].render(d)
            };
            b.prototype.render = function() {
                var a = this,
                    e = a.chart,
                    g = a.logarithmic,
                    m = a.options,
                    c = a.isLinked,
                    f = a.tickPositions,
                    n = a.axisTitle,
                    k = a.ticks,
                    h = a.minorTicks,
                    b = a.alternateBands,
                    u = m.stackLabels,
                    E = m.alternateGridColor,
                    A = a.tickmarkOffset,
                    p = a.axisLine,
                    x = a.showAxis,
                    q = t(e.renderer.globalAnimation),
                    l, N;
                a.labelEdge.length = 0;
                a.overlap = !1;
                [k, h, b].forEach(function(a) {
                    I(a, function(a) {
                        a.isActive = !1
                    })
                });
                if (a.hasData() || c) a.minorTickInterval && !a.categories && a.getMinorTickPositions().forEach(function(d) {
                        a.renderMinorTick(d)
                    }),
                    f.length && (f.forEach(function(d, e) {
                        a.renderTick(d, e)
                    }), A && (0 === a.min || a.single) && (k[-1] || (k[-1] = new C(a, -1, null, !0)), k[-1].render(-1))), E && f.forEach(function(d, m) {
                        N = "undefined" !== typeof f[m + 1] ? f[m + 1] + A : a.max - A;
                        0 === m % 2 && d < a.max && N <= a.max + (e.polar ? -A : A) && (b[d] || (b[d] = new B.PlotLineOrBand(a)), l = d + A, b[d].options = {
                            from: g ? g.lin2log(l) : l,
                            to: g ? g.lin2log(N) : N,
                            color: E,
                            className: "highcharts-alternate-grid"
                        }, b[d].render(), b[d].isActive = !0)
                    }), a._addedPlotLB || (a._addedPlotLB = !0, (m.plotLines || []).concat(m.plotBands || []).forEach(function(d) {
                        a.addPlotBandOrLine(d)
                    }));
                [k, h, b].forEach(function(a) {
                    var d, g = [],
                        m = q.duration;
                    I(a, function(a, d) {
                        a.isActive || (a.render(d, !1, 0), a.isActive = !1, g.push(d))
                    });
                    T(function() {
                        for (d = g.length; d--;) a[g[d]] && !a[g[d]].isActive && (a[g[d]].destroy(), delete a[g[d]])
                    }, a !== b && e.hasRendered && m ? m : 0)
                });
                p && (p[p.isPlaced ? "animate" : "attr"]({
                    d: this.getLinePath(p.strokeWidth())
                }), p.isPlaced = !0, p[x ? "show" : "hide"](x));
                n && x && (m = a.getTitlePosition(), d(m.y) ? (n[n.isNew ? "attr" : "animate"](m), n.isNew = !1) : (n.attr("y",
                    -9999), n.isNew = !0));
                u && u.enabled && a.stacking && a.stacking.renderStackTotals();
                a.old = {
                    len: a.len,
                    max: a.max,
                    min: a.min,
                    transA: a.transA,
                    userMax: a.userMax,
                    userMin: a.userMin
                };
                a.isDirty = !1;
                r(this, "afterRender")
            };
            b.prototype.redraw = function() {
                this.visible && (this.render(), this.plotLinesAndBands.forEach(function(a) {
                    a.render()
                }));
                this.series.forEach(function(a) {
                    a.isDirty = !0
                })
            };
            b.prototype.getKeepProps = function() {
                return this.keepProps || b.keepProps
            };
            b.prototype.destroy = function(a) {
                var d = this,
                    e = d.plotLinesAndBands,
                    g;
                r(this, "destroy", {
                    keepEvents: a
                });
                a || R(d);
                [d.ticks, d.minorTicks, d.alternateBands].forEach(function(a) {
                    H(a)
                });
                if (e)
                    for (a = e.length; a--;) e[a].destroy();
                "axisLine axisTitle axisGroup gridGroup labelGroup cross scrollbar".split(" ").forEach(function(a) {
                    d[a] && (d[a] = d[a].destroy())
                });
                for (g in d.plotLinesAndBandsGroups) d.plotLinesAndBandsGroups[g] = d.plotLinesAndBandsGroups[g].destroy();
                I(d, function(a, e) {
                    -1 === d.getKeepProps().indexOf(e) && delete d[e]
                })
            };
            b.prototype.drawCrosshair = function(a, d) {
                var e = this.crosshair,
                    g = A(e.snap, !0),
                    m, c = this.cross,
                    n = this.chart;
                r(this, "drawCrosshair", {
                    e: a,
                    point: d
                });
                a || (a = this.cross && this.cross.e);
                if (this.crosshair && !1 !== (f(d) || !g)) {
                    g ? f(d) && (m = A("colorAxis" !== this.coll ? d.crosshairPos : null, this.isXAxis ? d.plotX : this.len - d.plotY)) : m = a && (this.horiz ? a.chartX - this.pos : this.len - a.chartY + this.pos);
                    if (f(m)) {
                        var k = {
                            value: d && (this.isXAxis ? d.x : A(d.stackY, d.y)),
                            translatedValue: m
                        };
                        n.polar && L(k, {
                            isCrosshair: !0,
                            chartX: a && a.chartX,
                            chartY: a && a.chartY,
                            point: d
                        });
                        k = this.getPlotLinePath(k) || null
                    }
                    if (!f(k)) {
                        this.hideCrosshair();
                        return
                    }
                    g = this.categories && !this.isRadial;
                    c || (this.cross = c = n.renderer.path().addClass("highcharts-crosshair highcharts-crosshair-" + (g ? "category " : "thin ") + e.className).attr({
                        zIndex: A(e.zIndex, 2)
                    }).add(), n.styledMode || (c.attr({
                        stroke: e.color || (g ? l.parse(y.highlightColor20).setOpacity(.25).get() : y.neutralColor20),
                        "stroke-width": A(e.width, 1)
                    }).css({
                        "pointer-events": "none"
                    }), e.dashStyle && c.attr({
                        dashstyle: e.dashStyle
                    })));
                    c.show().attr({
                        d: k
                    });
                    g && !e.width && c.attr({
                        "stroke-width": this.transA
                    });
                    this.cross.e =
                        a
                } else this.hideCrosshair();
                r(this, "afterDrawCrosshair", {
                    e: a,
                    point: d
                })
            };
            b.prototype.hideCrosshair = function() {
                this.cross && this.cross.hide();
                r(this, "afterHideCrosshair")
            };
            b.prototype.hasVerticalPanning = function() {
                var a, d = null === (a = this.chart.options.chart) || void 0 === a ? void 0 : a.panning;
                return !!(d && d.enabled && /y/.test(d.type))
            };
            b.prototype.validatePositiveValue = function(a) {
                return d(a) && 0 < a
            };
            b.prototype.update = function(a, d) {
                var e = this.chart,
                    g = a && a.events || {};
                a = m(this.userOptions, a);
                e.options[this.coll].indexOf &&
                    (e.options[this.coll][e.options[this.coll].indexOf(this.userOptions)] = a);
                I(e.options[this.coll].events, function(a, d) {
                    "undefined" === typeof g[d] && (g[d] = void 0)
                });
                this.destroy(!0);
                this.init(e, L(a, {
                    events: g
                }));
                e.isDirtyBox = !0;
                A(d, !0) && e.redraw()
            };
            b.prototype.remove = function(a) {
                for (var d = this.chart, g = this.coll, m = this.series, c = m.length; c--;) m[c] && m[c].remove(!1);
                x(d.axes, this);
                x(d[g], this);
                e(d.options[g]) ? d.options[g].splice(this.options.index, 1) : delete d.options[g];
                d[g].forEach(function(a, d) {
                    a.options.index =
                        a.userOptions.index = d
                });
                this.destroy();
                d.isDirtyBox = !0;
                A(a, !0) && d.redraw()
            };
            b.prototype.setTitle = function(a, d) {
                this.update({
                    title: a
                }, d)
            };
            b.prototype.setCategories = function(a, d) {
                this.update({
                    categories: a
                }, d)
            };
            b.defaultOptions = {
                dateTimeLabelFormats: {
                    millisecond: {
                        main: "%H:%M:%S.%L",
                        range: !1
                    },
                    second: {
                        main: "%H:%M:%S",
                        range: !1
                    },
                    minute: {
                        main: "%H:%M",
                        range: !1
                    },
                    hour: {
                        main: "%H:%M",
                        range: !1
                    },
                    day: {
                        main: "%e. %b"
                    },
                    week: {
                        main: "%e. %b"
                    },
                    month: {
                        main: "%b '%y"
                    },
                    year: {
                        main: "%Y"
                    }
                },
                endOnTick: !1,
                labels: {
                    enabled: !0,
                    indentation: 10,
                    x: 0,
                    style: {
                        color: y.neutralColor60,
                        cursor: "default",
                        fontSize: "11px"
                    }
                },
                maxPadding: .01,
                minorTickLength: 2,
                minorTickPosition: "outside",
                minPadding: .01,
                showEmpty: !0,
                startOfWeek: 1,
                startOnTick: !1,
                tickLength: 10,
                tickPixelInterval: 100,
                tickmarkPlacement: "between",
                tickPosition: "outside",
                title: {
                    align: "middle",
                    style: {
                        color: y.neutralColor60
                    }
                },
                type: "linear",
                minorGridLineColor: y.neutralColor5,
                minorGridLineWidth: 1,
                minorTickColor: y.neutralColor40,
                lineColor: y.highlightColor20,
                lineWidth: 1,
                gridLineColor: y.neutralColor10,
                tickColor: y.highlightColor20
            };
            b.defaultYAxisOptions = {
                endOnTick: !0,
                maxPadding: .05,
                minPadding: .05,
                tickPixelInterval: 72,
                showLastLabel: !0,
                labels: {
                    x: -8
                },
                startOnTick: !0,
                title: {
                    rotation: 270,
                    text: "Values"
                },
                stackLabels: {
                    animation: {},
                    allowOverlap: !1,
                    enabled: !1,
                    crop: !0,
                    overflow: "justify",
                    formatter: function() {
                        var a = this.axis.chart.numberFormatter;
                        return a(this.total, -1)
                    },
                    style: {
                        color: y.neutralColor100,
                        fontSize: "11px",
                        fontWeight: "bold",
                        textOutline: "1px contrast"
                    }
                },
                gridLineWidth: 1,
                lineWidth: 0
            };
            b.defaultLeftAxisOptions = {
                labels: {
                    x: -15
                },
                title: {
                    rotation: 270
                }
            };
            b.defaultRightAxisOptions = {
                labels: {
                    x: 15
                },
                title: {
                    rotation: 90
                }
            };
            b.defaultBottomAxisOptions = {
                labels: {
                    autoRotation: [-45],
                    x: 0
                },
                margin: 15,
                title: {
                    rotation: 0
                }
            };
            b.defaultTopAxisOptions = {
                labels: {
                    autoRotation: [-45],
                    x: 0
                },
                margin: 15,
                title: {
                    rotation: 0
                }
            };
            b.keepProps = "extKey hcEvents names series userMax userMin".split(" ");
            return b
        }();
        B.Axis = b;
        return B.Axis
    });
    J(b, "Core/Axis/DateTimeAxis.js", [b["Core/Axis/Axis.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = l.addEvent,
            y = l.getMagnitude,
            z = l.normalizeTickInterval,
            C = l.timeUnits,
            v = function() {
                function b(b) {
                    this.axis = b
                }
                b.prototype.normalizeTimeTickInterval = function(b, h) {
                    var c = h || [
                        ["millisecond", [1, 2, 5, 10, 20, 25, 50, 100, 200, 500]],
                        ["second", [1, 2, 5, 10, 15, 30]],
                        ["minute", [1, 2, 5, 10, 15, 30]],
                        ["hour", [1, 2, 3, 4, 6, 8, 12]],
                        ["day", [1, 2]],
                        ["week", [1, 2]],
                        ["month", [1, 2, 3, 4, 6]],
                        ["year", null]
                    ];
                    h = c[c.length - 1];
                    var p = C[h[0]],
                        k = h[1],
                        l;
                    for (l = 0; l < c.length && !(h = c[l], p = C[h[0]], k = h[1], c[l + 1] && b <= (p * k[k.length - 1] + C[c[l + 1][0]]) / 2); l++);
                    p === C.year && b < 5 * p && (k = [1, 2, 5]);
                    b = z(b / p, k, "year" === h[0] ? Math.max(y(b / p), 1) : 1);
                    return {
                        unitRange: p,
                        count: b,
                        unitName: h[0]
                    }
                };
                return b
            }();
        l = function() {
            function b() {}
            b.compose = function(b) {
                b.keepProps.push("dateTime");
                b.prototype.getTimeTicks = function() {
                    return this.chart.time.getTimeTicks.apply(this.chart.time, arguments)
                };
                w(b, "init", function(b) {
                    "datetime" !== b.userOptions.type ? this.dateTime = void 0 : this.dateTime || (this.dateTime = new v(this))
                })
            };
            b.AdditionsClass = v;
            return b
        }();
        l.compose(b);
        return l
    });
    J(b, "Core/Axis/LogarithmicAxis.js", [b["Core/Axis/Axis.js"],
        b["Core/Utilities.js"]
    ], function(b, l) {
        var w = l.addEvent,
            y = l.getMagnitude,
            z = l.normalizeTickInterval,
            C = l.pick,
            v = function() {
                function b(b) {
                    this.axis = b
                }
                b.prototype.getLogTickPositions = function(b, h, c, p) {
                    var k = this.axis,
                        l = k.len,
                        f = k.options,
                        q = [];
                    p || (this.minorAutoInterval = void 0);
                    if (.5 <= b) b = Math.round(b), q = k.getLinearTickPositions(b, h, c);
                    else if (.08 <= b) {
                        f = Math.floor(h);
                        var x, t;
                        for (l = .3 < b ? [1, 2, 4] : .15 < b ? [1, 2, 4, 6, 8] : [1, 2, 3, 4, 5, 6, 7, 8, 9]; f < c + 1 && !t; f++) {
                            var v = l.length;
                            for (x = 0; x < v && !t; x++) {
                                var r = this.log2lin(this.lin2log(f) *
                                    l[x]);
                                r > h && (!p || n <= c) && "undefined" !== typeof n && q.push(n);
                                n > c && (t = !0);
                                var n = r
                            }
                        }
                    } else h = this.lin2log(h), c = this.lin2log(c), b = p ? k.getMinorTickInterval() : f.tickInterval, b = C("auto" === b ? null : b, this.minorAutoInterval, f.tickPixelInterval / (p ? 5 : 1) * (c - h) / ((p ? l / k.tickPositions.length : l) || 1)), b = z(b, void 0, y(b)), q = k.getLinearTickPositions(b, h, c).map(this.log2lin), p || (this.minorAutoInterval = b / 5);
                    p || (k.tickInterval = b);
                    return q
                };
                b.prototype.lin2log = function(b) {
                    return Math.pow(10, b)
                };
                b.prototype.log2lin = function(b) {
                    return Math.log(b) /
                        Math.LN10
                };
                return b
            }();
        l = function() {
            function b() {}
            b.compose = function(b) {
                b.keepProps.push("logarithmic");
                w(b, "init", function(b) {
                    var c = this.logarithmic;
                    "logarithmic" !== b.userOptions.type ? this.logarithmic = void 0 : c || (this.logarithmic = new v(this))
                });
                w(b, "afterInit", function() {
                    var b = this.logarithmic;
                    b && (this.lin2val = function(c) {
                        return b.lin2log(c)
                    }, this.val2lin = function(c) {
                        return b.log2lin(c)
                    })
                })
            };
            return b
        }();
        l.compose(b);
        return l
    });
    J(b, "Core/Axis/PlotLineOrBand.js", [b["Core/Axis/Axis.js"], b["Core/Globals.js"],
        b["Core/Color/Palette.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y) {
        var w = y.arrayMax,
            C = y.arrayMin,
            v = y.defined,
            t = y.destroyObjectProperties,
            q = y.erase,
            h = y.extend,
            c = y.fireEvent,
            p = y.merge,
            k = y.objectEach,
            G = y.pick;
        y = function() {
            function f(c, f) {
                this.axis = c;
                f && (this.options = f, this.id = f.id)
            }
            f.prototype.render = function() {
                c(this, "render");
                var f = this,
                    b = f.axis,
                    h = b.horiz,
                    l = b.logarithmic,
                    r = f.options,
                    n = r.label,
                    u = f.label,
                    e = r.to,
                    g = r.from,
                    d = r.value,
                    a = v(g) && v(e),
                    m = v(d),
                    E = f.svgElem,
                    I = !E,
                    A = [],
                    N = r.color,
                    q = G(r.zIndex, 0),
                    t = r.events;
                A = {
                    "class": "highcharts-plot-" + (a ? "band " : "line ") + (r.className || "")
                };
                var w = {},
                    M = b.chart.renderer,
                    z = a ? "bands" : "lines";
                l && (g = l.log2lin(g), e = l.log2lin(e), d = l.log2lin(d));
                b.chart.styledMode || (m ? (A.stroke = N || B.neutralColor40, A["stroke-width"] = G(r.width, 1), r.dashStyle && (A.dashstyle = r.dashStyle)) : a && (A.fill = N || B.highlightColor10, r.borderWidth && (A.stroke = r.borderColor, A["stroke-width"] = r.borderWidth)));
                w.zIndex = q;
                z += "-" + q;
                (l = b.plotLinesAndBandsGroups[z]) || (b.plotLinesAndBandsGroups[z] = l = M.g("plot-" +
                    z).attr(w).add());
                I && (f.svgElem = E = M.path().attr(A).add(l));
                if (m) A = b.getPlotLinePath({
                    value: d,
                    lineWidth: E.strokeWidth(),
                    acrossPanes: r.acrossPanes
                });
                else if (a) A = b.getPlotBandPath(g, e, r);
                else return;
                !f.eventsAdded && t && (k(t, function(a, d) {
                    E.on(d, function(a) {
                        t[d].apply(f, [a])
                    })
                }), f.eventsAdded = !0);
                (I || !E.d) && A && A.length ? E.attr({
                    d: A
                }) : E && (A ? (E.show(!0), E.animate({
                    d: A
                })) : E.d && (E.hide(), u && (f.label = u = u.destroy())));
                n && (v(n.text) || v(n.formatter)) && A && A.length && 0 < b.width && 0 < b.height && !A.isFlat ? (n = p({
                    align: h &&
                        a && "center",
                    x: h ? !a && 4 : 10,
                    verticalAlign: !h && a && "middle",
                    y: h ? a ? 16 : 10 : a ? 6 : -4,
                    rotation: h && !a && 90
                }, n), this.renderLabel(n, A, a, q)) : u && u.hide();
                return f
            };
            f.prototype.renderLabel = function(c, f, b, k) {
                var h = this.label,
                    n = this.axis.chart.renderer;
                h || (h = {
                    align: c.textAlign || c.align,
                    rotation: c.rotation,
                    "class": "highcharts-plot-" + (b ? "band" : "line") + "-label " + (c.className || "")
                }, h.zIndex = k, k = this.getLabelText(c), this.label = h = n.text(k, 0, 0, c.useHTML).attr(h).add(), this.axis.chart.styledMode || h.css(c.style));
                n = f.xBounds || [f[0][1], f[1][1], b ? f[2][1] : f[0][1]];
                f = f.yBounds || [f[0][2], f[1][2], b ? f[2][2] : f[0][2]];
                b = C(n);
                k = C(f);
                h.align(c, !1, {
                    x: b,
                    y: k,
                    width: w(n) - b,
                    height: w(f) - k
                });
                h.show(!0)
            };
            f.prototype.getLabelText = function(c) {
                return v(c.formatter) ? c.formatter.call(this) : c.text
            };
            f.prototype.destroy = function() {
                q(this.axis.plotLinesAndBands, this);
                delete this.axis;
                t(this)
            };
            return f
        }();
        h(b.prototype, {
            getPlotBandPath: function(c, b, k) {
                void 0 === k && (k = this.options);
                var f = this.getPlotLinePath({
                    value: b,
                    force: !0,
                    acrossPanes: k.acrossPanes
                });
                k = this.getPlotLinePath({
                    value: c,
                    force: !0,
                    acrossPanes: k.acrossPanes
                });
                var h = [],
                    p = this.horiz,
                    n = 1;
                c = c < this.min && b < this.min || c > this.max && b > this.max;
                if (k && f) {
                    if (c) {
                        var u = k.toString() === f.toString();
                        n = 0
                    }
                    for (c = 0; c < k.length; c += 2) {
                        b = k[c];
                        var e = k[c + 1],
                            g = f[c],
                            d = f[c + 1];
                        "M" !== b[0] && "L" !== b[0] || "M" !== e[0] && "L" !== e[0] || "M" !== g[0] && "L" !== g[0] || "M" !== d[0] && "L" !== d[0] || (p && g[1] === b[1] ? (g[1] += n, d[1] += n) : p || g[2] !== b[2] || (g[2] += n, d[2] += n), h.push(["M", b[1], b[2]], ["L", e[1], e[2]], ["L", d[1], d[2]], ["L", g[1], g[2]], ["Z"]));
                        h.isFlat = u
                    }
                }
                return h
            },
            addPlotBand: function(c) {
                return this.addPlotBandOrLine(c, "plotBands")
            },
            addPlotLine: function(c) {
                return this.addPlotBandOrLine(c, "plotLines")
            },
            addPlotBandOrLine: function(c, b) {
                var f = this,
                    k = new l.PlotLineOrBand(this, c),
                    h = this.userOptions;
                this.visible && (k = k.render());
                if (k) {
                    this._addedPlotLB || (this._addedPlotLB = !0, (h.plotLines || []).concat(h.plotBands || []).forEach(function(c) {
                        f.addPlotBandOrLine(c)
                    }));
                    if (b) {
                        var p = h[b] || [];
                        p.push(c);
                        h[b] = p
                    }
                    this.plotLinesAndBands.push(k)
                }
                return k
            },
            removePlotBandOrLine: function(c) {
                for (var f =
                        this.plotLinesAndBands, b = this.options, k = this.userOptions, h = f.length; h--;) f[h].id === c && f[h].destroy();
                [b.plotLines || [], k.plotLines || [], b.plotBands || [], k.plotBands || []].forEach(function(f) {
                    for (h = f.length; h--;)(f[h] || {}).id === c && q(f, f[h])
                })
            },
            removePlotBand: function(c) {
                this.removePlotBandOrLine(c)
            },
            removePlotLine: function(c) {
                this.removePlotBandOrLine(c)
            }
        });
        l.PlotLineOrBand = y;
        return l.PlotLineOrBand
    });
    J(b, "Core/Tooltip.js", [b["Core/Globals.js"], b["Core/Color/Palette.js"], b["Core/Utilities.js"]], function(b,
        l, B) {
        var w = b.doc,
            z = B.clamp,
            C = B.css,
            v = B.defined,
            t = B.discardElement,
            q = B.extend,
            h = B.fireEvent,
            c = B.format,
            p = B.isNumber,
            k = B.isString,
            G = B.merge,
            f = B.pick,
            H = B.splat,
            x = B.syncTimeout,
            K = B.timeUnits;
        "";
        var L = function() {
            function r(c, f) {
                this.container = void 0;
                this.crosshairs = [];
                this.distance = 0;
                this.isHidden = !0;
                this.isSticky = !1;
                this.now = {};
                this.options = {};
                this.outside = !1;
                this.chart = c;
                this.init(c, f)
            }
            r.prototype.applyFilter = function() {
                var c = this.chart;
                c.renderer.definition({
                    tagName: "filter",
                    attributes: {
                        id: "drop-shadow-" +
                            c.index,
                        opacity: .5
                    },
                    children: [{
                        tagName: "feGaussianBlur",
                        attributes: {
                            "in": "SourceAlpha",
                            stdDeviation: 1
                        }
                    }, {
                        tagName: "feOffset",
                        attributes: {
                            dx: 1,
                            dy: 1
                        }
                    }, {
                        tagName: "feComponentTransfer",
                        children: [{
                            tagName: "feFuncA",
                            attributes: {
                                type: "linear",
                                slope: .3
                            }
                        }]
                    }, {
                        tagName: "feMerge",
                        children: [{
                            tagName: "feMergeNode"
                        }, {
                            tagName: "feMergeNode",
                            attributes: {
                                "in": "SourceGraphic"
                            }
                        }]
                    }]
                });
                c.renderer.definition({
                    tagName: "style",
                    textContent: ".highcharts-tooltip-" + c.index + "{filter:url(#drop-shadow-" + c.index + ")}"
                })
            };
            r.prototype.bodyFormatter =
                function(c) {
                    return c.map(function(c) {
                        var e = c.series.tooltipOptions;
                        return (e[(c.point.formatPrefix || "point") + "Formatter"] || c.point.tooltipFormatter).call(c.point, e[(c.point.formatPrefix || "point") + "Format"] || "")
                    })
                };
            r.prototype.cleanSplit = function(c) {
                this.chart.series.forEach(function(f) {
                    var e = f && f.tt;
                    e && (!e.isActive || c ? f.tt = e.destroy() : e.isActive = !1)
                })
            };
            r.prototype.defaultFormatter = function(c) {
                var f = this.points || H(this);
                var e = [c.tooltipFooterHeaderFormatter(f[0])];
                e = e.concat(c.bodyFormatter(f));
                e.push(c.tooltipFooterHeaderFormatter(f[0],
                    !0));
                return e
            };
            r.prototype.destroy = function() {
                this.label && (this.label = this.label.destroy());
                this.split && this.tt && (this.cleanSplit(this.chart, !0), this.tt = this.tt.destroy());
                this.renderer && (this.renderer = this.renderer.destroy(), t(this.container));
                B.clearTimeout(this.hideTimer);
                B.clearTimeout(this.tooltipTimeout)
            };
            r.prototype.getAnchor = function(c, f) {
                var e = this.chart;
                var g = e.pointer;
                var d = e.inverted,
                    a = e.plotTop,
                    m = e.plotLeft,
                    b = 0,
                    n = 0,
                    k, h;
                c = H(c);
                this.followPointer && f ? ("undefined" === typeof f.chartX && (f = g.normalize(f)),
                    g = [f.chartX - m, f.chartY - a]) : c[0].tooltipPos ? g = c[0].tooltipPos : (c.forEach(function(g) {
                    k = g.series.yAxis;
                    h = g.series.xAxis;
                    b += g.plotX || 0;
                    n += g.plotLow ? (g.plotLow + (g.plotHigh || 0)) / 2 : g.plotY || 0;
                    h && k && (d ? (b += a + e.plotHeight - h.len - h.pos, n += m + e.plotWidth - k.len - k.pos) : (b += h.pos - m, n += k.pos - a))
                }), b /= c.length, n /= c.length, g = [d ? e.plotWidth - n : b, d ? e.plotHeight - b : n], this.shared && 1 < c.length && f && (d ? g[0] = f.chartX - m : g[1] = f.chartY - a));
                return g.map(Math.round)
            };
            r.prototype.getDateFormat = function(c, f, e, g) {
                var d = this.chart.time,
                    a = d.dateFormat("%m-%d %H:%M:%S.%L", f),
                    m = {
                        millisecond: 15,
                        second: 12,
                        minute: 9,
                        hour: 6,
                        day: 3
                    },
                    b = "millisecond";
                for (n in K) {
                    if (c === K.week && +d.dateFormat("%w", f) === e && "00:00:00.000" === a.substr(6)) {
                        var n = "week";
                        break
                    }
                    if (K[n] > c) {
                        n = b;
                        break
                    }
                    if (m[n] && a.substr(m[n]) !== "01-01 00:00:00.000".substr(m[n])) break;
                    "week" !== n && (b = n)
                }
                if (n) var k = d.resolveDTLFormat(g[n]).main;
                return k
            };
            r.prototype.getLabel = function() {
                var c, f, e, g = this,
                    d = this.chart.renderer,
                    a = this.chart.styledMode,
                    m = this.options,
                    k = "tooltip" + (v(m.className) ?
                        " " + m.className : ""),
                    h = (null === (c = m.style) || void 0 === c ? void 0 : c.pointerEvents) || (!this.followPointer && m.stickOnContact ? "auto" : "none"),
                    A;
                c = function() {
                    g.inContact = !0
                };
                var p = function() {
                    var a = g.chart.hoverSeries;
                    g.inContact = !1;
                    if (a && a.onMouseOut) a.onMouseOut()
                };
                if (!this.label) {
                    if (this.outside) {
                        var r = null === (f = this.chart.options.chart) || void 0 === f ? void 0 : f.style;
                        this.container = A = b.doc.createElement("div");
                        A.className = "highcharts-tooltip-container";
                        C(A, {
                            position: "absolute",
                            top: "1px",
                            pointerEvents: h,
                            zIndex: Math.max((null ===
                                (e = this.options.style) || void 0 === e ? void 0 : e.zIndex) || 0, ((null === r || void 0 === r ? void 0 : r.zIndex) || 0) + 3)
                        });
                        b.doc.body.appendChild(A);
                        this.renderer = d = new b.Renderer(A, 0, 0, r, void 0, void 0, d.styledMode)
                    }
                    this.split ? this.label = d.g(k) : (this.label = d.label("", 0, 0, m.shape || "callout", null, null, m.useHTML, null, k).attr({
                        padding: m.padding,
                        r: m.borderRadius
                    }), a || this.label.attr({
                        fill: m.backgroundColor,
                        "stroke-width": m.borderWidth
                    }).css(m.style).css({
                        pointerEvents: h
                    }).shadow(m.shadow));
                    a && (this.applyFilter(), this.label.addClass("highcharts-tooltip-" +
                        this.chart.index));
                    if (g.outside && !g.split) {
                        var l = this.label,
                            x = l.xSetter,
                            q = l.ySetter;
                        l.xSetter = function(a) {
                            x.call(l, g.distance);
                            A.style.left = a + "px"
                        };
                        l.ySetter = function(a) {
                            q.call(l, g.distance);
                            A.style.top = a + "px"
                        }
                    }
                    this.label.on("mouseenter", c).on("mouseleave", p).attr({
                        zIndex: 8
                    }).add()
                }
                return this.label
            };
            r.prototype.getPosition = function(c, b, e) {
                var g = this.chart,
                    d = this.distance,
                    a = {},
                    m = g.inverted && e.h || 0,
                    k, n = this.outside,
                    h = n ? w.documentElement.clientWidth - 2 * d : g.chartWidth,
                    u = n ? Math.max(w.body.scrollHeight,
                        w.documentElement.scrollHeight, w.body.offsetHeight, w.documentElement.offsetHeight, w.documentElement.clientHeight) : g.chartHeight,
                    p = g.pointer.getChartPosition(),
                    r = function(a) {
                        var m = "x" === a;
                        return [a, m ? h : u, m ? c : b].concat(n ? [m ? c * p.scaleX : b * p.scaleY, m ? p.left - d + (e.plotX + g.plotLeft) * p.scaleX : p.top - d + (e.plotY + g.plotTop) * p.scaleY, 0, m ? h : u] : [m ? c : b, m ? e.plotX + g.plotLeft : e.plotY + g.plotTop, m ? g.plotLeft : g.plotTop, m ? g.plotLeft + g.plotWidth : g.plotTop + g.plotHeight])
                    },
                    l = r("y"),
                    x = r("x"),
                    q = !this.followPointer && f(e.ttBelow,
                        !g.inverted === !!e.negative),
                    t = function(e, g, c, f, b, k, h) {
                        var E = n ? "y" === e ? d * p.scaleY : d * p.scaleX : d,
                            u = (c - f) / 2,
                            A = f < b - d,
                            D = b + d + f < g,
                            r = b - E - c + u;
                        b = b + E - u;
                        if (q && D) a[e] = b;
                        else if (!q && A) a[e] = r;
                        else if (A) a[e] = Math.min(h - f, 0 > r - m ? r : r - m);
                        else if (D) a[e] = Math.max(k, b + m + c > g ? b : b + m);
                        else return !1
                    },
                    v = function(e, g, m, c, f) {
                        var b;
                        f < d || f > g - d ? b = !1 : a[e] = f < m / 2 ? 1 : f > g - c / 2 ? g - c - 2 : f - m / 2;
                        return b
                    },
                    G = function(a) {
                        var d = l;
                        l = x;
                        x = d;
                        k = a
                    },
                    H = function() {
                        !1 !== t.apply(0, l) ? !1 !== v.apply(0, x) || k || (G(!0), H()) : k ? a.x = a.y = 0 : (G(!0), H())
                    };
                (g.inverted || 1 < this.len) &&
                G();
                H();
                return a
            };
            r.prototype.getXDateFormat = function(c, f, e) {
                f = f.dateTimeLabelFormats;
                var g = e && e.closestPointRange;
                return (g ? this.getDateFormat(g, c.x, e.options.startOfWeek, f) : f.day) || f.year
            };
            r.prototype.hide = function(c) {
                var b = this;
                B.clearTimeout(this.hideTimer);
                c = f(c, this.options.hideDelay, 500);
                this.isHidden || (this.hideTimer = x(function() {
                    b.getLabel().fadeOut(c ? void 0 : c);
                    b.isHidden = !0
                }, c))
            };
            r.prototype.init = function(c, b) {
                this.chart = c;
                this.options = b;
                this.crosshairs = [];
                this.now = {
                    x: 0,
                    y: 0
                };
                this.isHidden = !0;
                this.split = b.split && !c.inverted && !c.polar;
                this.shared = b.shared || this.split;
                this.outside = f(b.outside, !(!c.scrollablePixelsX && !c.scrollablePixelsY))
            };
            r.prototype.isStickyOnContact = function() {
                return !(this.followPointer || !this.options.stickOnContact || !this.inContact)
            };
            r.prototype.move = function(c, f, e, g) {
                var d = this,
                    a = d.now,
                    m = !1 !== d.options.animation && !d.isHidden && (1 < Math.abs(c - a.x) || 1 < Math.abs(f - a.y)),
                    b = d.followPointer || 1 < d.len;
                q(a, {
                    x: m ? (2 * a.x + c) / 3 : c,
                    y: m ? (a.y + f) / 2 : f,
                    anchorX: b ? void 0 : m ? (2 * a.anchorX + e) /
                        3 : e,
                    anchorY: b ? void 0 : m ? (a.anchorY + g) / 2 : g
                });
                d.getLabel().attr(a);
                d.drawTracker();
                m && (B.clearTimeout(this.tooltipTimeout), this.tooltipTimeout = setTimeout(function() {
                    d && d.move(c, f, e, g)
                }, 32))
            };
            r.prototype.refresh = function(c, b) {
                var e = this.chart,
                    g = this.options,
                    d = c,
                    a = {},
                    m = [],
                    k = g.formatter || this.defaultFormatter;
                a = this.shared;
                var n = e.styledMode;
                if (g.enabled) {
                    B.clearTimeout(this.hideTimer);
                    this.followPointer = H(d)[0].series.tooltipOptions.followPointer;
                    var u = this.getAnchor(d, b);
                    b = u[0];
                    var p = u[1];
                    !a || d.series &&
                        d.series.noSharedTooltip ? a = d.getLabelConfig() : (e.pointer.applyInactiveState(d), d.forEach(function(a) {
                            a.setState("hover");
                            m.push(a.getLabelConfig())
                        }), a = {
                            x: d[0].category,
                            y: d[0].y
                        }, a.points = m, d = d[0]);
                    this.len = m.length;
                    e = k.call(a, this);
                    k = d.series;
                    this.distance = f(k.tooltipOptions.distance, 16);
                    !1 === e ? this.hide() : (this.split ? this.renderSplit(e, H(c)) : (c = this.getLabel(), g.style.width && !n || c.css({
                        width: this.chart.spacingBox.width + "px"
                    }), c.attr({
                        text: e && e.join ? e.join("") : e
                    }), c.removeClass(/highcharts-color-[\d]+/g).addClass("highcharts-color-" +
                        f(d.colorIndex, k.colorIndex)), n || c.attr({
                        stroke: g.borderColor || d.color || k.color || l.neutralColor60
                    }), this.updatePosition({
                        plotX: b,
                        plotY: p,
                        negative: d.negative,
                        ttBelow: d.ttBelow,
                        h: u[2] || 0
                    })), this.isHidden && this.label && this.label.attr({
                        opacity: 1
                    }).show(), this.isHidden = !1);
                    h(this, "refresh")
                }
            };
            r.prototype.renderSplit = function(c, h) {
                function e(a, d, e, g, c) {
                    void 0 === c && (c = !0);
                    e ? (d = S ? 0 : U, a = z(a - g / 2, C.left, C.right - g)) : (d -= P, a = c ? a - g - w : a + w, a = z(a, c ? a : C.left, C.right));
                    return {
                        x: a,
                        y: d
                    }
                }
                var g = this,
                    d = g.chart,
                    a = g.chart,
                    m = a.plotHeight,
                    n = a.plotLeft,
                    u = a.plotTop,
                    A = a.pointer,
                    p = a.renderer,
                    r = a.scrollablePixelsY,
                    x = void 0 === r ? 0 : r;
                r = a.scrollingContainer;
                r = void 0 === r ? {
                    scrollLeft: 0,
                    scrollTop: 0
                } : r;
                var t = r.scrollLeft,
                    v = r.scrollTop,
                    G = a.styledMode,
                    w = g.distance,
                    H = g.options,
                    L = g.options.positioner,
                    C = {
                        left: t,
                        right: t + a.chartWidth,
                        top: v,
                        bottom: v + a.chartHeight
                    },
                    D = g.getLabel(),
                    S = !(!d.xAxis[0] || !d.xAxis[0].opposite),
                    P = u + v,
                    K = 0,
                    U = m - x;
                k(c) && (c = [!1, c]);
                c = c.slice(0, h.length + 1).reduce(function(a, d, c) {
                    if (!1 !== d && "" !== d) {
                        c = h[c - 1] || {
                            isHeader: !0,
                            plotX: h[0].plotX,
                            plotY: m,
                            series: {}
                        };
                        var b = c.isHeader,
                            k = b ? g : c.series,
                            E = k.tt,
                            A = c.isHeader;
                        var r = c.series;
                        var I = "highcharts-color-" + f(c.colorIndex, r.colorIndex, "none");
                        E || (E = {
                            padding: H.padding,
                            r: H.borderRadius
                        }, G || (E.fill = H.backgroundColor, E["stroke-width"] = H.borderWidth), E = p.label("", 0, 0, H[A ? "headerShape" : "shape"] || "callout", void 0, void 0, H.useHTML).addClass((A ? "highcharts-tooltip-header " : "") + "highcharts-tooltip-box " + I).attr(E).add(D));
                        E.isActive = !0;
                        E.attr({
                            text: d
                        });
                        G || E.css(H.style).shadow(H.shadow).attr({
                            stroke: H.borderColor ||
                                c.color || r.color || l.neutralColor80
                        });
                        d = k.tt = E;
                        A = d.getBBox();
                        k = A.width + d.strokeWidth();
                        b && (K = A.height, U += K, S && (P -= K));
                        r = c.plotX;
                        r = void 0 === r ? 0 : r;
                        I = c.plotY;
                        I = void 0 === I ? 0 : I;
                        var q = c.series;
                        if (c.isHeader) {
                            r = n + r;
                            var N = u + m / 2
                        } else E = q.xAxis, q = q.yAxis, r = E.pos + z(r, -w, E.len + w), q.pos + I >= v + u && q.pos + I <= v + u + m - x && (N = q.pos + I);
                        r = z(r, C.left - w, C.right + w);
                        "number" === typeof N ? (A = A.height + 1, I = L ? L.call(g, k, A, c) : e(r, N, b, k), a.push({
                            align: L ? 0 : void 0,
                            anchorX: r,
                            anchorY: N,
                            boxWidth: k,
                            point: c,
                            rank: f(I.rank, b ? 1 : 0),
                            size: A,
                            target: I.y,
                            tt: d,
                            x: I.x
                        })) : d.isActive = !1
                    }
                    return a
                }, []);
                !L && c.some(function(a) {
                    return a.x < C.left
                }) && (c = c.map(function(a) {
                    var d = e(a.anchorX, a.anchorY, a.point.isHeader, a.boxWidth, !1);
                    return q(a, {
                        target: d.y,
                        x: d.x
                    })
                }));
                g.cleanSplit();
                b.distribute(c, U);
                c.forEach(function(a) {
                    var d = a.pos;
                    a.tt.attr({
                        visibility: "undefined" === typeof d ? "hidden" : "inherit",
                        x: a.x,
                        y: d + P,
                        anchorX: a.anchorX,
                        anchorY: a.anchorY
                    })
                });
                c = g.container;
                d = g.renderer;
                g.outside && c && d && (a = D.getBBox(), d.setSize(a.width + a.x, a.height + a.y, !1), A = A.getChartPosition(),
                    c.style.left = A.left + "px", c.style.top = A.top + "px")
            };
            r.prototype.drawTracker = function() {
                if (this.followPointer || !this.options.stickOnContact) this.tracker && this.tracker.destroy();
                else {
                    var c = this.chart,
                        f = this.label,
                        e = c.hoverPoint;
                    if (f && e) {
                        var g = {
                            x: 0,
                            y: 0,
                            width: 0,
                            height: 0
                        };
                        e = this.getAnchor(e);
                        var d = f.getBBox();
                        e[0] += c.plotLeft - f.translateX;
                        e[1] += c.plotTop - f.translateY;
                        g.x = Math.min(0, e[0]);
                        g.y = Math.min(0, e[1]);
                        g.width = 0 > e[0] ? Math.max(Math.abs(e[0]), d.width - e[0]) : Math.max(Math.abs(e[0]), d.width);
                        g.height = 0 >
                            e[1] ? Math.max(Math.abs(e[1]), d.height - Math.abs(e[1])) : Math.max(Math.abs(e[1]), d.height);
                        this.tracker ? this.tracker.attr(g) : (this.tracker = f.renderer.rect(g).addClass("highcharts-tracker").add(f), c.styledMode || this.tracker.attr({
                            fill: "rgba(0,0,0,0)"
                        }))
                    }
                }
            };
            r.prototype.styledModeFormat = function(c) {
                return c.replace('style="font-size: 10px"', 'class="highcharts-header"').replace(/style="color:{(point|series)\.color}"/g, 'class="highcharts-color-{$1.colorIndex}"')
            };
            r.prototype.tooltipFooterHeaderFormatter =
                function(f, b) {
                    var e = b ? "footer" : "header",
                        g = f.series,
                        d = g.tooltipOptions,
                        a = d.xDateFormat,
                        m = g.xAxis,
                        k = m && "datetime" === m.options.type && p(f.key),
                        n = d[e + "Format"];
                    b = {
                        isFooter: b,
                        labelConfig: f
                    };
                    h(this, "headerFormatter", b, function(e) {
                        k && !a && (a = this.getXDateFormat(f, d, m));
                        k && a && (f.point && f.point.tooltipDateKeys || ["key"]).forEach(function(d) {
                            n = n.replace("{point." + d + "}", "{point." + d + ":" + a + "}")
                        });
                        g.chart.styledMode && (n = this.styledModeFormat(n));
                        e.text = c(n, {
                            point: f,
                            series: g
                        }, this.chart)
                    });
                    return b.text
                };
            r.prototype.update =
                function(c) {
                    this.destroy();
                    G(!0, this.chart.options.tooltip.userOptions, c);
                    this.init(this.chart, G(!0, this.options, c))
                };
            r.prototype.updatePosition = function(c) {
                var f = this.chart,
                    e = f.pointer,
                    g = this.getLabel(),
                    d = c.plotX + f.plotLeft;
                f = c.plotY + f.plotTop;
                e = e.getChartPosition();
                c = (this.options.positioner || this.getPosition).call(this, g.width, g.height, c);
                if (this.outside) {
                    var a = (this.options.borderWidth || 0) + 2 * this.distance;
                    this.renderer.setSize(g.width + a, g.height + a, !1);
                    if (1 !== e.scaleX || 1 !== e.scaleY) C(this.container, {
                        transform: "scale(" + e.scaleX + ", " + e.scaleY + ")"
                    }), d *= e.scaleX, f *= e.scaleY;
                    d += e.left - c.x;
                    f += e.top - c.y
                }
                this.move(Math.round(c.x), Math.round(c.y || 0), d, f)
            };
            return r
        }();
        b.Tooltip = L;
        return b.Tooltip
    });
    J(b, "Core/Pointer.js", [b["Core/Color/Color.js"], b["Core/Globals.js"], b["Core/Color/Palette.js"], b["Core/Tooltip.js"], b["Core/Utilities.js"]], function(b, l, B, y, z) {
        var w = b.parse,
            v = l.charts,
            t = l.noop,
            q = z.addEvent,
            h = z.attr,
            c = z.css,
            p = z.defined,
            k = z.extend,
            G = z.find,
            f = z.fireEvent,
            H = z.isNumber,
            x = z.isObject,
            K = z.objectEach,
            L = z.offset,
            r = z.pick,
            n = z.splat;
        "";
        b = function() {
            function b(e, g) {
                this.lastValidTouch = {};
                this.pinchDown = [];
                this.runChartClick = !1;
                this.chart = e;
                this.hasDragged = !1;
                this.options = g;
                this.unbindContainerMouseLeave = function() {};
                this.unbindContainerMouseEnter = function() {};
                this.init(e, g)
            }
            b.prototype.applyInactiveState = function(e) {
                var g = [],
                    d;
                (e || []).forEach(function(a) {
                    d = a.series;
                    g.push(d);
                    d.linkedParent && g.push(d.linkedParent);
                    d.linkedSeries && (g = g.concat(d.linkedSeries));
                    d.navigatorSeries && g.push(d.navigatorSeries)
                });
                this.chart.series.forEach(function(a) {
                    -1 === g.indexOf(a) ? a.setState("inactive", !0) : a.options.inactiveOtherPoints && a.setAllPointsToState("inactive")
                })
            };
            b.prototype.destroy = function() {
                var e = this;
                "undefined" !== typeof e.unDocMouseMove && e.unDocMouseMove();
                this.unbindContainerMouseLeave();
                l.chartCount || (l.unbindDocumentMouseUp && (l.unbindDocumentMouseUp = l.unbindDocumentMouseUp()), l.unbindDocumentTouchEnd && (l.unbindDocumentTouchEnd = l.unbindDocumentTouchEnd()));
                clearInterval(e.tooltipTimeout);
                K(e, function(g,
                    d) {
                    e[d] = void 0
                })
            };
            b.prototype.drag = function(e) {
                var g = this.chart,
                    d = g.options.chart,
                    a = e.chartX,
                    c = e.chartY,
                    f = this.zoomHor,
                    b = this.zoomVert,
                    k = g.plotLeft,
                    h = g.plotTop,
                    n = g.plotWidth,
                    p = g.plotHeight,
                    u = this.selectionMarker,
                    r = this.mouseDownX || 0,
                    l = this.mouseDownY || 0,
                    q = x(d.panning) ? d.panning && d.panning.enabled : d.panning,
                    t = d.panKey && e[d.panKey + "Key"];
                if (!u || !u.touch)
                    if (a < k ? a = k : a > k + n && (a = k + n), c < h ? c = h : c > h + p && (c = h + p), this.hasDragged = Math.sqrt(Math.pow(r - a, 2) + Math.pow(l - c, 2)), 10 < this.hasDragged) {
                        var v = g.isInsidePlot(r -
                            k, l - h);
                        g.hasCartesianSeries && (this.zoomX || this.zoomY) && v && !t && !u && (this.selectionMarker = u = g.renderer.rect(k, h, f ? 1 : n, b ? 1 : p, 0).attr({
                            "class": "highcharts-selection-marker",
                            zIndex: 7
                        }).add(), g.styledMode || u.attr({
                            fill: d.selectionMarkerFill || w(B.highlightColor80).setOpacity(.25).get()
                        }));
                        u && f && (a -= r, u.attr({
                            width: Math.abs(a),
                            x: (0 < a ? 0 : a) + r
                        }));
                        u && b && (a = c - l, u.attr({
                            height: Math.abs(a),
                            y: (0 < a ? 0 : a) + l
                        }));
                        v && !u && q && g.pan(e, d.panning)
                    }
            };
            b.prototype.dragStart = function(e) {
                var g = this.chart;
                g.mouseIsDown = e.type;
                g.cancelClick = !1;
                g.mouseDownX = this.mouseDownX = e.chartX;
                g.mouseDownY = this.mouseDownY = e.chartY
            };
            b.prototype.drop = function(e) {
                var g = this,
                    d = this.chart,
                    a = this.hasPinched;
                if (this.selectionMarker) {
                    var m = {
                            originalEvent: e,
                            xAxis: [],
                            yAxis: []
                        },
                        b = this.selectionMarker,
                        h = b.attr ? b.attr("x") : b.x,
                        n = b.attr ? b.attr("y") : b.y,
                        u = b.attr ? b.attr("width") : b.width,
                        r = b.attr ? b.attr("height") : b.height,
                        l;
                    if (this.hasDragged || a) d.axes.forEach(function(d) {
                        if (d.zoomEnabled && p(d.min) && (a || g[{
                                xAxis: "zoomX",
                                yAxis: "zoomY"
                            } [d.coll]]) && H(h) && H(n)) {
                            var c =
                                d.horiz,
                                f = "touchend" === e.type ? d.minPixelPadding : 0,
                                b = d.toValue((c ? h : n) + f);
                            c = d.toValue((c ? h + u : n + r) - f);
                            m[d.coll].push({
                                axis: d,
                                min: Math.min(b, c),
                                max: Math.max(b, c)
                            });
                            l = !0
                        }
                    }), l && f(d, "selection", m, function(e) {
                        d.zoom(k(e, a ? {
                            animation: !1
                        } : null))
                    });
                    H(d.index) && (this.selectionMarker = this.selectionMarker.destroy());
                    a && this.scaleGroups()
                }
                d && H(d.index) && (c(d.container, {
                    cursor: d._cursor
                }), d.cancelClick = 10 < this.hasDragged, d.mouseIsDown = this.hasDragged = this.hasPinched = !1, this.pinchDown = [])
            };
            b.prototype.findNearestKDPoint =
                function(e, g, d) {
                    var a = this.chart,
                        c = a.hoverPoint;
                    a = a.tooltip;
                    if (c && a && a.isStickyOnContact()) return c;
                    var f;
                    e.forEach(function(a) {
                        var e = !(a.noSharedTooltip && g) && 0 > a.options.findNearestPointBy.indexOf("y");
                        a = a.searchPoint(d, e);
                        if ((e = x(a, !0) && a.series) && !(e = !x(f, !0))) {
                            e = f.distX - a.distX;
                            var c = f.dist - a.dist,
                                m = (a.series.group && a.series.group.zIndex) - (f.series.group && f.series.group.zIndex);
                            e = 0 < (0 !== e && g ? e : 0 !== c ? c : 0 !== m ? m : f.series.index > a.series.index ? -1 : 1)
                        }
                        e && (f = a)
                    });
                    return f
                };
            b.prototype.getChartCoordinatesFromPoint =
                function(e, c) {
                    var d = e.series,
                        a = d.xAxis;
                    d = d.yAxis;
                    var g = r(e.clientX, e.plotX),
                        f = e.shapeArgs;
                    if (a && d) return c ? {
                        chartX: a.len + a.pos - g,
                        chartY: d.len + d.pos - e.plotY
                    } : {
                        chartX: g + a.pos,
                        chartY: e.plotY + d.pos
                    };
                    if (f && f.x && f.y) return {
                        chartX: f.x,
                        chartY: f.y
                    }
                };
            b.prototype.getChartPosition = function() {
                if (this.chartPosition) return this.chartPosition;
                var e = this.chart.container,
                    c = L(e);
                this.chartPosition = {
                    left: c.left,
                    top: c.top,
                    scaleX: 1,
                    scaleY: 1
                };
                var d = e.offsetWidth;
                e = e.offsetHeight;
                2 < d && 2 < e && (this.chartPosition.scaleX = c.width /
                    d, this.chartPosition.scaleY = c.height / e);
                return this.chartPosition
            };
            b.prototype.getCoordinates = function(e) {
                var c = {
                    xAxis: [],
                    yAxis: []
                };
                this.chart.axes.forEach(function(d) {
                    c[d.isXAxis ? "xAxis" : "yAxis"].push({
                        axis: d,
                        value: d.toValue(e[d.horiz ? "chartX" : "chartY"])
                    })
                });
                return c
            };
            b.prototype.getHoverData = function(e, c, d, a, m, b) {
                var g, k = [];
                a = !(!a || !e);
                var h = c && !c.stickyTracking,
                    n = {
                        chartX: b ? b.chartX : void 0,
                        chartY: b ? b.chartY : void 0,
                        shared: m
                    };
                f(this, "beforeGetHoverData", n);
                h = h ? [c] : d.filter(function(a) {
                    return n.filter ?
                        n.filter(a) : a.visible && !(!m && a.directTouch) && r(a.options.enableMouseTracking, !0) && a.stickyTracking
                });
                c = (g = a || !b ? e : this.findNearestKDPoint(h, m, b)) && g.series;
                g && (m && !c.noSharedTooltip ? (h = d.filter(function(a) {
                    return n.filter ? n.filter(a) : a.visible && !(!m && a.directTouch) && r(a.options.enableMouseTracking, !0) && !a.noSharedTooltip
                }), h.forEach(function(a) {
                    var d = G(a.points, function(a) {
                        return a.x === g.x && !a.isNull
                    });
                    x(d) && (a.chart.isBoosting && (d = a.getPoint(d)), k.push(d))
                })) : k.push(g));
                n = {
                    hoverPoint: g
                };
                f(this, "afterGetHoverData",
                    n);
                return {
                    hoverPoint: n.hoverPoint,
                    hoverSeries: c,
                    hoverPoints: k
                }
            };
            b.prototype.getPointFromEvent = function(e) {
                e = e.target;
                for (var c; e && !c;) c = e.point, e = e.parentNode;
                return c
            };
            b.prototype.onTrackerMouseOut = function(e) {
                e = e.relatedTarget || e.toElement;
                var c = this.chart.hoverSeries;
                this.isDirectTouch = !1;
                if (!(!c || !e || c.stickyTracking || this.inClass(e, "highcharts-tooltip") || this.inClass(e, "highcharts-series-" + c.index) && this.inClass(e, "highcharts-tracker"))) c.onMouseOut()
            };
            b.prototype.inClass = function(e, c) {
                for (var d; e;) {
                    if (d =
                        h(e, "class")) {
                        if (-1 !== d.indexOf(c)) return !0;
                        if (-1 !== d.indexOf("highcharts-container")) return !1
                    }
                    e = e.parentNode
                }
            };
            b.prototype.init = function(e, c) {
                this.options = c;
                this.chart = e;
                this.runChartClick = c.chart.events && !!c.chart.events.click;
                this.pinchDown = [];
                this.lastValidTouch = {};
                y && (e.tooltip = new y(e, c.tooltip), this.followTouchMove = r(c.tooltip.followTouchMove, !0));
                this.setDOMEvents()
            };
            b.prototype.normalize = function(e, c) {
                var d = e.touches,
                    a = d ? d.length ? d.item(0) : r(d.changedTouches, e.changedTouches)[0] : e;
                c || (c =
                    this.getChartPosition());
                d = a.pageX - c.left;
                a = a.pageY - c.top;
                d /= c.scaleX;
                a /= c.scaleY;
                return k(e, {
                    chartX: Math.round(d),
                    chartY: Math.round(a)
                })
            };
            b.prototype.onContainerClick = function(e) {
                var c = this.chart,
                    d = c.hoverPoint;
                e = this.normalize(e);
                var a = c.plotLeft,
                    m = c.plotTop;
                c.cancelClick || (d && this.inClass(e.target, "highcharts-tracker") ? (f(d.series, "click", k(e, {
                    point: d
                })), c.hoverPoint && d.firePointEvent("click", e)) : (k(e, this.getCoordinates(e)), c.isInsidePlot(e.chartX - a, e.chartY - m) && f(c, "click", e)))
            };
            b.prototype.onContainerMouseDown =
                function(e) {
                    var c = 1 === ((e.buttons || e.button) & 1);
                    e = this.normalize(e);
                    if (l.isFirefox && 0 !== e.button) this.onContainerMouseMove(e);
                    if ("undefined" === typeof e.button || c) this.zoomOption(e), c && e.preventDefault && e.preventDefault(), this.dragStart(e)
                };
            b.prototype.onContainerMouseLeave = function(e) {
                var c = v[r(l.hoverChartIndex, -1)],
                    d = this.chart.tooltip;
                e = this.normalize(e);
                c && (e.relatedTarget || e.toElement) && (c.pointer.reset(), c.pointer.chartPosition = void 0);
                d && !d.isHidden && this.reset()
            };
            b.prototype.onContainerMouseEnter =
                function(e) {
                    delete this.chartPosition
                };
            b.prototype.onContainerMouseMove = function(e) {
                var c = this.chart;
                e = this.normalize(e);
                this.setHoverChartIndex();
                e.preventDefault || (e.returnValue = !1);
                ("mousedown" === c.mouseIsDown || this.touchSelect(e)) && this.drag(e);
                c.openMenu || !this.inClass(e.target, "highcharts-tracker") && !c.isInsidePlot(e.chartX - c.plotLeft, e.chartY - c.plotTop) || this.runPointActions(e)
            };
            b.prototype.onDocumentTouchEnd = function(e) {
                v[l.hoverChartIndex] && v[l.hoverChartIndex].pointer.drop(e)
            };
            b.prototype.onContainerTouchMove =
                function(e) {
                    if (this.touchSelect(e)) this.onContainerMouseMove(e);
                    else this.touch(e)
                };
            b.prototype.onContainerTouchStart = function(e) {
                if (this.touchSelect(e)) this.onContainerMouseDown(e);
                else this.zoomOption(e), this.touch(e, !0)
            };
            b.prototype.onDocumentMouseMove = function(e) {
                var c = this.chart,
                    d = this.chartPosition;
                e = this.normalize(e, d);
                var a = c.tooltip;
                !d || a && a.isStickyOnContact() || c.isInsidePlot(e.chartX - c.plotLeft, e.chartY - c.plotTop) || this.inClass(e.target, "highcharts-tracker") || this.reset()
            };
            b.prototype.onDocumentMouseUp =
                function(e) {
                    var c = v[r(l.hoverChartIndex, -1)];
                    c && c.pointer.drop(e)
                };
            b.prototype.pinch = function(e) {
                var c = this,
                    d = c.chart,
                    a = c.pinchDown,
                    m = e.touches || [],
                    f = m.length,
                    b = c.lastValidTouch,
                    h = c.hasZoom,
                    n = c.selectionMarker,
                    p = {},
                    u = 1 === f && (c.inClass(e.target, "highcharts-tracker") && d.runTrackerClick || c.runChartClick),
                    l = {};
                1 < f && (c.initiated = !0);
                h && c.initiated && !u && !1 !== e.cancelable && e.preventDefault();
                [].map.call(m, function(a) {
                    return c.normalize(a)
                });
                "touchstart" === e.type ? ([].forEach.call(m, function(d, e) {
                    a[e] = {
                        chartX: d.chartX,
                        chartY: d.chartY
                    }
                }), b.x = [a[0].chartX, a[1] && a[1].chartX], b.y = [a[0].chartY, a[1] && a[1].chartY], d.axes.forEach(function(a) {
                    if (a.zoomEnabled) {
                        var e = d.bounds[a.horiz ? "h" : "v"],
                            c = a.minPixelPadding,
                            m = a.toPixels(Math.min(r(a.options.min, a.dataMin), a.dataMin)),
                            g = a.toPixels(Math.max(r(a.options.max, a.dataMax), a.dataMax)),
                            f = Math.max(m, g);
                        e.min = Math.min(a.pos, Math.min(m, g) - c);
                        e.max = Math.max(a.pos + a.len, f + c)
                    }
                }), c.res = !0) : c.followTouchMove && 1 === f ? this.runPointActions(c.normalize(e)) : a.length && (n || (c.selectionMarker =
                    n = k({
                        destroy: t,
                        touch: !0
                    }, d.plotBox)), c.pinchTranslate(a, m, p, n, l, b), c.hasPinched = h, c.scaleGroups(p, l), c.res && (c.res = !1, this.reset(!1, 0)))
            };
            b.prototype.pinchTranslate = function(e, c, d, a, m, f) {
                this.zoomHor && this.pinchTranslateDirection(!0, e, c, d, a, m, f);
                this.zoomVert && this.pinchTranslateDirection(!1, e, c, d, a, m, f)
            };
            b.prototype.pinchTranslateDirection = function(e, c, d, a, m, f, b, k) {
                var g = this.chart,
                    h = e ? "x" : "y",
                    n = e ? "X" : "Y",
                    E = "chart" + n,
                    p = e ? "width" : "height",
                    u = g["plot" + (e ? "Left" : "Top")],
                    A, r, l = k || 1,
                    I = g.inverted,
                    D = g.bounds[e ?
                        "h" : "v"],
                    x = 1 === c.length,
                    q = c[0][E],
                    t = d[0][E],
                    v = !x && c[1][E],
                    G = !x && d[1][E];
                d = function() {
                    "number" === typeof G && 20 < Math.abs(q - v) && (l = k || Math.abs(t - G) / Math.abs(q - v));
                    r = (u - t) / l + q;
                    A = g["plot" + (e ? "Width" : "Height")] / l
                };
                d();
                c = r;
                if (c < D.min) {
                    c = D.min;
                    var w = !0
                } else c + A > D.max && (c = D.max - A, w = !0);
                w ? (t -= .8 * (t - b[h][0]), "number" === typeof G && (G -= .8 * (G - b[h][1])), d()) : b[h] = [t, G];
                I || (f[h] = r - u, f[p] = A);
                f = I ? 1 / l : l;
                m[p] = A;
                m[h] = c;
                a[I ? e ? "scaleY" : "scaleX" : "scale" + n] = l;
                a["translate" + n] = f * u + (t - f * q)
            };
            b.prototype.reset = function(e, c) {
                var d =
                    this.chart,
                    a = d.hoverSeries,
                    m = d.hoverPoint,
                    g = d.hoverPoints,
                    f = d.tooltip,
                    b = f && f.shared ? g : m;
                e && b && n(b).forEach(function(a) {
                    a.series.isCartesian && "undefined" === typeof a.plotX && (e = !1)
                });
                if (e) f && b && n(b).length && (f.refresh(b), f.shared && g ? g.forEach(function(a) {
                    a.setState(a.state, !0);
                    a.series.isCartesian && (a.series.xAxis.crosshair && a.series.xAxis.drawCrosshair(null, a), a.series.yAxis.crosshair && a.series.yAxis.drawCrosshair(null, a))
                }) : m && (m.setState(m.state, !0), d.axes.forEach(function(a) {
                    a.crosshair && m.series[a.coll] ===
                        a && a.drawCrosshair(null, m)
                })));
                else {
                    if (m) m.onMouseOut();
                    g && g.forEach(function(a) {
                        a.setState()
                    });
                    if (a) a.onMouseOut();
                    f && f.hide(c);
                    this.unDocMouseMove && (this.unDocMouseMove = this.unDocMouseMove());
                    d.axes.forEach(function(a) {
                        a.hideCrosshair()
                    });
                    this.hoverX = d.hoverPoints = d.hoverPoint = null
                }
            };
            b.prototype.runPointActions = function(e, c) {
                var d = this.chart,
                    a = d.tooltip && d.tooltip.options.enabled ? d.tooltip : void 0,
                    m = a ? a.shared : !1,
                    g = c || d.hoverPoint,
                    f = g && g.series || d.hoverSeries;
                f = this.getHoverData(g, f, d.series, (!e ||
                    "touchmove" !== e.type) && (!!c || f && f.directTouch && this.isDirectTouch), m, e);
                g = f.hoverPoint;
                var b = f.hoverPoints;
                c = (f = f.hoverSeries) && f.tooltipOptions.followPointer;
                m = m && f && !f.noSharedTooltip;
                if (g && (g !== d.hoverPoint || a && a.isHidden)) {
                    (d.hoverPoints || []).forEach(function(a) {
                        -1 === b.indexOf(a) && a.setState()
                    });
                    if (d.hoverSeries !== f) f.onMouseOver();
                    this.applyInactiveState(b);
                    (b || []).forEach(function(a) {
                        a.setState("hover")
                    });
                    d.hoverPoint && d.hoverPoint.firePointEvent("mouseOut");
                    if (!g.series) return;
                    d.hoverPoints =
                        b;
                    d.hoverPoint = g;
                    g.firePointEvent("mouseOver");
                    a && a.refresh(m ? b : g, e)
                } else c && a && !a.isHidden && (g = a.getAnchor([{}], e), a.updatePosition({
                    plotX: g[0],
                    plotY: g[1]
                }));
                this.unDocMouseMove || (this.unDocMouseMove = q(d.container.ownerDocument, "mousemove", function(a) {
                    var d = v[l.hoverChartIndex];
                    if (d) d.pointer.onDocumentMouseMove(a)
                }));
                d.axes.forEach(function(a) {
                    var c = r((a.crosshair || {}).snap, !0),
                        m;
                    c && ((m = d.hoverPoint) && m.series[a.coll] === a || (m = G(b, function(d) {
                        return d.series[a.coll] === a
                    })));
                    m || !c ? a.drawCrosshair(e,
                        m) : a.hideCrosshair()
                })
            };
            b.prototype.scaleGroups = function(e, c) {
                var d = this.chart,
                    a;
                d.series.forEach(function(m) {
                    a = e || m.getPlotBox();
                    m.xAxis && m.xAxis.zoomEnabled && m.group && (m.group.attr(a), m.markerGroup && (m.markerGroup.attr(a), m.markerGroup.clip(c ? d.clipRect : null)), m.dataLabelsGroup && m.dataLabelsGroup.attr(a))
                });
                d.clipRect.attr(c || d.clipBox)
            };
            b.prototype.setDOMEvents = function() {
                var e = this,
                    c = this.chart.container,
                    d = c.ownerDocument;
                c.onmousedown = this.onContainerMouseDown.bind(this);
                c.onmousemove = this.onContainerMouseMove.bind(this);
                c.onclick = this.onContainerClick.bind(this);
                this.unbindContainerMouseEnter = q(c, "mouseenter", this.onContainerMouseEnter.bind(this));
                this.unbindContainerMouseLeave = q(c, "mouseleave", this.onContainerMouseLeave.bind(this));
                l.unbindDocumentMouseUp || (l.unbindDocumentMouseUp = q(d, "mouseup", this.onDocumentMouseUp.bind(this)));
                for (var a = this.chart.renderTo.parentElement; a && "BODY" !== a.tagName;) q(a, "scroll", function() {
                    delete e.chartPosition
                }), a = a.parentElement;
                l.hasTouch && (q(c, "touchstart", this.onContainerTouchStart.bind(this), {
                    passive: !1
                }), q(c, "touchmove", this.onContainerTouchMove.bind(this), {
                    passive: !1
                }), l.unbindDocumentTouchEnd || (l.unbindDocumentTouchEnd = q(d, "touchend", this.onDocumentTouchEnd.bind(this), {
                    passive: !1
                })))
            };
            b.prototype.setHoverChartIndex = function() {
                var e = this.chart,
                    c = l.charts[r(l.hoverChartIndex, -1)];
                if (c && c !== e) c.pointer.onContainerMouseLeave({
                    relatedTarget: !0
                });
                c && c.mouseIsDown || (l.hoverChartIndex = e.index)
            };
            b.prototype.touch = function(e, c) {
                var d = this.chart,
                    a;
                this.setHoverChartIndex();
                if (1 === e.touches.length)
                    if (e =
                        this.normalize(e), (a = d.isInsidePlot(e.chartX - d.plotLeft, e.chartY - d.plotTop)) && !d.openMenu) {
                        c && this.runPointActions(e);
                        if ("touchmove" === e.type) {
                            c = this.pinchDown;
                            var m = c[0] ? 4 <= Math.sqrt(Math.pow(c[0].chartX - e.chartX, 2) + Math.pow(c[0].chartY - e.chartY, 2)) : !1
                        }
                        r(m, !0) && this.pinch(e)
                    } else c && this.reset();
                else 2 === e.touches.length && this.pinch(e)
            };
            b.prototype.touchSelect = function(e) {
                return !(!this.chart.options.chart.zoomBySingleTouch || !e.touches || 1 !== e.touches.length)
            };
            b.prototype.zoomOption = function(e) {
                var c =
                    this.chart,
                    d = c.options.chart,
                    a = d.zoomType || "";
                c = c.inverted;
                /touch/.test(e.type) && (a = r(d.pinchType, a));
                this.zoomX = e = /x/.test(a);
                this.zoomY = a = /y/.test(a);
                this.zoomHor = e && !c || a && c;
                this.zoomVert = a && !c || e && c;
                this.hasZoom = e || a
            };
            return b
        }();
        return l.Pointer = b
    });
    J(b, "Core/MSPointer.js", [b["Core/Globals.js"], b["Core/Pointer.js"], b["Core/Utilities.js"]], function(b, l, B) {
        function w() {
            var c = [];
            c.item = function(c) {
                return this[c]
            };
            p(G, function(f) {
                c.push({
                    pageX: f.pageX,
                    pageY: f.pageY,
                    target: f.target
                })
            });
            return c
        }

        function z(c,
            f, k, h) {
            "touch" !== c.pointerType && c.pointerType !== c.MSPOINTER_TYPE_TOUCH || !v[b.hoverChartIndex] || (h(c), h = v[b.hoverChartIndex].pointer, h[f]({
                type: k,
                target: c.currentTarget,
                preventDefault: q,
                touches: w()
            }))
        }
        var C = this && this.__extends || function() {
                var c = function(f, b) {
                    c = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(c, f) {
                        c.__proto__ = f
                    } || function(c, f) {
                        for (var b in f) f.hasOwnProperty(b) && (c[b] = f[b])
                    };
                    return c(f, b)
                };
                return function(f, b) {
                    function k() {
                        this.constructor = f
                    }
                    c(f, b);
                    f.prototype = null ===
                        b ? Object.create(b) : (k.prototype = b.prototype, new k)
                }
            }(),
            v = b.charts,
            t = b.doc,
            q = b.noop,
            h = B.addEvent,
            c = B.css,
            p = B.objectEach,
            k = B.removeEvent,
            G = {},
            f = !!b.win.PointerEvent;
        return function(b) {
            function p() {
                return null !== b && b.apply(this, arguments) || this
            }
            C(p, b);
            p.prototype.batchMSEvents = function(c) {
                c(this.chart.container, f ? "pointerdown" : "MSPointerDown", this.onContainerPointerDown);
                c(this.chart.container, f ? "pointermove" : "MSPointerMove", this.onContainerPointerMove);
                c(t, f ? "pointerup" : "MSPointerUp", this.onDocumentPointerUp)
            };
            p.prototype.destroy = function() {
                this.batchMSEvents(k);
                b.prototype.destroy.call(this)
            };
            p.prototype.init = function(f, k) {
                b.prototype.init.call(this, f, k);
                this.hasZoom && c(f.container, {
                    "-ms-touch-action": "none",
                    "touch-action": "none"
                })
            };
            p.prototype.onContainerPointerDown = function(c) {
                z(c, "onContainerTouchStart", "touchstart", function(c) {
                    G[c.pointerId] = {
                        pageX: c.pageX,
                        pageY: c.pageY,
                        target: c.currentTarget
                    }
                })
            };
            p.prototype.onContainerPointerMove = function(c) {
                z(c, "onContainerTouchMove", "touchmove", function(c) {
                    G[c.pointerId] = {
                        pageX: c.pageX,
                        pageY: c.pageY
                    };
                    G[c.pointerId].target || (G[c.pointerId].target = c.currentTarget)
                })
            };
            p.prototype.onDocumentPointerUp = function(c) {
                z(c, "onDocumentTouchEnd", "touchend", function(c) {
                    delete G[c.pointerId]
                })
            };
            p.prototype.setDOMEvents = function() {
                b.prototype.setDOMEvents.call(this);
                (this.hasZoom || this.followTouchMove) && this.batchMSEvents(h)
            };
            return p
        }(l)
    });
    J(b, "Core/Series/Point.js", [b["Core/Renderer/HTML/AST.js"], b["Core/Animation/AnimationUtilities.js"], b["Core/Globals.js"], b["Core/Options.js"],
        b["Core/Utilities.js"]
    ], function(b, l, B, y, z) {
        var w = l.animObject,
            v = y.defaultOptions,
            t = z.addEvent,
            q = z.defined,
            h = z.erase,
            c = z.extend,
            p = z.fireEvent,
            k = z.format,
            G = z.getNestedProperty,
            f = z.isArray,
            H = z.isFunction,
            x = z.isNumber,
            K = z.isObject,
            L = z.merge,
            r = z.objectEach,
            n = z.pick,
            u = z.syncTimeout,
            e = z.removeEvent,
            g = z.uniqueKey;
        "";
        l = function() {
            function d() {
                this.colorIndex = this.category = void 0;
                this.formatPrefix = "point";
                this.id = void 0;
                this.isNull = !1;
                this.percentage = this.options = this.name = void 0;
                this.selected = !1;
                this.total =
                    this.series = void 0;
                this.visible = !0;
                this.x = void 0
            }
            d.prototype.animateBeforeDestroy = function() {
                var a = this,
                    d = {
                        x: a.startXPos,
                        opacity: 0
                    },
                    e, g = a.getGraphicalProps();
                g.singular.forEach(function(c) {
                    e = "dataLabel" === c;
                    a[c] = a[c].animate(e ? {
                        x: a[c].startXPos,
                        y: a[c].startYPos,
                        opacity: 0
                    } : d)
                });
                g.plural.forEach(function(d) {
                    a[d].forEach(function(d) {
                        d.element && d.animate(c({
                            x: a.startXPos
                        }, d.startYPos ? {
                            x: d.startXPos,
                            y: d.startYPos
                        } : {}))
                    })
                })
            };
            d.prototype.applyOptions = function(a, e) {
                var m = this.series,
                    g = m.options.pointValKey ||
                    m.pointValKey;
                a = d.prototype.optionsToObject.call(this, a);
                c(this, a);
                this.options = this.options ? c(this.options, a) : a;
                a.group && delete this.group;
                a.dataLabels && delete this.dataLabels;
                g && (this.y = d.prototype.getNestedProperty.call(this, g));
                this.formatPrefix = (this.isNull = n(this.isValid && !this.isValid(), null === this.x || !x(this.y))) ? "null" : "point";
                this.selected && (this.state = "select");
                "name" in this && "undefined" === typeof e && m.xAxis && m.xAxis.hasNames && (this.x = m.xAxis.nameToX(this));
                "undefined" === typeof this.x &&
                    m && (this.x = "undefined" === typeof e ? m.autoIncrement(this) : e);
                return this
            };
            d.prototype.destroy = function() {
                function a() {
                    if (d.graphic || d.dataLabel || d.dataLabels) e(d), d.destroyElements();
                    for (k in d) d[k] = null
                }
                var d = this,
                    c = d.series,
                    g = c.chart;
                c = c.options.dataSorting;
                var f = g.hoverPoints,
                    b = w(d.series.chart.renderer.globalAnimation),
                    k;
                d.legendItem && g.legend.destroyItem(d);
                f && (d.setState(), h(f, d), f.length || (g.hoverPoints = null));
                if (d === g.hoverPoint) d.onMouseOut();
                c && c.enabled ? (this.animateBeforeDestroy(), u(a, b.duration)) :
                    a();
                g.pointCount--
            };
            d.prototype.destroyElements = function(a) {
                var d = this;
                a = d.getGraphicalProps(a);
                a.singular.forEach(function(a) {
                    d[a] = d[a].destroy()
                });
                a.plural.forEach(function(a) {
                    d[a].forEach(function(a) {
                        a.element && a.destroy()
                    });
                    delete d[a]
                })
            };
            d.prototype.firePointEvent = function(a, d, e) {
                var c = this,
                    m = this.series.options;
                (m.point.events[a] || c.options && c.options.events && c.options.events[a]) && c.importEvents();
                "click" === a && m.allowPointSelect && (e = function(a) {
                    c.select && c.select(null, a.ctrlKey || a.metaKey ||
                        a.shiftKey)
                });
                p(c, a, d, e)
            };
            d.prototype.getClassName = function() {
                return "highcharts-point" + (this.selected ? " highcharts-point-select" : "") + (this.negative ? " highcharts-negative" : "") + (this.isNull ? " highcharts-null-point" : "") + ("undefined" !== typeof this.colorIndex ? " highcharts-color-" + this.colorIndex : "") + (this.options.className ? " " + this.options.className : "") + (this.zone && this.zone.className ? " " + this.zone.className.replace("highcharts-negative", "") : "")
            };
            d.prototype.getGraphicalProps = function(a) {
                var d = this,
                    e = [],
                    c, g = {
                        singular: [],
                        plural: []
                    };
                a = a || {
                    graphic: 1,
                    dataLabel: 1
                };
                a.graphic && e.push("graphic", "upperGraphic", "shadowGroup");
                a.dataLabel && e.push("dataLabel", "dataLabelUpper", "connector");
                for (c = e.length; c--;) {
                    var f = e[c];
                    d[f] && g.singular.push(f)
                } ["dataLabel", "connector"].forEach(function(e) {
                    var c = e + "s";
                    a[e] && d[c] && g.plural.push(c)
                });
                return g
            };
            d.prototype.getLabelConfig = function() {
                return {
                    x: this.category,
                    y: this.y,
                    color: this.color,
                    colorIndex: this.colorIndex,
                    key: this.name || this.category,
                    series: this.series,
                    point: this,
                    percentage: this.percentage,
                    total: this.total || this.stackTotal
                }
            };
            d.prototype.getNestedProperty = function(a) {
                if (a) return 0 === a.indexOf("custom.") ? G(a, this.options) : this[a]
            };
            d.prototype.getZone = function() {
                var a = this.series,
                    d = a.zones;
                a = a.zoneAxis || "y";
                var e = 0,
                    c;
                for (c = d[e]; this[a] >= c.value;) c = d[++e];
                this.nonZonedColor || (this.nonZonedColor = this.color);
                this.color = c && c.color && !this.options.color ? c.color : this.nonZonedColor;
                return c
            };
            d.prototype.hasNewShapeType = function() {
                return (this.graphic && (this.graphic.symbolName ||
                    this.graphic.element.nodeName)) !== this.shapeType
            };
            d.prototype.init = function(a, d, e) {
                this.series = a;
                this.applyOptions(d, e);
                this.id = q(this.id) ? this.id : g();
                this.resolveColor();
                a.chart.pointCount++;
                p(this, "afterInit");
                return this
            };
            d.prototype.optionsToObject = function(a) {
                var e = {},
                    c = this.series,
                    g = c.options.keys,
                    b = g || c.pointArrayMap || ["y"],
                    k = b.length,
                    h = 0,
                    n = 0;
                if (x(a) || null === a) e[b[0]] = a;
                else if (f(a))
                    for (!g && a.length > k && (c = typeof a[0], "string" === c ? e.name = a[0] : "number" === c && (e.x = a[0]), h++); n < k;) g && "undefined" ===
                        typeof a[h] || (0 < b[n].indexOf(".") ? d.prototype.setNestedProperty(e, a[h], b[n]) : e[b[n]] = a[h]), h++, n++;
                else "object" === typeof a && (e = a, a.dataLabels && (c._hasPointLabels = !0), a.marker && (c._hasPointMarkers = !0));
                return e
            };
            d.prototype.resolveColor = function() {
                var a = this.series;
                var d = a.chart.options.chart.colorCount;
                var e = a.chart.styledMode;
                delete this.nonZonedColor;
                e || this.options.color || (this.color = a.color);
                a.options.colorByPoint ? (e || (d = a.options.colors || a.chart.options.colors, this.color = this.color || d[a.colorCounter],
                    d = d.length), e = a.colorCounter, a.colorCounter++, a.colorCounter === d && (a.colorCounter = 0)) : e = a.colorIndex;
                this.colorIndex = n(this.options.colorIndex, e)
            };
            d.prototype.setNestedProperty = function(a, d, e) {
                e.split(".").reduce(function(a, e, c, g) {
                    a[e] = g.length - 1 === c ? d : K(a[e], !0) ? a[e] : {};
                    return a[e]
                }, a);
                return a
            };
            d.prototype.tooltipFormatter = function(a) {
                var d = this.series,
                    e = d.tooltipOptions,
                    c = n(e.valueDecimals, ""),
                    g = e.valuePrefix || "",
                    f = e.valueSuffix || "";
                d.chart.styledMode && (a = d.chart.tooltip.styledModeFormat(a));
                (d.pointArrayMap || ["y"]).forEach(function(d) {
                    d = "{point." + d;
                    if (g || f) a = a.replace(RegExp(d + "}", "g"), g + d + "}" + f);
                    a = a.replace(RegExp(d + "}", "g"), d + ":,." + c + "f}")
                });
                return k(a, {
                    point: this,
                    series: this.series
                }, d.chart)
            };
            d.prototype.update = function(a, d, e, c) {
                function g() {
                    m.applyOptions(a);
                    var c = b && m.hasDummyGraphic;
                    c = null === m.y ? !c : c;
                    b && c && (m.graphic = b.destroy(), delete m.hasDummyGraphic);
                    K(a, !0) && (b && b.element && a && a.marker && "undefined" !== typeof a.marker.symbol && (m.graphic = b.destroy()), a && a.dataLabels && m.dataLabel && (m.dataLabel =
                        m.dataLabel.destroy()), m.connector && (m.connector = m.connector.destroy()));
                    k = m.index;
                    f.updateParallelArrays(m, k);
                    p.data[k] = K(p.data[k], !0) || K(a, !0) ? m.options : n(a, p.data[k]);
                    f.isDirty = f.isDirtyData = !0;
                    !f.fixedBox && f.hasCartesianSeries && (h.isDirtyBox = !0);
                    "point" === p.legendType && (h.isDirtyLegend = !0);
                    d && h.redraw(e)
                }
                var m = this,
                    f = m.series,
                    b = m.graphic,
                    k, h = f.chart,
                    p = f.options;
                d = n(d, !0);
                !1 === c ? g() : m.firePointEvent("update", {
                    options: a
                }, g)
            };
            d.prototype.remove = function(a, d) {
                this.series.removePoint(this.series.data.indexOf(this),
                    a, d)
            };
            d.prototype.select = function(a, d) {
                var e = this,
                    c = e.series,
                    g = c.chart;
                this.selectedStaging = a = n(a, !e.selected);
                e.firePointEvent(a ? "select" : "unselect", {
                    accumulate: d
                }, function() {
                    e.selected = e.options.selected = a;
                    c.options.data[c.data.indexOf(e)] = e.options;
                    e.setState(a && "select");
                    d || g.getSelectedPoints().forEach(function(a) {
                        var d = a.series;
                        a.selected && a !== e && (a.selected = a.options.selected = !1, d.options.data[d.data.indexOf(a)] = a.options, a.setState(g.hoverPoints && d.options.inactiveOtherPoints ? "inactive" : ""),
                            a.firePointEvent("unselect"))
                    })
                });
                delete this.selectedStaging
            };
            d.prototype.onMouseOver = function(a) {
                var d = this.series.chart,
                    e = d.pointer;
                a = a ? e.normalize(a) : e.getChartCoordinatesFromPoint(this, d.inverted);
                e.runPointActions(a, this)
            };
            d.prototype.onMouseOut = function() {
                var a = this.series.chart;
                this.firePointEvent("mouseOut");
                this.series.options.inactiveOtherPoints || (a.hoverPoints || []).forEach(function(a) {
                    a.setState()
                });
                a.hoverPoints = a.hoverPoint = null
            };
            d.prototype.importEvents = function() {
                if (!this.hasImportedEvents) {
                    var a =
                        this,
                        d = L(a.series.options.point, a.options).events;
                    a.events = d;
                    r(d, function(d, e) {
                        H(d) && t(a, e, d)
                    });
                    this.hasImportedEvents = !0
                }
            };
            d.prototype.setState = function(a, d) {
                var e = this.series,
                    g = this.state,
                    m = e.options.states[a || "normal"] || {},
                    f = v.plotOptions[e.type].marker && e.options.marker,
                    k = f && !1 === f.enabled,
                    h = f && f.states && f.states[a || "normal"] || {},
                    u = !1 === h.enabled,
                    r = e.stateMarkerGraphic,
                    l = this.marker || {},
                    q = e.chart,
                    x = e.halo,
                    t, G = f && e.markerAttribs;
                a = a || "";
                if (!(a === this.state && !d || this.selected && "select" !== a || !1 ===
                        m.enabled || a && (u || k && !1 === h.enabled) || a && l.states && l.states[a] && !1 === l.states[a].enabled)) {
                    this.state = a;
                    G && (t = e.markerAttribs(this, a));
                    if (this.graphic) {
                        g && this.graphic.removeClass("highcharts-point-" + g);
                        a && this.graphic.addClass("highcharts-point-" + a);
                        if (!q.styledMode) {
                            var D = e.pointAttribs(this, a);
                            var w = n(q.options.chart.animation, m.animation);
                            e.options.inactiveOtherPoints && D.opacity && ((this.dataLabels || []).forEach(function(a) {
                                a && a.animate({
                                    opacity: D.opacity
                                }, w)
                            }), this.connector && this.connector.animate({
                                    opacity: D.opacity
                                },
                                w));
                            this.graphic.animate(D, w)
                        }
                        t && this.graphic.animate(t, n(q.options.chart.animation, h.animation, f.animation));
                        r && r.hide()
                    } else {
                        if (a && h) {
                            g = l.symbol || e.symbol;
                            r && r.currentSymbol !== g && (r = r.destroy());
                            if (t)
                                if (r) r[d ? "animate" : "attr"]({
                                    x: t.x,
                                    y: t.y
                                });
                                else g && (e.stateMarkerGraphic = r = q.renderer.symbol(g, t.x, t.y, t.width, t.height).add(e.markerGroup), r.currentSymbol = g);
                            !q.styledMode && r && r.attr(e.pointAttribs(this, a))
                        }
                        r && (r[a && this.isInside ? "show" : "hide"](), r.element.point = this)
                    }
                    a = m.halo;
                    m = (r = this.graphic || r) &&
                        r.visibility || "inherit";
                    a && a.size && r && "hidden" !== m && !this.isCluster ? (x || (e.halo = x = q.renderer.path().add(r.parentGroup)), x.show()[d ? "animate" : "attr"]({
                        d: this.haloPath(a.size)
                    }), x.attr({
                        "class": "highcharts-halo highcharts-color-" + n(this.colorIndex, e.colorIndex) + (this.className ? " " + this.className : ""),
                        visibility: m,
                        zIndex: -1
                    }), x.point = this, q.styledMode || x.attr(c({
                        fill: this.color || e.color,
                        "fill-opacity": a.opacity
                    }, b.filterUserAttributes(a.attributes || {})))) : x && x.point && x.point.haloPath && x.animate({
                            d: x.point.haloPath(0)
                        },
                        null, x.hide);
                    p(this, "afterSetState")
                }
            };
            d.prototype.haloPath = function(a) {
                return this.series.chart.renderer.symbols.circle(Math.floor(this.plotX) - a, this.plotY - a, 2 * a, 2 * a)
            };
            return d
        }();
        return B.Point = l
    });
    J(b, "Core/Legend.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Globals.js"], b["Core/Series/Point.js"], b["Core/Utilities.js"]], function(b, l, B, y) {
        var w = b.animObject,
            C = b.setAnimation;
        b = l.isFirefox;
        var v = l.marginNames,
            t = l.win,
            q = y.addEvent,
            h = y.createElement,
            c = y.css,
            p = y.defined,
            k = y.discardElement,
            G = y.find,
            f = y.fireEvent,
            H = y.format,
            x = y.isNumber,
            K = y.merge,
            L = y.pick,
            r = y.relativeLength,
            n = y.stableSort,
            u = y.syncTimeout;
        y = y.wrap;
        var e = function() {
            function e(d, a) {
                this.allItems = [];
                this.contentGroup = this.box = void 0;
                this.display = !1;
                this.group = void 0;
                this.offsetWidth = this.maxLegendWidth = this.maxItemWidth = this.legendWidth = this.legendHeight = this.lastLineHeight = this.lastItemY = this.itemY = this.itemX = this.itemMarginTop = this.itemMarginBottom = this.itemHeight = this.initialItemY = 0;
                this.options = {};
                this.padding = 0;
                this.pages = [];
                this.proximate = !1;
                this.scrollGroup = void 0;
                this.widthOption = this.totalItemWidth = this.titleHeight = this.symbolWidth = this.symbolHeight = 0;
                this.chart = d;
                this.init(d, a)
            }
            e.prototype.init = function(d, a) {
                this.chart = d;
                this.setOptions(a);
                a.enabled && (this.render(), q(this.chart, "endResize", function() {
                    this.legend.positionCheckboxes()
                }), this.proximate ? this.unchartrender = q(this.chart, "render", function() {
                    this.legend.proximatePositions();
                    this.legend.positionItems()
                }) : this.unchartrender && this.unchartrender())
            };
            e.prototype.setOptions =
                function(d) {
                    var a = L(d.padding, 8);
                    this.options = d;
                    this.chart.styledMode || (this.itemStyle = d.itemStyle, this.itemHiddenStyle = K(this.itemStyle, d.itemHiddenStyle));
                    this.itemMarginTop = d.itemMarginTop || 0;
                    this.itemMarginBottom = d.itemMarginBottom || 0;
                    this.padding = a;
                    this.initialItemY = a - 5;
                    this.symbolWidth = L(d.symbolWidth, 16);
                    this.pages = [];
                    this.proximate = "proximate" === d.layout && !this.chart.inverted;
                    this.baseline = void 0
                };
            e.prototype.update = function(d, a) {
                var e = this.chart;
                this.setOptions(K(!0, this.options, d));
                this.destroy();
                e.isDirtyLegend = e.isDirtyBox = !0;
                L(a, !0) && e.redraw();
                f(this, "afterUpdate")
            };
            e.prototype.colorizeItem = function(d, a) {
                d.legendGroup[a ? "removeClass" : "addClass"]("highcharts-legend-item-hidden");
                if (!this.chart.styledMode) {
                    var e = this.options,
                        c = d.legendItem,
                        g = d.legendLine,
                        b = d.legendSymbol,
                        k = this.itemHiddenStyle.color;
                    e = a ? e.itemStyle.color : k;
                    var h = a ? d.color || k : k,
                        n = d.options && d.options.marker,
                        p = {
                            fill: h
                        };
                    c && c.css({
                        fill: e,
                        color: e
                    });
                    g && g.attr({
                        stroke: h
                    });
                    b && (n && b.isMarker && (p = d.pointAttribs(), a || (p.stroke = p.fill =
                        k)), b.attr(p))
                }
                f(this, "afterColorizeItem", {
                    item: d,
                    visible: a
                })
            };
            e.prototype.positionItems = function() {
                this.allItems.forEach(this.positionItem, this);
                this.chart.isResizing || this.positionCheckboxes()
            };
            e.prototype.positionItem = function(d) {
                var a = this,
                    e = this.options,
                    c = e.symbolPadding,
                    g = !e.rtl,
                    b = d._legendItemPos;
                e = b[0];
                b = b[1];
                var k = d.checkbox,
                    h = d.legendGroup;
                h && h.element && (c = {
                    translateX: g ? e : this.legendWidth - e - 2 * c - 4,
                    translateY: b
                }, g = function() {
                    f(a, "afterPositionItem", {
                        item: d
                    })
                }, p(h.translateY) ? h.animate(c, void 0,
                    g) : (h.attr(c), g()));
                k && (k.x = e, k.y = b)
            };
            e.prototype.destroyItem = function(d) {
                var a = d.checkbox;
                ["legendItem", "legendLine", "legendSymbol", "legendGroup"].forEach(function(a) {
                    d[a] && (d[a] = d[a].destroy())
                });
                a && k(d.checkbox)
            };
            e.prototype.destroy = function() {
                function d(a) {
                    this[a] && (this[a] = this[a].destroy())
                }
                this.getAllItems().forEach(function(a) {
                    ["legendItem", "legendGroup"].forEach(d, a)
                });
                "clipRect up down pager nav box title group".split(" ").forEach(d, this);
                this.display = null
            };
            e.prototype.positionCheckboxes =
                function() {
                    var d = this.group && this.group.alignAttr,
                        a = this.clipHeight || this.legendHeight,
                        e = this.titleHeight;
                    if (d) {
                        var g = d.translateY;
                        this.allItems.forEach(function(f) {
                            var m = f.checkbox;
                            if (m) {
                                var b = g + e + m.y + (this.scrollOffset || 0) + 3;
                                c(m, {
                                    left: d.translateX + f.checkboxOffset + m.x - 20 + "px",
                                    top: b + "px",
                                    display: this.proximate || b > g - 6 && b < g + a - 6 ? "" : "none"
                                })
                            }
                        }, this)
                    }
                };
            e.prototype.renderTitle = function() {
                var d = this.options,
                    a = this.padding,
                    e = d.title,
                    c = 0;
                e.text && (this.title || (this.title = this.chart.renderer.label(e.text, a -
                    3, a - 4, null, null, null, d.useHTML, null, "legend-title").attr({
                    zIndex: 1
                }), this.chart.styledMode || this.title.css(e.style), this.title.add(this.group)), e.width || this.title.css({
                    width: this.maxLegendWidth + "px"
                }), d = this.title.getBBox(), c = d.height, this.offsetWidth = d.width, this.contentGroup.attr({
                    translateY: c
                }));
                this.titleHeight = c
            };
            e.prototype.setText = function(d) {
                var a = this.options;
                d.legendItem.attr({
                    text: a.labelFormat ? H(a.labelFormat, d, this.chart) : a.labelFormatter.call(d)
                })
            };
            e.prototype.renderItem = function(d) {
                var a =
                    this.chart,
                    e = a.renderer,
                    c = this.options,
                    g = this.symbolWidth,
                    f = c.symbolPadding,
                    b = this.itemStyle,
                    k = this.itemHiddenStyle,
                    h = "horizontal" === c.layout ? L(c.itemDistance, 20) : 0,
                    n = !c.rtl,
                    p = d.legendItem,
                    u = !d.series,
                    r = !u && d.series.drawLegendSymbol ? d.series : d,
                    l = r.options;
                l = this.createCheckboxForItem && l && l.showCheckbox;
                h = g + f + h + (l ? 20 : 0);
                var q = c.useHTML,
                    x = d.options.className;
                p || (d.legendGroup = e.g("legend-item").addClass("highcharts-" + r.type + "-series highcharts-color-" + d.colorIndex + (x ? " " + x : "") + (u ? " highcharts-series-" +
                    d.index : "")).attr({
                    zIndex: 1
                }).add(this.scrollGroup), d.legendItem = p = e.text("", n ? g + f : -f, this.baseline || 0, q), a.styledMode || p.css(K(d.visible ? b : k)), p.attr({
                    align: n ? "left" : "right",
                    zIndex: 2
                }).add(d.legendGroup), this.baseline || (this.fontMetrics = e.fontMetrics(a.styledMode ? 12 : b.fontSize, p), this.baseline = this.fontMetrics.f + 3 + this.itemMarginTop, p.attr("y", this.baseline)), this.symbolHeight = c.symbolHeight || this.fontMetrics.f, r.drawLegendSymbol(this, d), this.setItemEvents && this.setItemEvents(d, p, q));
                l && !d.checkbox &&
                    this.createCheckboxForItem && this.createCheckboxForItem(d);
                this.colorizeItem(d, d.visible);
                !a.styledMode && b.width || p.css({
                    width: (c.itemWidth || this.widthOption || a.spacingBox.width) - h + "px"
                });
                this.setText(d);
                a = p.getBBox();
                d.itemWidth = d.checkboxOffset = c.itemWidth || d.legendItemWidth || a.width + h;
                this.maxItemWidth = Math.max(this.maxItemWidth, d.itemWidth);
                this.totalItemWidth += d.itemWidth;
                this.itemHeight = d.itemHeight = Math.round(d.legendItemHeight || a.height || this.symbolHeight)
            };
            e.prototype.layoutItem = function(d) {
                var a =
                    this.options,
                    e = this.padding,
                    c = "horizontal" === a.layout,
                    g = d.itemHeight,
                    f = this.itemMarginBottom,
                    b = this.itemMarginTop,
                    k = c ? L(a.itemDistance, 20) : 0,
                    h = this.maxLegendWidth;
                a = a.alignColumns && this.totalItemWidth > h ? this.maxItemWidth : d.itemWidth;
                c && this.itemX - e + a > h && (this.itemX = e, this.lastLineHeight && (this.itemY += b + this.lastLineHeight + f), this.lastLineHeight = 0);
                this.lastItemY = b + this.itemY + f;
                this.lastLineHeight = Math.max(g, this.lastLineHeight);
                d._legendItemPos = [this.itemX, this.itemY];
                c ? this.itemX += a : (this.itemY +=
                    b + g + f, this.lastLineHeight = g);
                this.offsetWidth = this.widthOption || Math.max((c ? this.itemX - e - (d.checkbox ? 0 : k) : a) + e, this.offsetWidth)
            };
            e.prototype.getAllItems = function() {
                var d = [];
                this.chart.series.forEach(function(a) {
                    var e = a && a.options;
                    a && L(e.showInLegend, p(e.linkedTo) ? !1 : void 0, !0) && (d = d.concat(a.legendItems || ("point" === e.legendType ? a.data : a)))
                });
                f(this, "afterGetAllItems", {
                    allItems: d
                });
                return d
            };
            e.prototype.getAlignment = function() {
                var d = this.options;
                return this.proximate ? d.align.charAt(0) + "tv" : d.floating ?
                    "" : d.align.charAt(0) + d.verticalAlign.charAt(0) + d.layout.charAt(0)
            };
            e.prototype.adjustMargins = function(d, a) {
                var e = this.chart,
                    c = this.options,
                    g = this.getAlignment();
                g && [/(lth|ct|rth)/, /(rtv|rm|rbv)/, /(rbh|cb|lbh)/, /(lbv|lm|ltv)/].forEach(function(f, b) {
                    f.test(g) && !p(d[b]) && (e[v[b]] = Math.max(e[v[b]], e.legend[(b + 1) % 2 ? "legendHeight" : "legendWidth"] + [1, -1, -1, 1][b] * c[b % 2 ? "x" : "y"] + L(c.margin, 12) + a[b] + (e.titleOffset[b] || 0)))
                })
            };
            e.prototype.proximatePositions = function() {
                var d = this.chart,
                    a = [],
                    e = "left" === this.options.align;
                this.allItems.forEach(function(c) {
                    var g;
                    var f = e;
                    if (c.yAxis) {
                        c.xAxis.options.reversed && (f = !f);
                        c.points && (g = G(f ? c.points : c.points.slice(0).reverse(), function(a) {
                            return x(a.plotY)
                        }));
                        f = this.itemMarginTop + c.legendItem.getBBox().height + this.itemMarginBottom;
                        var b = c.yAxis.top - d.plotTop;
                        c.visible ? (g = g ? g.plotY : c.yAxis.height, g += b - .3 * f) : g = b + c.yAxis.height;
                        a.push({
                            target: g,
                            size: f,
                            item: c
                        })
                    }
                }, this);
                l.distribute(a, d.plotHeight);
                a.forEach(function(a) {
                    a.item._legendItemPos[1] = d.plotTop - d.spacing[0] + a.pos
                })
            };
            e.prototype.render =
                function() {
                    var d = this.chart,
                        a = d.renderer,
                        e = this.group,
                        c = this.box,
                        g = this.options,
                        b = this.padding;
                    this.itemX = b;
                    this.itemY = this.initialItemY;
                    this.lastItemY = this.offsetWidth = 0;
                    this.widthOption = r(g.width, d.spacingBox.width - b);
                    var k = d.spacingBox.width - 2 * b - g.x; - 1 < ["rm", "lm"].indexOf(this.getAlignment().substring(0, 2)) && (k /= 2);
                    this.maxLegendWidth = this.widthOption || k;
                    e || (this.group = e = a.g("legend").attr({
                        zIndex: 7
                    }).add(), this.contentGroup = a.g().attr({
                        zIndex: 1
                    }).add(e), this.scrollGroup = a.g().add(this.contentGroup));
                    this.renderTitle();
                    var h = this.getAllItems();
                    n(h, function(a, d) {
                        return (a.options && a.options.legendIndex || 0) - (d.options && d.options.legendIndex || 0)
                    });
                    g.reversed && h.reverse();
                    this.allItems = h;
                    this.display = k = !!h.length;
                    this.itemHeight = this.totalItemWidth = this.maxItemWidth = this.lastLineHeight = 0;
                    h.forEach(this.renderItem, this);
                    h.forEach(this.layoutItem, this);
                    h = (this.widthOption || this.offsetWidth) + b;
                    var p = this.lastItemY + this.lastLineHeight + this.titleHeight;
                    p = this.handleOverflow(p);
                    p += b;
                    c || (this.box = c = a.rect().addClass("highcharts-legend-box").attr({
                            r: g.borderRadius
                        }).add(e),
                        c.isNew = !0);
                    d.styledMode || c.attr({
                        stroke: g.borderColor,
                        "stroke-width": g.borderWidth || 0,
                        fill: g.backgroundColor || "none"
                    }).shadow(g.shadow);
                    0 < h && 0 < p && (c[c.isNew ? "attr" : "animate"](c.crisp.call({}, {
                        x: 0,
                        y: 0,
                        width: h,
                        height: p
                    }, c.strokeWidth())), c.isNew = !1);
                    c[k ? "show" : "hide"]();
                    d.styledMode && "none" === e.getStyle("display") && (h = p = 0);
                    this.legendWidth = h;
                    this.legendHeight = p;
                    k && this.align();
                    this.proximate || this.positionItems();
                    f(this, "afterRender")
                };
            e.prototype.align = function(d) {
                void 0 === d && (d = this.chart.spacingBox);
                var a = this.chart,
                    e = this.options,
                    c = d.y;
                /(lth|ct|rth)/.test(this.getAlignment()) && 0 < a.titleOffset[0] ? c += a.titleOffset[0] : /(lbh|cb|rbh)/.test(this.getAlignment()) && 0 < a.titleOffset[2] && (c -= a.titleOffset[2]);
                c !== d.y && (d = K(d, {
                    y: c
                }));
                this.group.align(K(e, {
                    width: this.legendWidth,
                    height: this.legendHeight,
                    verticalAlign: this.proximate ? "top" : e.verticalAlign
                }), !0, d)
            };
            e.prototype.handleOverflow = function(d) {
                var a = this,
                    e = this.chart,
                    c = e.renderer,
                    g = this.options,
                    f = g.y,
                    b = this.padding;
                f = e.spacingBox.height + ("top" === g.verticalAlign ?
                    -f : f) - b;
                var k = g.maxHeight,
                    h, n = this.clipRect,
                    p = g.navigation,
                    u = L(p.animation, !0),
                    r = p.arrowSize || 12,
                    l = this.nav,
                    q = this.pages,
                    x, D = this.allItems,
                    t = function(d) {
                        "number" === typeof d ? n.attr({
                            height: d
                        }) : n && (a.clipRect = n.destroy(), a.contentGroup.clip());
                        a.contentGroup.div && (a.contentGroup.div.style.clip = d ? "rect(" + b + "px,9999px," + (b + d) + "px,0)" : "auto")
                    },
                    P = function(d) {
                        a[d] = c.circle(0, 0, 1.3 * r).translate(r / 2, r / 2).add(l);
                        e.styledMode || a[d].attr("fill", "rgba(0,0,0,0.0001)");
                        return a[d]
                    };
                "horizontal" !== g.layout || "middle" ===
                    g.verticalAlign || g.floating || (f /= 2);
                k && (f = Math.min(f, k));
                q.length = 0;
                d > f && !1 !== p.enabled ? (this.clipHeight = h = Math.max(f - 20 - this.titleHeight - b, 0), this.currentPage = L(this.currentPage, 1), this.fullHeight = d, D.forEach(function(a, d) {
                    var e = a._legendItemPos[1],
                        c = Math.round(a.legendItem.getBBox().height),
                        g = q.length;
                    if (!g || e - q[g - 1] > h && (x || e) !== q[g - 1]) q.push(x || e), g++;
                    a.pageIx = g - 1;
                    x && (D[d - 1].pageIx = g - 1);
                    d === D.length - 1 && e + c - q[g - 1] > h && e !== x && (q.push(e), a.pageIx = g);
                    e !== x && (x = e)
                }), n || (n = a.clipRect = c.clipRect(0, b, 9999,
                    0), a.contentGroup.clip(n)), t(h), l || (this.nav = l = c.g().attr({
                    zIndex: 1
                }).add(this.group), this.up = c.symbol("triangle", 0, 0, r, r).add(l), P("upTracker").on("click", function() {
                    a.scroll(-1, u)
                }), this.pager = c.text("", 15, 10).addClass("highcharts-legend-navigation"), e.styledMode || this.pager.css(p.style), this.pager.add(l), this.down = c.symbol("triangle-down", 0, 0, r, r).add(l), P("downTracker").on("click", function() {
                    a.scroll(1, u)
                })), a.scroll(0), d = f) : l && (t(), this.nav = l.destroy(), this.scrollGroup.attr({
                        translateY: 1
                    }), this.clipHeight =
                    0);
                return d
            };
            e.prototype.scroll = function(d, a) {
                var e = this,
                    c = this.chart,
                    g = this.pages,
                    b = g.length,
                    k = this.currentPage + d;
                d = this.clipHeight;
                var h = this.options.navigation,
                    n = this.pager,
                    p = this.padding;
                k > b && (k = b);
                0 < k && ("undefined" !== typeof a && C(a, c), this.nav.attr({
                        translateX: p,
                        translateY: d + this.padding + 7 + this.titleHeight,
                        visibility: "visible"
                    }), [this.up, this.upTracker].forEach(function(a) {
                        a.attr({
                            "class": 1 === k ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active"
                        })
                    }), n.attr({
                        text: k + "/" + b
                    }), [this.down,
                        this.downTracker
                    ].forEach(function(a) {
                        a.attr({
                            x: 18 + this.pager.getBBox().width,
                            "class": k === b ? "highcharts-legend-nav-inactive" : "highcharts-legend-nav-active"
                        })
                    }, this), c.styledMode || (this.up.attr({
                        fill: 1 === k ? h.inactiveColor : h.activeColor
                    }), this.upTracker.css({
                        cursor: 1 === k ? "default" : "pointer"
                    }), this.down.attr({
                        fill: k === b ? h.inactiveColor : h.activeColor
                    }), this.downTracker.css({
                        cursor: k === b ? "default" : "pointer"
                    })), this.scrollOffset = -g[k - 1] + this.initialItemY, this.scrollGroup.animate({
                        translateY: this.scrollOffset
                    }),
                    this.currentPage = k, this.positionCheckboxes(), a = w(L(a, c.renderer.globalAnimation, !0)), u(function() {
                        f(e, "afterScroll", {
                            currentPage: k
                        })
                    }, a.duration))
            };
            e.prototype.setItemEvents = function(d, a, e) {
                var c = this,
                    g = c.chart.renderer.boxWrapper,
                    b = d instanceof B,
                    m = "highcharts-legend-" + (b ? "point" : "series") + "-active",
                    k = c.chart.styledMode;
                (e ? [a, d.legendSymbol] : [d.legendGroup]).forEach(function(e) {
                    if (e) e.on("mouseover", function() {
                        d.visible && c.allItems.forEach(function(a) {
                            d !== a && a.setState("inactive", !b)
                        });
                        d.setState("hover");
                        d.visible && g.addClass(m);
                        k || a.css(c.options.itemHoverStyle)
                    }).on("mouseout", function() {
                        c.chart.styledMode || a.css(K(d.visible ? c.itemStyle : c.itemHiddenStyle));
                        c.allItems.forEach(function(a) {
                            d !== a && a.setState("", !b)
                        });
                        g.removeClass(m);
                        d.setState()
                    }).on("click", function(a) {
                        var e = function() {
                            d.setVisible && d.setVisible();
                            c.allItems.forEach(function(a) {
                                d !== a && a.setState(d.visible ? "inactive" : "", !b)
                            })
                        };
                        g.removeClass(m);
                        a = {
                            browserEvent: a
                        };
                        d.firePointEvent ? d.firePointEvent("legendItemClick", a, e) : f(d, "legendItemClick",
                            a, e)
                    })
                })
            };
            e.prototype.createCheckboxForItem = function(d) {
                d.checkbox = h("input", {
                    type: "checkbox",
                    className: "highcharts-legend-checkbox",
                    checked: d.selected,
                    defaultChecked: d.selected
                }, this.options.itemCheckboxStyle, this.chart.container);
                q(d.checkbox, "click", function(a) {
                    f(d.series || d, "checkboxClick", {
                        checked: a.target.checked,
                        item: d
                    }, function() {
                        d.select()
                    })
                })
            };
            return e
        }();
        (/Trident\/7\.0/.test(t.navigator && t.navigator.userAgent) || b) && y(e.prototype, "positionItem", function(e, d) {
            var a = this,
                c = function() {
                    d._legendItemPos &&
                        e.call(a, d)
                };
            c();
            a.bubbleLegend || setTimeout(c)
        });
        l.Legend = e;
        return l.Legend
    });
    J(b, "Core/Series/SeriesRegistry.js", [b["Core/Globals.js"], b["Core/Options.js"], b["Core/Series/Point.js"], b["Core/Utilities.js"]], function(b, l, B, y) {
        var w = l.defaultOptions,
            C = y.error,
            v = y.extendClass,
            t = y.merge,
            q;
        (function(b) {
            function c(c, k) {
                var h = w.plotOptions || {},
                    f = k.defaultOptions;
                k.prototype.pointClass || (k.prototype.pointClass = B);
                k.prototype.type = c;
                f && (h[c] = f);
                b.seriesTypes[c] = k
            }
            b.seriesTypes = {};
            b.getSeries = function(c, k) {
                void 0 ===
                    k && (k = {});
                var h = c.options.chart;
                h = k.type || h.type || h.defaultSeriesType || "";
                var f = b.seriesTypes[h];
                b || C(17, !0, c, {
                    missingModuleFor: h
                });
                h = new f;
                "function" === typeof h.init && h.init(c, k);
                return h
            };
            b.registerSeriesType = c;
            b.seriesType = function(h, k, l, f, q) {
                var p = w.plotOptions || {};
                k = k || "";
                p[h] = t(p[k], l);
                c(h, v(b.seriesTypes[k] || function() {}, f));
                b.seriesTypes[h].prototype.type = h;
                q && (b.seriesTypes[h].prototype.pointClass = v(B, q));
                return b.seriesTypes[h]
            }
        })(q || (q = {}));
        b.seriesType = q.seriesType;
        b.seriesTypes = q.seriesTypes;
        return q
    });
    J(b, "Core/Chart/Chart.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Axis/Axis.js"], b["Core/Globals.js"], b["Core/Legend.js"], b["Core/MSPointer.js"], b["Core/Options.js"], b["Core/Color/Palette.js"], b["Core/Pointer.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Time.js"], b["Core/Utilities.js"], b["Core/Renderer/HTML/AST.js"]], function(b, l, B, y, z, C, v, t, q, h, c, p) {
        var k = b.animate,
            G = b.animObject,
            f = b.setAnimation,
            w = B.charts,
            x = B.doc,
            K = B.win,
            L = C.defaultOptions,
            r = C.time,
            n = q.seriesTypes,
            u = c.addEvent,
            e = c.attr,
            g = c.cleanRecursively,
            d = c.createElement,
            a = c.css,
            m = c.defined,
            E = c.discardElement,
            I = c.erase,
            A = c.error,
            N = c.extend,
            R = c.find,
            Q = c.fireEvent,
            T = c.getStyle,
            M = c.isArray,
            O = c.isFunction,
            F = c.isNumber,
            J = c.isObject,
            aa = c.isString,
            Y = c.merge,
            D = c.numberFormat,
            S = c.objectEach,
            P = c.pick,
            Z = c.pInt,
            U = c.relativeLength,
            da = c.removeEvent,
            X = c.splat,
            ca = c.syncTimeout,
            fa = c.uniqueKey,
            ea = B.marginNames,
            ba = function() {
                function b(a, d, e) {
                    this.yAxis = this.xAxis = this.userOptions = this.titleOffset = this.time = this.symbolCounter = this.spacingBox =
                        this.spacing = this.series = this.renderTo = this.renderer = this.pointer = this.pointCount = this.plotWidth = this.plotTop = this.plotLeft = this.plotHeight = this.plotBox = this.options = this.numberFormatter = this.margin = this.legend = this.labelCollectors = this.isResizing = this.index = this.container = this.colorCounter = this.clipBox = this.chartWidth = this.chartHeight = this.bounds = this.axisOffset = this.axes = void 0;
                    this.getArgs(a, d, e)
                }
                b.prototype.getArgs = function(a, d, e) {
                    aa(a) || a.nodeName ? (this.renderTo = a, this.init(d, e)) : this.init(a,
                        d)
                };
                b.prototype.init = function(a, d) {
                    var e, c = a.series,
                        b = a.plotOptions || {};
                    Q(this, "init", {
                        args: arguments
                    }, function() {
                        a.series = null;
                        e = Y(L, a);
                        var g = e.chart || {};
                        S(e.plotOptions, function(a, d) {
                            J(a) && (a.tooltip = b[d] && Y(b[d].tooltip) || void 0)
                        });
                        e.tooltip.userOptions = a.chart && a.chart.forExport && a.tooltip.userOptions || a.tooltip;
                        e.series = a.series = c;
                        this.userOptions = a;
                        var f = g.events;
                        this.margin = [];
                        this.spacing = [];
                        this.bounds = {
                            h: {},
                            v: {}
                        };
                        this.labelCollectors = [];
                        this.callback = d;
                        this.isResizing = 0;
                        this.options = e;
                        this.axes = [];
                        this.series = [];
                        this.time = a.time && Object.keys(a.time).length ? new h(a.time) : B.time;
                        this.numberFormatter = g.numberFormatter || D;
                        this.styledMode = g.styledMode;
                        this.hasCartesianSeries = g.showAxes;
                        var m = this;
                        m.index = w.length;
                        w.push(m);
                        B.chartCount++;
                        f && S(f, function(a, d) {
                            O(a) && u(m, d, a)
                        });
                        m.xAxis = [];
                        m.yAxis = [];
                        m.pointCount = m.colorCounter = m.symbolCounter = 0;
                        Q(m, "afterInit");
                        m.firstRender()
                    })
                };
                b.prototype.initSeries = function(a) {
                    var d = this.options.chart;
                    d = a.type || d.type || d.defaultSeriesType;
                    var e = n[d];
                    e || A(17,
                        !0, this, {
                            missingModuleFor: d
                        });
                    d = new e;
                    "function" === typeof d.init && d.init(this, a);
                    return d
                };
                b.prototype.setSeriesData = function() {
                    this.getSeriesOrderByLinks().forEach(function(a) {
                        a.points || a.data || !a.enabledDataSorting || a.setData(a.options.data, !1)
                    })
                };
                b.prototype.getSeriesOrderByLinks = function() {
                    return this.series.concat().sort(function(a, d) {
                        return a.linkedSeries.length || d.linkedSeries.length ? d.linkedSeries.length - a.linkedSeries.length : 0
                    })
                };
                b.prototype.orderSeries = function(a) {
                    var d = this.series;
                    for (a =
                        a || 0; a < d.length; a++) d[a] && (d[a].index = a, d[a].name = d[a].getName())
                };
                b.prototype.isInsidePlot = function(a, d, e) {
                    var c = e ? d : a;
                    a = e ? a : d;
                    c = {
                        x: c,
                        y: a,
                        isInsidePlot: 0 <= c && c <= this.plotWidth && 0 <= a && a <= this.plotHeight
                    };
                    Q(this, "afterIsInsidePlot", c);
                    return c.isInsidePlot
                };
                b.prototype.redraw = function(a) {
                    Q(this, "beforeRedraw");
                    var d = this.hasCartesianSeries ? this.axes : this.colorAxis || [],
                        e = this.series,
                        c = this.pointer,
                        b = this.legend,
                        g = this.userOptions.legend,
                        m = this.isDirtyLegend,
                        k = this.isDirtyBox,
                        h = this.renderer,
                        n = h.isHidden(),
                        p = [];
                    this.setResponsive && this.setResponsive(!1);
                    f(this.hasRendered ? a : !1, this);
                    n && this.temporaryDisplay();
                    this.layOutTitles();
                    for (a = e.length; a--;) {
                        var u = e[a];
                        if (u.options.stacking || u.options.centerInCategory) {
                            var r = !0;
                            if (u.isDirty) {
                                var l = !0;
                                break
                            }
                        }
                    }
                    if (l)
                        for (a = e.length; a--;) u = e[a], u.options.stacking && (u.isDirty = !0);
                    e.forEach(function(a) {
                        a.isDirty && ("point" === a.options.legendType ? ("function" === typeof a.updateTotals && a.updateTotals(), m = !0) : g && (g.labelFormatter || g.labelFormat) && (m = !0));
                        a.isDirtyData &&
                            Q(a, "updatedData")
                    });
                    m && b && b.options.enabled && (b.render(), this.isDirtyLegend = !1);
                    r && this.getStacks();
                    d.forEach(function(a) {
                        a.updateNames();
                        a.setScale()
                    });
                    this.getMargins();
                    d.forEach(function(a) {
                        a.isDirty && (k = !0)
                    });
                    d.forEach(function(a) {
                        var d = a.min + "," + a.max;
                        a.extKey !== d && (a.extKey = d, p.push(function() {
                            Q(a, "afterSetExtremes", N(a.eventArgs, a.getExtremes()));
                            delete a.eventArgs
                        }));
                        (k || r) && a.redraw()
                    });
                    k && this.drawChartBox();
                    Q(this, "predraw");
                    e.forEach(function(a) {
                        (k || a.isDirty) && a.visible && a.redraw();
                        a.isDirtyData = !1
                    });
                    c && c.reset(!0);
                    h.draw();
                    Q(this, "redraw");
                    Q(this, "render");
                    n && this.temporaryDisplay(!0);
                    p.forEach(function(a) {
                        a.call()
                    })
                };
                b.prototype.get = function(a) {
                    function d(d) {
                        return d.id === a || d.options && d.options.id === a
                    }
                    var e = this.series,
                        c;
                    var b = R(this.axes, d) || R(this.series, d);
                    for (c = 0; !b && c < e.length; c++) b = R(e[c].points || [], d);
                    return b
                };
                b.prototype.getAxes = function() {
                    var a = this,
                        d = this.options,
                        e = d.xAxis = X(d.xAxis || {});
                    d = d.yAxis = X(d.yAxis || {});
                    Q(this, "getAxes");
                    e.forEach(function(a, d) {
                        a.index =
                            d;
                        a.isX = !0
                    });
                    d.forEach(function(a, d) {
                        a.index = d
                    });
                    e.concat(d).forEach(function(d) {
                        new l(a, d)
                    });
                    Q(this, "afterGetAxes")
                };
                b.prototype.getSelectedPoints = function() {
                    var a = [];
                    this.series.forEach(function(d) {
                        a = a.concat(d.getPointsCollection().filter(function(a) {
                            return P(a.selectedStaging, a.selected)
                        }))
                    });
                    return a
                };
                b.prototype.getSelectedSeries = function() {
                    return this.series.filter(function(a) {
                        return a.selected
                    })
                };
                b.prototype.setTitle = function(a, d, e) {
                    this.applyDescription("title", a);
                    this.applyDescription("subtitle",
                        d);
                    this.applyDescription("caption", void 0);
                    this.layOutTitles(e)
                };
                b.prototype.applyDescription = function(a, d) {
                    var e = this,
                        c = "title" === a ? {
                            color: v.neutralColor80,
                            fontSize: this.options.isStock ? "16px" : "18px"
                        } : {
                            color: v.neutralColor60
                        };
                    c = this.options[a] = Y(!this.styledMode && {
                        style: c
                    }, this.options[a], d);
                    var b = this[a];
                    b && d && (this[a] = b = b.destroy());
                    c && !b && (b = this.renderer.text(c.text, 0, 0, c.useHTML).attr({
                        align: c.align,
                        "class": "highcharts-" + a,
                        zIndex: c.zIndex || 4
                    }).add(), b.update = function(d) {
                        e[{
                            title: "setTitle",
                            subtitle: "setSubtitle",
                            caption: "setCaption"
                        } [a]](d)
                    }, this.styledMode || b.css(c.style), this[a] = b)
                };
                b.prototype.layOutTitles = function(a) {
                    var d = [0, 0, 0],
                        e = this.renderer,
                        c = this.spacingBox;
                    ["title", "subtitle", "caption"].forEach(function(a) {
                        var b = this[a],
                            g = this.options[a],
                            f = g.verticalAlign || "top";
                        a = "title" === a ? -3 : "top" === f ? d[0] + 2 : 0;
                        if (b) {
                            if (!this.styledMode) var m = g.style.fontSize;
                            m = e.fontMetrics(m, b).b;
                            b.css({
                                width: (g.width || c.width + (g.widthAdjust || 0)) + "px"
                            });
                            var k = Math.round(b.getBBox(g.useHTML).height);
                            b.align(N({
                                y: "bottom" === f ? m : a + m,
                                height: k
                            }, g), !1, "spacingBox");
                            g.floating || ("top" === f ? d[0] = Math.ceil(d[0] + k) : "bottom" === f && (d[2] = Math.ceil(d[2] + k)))
                        }
                    }, this);
                    d[0] && "top" === (this.options.title.verticalAlign || "top") && (d[0] += this.options.title.margin);
                    d[2] && "bottom" === this.options.caption.verticalAlign && (d[2] += this.options.caption.margin);
                    var b = !this.titleOffset || this.titleOffset.join(",") !== d.join(",");
                    this.titleOffset = d;
                    Q(this, "afterLayOutTitles");
                    !this.isDirtyBox && b && (this.isDirtyBox = this.isDirtyLegend =
                        b, this.hasRendered && P(a, !0) && this.isDirtyBox && this.redraw())
                };
                b.prototype.getChartSize = function() {
                    var a = this.options.chart,
                        d = a.width;
                    a = a.height;
                    var e = this.renderTo;
                    m(d) || (this.containerWidth = T(e, "width"));
                    m(a) || (this.containerHeight = T(e, "height"));
                    this.chartWidth = Math.max(0, d || this.containerWidth || 600);
                    this.chartHeight = Math.max(0, U(a, this.chartWidth) || (1 < this.containerHeight ? this.containerHeight : 400))
                };
                b.prototype.temporaryDisplay = function(d) {
                    var e = this.renderTo;
                    if (d)
                        for (; e && e.style;) e.hcOrigStyle &&
                            (a(e, e.hcOrigStyle), delete e.hcOrigStyle), e.hcOrigDetached && (x.body.removeChild(e), e.hcOrigDetached = !1), e = e.parentNode;
                    else
                        for (; e && e.style;) {
                            x.body.contains(e) || e.parentNode || (e.hcOrigDetached = !0, x.body.appendChild(e));
                            if ("none" === T(e, "display", !1) || e.hcOricDetached) e.hcOrigStyle = {
                                display: e.style.display,
                                height: e.style.height,
                                overflow: e.style.overflow
                            }, d = {
                                display: "block",
                                overflow: "hidden"
                            }, e !== this.renderTo && (d.height = 0), a(e, d), e.offsetWidth || e.style.setProperty("display", "block", "important");
                            e =
                                e.parentNode;
                            if (e === x.body) break
                        }
                };
                b.prototype.setClassName = function(a) {
                    this.container.className = "highcharts-container " + (a || "")
                };
                b.prototype.getContainer = function() {
                    var c = this.options,
                        b = c.chart;
                    var g = this.renderTo;
                    var m = fa(),
                        k, h;
                    g || (this.renderTo = g = b.renderTo);
                    aa(g) && (this.renderTo = g = x.getElementById(g));
                    g || A(13, !0, this);
                    var n = Z(e(g, "data-highcharts-chart"));
                    F(n) && w[n] && w[n].hasRendered && w[n].destroy();
                    e(g, "data-highcharts-chart", this.index);
                    g.innerHTML = "";
                    b.skipClone || g.offsetWidth || this.temporaryDisplay();
                    this.getChartSize();
                    n = this.chartWidth;
                    var p = this.chartHeight;
                    a(g, {
                        overflow: "hidden"
                    });
                    this.styledMode || (k = N({
                        position: "relative",
                        overflow: "hidden",
                        width: n + "px",
                        height: p + "px",
                        textAlign: "left",
                        lineHeight: "normal",
                        zIndex: 0,
                        "-webkit-tap-highlight-color": "rgba(0,0,0,0)",
                        userSelect: "none"
                    }, b.style));
                    this.container = g = d("div", {
                        id: m
                    }, k, g);
                    this._cursor = g.style.cursor;
                    this.renderer = new(B[b.renderer] || B.Renderer)(g, n, p, null, b.forExport, c.exporting && c.exporting.allowHTML, this.styledMode);
                    f(void 0, this);
                    this.setClassName(b.className);
                    if (this.styledMode)
                        for (h in c.defs) this.renderer.definition(c.defs[h]);
                    else this.renderer.setStyle(b.style);
                    this.renderer.chartIndex = this.index;
                    Q(this, "afterGetContainer")
                };
                b.prototype.getMargins = function(a) {
                    var d = this.spacing,
                        e = this.margin,
                        c = this.titleOffset;
                    this.resetMargins();
                    c[0] && !m(e[0]) && (this.plotTop = Math.max(this.plotTop, c[0] + d[0]));
                    c[2] && !m(e[2]) && (this.marginBottom = Math.max(this.marginBottom, c[2] + d[2]));
                    this.legend && this.legend.display && this.legend.adjustMargins(e, d);
                    Q(this, "getMargins");
                    a || this.getAxisMargins()
                };
                b.prototype.getAxisMargins = function() {
                    var a = this,
                        d = a.axisOffset = [0, 0, 0, 0],
                        e = a.colorAxis,
                        c = a.margin,
                        b = function(a) {
                            a.forEach(function(a) {
                                a.visible && a.getOffset()
                            })
                        };
                    a.hasCartesianSeries ? b(a.axes) : e && e.length && b(e);
                    ea.forEach(function(e, b) {
                        m(c[b]) || (a[e] += d[b])
                    });
                    a.setChartSize()
                };
                b.prototype.reflow = function(a) {
                    var d = this,
                        e = d.options.chart,
                        b = d.renderTo,
                        g = m(e.width) && m(e.height),
                        f = e.width || T(b, "width");
                    e = e.height || T(b, "height");
                    b = a ? a.target : K;
                    delete d.pointer.chartPosition;
                    if (!g &&
                        !d.isPrinting && f && e && (b === K || b === x)) {
                        if (f !== d.containerWidth || e !== d.containerHeight) c.clearTimeout(d.reflowTimeout), d.reflowTimeout = ca(function() {
                            d.container && d.setSize(void 0, void 0, !1)
                        }, a ? 100 : 0);
                        d.containerWidth = f;
                        d.containerHeight = e
                    }
                };
                b.prototype.setReflow = function(a) {
                    var d = this;
                    !1 === a || this.unbindReflow ? !1 === a && this.unbindReflow && (this.unbindReflow = this.unbindReflow()) : (this.unbindReflow = u(K, "resize", function(a) {
                        d.options && d.reflow(a)
                    }), u(this, "destroy", this.unbindReflow))
                };
                b.prototype.setSize =
                    function(d, e, c) {
                        var b = this,
                            g = b.renderer;
                        b.isResizing += 1;
                        f(c, b);
                        c = g.globalAnimation;
                        b.oldChartHeight = b.chartHeight;
                        b.oldChartWidth = b.chartWidth;
                        "undefined" !== typeof d && (b.options.chart.width = d);
                        "undefined" !== typeof e && (b.options.chart.height = e);
                        b.getChartSize();
                        b.styledMode || (c ? k : a)(b.container, {
                            width: b.chartWidth + "px",
                            height: b.chartHeight + "px"
                        }, c);
                        b.setChartSize(!0);
                        g.setSize(b.chartWidth, b.chartHeight, c);
                        b.axes.forEach(function(a) {
                            a.isDirty = !0;
                            a.setScale()
                        });
                        b.isDirtyLegend = !0;
                        b.isDirtyBox = !0;
                        b.layOutTitles();
                        b.getMargins();
                        b.redraw(c);
                        b.oldChartHeight = null;
                        Q(b, "resize");
                        ca(function() {
                            b && Q(b, "endResize", null, function() {
                                --b.isResizing
                            })
                        }, G(c).duration)
                    };
                b.prototype.setChartSize = function(a) {
                    var d = this.inverted,
                        e = this.renderer,
                        c = this.chartWidth,
                        b = this.chartHeight,
                        g = this.options.chart,
                        f = this.spacing,
                        m = this.clipOffset,
                        k, h, n, p;
                    this.plotLeft = k = Math.round(this.plotLeft);
                    this.plotTop = h = Math.round(this.plotTop);
                    this.plotWidth = n = Math.max(0, Math.round(c - k - this.marginRight));
                    this.plotHeight = p = Math.max(0, Math.round(b -
                        h - this.marginBottom));
                    this.plotSizeX = d ? p : n;
                    this.plotSizeY = d ? n : p;
                    this.plotBorderWidth = g.plotBorderWidth || 0;
                    this.spacingBox = e.spacingBox = {
                        x: f[3],
                        y: f[0],
                        width: c - f[3] - f[1],
                        height: b - f[0] - f[2]
                    };
                    this.plotBox = e.plotBox = {
                        x: k,
                        y: h,
                        width: n,
                        height: p
                    };
                    c = 2 * Math.floor(this.plotBorderWidth / 2);
                    d = Math.ceil(Math.max(c, m[3]) / 2);
                    e = Math.ceil(Math.max(c, m[0]) / 2);
                    this.clipBox = {
                        x: d,
                        y: e,
                        width: Math.floor(this.plotSizeX - Math.max(c, m[1]) / 2 - d),
                        height: Math.max(0, Math.floor(this.plotSizeY - Math.max(c, m[2]) / 2 - e))
                    };
                    a || this.axes.forEach(function(a) {
                        a.setAxisSize();
                        a.setAxisTranslation()
                    });
                    Q(this, "afterSetChartSize", {
                        skipAxes: a
                    })
                };
                b.prototype.resetMargins = function() {
                    Q(this, "resetMargins");
                    var a = this,
                        d = a.options.chart;
                    ["margin", "spacing"].forEach(function(e) {
                        var c = d[e],
                            b = J(c) ? c : [c, c, c, c];
                        ["Top", "Right", "Bottom", "Left"].forEach(function(c, g) {
                            a[e][g] = P(d[e + c], b[g])
                        })
                    });
                    ea.forEach(function(d, e) {
                        a[d] = P(a.margin[e], a.spacing[e])
                    });
                    a.axisOffset = [0, 0, 0, 0];
                    a.clipOffset = [0, 0, 0, 0]
                };
                b.prototype.drawChartBox = function() {
                    var a = this.options.chart,
                        d = this.renderer,
                        e = this.chartWidth,
                        c = this.chartHeight,
                        b = this.chartBackground,
                        g = this.plotBackground,
                        f = this.plotBorder,
                        m = this.styledMode,
                        k = this.plotBGImage,
                        h = a.backgroundColor,
                        n = a.plotBackgroundColor,
                        p = a.plotBackgroundImage,
                        u, r = this.plotLeft,
                        l = this.plotTop,
                        D = this.plotWidth,
                        q = this.plotHeight,
                        x = this.plotBox,
                        A = this.clipRect,
                        t = this.clipBox,
                        E = "animate";
                    b || (this.chartBackground = b = d.rect().addClass("highcharts-background").add(), E = "attr");
                    if (m) var P = u = b.strokeWidth();
                    else {
                        P = a.borderWidth || 0;
                        u = P + (a.shadow ? 8 : 0);
                        h = {
                            fill: h || "none"
                        };
                        if (P || b["stroke-width"]) h.stroke =
                            a.borderColor, h["stroke-width"] = P;
                        b.attr(h).shadow(a.shadow)
                    }
                    b[E]({
                        x: u / 2,
                        y: u / 2,
                        width: e - u - P % 2,
                        height: c - u - P % 2,
                        r: a.borderRadius
                    });
                    E = "animate";
                    g || (E = "attr", this.plotBackground = g = d.rect().addClass("highcharts-plot-background").add());
                    g[E](x);
                    m || (g.attr({
                        fill: n || "none"
                    }).shadow(a.plotShadow), p && (k ? (p !== k.attr("href") && k.attr("href", p), k.animate(x)) : this.plotBGImage = d.image(p, r, l, D, q).add()));
                    A ? A.animate({
                        width: t.width,
                        height: t.height
                    }) : this.clipRect = d.clipRect(t);
                    E = "animate";
                    f || (E = "attr", this.plotBorder =
                        f = d.rect().addClass("highcharts-plot-border").attr({
                            zIndex: 1
                        }).add());
                    m || f.attr({
                        stroke: a.plotBorderColor,
                        "stroke-width": a.plotBorderWidth || 0,
                        fill: "none"
                    });
                    f[E](f.crisp({
                        x: r,
                        y: l,
                        width: D,
                        height: q
                    }, -f.strokeWidth()));
                    this.isDirtyBox = !1;
                    Q(this, "afterDrawChartBox")
                };
                b.prototype.propFromSeries = function() {
                    var a = this,
                        d = a.options.chart,
                        e, c = a.options.series,
                        b, g;
                    ["inverted", "angular", "polar"].forEach(function(f) {
                        e = n[d.type || d.defaultSeriesType];
                        g = d[f] || e && e.prototype[f];
                        for (b = c && c.length; !g && b--;)(e = n[c[b].type]) &&
                            e.prototype[f] && (g = !0);
                        a[f] = g
                    })
                };
                b.prototype.linkSeries = function() {
                    var a = this,
                        d = a.series;
                    d.forEach(function(a) {
                        a.linkedSeries.length = 0
                    });
                    d.forEach(function(d) {
                        var e = d.options.linkedTo;
                        aa(e) && (e = ":previous" === e ? a.series[d.index - 1] : a.get(e)) && e.linkedParent !== d && (e.linkedSeries.push(d), d.linkedParent = e, e.enabledDataSorting && d.setDataSortingOptions(), d.visible = P(d.options.visible, e.options.visible, d.visible))
                    });
                    Q(this, "afterLinkSeries")
                };
                b.prototype.renderSeries = function() {
                    this.series.forEach(function(a) {
                        a.translate();
                        a.render()
                    })
                };
                b.prototype.renderLabels = function() {
                    var a = this,
                        d = a.options.labels;
                    d.items && d.items.forEach(function(e) {
                        var c = N(d.style, e.style),
                            b = Z(c.left) + a.plotLeft,
                            g = Z(c.top) + a.plotTop + 12;
                        delete c.left;
                        delete c.top;
                        a.renderer.text(e.html, b, g).attr({
                            zIndex: 2
                        }).css(c).add()
                    })
                };
                b.prototype.render = function() {
                    var a = this.axes,
                        d = this.colorAxis,
                        e = this.renderer,
                        c = this.options,
                        b = 0,
                        g = function(a) {
                            a.forEach(function(a) {
                                a.visible && a.render()
                            })
                        };
                    this.setTitle();
                    this.legend = new y(this, c.legend);
                    this.getStacks &&
                        this.getStacks();
                    this.getMargins(!0);
                    this.setChartSize();
                    c = this.plotWidth;
                    a.some(function(a) {
                        if (a.horiz && a.visible && a.options.labels.enabled && a.series.length) return b = 21, !0
                    });
                    var f = this.plotHeight = Math.max(this.plotHeight - b, 0);
                    a.forEach(function(a) {
                        a.setScale()
                    });
                    this.getAxisMargins();
                    var m = 1.1 < c / this.plotWidth;
                    var k = 1.05 < f / this.plotHeight;
                    if (m || k) a.forEach(function(a) {
                        (a.horiz && m || !a.horiz && k) && a.setTickInterval(!0)
                    }), this.getMargins();
                    this.drawChartBox();
                    this.hasCartesianSeries ? g(a) : d && d.length &&
                        g(d);
                    this.seriesGroup || (this.seriesGroup = e.g("series-group").attr({
                        zIndex: 3
                    }).add());
                    this.renderSeries();
                    this.renderLabels();
                    this.addCredits();
                    this.setResponsive && this.setResponsive();
                    this.hasRendered = !0
                };
                // b.prototype.addCredits = function(a) {
                //     var d = this,
                //         e = Y(!0, this.options.credits, a);
                //     e.enabled && !this.credits && (this.credits = this.renderer.text(e.text + (this.mapCredits || ""), 0, 0).addClass("highcharts-credits").on("click", function() {
                //             e.href && (K.location.href = e.href)
                //         }).attr({
                //             align: e.position.align,
                //             zIndex: 8
                //         }),
                //         d.styledMode || this.credits.css(e.style), this.credits.add().align(e.position), this.credits.update = function(a) {
                //             d.credits = d.credits.destroy();
                //             d.addCredits(a)
                //         })
                // };
                b.prototype.destroy = function() {
                    var a = this,
                        d = a.axes,
                        e = a.series,
                        c = a.container,
                        b, g = c && c.parentNode;
                    Q(a, "destroy");
                    a.renderer.forExport ? I(w, a) : w[a.index] = void 0;
                    B.chartCount--;
                    a.renderTo.removeAttribute("data-highcharts-chart");
                    da(a);
                    for (b = d.length; b--;) d[b] = d[b].destroy();
                    this.scroller && this.scroller.destroy && this.scroller.destroy();
                    for (b = e.length; b--;) e[b] =
                        e[b].destroy();
                    "title subtitle chartBackground plotBackground plotBGImage plotBorder seriesGroup clipRect credits pointer rangeSelector legend resetZoomButton tooltip renderer".split(" ").forEach(function(d) {
                        var e = a[d];
                        e && e.destroy && (a[d] = e.destroy())
                    });
                    c && (c.innerHTML = "", da(c), g && E(c));
                    S(a, function(d, e) {
                        delete a[e]
                    })
                };
                b.prototype.firstRender = function() {
                    var a = this,
                        d = a.options;
                    if (!a.isReadyToRender || a.isReadyToRender()) {
                        a.getContainer();
                        a.resetMargins();
                        a.setChartSize();
                        a.propFromSeries();
                        a.getAxes();
                        (M(d.series) ? d.series : []).forEach(function(d) {
                            a.initSeries(d)
                        });
                        a.linkSeries();
                        a.setSeriesData();
                        Q(a, "beforeRender");
                        t && (a.pointer = B.hasTouch || !K.PointerEvent && !K.MSPointerEvent ? new t(a, d) : new z(a, d));
                        a.render();
                        a.pointer.getChartPosition();
                        if (!a.renderer.imgCount && !a.hasLoaded) a.onload();
                        a.temporaryDisplay(!0)
                    }
                };
                b.prototype.onload = function() {
                    this.callbacks.concat([this.callback]).forEach(function(a) {
                        a && "undefined" !== typeof this.index && a.apply(this, [this])
                    }, this);
                    Q(this, "load");
                    Q(this, "render");
                    m(this.index) &&
                        this.setReflow(this.options.chart.reflow);
                    this.hasLoaded = !0
                };
                b.prototype.addSeries = function(a, d, e) {
                    var c, b = this;
                    a && (d = P(d, !0), Q(b, "addSeries", {
                        options: a
                    }, function() {
                        c = b.initSeries(a);
                        b.isDirtyLegend = !0;
                        b.linkSeries();
                        c.enabledDataSorting && c.setData(a.data, !1);
                        Q(b, "afterAddSeries", {
                            series: c
                        });
                        d && b.redraw(e)
                    }));
                    return c
                };
                b.prototype.addAxis = function(a, d, e, c) {
                    return this.createAxis(d ? "xAxis" : "yAxis", {
                        axis: a,
                        redraw: e,
                        animation: c
                    })
                };
                b.prototype.addColorAxis = function(a, d, e) {
                    return this.createAxis("colorAxis", {
                        axis: a,
                        redraw: d,
                        animation: e
                    })
                };
                b.prototype.createAxis = function(a, d) {
                    var e = this.options,
                        c = "colorAxis" === a,
                        b = d.redraw,
                        g = d.animation;
                    d = Y(d.axis, {
                        index: this[a].length,
                        isX: "xAxis" === a
                    });
                    var f = c ? new B.ColorAxis(this, d) : new l(this, d);
                    e[a] = X(e[a] || {});
                    e[a].push(d);
                    c && (this.isDirtyLegend = !0, this.axes.forEach(function(a) {
                        a.series = []
                    }), this.series.forEach(function(a) {
                        a.bindAxes();
                        a.isDirtyData = !0
                    }));
                    P(b, !0) && this.redraw(g);
                    return f
                };
                b.prototype.showLoading = function(e) {
                    var c = this,
                        b = c.options,
                        g = c.loadingDiv,
                        f = c.loadingSpan,
                        m = b.loading,
                        h = function() {
                            g && a(g, {
                                left: c.plotLeft + "px",
                                top: c.plotTop + "px",
                                width: c.plotWidth + "px",
                                height: c.plotHeight + "px"
                            })
                        };
                    g || (c.loadingDiv = g = d("div", {
                        className: "highcharts-loading highcharts-loading-hidden"
                    }, null, c.container));
                    f || (c.loadingSpan = f = d("span", {
                        className: "highcharts-loading-inner"
                    }, null, g), u(c, "redraw", h));
                    g.className = "highcharts-loading";
                    p.setElementHTML(f, P(e, b.lang.loading, ""));
                    c.styledMode || (a(g, N(m.style, {
                        zIndex: 10
                    })), a(f, m.labelStyle), c.loadingShown || (a(g, {
                        opacity: 0,
                        display: ""
                    }), k(g, {
                        opacity: m.style.opacity || .5
                    }, {
                        duration: m.showDuration || 0
                    })));
                    c.loadingShown = !0;
                    h()
                };
                b.prototype.hideLoading = function() {
                    var d = this.options,
                        e = this.loadingDiv;
                    e && (e.className = "highcharts-loading highcharts-loading-hidden", this.styledMode || k(e, {
                        opacity: 0
                    }, {
                        duration: d.loading.hideDuration || 100,
                        complete: function() {
                            a(e, {
                                display: "none"
                            })
                        }
                    }));
                    this.loadingShown = !1
                };
                b.prototype.update = function(a, d, e, c) {
                    var b = this,
                        f = {
                            credits: "addCredits",
                            title: "setTitle",
                            subtitle: "setSubtitle",
                            caption: "setCaption"
                        },
                        k, n, p, u = a.isResponsiveOptions,
                        l = [];
                    Q(b, "update", {
                        options: a
                    });
                    u || b.setResponsive(!1, !0);
                    a = g(a, b.options);
                    b.userOptions = Y(b.userOptions, a);
                    if (k = a.chart) {
                        Y(!0, b.options.chart, k);
                        "className" in k && b.setClassName(k.className);
                        "reflow" in k && b.setReflow(k.reflow);
                        if ("inverted" in k || "polar" in k || "type" in k) {
                            b.propFromSeries();
                            var D = !0
                        }
                        "alignTicks" in k && (D = !0);
                        S(k, function(a, d) {
                            -1 !== b.propsRequireUpdateSeries.indexOf("chart." + d) && (n = !0); - 1 !== b.propsRequireDirtyBox.indexOf(d) && (b.isDirtyBox = !0); - 1 !== b.propsRequireReflow.indexOf(d) &&
                                (u ? b.isDirtyBox = !0 : p = !0)
                        });
                        !b.styledMode && "style" in k && b.renderer.setStyle(k.style)
                    }!b.styledMode && a.colors && (this.options.colors = a.colors);
                    a.time && (this.time === r && (this.time = new h(a.time)), Y(!0, b.options.time, a.time));
                    S(a, function(d, e) {
                        if (b[e] && "function" === typeof b[e].update) b[e].update(d, !1);
                        else if ("function" === typeof b[f[e]]) b[f[e]](d);
                        else "color" !== e && -1 === b.collectionsWithUpdate.indexOf(e) && Y(!0, b.options[e], a[e]);
                        "chart" !== e && -1 !== b.propsRequireUpdateSeries.indexOf(e) && (n = !0)
                    });
                    this.collectionsWithUpdate.forEach(function(d) {
                        if (a[d]) {
                            if ("series" ===
                                d) {
                                var c = [];
                                b[d].forEach(function(a, d) {
                                    a.options.isInternal || c.push(P(a.options.index, d))
                                })
                            }
                            X(a[d]).forEach(function(a, g) {
                                var f = m(a.id),
                                    k;
                                f && (k = b.get(a.id));
                                !k && b[d] && (k = b[d][c ? c[g] : g]) && f && m(k.options.id) && (k = void 0);
                                k && k.coll === d && (k.update(a, !1), e && (k.touched = !0));
                                !k && e && b.collectionsWithInit[d] && (b.collectionsWithInit[d][0].apply(b, [a].concat(b.collectionsWithInit[d][1] || []).concat([!1])).touched = !0)
                            });
                            e && b[d].forEach(function(a) {
                                a.touched || a.options.isInternal ? delete a.touched : l.push(a)
                            })
                        }
                    });
                    l.forEach(function(a) {
                        a.chart && a.remove(!1)
                    });
                    D && b.axes.forEach(function(a) {
                        a.update({}, !1)
                    });
                    n && b.getSeriesOrderByLinks().forEach(function(a) {
                        a.chart && a.update({}, !1)
                    }, this);
                    D = k && k.width;
                    k = k && k.height;
                    aa(k) && (k = U(k, D || b.chartWidth));
                    p || F(D) && D !== b.chartWidth || F(k) && k !== b.chartHeight ? b.setSize(D, k, c) : P(d, !0) && b.redraw(c);
                    Q(b, "afterUpdate", {
                        options: a,
                        redraw: d,
                        animation: c
                    })
                };
                b.prototype.setSubtitle = function(a, d) {
                    this.applyDescription("subtitle", a);
                    this.layOutTitles(d)
                };
                b.prototype.setCaption = function(a,
                    d) {
                    this.applyDescription("caption", a);
                    this.layOutTitles(d)
                };
                b.prototype.showResetZoom = function() {
                    function a() {
                        d.zoomOut()
                    }
                    var d = this,
                        e = L.lang,
                        c = d.options.chart.resetZoomButton,
                        b = c.theme,
                        g = b.states,
                        f = "chart" === c.relativeTo || "spaceBox" === c.relativeTo ? null : this.scrollablePlotBox || "plotBox";
                    Q(this, "beforeShowResetZoom", null, function() {
                        d.resetZoomButton = d.renderer.button(e.resetZoom, null, null, a, b, g && g.hover).attr({
                            align: c.position.align,
                            title: e.resetZoomTitle
                        }).addClass("highcharts-reset-zoom").add().align(c.position,
                            !1, f)
                    });
                    Q(this, "afterShowResetZoom")
                };
                b.prototype.zoomOut = function() {
                    Q(this, "selection", {
                        resetSelection: !0
                    }, this.zoom)
                };
                b.prototype.zoom = function(a) {
                    var d = this,
                        e, c = d.pointer,
                        b = !1,
                        g = d.inverted ? c.mouseDownX : c.mouseDownY;
                    !a || a.resetSelection ? (d.axes.forEach(function(a) {
                        e = a.zoom()
                    }), c.initiated = !1) : a.xAxis.concat(a.yAxis).forEach(function(a) {
                        var f = a.axis,
                            k = d.inverted ? f.left : f.top,
                            h = d.inverted ? k + f.width : k + f.height,
                            n = f.isXAxis,
                            p = !1;
                        if (!n && g >= k && g <= h || n || !m(g)) p = !0;
                        c[n ? "zoomX" : "zoomY"] && p && (e = f.zoom(a.min,
                            a.max), f.displayBtn && (b = !0))
                    });
                    var f = d.resetZoomButton;
                    b && !f ? d.showResetZoom() : !b && J(f) && (d.resetZoomButton = f.destroy());
                    e && d.redraw(P(d.options.chart.animation, a && a.animation, 100 > d.pointCount))
                };
                b.prototype.pan = function(d, e) {
                    var c = this,
                        b = c.hoverPoints,
                        g = c.options.chart,
                        f = c.options.mapNavigation && c.options.mapNavigation.enabled,
                        m;
                    e = "object" === typeof e ? e : {
                        enabled: e,
                        type: "x"
                    };
                    g && g.panning && (g.panning = e);
                    var k = e.type;
                    Q(this, "pan", {
                        originalEvent: d
                    }, function() {
                        b && b.forEach(function(a) {
                            a.setState()
                        });
                        var e = [1];
                        "xy" === k ? e = [1, 0] : "y" === k && (e = [0]);
                        e.forEach(function(a) {
                            var e = c[a ? "xAxis" : "yAxis"][0],
                                b = e.horiz,
                                g = d[b ? "chartX" : "chartY"];
                            b = b ? "mouseDownX" : "mouseDownY";
                            var h = c[b],
                                n = (e.pointRange || 0) / 2,
                                p = e.reversed && !c.inverted || !e.reversed && c.inverted ? -1 : 1,
                                u = e.getExtremes(),
                                r = e.toValue(h - g, !0) + n * p;
                            p = e.toValue(h + e.len - g, !0) - n * p;
                            var l = p < r;
                            h = l ? p : r;
                            r = l ? r : p;
                            p = e.hasVerticalPanning();
                            var D = e.panningState;
                            !p || a || D && !D.isDirty || e.series.forEach(function(a) {
                                var d = a.getProcessedData(!0);
                                d = a.getExtremes(d.yData, !0);
                                D || (D = {
                                    startMin: Number.MAX_VALUE,
                                    startMax: -Number.MAX_VALUE
                                });
                                F(d.dataMin) && F(d.dataMax) && (D.startMin = Math.min(P(a.options.threshold, Infinity), d.dataMin, D.startMin), D.startMax = Math.max(P(a.options.threshold, -Infinity), d.dataMax, D.startMax))
                            });
                            a = Math.min(P(null === D || void 0 === D ? void 0 : D.startMin, u.dataMin), n ? u.min : e.toValue(e.toPixels(u.min) - e.minPixelPadding));
                            n = Math.max(P(null === D || void 0 === D ? void 0 : D.startMax, u.dataMax), n ? u.max : e.toValue(e.toPixels(u.max) + e.minPixelPadding));
                            e.panningState = D;
                            e.isOrdinal ||
                                (p = a - h, 0 < p && (r += p, h = a), p = r - n, 0 < p && (r = n, h -= p), e.series.length && h !== u.min && r !== u.max && h >= a && r <= n && (e.setExtremes(h, r, !1, !1, {
                                    trigger: "pan"
                                }), c.resetZoomButton || f || h === a || r === n || !k.match("y") || (c.showResetZoom(), e.displayBtn = !1), m = !0), c[b] = g)
                        });
                        m && c.redraw(!1);
                        a(c.container, {
                            cursor: "move"
                        })
                    })
                };
                return b
            }();
        N(ba.prototype, {
            callbacks: [],
            collectionsWithInit: {
                xAxis: [ba.prototype.addAxis, [!0]],
                yAxis: [ba.prototype.addAxis, [!1]],
                series: [ba.prototype.addSeries]
            },
            collectionsWithUpdate: ["xAxis", "yAxis", "zAxis",
                "series"
            ],
            propsRequireDirtyBox: "backgroundColor borderColor borderWidth borderRadius plotBackgroundColor plotBackgroundImage plotBorderColor plotBorderWidth plotShadow shadow".split(" "),
            propsRequireReflow: "margin marginTop marginRight marginBottom marginLeft spacing spacingTop spacingRight spacingBottom spacingLeft".split(" "),
            propsRequireUpdateSeries: "chart.inverted chart.polar chart.ignoreHiddenSeries chart.type colors plotOptions time tooltip".split(" ")
        });
        B.chart = function(a, d, e) {
            return new ba(a,
                d, e)
        };
        B.Chart = ba;
        "";
        return ba
    });
    J(b, "Mixins/LegendSymbol.js", [b["Core/Globals.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = l.merge,
            y = l.pick;
        return b.LegendSymbolMixin = {
            drawRectangle: function(b, l) {
                var v = b.symbolHeight,
                    t = b.options.squareSymbol;
                l.legendSymbol = this.chart.renderer.rect(t ? (b.symbolWidth - v) / 2 : 0, b.baseline - v + 1, t ? v : b.symbolWidth, v, y(b.options.symbolRadius, v / 2)).addClass("highcharts-point").attr({
                    zIndex: 3
                }).add(l.legendGroup)
            },
            drawLineMarker: function(b) {
                var l = this.options,
                    v = l.marker,
                    t =
                    b.symbolWidth,
                    q = b.symbolHeight,
                    h = q / 2,
                    c = this.chart.renderer,
                    p = this.legendGroup;
                b = b.baseline - Math.round(.3 * b.fontMetrics.b);
                var k = {};
                this.chart.styledMode || (k = {
                    "stroke-width": l.lineWidth || 0
                }, l.dashStyle && (k.dashstyle = l.dashStyle));
                this.legendLine = c.path([
                    ["M", 0, b],
                    ["L", t, b]
                ]).addClass("highcharts-graph").attr(k).add(p);
                v && !1 !== v.enabled && t && (l = Math.min(y(v.radius, h), h), 0 === this.symbol.indexOf("url") && (v = w(v, {
                        width: q,
                        height: q
                    }), l = 0), this.legendSymbol = v = c.symbol(this.symbol, t / 2 - l, b - l, 2 * l, 2 * l, v).addClass("highcharts-point").add(p),
                    v.isMarker = !0)
            }
        }
    });
    J(b, "Core/Series/Series.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Globals.js"], b["Mixins/LegendSymbol.js"], b["Core/Options.js"], b["Core/Color/Palette.js"], b["Core/Series/Point.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Renderer/SVG/SVGElement.js"], b["Core/Utilities.js"]], function(b, l, B, y, z, C, v, t, q) {
        var h = b.animObject,
            c = b.setAnimation,
            p = l.hasTouch,
            k = l.svg,
            G = l.win,
            f = y.defaultOptions,
            w = v.seriesTypes,
            x = q.addEvent,
            K = q.arrayMax,
            L = q.arrayMin,
            r = q.clamp,
            n = q.cleanRecursively,
            u = q.correctFloat,
            e = q.defined,
            g = q.erase,
            d = q.error,
            a = q.extend,
            m = q.find,
            E = q.fireEvent,
            I = q.getNestedProperty,
            A = q.isArray,
            N = q.isFunction,
            R = q.isNumber,
            Q = q.isString,
            T = q.merge,
            M = q.objectEach,
            O = q.pick,
            F = q.removeEvent,
            J = q.splat,
            aa = q.syncTimeout;
        b = function() {
            function b() {
                this.zones = this.yAxis = this.xAxis = this.userOptions = this.tooltipOptions = this.processedYData = this.processedXData = this.points = this.options = this.linkedSeries = this.index = this.eventsToUnbind = this.eventOptions = this.data = this.chart = this._i = void 0
            }
            b.prototype.init =
                function(d, e) {
                    E(this, "init", {
                        options: e
                    });
                    var c = this,
                        b = d.series,
                        g;
                    this.eventOptions = this.eventOptions || {};
                    this.eventsToUnbind = [];
                    c.chart = d;
                    c.options = e = c.setOptions(e);
                    c.linkedSeries = [];
                    c.bindAxes();
                    a(c, {
                        name: e.name,
                        state: "",
                        visible: !1 !== e.visible,
                        selected: !0 === e.selected
                    });
                    var f = e.events;
                    M(f, function(a, d) {
                        N(a) && c.eventOptions[d] !== a && (N(c.eventOptions[d]) && F(c, d, c.eventOptions[d]), c.eventOptions[d] = a, x(c, d, a))
                    });
                    if (f && f.click || e.point && e.point.events && e.point.events.click || e.allowPointSelect) d.runTrackerClick = !0;
                    c.getColor();
                    c.getSymbol();
                    c.parallelArrays.forEach(function(a) {
                        c[a + "Data"] || (c[a + "Data"] = [])
                    });
                    c.isCartesian && (d.hasCartesianSeries = !0);
                    b.length && (g = b[b.length - 1]);
                    c._i = O(g && g._i, -1) + 1;
                    c.opacity = c.options.opacity;
                    d.orderSeries(this.insert(b));
                    e.dataSorting && e.dataSorting.enabled ? c.setDataSortingOptions() : c.points || c.data || c.setData(e.data, !1);
                    E(this, "afterInit")
                };
            b.prototype.is = function(a) {
                return w[a] && this instanceof w[a]
            };
            b.prototype.insert = function(a) {
                var d = this.options.index,
                    e;
                if (R(d)) {
                    for (e =
                        a.length; e--;)
                        if (d >= O(a[e].options.index, a[e]._i)) {
                            a.splice(e + 1, 0, this);
                            break
                        } - 1 === e && a.unshift(this);
                    e += 1
                } else a.push(this);
                return O(e, a.length - 1)
            };
            b.prototype.bindAxes = function() {
                var a = this,
                    e = a.options,
                    c = a.chart,
                    b;
                E(this, "bindAxes", null, function() {
                    (a.axisTypes || []).forEach(function(g) {
                        c[g].forEach(function(d) {
                            b = d.options;
                            if (e[g] === b.index || "undefined" !== typeof e[g] && e[g] === b.id || "undefined" === typeof e[g] && 0 === b.index) a.insert(d.series), a[g] = d, d.isDirty = !0
                        });
                        a[g] || a.optionalAxis === g || d(18, !0, c)
                    })
                });
                E(this, "afterBindAxes")
            };
            b.prototype.updateParallelArrays = function(a, d) {
                var e = a.series,
                    c = arguments,
                    b = R(d) ? function(c) {
                        var b = "y" === c && e.toYData ? e.toYData(a) : a[c];
                        e[c + "Data"][d] = b
                    } : function(a) {
                        Array.prototype[d].apply(e[a + "Data"], Array.prototype.slice.call(c, 2))
                    };
                e.parallelArrays.forEach(b)
            };
            b.prototype.hasData = function() {
                return this.visible && "undefined" !== typeof this.dataMax && "undefined" !== typeof this.dataMin || this.visible && this.yData && 0 < this.yData.length
            };
            b.prototype.autoIncrement = function() {
                var a =
                    this.options,
                    d = this.xIncrement,
                    e, c = a.pointIntervalUnit,
                    b = this.chart.time;
                d = O(d, a.pointStart, 0);
                this.pointInterval = e = O(this.pointInterval, a.pointInterval, 1);
                c && (a = new b.Date(d), "day" === c ? b.set("Date", a, b.get("Date", a) + e) : "month" === c ? b.set("Month", a, b.get("Month", a) + e) : "year" === c && b.set("FullYear", a, b.get("FullYear", a) + e), e = a.getTime() - d);
                this.xIncrement = d + e;
                return d
            };
            b.prototype.setDataSortingOptions = function() {
                var d = this.options;
                a(this, {
                    requireSorting: !1,
                    sorted: !1,
                    enabledDataSorting: !0,
                    allowDG: !1
                });
                e(d.pointRange) || (d.pointRange = 1)
            };
            b.prototype.setOptions = function(a) {
                var d = this.chart,
                    c = d.options,
                    b = c.plotOptions,
                    g = d.userOptions || {};
                a = T(a);
                d = d.styledMode;
                var m = {
                    plotOptions: b,
                    userOptions: a
                };
                E(this, "setOptions", m);
                var k = m.plotOptions[this.type],
                    h = g.plotOptions || {};
                this.userOptions = m.userOptions;
                g = T(k, b.series, g.plotOptions && g.plotOptions[this.type], a);
                this.tooltipOptions = T(f.tooltip, f.plotOptions.series && f.plotOptions.series.tooltip, f.plotOptions[this.type].tooltip, c.tooltip.userOptions, b.series &&
                    b.series.tooltip, b[this.type].tooltip, a.tooltip);
                this.stickyTracking = O(a.stickyTracking, h[this.type] && h[this.type].stickyTracking, h.series && h.series.stickyTracking, this.tooltipOptions.shared && !this.noSharedTooltip ? !0 : g.stickyTracking);
                null === k.marker && delete g.marker;
                this.zoneAxis = g.zoneAxis;
                c = this.zones = (g.zones || []).slice();
                !g.negativeColor && !g.negativeFillColor || g.zones || (b = {
                    value: g[this.zoneAxis + "Threshold"] || g.threshold || 0,
                    className: "highcharts-negative"
                }, d || (b.color = g.negativeColor, b.fillColor =
                    g.negativeFillColor), c.push(b));
                c.length && e(c[c.length - 1].value) && c.push(d ? {} : {
                    color: this.color,
                    fillColor: this.fillColor
                });
                E(this, "afterSetOptions", {
                    options: g
                });
                return g
            };
            b.prototype.getName = function() {
                return O(this.options.name, "Series " + (this.index + 1))
            };
            b.prototype.getCyclic = function(a, d, c) {
                var b = this.chart,
                    g = this.userOptions,
                    f = a + "Index",
                    m = a + "Counter",
                    k = c ? c.length : O(b.options.chart[a + "Count"], b[a + "Count"]);
                if (!d) {
                    var h = O(g[f], g["_" + f]);
                    e(h) || (b.series.length || (b[m] = 0), g["_" + f] = h = b[m] % k, b[m] += 1);
                    c && (d = c[h])
                }
                "undefined" !== typeof h && (this[f] = h);
                this[a] = d
            };
            b.prototype.getColor = function() {
                this.chart.styledMode ? this.getCyclic("color") : this.options.colorByPoint ? this.options.color = null : this.getCyclic("color", this.options.color || f.plotOptions[this.type].color, this.chart.options.colors)
            };
            b.prototype.getPointsCollection = function() {
                return (this.hasGroupedData ? this.points : this.data) || []
            };
            b.prototype.getSymbol = function() {
                this.getCyclic("symbol", this.options.marker.symbol, this.chart.options.symbols)
            };
            b.prototype.findPointIndex =
                function(a, d) {
                    var e = a.id,
                        c = a.x,
                        b = this.points,
                        g, f = this.options.dataSorting;
                    if (e) var k = this.chart.get(e);
                    else if (this.linkedParent || this.enabledDataSorting) {
                        var h = f && f.matchByName ? "name" : "index";
                        k = m(b, function(d) {
                            return !d.touched && d[h] === a[h]
                        });
                        if (!k) return
                    }
                    if (k) {
                        var n = k && k.index;
                        "undefined" !== typeof n && (g = !0)
                    }
                    "undefined" === typeof n && R(c) && (n = this.xData.indexOf(c, d)); - 1 !== n && "undefined" !== typeof n && this.cropped && (n = n >= this.cropStart ? n - this.cropStart : n);
                    !g && b[n] && b[n].touched && (n = void 0);
                    return n
                };
            b.prototype.updateData =
                function(a, d) {
                    var c = this.options,
                        b = c.dataSorting,
                        g = this.points,
                        f = [],
                        m, k, h, n = this.requireSorting,
                        p = a.length === g.length,
                        u = !0;
                    this.xIncrement = null;
                    a.forEach(function(a, d) {
                            var k = e(a) && this.pointClass.prototype.optionsToObject.call({
                                series: this
                            }, a) || {};
                            var u = k.x;
                            if (k.id || R(u)) {
                                if (u = this.findPointIndex(k, h), -1 === u || "undefined" === typeof u ? f.push(a) : g[u] && a !== c.data[u] ? (g[u].update(a, !1, null, !1), g[u].touched = !0, n && (h = u + 1)) : g[u] && (g[u].touched = !0), !p || d !== u || b && b.enabled || this.hasDerivedData) m = !0
                            } else f.push(a)
                        },
                        this);
                    if (m)
                        for (a = g.length; a--;)(k = g[a]) && !k.touched && k.remove && k.remove(!1, d);
                    else !p || b && b.enabled ? u = !1 : (a.forEach(function(a, d) {
                        g[d].update && a !== g[d].y && g[d].update(a, !1, null, !1)
                    }), f.length = 0);
                    g.forEach(function(a) {
                        a && (a.touched = !1)
                    });
                    if (!u) return !1;
                    f.forEach(function(a) {
                        this.addPoint(a, !1, null, null, !1)
                    }, this);
                    null === this.xIncrement && this.xData && this.xData.length && (this.xIncrement = K(this.xData), this.autoIncrement());
                    return !0
                };
            b.prototype.setData = function(a, e, c, b) {
                var g = this,
                    f = g.points,
                    m = f && f.length ||
                    0,
                    k, h = g.options,
                    n = g.chart,
                    p = h.dataSorting,
                    u = null,
                    r = g.xAxis;
                u = h.turboThreshold;
                var l = this.xData,
                    q = this.yData,
                    D = (k = g.pointArrayMap) && k.length,
                    x = h.keys,
                    t = 0,
                    E = 1,
                    v;
                a = a || [];
                k = a.length;
                e = O(e, !0);
                p && p.enabled && (a = this.sortData(a));
                !1 !== b && k && m && !g.cropped && !g.hasGroupedData && g.visible && !g.isSeriesBoosting && (v = this.updateData(a, c));
                if (!v) {
                    g.xIncrement = null;
                    g.colorCounter = 0;
                    this.parallelArrays.forEach(function(a) {
                        g[a + "Data"].length = 0
                    });
                    if (u && k > u)
                        if (u = g.getFirstValidPoint(a), R(u))
                            for (c = 0; c < k; c++) l[c] = this.autoIncrement(),
                                q[c] = a[c];
                        else if (A(u))
                        if (D)
                            for (c = 0; c < k; c++) b = a[c], l[c] = b[0], q[c] = b.slice(1, D + 1);
                        else
                            for (x && (t = x.indexOf("x"), E = x.indexOf("y"), t = 0 <= t ? t : 0, E = 0 <= E ? E : 1), c = 0; c < k; c++) b = a[c], l[c] = b[t], q[c] = b[E];
                    else d(12, !1, n);
                    else
                        for (c = 0; c < k; c++) "undefined" !== typeof a[c] && (b = {
                            series: g
                        }, g.pointClass.prototype.applyOptions.apply(b, [a[c]]), g.updateParallelArrays(b, c));
                    q && Q(q[0]) && d(14, !0, n);
                    g.data = [];
                    g.options.data = g.userOptions.data = a;
                    for (c = m; c--;) f[c] && f[c].destroy && f[c].destroy();
                    r && (r.minRange = r.userMinRange);
                    g.isDirty =
                        n.isDirtyBox = !0;
                    g.isDirtyData = !!f;
                    c = !1
                }
                "point" === h.legendType && (this.processData(), this.generatePoints());
                e && n.redraw(c)
            };
            b.prototype.sortData = function(a) {
                var d = this,
                    c = d.options.dataSorting.sortKey || "y",
                    b = function(a, d) {
                        return e(d) && a.pointClass.prototype.optionsToObject.call({
                            series: a
                        }, d) || {}
                    };
                a.forEach(function(e, c) {
                    a[c] = b(d, e);
                    a[c].index = c
                }, this);
                a.concat().sort(function(a, d) {
                    a = I(c, a);
                    d = I(c, d);
                    return d < a ? -1 : d > a ? 1 : 0
                }).forEach(function(a, d) {
                    a.x = d
                }, this);
                d.linkedSeries && d.linkedSeries.forEach(function(d) {
                    var e =
                        d.options,
                        c = e.data;
                    e.dataSorting && e.dataSorting.enabled || !c || (c.forEach(function(e, g) {
                        c[g] = b(d, e);
                        a[g] && (c[g].x = a[g].x, c[g].index = g)
                    }), d.setData(c, !1))
                });
                return a
            };
            b.prototype.getProcessedData = function(a) {
                var e = this.xData,
                    c = this.yData,
                    b = e.length;
                var g = 0;
                var f = this.xAxis,
                    m = this.options;
                var k = m.cropThreshold;
                var h = a || this.getExtremesFromAll || m.getExtremesFromAll,
                    n = this.isCartesian;
                a = f && f.val2lin;
                m = !(!f || !f.logarithmic);
                var p = this.requireSorting;
                if (f) {
                    f = f.getExtremes();
                    var u = f.min;
                    var r = f.max
                }
                if (n &&
                    this.sorted && !h && (!k || b > k || this.forceCrop))
                    if (e[b - 1] < u || e[0] > r) e = [], c = [];
                    else if (this.yData && (e[0] < u || e[b - 1] > r)) {
                    g = this.cropData(this.xData, this.yData, u, r);
                    e = g.xData;
                    c = g.yData;
                    g = g.start;
                    var l = !0
                }
                for (k = e.length || 1; --k;)
                    if (b = m ? a(e[k]) - a(e[k - 1]) : e[k] - e[k - 1], 0 < b && ("undefined" === typeof q || b < q)) var q = b;
                    else 0 > b && p && (d(15, !1, this.chart), p = !1);
                return {
                    xData: e,
                    yData: c,
                    cropped: l,
                    cropStart: g,
                    closestPointRange: q
                }
            };
            b.prototype.processData = function(a) {
                var d = this.xAxis;
                if (this.isCartesian && !this.isDirty && !d.isDirty &&
                    !this.yAxis.isDirty && !a) return !1;
                a = this.getProcessedData();
                this.cropped = a.cropped;
                this.cropStart = a.cropStart;
                this.processedXData = a.xData;
                this.processedYData = a.yData;
                this.closestPointRange = this.basePointRange = a.closestPointRange
            };
            b.prototype.cropData = function(a, d, e, c, b) {
                var g = a.length,
                    f = 0,
                    m = g,
                    k;
                b = O(b, this.cropShoulder);
                for (k = 0; k < g; k++)
                    if (a[k] >= e) {
                        f = Math.max(0, k - b);
                        break
                    } for (e = k; e < g; e++)
                    if (a[e] > c) {
                        m = e + b;
                        break
                    } return {
                    xData: a.slice(f, m),
                    yData: d.slice(f, m),
                    start: f,
                    end: m
                }
            };
            b.prototype.generatePoints = function() {
                var d =
                    this.options,
                    e = d.data,
                    c = this.data,
                    b, g = this.processedXData,
                    f = this.processedYData,
                    m = this.pointClass,
                    k = g.length,
                    h = this.cropStart || 0,
                    n = this.hasGroupedData;
                d = d.keys;
                var p = [],
                    u;
                c || n || (c = [], c.length = e.length, c = this.data = c);
                d && n && (this.options.keys = !1);
                for (u = 0; u < k; u++) {
                    var r = h + u;
                    if (n) {
                        var l = (new m).init(this, [g[u]].concat(J(f[u])));
                        l.dataGroup = this.groupMap[u];
                        l.dataGroup.options && (l.options = l.dataGroup.options, a(l, l.dataGroup.options), delete l.dataLabels)
                    } else(l = c[r]) || "undefined" === typeof e[r] || (c[r] = l =
                        (new m).init(this, e[r], g[u]));
                    l && (l.index = r, p[u] = l)
                }
                this.options.keys = d;
                if (c && (k !== (b = c.length) || n))
                    for (u = 0; u < b; u++) u !== h || n || (u += k), c[u] && (c[u].destroyElements(), c[u].plotX = void 0);
                this.data = c;
                this.points = p;
                E(this, "afterGeneratePoints")
            };
            b.prototype.getXExtremes = function(a) {
                return {
                    min: L(a),
                    max: K(a)
                }
            };
            b.prototype.getExtremes = function(a, d) {
                var e = this.xAxis,
                    c = this.yAxis,
                    b = this.processedXData || this.xData,
                    g = [],
                    f = 0,
                    m = 0;
                var k = 0;
                var h = this.requireSorting ? this.cropShoulder : 0,
                    n = c ? c.positiveValuesOnly : !1,
                    p;
                a = a || this.stackedYData || this.processedYData || [];
                c = a.length;
                e && (k = e.getExtremes(), m = k.min, k = k.max);
                for (p = 0; p < c; p++) {
                    var u = b[p];
                    var r = a[p];
                    var l = (R(r) || A(r)) && (r.length || 0 < r || !n);
                    u = d || this.getExtremesFromAll || this.options.getExtremesFromAll || this.cropped || !e || (b[p + h] || u) >= m && (b[p - h] || u) <= k;
                    if (l && u)
                        if (l = r.length)
                            for (; l--;) R(r[l]) && (g[f++] = r[l]);
                        else g[f++] = r
                }
                a = {
                    dataMin: L(g),
                    dataMax: K(g)
                };
                E(this, "afterGetExtremes", {
                    dataExtremes: a
                });
                return a
            };
            b.prototype.applyExtremes = function() {
                var a = this.getExtremes();
                this.dataMin = a.dataMin;
                this.dataMax = a.dataMax;
                return a
            };
            b.prototype.getFirstValidPoint = function(a) {
                for (var d = null, e = a.length, c = 0; null === d && c < e;) d = a[c], c++;
                return d
            };
            b.prototype.translate = function() {
                this.processedXData || this.processData();
                this.generatePoints();
                var a = this.options,
                    d = a.stacking,
                    c = this.xAxis,
                    b = c.categories,
                    g = this.enabledDataSorting,
                    f = this.yAxis,
                    m = this.points,
                    k = m.length,
                    h = !!this.modifyValue,
                    n, p = this.pointPlacementToXValue(),
                    l = !!p,
                    q = a.threshold,
                    x = a.startFromThreshold ? q : 0,
                    t, v = this.zoneAxis ||
                    "y",
                    I = Number.MAX_VALUE;
                for (n = 0; n < k; n++) {
                    var G = m[n],
                        w = G.x,
                        H = G.y,
                        z = G.low,
                        C = d && f.stacking && f.stacking.stacks[(this.negStacks && H < (x ? 0 : q) ? "-" : "") + this.stackKey];
                    if (f.positiveValuesOnly && !f.validatePositiveValue(H) || c.positiveValuesOnly && !c.validatePositiveValue(w)) G.isNull = !0;
                    G.plotX = t = u(r(c.translate(w, 0, 0, 0, 1, p, "flags" === this.type), -1E5, 1E5));
                    if (d && this.visible && C && C[w]) {
                        var L = this.getStackIndicator(L, w, this.index);
                        if (!G.isNull) {
                            var N = C[w];
                            var K = N.points[L.key]
                        }
                    }
                    A(K) && (z = K[0], H = K[1], z === x && L.key === C[w].base &&
                        (z = O(R(q) && q, f.min)), f.positiveValuesOnly && 0 >= z && (z = null), G.total = G.stackTotal = N.total, G.percentage = N.total && G.y / N.total * 100, G.stackY = H, this.irregularWidths || N.setOffset(this.pointXOffset || 0, this.barW || 0));
                    G.yBottom = e(z) ? r(f.translate(z, 0, 1, 0, 1), -1E5, 1E5) : null;
                    h && (H = this.modifyValue(H, G));
                    G.plotY = void 0;
                    R(H) && (H = f.translate(H, !1, !0, !1, !0), "undefined" !== typeof H && (G.plotY = r(H, -1E5, 1E5)));
                    G.isInside = this.isPointInside(G);
                    G.clientX = l ? u(c.translate(w, 0, 0, 0, 1, p)) : t;
                    G.negative = G[v] < (a[v + "Threshold"] || q ||
                        0);
                    G.category = b && "undefined" !== typeof b[G.x] ? b[G.x] : G.x;
                    if (!G.isNull && !1 !== G.visible) {
                        "undefined" !== typeof F && (I = Math.min(I, Math.abs(t - F)));
                        var F = t
                    }
                    G.zone = this.zones.length && G.getZone();
                    !G.graphic && this.group && g && (G.isNew = !0)
                }
                this.closestPointRangePx = I;
                E(this, "afterTranslate")
            };
            b.prototype.getValidPoints = function(a, d, e) {
                var c = this.chart;
                return (a || this.points || []).filter(function(a) {
                    return d && !c.isInsidePlot(a.plotX, a.plotY, c.inverted) ? !1 : !1 !== a.visible && (e || !a.isNull)
                })
            };
            b.prototype.getClipBox = function(a,
                d) {
                var e = this.options,
                    c = this.chart,
                    b = c.inverted,
                    g = this.xAxis,
                    f = g && this.yAxis,
                    m = c.options.chart.scrollablePlotArea || {};
                a && !1 === e.clip && f ? a = b ? {
                    y: -c.chartWidth + f.len + f.pos,
                    height: c.chartWidth,
                    width: c.chartHeight,
                    x: -c.chartHeight + g.len + g.pos
                } : {
                    y: -f.pos,
                    height: c.chartHeight,
                    width: c.chartWidth,
                    x: -g.pos
                } : (a = this.clipBox || c.clipBox, d && (a.width = c.plotSizeX, a.x = (c.scrollablePixelsX || 0) * (m.scrollPositionX || 0)));
                return d ? {
                    width: a.width,
                    x: a.x
                } : a
            };
            b.prototype.setClip = function(a) {
                var d = this.chart,
                    e = this.options,
                    c = d.renderer,
                    b = d.inverted,
                    g = this.clipBox,
                    f = this.getClipBox(a),
                    m = this.sharedClipKey || ["_sharedClip", a && a.duration, a && a.easing, a && a.defer, f.height, e.xAxis, e.yAxis].join(),
                    k = d[m],
                    h = d[m + "m"];
                a && (f.width = 0, b && (f.x = d.plotHeight + (!1 !== e.clip ? 0 : d.plotTop)));
                k ? d.hasLoaded || k.attr(f) : (a && (d[m + "m"] = h = c.clipRect(b ? d.plotSizeX + 99 : -99, b ? -d.plotLeft : -d.plotTop, 99, b ? d.chartWidth : d.chartHeight)), d[m] = k = c.clipRect(f), k.count = {
                    length: 0
                });
                a && !k.count[this.index] && (k.count[this.index] = !0, k.count.length += 1);
                if (!1 !== e.clip ||
                    a) this.group.clip(a || g ? k : d.clipRect), this.markerGroup.clip(h), this.sharedClipKey = m;
                a || (k.count[this.index] && (delete k.count[this.index], --k.count.length), 0 === k.count.length && m && d[m] && (g || (d[m] = d[m].destroy()), d[m + "m"] && (d[m + "m"] = d[m + "m"].destroy())))
            };
            b.prototype.animate = function(a) {
                var d = this.chart,
                    e = h(this.options.animation);
                if (a) this.setClip(e);
                else {
                    var c = this.sharedClipKey;
                    a = d[c];
                    var b = this.getClipBox(e, !0);
                    a && a.animate(b, e);
                    d[c + "m"] && d[c + "m"].animate({
                            width: b.width + 99,
                            x: b.x - (d.inverted ? 0 : 99)
                        },
                        e)
                }
            };
            b.prototype.afterAnimate = function() {
                this.setClip();
                E(this, "afterAnimate");
                this.finishedAnimating = !0
            };
            b.prototype.drawPoints = function() {
                var a = this.points,
                    d = this.chart,
                    e, c, b = this.options.marker,
                    g = this[this.specialGroup] || this.markerGroup,
                    f = this.xAxis,
                    m = O(b.enabled, !f || f.isRadial ? !0 : null, this.closestPointRangePx >= b.enabledThreshold * b.radius);
                if (!1 !== b.enabled || this._hasPointMarkers)
                    for (e = 0; e < a.length; e++) {
                        var k = a[e];
                        var h = (c = k.graphic) ? "animate" : "attr";
                        var n = k.marker || {};
                        var p = !!k.marker;
                        if ((m &&
                                "undefined" === typeof n.enabled || n.enabled) && !k.isNull && !1 !== k.visible) {
                            var u = O(n.symbol, this.symbol);
                            var r = this.markerAttribs(k, k.selected && "select");
                            this.enabledDataSorting && (k.startXPos = f.reversed ? -r.width : f.width);
                            var l = !1 !== k.isInside;
                            c ? c[l ? "show" : "hide"](l).animate(r) : l && (0 < r.width || k.hasImage) && (k.graphic = c = d.renderer.symbol(u, r.x, r.y, r.width, r.height, p ? n : b).add(g), this.enabledDataSorting && d.hasRendered && (c.attr({
                                x: k.startXPos
                            }), h = "animate"));
                            c && "animate" === h && c[l ? "show" : "hide"](l).animate(r);
                            if (c && !d.styledMode) c[h](this.pointAttribs(k, k.selected && "select"));
                            c && c.addClass(k.getClassName(), !0)
                        } else c && (k.graphic = c.destroy())
                    }
            };
            b.prototype.markerAttribs = function(a, d) {
                var e = this.options,
                    c = e.marker,
                    b = a.marker || {},
                    g = b.symbol || c.symbol,
                    f = O(b.radius, c.radius);
                d && (c = c.states[d], d = b.states && b.states[d], f = O(d && d.radius, c && c.radius, f + (c && c.radiusPlus || 0)));
                a.hasImage = g && 0 === g.indexOf("url");
                a.hasImage && (f = 0);
                a = {
                    x: e.crisp ? Math.floor(a.plotX) - f : a.plotX - f,
                    y: a.plotY - f
                };
                f && (a.width = a.height = 2 * f);
                return a
            };
            b.prototype.pointAttribs = function(a, d) {
                var e = this.options.marker,
                    c = a && a.options,
                    b = c && c.marker || {},
                    g = this.color,
                    f = c && c.color,
                    m = a && a.color;
                c = O(b.lineWidth, e.lineWidth);
                var k = a && a.zone && a.zone.color;
                a = 1;
                g = f || k || m || g;
                f = b.fillColor || e.fillColor || g;
                g = b.lineColor || e.lineColor || g;
                d = d || "normal";
                e = e.states[d];
                d = b.states && b.states[d] || {};
                c = O(d.lineWidth, e.lineWidth, c + O(d.lineWidthPlus, e.lineWidthPlus, 0));
                f = d.fillColor || e.fillColor || f;
                g = d.lineColor || e.lineColor || g;
                a = O(d.opacity, e.opacity, a);
                return {
                    stroke: g,
                    "stroke-width": c,
                    fill: f,
                    opacity: a
                }
            };
            b.prototype.destroy = function(a) {
                var d = this,
                    e = d.chart,
                    c = /AppleWebKit\/533/.test(G.navigator.userAgent),
                    b, f, m = d.data || [],
                    k, h;
                E(d, "destroy");
                this.removeEvents(a);
                (d.axisTypes || []).forEach(function(a) {
                    (h = d[a]) && h.series && (g(h.series, d), h.isDirty = h.forceRedraw = !0)
                });
                d.legendItem && d.chart.legend.destroyItem(d);
                for (f = m.length; f--;)(k = m[f]) && k.destroy && k.destroy();
                d.points = null;
                q.clearTimeout(d.animationTimeout);
                M(d, function(a, d) {
                    a instanceof t && !a.survive && (b = c && "group" === d ? "hide" : "destroy",
                        a[b]())
                });
                e.hoverSeries === d && (e.hoverSeries = null);
                g(e.series, d);
                e.orderSeries();
                M(d, function(e, c) {
                    a && "hcEvents" === c || delete d[c]
                })
            };
            b.prototype.applyZones = function() {
                var a = this,
                    d = this.chart,
                    e = d.renderer,
                    c = this.zones,
                    b, g, f = this.clips || [],
                    m, k = this.graph,
                    h = this.area,
                    n = Math.max(d.chartWidth, d.chartHeight),
                    p = this[(this.zoneAxis || "y") + "Axis"],
                    u = d.inverted,
                    l, q, x, A = !1,
                    t, E;
                if (c.length && (k || h) && p && "undefined" !== typeof p.min) {
                    var v = p.reversed;
                    var G = p.horiz;
                    k && !this.showLine && k.hide();
                    h && h.hide();
                    var I = p.getExtremes();
                    c.forEach(function(c, D) {
                        b = v ? G ? d.plotWidth : 0 : G ? 0 : p.toPixels(I.min) || 0;
                        b = r(O(g, b), 0, n);
                        g = r(Math.round(p.toPixels(O(c.value, I.max), !0) || 0), 0, n);
                        A && (b = g = p.toPixels(I.max));
                        l = Math.abs(b - g);
                        q = Math.min(b, g);
                        x = Math.max(b, g);
                        p.isXAxis ? (m = {
                            x: u ? x : q,
                            y: 0,
                            width: l,
                            height: n
                        }, G || (m.x = d.plotHeight - m.x)) : (m = {
                            x: 0,
                            y: u ? x : q,
                            width: n,
                            height: l
                        }, G && (m.y = d.plotWidth - m.y));
                        u && e.isVML && (m = p.isXAxis ? {
                            x: 0,
                            y: v ? q : x,
                            height: m.width,
                            width: d.chartWidth
                        } : {
                            x: m.y - d.plotLeft - d.spacingBox.x,
                            y: 0,
                            width: m.height,
                            height: d.chartHeight
                        });
                        f[D] ? f[D].animate(m) :
                            f[D] = e.clipRect(m);
                        t = a["zone-area-" + D];
                        E = a["zone-graph-" + D];
                        k && E && E.clip(f[D]);
                        h && t && t.clip(f[D]);
                        A = c.value > I.max;
                        a.resetZones && 0 === g && (g = void 0)
                    });
                    this.clips = f
                } else a.visible && (k && k.show(!0), h && h.show(!0))
            };
            b.prototype.invertGroups = function(a) {
                function d() {
                    ["group", "markerGroup"].forEach(function(d) {
                        e[d] && (c.renderer.isVML && e[d].attr({
                            width: e.yAxis.len,
                            height: e.xAxis.len
                        }), e[d].width = e.yAxis.len, e[d].height = e.xAxis.len, e[d].invert(e.isRadialSeries ? !1 : a))
                    })
                }
                var e = this,
                    c = e.chart;
                e.xAxis && (e.eventsToUnbind.push(x(c,
                    "resize", d)), d(), e.invertGroups = d)
            };
            b.prototype.plotGroup = function(a, d, c, b, g) {
                var f = this[a],
                    m = !f;
                c = {
                    visibility: c,
                    zIndex: b || .1
                };
                "undefined" === typeof this.opacity || this.chart.styledMode || "inactive" === this.state || (c.opacity = this.opacity);
                m && (this[a] = f = this.chart.renderer.g().add(g));
                f.addClass("highcharts-" + d + " highcharts-series-" + this.index + " highcharts-" + this.type + "-series " + (e(this.colorIndex) ? "highcharts-color-" + this.colorIndex + " " : "") + (this.options.className || "") + (f.hasClass("highcharts-tracker") ?
                    " highcharts-tracker" : ""), !0);
                f.attr(c)[m ? "attr" : "animate"](this.getPlotBox());
                return f
            };
            b.prototype.getPlotBox = function() {
                var a = this.chart,
                    d = this.xAxis,
                    e = this.yAxis;
                a.inverted && (d = e, e = this.xAxis);
                return {
                    translateX: d ? d.left : a.plotLeft,
                    translateY: e ? e.top : a.plotTop,
                    scaleX: 1,
                    scaleY: 1
                }
            };
            b.prototype.removeEvents = function(a) {
                a || F(this);
                this.eventsToUnbind.length && (this.eventsToUnbind.forEach(function(a) {
                    a()
                }), this.eventsToUnbind.length = 0)
            };
            b.prototype.render = function() {
                var a = this,
                    d = a.chart,
                    e = a.options,
                    c = h(e.animation),
                    b = !a.finishedAnimating && d.renderer.isSVG && c.duration,
                    g = a.visible ? "inherit" : "hidden",
                    f = e.zIndex,
                    m = a.hasRendered,
                    k = d.seriesGroup,
                    n = d.inverted;
                E(this, "render");
                var p = a.plotGroup("group", "series", g, f, k);
                a.markerGroup = a.plotGroup("markerGroup", "markers", g, f, k);
                b && a.animate && a.animate(!0);
                p.inverted = O(a.invertible, a.isCartesian) ? n : !1;
                a.drawGraph && (a.drawGraph(), a.applyZones());
                a.visible && a.drawPoints();
                a.drawDataLabels && a.drawDataLabels();
                a.redrawPoints && a.redrawPoints();
                a.drawTracker &&
                    !1 !== a.options.enableMouseTracking && a.drawTracker();
                a.invertGroups(n);
                !1 === e.clip || a.sharedClipKey || m || p.clip(d.clipRect);
                b && a.animate && a.animate();
                m || (b && c.defer && (b += c.defer), a.animationTimeout = aa(function() {
                    a.afterAnimate()
                }, b || 0));
                a.isDirty = !1;
                a.hasRendered = !0;
                E(a, "afterRender")
            };
            b.prototype.redraw = function() {
                var a = this.chart,
                    d = this.isDirty || this.isDirtyData,
                    e = this.group,
                    c = this.xAxis,
                    b = this.yAxis;
                e && (a.inverted && e.attr({
                    width: a.plotWidth,
                    height: a.plotHeight
                }), e.animate({
                    translateX: O(c && c.left,
                        a.plotLeft),
                    translateY: O(b && b.top, a.plotTop)
                }));
                this.translate();
                this.render();
                d && delete this.kdTree
            };
            b.prototype.searchPoint = function(a, d) {
                var e = this.xAxis,
                    c = this.yAxis,
                    b = this.chart.inverted;
                return this.searchKDTree({
                    clientX: b ? e.len - a.chartY + e.pos : a.chartX - e.pos,
                    plotY: b ? c.len - a.chartX + c.pos : a.chartY - c.pos
                }, d, a)
            };
            b.prototype.buildKDTree = function(a) {
                function d(a, c, b) {
                    var g;
                    if (g = a && a.length) {
                        var f = e.kdAxisArray[c % b];
                        a.sort(function(a, d) {
                            return a[f] - d[f]
                        });
                        g = Math.floor(g / 2);
                        return {
                            point: a[g],
                            left: d(a.slice(0,
                                g), c + 1, b),
                            right: d(a.slice(g + 1), c + 1, b)
                        }
                    }
                }
                this.buildingKdTree = !0;
                var e = this,
                    c = -1 < e.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                delete e.kdTree;
                aa(function() {
                    e.kdTree = d(e.getValidPoints(null, !e.directTouch), c, c);
                    e.buildingKdTree = !1
                }, e.options.kdNow || a && "touchstart" === a.type ? 0 : 1)
            };
            b.prototype.searchKDTree = function(a, d, c) {
                function b(a, d, c, h) {
                    var n = d.point,
                        p = g.kdAxisArray[c % h],
                        u = n;
                    var r = e(a[f]) && e(n[f]) ? Math.pow(a[f] - n[f], 2) : null;
                    var l = e(a[m]) && e(n[m]) ? Math.pow(a[m] - n[m], 2) : null;
                    l = (r || 0) + (l || 0);
                    n.dist =
                        e(l) ? Math.sqrt(l) : Number.MAX_VALUE;
                    n.distX = e(r) ? Math.sqrt(r) : Number.MAX_VALUE;
                    p = a[p] - n[p];
                    l = 0 > p ? "left" : "right";
                    r = 0 > p ? "right" : "left";
                    d[l] && (l = b(a, d[l], c + 1, h), u = l[k] < u[k] ? l : n);
                    d[r] && Math.sqrt(p * p) < u[k] && (a = b(a, d[r], c + 1, h), u = a[k] < u[k] ? a : u);
                    return u
                }
                var g = this,
                    f = this.kdAxisArray[0],
                    m = this.kdAxisArray[1],
                    k = d ? "distX" : "dist";
                d = -1 < g.options.findNearestPointBy.indexOf("y") ? 2 : 1;
                this.kdTree || this.buildingKdTree || this.buildKDTree(c);
                if (this.kdTree) return b(a, this.kdTree, d, d)
            };
            b.prototype.pointPlacementToXValue =
                function() {
                    var a = this.options,
                        d = a.pointRange,
                        e = this.xAxis;
                    a = a.pointPlacement;
                    "between" === a && (a = e.reversed ? -.5 : .5);
                    return R(a) ? a * (d || e.pointRange) : 0
                };
            b.prototype.isPointInside = function(a) {
                return "undefined" !== typeof a.plotY && "undefined" !== typeof a.plotX && 0 <= a.plotY && a.plotY <= this.yAxis.len && 0 <= a.plotX && a.plotX <= this.xAxis.len
            };
            b.prototype.drawTracker = function() {
                var a = this,
                    d = a.options,
                    e = d.trackByArea,
                    c = [].concat(e ? a.areaPath : a.graphPath),
                    b = a.chart,
                    g = b.pointer,
                    f = b.renderer,
                    m = b.options.tooltip.snap,
                    h =
                    a.tracker,
                    n = function(d) {
                        if (b.hoverSeries !== a) a.onMouseOver()
                    },
                    u = "rgba(192,192,192," + (k ? .0001 : .002) + ")";
                h ? h.attr({
                    d: c
                }) : a.graph && (a.tracker = f.path(c).attr({
                    visibility: a.visible ? "visible" : "hidden",
                    zIndex: 2
                }).addClass(e ? "highcharts-tracker-area" : "highcharts-tracker-line").add(a.group), b.styledMode || a.tracker.attr({
                    "stroke-linecap": "round",
                    "stroke-linejoin": "round",
                    stroke: u,
                    fill: e ? u : "none",
                    "stroke-width": a.graph.strokeWidth() + (e ? 0 : 2 * m)
                }), [a.tracker, a.markerGroup].forEach(function(a) {
                    a.addClass("highcharts-tracker").on("mouseover",
                        n).on("mouseout", function(a) {
                        g.onTrackerMouseOut(a)
                    });
                    d.cursor && !b.styledMode && a.css({
                        cursor: d.cursor
                    });
                    if (p) a.on("touchstart", n)
                }));
                E(this, "afterDrawTracker")
            };
            b.prototype.addPoint = function(a, d, e, c, b) {
                var g = this.options,
                    f = this.data,
                    m = this.chart,
                    k = this.xAxis;
                k = k && k.hasNames && k.names;
                var h = g.data,
                    n = this.xData,
                    p;
                d = O(d, !0);
                var u = {
                    series: this
                };
                this.pointClass.prototype.applyOptions.apply(u, [a]);
                var r = u.x;
                var l = n.length;
                if (this.requireSorting && r < n[l - 1])
                    for (p = !0; l && n[l - 1] > r;) l--;
                this.updateParallelArrays(u,
                    "splice", l, 0, 0);
                this.updateParallelArrays(u, l);
                k && u.name && (k[r] = u.name);
                h.splice(l, 0, a);
                p && (this.data.splice(l, 0, null), this.processData());
                "point" === g.legendType && this.generatePoints();
                e && (f[0] && f[0].remove ? f[0].remove(!1) : (f.shift(), this.updateParallelArrays(u, "shift"), h.shift()));
                !1 !== b && E(this, "addPoint", {
                    point: u
                });
                this.isDirtyData = this.isDirty = !0;
                d && m.redraw(c)
            };
            b.prototype.removePoint = function(a, d, e) {
                var b = this,
                    g = b.data,
                    f = g[a],
                    m = b.points,
                    k = b.chart,
                    h = function() {
                        m && m.length === g.length && m.splice(a,
                            1);
                        g.splice(a, 1);
                        b.options.data.splice(a, 1);
                        b.updateParallelArrays(f || {
                            series: b
                        }, "splice", a, 1);
                        f && f.destroy();
                        b.isDirty = !0;
                        b.isDirtyData = !0;
                        d && k.redraw()
                    };
                c(e, k);
                d = O(d, !0);
                f ? f.firePointEvent("remove", null, h) : h()
            };
            b.prototype.remove = function(a, d, e, c) {
                function b() {
                    g.destroy(c);
                    f.isDirtyLegend = f.isDirtyBox = !0;
                    f.linkSeries();
                    O(a, !0) && f.redraw(d)
                }
                var g = this,
                    f = g.chart;
                !1 !== e ? E(g, "remove", null, b) : b()
            };
            b.prototype.update = function(e, c) {
                e = n(e, this.userOptions);
                E(this, "update", {
                    options: e
                });
                var b = this,
                    g = b.chart,
                    f = b.userOptions,
                    m = b.initialType || b.type,
                    k = g.options.plotOptions,
                    h = e.type || f.type || g.options.chart.type,
                    p = !(this.hasDerivedData || h && h !== this.type || "undefined" !== typeof e.pointStart || "undefined" !== typeof e.pointInterval || b.hasOptionChanged("dataGrouping") || b.hasOptionChanged("pointStart") || b.hasOptionChanged("pointInterval") || b.hasOptionChanged("pointIntervalUnit") || b.hasOptionChanged("keys")),
                    u = w[m].prototype,
                    r, l = ["eventOptions", "navigatorSeries", "baseSeries"],
                    q = b.finishedAnimating && {
                        animation: !1
                    },
                    x = {};
                p && (l.push("data", "isDirtyData", "points", "processedXData", "processedYData", "xIncrement", "cropped", "_hasPointMarkers", "_hasPointLabels", "nodes", "layout", "mapMap", "mapData", "minY", "maxY", "minX", "maxX"), !1 !== e.visible && l.push("area", "graph"), b.parallelArrays.forEach(function(a) {
                    l.push(a + "Data")
                }), e.data && (e.dataSorting && a(b.options.dataSorting, e.dataSorting), this.setData(e.data, !1)));
                e = T(f, q, {
                    index: "undefined" === typeof f.index ? b.index : f.index,
                    pointStart: O(k && k.series && k.series.pointStart, f.pointStart,
                        b.xData[0])
                }, !p && {
                    data: b.options.data
                }, e);
                p && e.data && (e.data = b.options.data);
                l = ["group", "markerGroup", "dataLabelsGroup", "transformGroup"].concat(l);
                l.forEach(function(a) {
                    l[a] = b[a];
                    delete b[a]
                });
                if (w[h || m]) {
                    if (f = h !== b.type, b.remove(!1, !1, !1, !0), f)
                        if (Object.setPrototypeOf) Object.setPrototypeOf(b, w[h || m].prototype);
                        else {
                            f = Object.hasOwnProperty.call(b, "hcEvents") && b.hcEvents;
                            for (r in u) b[r] = void 0;
                            a(b, w[h || m].prototype);
                            f ? b.hcEvents = f : delete b.hcEvents
                        }
                } else d(17, !0, g, {
                    missingModuleFor: h || m
                });
                l.forEach(function(a) {
                    b[a] =
                        l[a]
                });
                b.init(g, e);
                if (p && this.points) {
                    var A = b.options;
                    !1 === A.visible ? (x.graphic = 1, x.dataLabel = 1) : b._hasPointLabels || (e = A.marker, h = A.dataLabels, e && (!1 === e.enabled || "symbol" in e) && (x.graphic = 1), h && !1 === h.enabled && (x.dataLabel = 1));
                    this.points.forEach(function(a) {
                        a && a.series && (a.resolveColor(), Object.keys(x).length && a.destroyElements(x), !1 === A.showInLegend && a.legendItem && g.legend.destroyItem(a))
                    }, this)
                }
                b.initialType = m;
                g.linkSeries();
                E(this, "afterUpdate");
                O(c, !0) && g.redraw(p ? void 0 : !1)
            };
            b.prototype.setName =
                function(a) {
                    this.name = this.options.name = this.userOptions.name = a;
                    this.chart.isDirtyLegend = !0
                };
            b.prototype.hasOptionChanged = function(a) {
                var d = this.options[a],
                    e = this.chart.options.plotOptions,
                    c = this.userOptions[a];
                return c ? d !== c : d !== O(e && e[this.type] && e[this.type][a], e && e.series && e.series[a], d)
            };
            b.prototype.onMouseOver = function() {
                var a = this.chart,
                    d = a.hoverSeries;
                a.pointer.setHoverChartIndex();
                if (d && d !== this) d.onMouseOut();
                this.options.events.mouseOver && E(this, "mouseOver");
                this.setState("hover");
                a.hoverSeries =
                    this
            };
            b.prototype.onMouseOut = function() {
                var a = this.options,
                    d = this.chart,
                    e = d.tooltip,
                    c = d.hoverPoint;
                d.hoverSeries = null;
                if (c) c.onMouseOut();
                this && a.events.mouseOut && E(this, "mouseOut");
                !e || this.stickyTracking || e.shared && !this.noSharedTooltip || e.hide();
                d.series.forEach(function(a) {
                    a.setState("", !0)
                })
            };
            b.prototype.setState = function(a, d) {
                var e = this,
                    c = e.options,
                    b = e.graph,
                    g = c.inactiveOtherPoints,
                    f = c.states,
                    m = c.lineWidth,
                    k = c.opacity,
                    h = O(f[a || "normal"] && f[a || "normal"].animation, e.chart.options.chart.animation);
                c = 0;
                a = a || "";
                if (e.state !== a && ([e.group, e.markerGroup, e.dataLabelsGroup].forEach(function(d) {
                        d && (e.state && d.removeClass("highcharts-series-" + e.state), a && d.addClass("highcharts-series-" + a))
                    }), e.state = a, !e.chart.styledMode)) {
                    if (f[a] && !1 === f[a].enabled) return;
                    a && (m = f[a].lineWidth || m + (f[a].lineWidthPlus || 0), k = O(f[a].opacity, k));
                    if (b && !b.dashstyle)
                        for (f = {
                                "stroke-width": m
                            }, b.animate(f, h); e["zone-graph-" + c];) e["zone-graph-" + c].animate(f, h), c += 1;
                    g || [e.group, e.markerGroup, e.dataLabelsGroup, e.labelBySeries].forEach(function(a) {
                        a &&
                            a.animate({
                                opacity: k
                            }, h)
                    })
                }
                d && g && e.points && e.setAllPointsToState(a || void 0)
            };
            b.prototype.setAllPointsToState = function(a) {
                this.points.forEach(function(d) {
                    d.setState && d.setState(a)
                })
            };
            b.prototype.setVisible = function(a, d) {
                var e = this,
                    c = e.chart,
                    b = e.legendItem,
                    g = c.options.chart.ignoreHiddenSeries,
                    f = e.visible;
                var m = (e.visible = a = e.options.visible = e.userOptions.visible = "undefined" === typeof a ? !f : a) ? "show" : "hide";
                ["group", "dataLabelsGroup", "markerGroup", "tracker", "tt"].forEach(function(a) {
                    if (e[a]) e[a][m]()
                });
                if (c.hoverSeries === e || (c.hoverPoint && c.hoverPoint.series) === e) e.onMouseOut();
                b && c.legend.colorizeItem(e, a);
                e.isDirty = !0;
                e.options.stacking && c.series.forEach(function(a) {
                    a.options.stacking && a.visible && (a.isDirty = !0)
                });
                e.linkedSeries.forEach(function(d) {
                    d.setVisible(a, !1)
                });
                g && (c.isDirtyBox = !0);
                E(e, m);
                !1 !== d && c.redraw()
            };
            b.prototype.show = function() {
                this.setVisible(!0)
            };
            b.prototype.hide = function() {
                this.setVisible(!1)
            };
            b.prototype.select = function(a) {
                this.selected = a = this.options.selected = "undefined" ===
                    typeof a ? !this.selected : a;
                this.checkbox && (this.checkbox.checked = a);
                E(this, a ? "select" : "unselect")
            };
            b.defaultOptions = {
                lineWidth: 2,
                allowPointSelect: !1,
                crisp: !0,
                showCheckbox: !1,
                animation: {
                    duration: 1E3
                },
                events: {},
                marker: {
                    enabledThreshold: 2,
                    lineColor: z.backgroundColor,
                    lineWidth: 0,
                    radius: 4,
                    states: {
                        normal: {
                            animation: !0
                        },
                        hover: {
                            animation: {
                                duration: 50
                            },
                            enabled: !0,
                            radiusPlus: 2,
                            lineWidthPlus: 1
                        },
                        select: {
                            fillColor: z.neutralColor20,
                            lineColor: z.neutralColor100,
                            lineWidth: 2
                        }
                    }
                },
                point: {
                    events: {}
                },
                dataLabels: {
                    animation: {},
                    align: "center",
                    defer: !0,
                    formatter: function() {
                        var a = this.series.chart.numberFormatter;
                        return "number" !== typeof this.y ? "" : a(this.y, -1)
                    },
                    padding: 5,
                    style: {
                        fontSize: "11px",
                        fontWeight: "bold",
                        color: "contrast",
                        textOutline: "1px contrast"
                    },
                    verticalAlign: "bottom",
                    x: 0,
                    y: 0
                },
                cropThreshold: 300,
                opacity: 1,
                pointRange: 0,
                softThreshold: !0,
                states: {
                    normal: {
                        animation: !0
                    },
                    hover: {
                        animation: {
                            duration: 50
                        },
                        lineWidthPlus: 1,
                        marker: {},
                        halo: {
                            size: 10,
                            opacity: .25
                        }
                    },
                    select: {
                        animation: {
                            duration: 0
                        }
                    },
                    inactive: {
                        animation: {
                            duration: 50
                        },
                        opacity: .2
                    }
                },
                stickyTracking: !0,
                turboThreshold: 1E3,
                findNearestPointBy: "x"
            };
            return b
        }();
        a(b.prototype, {
            axisTypes: ["xAxis", "yAxis"],
            coll: "series",
            colorCounter: 0,
            cropShoulder: 1,
            directTouch: !1,
            drawLegendSymbol: B.drawLineMarker,
            isCartesian: !0,
            kdAxisArray: ["clientX", "plotY"],
            parallelArrays: ["x", "y"],
            pointClass: C,
            requireSorting: !0,
            sorted: !0
        });
        v.series = b;
        "";
        "";
        return b
    });
    J(b, "Extensions/ScrollablePlotArea.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Axis/Axis.js"], b["Core/Chart/Chart.js"], b["Core/Series/Series.js"],
        b["Core/Globals.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C) {
        var v = b.stop,
            t = C.addEvent,
            q = C.createElement,
            h = C.merge,
            c = C.pick;
        "";
        t(B, "afterSetChartSize", function(c) {
            var b = this.options.chart.scrollablePlotArea,
                p = b && b.minWidth;
            b = b && b.minHeight;
            if (!this.renderer.forExport) {
                if (p) {
                    if (this.scrollablePixelsX = p = Math.max(0, p - this.chartWidth)) {
                        this.scrollablePlotBox = h(this.plotBox);
                        this.plotWidth += p;
                        this.inverted ? (this.clipBox.height += p, this.plotBox.height += p) : (this.clipBox.width += p, this.plotBox.width +=
                            p);
                        var f = {
                            1: {
                                name: "right",
                                value: p
                            }
                        }
                    }
                } else b && (this.scrollablePixelsY = p = Math.max(0, b - this.chartHeight)) && (this.scrollablePlotBox = h(this.plotBox), this.plotHeight += p, this.inverted ? (this.clipBox.width += p, this.plotBox.width += p) : (this.clipBox.height += p, this.plotBox.height += p), f = {
                    2: {
                        name: "bottom",
                        value: p
                    }
                });
                f && !c.skipAxes && this.axes.forEach(function(c) {
                    f[c.side] ? c.getPlotLinePath = function() {
                        var b = f[c.side].name,
                            k = this[b];
                        this[b] = k - f[c.side].value;
                        var h = z.Axis.prototype.getPlotLinePath.apply(this, arguments);
                        this[b] = k;
                        return h
                    } : (c.setAxisSize(), c.setAxisTranslation())
                })
            }
        });
        t(B, "render", function() {
            this.scrollablePixelsX || this.scrollablePixelsY ? (this.setUpScrolling && this.setUpScrolling(), this.applyFixed()) : this.fixedDiv && this.applyFixed()
        });
        B.prototype.setUpScrolling = function() {
            var c = this,
                b = {
                    WebkitOverflowScrolling: "touch",
                    overflowX: "hidden",
                    overflowY: "hidden"
                };
            this.scrollablePixelsX && (b.overflowX = "auto");
            this.scrollablePixelsY && (b.overflowY = "auto");
            this.scrollingParent = q("div", {
                className: "highcharts-scrolling-parent"
            }, {
                position: "relative"
            }, this.renderTo);
            this.scrollingContainer = q("div", {
                className: "highcharts-scrolling"
            }, b, this.scrollingParent);
            t(this.scrollingContainer, "scroll", function() {
                c.pointer && delete c.pointer.chartPosition
            });
            this.innerContainer = q("div", {
                className: "highcharts-inner-container"
            }, null, this.scrollingContainer);
            this.innerContainer.appendChild(this.container);
            this.setUpScrolling = null
        };
        B.prototype.moveFixedElements = function() {
            var c = this.container,
                b = this.fixedRenderer,
                h = ".highcharts-contextbutton .highcharts-credits .highcharts-legend .highcharts-legend-checkbox .highcharts-navigator-series .highcharts-navigator-xaxis .highcharts-navigator-yaxis .highcharts-navigator .highcharts-reset-zoom .highcharts-scrollbar .highcharts-subtitle .highcharts-title".split(" "),
                f;
            this.scrollablePixelsX && !this.inverted ? f = ".highcharts-yaxis" : this.scrollablePixelsX && this.inverted ? f = ".highcharts-xaxis" : this.scrollablePixelsY && !this.inverted ? f = ".highcharts-xaxis" : this.scrollablePixelsY && this.inverted && (f = ".highcharts-yaxis");
            f && h.push(f + ":not(.highcharts-radial-axis)", f + "-labels:not(.highcharts-radial-axis-labels)");
            h.forEach(function(f) {
                [].forEach.call(c.querySelectorAll(f), function(c) {
                    (c.namespaceURI === b.SVG_NS ? b.box : b.box.parentNode).appendChild(c);
                    c.style.pointerEvents = "auto"
                })
            })
        };
        B.prototype.applyFixed = function() {
            var b = this,
                k, h, f, w = !this.fixedDiv,
                x = this.options.chart,
                C = x.scrollablePlotArea;
            w ? (this.fixedDiv = q("div", {
                className: "highcharts-fixed"
            }, {
                position: "absolute",
                overflow: "hidden",
                pointerEvents: "none",
                zIndex: ((null === (k = x.style) || void 0 === k ? void 0 : k.zIndex) || 0) + 2,
                top: 0
            }, null, !0), null === (h = this.scrollingContainer) || void 0 === h ? void 0 : h.parentNode.insertBefore(this.fixedDiv, this.scrollingContainer), this.renderTo.style.overflow = "visible", this.fixedRenderer = k = new z.Renderer(this.fixedDiv,
                this.chartWidth, this.chartHeight, null === (f = this.options.chart) || void 0 === f ? void 0 : f.style), this.scrollableMask = k.path().attr({
                fill: this.options.chart.backgroundColor || "#fff",
                "fill-opacity": c(C.opacity, .85),
                zIndex: -1
            }).addClass("highcharts-scrollable-mask").add(), t(this, "afterShowResetZoom", this.moveFixedElements), t(this, "afterLayOutTitles", this.moveFixedElements), t(l, "afterInit", function() {
                b.scrollableDirty = !0
            }), t(y, "show", function() {
                b.scrollableDirty = !0
            })) : this.fixedRenderer.setSize(this.chartWidth,
                this.chartHeight);
            if (this.scrollableDirty || w) this.scrollableDirty = !1, this.moveFixedElements();
            f = this.chartWidth + (this.scrollablePixelsX || 0);
            k = this.chartHeight + (this.scrollablePixelsY || 0);
            v(this.container);
            this.container.style.width = f + "px";
            this.container.style.height = k + "px";
            this.renderer.boxWrapper.attr({
                width: f,
                height: k,
                viewBox: [0, 0, f, k].join(" ")
            });
            this.chartBackground.attr({
                width: f,
                height: k
            });
            this.scrollingContainer.style.height = this.chartHeight + "px";
            w && (C.scrollPositionX && (this.scrollingContainer.scrollLeft =
                this.scrollablePixelsX * C.scrollPositionX), C.scrollPositionY && (this.scrollingContainer.scrollTop = this.scrollablePixelsY * C.scrollPositionY));
            k = this.axisOffset;
            w = this.plotTop - k[0] - 1;
            C = this.plotLeft - k[3] - 1;
            f = this.plotTop + this.plotHeight + k[2] + 1;
            k = this.plotLeft + this.plotWidth + k[1] + 1;
            h = this.plotLeft + this.plotWidth - (this.scrollablePixelsX || 0);
            x = this.plotTop + this.plotHeight - (this.scrollablePixelsY || 0);
            w = this.scrollablePixelsX ? [
                ["M", 0, w],
                ["L", this.plotLeft - 1, w],
                ["L", this.plotLeft - 1, f],
                ["L", 0, f],
                ["Z"],
                ["M",
                    h, w
                ],
                ["L", this.chartWidth, w],
                ["L", this.chartWidth, f],
                ["L", h, f],
                ["Z"]
            ] : this.scrollablePixelsY ? [
                ["M", C, 0],
                ["L", C, this.plotTop - 1],
                ["L", k, this.plotTop - 1],
                ["L", k, 0],
                ["Z"],
                ["M", C, x],
                ["L", C, this.chartHeight],
                ["L", k, this.chartHeight],
                ["L", k, x],
                ["Z"]
            ] : [
                ["M", 0, 0]
            ];
            "adjustHeight" !== this.redrawTrigger && this.scrollableMask.attr({
                d: w
            })
        }
    });
    J(b, "Core/Axis/StackingAxis.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = b.getDeferredAnimation,
            y = l.addEvent,
            z = l.destroyObjectProperties,
            C = l.fireEvent,
            v = l.objectEach,
            t = l.pick,
            q = function() {
                function b(c) {
                    this.oldStacks = {};
                    this.stacks = {};
                    this.stacksTouched = 0;
                    this.axis = c
                }
                b.prototype.buildStacks = function() {
                    var c = this.axis,
                        b = c.series,
                        k = t(c.options.reversedStacks, !0),
                        h = b.length,
                        f;
                    if (!c.isXAxis) {
                        this.usePercentage = !1;
                        for (f = h; f--;) {
                            var l = b[k ? f : h - f - 1];
                            l.setStackedPoints();
                            l.setGroupedPoints()
                        }
                        for (f = 0; f < h; f++) b[f].modifyStacks();
                        C(c, "afterBuildStacks")
                    }
                };
                b.prototype.cleanStacks = function() {
                    if (!this.axis.isXAxis) {
                        if (this.oldStacks) var c = this.stacks =
                            this.oldStacks;
                        v(c, function(c) {
                            v(c, function(c) {
                                c.cumulative = c.total
                            })
                        })
                    }
                };
                b.prototype.resetStacks = function() {
                    var c = this,
                        b = c.stacks;
                    c.axis.isXAxis || v(b, function(b) {
                        v(b, function(k, f) {
                            k.touched < c.stacksTouched ? (k.destroy(), delete b[f]) : (k.total = null, k.cumulative = null)
                        })
                    })
                };
                b.prototype.renderStackTotals = function() {
                    var c = this.axis,
                        b = c.chart,
                        k = b.renderer,
                        h = this.stacks;
                    c = w(b, c.options.stackLabels.animation);
                    var f = this.stackTotalGroup = this.stackTotalGroup || k.g("stack-labels").attr({
                        visibility: "visible",
                        zIndex: 6,
                        opacity: 0
                    }).add();
                    f.translate(b.plotLeft, b.plotTop);
                    v(h, function(c) {
                        v(c, function(c) {
                            c.render(f)
                        })
                    });
                    f.animate({
                        opacity: 1
                    }, c)
                };
                return b
            }();
        return function() {
            function b() {}
            b.compose = function(c) {
                y(c, "init", b.onInit);
                y(c, "destroy", b.onDestroy)
            };
            b.onDestroy = function() {
                var c = this.stacking;
                if (c) {
                    var b = c.stacks;
                    v(b, function(c, h) {
                        z(c);
                        b[h] = null
                    });
                    c && c.stackTotalGroup && c.stackTotalGroup.destroy()
                }
            };
            b.onInit = function() {
                this.stacking || (this.stacking = new q(this))
            };
            return b
        }()
    });
    J(b, "Extensions/Stacking.js", [b["Core/Axis/Axis.js"],
        b["Core/Chart/Chart.js"], b["Core/Globals.js"], b["Core/Series/Series.js"], b["Core/Axis/StackingAxis.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C) {
        var v = C.correctFloat,
            t = C.defined,
            q = C.destroyObjectProperties,
            h = C.format,
            c = C.isArray,
            p = C.isNumber,
            k = C.pick;
        "";
        var w = function() {
            function c(c, b, f, k, h) {
                var n = c.chart.inverted;
                this.axis = c;
                this.isNegative = f;
                this.options = b = b || {};
                this.x = k;
                this.total = null;
                this.points = {};
                this.hasValidPoints = !1;
                this.stack = h;
                this.rightCliff = this.leftCliff = 0;
                this.alignOptions = {
                    align: b.align ||
                        (n ? f ? "left" : "right" : "center"),
                    verticalAlign: b.verticalAlign || (n ? "middle" : f ? "bottom" : "top"),
                    y: b.y,
                    x: b.x
                };
                this.textAlign = b.textAlign || (n ? f ? "right" : "left" : "center")
            }
            c.prototype.destroy = function() {
                q(this, this.axis)
            };
            c.prototype.render = function(c) {
                var b = this.axis.chart,
                    f = this.options,
                    p = f.format;
                p = p ? h(p, this, b) : f.formatter.call(this);
                this.label ? this.label.attr({
                    text: p,
                    visibility: "hidden"
                }) : (this.label = b.renderer.label(p, null, null, f.shape, null, null, f.useHTML, !1, "stack-labels"), p = {
                    r: f.borderRadius || 0,
                    text: p,
                    rotation: f.rotation,
                    padding: k(f.padding, 5),
                    visibility: "hidden"
                }, b.styledMode || (p.fill = f.backgroundColor, p.stroke = f.borderColor, p["stroke-width"] = f.borderWidth, this.label.css(f.style)), this.label.attr(p), this.label.added || this.label.add(c));
                this.label.labelrank = b.plotSizeY
            };
            c.prototype.setOffset = function(c, b, f, h, r) {
                var n = this.axis,
                    u = n.chart;
                h = n.translate(n.stacking.usePercentage ? 100 : h ? h : this.total, 0, 0, 0, 1);
                f = n.translate(f ? f : 0);
                f = t(h) && Math.abs(h - f);
                c = k(r, u.xAxis[0].translate(this.x)) + c;
                n = t(h) && this.getStackBox(u,
                    this, c, h, b, f, n);
                b = this.label;
                f = this.isNegative;
                c = "justify" === k(this.options.overflow, "justify");
                var e = this.textAlign;
                b && n && (r = b.getBBox(), h = b.padding, e = "left" === e ? u.inverted ? -h : h : "right" === e ? r.width : u.inverted && "center" === e ? r.width / 2 : u.inverted ? f ? r.width + h : -h : r.width / 2, f = u.inverted ? r.height / 2 : f ? -h : r.height, this.alignOptions.x = k(this.options.x, 0), this.alignOptions.y = k(this.options.y, 0), n.x -= e, n.y -= f, b.align(this.alignOptions, null, n), u.isInsidePlot(b.alignAttr.x + e - this.alignOptions.x, b.alignAttr.y +
                    f - this.alignOptions.y) ? b.show() : (b.alignAttr.y = -9999, c = !1), c && y.prototype.justifyDataLabel.call(this.axis, b, this.alignOptions, b.alignAttr, r, n), b.attr({
                    x: b.alignAttr.x,
                    y: b.alignAttr.y
                }), k(!c && this.options.crop, !0) && ((u = p(b.x) && p(b.y) && u.isInsidePlot(b.x - h + b.width, b.y) && u.isInsidePlot(b.x + h, b.y)) || b.hide()))
            };
            c.prototype.getStackBox = function(c, b, f, k, h, n, p) {
                var e = b.axis.reversed,
                    g = c.inverted,
                    d = p.height + p.pos - (g ? c.plotLeft : c.plotTop);
                b = b.isNegative && !e || !b.isNegative && e;
                return {
                    x: g ? b ? k - p.right : k - n + p.pos -
                        c.plotLeft : f + c.xAxis[0].transB - c.plotLeft,
                    y: g ? p.height - f - h : b ? d - k - n : d - k,
                    width: g ? n : h,
                    height: g ? h : n
                }
            };
            return c
        }();
        l.prototype.getStacks = function() {
            var c = this,
                b = c.inverted;
            c.yAxis.forEach(function(c) {
                c.stacking && c.stacking.stacks && c.hasVisibleSeries && (c.stacking.oldStacks = c.stacking.stacks)
            });
            c.series.forEach(function(f) {
                var h = f.xAxis && f.xAxis.options || {};
                !f.options.stacking || !0 !== f.visible && !1 !== c.options.chart.ignoreHiddenSeries || (f.stackKey = [f.type, k(f.options.stack, ""), b ? h.top : h.left, b ? h.height : h.width].join())
            })
        };
        z.compose(b);
        y.prototype.setGroupedPoints = function() {
            this.options.centerInCategory && (this.is("column") || this.is("columnrange")) && !this.options.stacking && 1 < this.chart.series.length && y.prototype.setStackedPoints.call(this, "group")
        };
        y.prototype.setStackedPoints = function(b) {
            var f = b || this.options.stacking;
            if (f && (!0 === this.visible || !1 === this.chart.options.chart.ignoreHiddenSeries)) {
                var h = this.processedXData,
                    p = this.processedYData,
                    l = [],
                    r = p.length,
                    n = this.options,
                    u = n.threshold,
                    e = k(n.startFromThreshold && u, 0);
                n = n.stack;
                b = b ? this.type + "," + f : this.stackKey;
                var g = "-" + b,
                    d = this.negStacks,
                    a = this.yAxis,
                    m = a.stacking.stacks,
                    q = a.stacking.oldStacks,
                    I, A;
                a.stacking.stacksTouched += 1;
                for (A = 0; A < r; A++) {
                    var G = h[A];
                    var z = p[A];
                    var C = this.getStackIndicator(C, G, this.index);
                    var B = C.key;
                    var y = (I = d && z < (e ? 0 : u)) ? g : b;
                    m[y] || (m[y] = {});
                    m[y][G] || (q[y] && q[y][G] ? (m[y][G] = q[y][G], m[y][G].total = null) : m[y][G] = new w(a, a.options.stackLabels, I, G, n));
                    y = m[y][G];
                    null !== z ? (y.points[B] = y.points[this.index] = [k(y.cumulative, e)], t(y.cumulative) || (y.base =
                        B), y.touched = a.stacking.stacksTouched, 0 < C.index && !1 === this.singleStacks && (y.points[B][0] = y.points[this.index + "," + G + ",0"][0])) : y.points[B] = y.points[this.index] = null;
                    "percent" === f ? (I = I ? b : g, d && m[I] && m[I][G] ? (I = m[I][G], y.total = I.total = Math.max(I.total, y.total) + Math.abs(z) || 0) : y.total = v(y.total + (Math.abs(z) || 0))) : "group" === f ? (c(z) && (z = z[0]), null !== z && (y.total = (y.total || 0) + 1)) : y.total = v(y.total + (z || 0));
                    y.cumulative = "group" === f ? (y.total || 1) - 1 : k(y.cumulative, e) + (z || 0);
                    null !== z && (y.points[B].push(y.cumulative),
                        l[A] = y.cumulative, y.hasValidPoints = !0)
                }
                "percent" === f && (a.stacking.usePercentage = !0);
                "group" !== f && (this.stackedYData = l);
                a.stacking.oldStacks = {}
            }
        };
        y.prototype.modifyStacks = function() {
            var c = this,
                b = c.stackKey,
                k = c.yAxis.stacking.stacks,
                h = c.processedXData,
                p, l = c.options.stacking;
            c[l + "Stacker"] && [b, "-" + b].forEach(function(b) {
                for (var f = h.length, e, g; f--;)
                    if (e = h[f], p = c.getStackIndicator(p, e, c.index, b), g = (e = k[b] && k[b][e]) && e.points[p.key]) c[l + "Stacker"](g, e, f)
            })
        };
        y.prototype.percentStacker = function(c, b, k) {
            b =
                b.total ? 100 / b.total : 0;
            c[0] = v(c[0] * b);
            c[1] = v(c[1] * b);
            this.stackedYData[k] = c[1]
        };
        y.prototype.getStackIndicator = function(c, b, k, h) {
            !t(c) || c.x !== b || h && c.key !== h ? c = {
                x: b,
                index: 0,
                key: h
            } : c.index++;
            c.key = [k, b, c.index].join();
            return c
        };
        B.StackItem = w;
        return B.StackItem
    });
    J(b, "Series/Line/LineSeries.js", [b["Core/Color/Palette.js"], b["Core/Series/Series.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B, y) {
        var w = this && this.__extends || function() {
                var b = function(l, h) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(c, b) {
                        c.__proto__ = b
                    } || function(c, b) {
                        for (var k in b) b.hasOwnProperty(k) && (c[k] = b[k])
                    };
                    return b(l, h)
                };
                return function(l, h) {
                    function c() {
                        this.constructor = l
                    }
                    b(l, h);
                    l.prototype = null === h ? Object.create(h) : (c.prototype = h.prototype, new c)
                }
            }(),
            C = y.defined,
            v = y.merge;
        y = function(t) {
            function q() {
                var b = null !== t && t.apply(this, arguments) || this;
                b.data = void 0;
                b.options = void 0;
                b.points = void 0;
                return b
            }
            w(q, t);
            q.prototype.drawGraph = function() {
                var h = this,
                    c = this.options,
                    p = (this.gappedPath ||
                        this.getGraphPath).call(this),
                    k = this.chart.styledMode,
                    l = [
                        ["graph", "highcharts-graph"]
                    ];
                k || l[0].push(c.lineColor || this.color || b.neutralColor20, c.dashStyle);
                l = h.getZonesGraphs(l);
                l.forEach(function(b, l) {
                    var f = b[0],
                        q = h[f],
                        t = q ? "animate" : "attr";
                    q ? (q.endX = h.preventGraphAnimation ? null : p.xMap, q.animate({
                        d: p
                    })) : p.length && (h[f] = q = h.chart.renderer.path(p).addClass(b[1]).attr({
                        zIndex: 1
                    }).add(h.group));
                    q && !k && (f = {
                            stroke: b[2],
                            "stroke-width": c.lineWidth,
                            fill: h.fillGraph && h.color || "none"
                        }, b[3] ? f.dashstyle = b[3] : "square" !==
                        c.linecap && (f["stroke-linecap"] = f["stroke-linejoin"] = "round"), q[t](f).shadow(2 > l && c.shadow));
                    q && (q.startX = p.xMap, q.isArea = p.isArea)
                })
            };
            q.prototype.getGraphPath = function(b, c, p) {
                var k = this,
                    h = k.options,
                    f = h.step,
                    l, q = [],
                    t = [],
                    v;
                b = b || k.points;
                (l = b.reversed) && b.reverse();
                (f = {
                    right: 1,
                    center: 2
                } [f] || f && 3) && l && (f = 4 - f);
                b = this.getValidPoints(b, !1, !(h.connectNulls && !c && !p));
                b.forEach(function(l, n) {
                    var u = l.plotX,
                        e = l.plotY,
                        g = b[n - 1];
                    (l.leftCliff || g && g.rightCliff) && !p && (v = !0);
                    l.isNull && !C(c) && 0 < n ? v = !h.connectNulls :
                        l.isNull && !c ? v = !0 : (0 === n || v ? n = [
                            ["M", l.plotX, l.plotY]
                        ] : k.getPointSpline ? n = [k.getPointSpline(b, l, n)] : f ? (n = 1 === f ? [
                            ["L", g.plotX, e]
                        ] : 2 === f ? [
                            ["L", (g.plotX + u) / 2, g.plotY],
                            ["L", (g.plotX + u) / 2, e]
                        ] : [
                            ["L", u, g.plotY]
                        ], n.push(["L", u, e])) : n = [
                            ["L", u, e]
                        ], t.push(l.x), f && (t.push(l.x), 2 === f && t.push(l.x)), q.push.apply(q, n), v = !1)
                });
                q.xMap = t;
                return k.graphPath = q
            };
            q.prototype.getZonesGraphs = function(b) {
                this.zones.forEach(function(c, h) {
                    h = ["zone-graph-" + h, "highcharts-graph highcharts-zone-graph-" + h + " " + (c.className || "")];
                    this.chart.styledMode ||
                        h.push(c.color || this.color, c.dashStyle || this.options.dashStyle);
                    b.push(h)
                }, this);
                return b
            };
            q.defaultOptions = v(l.defaultOptions, {});
            return q
        }(l);
        B.registerSeriesType("line", y);
        "";
        return y
    });
    J(b, "Series/Area/AreaSeries.js", [b["Core/Color/Color.js"], b["Mixins/LegendSymbol.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B, y) {
        var w = this && this.__extends || function() {
                var c = function(b, k) {
                    c = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(c, b) {
                        c.__proto__ = b
                    } || function(c,
                        b) {
                        for (var f in b) b.hasOwnProperty(f) && (c[f] = b[f])
                    };
                    return c(b, k)
                };
                return function(b, k) {
                    function h() {
                        this.constructor = b
                    }
                    c(b, k);
                    b.prototype = null === k ? Object.create(k) : (h.prototype = k.prototype, new h)
                }
            }(),
            C = b.parse,
            v = B.seriesTypes.line;
        b = y.extend;
        var t = y.merge,
            q = y.objectEach,
            h = y.pick;
        y = function(c) {
            function b() {
                var b = null !== c && c.apply(this, arguments) || this;
                b.data = void 0;
                b.options = void 0;
                b.points = void 0;
                return b
            }
            w(b, c);
            b.prototype.drawGraph = function() {
                this.areaPath = [];
                c.prototype.drawGraph.apply(this);
                var b = this,
                    p = this.areaPath,
                    f = this.options,
                    l = [
                        ["area", "highcharts-area", this.color, f.fillColor]
                    ];
                this.zones.forEach(function(c, k) {
                    l.push(["zone-area-" + k, "highcharts-area highcharts-zone-area-" + k + " " + c.className, c.color || b.color, c.fillColor || f.fillColor])
                });
                l.forEach(function(c) {
                    var k = c[0],
                        l = b[k],
                        r = l ? "animate" : "attr",
                        n = {};
                    l ? (l.endX = b.preventGraphAnimation ? null : p.xMap, l.animate({
                        d: p
                    })) : (n.zIndex = 0, l = b[k] = b.chart.renderer.path(p).addClass(c[1]).add(b.group), l.isArea = !0);
                    b.chart.styledMode || (n.fill = h(c[3],
                        C(c[2]).setOpacity(h(f.fillOpacity, .75)).get()));
                    l[r](n);
                    l.startX = p.xMap;
                    l.shiftUnit = f.step ? 2 : 1
                })
            };
            b.prototype.getGraphPath = function(c) {
                var b = v.prototype.getGraphPath,
                    f = this.options,
                    k = f.stacking,
                    p = this.yAxis,
                    l, q = [],
                    r = [],
                    n = this.index,
                    u = p.stacking.stacks[this.stackKey],
                    e = f.threshold,
                    g = Math.round(p.getThreshold(f.threshold));
                f = h(f.connectNulls, "percent" === k);
                var d = function(a, d, b) {
                    var f = c[a];
                    a = k && u[f.x].points[n];
                    var h = f[b + "Null"] || 0;
                    b = f[b + "Cliff"] || 0;
                    f = !0;
                    if (b || h) {
                        var l = (h ? a[0] : a[1]) + b;
                        var A = a[0] + b;
                        f = !!h
                    } else !k && c[d] && c[d].isNull && (l = A = e);
                    "undefined" !== typeof l && (r.push({
                        plotX: m,
                        plotY: null === l ? g : p.getThreshold(l),
                        isNull: f,
                        isCliff: !0
                    }), q.push({
                        plotX: m,
                        plotY: null === A ? g : p.getThreshold(A),
                        doCurve: !1
                    }))
                };
                c = c || this.points;
                k && (c = this.getStackPoints(c));
                for (l = 0; l < c.length; l++) {
                    k || (c[l].leftCliff = c[l].rightCliff = c[l].leftNull = c[l].rightNull = void 0);
                    var a = c[l].isNull;
                    var m = h(c[l].rectPlotX, c[l].plotX);
                    var t = k ? h(c[l].yBottom, g) : g;
                    if (!a || f) f || d(l, l - 1, "left"), a && !k && f || (r.push(c[l]), q.push({
                        x: l,
                        plotX: m,
                        plotY: t
                    })), f || d(l, l + 1, "right")
                }
                l = b.call(this, r, !0, !0);
                q.reversed = !0;
                a = b.call(this, q, !0, !0);
                (t = a[0]) && "M" === t[0] && (a[0] = ["L", t[1], t[2]]);
                a = l.concat(a);
                b = b.call(this, r, !1, f);
                a.xMap = l.xMap;
                this.areaPath = a;
                return b
            };
            b.prototype.getStackPoints = function(c) {
                var b = [],
                    f = [],
                    k = this.xAxis,
                    p = this.yAxis,
                    l = p.stacking.stacks[this.stackKey],
                    t = {},
                    r = this.index,
                    n = p.series,
                    u = n.length,
                    e = h(p.options.reversedStacks, !0) ? 1 : -1,
                    g;
                c = c || this.points;
                if (this.options.stacking) {
                    for (g = 0; g < c.length; g++) c[g].leftNull = c[g].rightNull =
                        void 0, t[c[g].x] = c[g];
                    q(l, function(a, d) {
                        null !== a.total && f.push(d)
                    });
                    f.sort(function(a, d) {
                        return a - d
                    });
                    var d = n.map(function(a) {
                        return a.visible
                    });
                    f.forEach(function(a, c) {
                        var m = 0,
                            h, n;
                        if (t[a] && !t[a].isNull) b.push(t[a]), [-1, 1].forEach(function(b) {
                            var m = 1 === b ? "rightNull" : "leftNull",
                                k = 0,
                                p = l[f[c + b]];
                            if (p)
                                for (g = r; 0 <= g && g < u;) h = p.points[g], h || (g === r ? t[a][m] = !0 : d[g] && (n = l[a].points[g]) && (k -= n[1] - n[0])), g += e;
                            t[a][1 === b ? "rightCliff" : "leftCliff"] = k
                        });
                        else {
                            for (g = r; 0 <= g && g < u;) {
                                if (h = l[a].points[g]) {
                                    m = h[1];
                                    break
                                }
                                g +=
                                    e
                            }
                            m = p.translate(m, 0, 1, 0, 1);
                            b.push({
                                isNull: !0,
                                plotX: k.translate(a, 0, 0, 0, 1),
                                x: a,
                                plotY: m,
                                yBottom: m
                            })
                        }
                    })
                }
                return b
            };
            b.defaultOptions = t(v.defaultOptions, {
                threshold: 0
            });
            return b
        }(v);
        b(y.prototype, {
            singleStacks: !1,
            drawLegendSymbol: l.drawRectangle
        });
        B.registerSeriesType("area", y);
        "";
        return y
    });
    J(b, "Series/Spline/SplineSeries.js", [b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = this && this.__extends || function() {
                var b = function(l, q) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof
                    Array && function(b, c) {
                        b.__proto__ = c
                    } || function(b, c) {
                        for (var h in c) c.hasOwnProperty(h) && (b[h] = c[h])
                    };
                    return b(l, q)
                };
                return function(l, q) {
                    function h() {
                        this.constructor = l
                    }
                    b(l, q);
                    l.prototype = null === q ? Object.create(q) : (h.prototype = q.prototype, new h)
                }
            }(),
            y = b.seriesTypes.line,
            z = l.merge,
            C = l.pick;
        l = function(b) {
            function l() {
                var l = null !== b && b.apply(this, arguments) || this;
                l.data = void 0;
                l.options = void 0;
                l.points = void 0;
                return l
            }
            w(l, b);
            l.prototype.getPointSpline = function(b, h, c) {
                var l = h.plotX || 0,
                    k = h.plotY || 0,
                    q = b[c -
                        1];
                c = b[c + 1];
                if (q && !q.isNull && !1 !== q.doCurve && !h.isCliff && c && !c.isNull && !1 !== c.doCurve && !h.isCliff) {
                    b = q.plotY || 0;
                    var f = c.plotX || 0;
                    c = c.plotY || 0;
                    var t = 0;
                    var x = (1.5 * l + (q.plotX || 0)) / 2.5;
                    var v = (1.5 * k + b) / 2.5;
                    f = (1.5 * l + f) / 2.5;
                    var w = (1.5 * k + c) / 2.5;
                    f !== x && (t = (w - v) * (f - l) / (f - x) + k - w);
                    v += t;
                    w += t;
                    v > b && v > k ? (v = Math.max(b, k), w = 2 * k - v) : v < b && v < k && (v = Math.min(b, k), w = 2 * k - v);
                    w > c && w > k ? (w = Math.max(c, k), v = 2 * k - w) : w < c && w < k && (w = Math.min(c, k), v = 2 * k - w);
                    h.rightContX = f;
                    h.rightContY = w
                }
                h = ["C", C(q.rightContX, q.plotX, 0), C(q.rightContY, q.plotY,
                    0), C(x, l, 0), C(v, k, 0), l, k];
                q.rightContX = q.rightContY = void 0;
                return h
            };
            l.defaultOptions = z(y.defaultOptions);
            return l
        }(y);
        b.registerSeriesType("spline", l);
        "";
        return l
    });
    J(b, "Series/AreaSpline/AreaSplineSeries.js", [b["Series/Area/AreaSeries.js"], b["Series/Spline/SplineSeries.js"], b["Mixins/LegendSymbol.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B, y, z) {
        var w = this && this.__extends || function() {
                var b = function(c, h) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(c,
                        b) {
                        c.__proto__ = b
                    } || function(c, b) {
                        for (var f in b) b.hasOwnProperty(f) && (c[f] = b[f])
                    };
                    return b(c, h)
                };
                return function(c, h) {
                    function k() {
                        this.constructor = c
                    }
                    b(c, h);
                    c.prototype = null === h ? Object.create(h) : (k.prototype = h.prototype, new k)
                }
            }(),
            v = b.prototype,
            t = z.extend,
            q = z.merge;
        z = function(h) {
            function c() {
                var c = null !== h && h.apply(this, arguments) || this;
                c.data = void 0;
                c.points = void 0;
                c.options = void 0;
                return c
            }
            w(c, h);
            c.defaultOptions = q(l.defaultOptions, b.defaultOptions);
            return c
        }(l);
        t(z.prototype, {
            getGraphPath: v.getGraphPath,
            getStackPoints: v.getStackPoints,
            drawGraph: v.drawGraph,
            drawLegendSymbol: B.drawRectangle
        });
        y.registerSeriesType("areaspline", z);
        "";
        return z
    });
    J(b, "Series/Column/ColumnSeries.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Color/Color.js"], b["Core/Globals.js"], b["Mixins/LegendSymbol.js"], b["Core/Color/Palette.js"], b["Core/Series/Series.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B, y, z, C, v, t) {
        var q = this && this.__extends || function() {
                var e = function(c, d) {
                    e = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(a, d) {
                        a.__proto__ = d
                    } || function(a, d) {
                        for (var e in d) d.hasOwnProperty(e) && (a[e] = d[e])
                    };
                    return e(c, d)
                };
                return function(c, d) {
                    function a() {
                        this.constructor = c
                    }
                    e(c, d);
                    c.prototype = null === d ? Object.create(d) : (a.prototype = d.prototype, new a)
                }
            }(),
            h = b.animObject,
            c = l.parse,
            p = B.hasTouch;
        b = B.noop;
        var k = t.clamp,
            w = t.css,
            f = t.defined,
            H = t.extend,
            x = t.fireEvent,
            K = t.isArray,
            L = t.isNumber,
            r = t.merge,
            n = t.pick,
            u = t.objectEach;
        t = function(e) {
            function b() {
                var d = null !== e && e.apply(this, arguments) ||
                    this;
                d.borderWidth = void 0;
                d.data = void 0;
                d.group = void 0;
                d.options = void 0;
                d.points = void 0;
                return d
            }
            q(b, e);
            b.prototype.animate = function(d) {
                var a = this,
                    e = this.yAxis,
                    c = a.options,
                    b = this.chart.inverted,
                    g = {},
                    f = b ? "translateX" : "translateY";
                if (d) g.scaleY = .001, d = k(e.toPixels(c.threshold), e.pos, e.pos + e.len), b ? g.translateX = d - e.len : g.translateY = d, a.clipBox && a.setClip(), a.group.attr(g);
                else {
                    var n = a.group.attr(f);
                    a.group.animate({
                        scaleY: 1
                    }, H(h(a.options.animation), {
                        step: function(d, c) {
                            a.group && (g[f] = n + c.pos * (e.pos -
                                n), a.group.attr(g))
                        }
                    }))
                }
            };
            b.prototype.init = function(d, a) {
                e.prototype.init.apply(this, arguments);
                var c = this;
                d = c.chart;
                d.hasRendered && d.series.forEach(function(a) {
                    a.type === c.type && (a.isDirty = !0)
                })
            };
            b.prototype.getColumnMetrics = function() {
                var d = this,
                    a = d.options,
                    e = d.xAxis,
                    c = d.yAxis,
                    b = e.options.reversedStacks;
                b = e.reversed && !b || !e.reversed && b;
                var g, f = {},
                    k = 0;
                !1 === a.grouping ? k = 1 : d.chart.series.forEach(function(a) {
                    var e = a.yAxis,
                        b = a.options;
                    if (a.type === d.type && (a.visible || !d.chart.options.chart.ignoreHiddenSeries) &&
                        c.len === e.len && c.pos === e.pos) {
                        if (b.stacking && "group" !== b.stacking) {
                            g = a.stackKey;
                            "undefined" === typeof f[g] && (f[g] = k++);
                            var m = f[g]
                        } else !1 !== b.grouping && (m = k++);
                        a.columnIndex = m
                    }
                });
                var h = Math.min(Math.abs(e.transA) * (e.ordinal && e.ordinal.slope || a.pointRange || e.closestPointRange || e.tickInterval || 1), e.len),
                    l = h * a.groupPadding,
                    p = (h - 2 * l) / (k || 1);
                a = Math.min(a.maxPointWidth || e.len, n(a.pointWidth, p * (1 - 2 * a.pointPadding)));
                d.columnMetrics = {
                    width: a,
                    offset: (p - a) / 2 + (l + ((d.columnIndex || 0) + (b ? 1 : 0)) * p - h / 2) * (b ? -1 : 1),
                    paddedWidth: p,
                    columnCount: k
                };
                return d.columnMetrics
            };
            b.prototype.crispCol = function(d, a, e, c) {
                var b = this.chart,
                    g = this.borderWidth,
                    f = -(g % 2 ? .5 : 0);
                g = g % 2 ? .5 : 1;
                b.inverted && b.renderer.isVML && (g += 1);
                this.options.crisp && (e = Math.round(d + e) + f, d = Math.round(d) + f, e -= d);
                c = Math.round(a + c) + g;
                f = .5 >= Math.abs(a) && .5 < c;
                a = Math.round(a) + g;
                c -= a;
                f && c && (--a, c += 1);
                return {
                    x: d,
                    y: a,
                    width: e,
                    height: c
                }
            };
            b.prototype.adjustForMissingColumns = function(d, a, e, c) {
                var b = this,
                    g = this.options.stacking;
                if (!e.isNull && 1 < c.columnCount) {
                    var f = 0,
                        m = 0;
                    u(this.yAxis.stacking &&
                        this.yAxis.stacking.stacks,
                        function(a) {
                            if ("number" === typeof e.x && (a = a[e.x.toString()])) {
                                var d = a.points[b.index],
                                    c = a.total;
                                g ? (d && (f = m), a.hasValidPoints && m++) : K(d) && (f = d[1], m = c || 0)
                            }
                        });
                    d = (e.plotX || 0) + ((m - 1) * c.paddedWidth + a) / 2 - a - f * c.paddedWidth
                }
                return d
            };
            b.prototype.translate = function() {
                var d = this,
                    a = d.chart,
                    e = d.options,
                    c = d.dense = 2 > d.closestPointRange * d.xAxis.transA;
                c = d.borderWidth = n(e.borderWidth, c ? 0 : 1);
                var b = d.xAxis,
                    g = d.yAxis,
                    h = e.threshold,
                    l = d.translatedThreshold = g.getThreshold(h),
                    p = n(e.minPointLength,
                        5),
                    u = d.getColumnMetrics(),
                    r = u.width,
                    q = d.barW = Math.max(r, 1 + 2 * c),
                    t = d.pointXOffset = u.offset,
                    v = d.dataMin,
                    x = d.dataMax;
                a.inverted && (l -= .5);
                e.pointPadding && (q = Math.ceil(q));
                C.prototype.translate.apply(d);
                d.points.forEach(function(c) {
                    var m = n(c.yBottom, l),
                        A = 999 + Math.abs(m),
                        E = r,
                        w = c.plotX || 0;
                    A = k(c.plotY, -A, g.len + A);
                    var I = w + t,
                        z = q,
                        G = Math.min(A, m),
                        C = Math.max(A, m) - G;
                    if (p && Math.abs(C) < p) {
                        C = p;
                        var y = !g.reversed && !c.negative || g.reversed && c.negative;
                        L(h) && L(x) && c.y === h && x <= h && (g.min || 0) < h && (v !== x || (g.max || 0) <= h) && (y = !y);
                        G = Math.abs(G - l) > p ? m - p : l - (y ? p : 0)
                    }
                    f(c.options.pointWidth) && (E = z = Math.ceil(c.options.pointWidth), I -= Math.round((E - r) / 2));
                    e.centerInCategory && (I = d.adjustForMissingColumns(I, E, c, u));
                    c.barX = I;
                    c.pointWidth = E;
                    c.tooltipPos = a.inverted ? [k(g.len + g.pos - a.plotLeft - A, g.pos - a.plotLeft, g.len + g.pos - a.plotLeft), b.len + b.pos - a.plotTop - (w || 0) - t - z / 2, C] : [b.left - a.plotLeft + I + z / 2, k(A + g.pos - a.plotTop, g.pos - a.plotTop, g.len + g.pos - a.plotTop), C];
                    c.shapeType = d.pointClass.prototype.shapeType || "rect";
                    c.shapeArgs = d.crispCol.apply(d,
                        c.isNull ? [I, l, z, 0] : [I, G, z, C])
                })
            };
            b.prototype.drawGraph = function() {
                this.group[this.dense ? "addClass" : "removeClass"]("highcharts-dense-data")
            };
            b.prototype.pointAttribs = function(d, a) {
                var e = this.options,
                    b = this.pointAttrToOptions || {};
                var g = b.stroke || "borderColor";
                var f = b["stroke-width"] || "borderWidth",
                    k = d && d.color || this.color,
                    h = d && d[g] || e[g] || this.color || k,
                    l = d && d[f] || e[f] || this[f] || 0;
                b = d && d.options.dashStyle || e.dashStyle;
                var p = n(d && d.opacity, e.opacity, 1);
                if (d && this.zones.length) {
                    var u = d.getZone();
                    k = d.options.color ||
                        u && (u.color || d.nonZonedColor) || this.color;
                    u && (h = u.borderColor || h, b = u.dashStyle || b, l = u.borderWidth || l)
                }
                a && d && (d = r(e.states[a], d.options.states && d.options.states[a] || {}), a = d.brightness, k = d.color || "undefined" !== typeof a && c(k).brighten(d.brightness).get() || k, h = d[g] || h, l = d[f] || l, b = d.dashStyle || b, p = n(d.opacity, p));
                g = {
                    fill: k,
                    stroke: h,
                    "stroke-width": l,
                    opacity: p
                };
                b && (g.dashstyle = b);
                return g
            };
            b.prototype.drawPoints = function() {
                var d = this,
                    a = this.chart,
                    e = d.options,
                    c = a.renderer,
                    b = e.animationLimit || 250,
                    g;
                d.points.forEach(function(f) {
                    var k =
                        f.graphic,
                        m = !!k,
                        h = k && a.pointCount < b ? "animate" : "attr";
                    if (L(f.plotY) && null !== f.y) {
                        g = f.shapeArgs;
                        k && f.hasNewShapeType() && (k = k.destroy());
                        d.enabledDataSorting && (f.startXPos = d.xAxis.reversed ? -(g ? g.width : 0) : d.xAxis.width);
                        k || (f.graphic = k = c[f.shapeType](g).add(f.group || d.group)) && d.enabledDataSorting && a.hasRendered && a.pointCount < b && (k.attr({
                            x: f.startXPos
                        }), m = !0, h = "animate");
                        if (k && m) k[h](r(g));
                        if (e.borderRadius) k[h]({
                            r: e.borderRadius
                        });
                        a.styledMode || k[h](d.pointAttribs(f, f.selected && "select")).shadow(!1 !==
                            f.allowShadow && e.shadow, null, e.stacking && !e.borderRadius);
                        k && (k.addClass(f.getClassName(), !0), k.attr({
                            visibility: f.visible ? "inherit" : "hidden"
                        }))
                    } else k && (f.graphic = k.destroy())
                })
            };
            b.prototype.drawTracker = function() {
                var d = this,
                    a = d.chart,
                    e = a.pointer,
                    c = function(a) {
                        var d = e.getPointFromEvent(a);
                        "undefined" !== typeof d && (e.isDirectTouch = !0, d.onMouseOver(a))
                    },
                    b;
                d.points.forEach(function(a) {
                    b = K(a.dataLabels) ? a.dataLabels : a.dataLabel ? [a.dataLabel] : [];
                    a.graphic && (a.graphic.element.point = a);
                    b.forEach(function(d) {
                        d.div ?
                            d.div.point = a : d.element.point = a
                    })
                });
                d._hasTracking || (d.trackerGroups.forEach(function(b) {
                    if (d[b]) {
                        d[b].addClass("highcharts-tracker").on("mouseover", c).on("mouseout", function(a) {
                            e.onTrackerMouseOut(a)
                        });
                        if (p) d[b].on("touchstart", c);
                        !a.styledMode && d.options.cursor && d[b].css(w).css({
                            cursor: d.options.cursor
                        })
                    }
                }), d._hasTracking = !0);
                x(this, "afterDrawTracker")
            };
            b.prototype.remove = function() {
                var d = this,
                    a = d.chart;
                a.hasRendered && a.series.forEach(function(a) {
                    a.type === d.type && (a.isDirty = !0)
                });
                C.prototype.remove.apply(d,
                    arguments)
            };
            b.defaultOptions = r(C.defaultOptions, {
                borderRadius: 0,
                centerInCategory: !1,
                groupPadding: .2,
                marker: null,
                pointPadding: .1,
                minPointLength: 0,
                cropThreshold: 50,
                pointRange: null,
                states: {
                    hover: {
                        halo: !1,
                        brightness: .1
                    },
                    select: {
                        color: z.neutralColor20,
                        borderColor: z.neutralColor100
                    }
                },
                dataLabels: {
                    align: void 0,
                    verticalAlign: void 0,
                    y: void 0
                },
                startFromThreshold: !0,
                stickyTracking: !1,
                tooltip: {
                    distance: 6
                },
                threshold: 0,
                borderColor: z.backgroundColor
            });
            return b
        }(C);
        H(t.prototype, {
            cropShoulder: 0,
            directTouch: !0,
            drawLegendSymbol: y.drawRectangle,
            getSymbol: b,
            negStacks: !0,
            trackerGroups: ["group", "dataLabelsGroup"]
        });
        v.registerSeriesType("column", t);
        "";
        "";
        return t
    });
    J(b, "Series/Bar/BarSeries.js", [b["Series/Column/ColumnSeries.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B) {
        var w = this && this.__extends || function() {
                var b = function(l, q) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, c) {
                        b.__proto__ = c
                    } || function(b, c) {
                        for (var h in c) c.hasOwnProperty(h) && (b[h] = c[h])
                    };
                    return b(l, q)
                };
                return function(l,
                    q) {
                    function h() {
                        this.constructor = l
                    }
                    b(l, q);
                    l.prototype = null === q ? Object.create(q) : (h.prototype = q.prototype, new h)
                }
            }(),
            z = B.extend,
            C = B.merge;
        B = function(l) {
            function t() {
                var b = null !== l && l.apply(this, arguments) || this;
                b.data = void 0;
                b.options = void 0;
                b.points = void 0;
                return b
            }
            w(t, l);
            t.defaultOptions = C(b.defaultOptions, {});
            return t
        }(b);
        z(B.prototype, {
            inverted: !0
        });
        l.registerSeriesType("bar", B);
        "";
        return B
    });
    J(b, "Series/Scatter/ScatterSeries.js", [b["Series/Column/ColumnSeries.js"], b["Series/Line/LineSeries.js"],
        b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y) {
        var w = this && this.__extends || function() {
                var b = function(h, c) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(c, b) {
                        c.__proto__ = b
                    } || function(c, b) {
                        for (var k in b) b.hasOwnProperty(k) && (c[k] = b[k])
                    };
                    return b(h, c)
                };
                return function(h, c) {
                    function l() {
                        this.constructor = h
                    }
                    b(h, c);
                    h.prototype = null === c ? Object.create(c) : (l.prototype = c.prototype, new l)
                }
            }(),
            C = y.addEvent,
            v = y.extend,
            t = y.merge;
        y = function(b) {
            function h() {
                var c =
                    null !== b && b.apply(this, arguments) || this;
                c.data = void 0;
                c.options = void 0;
                c.points = void 0;
                return c
            }
            w(h, b);
            h.prototype.applyJitter = function() {
                var c = this,
                    b = this.options.jitter,
                    k = this.points.length;
                b && this.points.forEach(function(h, f) {
                    ["x", "y"].forEach(function(l, p) {
                        var q = "plot" + l.toUpperCase();
                        if (b[l] && !h.isNull) {
                            var t = c[l + "Axis"];
                            var r = b[l] * t.transA;
                            if (t && !t.isLog) {
                                var n = Math.max(0, h[q] - r);
                                t = Math.min(t.len, h[q] + r);
                                p = 1E4 * Math.sin(f + p * k);
                                h[q] = n + (t - n) * (p - Math.floor(p));
                                "x" === l && (h.clientX = h.plotX)
                            }
                        }
                    })
                })
            };
            h.prototype.drawGraph = function() {
                (this.options.lineWidth || 0 === this.options.lineWidth && this.graph && this.graph.strokeWidth()) && b.prototype.drawGraph.call(this)
            };
            h.defaultOptions = t(l.defaultOptions, {
                lineWidth: 0,
                findNearestPointBy: "xy",
                jitter: {
                    x: 0,
                    y: 0
                },
                marker: {
                    enabled: !0
                },
                tooltip: {
                    headerFormat: '<span style="color:{point.color}">\u25cf</span> <span style="font-size: 10px"> {series.name}</span><br/>',
                    pointFormat: "x: <b>{point.x}</b><br/>y: <b>{point.y}</b><br/>"
                }
            });
            return h
        }(l);
        v(y.prototype, {
            drawTracker: b.prototype.drawTracker,
            sorted: !1,
            requireSorting: !1,
            noSharedTooltip: !0,
            trackerGroups: ["group", "markerGroup", "dataLabelsGroup"],
            takeOrdinalPosition: !1
        });
        C(y, "afterTranslate", function() {
            this.applyJitter()
        });
        B.registerSeriesType("scatter", y);
        "";
        return y
    });
    J(b, "Mixins/CenteredSeries.js", [b["Core/Globals.js"], b["Core/Series/Series.js"], b["Core/Utilities.js"]], function(b, l, B) {
        var w = B.isNumber,
            z = B.pick,
            C = B.relativeLength,
            v = b.deg2rad;
        return b.CenteredSeriesMixin = {
            getCenter: function() {
                var b = this.options,
                    q = this.chart,
                    h = 2 * (b.slicedOffset ||
                        0),
                    c = q.plotWidth - 2 * h,
                    p = q.plotHeight - 2 * h,
                    k = b.center,
                    v = Math.min(c, p),
                    f = b.size,
                    w = b.innerSize || 0;
                "string" === typeof f && (f = parseFloat(f));
                "string" === typeof w && (w = parseFloat(w));
                b = [z(k[0], "50%"), z(k[1], "50%"), z(f && 0 > f ? void 0 : b.size, "100%"), z(w && 0 > w ? void 0 : b.innerSize || 0, "0%")];
                !q.angular || this instanceof l || (b[3] = 0);
                for (k = 0; 4 > k; ++k) f = b[k], q = 2 > k || 2 === k && /%$/.test(f), b[k] = C(f, [c, p, v, b[2]][k]) + (q ? h : 0);
                b[3] > b[2] && (b[3] = b[2]);
                return b
            },
            getStartAndEndRadians: function(b, l) {
                b = w(b) ? b : 0;
                l = w(l) && l > b && 360 > l - b ? l : b + 360;
                return {
                    start: v * (b + -90),
                    end: v * (l + -90)
                }
            }
        }
    });
    J(b, "Series/Pie/PiePoint.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Series/Point.js"], b["Core/Utilities.js"]], function(b, l, B) {
        var w = this && this.__extends || function() {
                var c = function(b, k) {
                    c = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(c, b) {
                        c.__proto__ = b
                    } || function(c, b) {
                        for (var f in b) b.hasOwnProperty(f) && (c[f] = b[f])
                    };
                    return c(b, k)
                };
                return function(b, k) {
                    function h() {
                        this.constructor = b
                    }
                    c(b, k);
                    b.prototype = null === k ? Object.create(k) :
                        (h.prototype = k.prototype, new h)
                }
            }(),
            z = b.setAnimation,
            C = B.addEvent,
            v = B.defined;
        b = B.extend;
        var t = B.isNumber,
            q = B.pick,
            h = B.relativeLength;
        B = function(c) {
            function b() {
                var b = null !== c && c.apply(this, arguments) || this;
                b.labelDistance = void 0;
                b.options = void 0;
                b.series = void 0;
                return b
            }
            w(b, c);
            b.prototype.getConnectorPath = function() {
                var c = this.labelPosition,
                    b = this.series.options.dataLabels,
                    f = b.connectorShape,
                    h = this.connectorShapes;
                h[f] && (f = h[f]);
                return f.call(this, {
                        x: c.final.x,
                        y: c.final.y,
                        alignment: c.alignment
                    },
                    c.connectorPosition, b)
            };
            b.prototype.getTranslate = function() {
                return this.sliced ? this.slicedTranslation : {
                    translateX: 0,
                    translateY: 0
                }
            };
            b.prototype.haloPath = function(c) {
                var b = this.shapeArgs;
                return this.sliced || !this.visible ? [] : this.series.chart.renderer.symbols.arc(b.x, b.y, b.r + c, b.r + c, {
                    innerR: b.r - 1,
                    start: b.start,
                    end: b.end
                })
            };
            b.prototype.init = function() {
                l.prototype.init.apply(this, arguments);
                var c = this;
                c.name = q(c.name, "Slice");
                var b = function(b) {
                    c.slice("select" === b.type)
                };
                C(c, "select", b);
                C(c, "unselect",
                    b);
                return c
            };
            b.prototype.isValid = function() {
                return t(this.y) && 0 <= this.y
            };
            b.prototype.setVisible = function(c, b) {
                var f = this,
                    k = f.series,
                    h = k.chart,
                    l = k.options.ignoreHiddenPoint;
                b = q(b, l);
                c !== f.visible && (f.visible = f.options.visible = c = "undefined" === typeof c ? !f.visible : c, k.options.data[k.data.indexOf(f)] = f.options, ["graphic", "dataLabel", "connector", "shadowGroup"].forEach(function(b) {
                    if (f[b]) f[b][c ? "show" : "hide"](c)
                }), f.legendItem && h.legend.colorizeItem(f, c), c || "hover" !== f.state || f.setState(""), l && (k.isDirty = !0), b && h.redraw())
            };
            b.prototype.slice = function(c, b, f) {
                var k = this.series;
                z(f, k.chart);
                q(b, !0);
                this.sliced = this.options.sliced = v(c) ? c : !this.sliced;
                k.options.data[k.data.indexOf(this)] = this.options;
                this.graphic && this.graphic.animate(this.getTranslate());
                this.shadowGroup && this.shadowGroup.animate(this.getTranslate())
            };
            return b
        }(l);
        b(B.prototype, {
            connectorShapes: {
                fixedOffset: function(c, b, k) {
                    var h = b.breakAt;
                    b = b.touchingSliceAt;
                    return [
                        ["M", c.x, c.y], k.softConnector ? ["C", c.x + ("left" === c.alignment ? -5 : 5), c.y,
                            2 * h.x - b.x, 2 * h.y - b.y, h.x, h.y
                        ] : ["L", h.x, h.y],
                        ["L", b.x, b.y]
                    ]
                },
                straight: function(c, b) {
                    b = b.touchingSliceAt;
                    return [
                        ["M", c.x, c.y],
                        ["L", b.x, b.y]
                    ]
                },
                crookedLine: function(c, b, k) {
                    b = b.touchingSliceAt;
                    var l = this.series,
                        f = l.center[0],
                        p = l.chart.plotWidth,
                        q = l.chart.plotLeft;
                    l = c.alignment;
                    var t = this.shapeArgs.r;
                    k = h(k.crookDistance, 1);
                    p = "left" === l ? f + t + (p + q - f - t) * (1 - k) : q + (f - t) * k;
                    k = ["L", p, c.y];
                    f = !0;
                    if ("left" === l ? p > c.x || p < b.x : p < c.x || p > b.x) f = !1;
                    c = [
                        ["M", c.x, c.y]
                    ];
                    f && c.push(k);
                    c.push(["L", b.x, b.y]);
                    return c
                }
            }
        });
        return B
    });
    J(b, "Series/Pie/PieSeries.js", [b["Mixins/CenteredSeries.js"], b["Series/Column/ColumnSeries.js"], b["Core/Globals.js"], b["Mixins/LegendSymbol.js"], b["Core/Color/Palette.js"], b["Series/Pie/PiePoint.js"], b["Core/Series/Series.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Renderer/SVG/SVGRenderer.js"], b["Core/Utilities.js"]], function(b, l, B, y, z, C, v, t, q, h) {
        var c = this && this.__extends || function() {
                var c = function(b, f) {
                    c = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(c, e) {
                        c.__proto__ = e
                    } || function(c,
                        e) {
                        for (var b in e) e.hasOwnProperty(b) && (c[b] = e[b])
                    };
                    return c(b, f)
                };
                return function(b, f) {
                    function k() {
                        this.constructor = b
                    }
                    c(b, f);
                    b.prototype = null === f ? Object.create(f) : (k.prototype = f.prototype, new k)
                }
            }(),
            p = b.getStartAndEndRadians;
        B = B.noop;
        var k = h.clamp,
            w = h.extend,
            f = h.fireEvent,
            H = h.merge,
            x = h.pick,
            K = h.relativeLength;
        h = function(b) {
            function h() {
                var c = null !== b && b.apply(this, arguments) || this;
                c.center = void 0;
                c.data = void 0;
                c.maxLabelDistance = void 0;
                c.options = void 0;
                c.points = void 0;
                return c
            }
            c(h, b);
            h.prototype.animate =
                function(c) {
                    var b = this,
                        e = b.points,
                        g = b.startAngleRad;
                    c || e.forEach(function(d) {
                        var a = d.graphic,
                            e = d.shapeArgs;
                        a && e && (a.attr({
                            r: x(d.startR, b.center && b.center[3] / 2),
                            start: g,
                            end: g
                        }), a.animate({
                            r: e.r,
                            start: e.start,
                            end: e.end
                        }, b.options.animation))
                    })
                };
            h.prototype.drawEmpty = function() {
                var c = this.startAngleRad,
                    b = this.endAngleRad,
                    e = this.options;
                if (0 === this.total && this.center) {
                    var g = this.center[0];
                    var d = this.center[1];
                    this.graph || (this.graph = this.chart.renderer.arc(g, d, this.center[1] / 2, 0, c, b).addClass("highcharts-empty-series").add(this.group));
                    this.graph.attr({
                        d: q.prototype.symbols.arc(g, d, this.center[2] / 2, 0, {
                            start: c,
                            end: b,
                            innerR: this.center[3] / 2
                        })
                    });
                    this.chart.styledMode || this.graph.attr({
                        "stroke-width": e.borderWidth,
                        fill: e.fillColor || "none",
                        stroke: e.color || z.neutralColor20
                    })
                } else this.graph && (this.graph = this.graph.destroy())
            };
            h.prototype.drawPoints = function() {
                var c = this.chart.renderer;
                this.points.forEach(function(b) {
                    b.graphic && b.hasNewShapeType() && (b.graphic = b.graphic.destroy());
                    b.graphic || (b.graphic = c[b.shapeType](b.shapeArgs).add(b.series.group),
                        b.delayedRendering = !0)
                })
            };
            h.prototype.generatePoints = function() {
                b.prototype.generatePoints.call(this);
                this.updateTotals()
            };
            h.prototype.getX = function(c, b, e) {
                var g = this.center,
                    d = this.radii ? this.radii[e.index] || 0 : g[2] / 2;
                c = Math.asin(k((c - g[1]) / (d + e.labelDistance), -1, 1));
                return g[0] + (b ? -1 : 1) * Math.cos(c) * (d + e.labelDistance) + (0 < e.labelDistance ? (b ? -1 : 1) * this.options.dataLabels.padding : 0)
            };
            h.prototype.hasData = function() {
                return !!this.processedXData.length
            };
            h.prototype.redrawPoints = function() {
                var c = this,
                    b = c.chart,
                    e = b.renderer,
                    g, d, a, f, k = c.options.shadow;
                this.drawEmpty();
                !k || c.shadowGroup || b.styledMode || (c.shadowGroup = e.g("shadow").attr({
                    zIndex: -1
                }).add(c.group));
                c.points.forEach(function(h) {
                    var m = {};
                    d = h.graphic;
                    if (!h.isNull && d) {
                        f = h.shapeArgs;
                        g = h.getTranslate();
                        if (!b.styledMode) {
                            var n = h.shadowGroup;
                            k && !n && (n = h.shadowGroup = e.g("shadow").add(c.shadowGroup));
                            n && n.attr(g);
                            a = c.pointAttribs(h, h.selected && "select")
                        }
                        h.delayedRendering ? (d.setRadialReference(c.center).attr(f).attr(g), b.styledMode || d.attr(a).attr({
                            "stroke-linejoin": "round"
                        }).shadow(k,
                            n), h.delayedRendering = !1) : (d.setRadialReference(c.center), b.styledMode || H(!0, m, a), H(!0, m, f, g), d.animate(m));
                        d.attr({
                            visibility: h.visible ? "inherit" : "hidden"
                        });
                        d.addClass(h.getClassName(), !0)
                    } else d && (h.graphic = d.destroy())
                })
            };
            h.prototype.sortByAngle = function(c, b) {
                c.sort(function(e, c) {
                    return "undefined" !== typeof e.angle && (c.angle - e.angle) * b
                })
            };
            h.prototype.translate = function(c) {
                this.generatePoints();
                var b = 0,
                    e = this.options,
                    g = e.slicedOffset,
                    d = g + (e.borderWidth || 0),
                    a = p(e.startAngle, e.endAngle),
                    k = this.startAngleRad =
                    a.start;
                a = (this.endAngleRad = a.end) - k;
                var h = this.points,
                    n = e.dataLabels.distance;
                e = e.ignoreHiddenPoint;
                var l, r = h.length;
                c || (this.center = c = this.getCenter());
                for (l = 0; l < r; l++) {
                    var q = h[l];
                    var t = k + b * a;
                    !q.isValid() || e && !q.visible || (b += q.percentage / 100);
                    var v = k + b * a;
                    q.shapeType = "arc";
                    q.shapeArgs = {
                        x: c[0],
                        y: c[1],
                        r: c[2] / 2,
                        innerR: c[3] / 2,
                        start: Math.round(1E3 * t) / 1E3,
                        end: Math.round(1E3 * v) / 1E3
                    };
                    q.labelDistance = x(q.options.dataLabels && q.options.dataLabels.distance, n);
                    q.labelDistance = K(q.labelDistance, q.shapeArgs.r);
                    this.maxLabelDistance = Math.max(this.maxLabelDistance || 0, q.labelDistance);
                    v = (v + t) / 2;
                    v > 1.5 * Math.PI ? v -= 2 * Math.PI : v < -Math.PI / 2 && (v += 2 * Math.PI);
                    q.slicedTranslation = {
                        translateX: Math.round(Math.cos(v) * g),
                        translateY: Math.round(Math.sin(v) * g)
                    };
                    var w = Math.cos(v) * c[2] / 2;
                    var z = Math.sin(v) * c[2] / 2;
                    q.tooltipPos = [c[0] + .7 * w, c[1] + .7 * z];
                    q.half = v < -Math.PI / 2 || v > Math.PI / 2 ? 1 : 0;
                    q.angle = v;
                    t = Math.min(d, q.labelDistance / 5);
                    q.labelPosition = {
                        natural: {
                            x: c[0] + w + Math.cos(v) * q.labelDistance,
                            y: c[1] + z + Math.sin(v) * q.labelDistance
                        },
                        "final": {},
                        alignment: 0 > q.labelDistance ? "center" : q.half ? "right" : "left",
                        connectorPosition: {
                            breakAt: {
                                x: c[0] + w + Math.cos(v) * t,
                                y: c[1] + z + Math.sin(v) * t
                            },
                            touchingSliceAt: {
                                x: c[0] + w,
                                y: c[1] + z
                            }
                        }
                    }
                }
                f(this, "afterTranslate")
            };
            h.prototype.updateTotals = function() {
                var c, b = 0,
                    e = this.points,
                    g = e.length,
                    d = this.options.ignoreHiddenPoint;
                for (c = 0; c < g; c++) {
                    var a = e[c];
                    !a.isValid() || d && !a.visible || (b += a.y)
                }
                this.total = b;
                for (c = 0; c < g; c++) a = e[c], a.percentage = 0 < b && (a.visible || !d) ? a.y / b * 100 : 0, a.total = b
            };
            h.defaultOptions = H(v.defaultOptions, {
                center: [null,
                    null
                ],
                clip: !1,
                colorByPoint: !0,
                dataLabels: {
                    allowOverlap: !0,
                    connectorPadding: 5,
                    connectorShape: "fixedOffset",
                    crookDistance: "70%",
                    distance: 30,
                    enabled: !0,
                    formatter: function() {
                        return this.point.isNull ? void 0 : this.point.name
                    },
                    softConnector: !0,
                    x: 0
                },
                fillColor: void 0,
                ignoreHiddenPoint: !0,
                inactiveOtherPoints: !0,
                legendType: "point",
                marker: null,
                size: null,
                showInLegend: !1,
                slicedOffset: 10,
                stickyTracking: !1,
                tooltip: {
                    followPointer: !0
                },
                borderColor: z.backgroundColor,
                borderWidth: 1,
                lineWidth: void 0,
                states: {
                    hover: {
                        brightness: .1
                    }
                }
            });
            return h
        }(v);
        w(h.prototype, {
            axisTypes: [],
            directTouch: !0,
            drawGraph: null,
            drawLegendSymbol: y.drawRectangle,
            drawTracker: l.prototype.drawTracker,
            getCenter: b.getCenter,
            getSymbol: B,
            isCartesian: !1,
            noSharedTooltip: !0,
            pointAttribs: l.prototype.pointAttribs,
            pointClass: C,
            requireSorting: !1,
            searchPoint: B,
            trackerGroups: ["group", "dataLabelsGroup"]
        });
        t.registerSeriesType("pie", h);
        "";
        return h
    });
    J(b, "Core/Series/DataLabels.js", [b["Core/Animation/AnimationUtilities.js"], b["Core/Globals.js"], b["Core/Color/Palette.js"],
        b["Core/Series/Series.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C) {
        var v = b.getDeferredAnimation;
        b = l.noop;
        z = z.seriesTypes;
        var t = C.arrayMax,
            q = C.clamp,
            h = C.defined,
            c = C.extend,
            p = C.fireEvent,
            k = C.format,
            w = C.isArray,
            f = C.merge,
            H = C.objectEach,
            x = C.pick,
            K = C.relativeLength,
            L = C.splat,
            r = C.stableSort;
        "";
        l.distribute = function(c, b, e) {
            function g(a, d) {
                return a.target - d.target
            }
            var d, a = !0,
                f = c,
                k = [];
            var h = 0;
            var n = f.reducedLen || b;
            for (d = c.length; d--;) h += c[d].size;
            if (h > n) {
                r(c, function(a,
                    d) {
                    return (d.rank || 0) - (a.rank || 0)
                });
                for (h = d = 0; h <= n;) h += c[d].size, d++;
                k = c.splice(d - 1, c.length)
            }
            r(c, g);
            for (c = c.map(function(a) {
                    return {
                        size: a.size,
                        targets: [a.target],
                        align: x(a.align, .5)
                    }
                }); a;) {
                for (d = c.length; d--;) a = c[d], h = (Math.min.apply(0, a.targets) + Math.max.apply(0, a.targets)) / 2, a.pos = q(h - a.size * a.align, 0, b - a.size);
                d = c.length;
                for (a = !1; d--;) 0 < d && c[d - 1].pos + c[d - 1].size > c[d].pos && (c[d - 1].size += c[d].size, c[d - 1].targets = c[d - 1].targets.concat(c[d].targets), c[d - 1].align = .5, c[d - 1].pos + c[d - 1].size > b && (c[d - 1].pos =
                    b - c[d - 1].size), c.splice(d, 1), a = !0)
            }
            f.push.apply(f, k);
            d = 0;
            c.some(function(a) {
                var c = 0;
                if (a.targets.some(function() {
                        f[d].pos = a.pos + c;
                        if ("undefined" !== typeof e && Math.abs(f[d].pos - f[d].target) > e) return f.slice(0, d + 1).forEach(function(a) {
                            delete a.pos
                        }), f.reducedLen = (f.reducedLen || b) - .1 * b, f.reducedLen > .1 * b && l.distribute(f, b, e), !0;
                        c += f[d].size;
                        d++
                    })) return !0
            });
            r(f, g)
        };
        y.prototype.drawDataLabels = function() {
            function c(a, d) {
                var c = d.filter;
                return c ? (d = c.operator, a = a[c.property], c = c.value, ">" === d && a > c || "<" ===
                    d && a < c || ">=" === d && a >= c || "<=" === d && a <= c || "==" === d && a == c || "===" === d && a === c ? !0 : !1) : !0
            }

            function b(a, d) {
                var c = [],
                    e;
                if (w(a) && !w(d)) c = a.map(function(a) {
                    return f(a, d)
                });
                else if (w(d) && !w(a)) c = d.map(function(d) {
                    return f(a, d)
                });
                else if (w(a) || w(d))
                    for (e = Math.max(a.length, d.length); e--;) c[e] = f(a[e], d[e]);
                else c = f(a, d);
                return c
            }
            var e = this,
                g = e.chart,
                d = e.options,
                a = d.dataLabels,
                m = e.points,
                l, r = e.hasRendered || 0,
                q = a.animation;
            q = a.defer ? v(g, q, e) : {
                defer: 0,
                duration: 0
            };
            var t = g.renderer;
            a = b(b(g.options.plotOptions && g.options.plotOptions.series &&
                g.options.plotOptions.series.dataLabels, g.options.plotOptions && g.options.plotOptions[e.type] && g.options.plotOptions[e.type].dataLabels), a);
            p(this, "drawDataLabels");
            if (w(a) || a.enabled || e._hasPointLabels) {
                var z = e.plotGroup("dataLabelsGroup", "data-labels", r ? "inherit" : "hidden", a.zIndex || 6);
                z.attr({
                    opacity: +r
                });
                !r && (r = e.dataLabelsGroup) && (e.visible && z.show(!0), r[d.animation ? "animate" : "attr"]({
                    opacity: 1
                }, q));
                m.forEach(function(f) {
                    l = L(b(a, f.dlOptions || f.options && f.options.dataLabels));
                    l.forEach(function(a,
                        b) {
                        var m = a.enabled && (!f.isNull || f.dataLabelOnNull) && c(f, a),
                            n = f.dataLabels ? f.dataLabels[b] : f.dataLabel,
                            l = f.connectors ? f.connectors[b] : f.connector,
                            p = x(a.distance, f.labelDistance),
                            u = !n;
                        if (m) {
                            var r = f.getLabelConfig();
                            var q = x(a[f.formatPrefix + "Format"], a.format);
                            r = h(q) ? k(q, r, g) : (a[f.formatPrefix + "Formatter"] || a.formatter).call(r, a);
                            q = a.style;
                            var v = a.rotation;
                            g.styledMode || (q.color = x(a.color, q.color, e.color, B.neutralColor100), "contrast" === q.color ? (f.contrastColor = t.getContrast(f.color || e.color), q.color = !h(p) && a.inside || 0 > p || d.stacking ? f.contrastColor : B.neutralColor100) : delete f.contrastColor, d.cursor && (q.cursor = d.cursor));
                            var A = {
                                r: a.borderRadius || 0,
                                rotation: v,
                                padding: a.padding,
                                zIndex: 1
                            };
                            g.styledMode || (A.fill = a.backgroundColor, A.stroke = a.borderColor, A["stroke-width"] = a.borderWidth);
                            H(A, function(a, d) {
                                "undefined" === typeof a && delete A[d]
                            })
                        }!n || m && h(r) ? m && h(r) && (n ? A.text = r : (f.dataLabels = f.dataLabels || [], n = f.dataLabels[b] = v ? t.text(r, 0, -9999, a.useHTML).addClass("highcharts-data-label") : t.label(r, 0, -9999,
                            a.shape, null, null, a.useHTML, null, "data-label"), b || (f.dataLabel = n), n.addClass(" highcharts-data-label-color-" + f.colorIndex + " " + (a.className || "") + (a.useHTML ? " highcharts-tracker" : ""))), n.options = a, n.attr(A), g.styledMode || n.css(q).shadow(a.shadow), n.added || n.add(z), a.textPath && !a.useHTML && (n.setTextPath(f.getDataLabelPath && f.getDataLabelPath(n) || f.graphic, a.textPath), f.dataLabelPath && !a.textPath.enabled && (f.dataLabelPath = f.dataLabelPath.destroy())), e.alignDataLabel(f, n, a, null, u)) : (f.dataLabel = f.dataLabel &&
                            f.dataLabel.destroy(), f.dataLabels && (1 === f.dataLabels.length ? delete f.dataLabels : delete f.dataLabels[b]), b || delete f.dataLabel, l && (f.connector = f.connector.destroy(), f.connectors && (1 === f.connectors.length ? delete f.connectors : delete f.connectors[b])))
                    })
                })
            }
            p(this, "afterDrawDataLabels")
        };
        y.prototype.alignDataLabel = function(b, f, e, g, d) {
            var a = this,
                k = this.chart,
                h = this.isCartesian && k.inverted,
                n = this.enabledDataSorting,
                l = x(b.dlBox && b.dlBox.centerX, b.plotX, -9999),
                p = x(b.plotY, -9999),
                r = f.getBBox(),
                u = e.rotation,
                q = e.align,
                t = k.isInsidePlot(l, Math.round(p), h),
                v = "justify" === x(e.overflow, n ? "none" : "justify"),
                w = this.visible && !1 !== b.visible && (b.series.forceDL || n && !v || t || e.inside && g && k.isInsidePlot(l, h ? g.x + 1 : g.y + g.height - 1, h));
            var z = function(c) {
                n && a.xAxis && !v && a.setDataLabelStartPos(b, f, d, t, c)
            };
            if (w) {
                var C = k.renderer.fontMetrics(k.styledMode ? void 0 : e.style.fontSize, f).b;
                g = c({
                    x: h ? this.yAxis.len - p : l,
                    y: Math.round(h ? this.xAxis.len - l : p),
                    width: 0,
                    height: 0
                }, g);
                c(e, {
                    width: r.width,
                    height: r.height
                });
                u ? (v = !1, l = k.renderer.rotCorr(C,
                    u), l = {
                    x: g.x + (e.x || 0) + g.width / 2 + l.x,
                    y: g.y + (e.y || 0) + {
                        top: 0,
                        middle: .5,
                        bottom: 1
                    } [e.verticalAlign] * g.height
                }, z(l), f[d ? "attr" : "animate"](l).attr({
                    align: q
                }), z = (u + 720) % 360, z = 180 < z && 360 > z, "left" === q ? l.y -= z ? r.height : 0 : "center" === q ? (l.x -= r.width / 2, l.y -= r.height / 2) : "right" === q && (l.x -= r.width, l.y -= z ? 0 : r.height), f.placed = !0, f.alignAttr = l) : (z(g), f.align(e, null, g), l = f.alignAttr);
                v && 0 <= g.height ? this.justifyDataLabel(f, e, l, r, g, d) : x(e.crop, !0) && (w = k.isInsidePlot(l.x, l.y) && k.isInsidePlot(l.x + r.width, l.y + r.height));
                if (e.shape &&
                    !u) f[d ? "attr" : "animate"]({
                    anchorX: h ? k.plotWidth - b.plotY : b.plotX,
                    anchorY: h ? k.plotHeight - b.plotX : b.plotY
                })
            }
            d && n && (f.placed = !1);
            w || n && !v || (f.hide(!0), f.placed = !1)
        };
        y.prototype.setDataLabelStartPos = function(c, b, e, f, d) {
            var a = this.chart,
                g = a.inverted,
                k = this.xAxis,
                h = k.reversed,
                n = g ? b.height / 2 : b.width / 2;
            c = (c = c.pointWidth) ? c / 2 : 0;
            k = g ? d.x : h ? -n - c : k.width - n + c;
            d = g ? h ? this.yAxis.height - n + c : -n - c : d.y;
            b.startXPos = k;
            b.startYPos = d;
            f ? "hidden" === b.visibility && (b.show(), b.attr({
                opacity: 0
            }).animate({
                opacity: 1
            })) : b.attr({
                opacity: 1
            }).animate({
                    opacity: 0
                },
                void 0, b.hide);
            a.hasRendered && (e && b.attr({
                x: b.startXPos,
                y: b.startYPos
            }), b.placed = !0)
        };
        y.prototype.justifyDataLabel = function(c, b, e, f, d, a) {
            var g = this.chart,
                k = b.align,
                h = b.verticalAlign,
                n = c.box ? 0 : c.padding || 0,
                l = b.x;
            l = void 0 === l ? 0 : l;
            var p = b.y;
            var r = void 0 === p ? 0 : p;
            p = e.x + n;
            if (0 > p) {
                "right" === k && 0 <= l ? (b.align = "left", b.inside = !0) : l -= p;
                var u = !0
            }
            p = e.x + f.width - n;
            p > g.plotWidth && ("left" === k && 0 >= l ? (b.align = "right", b.inside = !0) : l += g.plotWidth - p, u = !0);
            p = e.y + n;
            0 > p && ("bottom" === h && 0 <= r ? (b.verticalAlign = "top", b.inside = !0) : r -= p, u = !0);
            p = e.y + f.height - n;
            p > g.plotHeight && ("top" === h && 0 >= r ? (b.verticalAlign = "bottom", b.inside = !0) : r += g.plotHeight - p, u = !0);
            u && (b.x = l, b.y = r, c.placed = !a, c.align(b, void 0, d));
            return u
        };
        z.pie && (z.pie.prototype.dataLabelPositioners = {
                radialDistributionY: function(c) {
                    return c.top + c.distributeBox.pos
                },
                radialDistributionX: function(c, b, e, f) {
                    return c.getX(e < b.top + 2 || e > b.bottom - 2 ? f : e, b.half, b)
                },
                justify: function(c, b, e) {
                    return e[0] + (c.half ? -1 : 1) * (b + c.labelDistance)
                },
                alignToPlotEdges: function(c, b, e, f) {
                    c = c.getBBox().width;
                    return b ? c + f : e - c - f
                },
                alignToConnectors: function(c, b, e, f) {
                    var d = 0,
                        a;
                    c.forEach(function(c) {
                        a = c.dataLabel.getBBox().width;
                        a > d && (d = a)
                    });
                    return b ? d + f : e - d - f
                }
            }, z.pie.prototype.drawDataLabels = function() {
                var c = this,
                    b = c.data,
                    e, g = c.chart,
                    d = c.options.dataLabels || {},
                    a = d.connectorPadding,
                    k, p = g.plotWidth,
                    r = g.plotHeight,
                    q = g.plotLeft,
                    v = Math.round(g.chartWidth / 3),
                    w, z = c.center,
                    C = z[2] / 2,
                    G = z[1],
                    H, F, L, K, J = [
                        [],
                        []
                    ],
                    D, S, P, Z, U = [0, 0, 0, 0],
                    V = c.dataLabelPositioners,
                    X;
                c.visible && (d.enabled || c._hasPointLabels) && (b.forEach(function(a) {
                        a.dataLabel &&
                            a.visible && a.dataLabel.shortened && (a.dataLabel.attr({
                                width: "auto"
                            }).css({
                                width: "auto",
                                textOverflow: "clip"
                            }), a.dataLabel.shortened = !1)
                    }), y.prototype.drawDataLabels.apply(c), b.forEach(function(a) {
                        a.dataLabel && (a.visible ? (J[a.half].push(a), a.dataLabel._pos = null, !h(d.style.width) && !h(a.options.dataLabels && a.options.dataLabels.style && a.options.dataLabels.style.width) && a.dataLabel.getBBox().width > v && (a.dataLabel.css({
                            width: Math.round(.7 * v) + "px"
                        }), a.dataLabel.shortened = !0)) : (a.dataLabel = a.dataLabel.destroy(),
                            a.dataLabels && 1 === a.dataLabels.length && delete a.dataLabels))
                    }), J.forEach(function(b, f) {
                        var k = b.length,
                            m = [],
                            n;
                        if (k) {
                            c.sortByAngle(b, f - .5);
                            if (0 < c.maxLabelDistance) {
                                var u = Math.max(0, G - C - c.maxLabelDistance);
                                var t = Math.min(G + C + c.maxLabelDistance, g.plotHeight);
                                b.forEach(function(a) {
                                    0 < a.labelDistance && a.dataLabel && (a.top = Math.max(0, G - C - a.labelDistance), a.bottom = Math.min(G + C + a.labelDistance, g.plotHeight), n = a.dataLabel.getBBox().height || 21, a.distributeBox = {
                                        target: a.labelPosition.natural.y - a.top + n / 2,
                                        size: n,
                                        rank: a.y
                                    }, m.push(a.distributeBox))
                                });
                                u = t + n - u;
                                l.distribute(m, u, u / 5)
                            }
                            for (Z = 0; Z < k; Z++) {
                                e = b[Z];
                                L = e.labelPosition;
                                H = e.dataLabel;
                                P = !1 === e.visible ? "hidden" : "inherit";
                                S = u = L.natural.y;
                                m && h(e.distributeBox) && ("undefined" === typeof e.distributeBox.pos ? P = "hidden" : (K = e.distributeBox.size, S = V.radialDistributionY(e)));
                                delete e.positionIndex;
                                if (d.justify) D = V.justify(e, C, z);
                                else switch (d.alignTo) {
                                    case "connectors":
                                        D = V.alignToConnectors(b, f, p, q);
                                        break;
                                    case "plotEdges":
                                        D = V.alignToPlotEdges(H, f, p, q);
                                        break;
                                    default:
                                        D = V.radialDistributionX(c,
                                            e, S, u)
                                }
                                H._attr = {
                                    visibility: P,
                                    align: L.alignment
                                };
                                X = e.options.dataLabels || {};
                                H._pos = {
                                    x: D + x(X.x, d.x) + ({
                                        left: a,
                                        right: -a
                                    } [L.alignment] || 0),
                                    y: S + x(X.y, d.y) - 10
                                };
                                L.final.x = D;
                                L.final.y = S;
                                x(d.crop, !0) && (F = H.getBBox().width, u = null, D - F < a && 1 === f ? (u = Math.round(F - D + a), U[3] = Math.max(u, U[3])) : D + F > p - a && 0 === f && (u = Math.round(D + F - p + a), U[1] = Math.max(u, U[1])), 0 > S - K / 2 ? U[0] = Math.max(Math.round(-S + K / 2), U[0]) : S + K / 2 > r && (U[2] = Math.max(Math.round(S + K / 2 - r), U[2])), H.sideOverflow = u)
                            }
                        }
                    }), 0 === t(U) || this.verifyDataLabelOverflow(U)) &&
                    (this.placeDataLabels(), this.points.forEach(function(a) {
                        X = f(d, a.options.dataLabels);
                        if (k = x(X.connectorWidth, 1)) {
                            var b;
                            w = a.connector;
                            if ((H = a.dataLabel) && H._pos && a.visible && 0 < a.labelDistance) {
                                P = H._attr.visibility;
                                if (b = !w) a.connector = w = g.renderer.path().addClass("highcharts-data-label-connector  highcharts-color-" + a.colorIndex + (a.className ? " " + a.className : "")).add(c.dataLabelsGroup), g.styledMode || w.attr({
                                    "stroke-width": k,
                                    stroke: X.connectorColor || a.color || B.neutralColor60
                                });
                                w[b ? "attr" : "animate"]({
                                    d: a.getConnectorPath()
                                });
                                w.attr("visibility", P)
                            } else w && (a.connector = w.destroy())
                        }
                    }))
            }, z.pie.prototype.placeDataLabels = function() {
                this.points.forEach(function(c) {
                    var b = c.dataLabel,
                        e;
                    b && c.visible && ((e = b._pos) ? (b.sideOverflow && (b._attr.width = Math.max(b.getBBox().width - b.sideOverflow, 0), b.css({
                        width: b._attr.width + "px",
                        textOverflow: (this.options.dataLabels.style || {}).textOverflow || "ellipsis"
                    }), b.shortened = !0), b.attr(b._attr), b[b.moved ? "animate" : "attr"](e), b.moved = !0) : b && b.attr({
                        y: -9999
                    }));
                    delete c.distributeBox
                }, this)
            }, z.pie.prototype.alignDataLabel =
            b, z.pie.prototype.verifyDataLabelOverflow = function(c) {
                var b = this.center,
                    e = this.options,
                    f = e.center,
                    d = e.minSize || 80,
                    a = null !== e.size;
                if (!a) {
                    if (null !== f[0]) var k = Math.max(b[2] - Math.max(c[1], c[3]), d);
                    else k = Math.max(b[2] - c[1] - c[3], d), b[0] += (c[3] - c[1]) / 2;
                    null !== f[1] ? k = q(k, d, b[2] - Math.max(c[0], c[2])) : (k = q(k, d, b[2] - c[0] - c[2]), b[1] += (c[0] - c[2]) / 2);
                    k < b[2] ? (b[2] = k, b[3] = Math.min(K(e.innerSize || 0, k), k), this.translate(b), this.drawDataLabels && this.drawDataLabels()) : a = !0
                }
                return a
            });
        z.column && (z.column.prototype.alignDataLabel =
            function(c, b, e, g, d) {
                var a = this.chart.inverted,
                    k = c.series,
                    h = c.dlBox || c.shapeArgs,
                    l = x(c.below, c.plotY > x(this.translatedThreshold, k.yAxis.len)),
                    n = x(e.inside, !!this.options.stacking);
                h && (g = f(h), 0 > g.y && (g.height += g.y, g.y = 0), h = g.y + g.height - k.yAxis.len, 0 < h && h < g.height && (g.height -= h), a && (g = {
                    x: k.yAxis.len - g.y - g.height,
                    y: k.xAxis.len - g.x - g.width,
                    width: g.height,
                    height: g.width
                }), n || (a ? (g.x += l ? 0 : g.width, g.width = 0) : (g.y += l ? g.height : 0, g.height = 0)));
                e.align = x(e.align, !a || n ? "center" : l ? "right" : "left");
                e.verticalAlign =
                    x(e.verticalAlign, a || n ? "middle" : l ? "top" : "bottom");
                y.prototype.alignDataLabel.call(this, c, b, e, g, d);
                e.inside && c.contrastColor && b.css({
                    color: c.contrastColor
                })
            })
    });
    J(b, "Extensions/OverlappingDataLabels.js", [b["Core/Chart/Chart.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = l.addEvent,
            y = l.fireEvent,
            z = l.isArray,
            C = l.isNumber,
            v = l.objectEach,
            t = l.pick;
        w(b, "render", function() {
            var b = [];
            (this.labelCollectors || []).forEach(function(h) {
                b = b.concat(h())
            });
            (this.yAxis || []).forEach(function(h) {
                h.stacking && h.options.stackLabels &&
                    !h.options.stackLabels.allowOverlap && v(h.stacking.stacks, function(c) {
                        v(c, function(c) {
                            b.push(c.label)
                        })
                    })
            });
            (this.series || []).forEach(function(h) {
                var c = h.options.dataLabels;
                h.visible && (!1 !== c.enabled || h._hasPointLabels) && (c = function(c) {
                    return c.forEach(function(c) {
                        c.visible && (z(c.dataLabels) ? c.dataLabels : c.dataLabel ? [c.dataLabel] : []).forEach(function(k) {
                            var f = k.options;
                            k.labelrank = t(f.labelrank, c.labelrank, c.shapeArgs && c.shapeArgs.height);
                            f.allowOverlap || b.push(k)
                        })
                    })
                }, c(h.nodes || []), c(h.points))
            });
            this.hideOverlappingLabels(b)
        });
        b.prototype.hideOverlappingLabels = function(b) {
            var h = this,
                c = b.length,
                l = h.renderer,
                k, q, f, t = !1;
            var v = function(c) {
                var b, f = c.box ? 0 : c.padding || 0,
                    e = b = 0,
                    g;
                if (c && (!c.alignAttr || c.placed)) {
                    var d = c.alignAttr || {
                        x: c.attr("x"),
                        y: c.attr("y")
                    };
                    var a = c.parentGroup;
                    c.width || (b = c.getBBox(), c.width = b.width, c.height = b.height, b = l.fontMetrics(null, c.element).h);
                    var k = c.width - 2 * f;
                    (g = {
                        left: "0",
                        center: "0.5",
                        right: "1"
                    } [c.alignValue]) ? e = +g * k: C(c.x) && Math.round(c.x) !== c.translateX && (e = c.x - c.translateX);
                    return {
                        x: d.x + (a.translateX || 0) + f - (e || 0),
                        y: d.y + (a.translateY || 0) + f - b,
                        width: c.width - 2 * f,
                        height: c.height - 2 * f
                    }
                }
            };
            for (q = 0; q < c; q++)
                if (k = b[q]) k.oldOpacity = k.opacity, k.newOpacity = 1, k.absoluteBox = v(k);
            b.sort(function(c, b) {
                return (b.labelrank || 0) - (c.labelrank || 0)
            });
            for (q = 0; q < c; q++) {
                var w = (v = b[q]) && v.absoluteBox;
                for (k = q + 1; k < c; ++k) {
                    var z = (f = b[k]) && f.absoluteBox;
                    !w || !z || v === f || 0 === v.newOpacity || 0 === f.newOpacity || z.x >= w.x + w.width || z.x + z.width <= w.x || z.y >= w.y + w.height || z.y + z.height <= w.y || ((v.labelrank < f.labelrank ?
                        v : f).newOpacity = 0)
                }
            }
            b.forEach(function(c) {
                if (c) {
                    var b = c.newOpacity;
                    c.oldOpacity !== b && (c.alignAttr && c.placed ? (c[b ? "removeClass" : "addClass"]("highcharts-data-label-hidden"), t = !0, c.alignAttr.opacity = b, c[c.isOld ? "animate" : "attr"](c.alignAttr, null, function() {
                        h.styledMode || c.css({
                            pointerEvents: b ? "auto" : "none"
                        });
                        c.visibility = b ? "inherit" : "hidden"
                    }), y(h, "afterHideOverlappingLabel")) : c.attr({
                        opacity: b
                    }));
                    c.isOld = !0
                }
            });
            t && y(h, "afterHideAllOverlappingLabels")
        }
    });
    J(b, "Core/Responsive.js", [b["Core/Chart/Chart.js"],
        b["Core/Utilities.js"]
    ], function(b, l) {
        var w = l.find,
            y = l.isArray,
            z = l.isObject,
            C = l.merge,
            v = l.objectEach,
            t = l.pick,
            q = l.splat,
            h = l.uniqueKey;
        b.prototype.setResponsive = function(c, b) {
            var k = this.options.responsive,
                l = [],
                f = this.currentResponsive;
            !b && k && k.rules && k.rules.forEach(function(c) {
                "undefined" === typeof c._id && (c._id = h());
                this.matchResponsiveRule(c, l)
            }, this);
            b = C.apply(0, l.map(function(c) {
                return w(k.rules, function(b) {
                    return b._id === c
                }).chartOptions
            }));
            b.isResponsiveOptions = !0;
            l = l.toString() || void 0;
            l !==
                (f && f.ruleIds) && (f && this.update(f.undoOptions, c, !0), l ? (f = this.currentOptions(b), f.isResponsiveOptions = !0, this.currentResponsive = {
                    ruleIds: l,
                    mergedOptions: b,
                    undoOptions: f
                }, this.update(b, c, !0)) : this.currentResponsive = void 0)
        };
        b.prototype.matchResponsiveRule = function(c, b) {
            var k = c.condition;
            (k.callback || function() {
                return this.chartWidth <= t(k.maxWidth, Number.MAX_VALUE) && this.chartHeight <= t(k.maxHeight, Number.MAX_VALUE) && this.chartWidth >= t(k.minWidth, 0) && this.chartHeight >= t(k.minHeight, 0)
            }).call(this) &&
                b.push(c._id)
        };
        b.prototype.currentOptions = function(c) {
            function b(c, h, l, p) {
                var f;
                v(c, function(c, n) {
                    if (!p && -1 < k.collectionsWithUpdate.indexOf(n) && h[n])
                        for (c = q(c), l[n] = [], f = 0; f < Math.max(c.length, h[n].length); f++) h[n][f] && (void 0 === c[f] ? l[n][f] = h[n][f] : (l[n][f] = {}, b(c[f], h[n][f], l[n][f], p + 1)));
                    else z(c) ? (l[n] = y(c) ? [] : {}, b(c, h[n] || {}, l[n], p + 1)) : l[n] = "undefined" === typeof h[n] ? null : h[n]
                })
            }
            var k = this,
                h = {};
            b(c, this.options, h, 0);
            return h
        }
    });
    J(b, "masters/highcharts.src.js", [b["Core/Globals.js"], b["Core/Utilities.js"],
        b["Core/Renderer/HTML/AST.js"], b["Core/Series/Series.js"]
    ], function(b, l, B, y) {
        b.addEvent = l.addEvent;
        b.arrayMax = l.arrayMax;
        b.arrayMin = l.arrayMin;
        b.attr = l.attr;
        b.clearTimeout = l.clearTimeout;
        b.correctFloat = l.correctFloat;
        b.createElement = l.createElement;
        b.css = l.css;
        b.defined = l.defined;
        b.destroyObjectProperties = l.destroyObjectProperties;
        b.discardElement = l.discardElement;
        b.erase = l.erase;
        b.error = l.error;
        b.extend = l.extend;
        b.extendClass = l.extendClass;
        b.find = l.find;
        b.fireEvent = l.fireEvent;
        b.format = l.format;
        b.getMagnitude = l.getMagnitude;
        b.getStyle = l.getStyle;
        b.inArray = l.inArray;
        b.isArray = l.isArray;
        b.isClass = l.isClass;
        b.isDOMElement = l.isDOMElement;
        b.isFunction = l.isFunction;
        b.isNumber = l.isNumber;
        b.isObject = l.isObject;
        b.isString = l.isString;
        b.keys = l.keys;
        b.merge = l.merge;
        b.normalizeTickInterval = l.normalizeTickInterval;
        b.numberFormat = l.numberFormat;
        b.objectEach = l.objectEach;
        b.offset = l.offset;
        b.pad = l.pad;
        b.pick = l.pick;
        b.pInt = l.pInt;
        b.relativeLength = l.relativeLength;
        b.removeEvent = l.removeEvent;
        b.splat = l.splat;
        b.stableSort = l.stableSort;
        b.syncTimeout = l.syncTimeout;
        b.timeUnits = l.timeUnits;
        b.uniqueKey = l.uniqueKey;
        b.useSerialIds = l.useSerialIds;
        b.wrap = l.wrap;
        b.AST = B;
        b.Series = y;
        return b
    });
    J(b, "Core/Axis/MapAxis.js", [b["Core/Axis/Axis.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = l.addEvent,
            y = l.pick,
            z = function() {
                return function(b) {
                    this.axis = b
                }
            }();
        l = function() {
            function b() {}
            b.compose = function(b) {
                b.keepProps.push("mapAxis");
                w(b, "init", function() {
                    this.mapAxis || (this.mapAxis = new z(this))
                });
                w(b, "getSeriesExtremes",
                    function() {
                        if (this.mapAxis) {
                            var b = [];
                            this.isXAxis && (this.series.forEach(function(l, h) {
                                l.useMapGeometry && (b[h] = l.xData, l.xData = [])
                            }), this.mapAxis.seriesXData = b)
                        }
                    });
                w(b, "afterGetSeriesExtremes", function() {
                    if (this.mapAxis) {
                        var b = this.mapAxis.seriesXData || [],
                            l;
                        if (this.isXAxis) {
                            var h = y(this.dataMin, Number.MAX_VALUE);
                            var c = y(this.dataMax, -Number.MAX_VALUE);
                            this.series.forEach(function(p, k) {
                                p.useMapGeometry && (h = Math.min(h, y(p.minX, h)), c = Math.max(c, y(p.maxX, c)), p.xData = b[k], l = !0)
                            });
                            l && (this.dataMin = h, this.dataMax =
                                c);
                            this.mapAxis.seriesXData = void 0
                        }
                    }
                });
                w(b, "afterSetAxisTranslation", function() {
                    if (this.mapAxis) {
                        var b = this.chart,
                            l = b.plotWidth / b.plotHeight;
                        b = b.xAxis[0];
                        var h;
                        "yAxis" === this.coll && "undefined" !== typeof b.transA && this.series.forEach(function(c) {
                            c.preserveAspectRatio && (h = !0)
                        });
                        if (h && (this.transA = b.transA = Math.min(this.transA, b.transA), l /= (b.max - b.min) / (this.max - this.min), l = 1 > l ? this : b, b = (l.max - l.min) * l.transA, l.mapAxis.pixelPadding = l.len - b, l.minPixelPadding = l.mapAxis.pixelPadding / 2, b = l.mapAxis.fixTo)) {
                            b =
                                b[1] - l.toValue(b[0], !0);
                            b *= l.transA;
                            if (Math.abs(b) > l.minPixelPadding || l.min === l.dataMin && l.max === l.dataMax) b = 0;
                            l.minPixelPadding -= b
                        }
                    }
                });
                w(b, "render", function() {
                    this.mapAxis && (this.mapAxis.fixTo = void 0)
                })
            };
            return b
        }();
        l.compose(b);
        return l
    });
    J(b, "Mixins/ColorSeries.js", [], function() {
        return {
            colorPointMixin: {
                setVisible: function(b) {
                    var l = this,
                        w = b ? "show" : "hide";
                    l.visible = l.options.visible = !!b;
                    ["graphic", "dataLabel"].forEach(function(b) {
                        if (l[b]) l[b][w]()
                    });
                    this.series.buildKDTree()
                }
            },
            colorSeriesMixin: {
                optionalAxis: "colorAxis",
                colorAxis: 0,
                translateColors: function() {
                    var b = this,
                        l = this.options.nullColor,
                        B = this.colorAxis,
                        y = this.colorKey;
                    (this.data.length ? this.data : this.points).forEach(function(w) {
                        var z = w.getNestedProperty(y);
                        (z = w.options.color || (w.isNull || null === w.value ? l : B && "undefined" !== typeof z ? B.toColor(z, w) : w.color || b.color)) && w.color !== z && (w.color = z, "point" === b.options.legendType && w.legendItem && b.chart.legend.colorizeItem(w, w.visible))
                    })
                }
            }
        }
    });
    J(b, "Core/Axis/ColorAxis.js", [b["Core/Axis/Axis.js"], b["Core/Chart/Chart.js"],
        b["Core/Color/Color.js"], b["Mixins/ColorSeries.js"], b["Core/Animation/Fx.js"], b["Core/Globals.js"], b["Core/Legend.js"], b["Mixins/LegendSymbol.js"], b["Core/Color/Palette.js"], b["Core/Series/Point.js"], b["Core/Series/Series.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C, v, t, q, h, c, p) {
        var k = this && this.__extends || function() {
                var b = function(d, a) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(a, d) {
                        a.__proto__ = d
                    } || function(a, d) {
                        for (var b in d) d.hasOwnProperty(b) && (a[b] = d[b])
                    };
                    return b(d,
                        a)
                };
                return function(d, a) {
                    function c() {
                        this.constructor = d
                    }
                    b(d, a);
                    d.prototype = null === a ? Object.create(a) : (c.prototype = a.prototype, new c)
                }
            }(),
            w = B.parse;
        B = y.colorPointMixin;
        y = y.colorSeriesMixin;
        var f = C.noop,
            H = p.addEvent,
            x = p.erase,
            K = p.extend,
            L = p.isNumber,
            r = p.merge,
            n = p.pick,
            u = p.splat;
        "";
        K(c.prototype, y);
        K(h.prototype, B);
        l.prototype.collectionsWithUpdate.push("colorAxis");
        l.prototype.collectionsWithInit.colorAxis = [l.prototype.addColorAxis];
        var e = function(b) {
            function d(a, d) {
                var c = b.call(this, a, d) || this;
                c.beforePadding = !1;
                c.chart = void 0;
                c.coll = "colorAxis";
                c.dataClasses = void 0;
                c.legendItem = void 0;
                c.legendItems = void 0;
                c.name = "";
                c.options = void 0;
                c.stops = void 0;
                c.visible = !0;
                c.init(a, d);
                return c
            }
            k(d, b);
            d.prototype.init = function(a, c) {
                var e = a.options.legend || {},
                    f = c.layout ? "vertical" !== c.layout : "vertical" !== e.layout;
                e = r(d.defaultOptions, c, {
                    showEmpty: !1,
                    title: null,
                    visible: e.enabled && (c ? !1 !== c.visible : !0)
                });
                this.coll = "colorAxis";
                this.side = c.side || f ? 2 : 1;
                this.reversed = c.reversed || !f;
                this.opposite = !f;
                a.options[this.coll] = e;
                b.prototype.init.call(this, a, e);
                c.dataClasses && this.initDataClasses(c);
                this.initStops();
                this.horiz = f;
                this.zoomEnabled = !1
            };
            d.prototype.initDataClasses = function(a) {
                var d = this.chart,
                    c, b = 0,
                    e = d.options.chart.colorCount,
                    f = this.options,
                    g = a.dataClasses.length;
                this.dataClasses = c = [];
                this.legendItems = [];
                a.dataClasses.forEach(function(a, k) {
                    a = r(a);
                    c.push(a);
                    if (d.styledMode || !a.color) "category" === f.dataClassColor ? (d.styledMode || (k = d.options.colors, e = k.length, a.color = k[b]), a.colorIndex = b, b++, b === e && (b = 0)) : a.color =
                        w(f.minColor).tweenTo(w(f.maxColor), 2 > g ? .5 : k / (g - 1))
                })
            };
            d.prototype.hasData = function() {
                return !!(this.tickPositions || []).length
            };
            d.prototype.setTickPositions = function() {
                if (!this.dataClasses) return b.prototype.setTickPositions.call(this)
            };
            d.prototype.initStops = function() {
                this.stops = this.options.stops || [
                    [0, this.options.minColor],
                    [1, this.options.maxColor]
                ];
                this.stops.forEach(function(a) {
                    a.color = w(a[1])
                })
            };
            d.prototype.setOptions = function(a) {
                b.prototype.setOptions.call(this, a);
                this.options.crosshair = this.options.marker
            };
            d.prototype.setAxisSize = function() {
                var a = this.legendSymbol,
                    b = this.chart,
                    c = b.options.legend || {},
                    e, f;
                a ? (this.left = c = a.attr("x"), this.top = e = a.attr("y"), this.width = f = a.attr("width"), this.height = a = a.attr("height"), this.right = b.chartWidth - c - f, this.bottom = b.chartHeight - e - a, this.len = this.horiz ? f : a, this.pos = this.horiz ? c : e) : this.len = (this.horiz ? c.symbolWidth : c.symbolHeight) || d.defaultLegendLength
            };
            d.prototype.normalizedValue = function(a) {
                this.logarithmic && (a = this.logarithmic.log2lin(a));
                return 1 - (this.max - a) /
                    (this.max - this.min || 1)
            };
            d.prototype.toColor = function(a, d) {
                var b = this.dataClasses,
                    c = this.stops,
                    e;
                if (b)
                    for (e = b.length; e--;) {
                        var f = b[e];
                        var g = f.from;
                        c = f.to;
                        if (("undefined" === typeof g || a >= g) && ("undefined" === typeof c || a <= c)) {
                            var k = f.color;
                            d && (d.dataClass = e, d.colorIndex = f.colorIndex);
                            break
                        }
                    } else {
                        a = this.normalizedValue(a);
                        for (e = c.length; e-- && !(a > c[e][0]););
                        g = c[e] || c[e + 1];
                        c = c[e + 1] || g;
                        a = 1 - (c[0] - a) / (c[0] - g[0] || 1);
                        k = g.color.tweenTo(c.color, a)
                    }
                return k
            };
            d.prototype.getOffset = function() {
                var a = this.legendGroup,
                    c = this.chart.axisOffset[this.side];
                a && (this.axisParent = a, b.prototype.getOffset.call(this), this.added || (this.added = !0, this.labelLeft = 0, this.labelRight = this.width), this.chart.axisOffset[this.side] = c)
            };
            d.prototype.setLegendColor = function() {
                var a = this.reversed,
                    c = a ? 1 : 0;
                a = a ? 0 : 1;
                c = this.horiz ? [c, 0, a, 0] : [0, a, 0, c];
                this.legendColor = {
                    linearGradient: {
                        x1: c[0],
                        y1: c[1],
                        x2: c[2],
                        y2: c[3]
                    },
                    stops: this.stops
                }
            };
            d.prototype.drawLegendSymbol = function(a, c) {
                var b = a.padding,
                    e = a.options,
                    f = this.horiz,
                    g = n(e.symbolWidth, f ? d.defaultLegendLength :
                        12),
                    k = n(e.symbolHeight, f ? 12 : d.defaultLegendLength),
                    h = n(e.labelPadding, f ? 16 : 30);
                e = n(e.itemDistance, 10);
                this.setLegendColor();
                c.legendSymbol = this.chart.renderer.rect(0, a.baseline - 11, g, k).attr({
                    zIndex: 1
                }).add(c.legendGroup);
                this.legendItemWidth = g + b + (f ? e : h);
                this.legendItemHeight = k + b + (f ? h : 0)
            };
            d.prototype.setState = function(a) {
                this.series.forEach(function(c) {
                    c.setState(a)
                })
            };
            d.prototype.setVisible = function() {};
            d.prototype.getSeriesExtremes = function() {
                var a = this.series,
                    d = a.length,
                    b;
                this.dataMin = Infinity;
                for (this.dataMax = -Infinity; d--;) {
                    var e = a[d];
                    var f = e.colorKey = n(e.options.colorKey, e.colorKey, e.pointValKey, e.zoneAxis, "y");
                    var g = e.pointArrayMap;
                    var k = e[f + "Min"] && e[f + "Max"];
                    if (e[f + "Data"]) var h = e[f + "Data"];
                    else if (g) {
                        h = [];
                        g = g.indexOf(f);
                        var l = e.yData;
                        if (0 <= g && l)
                            for (b = 0; b < l.length; b++) h.push(n(l[b][g], l[b]))
                    } else h = e.yData;
                    k ? (e.minColorValue = e[f + "Min"], e.maxColorValue = e[f + "Max"]) : (h = c.prototype.getExtremes.call(e, h), e.minColorValue = h.dataMin, e.maxColorValue = h.dataMax);
                    "undefined" !== typeof e.minColorValue &&
                        (this.dataMin = Math.min(this.dataMin, e.minColorValue), this.dataMax = Math.max(this.dataMax, e.maxColorValue));
                    k || c.prototype.applyExtremes.call(e)
                }
            };
            d.prototype.drawCrosshair = function(a, c) {
                var d = c && c.plotX,
                    e = c && c.plotY,
                    f = this.pos,
                    g = this.len;
                if (c) {
                    var k = this.toPixels(c.getNestedProperty(c.series.colorKey));
                    k < f ? k = f - 2 : k > f + g && (k = f + g + 2);
                    c.plotX = k;
                    c.plotY = this.len - k;
                    b.prototype.drawCrosshair.call(this, a, c);
                    c.plotX = d;
                    c.plotY = e;
                    this.cross && !this.cross.addedToColorAxis && this.legendGroup && (this.cross.addClass("highcharts-coloraxis-marker").add(this.legendGroup),
                        this.cross.addedToColorAxis = !0, !this.chart.styledMode && this.crosshair && this.cross.attr({
                            fill: this.crosshair.color
                        }))
                }
            };
            d.prototype.getPlotLinePath = function(a) {
                var c = this.left,
                    d = a.translatedValue,
                    e = this.top;
                return L(d) ? this.horiz ? [
                    ["M", d - 4, e - 6],
                    ["L", d + 4, e - 6],
                    ["L", d, e],
                    ["Z"]
                ] : [
                    ["M", c, d],
                    ["L", c - 6, d + 6],
                    ["L", c - 6, d - 6],
                    ["Z"]
                ] : b.prototype.getPlotLinePath.call(this, a)
            };
            d.prototype.update = function(a, c) {
                var d = this.chart.legend;
                this.series.forEach(function(a) {
                    a.isDirtyData = !0
                });
                (a.dataClasses && d.allItems || this.dataClasses) &&
                this.destroyItems();
                b.prototype.update.call(this, a, c);
                this.legendItem && (this.setLegendColor(), d.colorizeItem(this, !0))
            };
            d.prototype.destroyItems = function() {
                var a = this.chart;
                this.legendItem ? a.legend.destroyItem(this) : this.legendItems && this.legendItems.forEach(function(c) {
                    a.legend.destroyItem(c)
                });
                a.isDirtyLegend = !0
            };
            d.prototype.destroy = function() {
                this.chart.isDirtyLegend = !0;
                this.destroyItems();
                b.prototype.destroy.apply(this, [].slice.call(arguments))
            };
            d.prototype.remove = function(a) {
                this.destroyItems();
                b.prototype.remove.call(this, a)
            };
            d.prototype.getDataClassLegendSymbols = function() {
                var a = this,
                    c = a.chart,
                    d = a.legendItems,
                    b = c.options.legend,
                    e = b.valueDecimals,
                    g = b.valueSuffix || "",
                    k;
                d.length || a.dataClasses.forEach(function(b, h) {
                    var m = !0,
                        l = b.from,
                        n = b.to,
                        p = c.numberFormatter;
                    k = "";
                    "undefined" === typeof l ? k = "< " : "undefined" === typeof n && (k = "> ");
                    "undefined" !== typeof l && (k += p(l, e) + g);
                    "undefined" !== typeof l && "undefined" !== typeof n && (k += " - ");
                    "undefined" !== typeof n && (k += p(n, e) + g);
                    d.push(K({
                        chart: c,
                        name: k,
                        options: {},
                        drawLegendSymbol: t.drawRectangle,
                        visible: !0,
                        setState: f,
                        isDataClass: !0,
                        setVisible: function() {
                            m = a.visible = !m;
                            a.series.forEach(function(a) {
                                a.points.forEach(function(a) {
                                    a.dataClass === h && a.setVisible(m)
                                })
                            });
                            c.legend.colorizeItem(this, m)
                        }
                    }, b))
                });
                return d
            };
            d.defaultLegendLength = 200;
            d.defaultOptions = {
                lineWidth: 0,
                minPadding: 0,
                maxPadding: 0,
                gridLineWidth: 1,
                tickPixelInterval: 72,
                startOnTick: !0,
                endOnTick: !0,
                offset: 0,
                marker: {
                    animation: {
                        duration: 50
                    },
                    width: .01,
                    color: q.neutralColor40
                },
                labels: {
                    overflow: "justify",
                    rotation: 0
                },
                minColor: q.highlightColor10,
                maxColor: q.highlightColor100,
                tickLength: 5,
                showInLegend: !0
            };
            d.keepProps = ["legendGroup", "legendItemHeight", "legendItemWidth", "legendItem", "legendSymbol"];
            return d
        }(b);
        Array.prototype.push.apply(b.keepProps, e.keepProps);
        C.ColorAxis = e;
        ["fill", "stroke"].forEach(function(c) {
            z.prototype[c + "Setter"] = function() {
                this.elem.attr(c, w(this.start).tweenTo(w(this.end), this.pos), null, !0)
            }
        });
        H(l, "afterGetAxes", function() {
            var c = this,
                d = c.options;
            this.colorAxis = [];
            d.colorAxis && (d.colorAxis =
                u(d.colorAxis), d.colorAxis.forEach(function(a, d) {
                    a.index = d;
                    new e(c, a)
                }))
        });
        H(c, "bindAxes", function() {
            var c = this.axisTypes;
            c ? -1 === c.indexOf("colorAxis") && c.push("colorAxis") : this.axisTypes = ["colorAxis"]
        });
        H(v, "afterGetAllItems", function(c) {
            var d = [],
                a, b;
            (this.chart.colorAxis || []).forEach(function(b) {
                (a = b.options) && a.showInLegend && (a.dataClasses && a.visible ? d = d.concat(b.getDataClassLegendSymbols()) : a.visible && d.push(b), b.series.forEach(function(d) {
                    if (!d.options.showInLegend || a.dataClasses) "point" === d.options.legendType ?
                        d.points.forEach(function(a) {
                            x(c.allItems, a)
                        }) : x(c.allItems, d)
                }))
            });
            for (b = d.length; b--;) c.allItems.unshift(d[b])
        });
        H(v, "afterColorizeItem", function(c) {
            c.visible && c.item.legendColor && c.item.legendSymbol.attr({
                fill: c.item.legendColor
            })
        });
        H(v, "afterUpdate", function() {
            var c = this.chart.colorAxis;
            c && c.forEach(function(c, a, b) {
                c.update({}, b)
            })
        });
        H(c, "afterTranslate", function() {
            (this.chart.colorAxis && this.chart.colorAxis.length || this.colorAttribs) && this.translateColors()
        });
        return e
    });
    J(b, "Mixins/ColorMapSeries.js",
        [b["Core/Globals.js"], b["Core/Series/Point.js"], b["Core/Utilities.js"]],
        function(b, l, B) {
            var w = B.defined;
            return {
                colorMapPointMixin: {
                    dataLabelOnNull: !0,
                    isValid: function() {
                        return null !== this.value && Infinity !== this.value && -Infinity !== this.value
                    },
                    setState: function(b) {
                        l.prototype.setState.call(this, b);
                        this.graphic && this.graphic.attr({
                            zIndex: "hover" === b ? 1 : 0
                        })
                    }
                },
                colorMapSeriesMixin: {
                    pointArrayMap: ["value"],
                    axisTypes: ["xAxis", "yAxis", "colorAxis"],
                    trackerGroups: ["group", "markerGroup", "dataLabelsGroup"],
                    getSymbol: b.noop,
                    parallelArrays: ["x", "y", "value"],
                    colorKey: "value",
                    pointAttribs: b.seriesTypes.column.prototype.pointAttribs,
                    colorAttribs: function(b) {
                        var l = {};
                        w(b.color) && (l[this.colorProp || "fill"] = b.color);
                        return l
                    }
                }
            }
        });
    J(b, "Maps/MapNavigationOptionsDefault.js", [b["Core/Options.js"], b["Core/Utilities.js"]], function(b, l) {
        l = l.extend;
        var w = {
            buttonOptions: {
                alignTo: "plotBox",
                align: "left",
                verticalAlign: "top",
                x: 0,
                width: 18,
                height: 18,
                padding: 5,
                style: {
                    fontSize: "15px",
                    fontWeight: "bold"
                },
                theme: {
                    "stroke-width": 1,
                    "text-align": "center"
                }
            },
            buttons: {
                zoomIn: {
                    onclick: function() {
                        this.mapZoom(.5)
                    },
                    text: "+",
                    y: 0
                },
                zoomOut: {
                    onclick: function() {
                        this.mapZoom(2)
                    },
                    text: "-",
                    y: 28
                }
            },
            mouseWheelSensitivity: 1.1
        };
        l(b.defaultOptions.lang, {
            zoomIn: "Zoom in",
            zoomOut: "Zoom out"
        });
        return b.defaultOptions.mapNavigation = w
    });
    J(b, "Maps/MapNavigation.js", [b["Core/Chart/Chart.js"], b["Core/Globals.js"], b["Core/Utilities.js"]], function(b, l, B) {
        function w(c) {
            c && (c.preventDefault && c.preventDefault(), c.stopPropagation && c.stopPropagation(), c.cancelBubble = !0)
        }

        function z(c) {
            this.init(c)
        }
        var C = l.doc,
            v = B.addEvent,
            t = B.extend,
            q = B.merge,
            h = B.objectEach,
            c = B.pick;
        z.prototype.init = function(c) {
            this.chart = c;
            c.mapNavButtons = []
        };
        z.prototype.update = function(b) {
            var k = this.chart,
                l = k.options.mapNavigation,
                f, p, x, z, C, r = function(c) {
                    this.handler.call(k, c);
                    w(c)
                },
                n = k.mapNavButtons;
            b && (l = k.options.mapNavigation = q(k.options.mapNavigation, b));
            for (; n.length;) n.pop().destroy();
            c(l.enableButtons, l.enabled) && !k.renderer.forExport && h(l.buttons, function(c, b) {
                f = q(l.buttonOptions, c);
                k.styledMode || (p = f.theme, p.style =
                    q(f.theme.style, f.style), z = (x = p.states) && x.hover, C = x && x.select);
                c = k.renderer.button(f.text, 0, 0, r, p, z, C, 0, "zoomIn" === b ? "topbutton" : "bottombutton").addClass("highcharts-map-navigation highcharts-" + {
                    zoomIn: "zoom-in",
                    zoomOut: "zoom-out"
                } [b]).attr({
                    width: f.width,
                    height: f.height,
                    title: k.options.lang[b],
                    padding: f.padding,
                    zIndex: 5
                }).add();
                c.handler = f.onclick;
                v(c.element, "dblclick", w);
                n.push(c);
                var e = f,
                    d = v(k, "load", function() {
                        c.align(t(e, {
                            width: c.width,
                            height: 2 * c.height
                        }), null, e.alignTo);
                        d()
                    })
            });
            this.updateEvents(l)
        };
        z.prototype.updateEvents = function(b) {
            var k = this.chart;
            c(b.enableDoubleClickZoom, b.enabled) || b.enableDoubleClickZoomTo ? this.unbindDblClick = this.unbindDblClick || v(k.container, "dblclick", function(c) {
                k.pointer.onContainerDblClick(c)
            }) : this.unbindDblClick && (this.unbindDblClick = this.unbindDblClick());
            c(b.enableMouseWheelZoom, b.enabled) ? this.unbindMouseWheel = this.unbindMouseWheel || v(k.container, "undefined" === typeof C.onmousewheel ? "DOMMouseScroll" : "mousewheel", function(c) {
                k.pointer.onContainerMouseWheel(c);
                w(c);
                return !1
            }) : this.unbindMouseWheel && (this.unbindMouseWheel = this.unbindMouseWheel())
        };
        t(b.prototype, {
            fitToBox: function(c, b) {
                [
                    ["x", "width"],
                    ["y", "height"]
                ].forEach(function(k) {
                    var f = k[0];
                    k = k[1];
                    c[f] + c[k] > b[f] + b[k] && (c[k] > b[k] ? (c[k] = b[k], c[f] = b[f]) : c[f] = b[f] + b[k] - c[k]);
                    c[k] > b[k] && (c[k] = b[k]);
                    c[f] < b[f] && (c[f] = b[f])
                });
                return c
            },
            mapZoom: function(b, k, h, f, l) {
                var p = this.xAxis[0],
                    q = p.max - p.min,
                    t = c(k, p.min + q / 2),
                    r = q * b;
                q = this.yAxis[0];
                var n = q.max - q.min,
                    u = c(h, q.min + n / 2);
                n *= b;
                t = this.fitToBox({
                    x: t - r * (f ? (f - p.pos) /
                        p.len : .5),
                    y: u - n * (l ? (l - q.pos) / q.len : .5),
                    width: r,
                    height: n
                }, {
                    x: p.dataMin,
                    y: q.dataMin,
                    width: p.dataMax - p.dataMin,
                    height: q.dataMax - q.dataMin
                });
                r = t.x <= p.dataMin && t.width >= p.dataMax - p.dataMin && t.y <= q.dataMin && t.height >= q.dataMax - q.dataMin;
                f && p.mapAxis && (p.mapAxis.fixTo = [f - p.pos, k]);
                l && q.mapAxis && (q.mapAxis.fixTo = [l - q.pos, h]);
                "undefined" === typeof b || r ? (p.setExtremes(void 0, void 0, !1), q.setExtremes(void 0, void 0, !1)) : (p.setExtremes(t.x, t.x + t.width, !1), q.setExtremes(t.y, t.y + t.height, !1));
                this.redraw()
            }
        });
        v(b,
            "beforeRender",
            function() {
                this.mapNavigation = new z(this);
                this.mapNavigation.update()
            });
        l.MapNavigation = z
    });
    J(b, "Maps/MapPointer.js", [b["Core/Pointer.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = l.extend,
            y = l.pick;
        l = l.wrap;
        w(b.prototype, {
            onContainerDblClick: function(b) {
                var l = this.chart;
                b = this.normalize(b);
                l.options.mapNavigation.enableDoubleClickZoomTo ? l.pointer.inClass(b.target, "highcharts-tracker") && l.hoverPoint && l.hoverPoint.zoomTo() : l.isInsidePlot(b.chartX - l.plotLeft, b.chartY - l.plotTop) && l.mapZoom(.5,
                    l.xAxis[0].toValue(b.chartX), l.yAxis[0].toValue(b.chartY), b.chartX, b.chartY)
            },
            onContainerMouseWheel: function(b) {
                var l = this.chart;
                b = this.normalize(b);
                var v = b.detail || -(b.wheelDelta / 120);
                l.isInsidePlot(b.chartX - l.plotLeft, b.chartY - l.plotTop) && l.mapZoom(Math.pow(l.options.mapNavigation.mouseWheelSensitivity, v), l.xAxis[0].toValue(b.chartX), l.yAxis[0].toValue(b.chartY), b.chartX, b.chartY)
            }
        });
        l(b.prototype, "zoomOption", function(b) {
            var l = this.chart.options.mapNavigation;
            y(l.enableTouchZoom, l.enabled) && (this.chart.options.chart.pinchType =
                "xy");
            b.apply(this, [].slice.call(arguments, 1))
        });
        l(b.prototype, "pinchTranslate", function(b, l, v, t, q, h, c) {
            b.call(this, l, v, t, q, h, c);
            "map" === this.chart.options.chart.type && this.hasZoom && (b = t.scaleX > t.scaleY, this.pinchTranslateDirection(!b, l, v, t, q, h, c, b ? t.scaleX : t.scaleY))
        })
    });
    J(b, "Maps/MapSymbols.js", [b["Core/Globals.js"], b["Core/Renderer/SVG/SVGRenderer.js"]], function(b, l) {
        function w(b, l, v, t, q, h, c, p) {
            return [
                ["M", b + q, l],
                ["L", b + v - h, l],
                ["C", b + v - h / 2, l, b + v, l + h / 2, b + v, l + h],
                ["L", b + v, l + t - c],
                ["C", b + v, l + t - c / 2,
                    b + v - c / 2, l + t, b + v - c, l + t
                ],
                ["L", b + p, l + t],
                ["C", b + p / 2, l + t, b, l + t - p / 2, b, l + t - p],
                ["L", b, l + q],
                ["C", b, l + q / 2, b + q / 2, l, b + q, l],
                ["Z"]
            ]
        }
        var y = b.Renderer;
        l.prototype.symbols.topbutton = function(b, l, v, t, q) {
            q = q && q.r || 0;
            return w(b - 1, l - 1, v, t, q, q, 0, 0)
        };
        l.prototype.symbols.bottombutton = function(b, l, v, t, q) {
            q = q && q.r || 0;
            return w(b - 1, l - 1, v, t, 0, 0, q, q)
        };
        y !== l && ["topbutton", "bottombutton"].forEach(function(b) {
            y.prototype.symbols[b] = l.prototype.symbols[b]
        });
        return l.prototype.symbols
    });
    J(b, "Maps/Map.js", [b["Core/Chart/Chart.js"],
        b["Core/Globals.js"], b["Core/Renderer/SVG/SVGRenderer.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y) {
        var w = y.getOptions,
            C = y.merge,
            v = y.pick,
            t;
        (function(l) {
            l.maps = {};
            l.mapChart = function(h, c, l) {
                var k = "string" === typeof h || h.nodeName,
                    p = arguments[k ? 1 : 0],
                    f = p,
                    q = {
                        endOnTick: !1,
                        visible: !1,
                        minPadding: 0,
                        maxPadding: 0,
                        startOnTick: !1
                    },
                    t = w().credits;
                var z = p.series;
                p.series = null;
                p = C({
                    chart: {
                        panning: {
                            enabled: !0,
                            type: "xy"
                        },
                        type: "map"
                    },
                    credits: {
                        mapText: v(t.mapText, ' \u00a9 <a href="{geojson.copyrightUrl}">{geojson.copyrightShort}</a>'),
                        mapTextFull: v(t.mapTextFull, "{geojson.copyright}")
                    },
                    tooltip: {
                        followTouchMove: !1
                    },
                    xAxis: q,
                    yAxis: C(q, {
                        reversed: !0
                    })
                }, p, {
                    chart: {
                        inverted: !1,
                        alignTicks: !1
                    }
                });
                p.series = f.series = z;
                return k ? new b(h, p, l) : new b(p, c)
            };
            l.splitPath = function(b) {
                "string" === typeof b && (b = b.replace(/([A-Za-z])/g, " $1 ").replace(/^\s*/, "").replace(/\s*$/, ""), b = b.split(/[ ,;]+/).map(function(b) {
                    return /[A-za-z]/.test(b) ? b : parseFloat(b)
                }));
                return B.prototype.pathToSegments(b)
            }
        })(t || (t = {}));
        l.Map = t.mapChart;
        l.mapChart = t.mapChart;
        l.maps =
            t.maps;
        return t
    });
    J(b, "Series/Map/MapPoint.js", [b["Mixins/ColorMapSeries.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B) {
        var w = this && this.__extends || function() {
            var b = function(l, t) {
                b = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function(b, h) {
                    b.__proto__ = h
                } || function(b, h) {
                    for (var c in h) h.hasOwnProperty(c) && (b[c] = h[c])
                };
                return b(l, t)
            };
            return function(l, t) {
                function q() {
                    this.constructor = l
                }
                b(l, t);
                l.prototype = null === t ? Object.create(t) : (q.prototype = t.prototype, new q)
            }
        }();
        b = b.colorMapPointMixin;
        var z = B.extend;
        l = function(b) {
            function l() {
                var l = null !== b && b.apply(this, arguments) || this;
                l.options = void 0;
                l.path = void 0;
                l.series = void 0;
                return l
            }
            w(l, b);
            l.prototype.applyOptions = function(l, q) {
                var h = this.series;
                l = b.prototype.applyOptions.call(this, l, q);
                q = h.joinBy;
                h.mapData && h.mapMap && (q = b.prototype.getNestedProperty.call(l, q[1]), (q = "undefined" !== typeof q && h.mapMap[q]) ? (h.xyFromShape && (l.x = q._midX, l.y = q._midY), z(l, q)) : l.value = l.value || null);
                return l
            };
            l.prototype.onMouseOver = function(l) {
                B.clearTimeout(this.colorInterval);
                if (null !== this.value || this.series.options.nullInteraction) b.prototype.onMouseOver.call(this, l);
                else this.series.onMouseOut(l)
            };
            l.prototype.zoomTo = function() {
                var b = this.series;
                b.xAxis.setExtremes(this._minX, this._maxX, !1);
                b.yAxis.setExtremes(this._minY, this._maxY, !1);
                b.chart.redraw()
            };
            return l
        }(l.seriesTypes.scatter.prototype.pointClass);
        z(l.prototype, {
            dataLabelOnNull: b.dataLabelOnNull,
            isValid: b.isValid,
            setState: b.setState
        });
        return l
    });
    J(b, "Series/Map/MapSeries.js", [b["Mixins/ColorMapSeries.js"], b["Core/Globals.js"],
        b["Mixins/LegendSymbol.js"], b["Maps/Map.js"], b["Series/Map/MapPoint.js"], b["Core/Color/Palette.js"], b["Core/Series/Series.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Renderer/SVG/SVGRenderer.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C, v, t, q, h) {
        var c = this && this.__extends || function() {
            var b = function(a, c) {
                b = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function(a, b) {
                    a.__proto__ = b
                } || function(a, b) {
                    for (var c in b) b.hasOwnProperty(c) && (a[c] = b[c])
                };
                return b(a, c)
            };
            return function(a, c) {
                function d() {
                    this.constructor =
                        a
                }
                b(a, c);
                a.prototype = null === c ? Object.create(c) : (d.prototype = c.prototype, new d)
            }
        }();
        b = b.colorMapSeriesMixin;
        var p = l.noop,
            k = y.maps,
            w = y.splitPath;
        y = t.seriesTypes;
        var f = y.column,
            H = y.scatter;
        y = h.extend;
        var x = h.fireEvent,
            K = h.getNestedProperty,
            L = h.isArray,
            r = h.isNumber,
            n = h.merge,
            u = h.objectEach,
            e = h.pick,
            g = h.splat;
        h = function(b) {
            function a() {
                var a = null !== b && b.apply(this, arguments) || this;
                a.baseTrans = void 0;
                a.chart = void 0;
                a.data = void 0;
                a.group = void 0;
                a.joinBy = void 0;
                a.options = void 0;
                a.points = void 0;
                a.transformGroup =
                    void 0;
                return a
            }
            c(a, b);
            a.prototype.animate = function(a) {
                var b = this.options.animation,
                    c = this.group,
                    d = this.xAxis,
                    e = this.yAxis,
                    f = d.pos,
                    g = e.pos;
                this.chart.renderer.isSVG && (!0 === b && (b = {
                    duration: 1E3
                }), a ? c.attr({
                    translateX: f + d.len / 2,
                    translateY: g + e.len / 2,
                    scaleX: .001,
                    scaleY: .001
                }) : c.animate({
                    translateX: f,
                    translateY: g,
                    scaleX: 1,
                    scaleY: 1
                }, b))
            };
            a.prototype.animateDrilldown = function(a) {
                var b = this.chart.plotBox,
                    c = this.chart.drilldownLevels[this.chart.drilldownLevels.length - 1],
                    d = c.bBox,
                    e = this.chart.options.drilldown.animation;
                a || (a = Math.min(d.width / b.width, d.height / b.height), c.shapeArgs = {
                    scaleX: a,
                    scaleY: a,
                    translateX: d.x,
                    translateY: d.y
                }, this.points.forEach(function(a) {
                    a.graphic && a.graphic.attr(c.shapeArgs).animate({
                        scaleX: 1,
                        scaleY: 1,
                        translateX: 0,
                        translateY: 0
                    }, e)
                }))
            };
            a.prototype.animateDrillupFrom = function(a) {
                f.prototype.animateDrillupFrom.call(this, a)
            };
            a.prototype.animateDrillupTo = function(a) {
                f.prototype.animateDrillupTo.call(this, a)
            };
            a.prototype.doFullTranslate = function() {
                return this.isDirtyData || this.chart.isResizing ||
                    this.chart.renderer.isVML || !this.baseTrans
            };
            a.prototype.drawMapDataLabels = function() {
                v.prototype.drawDataLabels.call(this);
                this.dataLabelsGroup && this.dataLabelsGroup.clip(this.chart.clipRect)
            };
            a.prototype.drawPoints = function() {
                var a = this,
                    b = a.xAxis,
                    c = a.yAxis,
                    d = a.group,
                    g = a.chart,
                    k = g.renderer,
                    h = this.baseTrans;
                a.transformGroup || (a.transformGroup = k.g().attr({
                    scaleX: 1,
                    scaleY: 1
                }).add(d), a.transformGroup.survive = !0);
                if (a.doFullTranslate()) g.hasRendered && !g.styledMode && a.points.forEach(function(b) {
                    b.shapeArgs &&
                        (b.shapeArgs.fill = a.pointAttribs(b, b.state).fill)
                }), a.group = a.transformGroup, f.prototype.drawPoints.apply(a), a.group = d, a.points.forEach(function(b) {
                    if (b.graphic) {
                        var c = "";
                        b.name && (c += "highcharts-name-" + b.name.replace(/ /g, "-").toLowerCase());
                        b.properties && b.properties["hc-key"] && (c += " highcharts-key-" + b.properties["hc-key"].toLowerCase());
                        c && b.graphic.addClass(c);
                        g.styledMode && b.graphic.css(a.pointAttribs(b, b.selected && "select" || void 0))
                    }
                }), this.baseTrans = {
                    originX: b.min - b.minPixelPadding / b.transA,
                    originY: c.min - c.minPixelPadding / c.transA + (c.reversed ? 0 : c.len / c.transA),
                    transAX: b.transA,
                    transAY: c.transA
                }, this.transformGroup.animate({
                    translateX: 0,
                    translateY: 0,
                    scaleX: 1,
                    scaleY: 1
                });
                else {
                    var l = b.transA / h.transAX;
                    var n = c.transA / h.transAY;
                    var p = b.toPixels(h.originX, !0);
                    var r = c.toPixels(h.originY, !0);
                    .99 < l && 1.01 > l && .99 < n && 1.01 > n && (n = l = 1, p = Math.round(p), r = Math.round(r));
                    var u = this.transformGroup;
                    if (g.renderer.globalAnimation) {
                        var q = u.attr("translateX");
                        var t = u.attr("translateY");
                        var v = u.attr("scaleX");
                        var w = u.attr("scaleY");
                        u.attr({
                            animator: 0
                        }).animate({
                            animator: 1
                        }, {
                            step: function(a, b) {
                                u.attr({
                                    translateX: q + (p - q) * b.pos,
                                    translateY: t + (r - t) * b.pos,
                                    scaleX: v + (l - v) * b.pos,
                                    scaleY: w + (n - w) * b.pos
                                })
                            }
                        })
                    } else u.attr({
                        translateX: p,
                        translateY: r,
                        scaleX: l,
                        scaleY: n
                    })
                }
                g.styledMode || d.element.setAttribute("stroke-width", e(a.options[a.pointAttrToOptions && a.pointAttrToOptions["stroke-width"] || "borderWidth"], 1) / (l || 1));
                this.drawMapDataLabels()
            };
            a.prototype.getBox = function(a) {
                var b = Number.MAX_VALUE,
                    c = -b,
                    d = b,
                    f = -b,
                    g = b,
                    k = b,
                    h = this.xAxis,
                    l = this.yAxis,
                    m;
                (a || []).forEach(function(a) {
                    if (a.path) {
                        "string" === typeof a.path ? a.path = w(a.path) : "M" === a.path[0] && (a.path = q.prototype.pathToSegments(a.path));
                        var h = a.path || [],
                            l = -b,
                            n = b,
                            p = -b,
                            r = b,
                            u = a.properties;
                        a._foundBox || (h.forEach(function(a) {
                            var b = a[a.length - 2];
                            a = a[a.length - 1];
                            "number" === typeof b && "number" === typeof a && (n = Math.min(n, b), l = Math.max(l, b), r = Math.min(r, a), p = Math.max(p, a))
                        }), a._midX = n + (l - n) * e(a.middleX, u && u["hc-middle-x"], .5), a._midY = r + (p - r) * e(a.middleY, u && u["hc-middle-y"],
                            .5), a._maxX = l, a._minX = n, a._maxY = p, a._minY = r, a.labelrank = e(a.labelrank, (l - n) * (p - r)), a._foundBox = !0);
                        c = Math.max(c, a._maxX);
                        d = Math.min(d, a._minX);
                        f = Math.max(f, a._maxY);
                        g = Math.min(g, a._minY);
                        k = Math.min(a._maxX - a._minX, a._maxY - a._minY, k);
                        m = !0
                    }
                });
                m && (this.minY = Math.min(g, e(this.minY, b)), this.maxY = Math.max(f, e(this.maxY, -b)), this.minX = Math.min(d, e(this.minX, b)), this.maxX = Math.max(c, e(this.maxX, -b)), h && "undefined" === typeof h.options.minRange && (h.minRange = Math.min(5 * k, (this.maxX - this.minX) / 5, h.minRange || b)),
                    l && "undefined" === typeof l.options.minRange && (l.minRange = Math.min(5 * k, (this.maxY - this.minY) / 5, l.minRange || b)))
            };
            a.prototype.getExtremes = function() {
                var a = v.prototype.getExtremes.call(this, this.valueData),
                    b = a.dataMin;
                a = a.dataMax;
                this.chart.hasRendered && this.isDirtyData && this.getBox(this.options.data);
                r(b) && (this.valueMin = b);
                r(a) && (this.valueMax = a);
                return {
                    dataMin: this.minY,
                    dataMax: this.maxY
                }
            };
            a.prototype.hasData = function() {
                return !!this.processedXData.length
            };
            a.prototype.pointAttribs = function(a, b) {
                b = a.series.chart.styledMode ?
                    this.colorAttribs(a) : f.prototype.pointAttribs.call(this, a, b);
                b["stroke-width"] = e(a.options[this.pointAttrToOptions && this.pointAttrToOptions["stroke-width"] || "borderWidth"], "inherit");
                return b
            };
            a.prototype.render = function() {
                var a = this,
                    b = v.prototype.render;
                a.chart.renderer.isVML && 3E3 < a.data.length ? setTimeout(function() {
                    b.call(a)
                }) : b.call(a)
            };
            a.prototype.setData = function(a, b, c, d) {
                var e = this.options,
                    f = this.chart.options.chart,
                    g = f && f.map,
                    h = e.mapData,
                    m = this.joinBy,
                    p = e.keys || this.pointArrayMap,
                    q = [],
                    t = {},
                    w = this.chart.mapTransforms;
                !h && g && (h = "string" === typeof g ? k[g] : g);
                a && a.forEach(function(b, c) {
                    var d = 0;
                    if (r(b)) a[c] = {
                        value: b
                    };
                    else if (L(b)) {
                        a[c] = {};
                        !e.keys && b.length > p.length && "string" === typeof b[0] && (a[c]["hc-key"] = b[0], ++d);
                        for (var f = 0; f < p.length; ++f, ++d) p[f] && "undefined" !== typeof b[d] && (0 < p[f].indexOf(".") ? z.prototype.setNestedProperty(a[c], b[d], p[f]) : a[c][p[f]] = b[d])
                    }
                    m && "_i" === m[0] && (a[c]._i = c)
                });
                this.getBox(a);
                (this.chart.mapTransforms = w = f && f.mapTransforms || h && h["hc-transform"] || w) && u(w, function(a) {
                    a.rotation &&
                        (a.cosAngle = Math.cos(a.rotation), a.sinAngle = Math.sin(a.rotation))
                });
                if (h) {
                    "FeatureCollection" === h.type && (this.mapTitle = h.title, h = l.geojson(h, this.type, this));
                    this.mapData = h;
                    this.mapMap = {};
                    for (w = 0; w < h.length; w++) f = h[w], g = f.properties, f._i = w, m[0] && g && g[m[0]] && (f[m[0]] = g[m[0]]), t[f[m[0]]] = f;
                    this.mapMap = t;
                    if (a && m[1]) {
                        var x = m[1];
                        a.forEach(function(a) {
                            a = K(x, a);
                            t[a] && q.push(t[a])
                        })
                    }
                    if (e.allAreas) {
                        this.getBox(h);
                        a = a || [];
                        if (m[1]) {
                            var A = m[1];
                            a.forEach(function(a) {
                                q.push(K(A, a))
                            })
                        }
                        q = "|" + q.map(function(a) {
                            return a &&
                                a[m[0]]
                        }).join("|") + "|";
                        h.forEach(function(b) {
                            m[0] && -1 !== q.indexOf("|" + b[m[0]] + "|") || (a.push(n(b, {
                                value: null
                            })), d = !1)
                        })
                    } else this.getBox(q)
                }
                v.prototype.setData.call(this, a, b, c, d)
            };
            a.prototype.setOptions = function(a) {
                a = v.prototype.setOptions.call(this, a);
                var b = a.joinBy;
                null === b && (b = "_i");
                b = this.joinBy = g(b);
                b[1] || (b[1] = b[0]);
                return a
            };
            a.prototype.translate = function() {
                var a = this,
                    b = a.xAxis,
                    c = a.yAxis,
                    d = a.doFullTranslate();
                a.generatePoints();
                a.data.forEach(function(e) {
                    r(e._midX) && r(e._midY) && (e.plotX = b.toPixels(e._midX,
                        !0), e.plotY = c.toPixels(e._midY, !0));
                    d && (e.shapeType = "path", e.shapeArgs = {
                        d: a.translatePath(e.path)
                    })
                });
                x(a, "afterTranslate")
            };
            a.prototype.translatePath = function(a) {
                var b = this.xAxis,
                    c = this.yAxis,
                    d = b.min,
                    e = b.transA,
                    f = b.minPixelPadding,
                    g = c.min,
                    k = c.transA,
                    h = c.minPixelPadding,
                    l = [];
                a && a.forEach(function(a) {
                    "M" === a[0] ? l.push(["M", (a[1] - (d || 0)) * e + f, (a[2] - (g || 0)) * k + h]) : "L" === a[0] ? l.push(["L", (a[1] - (d || 0)) * e + f, (a[2] - (g || 0)) * k + h]) : "C" === a[0] ? l.push(["C", (a[1] - (d || 0)) * e + f, (a[2] - (g || 0)) * k + h, (a[3] - (d || 0)) * e + f, (a[4] -
                        (g || 0)) * k + h, (a[5] - (d || 0)) * e + f, (a[6] - (g || 0)) * k + h]) : "Q" === a[0] ? l.push(["Q", (a[1] - (d || 0)) * e + f, (a[2] - (g || 0)) * k + h, (a[3] - (d || 0)) * e + f, (a[4] - (g || 0)) * k + h]) : "Z" === a[0] && l.push(["Z"])
                });
                return l
            };
            a.defaultOptions = n(H.defaultOptions, {
                animation: !1,
                dataLabels: {
                    crop: !1,
                    formatter: function() {
                        return this.point.value
                    },
                    inside: !0,
                    overflow: !1,
                    padding: 0,
                    verticalAlign: "middle"
                },
                marker: null,
                nullColor: C.neutralColor3,
                stickyTracking: !1,
                tooltip: {
                    followPointer: !0,
                    pointFormat: "{point.name}: {point.value}<br/>"
                },
                turboThreshold: 0,
                allAreas: !0,
                borderColor: C.neutralColor20,
                borderWidth: 1,
                joinBy: "hc-key",
                states: {
                    hover: {
                        halo: null,
                        brightness: .2
                    },
                    normal: {
                        animation: !0
                    },
                    select: {
                        color: C.neutralColor20
                    },
                    inactive: {
                        opacity: 1
                    }
                }
            });
            return a
        }(H);
        y(h.prototype, {
            type: "map",
            axisTypes: b.axisTypes,
            colorAttribs: b.colorAttribs,
            colorKey: b.colorKey,
            directTouch: !0,
            drawDataLabels: p,
            drawGraph: p,
            drawLegendSymbol: B.drawRectangle,
            forceDL: !0,
            getExtremesFromAll: !0,
            getSymbol: b.getSymbol,
            parallelArrays: b.parallelArrays,
            pointArrayMap: b.pointArrayMap,
            pointClass: z,
            preserveAspectRatio: !0,
            searchPoint: p,
            trackerGroups: b.trackerGroups,
            useMapGeometry: !0
        });
        t.registerSeriesType("map", h);
        "";
        return h
    });
    J(b, "Series/MapLine/MapLineSeries.js", [b["Series/Map/MapSeries.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B) {
        var w = this && this.__extends || function() {
                var b = function(l, h) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, h) {
                        b.__proto__ = h
                    } || function(b, h) {
                        for (var c in h) h.hasOwnProperty(c) && (b[c] = h[c])
                    };
                    return b(l, h)
                };
                return function(l,
                    h) {
                    function c() {
                        this.constructor = l
                    }
                    b(l, h);
                    l.prototype = null === h ? Object.create(h) : (c.prototype = h.prototype, new c)
                }
            }(),
            z = l.series,
            C = B.extend,
            v = B.merge;
        B = function(l) {
            function q() {
                var b = null !== l && l.apply(this, arguments) || this;
                b.data = void 0;
                b.options = void 0;
                b.points = void 0;
                return b
            }
            w(q, l);
            q.prototype.pointAttribs = function(h, c) {
                h = b.prototype.pointAttribs.call(this, h, c);
                h.fill = this.options.fillColor;
                return h
            };
            q.defaultOptions = v(b.defaultOptions, {
                lineWidth: 1,
                fillColor: "none"
            });
            return q
        }(b);
        C(B.prototype, {
            type: "mapline",
            colorProp: "stroke",
            drawLegendSymbol: z.prototype.drawLegendSymbol,
            pointAttrToOptions: {
                stroke: "color",
                "stroke-width": "lineWidth"
            }
        });
        l.registerSeriesType("mapline", B);
        "";
        return B
    });
    J(b, "Series/MapPoint/MapPointPoint.js", [b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l) {
        var w = this && this.__extends || function() {
                var b = function(l, v) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, l) {
                        b.__proto__ = l
                    } || function(b, l) {
                        for (var h in l) l.hasOwnProperty(h) && (b[h] = l[h])
                    };
                    return b(l,
                        v)
                };
                return function(l, v) {
                    function t() {
                        this.constructor = l
                    }
                    b(l, v);
                    l.prototype = null === v ? Object.create(v) : (t.prototype = v.prototype, new t)
                }
            }(),
            y = l.merge;
        return function(b) {
            function l() {
                var l = null !== b && b.apply(this, arguments) || this;
                l.options = void 0;
                l.series = void 0;
                return l
            }
            w(l, b);
            l.prototype.applyOptions = function(l, t) {
                l = "undefined" !== typeof l.lat && "undefined" !== typeof l.lon ? y(l, this.series.chart.fromLatLonToPoint(l)) : l;
                return b.prototype.applyOptions.call(this, l, t)
            };
            return l
        }(b.seriesTypes.scatter.prototype.pointClass)
    });
    J(b, "Series/MapPoint/MapPointSeries.js", [b["Series/MapPoint/MapPointPoint.js"], b["Core/Color/Palette.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B, y) {
        var w = this && this.__extends || function() {
                var b = function(h, c) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, c) {
                        b.__proto__ = c
                    } || function(b, c) {
                        for (var k in c) c.hasOwnProperty(k) && (b[k] = c[k])
                    };
                    return b(h, c)
                };
                return function(h, c) {
                    function l() {
                        this.constructor = h
                    }
                    b(h, c);
                    h.prototype = null === c ? Object.create(c) :
                        (l.prototype = c.prototype, new l)
                }
            }(),
            C = B.seriesTypes.scatter,
            v = y.extend,
            t = y.merge;
        y = function(b) {
            function h() {
                var c = null !== b && b.apply(this, arguments) || this;
                c.data = void 0;
                c.options = void 0;
                c.points = void 0;
                return c
            }
            w(h, b);
            h.prototype.drawDataLabels = function() {
                b.prototype.drawDataLabels.call(this);
                this.dataLabelsGroup && this.dataLabelsGroup.clip(this.chart.clipRect)
            };
            h.defaultOptions = t(C.defaultOptions, {
                dataLabels: {
                    crop: !1,
                    defer: !1,
                    enabled: !0,
                    formatter: function() {
                        return this.point.name
                    },
                    overflow: !1,
                    style: {
                        color: l.neutralColor100
                    }
                }
            });
            return h
        }(C);
        v(y.prototype, {
            type: "mappoint",
            forceDL: !0,
            pointClass: b
        });
        B.registerSeriesType("mappoint", y);
        "";
        return y
    });
    J(b, "Series/Bubble/BubblePoint.js", [b["Core/Series/Point.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]], function(b, l, B) {
        var w = this && this.__extends || function() {
            var b = function(l, v) {
                b = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function(b, l) {
                    b.__proto__ = l
                } || function(b, l) {
                    for (var h in l) l.hasOwnProperty(h) && (b[h] = l[h])
                };
                return b(l, v)
            };
            return function(l, v) {
                function t() {
                    this.constructor =
                        l
                }
                b(l, v);
                l.prototype = null === v ? Object.create(v) : (t.prototype = v.prototype, new t)
            }
        }();
        B = B.extend;
        l = function(l) {
            function z() {
                var b = null !== l && l.apply(this, arguments) || this;
                b.options = void 0;
                b.series = void 0;
                return b
            }
            w(z, l);
            z.prototype.haloPath = function(l) {
                return b.prototype.haloPath.call(this, 0 === l ? 0 : (this.marker ? this.marker.radius || 0 : 0) + l)
            };
            return z
        }(l.seriesTypes.scatter.prototype.pointClass);
        B(l.prototype, {
            ttBelow: !1
        });
        return l
    });
    J(b, "Series/Bubble/BubbleLegend.js", [b["Core/Chart/Chart.js"], b["Core/Color/Color.js"],
        b["Core/Globals.js"], b["Core/Legend.js"], b["Core/Color/Palette.js"], b["Core/Series/Series.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C, v) {
        var t = l.parse,
            q = B.noop;
        l = v.addEvent;
        var h = v.arrayMax,
            c = v.arrayMin,
            p = v.isNumber,
            k = v.merge,
            w = v.objectEach,
            f = v.pick,
            H = v.setOptions,
            x = v.stableSort,
            K = v.wrap;
        "";
        H({
            legend: {
                bubbleLegend: {
                    borderColor: void 0,
                    borderWidth: 2,
                    className: void 0,
                    color: void 0,
                    connectorClassName: void 0,
                    connectorColor: void 0,
                    connectorDistance: 60,
                    connectorWidth: 1,
                    enabled: !1,
                    labels: {
                        className: void 0,
                        allowOverlap: !1,
                        format: "",
                        formatter: void 0,
                        align: "right",
                        style: {
                            fontSize: 10,
                            color: void 0
                        },
                        x: 0,
                        y: 0
                    },
                    maxSize: 60,
                    minSize: 10,
                    legendIndex: 0,
                    ranges: {
                        value: void 0,
                        borderColor: void 0,
                        color: void 0,
                        connectorColor: void 0
                    },
                    sizeBy: "area",
                    sizeByAbsoluteValue: !1,
                    zIndex: 1,
                    zThreshold: 0
                }
            }
        });
        H = function() {
            function b(b, c) {
                this.options = this.symbols = this.visible = this.ranges = this.movementX = this.maxLabel = this.legendSymbol = this.legendItemWidth = this.legendItemHeight = this.legendItem = this.legendGroup = this.legend = this.fontMetrics =
                    this.chart = void 0;
                this.setState = q;
                this.init(b, c)
            }
            b.prototype.init = function(b, c) {
                this.options = b;
                this.visible = !0;
                this.chart = c.chart;
                this.legend = c
            };
            b.prototype.addToLegend = function(b) {
                b.splice(this.options.legendIndex, 0, this)
            };
            b.prototype.drawLegendSymbol = function(b) {
                var c = this.chart,
                    k = this.options,
                    e = f(b.options.itemDistance, 20),
                    g = k.ranges;
                var d = k.connectorDistance;
                this.fontMetrics = c.renderer.fontMetrics(k.labels.style.fontSize.toString() + "px");
                g && g.length && p(g[0].value) ? (x(g, function(a, b) {
                    return b.value -
                        a.value
                }), this.ranges = g, this.setOptions(), this.render(), c = this.getMaxLabelSize(), g = this.ranges[0].radius, b = 2 * g, d = d - g + c.width, d = 0 < d ? d : 0, this.maxLabel = c, this.movementX = "left" === k.labels.align ? d : 0, this.legendItemWidth = b + d + e, this.legendItemHeight = b + this.fontMetrics.h / 2) : b.options.bubbleLegend.autoRanges = !0
            };
            b.prototype.setOptions = function() {
                var b = this.ranges,
                    c = this.options,
                    h = this.chart.series[c.seriesIndex],
                    e = this.legend.baseline,
                    g = {
                        "z-index": c.zIndex,
                        "stroke-width": c.borderWidth
                    },
                    d = {
                        "z-index": c.zIndex,
                        "stroke-width": c.connectorWidth
                    },
                    a = this.getLabelStyles(),
                    l = h.options.marker.fillOpacity,
                    p = this.chart.styledMode;
                b.forEach(function(m, n) {
                    p || (g.stroke = f(m.borderColor, c.borderColor, h.color), g.fill = f(m.color, c.color, 1 !== l ? t(h.color).setOpacity(l).get("rgba") : h.color), d.stroke = f(m.connectorColor, c.connectorColor, h.color));
                    b[n].radius = this.getRangeRadius(m.value);
                    b[n] = k(b[n], {
                        center: b[0].radius - b[n].radius + e
                    });
                    p || k(!0, b[n], {
                        bubbleStyle: k(!1, g),
                        connectorStyle: k(!1, d),
                        labelStyle: a
                    })
                }, this)
            };
            b.prototype.getLabelStyles =
                function() {
                    var b = this.options,
                        c = {},
                        h = "left" === b.labels.align,
                        e = this.legend.options.rtl;
                    w(b.labels.style, function(b, d) {
                        "color" !== d && "fontSize" !== d && "z-index" !== d && (c[d] = b)
                    });
                    return k(!1, c, {
                        "font-size": b.labels.style.fontSize,
                        fill: f(b.labels.style.color, z.neutralColor100),
                        "z-index": b.zIndex,
                        align: e || h ? "right" : "left"
                    })
                };
            b.prototype.getRangeRadius = function(b) {
                var c = this.options;
                return this.chart.series[this.options.seriesIndex].getRadius.call(this, c.ranges[c.ranges.length - 1].value, c.ranges[0].value, c.minSize,
                    c.maxSize, b)
            };
            b.prototype.render = function() {
                var b = this.chart.renderer,
                    c = this.options.zThreshold;
                this.symbols || (this.symbols = {
                    connectors: [],
                    bubbleItems: [],
                    labels: []
                });
                this.legendSymbol = b.g("bubble-legend");
                this.legendItem = b.g("bubble-legend-item");
                this.legendSymbol.translateX = 0;
                this.legendSymbol.translateY = 0;
                this.ranges.forEach(function(b) {
                    b.value >= c && this.renderRange(b)
                }, this);
                this.legendSymbol.add(this.legendItem);
                this.legendItem.add(this.legendGroup);
                this.hideOverlappingLabels()
            };
            b.prototype.renderRange =
                function(b) {
                    var c = this.options,
                        f = c.labels,
                        e = this.chart.renderer,
                        g = this.symbols,
                        d = g.labels,
                        a = b.center,
                        k = Math.abs(b.radius),
                        h = c.connectorDistance || 0,
                        l = f.align,
                        p = f.style.fontSize;
                    h = this.legend.options.rtl || "left" === l ? -h : h;
                    f = c.connectorWidth;
                    var r = this.ranges[0].radius || 0,
                        q = a - k - c.borderWidth / 2 + f / 2;
                    p = p / 2 - (this.fontMetrics.h - p) / 2;
                    var t = e.styledMode;
                    "center" === l && (h = 0, c.connectorDistance = 0, b.labelStyle.align = "center");
                    l = q + c.labels.y;
                    var v = r + h + c.labels.x;
                    g.bubbleItems.push(e.circle(r, a + ((q % 1 ? 1 : .5) - (f % 2 ? 0 :
                        .5)), k).attr(t ? {} : b.bubbleStyle).addClass((t ? "highcharts-color-" + this.options.seriesIndex + " " : "") + "highcharts-bubble-legend-symbol " + (c.className || "")).add(this.legendSymbol));
                    g.connectors.push(e.path(e.crispLine([
                        ["M", r, q],
                        ["L", r + h, q]
                    ], c.connectorWidth)).attr(t ? {} : b.connectorStyle).addClass((t ? "highcharts-color-" + this.options.seriesIndex + " " : "") + "highcharts-bubble-legend-connectors " + (c.connectorClassName || "")).add(this.legendSymbol));
                    b = e.text(this.formatLabel(b), v, l + p).attr(t ? {} : b.labelStyle).addClass("highcharts-bubble-legend-labels " +
                        (c.labels.className || "")).add(this.legendSymbol);
                    d.push(b);
                    b.placed = !0;
                    b.alignAttr = {
                        x: v,
                        y: l + p
                    }
                };
            b.prototype.getMaxLabelSize = function() {
                var b, c;
                this.symbols.labels.forEach(function(f) {
                    c = f.getBBox(!0);
                    b = b ? c.width > b.width ? c : b : c
                });
                return b || {}
            };
            b.prototype.formatLabel = function(b) {
                var c = this.options,
                    f = c.labels.formatter;
                c = c.labels.format;
                var e = this.chart.numberFormatter;
                return c ? v.format(c, b) : f ? f.call(b) : e(b.value, 1)
            };
            b.prototype.hideOverlappingLabels = function() {
                var b = this.chart,
                    c = this.symbols;
                !this.options.labels.allowOverlap &&
                    c && (b.hideOverlappingLabels(c.labels), c.labels.forEach(function(b, e) {
                        b.newOpacity ? b.newOpacity !== b.oldOpacity && c.connectors[e].show() : c.connectors[e].hide()
                    }))
            };
            b.prototype.getRanges = function() {
                var b = this.legend.bubbleLegend,
                    l = b.options.ranges,
                    u, e = Number.MAX_VALUE,
                    g = -Number.MAX_VALUE;
                b.chart.series.forEach(function(a) {
                    a.isBubble && !a.ignoreSeries && (u = a.zData.filter(p), u.length && (e = f(a.options.zMin, Math.min(e, Math.max(c(u), !1 === a.options.displayNegative ? a.options.zThreshold : -Number.MAX_VALUE))), g = f(a.options.zMax,
                        Math.max(g, h(u)))))
                });
                var d = e === g ? [{
                    value: g
                }] : [{
                    value: e
                }, {
                    value: (e + g) / 2
                }, {
                    value: g,
                    autoRanges: !0
                }];
                l.length && l[0].radius && d.reverse();
                d.forEach(function(a, b) {
                    l && l[b] && (d[b] = k(!1, l[b], a))
                });
                return d
            };
            b.prototype.predictBubbleSizes = function() {
                var b = this.chart,
                    c = this.fontMetrics,
                    f = b.legend.options,
                    e = "horizontal" === f.layout,
                    g = e ? b.legend.lastLineHeight : 0,
                    d = b.plotSizeX,
                    a = b.plotSizeY,
                    h = b.series[this.options.seriesIndex];
                b = Math.ceil(h.minPxSize);
                var k = Math.ceil(h.maxPxSize);
                h = h.options.maxSize;
                var l = Math.min(a,
                    d);
                if (f.floating || !/%$/.test(h)) c = k;
                else if (h = parseFloat(h), c = (l + g - c.h / 2) * h / 100 / (h / 100 + 1), e && a - c >= d || !e && d - c >= a) c = k;
                return [b, Math.ceil(c)]
            };
            b.prototype.updateRanges = function(b, c) {
                var f = this.legend.options.bubbleLegend;
                f.minSize = b;
                f.maxSize = c;
                f.ranges = this.getRanges()
            };
            b.prototype.correctSizes = function() {
                var b = this.legend,
                    c = this.chart.series[this.options.seriesIndex];
                1 < Math.abs(Math.ceil(c.maxPxSize) - this.options.maxSize) && (this.updateRanges(this.options.minSize, c.maxPxSize), b.render())
            };
            return b
        }();
        l(y, "afterGetAllItems", function(b) {
            var c = this.bubbleLegend,
                f = this.options,
                h = f.bubbleLegend,
                e = this.chart.getVisibleBubbleSeriesIndex();
            c && c.ranges && c.ranges.length && (h.ranges.length && (h.autoRanges = !!h.ranges[0].autoRanges), this.destroyItem(c));
            0 <= e && f.enabled && h.enabled && (h.seriesIndex = e, this.bubbleLegend = new B.BubbleLegend(h, this), this.bubbleLegend.addToLegend(b.allItems))
        });
        b.prototype.getVisibleBubbleSeriesIndex = function() {
            for (var b = this.series, c = 0; c < b.length;) {
                if (b[c] && b[c].isBubble && b[c].visible &&
                    b[c].zData.length) return c;
                c++
            }
            return -1
        };
        y.prototype.getLinesHeights = function() {
            var b = this.allItems,
                c = [],
                f = b.length,
                h, e = 0;
            for (h = 0; h < f; h++)
                if (b[h].legendItemHeight && (b[h].itemHeight = b[h].legendItemHeight), b[h] === b[f - 1] || b[h + 1] && b[h]._legendItemPos[1] !== b[h + 1]._legendItemPos[1]) {
                    c.push({
                        height: 0
                    });
                    var g = c[c.length - 1];
                    for (e; e <= h; e++) b[e].itemHeight > g.height && (g.height = b[e].itemHeight);
                    g.step = h
                } return c
        };
        y.prototype.retranslateItems = function(b) {
            var c, f, h, e = this.options.rtl,
                g = 0;
            this.allItems.forEach(function(d,
                a) {
                c = d.legendGroup.translateX;
                f = d._legendItemPos[1];
                if ((h = d.movementX) || e && d.ranges) h = e ? c - d.options.maxSize / 2 : c + h, d.legendGroup.attr({
                    translateX: h
                });
                a > b[g].step && g++;
                d.legendGroup.attr({
                    translateY: Math.round(f + b[g].height / 2)
                });
                d._legendItemPos[1] = f + b[g].height / 2
            })
        };
        l(C, "legendItemClick", function() {
            var b = this.chart,
                c = this.visible,
                f = this.chart.legend;
            f && f.bubbleLegend && (this.visible = !c, this.ignoreSeries = c, b = 0 <= b.getVisibleBubbleSeriesIndex(), f.bubbleLegend.visible !== b && (f.update({
                    bubbleLegend: {
                        enabled: b
                    }
                }),
                f.bubbleLegend.visible = b), this.visible = c)
        });
        K(b.prototype, "drawChartBox", function(b, c, f) {
            var h = this.legend,
                e = 0 <= this.getVisibleBubbleSeriesIndex();
            if (h && h.options.enabled && h.bubbleLegend && h.options.bubbleLegend.autoRanges && e) {
                var g = h.bubbleLegend.options;
                e = h.bubbleLegend.predictBubbleSizes();
                h.bubbleLegend.updateRanges(e[0], e[1]);
                g.placed || (h.group.placed = !1, h.allItems.forEach(function(b) {
                    b.legendGroup.translateY = null
                }));
                h.render();
                this.getMargins();
                this.axes.forEach(function(b) {
                    b.visible && b.render();
                    g.placed || (b.setScale(), b.updateNames(), w(b.ticks, function(a) {
                        a.isNew = !0;
                        a.isNewLabel = !0
                    }))
                });
                g.placed = !0;
                this.getMargins();
                b.call(this, c, f);
                h.bubbleLegend.correctSizes();
                h.retranslateItems(h.getLinesHeights())
            } else b.call(this, c, f), h && h.options.enabled && h.bubbleLegend && (h.render(), h.retranslateItems(h.getLinesHeights()))
        });
        B.BubbleLegend = H;
        return B.BubbleLegend
    });
    J(b, "Series/Bubble/BubbleSeries.js", [b["Core/Axis/Axis.js"], b["Series/Bubble/BubblePoint.js"], b["Core/Color/Color.js"], b["Core/Globals.js"],
        b["Core/Series/Series.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z, C, v) {
        var t = this && this.__extends || function() {
                var b = function(c, f) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, c) {
                        b.__proto__ = c
                    } || function(b, c) {
                        for (var d in c) c.hasOwnProperty(d) && (b[d] = c[d])
                    };
                    return b(c, f)
                };
                return function(c, f) {
                    function e() {
                        this.constructor = c
                    }
                    b(c, f);
                    c.prototype = null === f ? Object.create(f) : (e.prototype = f.prototype, new e)
                }
            }(),
            q = B.parse;
        B = y.noop;
        var h = C.seriesTypes;
        y = h.column;
        var c = h.scatter,
            p = v.arrayMax,
            k = v.arrayMin,
            w = v.clamp,
            f = v.extend,
            H = v.isNumber,
            x = v.merge,
            K = v.pick,
            L = v.pInt;
        v = function(b) {
            function h() {
                var c = null !== b && b.apply(this, arguments) || this;
                c.data = void 0;
                c.maxPxSize = void 0;
                c.minPxSize = void 0;
                c.options = void 0;
                c.points = void 0;
                c.radii = void 0;
                c.yData = void 0;
                c.zData = void 0;
                return c
            }
            t(h, b);
            h.prototype.animate = function(b) {
                !b && this.points.length < this.options.animationLimit && this.points.forEach(function(b) {
                    var c = b.graphic;
                    c && c.width && (this.hasRendered || c.attr({
                        x: b.plotX,
                        y: b.plotY,
                        width: 1,
                        height: 1
                    }), c.animate(this.markerAttribs(b), this.options.animation))
                }, this)
            };
            h.prototype.getRadii = function(b, c, f) {
                var d = this.zData,
                    a = this.yData,
                    e = f.minPxSize,
                    g = f.maxPxSize,
                    h = [];
                var k = 0;
                for (f = d.length; k < f; k++) {
                    var l = d[k];
                    h.push(this.getRadius(b, c, e, g, l, a[k]))
                }
                this.radii = h
            };
            h.prototype.getRadius = function(b, c, f, d, a, h) {
                var e = this.options,
                    g = "width" !== e.sizeBy,
                    k = e.zThreshold,
                    l = c - b,
                    m = .5;
                if (null === h || null === a) return null;
                if (H(a)) {
                    e.sizeByAbsoluteValue && (a = Math.abs(a - k), l = Math.max(c - k, Math.abs(b -
                        k)), b = 0);
                    if (a < b) return f / 2 - 1;
                    0 < l && (m = (a - b) / l)
                }
                g && 0 <= m && (m = Math.sqrt(m));
                return Math.ceil(f + m * (d - f)) / 2
            };
            h.prototype.hasData = function() {
                return !!this.processedXData.length
            };
            h.prototype.pointAttribs = function(b, c) {
                var e = this.options.marker.fillOpacity;
                b = z.prototype.pointAttribs.call(this, b, c);
                1 !== e && (b.fill = q(b.fill).setOpacity(e).get("rgba"));
                return b
            };
            h.prototype.translate = function() {
                var c, e = this.data,
                    g = this.radii;
                b.prototype.translate.call(this);
                for (c = e.length; c--;) {
                    var d = e[c];
                    var a = g ? g[c] : 0;
                    H(a) &&
                        a >= this.minPxSize / 2 ? (d.marker = f(d.marker, {
                            radius: a,
                            width: 2 * a,
                            height: 2 * a
                        }), d.dlBox = {
                            x: d.plotX - a,
                            y: d.plotY - a,
                            width: 2 * a,
                            height: 2 * a
                        }) : d.shapeArgs = d.plotY = d.dlBox = void 0
                }
            };
            h.defaultOptions = x(c.defaultOptions, {
                dataLabels: {
                    formatter: function() {
                        return this.point.z
                    },
                    inside: !0,
                    verticalAlign: "middle"
                },
                animationLimit: 250,
                marker: {
                    lineColor: null,
                    lineWidth: 1,
                    fillOpacity: .5,
                    radius: null,
                    states: {
                        hover: {
                            radiusPlus: 0
                        }
                    },
                    symbol: "circle"
                },
                minSize: 8,
                maxSize: "20%",
                softThreshold: !1,
                states: {
                    hover: {
                        halo: {
                            size: 5
                        }
                    }
                },
                tooltip: {
                    pointFormat: "({point.x}, {point.y}), Size: {point.z}"
                },
                turboThreshold: 0,
                zThreshold: 0,
                zoneAxis: "z"
            });
            return h
        }(c);
        f(v.prototype, {
            alignDataLabel: y.prototype.alignDataLabel,
            applyZones: B,
            bubblePadding: !0,
            buildKDTree: B,
            directTouch: !0,
            isBubble: !0,
            pointArrayMap: ["y", "z"],
            pointClass: l,
            parallelArrays: ["x", "y", "z"],
            trackerGroups: ["group", "dataLabelsGroup"],
            specialGroup: "group",
            zoneAxis: "z"
        });
        b.prototype.beforePadding = function() {
            var b = this,
                c = this.len,
                f = this.chart,
                e = 0,
                g = c,
                d = this.isXAxis,
                a = d ? "xData" : "yData",
                h = this.min,
                l = {},
                q = Math.min(f.plotWidth, f.plotHeight),
                t = Number.MAX_VALUE,
                v = -Number.MAX_VALUE,
                x = this.max - h,
                z = c / x,
                y = [];
            this.series.forEach(function(a) {
                var c = a.options;
                !a.bubblePadding || !a.visible && f.options.chart.ignoreHiddenSeries || (b.allowZoomOutside = !0, y.push(a), d && (["minSize", "maxSize"].forEach(function(a) {
                    var b = c[a],
                        d = /%$/.test(b);
                    b = L(b);
                    l[a] = d ? q * b / 100 : b
                }), a.minPxSize = l.minSize, a.maxPxSize = Math.max(l.maxSize, l.minSize), a = a.zData.filter(H), a.length && (t = K(c.zMin, w(k(a), !1 === c.displayNegative ? c.zThreshold : -Number.MAX_VALUE, t)), v = K(c.zMax, Math.max(v, p(a))))))
            });
            y.forEach(function(c) {
                var f =
                    c[a],
                    k = f.length;
                d && c.getRadii(t, v, c);
                if (0 < x)
                    for (; k--;)
                        if (H(f[k]) && b.dataMin <= f[k] && f[k] <= b.max) {
                            var l = c.radii ? c.radii[k] : 0;
                            e = Math.min((f[k] - h) * z - l, e);
                            g = Math.max((f[k] - h) * z + l, g)
                        }
            });
            y.length && 0 < x && !this.logarithmic && (g -= c, z *= (c + Math.max(0, e) - Math.min(g, c)) / c, [
                ["min", "userMin", e],
                ["max", "userMax", g]
            ].forEach(function(a) {
                "undefined" === typeof K(b.options[a[0]], b[a[1]]) && (b[a[0]] += a[2] / z)
            }))
        };
        C.registerSeriesType("bubble", v);
        "";
        "";
        return v
    });
    J(b, "Series/MapBubble/MapBubblePoint.js", [b["Core/Series/SeriesRegistry.js"],
        b["Core/Utilities.js"]
    ], function(b, l) {
        var w = this && this.__extends || function() {
                var b = function(l, q) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, c) {
                        b.__proto__ = c
                    } || function(b, c) {
                        for (var h in c) c.hasOwnProperty(h) && (b[h] = c[h])
                    };
                    return b(l, q)
                };
                return function(l, q) {
                    function h() {
                        this.constructor = l
                    }
                    b(l, q);
                    l.prototype = null === q ? Object.create(q) : (h.prototype = q.prototype, new h)
                }
            }(),
            y = b.seriesTypes,
            z = y.map;
        b = l.extend;
        var C = l.merge;
        l = function(b) {
            function l() {
                return null !== b && b.apply(this,
                    arguments) || this
            }
            w(l, b);
            l.prototype.applyOptions = function(l, h) {
                return l && "undefined" !== typeof l.lat && "undefined" !== typeof l.lon ? b.prototype.applyOptions.call(this, C(l, this.series.chart.fromLatLonToPoint(l)), h) : z.prototype.pointClass.prototype.applyOptions.call(this, l, h)
            };
            l.prototype.isValid = function() {
                return "number" === typeof this.z
            };
            return l
        }(y.bubble.prototype.pointClass);
        b(l.prototype, {
            ttBelow: !1
        });
        return l
    });
    J(b, "Series/MapBubble/MapBubbleSeries.js", [b["Series/Bubble/BubbleSeries.js"], b["Series/MapBubble/MapBubblePoint.js"],
        b["Series/Map/MapSeries.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]
    ], function(b, l, B, y, z) {
        var w = this && this.__extends || function() {
                var b = function(h, c) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, c) {
                        b.__proto__ = c
                    } || function(b, c) {
                        for (var h in c) c.hasOwnProperty(h) && (b[h] = c[h])
                    };
                    return b(h, c)
                };
                return function(h, c) {
                    function l() {
                        this.constructor = h
                    }
                    b(h, c);
                    h.prototype = null === c ? Object.create(c) : (l.prototype = c.prototype, new l)
                }
            }(),
            v = z.extend,
            t = z.merge;
        z = function(l) {
            function h() {
                var b =
                    null !== l && l.apply(this, arguments) || this;
                b.data = void 0;
                b.options = void 0;
                b.points = void 0;
                return b
            }
            w(h, l);
            h.defaultOptions = t(b.defaultOptions, {
                animationLimit: 500,
                tooltip: {
                    pointFormat: "{point.name}: {point.z}"
                }
            });
            return h
        }(b);
        v(z.prototype, {
            type: "mapbubble",
            getBox: B.prototype.getBox,
            pointArrayMap: ["z"],
            pointClass: l,
            setData: B.prototype.setData,
            setOptions: B.prototype.setOptions,
            xyFromShape: !0
        });
        y.registerSeriesType("mapbubble", z);
        "";
        return z
    });
    J(b, "Series/Heatmap/HeatmapPoint.js", [b["Mixins/ColorMapSeries.js"],
        b["Core/Series/SeriesRegistry.js"], b["Core/Utilities.js"]
    ], function(b, l, B) {
        var w = this && this.__extends || function() {
            var b = function(l, h) {
                b = Object.setPrototypeOf || {
                    __proto__: []
                }
                instanceof Array && function(b, h) {
                    b.__proto__ = h
                } || function(b, h) {
                    for (var c in h) h.hasOwnProperty(c) && (b[c] = h[c])
                };
                return b(l, h)
            };
            return function(l, h) {
                function c() {
                    this.constructor = l
                }
                b(l, h);
                l.prototype = null === h ? Object.create(h) : (c.prototype = h.prototype, new c)
            }
        }();
        b = b.colorMapPointMixin;
        var z = B.clamp,
            C = B.extend,
            v = B.pick;
        l = function(b) {
            function l() {
                var h =
                    null !== b && b.apply(this, arguments) || this;
                h.options = void 0;
                h.series = void 0;
                h.value = void 0;
                h.x = void 0;
                h.y = void 0;
                return h
            }
            w(l, b);
            l.prototype.applyOptions = function(h, c) {
                h = b.prototype.applyOptions.call(this, h, c);
                h.formatPrefix = h.isNull || null === h.value ? "null" : "point";
                return h
            };
            l.prototype.getCellAttributes = function() {
                var b = this.series,
                    c = b.options,
                    l = (c.colsize || 1) / 2,
                    k = (c.rowsize || 1) / 2,
                    q = b.xAxis,
                    f = b.yAxis,
                    t = this.options.marker || b.options.marker;
                b = b.pointPlacementToXValue();
                var w = v(this.pointPadding, c.pointPadding,
                        0),
                    y = {
                        x1: z(Math.round(q.len - (q.translate(this.x - l, !1, !0, !1, !0, -b) || 0)), -q.len, 2 * q.len),
                        x2: z(Math.round(q.len - (q.translate(this.x + l, !1, !0, !1, !0, -b) || 0)), -q.len, 2 * q.len),
                        y1: z(Math.round(f.translate(this.y - k, !1, !0, !1, !0) || 0), -f.len, 2 * f.len),
                        y2: z(Math.round(f.translate(this.y + k, !1, !0, !1, !0) || 0), -f.len, 2 * f.len)
                    };
                [
                    ["width", "x"],
                    ["height", "y"]
                ].forEach(function(b) {
                    var c = b[0];
                    b = b[1];
                    var f = b + "1",
                        h = b + "2",
                        e = Math.abs(y[f] - y[h]),
                        g = t && t.lineWidth || 0,
                        d = Math.abs(y[f] + y[h]) / 2;
                    t[c] && t[c] < e && (y[f] = d - t[c] / 2 - g / 2, y[h] =
                        d + t[c] / 2 + g / 2);
                    w && ("y" === b && (f = h, h = b + "1"), y[f] += w, y[h] -= w)
                });
                return y
            };
            l.prototype.haloPath = function(b) {
                if (!b) return [];
                var c = this.shapeArgs;
                return ["M", c.x - b, c.y - b, "L", c.x - b, c.y + c.height + b, c.x + c.width + b, c.y + c.height + b, c.x + c.width + b, c.y - b, "Z"]
            };
            l.prototype.isValid = function() {
                return Infinity !== this.value && -Infinity !== this.value
            };
            return l
        }(l.seriesTypes.scatter.prototype.pointClass);
        C(l.prototype, {
            dataLabelOnNull: b.dataLabelOnNull,
            setState: b.setState
        });
        return l
    });
    J(b, "Series/Heatmap/HeatmapSeries.js",
        [b["Mixins/ColorMapSeries.js"], b["Core/Globals.js"], b["Series/Heatmap/HeatmapPoint.js"], b["Mixins/LegendSymbol.js"], b["Core/Color/Palette.js"], b["Core/Series/SeriesRegistry.js"], b["Core/Renderer/SVG/SVGRenderer.js"], b["Core/Utilities.js"]],
        function(b, l, B, y, z, C, v, t) {
            var q = this && this.__extends || function() {
                var b = function(c, e) {
                    b = Object.setPrototypeOf || {
                        __proto__: []
                    }
                    instanceof Array && function(b, c) {
                        b.__proto__ = c
                    } || function(b, c) {
                        for (var a in c) c.hasOwnProperty(a) && (b[a] = c[a])
                    };
                    return b(c, e)
                };
                return function(c,
                    e) {
                    function f() {
                        this.constructor = c
                    }
                    b(c, e);
                    c.prototype = null === e ? Object.create(e) : (f.prototype = e.prototype, new f)
                }
            }();
            b = b.colorMapSeriesMixin;
            var h = l.noop,
                c = C.series,
                p = C.seriesTypes,
                k = p.column,
                w = p.scatter,
                f = v.prototype.symbols,
                H = t.extend,
                x = t.fireEvent,
                K = t.isNumber,
                J = t.merge,
                r = t.pick;
            v = function(b) {
                function h() {
                    var c = null !== b && b.apply(this, arguments) || this;
                    c.colorAxis = void 0;
                    c.data = void 0;
                    c.options = void 0;
                    c.points = void 0;
                    c.valueMax = NaN;
                    c.valueMin = NaN;
                    return c
                }
                q(h, b);
                h.prototype.drawPoints = function() {
                    var b =
                        this;
                    if ((this.options.marker || {}).enabled || this._hasPointMarkers) c.prototype.drawPoints.call(this), this.points.forEach(function(c) {
                        c.graphic && c.graphic[b.chart.styledMode ? "css" : "animate"](b.colorAttribs(c))
                    })
                };
                h.prototype.getExtremes = function() {
                    var b = c.prototype.getExtremes.call(this, this.valueData),
                        f = b.dataMin;
                    b = b.dataMax;
                    K(f) && (this.valueMin = f);
                    K(b) && (this.valueMax = b);
                    return c.prototype.getExtremes.call(this)
                };
                h.prototype.getValidPoints = function(b, f) {
                    return c.prototype.getValidPoints.call(this,
                        b, f, !0)
                };
                h.prototype.hasData = function() {
                    return !!this.processedXData.length
                };
                h.prototype.init = function() {
                    c.prototype.init.apply(this, arguments);
                    var b = this.options;
                    b.pointRange = r(b.pointRange, b.colsize || 1);
                    this.yAxis.axisPointRange = b.rowsize || 1;
                    H(f, {
                        ellipse: f.circle,
                        rect: f.square
                    })
                };
                h.prototype.markerAttribs = function(b, c) {
                    var d = b.marker || {},
                        a = this.options.marker || {},
                        e = b.shapeArgs || {},
                        f = {};
                    if (b.hasImage) return {
                        x: b.plotX,
                        y: b.plotY
                    };
                    if (c) {
                        var g = a.states[c] || {};
                        var h = d.states && d.states[c] || {};
                        [
                            ["width",
                                "x"
                            ],
                            ["height", "y"]
                        ].forEach(function(a) {
                            f[a[0]] = (h[a[0]] || g[a[0]] || e[a[0]]) + (h[a[0] + "Plus"] || g[a[0] + "Plus"] || 0);
                            f[a[1]] = e[a[1]] + (e[a[0]] - f[a[0]]) / 2
                        })
                    }
                    return c ? f : e
                };
                h.prototype.pointAttribs = function(b, f) {
                    var d = c.prototype.pointAttribs.call(this, b, f),
                        a = this.options || {},
                        e = this.chart.options.plotOptions || {},
                        g = e.series || {},
                        h = e.heatmap || {};
                    e = a.borderColor || h.borderColor || g.borderColor;
                    g = a.borderWidth || h.borderWidth || g.borderWidth || d["stroke-width"];
                    d.stroke = b && b.marker && b.marker.lineColor || a.marker && a.marker.lineColor ||
                        e || this.color;
                    d["stroke-width"] = g;
                    f && (b = J(a.states[f], a.marker && a.marker.states[f], b && b.options.states && b.options.states[f] || {}), f = b.brightness, d.fill = b.color || l.color(d.fill).brighten(f || 0).get(), d.stroke = b.lineColor);
                    return d
                };
                h.prototype.setClip = function(b) {
                    var e = this.chart;
                    c.prototype.setClip.apply(this, arguments);
                    (!1 !== this.options.clip || b) && this.markerGroup.clip((b || this.clipBox) && this.sharedClipKey ? e[this.sharedClipKey] : e.clipRect)
                };
                h.prototype.translate = function() {
                    var b = this.options,
                        c = b.marker &&
                        b.marker.symbol || "",
                        d = f[c] ? c : "rect";
                    b = this.options;
                    var a = -1 !== ["circle", "square"].indexOf(d);
                    this.generatePoints();
                    this.points.forEach(function(b) {
                        var e = b.getCellAttributes(),
                            g = {
                                x: Math.min(e.x1, e.x2),
                                y: Math.min(e.y1, e.y2),
                                width: Math.max(Math.abs(e.x2 - e.x1), 0),
                                height: Math.max(Math.abs(e.y2 - e.y1), 0)
                            };
                        var h = b.hasImage = 0 === (b.marker && b.marker.symbol || c || "").indexOf("url");
                        if (a) {
                            var k = Math.abs(g.width - g.height);
                            g.x = Math.min(e.x1, e.x2) + (g.width < g.height ? 0 : k / 2);
                            g.y = Math.min(e.y1, e.y2) + (g.width < g.height ?
                                k / 2 : 0);
                            g.width = g.height = Math.min(g.width, g.height)
                        }
                        k = {
                            plotX: (e.x1 + e.x2) / 2,
                            plotY: (e.y1 + e.y2) / 2,
                            clientX: (e.x1 + e.x2) / 2,
                            shapeType: "path",
                            shapeArgs: J(!0, g, {
                                d: f[d](g.x, g.y, g.width, g.height)
                            })
                        };
                        h && (b.marker = {
                            width: g.width,
                            height: g.height
                        });
                        H(b, k)
                    });
                    x(this, "afterTranslate")
                };
                h.defaultOptions = J(w.defaultOptions, {
                    animation: !1,
                    borderWidth: 0,
                    nullColor: z.neutralColor3,
                    dataLabels: {
                        formatter: function() {
                            return this.point.value
                        },
                        inside: !0,
                        verticalAlign: "middle",
                        crop: !1,
                        overflow: !1,
                        padding: 0
                    },
                    marker: {
                        symbol: "rect",
                        radius: 0,
                        lineColor: void 0,
                        states: {
                            hover: {
                                lineWidthPlus: 0
                            },
                            select: {}
                        }
                    },
                    clip: !0,
                    pointRange: null,
                    tooltip: {
                        pointFormat: "{point.x}, {point.y}: {point.value}<br/>"
                    },
                    states: {
                        hover: {
                            halo: !1,
                            brightness: .2
                        }
                    }
                });
                return h
            }(w);
            H(v.prototype, {
                alignDataLabel: k.prototype.alignDataLabel,
                axisTypes: b.axisTypes,
                colorAttribs: b.colorAttribs,
                colorKey: b.colorKey,
                directTouch: !0,
                drawLegendSymbol: y.drawRectangle,
                getBox: h,
                getExtremesFromAll: !0,
                getSymbol: c.prototype.getSymbol,
                hasPointSpecificOptions: !0,
                parallelArrays: b.parallelArrays,
                pointArrayMap: ["y", "value"],
                pointClass: B,
                trackerGroups: b.trackerGroups
            });
            C.registerSeriesType("heatmap", v);
            "";
            "";
            return v
        });
    J(b, "Extensions/GeoJSON.js", [b["Core/Chart/Chart.js"], b["Core/Globals.js"], b["Core/Utilities.js"]], function(b, l, B) {
        function w(b, c) {
            var h, k = !1,
                l = b.x,
                f = b.y;
            b = 0;
            for (h = c.length - 1; b < c.length; h = b++) {
                var q = c[b][1] > f;
                var t = c[h][1] > f;
                q !== t && l < (c[h][0] - c[b][0]) * (f - c[b][1]) / (c[h][1] - c[b][1]) + c[b][0] && (k = !k)
            }
            return k
        }
        var z = l.win,
            C = B.error,
            v = B.extend,
            t = B.format,
            q = B.merge;
        B = B.wrap;
        "";
        b.prototype.transformFromLatLon =
            function(b, c) {
                var h, k = (null === (h = this.userOptions.chart) || void 0 === h ? void 0 : h.proj4) || z.proj4;
                if (!k) return C(21, !1, this), {
                    x: 0,
                    y: null
                };
                b = k(c.crs, [b.lon, b.lat]);
                h = c.cosAngle || c.rotation && Math.cos(c.rotation);
                k = c.sinAngle || c.rotation && Math.sin(c.rotation);
                b = c.rotation ? [b[0] * h + b[1] * k, -b[0] * k + b[1] * h] : b;
                return {
                    x: ((b[0] - (c.xoffset || 0)) * (c.scale || 1) + (c.xpan || 0)) * (c.jsonres || 1) + (c.jsonmarginX || 0),
                    y: (((c.yoffset || 0) - b[1]) * (c.scale || 1) + (c.ypan || 0)) * (c.jsonres || 1) - (c.jsonmarginY || 0)-50
                }
            };
        b.prototype.transformToLatLon =
            function(b, c) {
                if ("undefined" === typeof z.proj4) C(21, !1, this);
                else {
                    b = {
                        x: ((b.x - (c.jsonmarginX || 0)) / (c.jsonres || 1) - (c.xpan || 0)) / (c.scale || 1) + (c.xoffset || 0),
                        y: ((-b.y - (c.jsonmarginY || 0)) / (c.jsonres || 1) + (c.ypan || 0)) / (c.scale || 1) + (c.yoffset || 0)
                    };
                    var h = c.cosAngle || c.rotation && Math.cos(c.rotation),
                        k = c.sinAngle || c.rotation && Math.sin(c.rotation);
                    c = z.proj4(c.crs, "WGS84", c.rotation ? {
                        x: b.x * h + b.y * -k,
                        y: b.x * k + b.y * h
                    } : b);
                    return {
                        lat: c.y,
                        lon: c.x
                    }
                }
            };
        b.prototype.fromPointToLatLon = function(b) {
            var c = this.mapTransforms,
                h;
            if (c) {
                for (h in c)
                    if (Object.hasOwnProperty.call(c,
                            h) && c[h].hitZone && w({
                            x: b.x,
                            y: -b.y
                        }, c[h].hitZone.coordinates[0])) return this.transformToLatLon(b, c[h]);
                return this.transformToLatLon(b, c["default"])
            }
            C(22, !1, this)
        };
        b.prototype.fromLatLonToPoint = function(b) {
            var c = this.mapTransforms,
                h;
            if (!c) return C(22, !1, this), {
                x: 0,
                y: null
            };
            for (h in c)
                if (Object.hasOwnProperty.call(c, h) && c[h].hitZone) {
                    var k = this.transformFromLatLon(b, c[h]);
                    if (w({
                            x: k.x,
                            y: -k.y
                        }, c[h].hitZone.coordinates[0])) return k
                } return this.transformFromLatLon(b, c["default"])
        };
        l.geojson = function(b, c,
            l) {
            var h = [],
                p = [],
                f = function(b) {
                    b.forEach(function(b, c) {
                        0 === c ? p.push(["M", b[0], -b[1]]) : p.push(["L", b[0], -b[1]])
                    })
                };
            c = c || "map";
            b.features.forEach(function(b) {
                var k = b.geometry,
                    l = k.type;
                k = k.coordinates;
                b = b.properties;
                var q;
                p = [];
                "map" === c || "mapbubble" === c ? ("Polygon" === l ? (k.forEach(f), p.push(["Z"])) : "MultiPolygon" === l && (k.forEach(function(b) {
                        b.forEach(f)
                    }), p.push(["Z"])), p.length && (q = {
                        path: p
                    })) : "mapline" === c ? ("LineString" === l ? f(k) : "MultiLineString" === l && k.forEach(f), p.length && (q = {
                        path: p
                    })) : "mappoint" ===
                    c && "Point" === l && (q = {
                        x: k[0],
                        y: -k[1]
                    });
                q && h.push(v(q, {
                    name: b.name || b.NAME,
                    properties: b
                }))
            });
            l && b.copyrightShort && (l.chart.mapCredits = t(l.chart.options.credits.mapText, {
                geojson: b
            }), l.chart.mapCreditsFull = t(l.chart.options.credits.mapTextFull, {
                geojson: b
            }));
            return h
        };
        B(b.prototype, "addCredits", function(b, c) {
            c = q(!0, this.options.credits, c);
            this.mapCredits && (c.href = null);
            b.call(this, c);
            this.credits && this.mapCreditsFull && this.credits.attr({
                title: this.mapCreditsFull
            })
        })
    });
    J(b, "masters/modules/map.src.js", [],
        function() {});
    J(b, "masters/highmaps.src.js", [b["masters/highcharts.src.js"]], function(b) {
        b.product = "Highmaps";
        return b
    });
    b["masters/highmaps.src.js"]._modules = b;
    return b["masters/highmaps.src.js"]
});
//# sourceMappingURL=highmaps.js.map