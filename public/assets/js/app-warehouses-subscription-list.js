/**
 * Page User List
 */

"use strict";

// Datatable (jquery)
$(function () {
    let borderColor, bodyBg, headingColor;

    if (isDarkStyle) {
        borderColor = config.colors_dark.borderColor;
        bodyBg = config.colors_dark.bodyBg;
        headingColor = config.colors_dark.headingColor;
    } else {
        borderColor = config.colors.borderColor;
        bodyBg = config.colors.bodyBg;
        headingColor = config.colors.headingColor;
    }

    var dt_brand_table = $("#listWarehousesSubscriptionTable");
    if (dt_brand_table.length) {
        var dt_user = dt_brand_table.DataTable({
            ajax: "/listWarehousesTable/choose",
            columns: [
                { data: "" },
                { data: "index", class: "text-center" },
                { data: "name" },
                { data: "category", class: "text-center" },
                { data: "capacity", class: "text-center" },
                { data: "surface_area", class: "text-center" },
                { data: "building_area", class: "text-center" },
                { data: "country", class: "text-center" },
                { data: "zip_code", class: "text-center" },
                { data: "city", class: "text-center" },
                { data: "address" },
                { data: "storage_shelves", class: "text-center" },
                { data: "goods_handling_equipment", class: "text-center" },
                { data: "effective_lighting_system", class: "text-center" },
                { data: "advanced_security_system", class: "text-center" },
                { data: "toilet_and_rest_area", class: "text-center" },
                { data: "electricity", class: "text-center" },
                { data: "administrative_room_or_office", class: "text-center" },
                { data: "worker_safety_equipment", class: "text-center" },
                { data: "firefighting_tools", class: "text-center" },
                { data: "description" },
                { data: "admin", class: "text-center" },
                { data: "created_at", class: "text-center" },
                { data: "status", class: "text-center" },
                { data: "action" },
            ],
            columnDefs: [
                {
                    className: "control",
                    searchable: false,
                    orderable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    targets: 1,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return full.index;
                    },
                },
                {
                    targets: 2,
                    title: "Actions",
                    searchable: false,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return full.action;
                    },
                },

                {
                    targets: 3,
                    render: function (data, type, full, meta) {
                        return full.status;
                    },
                },

                {
                    targets: 4,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return full.name;
                    },
                },
                {
                    targets: 5,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        return full.category;
                    },
                },
                {
                    targets: 6,
                    render: function (data, type, full, meta) {
                        return full.capacity;
                    },
                },
                {
                    targets: 7,
                    render: function (data, type, full, meta) {
                        return full.surface_area;
                    },
                },
                {
                    targets: 8,
                    render: function (data, type, full, meta) {
                        return full.building_area;
                    },
                },
                {
                    targets: 9,
                    render: function (data, type, full, meta) {
                        return full.country;
                    },
                },
                {
                    targets: 10,
                    render: function (data, type, full, meta) {
                        return full.zip_code;
                    },
                },
                {
                    targets: 11,
                    render: function (data, type, full, meta) {
                        return full.city;
                    },
                },
                {
                    targets: 12,
                    render: function (data, type, full, meta) {
                        return full.address;
                    },
                },
                {
                    targets: 13,
                    render: function (data, type, full, meta) {
                        return full.storage_shelves;
                    },
                },
                {
                    targets: 14,
                    render: function (data, type, full, meta) {
                        return full.goods_handling_equipment;
                    },
                },
                {
                    targets: 15,
                    render: function (data, type, full, meta) {
                        return full.effective_lighting_system;
                    },
                },
                {
                    targets: 16,
                    render: function (data, type, full, meta) {
                        return full.advanced_security_system;
                    },
                },
                {
                    targets: 17,
                    render: function (data, type, full, meta) {
                        return full.toilet_and_rest_area;
                    },
                },
                {
                    targets: 18,
                    render: function (data, type, full, meta) {
                        return full.electricity;
                    },
                },
                {
                    targets: 19,
                    render: function (data, type, full, meta) {
                        return full.administrative_room_or_office;
                    },
                },
                {
                    targets: 20,
                    render: function (data, type, full, meta) {
                        return full.worker_safety_equipment;
                    },
                },
                {
                    targets: 21,
                    render: function (data, type, full, meta) {
                        return full.firefighting_tools;
                    },
                },
                {
                    targets: 22,
                    render: function (data, type, full, meta) {
                        return full.description;
                    },
                },
                {
                    targets: 23,
                    render: function (data, type, full, meta) {
                        return full.admin;
                    },
                },
                {
                    targets: -1,
                    render: function (data, type, full, meta) {
                        return full.created_at;
                    },
                },
            ],
            order: [[1, "desc"]],
            language: {
                sLengthMenu: "_MENU_",
                search: "",
                searchPlaceholder: "Search..",
            },
        });
    }

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
});
