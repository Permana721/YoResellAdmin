$((function() {
    "use strict";
    var e, t, n, a, o, l, s = $(".btn-apply-changes"),
        c = $(".source-item"),
        i = new Date,
        r = $(".date-picker"),
        d = $(".due-date-picker"),
        p = $(".invoiceto"),
        u = $("#customer-country"),
        m = $(".btn-add-new "),
        h = {
            "App Design": "Designed UI kit & app pages.",
            "App Customization": "Customization & Bug Fixes.",
            "ABC Template": "Bootstrap 4 admin template.",
            "App Development": "Native App Development."
        },
        f = {
            shelby: {
                name: "Thomas Shelby",
                company: "Shelby Company Limited",
                address: "Small Heath, Birmingham",
                pincode: "B10 0HF",
                country: "UK",
                tel: "Tel: 718-986-6062",
                email: "peakyFBlinders@gmail.com"
            },
            hunters: {
                name: "Dean Winchester",
                company: "Hunters Corp",
                address: "951  Red Hawk Road Minnesota,",
                pincode: "56222",
                country: "USA",
                tel: "Tel: 763-242-9206",
                email: "waywardSon@gmail.com"
            }
        };

    function g(e, t) {
        e.closest(".repeater-wrapper").find(t).text(e.val())
    }
    r.length && r.each((function() {
        $(this).flatpickr({
            defaultDate: i
        })
    })), d.length && d.flatpickr({
        defaultDate: new Date(i.getFullYear(), i.getMonth(), i.getDate() + 5)
    }), u.length && u.select2({
        placeholder: "Select country",
        dropdownParent: u.parent()
    }), $(document).on("click", ".add-new-customer", (function() {
        p.select2("close")
    })), p.length && (p.select2({
        placeholder: "Select Customer",
        dropdownParent: $(".invoice-customer")
    }), p.on("change", (function() {
        var e = $(this),
            t = '<div class="customer-details mt-1"><p class="mb-25">' + f[e.val()].name + '</p><p class="mb-25">' + f[e.val()].company + '</p><p class="mb-25">' + f[e.val()].address + '</p><p class="mb-25">' + f[e.val()].country + '</p><p class="mb-0">' + f[e.val()].tel + '</p><p class="mb-0">' + f[e.val()].email + "</p></div>";
        $(".row-bill-to").find(".customer-details").remove(), $(".row-bill-to").find(".col-bill-to").append(t)
    })), p.on("select2:open", (function() {
        $(document).find(".add-new-customer").length || $(document).find(".select2-results__options").before('<div class="add-new-customer btn btn-flat-success cursor-pointer rounded-0 text-start mb-50 p-50 w-100" data-bs-toggle="modal" data-bs-target="#add-new-customer-sidebar">' + feather.icons.plus.toSvg({
            class: "font-medium-1 me-50"
        }) + '<span class="align-middle">Add New Customer</span></div>')
    }))), c.length && (c.on("submit", (function(e) {
        e.preventDefault()
    })), c.repeater({
        show: function() {
            $(this).slideDown()
        },
        hide: function(e) {
            $(this).slideUp()
        }
    })), $(document).on("click", ".tax-select", (function(e) {
        e.stopPropagation()
    })), s.length && $(document).on("click", ".btn-apply-changes", (function(s) {
        var c = $(this);
        if (o = c.closest(".dropdown-menu").find("#tax-1-input"), l = c.closest(".dropdown-menu").find("#tax-2-input"), a = c.closest(".dropdown-menu").find("#discount-input"), t = c.closest(".repeater-wrapper").find(".tax-1"), n = c.closest(".repeater-wrapper").find(".tax-2"), e = $(".discount"), null !== o.val() && g(o, t), null !== l.val() && g(l, n), a.val().length) {
            var i = a.val() <= 100 ? a.val() : 100;
            c.closest(".repeater-wrapper").find(e).text(i + "%")
        }
    })), $(document).on("change", ".item-details", (function() {
        var e = $(this),
            t = h[e.val()];
        e.next("textarea").length ? e.next("textarea").val(t) : e.after('<textarea class="form-control mt-2" rows="2">' + t + "</textarea>")
    })), m.length && m.on("click", (function() {
        feather && feather.replace({
            width: 14,
            height: 14
        });
        [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).map((function(e) {
            return new bootstrap.Tooltip(e)
        }))
    }))
}));