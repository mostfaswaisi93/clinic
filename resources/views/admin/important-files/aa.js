! function(e) {
    var t = {};

    function r(n) { if (t[n]) return t[n].exports; var a = t[n] = { i: n, l: !1, exports: {} }; return e[n].call(a.exports, a, a.exports, r), a.l = !0, a.exports }
    r.m = e, r.c = t, r.d = function(e, t, n) { r.o(e, t) || Object.defineProperty(e, t, { enumerable: !0, get: n }) }, r.r = function(e) { "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, { value: "Module" }), Object.defineProperty(e, "__esModule", { value: !0 }) }, r.t = function(e, t) {
        if (1 & t && (e = r(e)), 8 & t) return e;
        if (4 & t && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (r.r(n), Object.defineProperty(n, "default", { enumerable: !0, value: e }), 2 & t && "string" != typeof e)
            for (var a in e) r.d(n, a, function(t) { return e[t] }.bind(null, a));
        return n
    }, r.n = function(e) { var t = e && e.__esModule ? function() { return e.default } : function() { return e }; return r.d(t, "a", t), t }, r.o = function(e, t) { return Object.prototype.hasOwnProperty.call(e, t) }, r.p = "/", r(r.s = 14)
}({
    14: function(e, t, r) { e.exports = r("3KQ5") },
    "3KQ5": function(e, t, r) {
        "use strict";
        var n = $("#nursesTbl").DataTable({
            processing: !0,
            serverSide: !0,
            order: [
                [1, "asc"]
            ],
            ajax: { url: nurseUrl, data: function(e) { e.status = $("#filter_status").find("option:selected").val() } },
            columnDefs: [{ targets: [0], orderable: !1, className: "text-center", width: "5%" }, { targets: "_all", defaultContent: "N/A" }, { targets: [6, 7], orderable: !1, className: "text-center", width: "5%" }],
            columns: [{ data: function(e) { return '<img src="'.concat(e.user.image_url, '" class="user-img">') }, name: "user.last_name" }, { data: function(e) { return '<a href="' + (nurseUrl + "/" + e.id) + '">' + e.user.full_name + "</a>" }, name: "user.first_name" }, { data: "user.email", name: "user.email" }, { data: function(e) { return isEmpty(e.user.phone) ? "N/A" : e.user.phone }, name: "user.phone" }, { data: "user.qualification", name: "user.qualification" }, { data: function(e) { return e }, render: function(e) { return null === e.user.dob ? "N/A" : moment(e.user.dob).format("Do MMM, Y") }, name: "user.dob" }, {
                data: function(e) {
                    var t = 0 == e.user.status ? "" : "checked",
                        r = [{ id: e.id, checked: t }];
                    return prepareTemplateRender("#nurseStatusTemplate", r)
                },
                name: "user.status"
            }, {
                data: function(e) {
                    var t = nurseUrl + "/" + e.id,
                        r = [{ id: e.id, url: t + "/edit" }];
                    return prepareTemplateRender("#nurseActionTemplate", r)
                },
                name: "id"
            }],
            fnInitComplete: function() { $("#filter_status").change((function() { $("#nursesTbl").DataTable().ajax.reload(null, !0) })) }
        });
        $(document).on("click", ".delete-btn", (function(e) {
            var t = $(e.currentTarget).data("id");
            deleteItem(nurseUrl + "/" + t, "#nursesTbl", "Nurse")
        })), $(document).on("change", ".status", (function(e) {
            var t = $(e.currentTarget).data("id");
            updateStatus(t)
        })), window.updateStatus = function(e) { $.ajax({ url: nurseUrl + "/" + +e + "/active-deactive", method: "post", cache: !1, success: function(e) { e.success && n.ajax.reload(null, !1) } }) }
    }
});