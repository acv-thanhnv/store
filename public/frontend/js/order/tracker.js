//! TrackJS JavaScript error monitoring agent.
//! COPYRIGHT (c) 2018 ALL RIGHTS RESERVED
//! See License at https://trackjs.com/terms/
(function(g, p, n) {
    "use awesome";
    if (g.trackJs)
        g.console && g.console.warn && g.console.warn("TrackJS global conflict");
    else {
        var q = function(a, b) {
            this.config = a;
            this.onError = b;
            a.enabled && this.watch()
        };
        q.prototype = {
            watch: function() {
                e.forEach(["EventTarget", "Node", "XMLHttpRequest"], function(a) {
                    e.has(g, a + ".prototype.addEventListener") && e.hasOwn(g[a].prototype, "addEventListener") && this.wrapEventTarget(g[a].prototype)
                }, this);
                this.wrapTimer("setTimeout");
                this.wrapTimer("setInterval")
            },
            wrap: function(a) {
                function b() {
                    try {
                        return a.apply(this, arguments)
                    } catch (b) {
                        throw d.onError("catch", b, {
                            bindTime: c,
                            bindStack: f
                        }),
                        e.wrapError(b);
                    }
                }
                var d = this;
                try {
                    if (!e.isFunction(a) || e.hasOwn(a, "__trackjs__"))
                        return a;
                    if (e.hasOwn(a, "__trackjs_state__"))
                        return a.__trackjs_state__
                } catch (l) {
                    return a
                }
                var c, f;
                if (d.config.bindStack)
                    try {
                        throw Error();
                    } catch (l) {
                        f = l.stack,
                        c = e.isoNow()
                    }
                for (var h in a)
                    e.hasOwn(a, h) && (b[h] = a[h]);
                b.prototype = a.prototype;
                b.__trackjs__ = !0;
                return a.__trackjs_state__ = b
            },
            wrapEventTarget: function(a) {
                var b = this;
                e.has(a, "addEventListener.call") && e.has(a, "removeEventListener.call") && (e.patch(a, "addEventListener", function(a) {
                    return function(c, f, h, l) {
                        try {
                            e.has(f, "handleEvent") && (f.handleEvent = b.wrap(f.handleEvent))
                        } catch (k) {}
                        return a.call(this, c, b.wrap(f), h, l)
                    }
                }),
                e.patch(a, "removeEventListener", function(a) {
                    return function(b, f, h, e) {
                        try {
                            f = f && (f.__trackjs_state__ || f)
                        } catch (k) {}
                        return a.call(this, b, f, h, e)
                    }
                }))
            },
            wrapTimer: function(a) {
                var b = this;
                e.patch(g, a, function(a) {
                    return function(c, f) {
                        var h = Array.prototype.slice.call(arguments)
                          , l = h[0];
                        e.isFunction(l) && (h[0] = b.wrap(l));
                        return e.has(a, "apply") ? a.apply(this, h) : a(h[0], h[1])
                    }
                })
            }
        };
        var u = function(a) {
            this.initCurrent(a)
        };
        u.prototype = {
            current: {},
            initOnly: {
                cookie: !0,
                enabled: !0,
                token: !0,
                callback: {
                    enabled: !0
                },
                console: {
                    enabled: !0
                },
                navigation: {
                    enabled: !0
                },
                network: {
                    enabled: !0,
                    fetch: !0
                },
                visitor: {
                    enabled: !0
                },
                window: {
                    enabled: !0,
                    promise: !0
                }
            },
            defaults: {
                application: "",
                cookie: !1,
                dedupe: !0,
                enabled: !0,
                errorURL: "https://capture.trackjs.com/capture",
                errorNoSSLURL: "http://capture.trackjs.com/capture",
                faultURL: "https://usage.trackjs.com/fault.gif",
                onError: function() {
                    return !0
                },
                serialize: function(a) {
                    function b(a) {
                        var d = "<" + a.tagName.toLowerCase();
                        a = a.attributes || [];
                        for (var b = 0; b < a.length; b++)
                            d += " " + a[b].name + '="' + a[b].value + '"';
                        return d + ">"
                    }
                    if ("" === a)
                        return "Empty String";
                    if (a === n)
                        return "undefined";
                    if (e.isString(a) || e.isNumber(a) || e.isBoolean(a) || e.isFunction(a))
                        return "" + a;
                    if (e.isElement(a))
                        return b(a);
                    var d;
                    try {
                        d = JSON.stringify(a, function(a, d) {
                            return d === n ? "undefined" : e.isNumber(d) && isNaN(d) ? "NaN" : e.isError(d) ? {
                                name: d.name,
                                message: d.message,
                                stack: d.stack
                            } : e.isElement(d) ? b(d) : d
                        })
                    } catch (f) {
                        d = "";
                        for (var c in a)
                            a.hasOwnProperty(c) && (d += ',"' + c + '":"' + a[c] + '"');
                        d = d ? "{" + d.replace(",", "") + "}" : "Unserializable Object"
                    }
                    return d.replace(/"undefined"/g, "undefined").replace(/"NaN"/g, "NaN")
                },
                sessionId: "",
                token: "",
                userId: "",
                version: "",
                callback: {
                    enabled: !0,
                    bindStack: !1
                },
                console: {
                    enabled: !0,
                    display: !0,
                    error: !0,
                    warn: !1,
                    watch: ["log", "debug", "info", "warn", "error"]
                },
                navigation: {
                    enabled: !0
                },
                network: {
                    enabled: !0,
                    error: !0,
                    fetch: !0
                },
                visitor: {
                    enabled: !0
                },
                usageURL: "https://usage.trackjs.com/usage.gif",
                window: {
                    enabled: !0,
                    promise: !0
                }
            },
            initCurrent: function(a) {
                if (this.validate(a, this.defaults, "config", {}))
                    return this.current = e.defaultsDeep({}, a, this.defaults),
                    !0;
                this.current = e.defaultsDeep({}, this.defaults);
                console.log("init current config", this.current);
                return !1
            },
            setCurrent: function(a) {
                return this.validate(a, this.defaults, "config", this.initOnly) ? (this.current = e.defaultsDeep({}, a, this.current),
                !0) : !1
            },
            validate: function(a, b, d, c) {
                var f = !0;
                d = d || "";
                c = c || {};
                for (var h in a)
                    if (a.hasOwnProperty(h))
                        if (b.hasOwnProperty(h)) {
                            var e = typeof b[h];
                            e !== typeof a[h] ? (console.warn(d + "." + h + ": property must be type " + e + "."),
                            f = !1) : "[object Array]" !== Object.prototype.toString.call(a[h]) || this.validateArray(a[h], b[h], d + "." + h) ? "[object Object]" === Object.prototype.toString.call(a[h]) ? f = this.validate(a[h], b[h], d + "." + h, c[h]) : c.hasOwnProperty(h) && (console.warn(d + "." + h + ": property cannot be set after load."),
                            f = !1) : f = !1
                        } else
                            console.warn(d + "." + h + ": property not supported."),
                            f = !1;
                return f
            },
            validateArray: function(a, b, d) {
                var c = !0;
                d = d || "";
                for (var f = 0; f < a.length; f++)
                    e.contains(b, a[f]) || (console.warn(d + "[" + f + "]: invalid value: " + a[f] + "."),
                    c = !1);
                return c
            }
        };
        var v = function(a, b, d, c, f, h, e) {
            this.util = a;
            this.log = b;
            this.onError = d;
            this.onFault = c;
            this.serialize = f;
            e.enabled && (h.console = this.wrapConsoleObject(h.console, e))
        };
        v.prototype = {
            wrapConsoleObject: function(a, b) {
                a = a || {};
                var d = a.log || function() {}
                , c = this, f;
                for (f = 0; f < b.watch.length; f++)
                    (function(f) {
                        var l = a[f] || d;
                        a[f] = function() {
                            try {
                                var a = Array.prototype.slice.call(arguments);
                                c.log.add("c", {
                                    timestamp: c.util.isoNow(),
                                    severity: f,
                                    message: c.serialize(1 === a.length ? a[0] : a)
                                });
                                if (b[f])
                                    if (e.isError(a[0]) && 1 === a.length)
                                        c.onError("console", a[0]);
                                    else
                                        try {
                                            throw Error(c.serialize(1 === a.length ? a[0] : a));
                                        } catch (d) {
                                            c.onError("console", d)
                                        }
                                b.display && (c.util.hasFunction(l, "apply") ? l.apply(this, a) : l(a[0]))
                            } catch (d) {
                                c.onFault(d)
                            }
                        }
                    }
                    )(b.watch[f]);
                return a
            },
            report: function() {
                return this.log.all("c")
            }
        };
        var w = function(a, b, d, c, f) {
            this.config = a;
            this.util = b;
            this.log = d;
            this.window = c;
            this.document = f;
            this.correlationId = this.token = null;
            this.initialize()
        };
        w.prototype = {
            initialize: function() {
                this.token = this.getCustomerToken();
                this.correlationId = this.getCorrelationId()
            },
            getCustomerToken: function() {
                if (this.config.current.token)
                    return this.config.current.token;
                var a = this.document.getElementsByTagName("script");
                return a[a.length - 1].getAttribute("data-token")
            },
            getCorrelationId: function() {
                var a;
                if (!this.config.current.cookie)
                    return this.util.uuid();
                try {
                    a = this.document.cookie.replace(/(?:(?:^|.*;\s*)TrackJS\s*\=\s*([^;]*).*$)|^.*$/, "$1"),
                    a || (a = this.util.uuid(),
                    this.document.cookie = "TrackJS=" + a + "; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/")
                } catch (b) {
                    a = this.util.uuid()
                }
                return a
            },
            report: function() {
                return {
                    application: this.config.current.application,
                    correlationId: this.correlationId,
                    sessionId: this.config.current.sessionId,
                    token: this.token,
                    userId: this.config.current.userId,
                    version: this.config.current.version
                }
            }
        };
        var y = function() {
            this.loadedOn = (new Date).getTime();
            this.originalUrl = e.getLocation();
            this.referrer = p.referrer
        };
        y.prototype = {
            discoverDependencies: function() {
                var a = {};
                g.jQuery && g.jQuery.fn && g.jQuery.fn.jquery && (a.jQuery = g.jQuery.fn.jquery);
                g.jQuery && g.jQuery.ui && g.jQuery.ui.version && (a.jQueryUI = g.jQuery.ui.version);
                g.angular && g.angular.version && g.angular.version.full && (a.angular = g.angular.version.full);
                for (var b in g)
                    if ("_trackJs" !== b && "_trackJS" !== b && "_trackjs" !== b && "webkitStorageInfo" !== b && "webkitIndexedDB" !== b && "top" !== b && "parent" !== b && "frameElement" !== b)
                        try {
                            if (g[b]) {
                                var d = g[b].version || g[b].Version || g[b].VERSION;
                                "string" === typeof d && (a[b] = d)
                            }
                        } catch (c) {}
                return a
            },
            report: function() {
                return {
                    age: (new Date).getTime() - this.loadedOn,
                    dependencies: this.discoverDependencies(),
                    originalUrl: this.originalUrl,
                    referrer: this.referrer,
                    userAgent: g.navigator.userAgent,
                    viewportHeight: g.document.documentElement.clientHeight,
                    viewportWidth: g.document.documentElement.clientWidth
                }
            }
        };
        var z = function(a) {
            this.util = a;
            this.appender = [];
            this.maxLength = 30
        };
        z.prototype = {
            all: function(a) {
                var b = [], d, c;
                for (c = 0; c < this.appender.length; c++)
                    (d = this.appender[c]) && d.category === a && b.push(d.value);
                return b
            },
            clear: function() {
                this.appender.length = 0
            },
            truncate: function() {
                this.appender.length > this.maxLength && (this.appender = this.appender.slice(Math.max(this.appender.length - this.maxLength, 0)))
            },
            add: function(a, b) {
                var d = this.util.uuid();
                this.appender.push({
                    key: d,
                    category: a,
                    value: b
                });
                this.truncate();
                return d
            },
            get: function(a, b) {
                var d, c;
                for (c = 0; c < this.appender.length; c++)
                    if (d = this.appender[c],
                    d.category === a && d.key === b)
                        return d.value;
                return !1
            }
        };
        var A = function(a, b) {
            this.log = a;
            this.options = b;
            b.enabled && this.watch()
        };
        A.prototype = {
            isCompatible: function(a) {
                a = a || g;
                return !e.has(a, "chrome.app.runtime") && e.has(a, "addEventListener") && e.has(a, "history.pushState")
            },
            record: function(a, b, d) {
                this.log.add("h", {
                    type: a,
                    from: e.truncate(b, 250),
                    to: e.truncate(d, 250),
                    on: e.isoNow()
                })
            },
            report: function() {
                return this.log.all("h")
            },
            watch: function() {
                if (this.isCompatible()) {
                    var a = this
                      , b = e.getLocationURL().relative;
                    g.addEventListener("popstate", function() {
                        var d = e.getLocationURL().relative;
                        a.record("popState", b, d);
                        b = d
                    }, !0);
                    e.forEach(["pushState", "replaceState"], function(d) {
                        e.patch(history, d, function(c) {
                            return function() {
                                b = e.getLocationURL().relative;
                                var f = c.apply(this, arguments)
                                  , h = e.getLocationURL().relative;
                                a.record(d, b, h);
                                b = h;
                                return f
                            }
                        })
                    })
                }
            }
        };
        var B = function(a, b, d, c, f, e) {
            this.util = a;
            this.log = b;
            this.onError = d;
            this.onFault = c;
            this.window = f;
            this.options = e;
            e.enabled && this.initialize(f)
        };
        B.prototype = {
            initialize: function(a) {
                a.XMLHttpRequest && this.util.hasFunction(a.XMLHttpRequest.prototype.open, "apply") && this.watchNetworkObject(a.XMLHttpRequest);
                a.XDomainRequest && this.util.hasFunction(a.XDomainRequest.prototype.open, "apply") && this.watchNetworkObject(a.XDomainRequest);
                this.options.fetch && e.isWrappableFunction(a.fetch) && this.watchFetch()
            },
            watchFetch: function() {
                var a = this.log
                  , b = this.options
                  , d = this.onError;
                e.patch(g, "fetch", function(c) {
                    return function(f, h) {
                        var l;
                        try {
                            throw Error();
                        } catch (x) {
                            l = x.stack
                        }
                        var k = f instanceof Request ? f : new Request(f,h)
                          , m = c.apply(g, arguments);
                        m.__trackjs_state__ = a.add("n", {
                            type: "fetch",
                            startedOn: e.isoNow(),
                            method: k.method,
                            url: e.truncate(k.url, 2E3)
                        });
                        return m.then(function(c) {
                            var f = a.get("n", m.__trackjs_state__);
                            f && (e.defaults(f, {
                                completedOn: e.isoNow(),
                                statusCode: c.status,
                                statusText: c.statusText
                            }),
                            b.error && 400 <= c.status && (f = Error(f.statusCode + " " + f.statusText + ": " + f.method + " " + f.url),
                            f.stack = l,
                            d("ajax", f)));
                            return c
                        })["catch"](function(c) {
                            c = c || {};
                            var f = a.get("n", m.__trackjs_state__);
                            f && (e.defaults(f, {
                                completedOn: e.isoNow(),
                                statusCode: 0,
                                statusText: c.toString()
                            }),
                            b.error && (c.message = c.message + ": " + f.method + " " + f.url,
                            c.stack = c.stack || l,
                            d("ajax", c)));
                            throw c;
                        })
                    }
                })
            },
            watchNetworkObject: function(a) {
                var b = this
                  , d = a.prototype.open
                  , c = a.prototype.send;
                a.prototype.open = function(a, b) {
                    var c = (b || "").toString();
                    0 > c.indexOf("localhost:0") && (this._trackJs = {
                        method: a,
                        url: c
                    });
                    return d.apply(this, arguments)
                }
                ;
                a.prototype.send = function() {
                    try {
                        if (!this._trackJs)
                            return c.apply(this, arguments);
                        this._trackJs.logId = b.log.add("n", {
                            type: "xhr",
                            startedOn: b.util.isoNow(),
                            method: this._trackJs.method,
                            url: e.truncate(this._trackJs.url, 2E3)
                        });
                        b.listenForNetworkComplete(this)
                    } catch (a) {
                        b.onFault(a)
                    }
                    return c.apply(this, arguments)
                }
                ;
                return a
            },
            listenForNetworkComplete: function(a) {
                var b = this;
                b.window.ProgressEvent && a.addEventListener && a.addEventListener("readystatechange", function() {
                    4 === a.readyState && b.finalizeNetworkEvent(a)
                }, !0);
                a.addEventListener ? a.addEventListener("load", function() {
                    b.finalizeNetworkEvent(a);
                    b.checkNetworkFault(a)
                }, !0) : setTimeout(function() {
                    try {
                        var d = a.onload;
                        a.onload = function() {
                            b.finalizeNetworkEvent(a);
                            b.checkNetworkFault(a);
                            "function" === typeof d && b.util.hasFunction(d, "apply") && d.apply(a, arguments)
                        }
                        ;
                        var c = a.onerror;
                        a.onerror = function() {
                            b.finalizeNetworkEvent(a);
                            b.checkNetworkFault(a);
                            "function" === typeof oldOnError && c.apply(a, arguments)
                        }
                    } catch (f) {
                        b.onFault(f)
                    }
                }, 0)
            },
            finalizeNetworkEvent: function(a) {
                if (a._trackJs) {
                    var b = this.log.get("n", a._trackJs.logId);
                    b && (b.completedOn = this.util.isoNow(),
                    b.statusCode = 1223 == a.status ? 204 : a.status,
                    b.statusText = 1223 == a.status ? "No Content" : a.statusText)
                }
            },
            checkNetworkFault: function(a) {
                if (this.options.error && 400 <= a.status && 1223 != a.status) {
                    var b = a._trackJs || {};
                    this.onError("ajax", a.status + " " + a.statusText + ": " + b.method + " " + b.url)
                }
            },
            report: function() {
                return this.log.all("n")
            }
        };
        var r = function(a, b) {
            this.util = a;
            this.config = b;
            this.disabled = !1;
            this.throttleStats = {
                attemptCount: 0,
                throttledCount: 0,
                lastAttempt: (new Date).getTime()
            };
            g.JSON && g.JSON.stringify || (this.disabled = !0)
        };
        r.prototype = {
            errorEndpoint: function(a) {
                var b = this.config.current.errorURL;
                this.util.testCrossdomainXhr() || -1 !== g.location.protocol.indexOf("https") || (b = this.config.current.errorNoSSLURL);
                return b + "?token=" + a
            },
            usageEndpoint: function(a) {
                return this.appendObjectAsQuery(a, this.config.current.usageURL)
            },
            trackerFaultEndpoint: function(a) {
                return this.appendObjectAsQuery(a, this.config.current.faultURL)
            },
            appendObjectAsQuery: function(a, b) {
                b += "?";
                for (var d in a)
                    a.hasOwnProperty(d) && (b += encodeURIComponent(d) + "=" + encodeURIComponent(a[d]) + "&");
                return b
            },
            getCORSRequest: function(a, b) {
                var d;
                this.util.testCrossdomainXhr() ? (d = new g.XMLHttpRequest,
                d.open(a, b),
                d.setRequestHeader("Content-Type", "text/plain")) : "undefined" !== typeof g.XDomainRequest ? (d = new g.XDomainRequest,
                d.open(a, b)) : d = null;
                return d
            },
            sendTrackerFault: function(a) {
                this.throttle(a) || ((new Image).src = this.trackerFaultEndpoint(a))
            },
            sendUsage: function(a) {
                (new Image).src = this.usageEndpoint(a)
            },
            sendError: function(a, b) {
                var d = this;
                if (!this.disabled && !this.throttle(a))
                    try {
                        var c = this.getCORSRequest("POST", this.errorEndpoint(b));
                        c.onreadystatechange = function() {
                            4 === c.readyState && 200 !== c.status && (d.disabled = !0)
                        }
                        ;
                        c._trackJs = n;
                        c.send(g.JSON.stringify(a))
                    } catch (f) {
                        throw this.disabled = !0,
                        f;
                    }
            },
            throttle: function(a) {
                var b = (new Date).getTime();
                this.throttleStats.attemptCount++;
                if (this.throttleStats.lastAttempt + 1E3 >= b) {
                    if (this.throttleStats.lastAttempt = b,
                    10 < this.throttleStats.attemptCount)
                        return this.throttleStats.throttledCount++,
                        !0
                } else
                    a.throttled = this.throttleStats.throttledCount,
                    this.throttleStats.attemptCount = 0,
                    this.throttleStats.lastAttempt = b,
                    this.throttleStats.throttledCount = 0;
                return !1
            }
        };
        var e = function() {
            function a(d, c, f, h) {
                f = f || !1;
                h = h || 0;
                e.forEach(c, function(c) {
                    e.forEach(e.keys(c), function(e) {
                        null === c[e] || c[e] === n ? d[e] = c[e] : f && 10 > h && "[object Object]" === b(c[e]) ? (d[e] = d[e] || {},
                        a(d[e], [c[e]], f, h + 1)) : d.hasOwnProperty(e) || (d[e] = c[e])
                    })
                });
                return d
            }
            function b(a) {
                return Object.prototype.toString.call(a)
            }
            return {
                addEventListenerSafe: function(a, b, f, e) {
                    a.addEventListener ? a.addEventListener(b, f, e) : a.attachEvent && a.attachEvent("on" + b, f)
                },
                afterDocumentLoad: function(a) {
                    var b = !1;
                    "complete" === p.readyState ? e.defer(a) : (e.addEventListenerSafe(p, "readystatechange", function() {
                        "complete" !== p.readyState || b || (e.defer(a),
                        b = !0)
                    }),
                    setTimeout(function() {
                        b || (e.defer(a),
                        b = !0)
                    }, 1E4))
                },
                bind: function(a, b) {
                    return function() {
                        return a.apply(b, Array.prototype.slice.call(arguments))
                    }
                },
                contains: function(a, b) {
                    var f;
                    for (f = 0; f < a.length; f++)
                        if (a[f] === b)
                            return !0;
                    return !1
                },
                defaults: function(d) {
                    return a(d, Array.prototype.slice.call(arguments, 1), !1)
                },
                defaultsDeep: function(d) {
                    return a(d, Array.prototype.slice.call(arguments, 1), !0)
                },
                defer: function(a, b) {
                    setTimeout(function() {
                        a.apply(b)
                    })
                },
                forEach: function(a, b, f) {
                    if (e.isArray(a)) {
                        if (a.forEach)
                            return a.forEach(b, f);
                        for (var h = 0; h < a.length; )
                            b.call(f, a[h], h, a),
                            h++
                    }
                },
                getLocation: function() {
                    return g.location.toString().replace(/ /g, "%20")
                },
                getLocationURL: function() {
                    return e.parseURL(e.getLocation())
                },
                has: function(a, b) {
                    try {
                        for (var f = b.split("."), e = a, g = 0; g < f.length; g++)
                            if (e[f[g]])
                                e = e[f[g]];
                            else
                                return !1;
                        return !0
                    } catch (k) {
                        return !1
                    }
                },
                hasFunction: function(a, b) {
                    try {
                        return !!a[b]
                    } catch (f) {
                        return !1
                    }
                },
                hasOwn: function(a, b) {
                    return Object.prototype.hasOwnProperty.call(a, b)
                },
                isArray: function(a) {
                    return "[object Array]" === b(a)
                },
                isBoolean: function(a) {
                    return "boolean" === typeof a || e.isObject(a) && "[object Boolean]" === b(a)
                },
                isBrowserIE: function(a) {
                    a = a || g.navigator.userAgent;
                    var b = a.match(/Trident\/([\d.]+)/);
                    return b && "7.0" === b[1] ? 11 : (a = a.match(/MSIE ([\d.]+)/)) ? parseInt(a[1], 10) : !1
                },
                isBrowserSupported: function() {
                    var a = this.isBrowserIE();
                    return !a || 8 <= a
                },
                isError: function(a) {
                    if (!e.isObject(a))
                        return !1;
                    var c = b(a);
                    return "[object Error]" === c || "[object DOMException]" === c || e.isString(a.name) && e.isString(a.message)
                },
                isElement: function(a) {
                    return e.isObject(a) && 1 === a.nodeType
                },
                isFunction: function(a) {
                    return !(!a || "function" !== typeof a)
                },
                isNumber: function(a) {
                    return "number" === typeof a || e.isObject(a) && "[object Number]" === b(a)
                },
                isObject: function(a) {
                    return !(!a || "object" !== typeof a)
                },
                isString: function(a) {
                    return "string" === typeof a || !e.isArray(a) && e.isObject(a) && "[object String]" === b(a)
                },
                isWrappableFunction: function(a) {
                    return this.isFunction(a) && this.hasFunction(a, "apply")
                },
                isoNow: function() {
                    var a = new Date;
                    return a.toISOString ? a.toISOString() : a.getUTCFullYear() + "-" + this.pad(a.getUTCMonth() + 1) + "-" + this.pad(a.getUTCDate()) + "T" + this.pad(a.getUTCHours()) + ":" + this.pad(a.getUTCMinutes()) + ":" + this.pad(a.getUTCSeconds()) + "." + String((a.getUTCMilliseconds() / 1E3).toFixed(3)).slice(2, 5) + "Z"
                },
                keys: function(a) {
                    if (!e.isObject(a))
                        return [];
                    var b = [], f;
                    for (f in a)
                        a.hasOwnProperty(f) && b.push(f);
                    return b
                },
                noop: function() {},
                pad: function(a) {
                    a = String(a);
                    1 === a.length && (a = "0" + a);
                    return a
                },
                parseURL: function(a) {
                    var b = a.match(/^(([^:\/?#]+):)?(\/\/([^\/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?$/);
                    if (!b)
                        return {};
                    b = {
                        protocol: b[2],
                        host: b[4],
                        path: b[5],
                        query: b[6],
                        hash: b[8]
                    };
                    b.origin = (b.protocol || "") + "://" + (b.host || "");
                    b.relative = (b.path || "") + (b.query || "") + (b.hash || "");
                    b.href = a;
                    return b
                },
                patch: function(a, b, f) {
                    a[b] = f(a[b] || e.noop)
                },
                testCrossdomainXhr: function() {
                    return "withCredentials"in new XMLHttpRequest
                },
                truncate: function(a, b) {
                    if (a.length <= b)
                        return a;
                    var f = a.length - b;
                    return a.substr(0, b) + "...{" + f + "}"
                },
                tryGet: function(a, b) {
                    try {
                        return a[b]
                    } catch (f) {}
                },
                uuid: function() {
                    return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function(a) {
                        var b = 16 * Math.random() | 0;
                        return ("x" == a ? b : b & 3 | 8).toString(16)
                    })
                },
                wrapError: function(a) {
                    if (a.innerError)
                        return a;
                    var b = Error("TrackJS Caught: " + (a.message || a));
                    b.description = "TrackJS Caught: " + a.description;
                    b.file = a.file;
                    b.line = a.line || a.lineNumber;
                    b.column = a.column || a.columnNumber;
                    b.stack = a.stack;
                    b.innerError = a;
                    return b
                }
            }
        }()
          , C = function(a, b, d, c, f, e) {
            this.util = a;
            this.log = b;
            this.onError = d;
            this.onFault = c;
            this.options = e;
            this.document = f;
            e.enabled && this.initialize(f)
        };
        C.prototype = {
            initialize: function(a) {
                var b = this.util.bind(this.onDocumentClicked, this)
                  , d = this.util.bind(this.onInputChanged, this);
                a.addEventListener ? (a.addEventListener("click", b, !0),
                a.addEventListener("blur", d, !0)) : a.attachEvent && (a.attachEvent("onclick", b),
                a.attachEvent("onfocusout", d))
            },
            onDocumentClicked: function(a) {
                try {
                    var b = this.getElementFromEvent(a);
                    b && b.tagName && (this.isDescribedElement(b, "a") || this.isDescribedElement(b, "button") || this.isDescribedElement(b, "input", ["button", "submit"]) ? this.writeVisitorEvent(b, "click") : this.isDescribedElement(b, "input", ["checkbox", "radio"]) && this.writeVisitorEvent(b, "input", b.value, b.checked))
                } catch (d) {
                    this.onFault(d)
                }
            },
            onInputChanged: function(a) {
                try {
                    var b = this.getElementFromEvent(a);
                    if (b && b.tagName)
                        if (this.isDescribedElement(b, "textarea"))
                            this.writeVisitorEvent(b, "input", b.value);
                        else if (this.isDescribedElement(b, "select") && b.options && b.options.length)
                            this.onSelectInputChanged(b);
                        else
                            this.isDescribedElement(b, "input") && !this.isDescribedElement(b, "input", ["button", "submit", "hidden", "checkbox", "radio"]) && this.writeVisitorEvent(b, "input", b.value)
                } catch (d) {
                    this.onFault(d)
                }
            },
            onSelectInputChanged: function(a) {
                if (a.multiple)
                    for (var b = 0; b < a.options.length; b++)
                        a.options[b].selected && this.writeVisitorEvent(a, "input", a.options[b].value);
                else
                    0 <= a.selectedIndex && a.options[a.selectedIndex] && this.writeVisitorEvent(a, "input", a.options[a.selectedIndex].value)
            },
            writeVisitorEvent: function(a, b, d, c) {
                "password" === this.getElementType(a) && (d = n);
                this.log.add("v", {
                    timestamp: this.util.isoNow(),
                    action: b,
                    element: {
                        tag: a.tagName.toLowerCase(),
                        attributes: this.getElementAttributes(a),
                        value: this.getMetaValue(d, c)
                    }
                })
            },
            getElementFromEvent: function(a) {
                return a.target || p.elementFromPoint(a.clientX, a.clientY)
            },
            isDescribedElement: function(a, b, d) {
                if (a.tagName.toLowerCase() !== b.toLowerCase())
                    return !1;
                if (!d)
                    return !0;
                a = this.getElementType(a);
                for (b = 0; b < d.length; b++)
                    if (d[b] === a)
                        return !0;
                return !1
            },
            getElementType: function(a) {
                return (a.getAttribute("type") || "").toLowerCase()
            },
            getElementAttributes: function(a) {
                for (var b = {}, d = Math.min(a.attributes.length, 10), c = 0; c < d; c++)
                    "value" !== a.attributes[c].name.toLowerCase() && (b[a.attributes[c].name] = e.truncate(a.attributes[c].value, 100));
                return b
            },
            getMetaValue: function(a, b) {
                return a === n ? n : {
                    length: a.length,
                    pattern: this.matchInputPattern(a),
                    checked: b
                }
            },
            matchInputPattern: function(a) {
                return "" === a ? "empty" : /^[a-z0-9!#$%&'*+=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/.test(a) ? "email" : /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/.test(a) || /^(\d{4}[\/\-](0?[1-9]|1[012])[\/\-]0?[1-9]|[12][0-9]|3[01])$/.test(a) ? "date" : /^(?:(?:\+?1\s*(?:[.-]\s*)?)?(?:\(\s*([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9])\s*\)|([2-9]1[02-9]|[2-9][02-8]1|[2-9][02-8][02-9]))\s*(?:[.-]\s*)?)?([2-9]1[02-9]|[2-9][02-9]1|[2-9][02-9]{2})\s*(?:[.-]\s*)?([0-9]{4})(?:\s*(?:#|x\.?|ext\.?|extension)\s*(\d+))?$/.test(a) ? "usphone" : /^\s*$/.test(a) ? "whitespace" : /^\d*$/.test(a) ? "numeric" : /^[a-zA-Z]*$/.test(a) ? "alpha" : /^[a-zA-Z0-9]*$/.test(a) ? "alphanumeric" : "characters"
            },
            report: function() {
                return this.log.all("v")
            }
        };
        var D = function(a, b, d, c, f) {
            this.onError = a;
            this.onFault = b;
            this.serialize = d;
            f.enabled && this.watchWindowErrors(c);
            f.promise && this.watchPromiseErrors(c)
        };
        D.prototype = {
            watchPromiseErrors: function(a) {
                var b = this;
                a.addEventListener ? a.addEventListener("unhandledrejection", function(a) {
                    a = a || {};
                    a = a.detail ? e.tryGet(a.detail, "reason") : e.tryGet(a, "reason");
                    if (a !== n) {
                        if (!e.isError(a))
                            try {
                                throw Error(b.serialize(a));
                            } catch (c) {
                                a = c
                            }
                        b.onError("promise", a)
                    }
                }) : a.onunhandledrejection = function(a) {
                    b.onError("promise", a)
                }
            },
            watchWindowErrors: function(a) {
                var b = this;
                e.patch(a, "onerror", function(a) {
                    return function(c, f, e, g, k) {
                        try {
                            k = k || {},
                            k.message = k.message || b.serialize(c),
                            k.name = k.name || "Error",
                            k.line = k.line || parseInt(e, 10) || null,
                            k.column = k.column || parseInt(g, 10) || null,
                            "[object Event]" !== Object.prototype.toString.call(c) || f ? k.file = k.file || b.serialize(f) : k.file = (c.target || {}).src,
                            b.onError("window", k)
                        } catch (m) {
                            b.onFault(m)
                        }
                        a.apply(this, arguments)
                    }
                })
            }
        };
        var E = function(a, b, d, c, f, h, g, k, m, x, n, p, q, r, u, v) {
            try {
                if (this.window = r,
                this.document = u,
                this.util = e,
                this.onError = this.util.bind(this.onError, this),
                this.onFault = this.util.bind(this.onFault, this),
                this.serialize = this.util.bind(this.serialize, this),
                this.config = new c(a),
                this.transmitter = new n(this.util,this.config),
                this.log = new k(this.util),
                this.api = new b(this.config,this.util,this.onError,this.serialize),
                this.metadata = new m(this.serialize),
                this.environment = new g,
                this.customer = new h(this.config,this.util,this.log,this.window,this.document),
                this.customer.token && (this.apiConsoleWatcher = new f(this.util,this.log,this.onError,this.onFault,this.serialize,this.api,this.config.defaults.console),
                this.config.current.enabled && (this.windowConsoleWatcher = new f(this.util,this.log,this.onError,this.onFault,this.serialize,this.window,this.config.current.console),
                this.util.isBrowserSupported()))) {
                    this.callbackWatcher = new d(this.config.current.callback,this.onError,this.onFault);
                    this.visitorWatcher = new p(this.util,this.log,this.onError,this.onFault,this.document,this.config.current.visitor);
                    this.navigationWatcher = new v(this.log,this.config.current.navigation);
                    this.networkWatcher = new x(this.util,this.log,this.onError,this.onFault,this.window,this.config.current.network);
                    this.windowWatcher = new q(this.onError,this.onFault,this.serialize,this.window,this.config.current.window);
                    var t = this;
                    e.afterDocumentLoad(function() {
                        t.transmitter.sendUsage({
                            token: t.customer.token,
                            correlationId: t.customer.correlationId,
                            application: t.config.current.application,
                            x: t.util.uuid()
                        })
                    })
                }
            } catch (w) {
                this.onFault(w)
            }
        };
        E.prototype = {
            reveal: function() {
                if (this.customer.token)
                    return this.api.addMetadata = this.metadata.addMetadata,
                    this.api.removeMetadata = this.metadata.removeMetadata,
                    this.api;
                this.config.current.enabled && this.window.console && this.window.console.warn && this.window.console.warn("TrackJS could not find a token");
                return n
            },
            onError: function() {
                var a, b = !1;
                return function(d, c, f) {
                    if (e.isBrowserSupported() && this.config.current.enabled)
                        try {
                            if (f = f || {
                                bindStack: null,
                                bindTime: null,
                                force: !1
                            },
                            c && e.isError(c) || (c = {
                                name: "Error",
                                message: this.serialize(c, f.force)
                            }),
                            -1 === c.message.indexOf("TrackJS Caught"))
                                if (b && -1 !== c.message.indexOf("Script error"))
                                    b = !1;
                                else {
                                    var h = e.defaultsDeep({}, {
                                        bindStack: f.bindStack,
                                        bindTime: f.bindTime,
                                        column: c.column || c.columnNumber,
                                        console: this.windowConsoleWatcher.report(),
                                        customer: this.customer.report(),
                                        entry: d,
                                        environment: this.environment.report(),
                                        file: c.file || c.fileName,
                                        line: c.line || c.lineNumber,
                                        message: c.message,
                                        metadata: this.metadata.report(),
                                        nav: this.navigationWatcher.report(),
                                        network: this.networkWatcher.report(),
                                        url: (g.location || "").toString(),
                                        stack: c.stack,
                                        timestamp: this.util.isoNow(),
                                        visitor: this.visitorWatcher.report(),
                                        version: "2.12.0"
                                    });
                                    if (!f.force)
                                        try {
                                            if (!this.config.current.onError(h, c))
                                                return
                                        } catch (m) {
                                            h.console.push({
                                                timestamp: this.util.isoNow(),
                                                severity: "error",
                                                message: m.message
                                            });
                                            var l = this;
                                            setTimeout(function() {
                                                l.onError("catch", m, {
                                                    force: !0
                                                })
                                            }, 0)
                                        }
                                    if (this.config.current.dedupe) {
                                        var k = (h.message + h.stack).substr(0, 1E4);
                                        if (k === a)
                                            return;
                                        a = k
                                    }
                                    (function() {
                                        function a() {
                                            var b = 0;
                                            e.forEach(h.console, function(a) {
                                                b += (a.message || "").length
                                            });
                                            return 8E4 <= b
                                        }
                                        for (var b = 0; a() && b < h.console.length; )
                                            h.console[b].message = e.truncate(h.console[b].message, 1E3),
                                            b++
                                    }
                                    )();
                                    this.log.clear();
                                    setTimeout(function() {
                                        b = !1
                                    });
                                    b = !0;
                                    this.transmitter.sendError(h, this.customer.token)
                                }
                        } catch (m) {
                            this.onFault(m)
                        }
                }
            }(),
            onFault: function(a) {
                var b = this.transmitter || new r;
                a = a || {};
                a = {
                    token: this.customer.token,
                    file: a.file || a.fileName,
                    msg: a.message || "unknown",
                    stack: (a.stack || "unknown").substr(0, 500),
                    url: this.window.location,
                    v: "2.12.0",
                    h: "662fc956e2ea2e730646aa1be19c5cd7e7a61a63",
                    x: this.util.uuid()
                };
                b.sendTrackerFault(a)
            },
            serialize: function(a, b) {
                if (this.config.current.serialize && !b)
                    try {
                        return this.config.current.serialize(a)
                    } catch (d) {
                        this.onError("catch", d, {
                            force: !0
                        })
                    }
                return this.config.defaults.serialize(a)
            }
        };
        q = new E(g._trackJs || g._trackJS || g._trackjs || {},function(a, b, d, c) {
            return {
                attempt: function(a, c) {
                    try {
                        var e = Array.prototype.slice.call(arguments, 2);
                        return a.apply(c || this, e)
                    } catch (g) {
                        throw d("catch", g),
                        b.wrapError(g);
                    }
                },
                configure: function(b) {
                    return a.setCurrent(b)
                },
                track: function(a) {
                    var b = c(a);
                    a = a || {};
                    if (!a.stack)
                        try {
                            throw Error(b);
                        } catch (e) {
                            a = e
                        }
                    d("direct", a)
                },
                watch: function(a, c) {
                    return function() {
                        try {
                            var e = Array.prototype.slice.call(arguments, 0);
                            return a.apply(c || this, e)
                        } catch (g) {
                            throw d("catch", g),
                            b.wrapError(g);
                        }
                    }
                },
                watchAll: function(a) {
                    var c = Array.prototype.slice.call(arguments, 1), e;
                    for (e in a)
                        "function" === typeof a[e] && (b.contains(c, e) || function() {
                            var c = a[e];
                            a[e] = function() {
                                try {
                                    var a = Array.prototype.slice.call(arguments, 0);
                                    return c.apply(this, a)
                                } catch (e) {
                                    throw d("catch", e),
                                    b.wrapError(e);
                                }
                            }
                        }());
                    return a
                },
                hash: "662fc956e2ea2e730646aa1be19c5cd7e7a61a63",
                version: "2.12.0"
            }
        }
        ,q,u,v,w,y,z,function(a) {
            var b = {};
            return {
                addMetadata: function(a, c) {
                    b[a] = c
                },
                removeMetadata: function(a) {
                    delete b[a]
                },
                report: function() {
                    var d = [], c;
                    for (c in b)
                        b.hasOwnProperty(c) && d.push({
                            key: c,
                            value: a(b[c])
                        });
                    return d
                },
                store: b
            }
        }
        ,B,r,C,D,g,p,A);
        g.trackJs = q.reveal()
    }
}
)(window, document);
