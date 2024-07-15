$(document).ready(() => {
    allMasterDetailData();
});

const masterDetailData = (url, targetSelector, search) => {
    return $.get(url, { search: search || 'default' })
        .done(data => {
            $(targetSelector).html(data);
        })
        .fail((jqXHR, textStatus, errorThrown) => {
            return;
        });
};

const allMasterDetailData = () => {
    const adminId = $(".nav-link-admin").attr('data-id');
    const tenantId = $(".nav-link-tenant").attr('data-id');
    const warehouseId = $(".nav-link-warehouse").attr('data-id');
    
    if (adminId) {
        masterDetailData("/ajax/admin-details/"+adminId+'/account', "#data-admin-detail");
    }

    if (tenantId) {
        masterDetailData("/ajax/tenant-details/"+tenantId+'/account', "#data-tenant-detail");
    }

    if (warehouseId) {
        masterDetailData("/ajax/warehouse-details/"+warehouseId+'/rental-activity', "#data-warehouse-detail");
    }

    masterDetailData('/ajax/admin-details/new-purchase-count', "#label-new-purchase-count");
};

$('.nav-link-admin').on('click', function () {
    let pos = $(this).attr('id');
    const adminId = $(this).attr('data-id');
  
    $('.nav-link').removeClass('active');
    $(this).addClass('active');
  
    if (pos == 'account') {
      allMasterDetailData();
    } else if (pos == 'security') {
      masterDetailData("/ajax/admin-details/"+adminId+'/security', "#data-admin-detail");
    }
});

$('.nav-link-tenant').on('click', function () {
    let pos = $(this).attr('id');
    const adminId = $(this).attr('data-id');
  
    $('.nav-link').removeClass('active');
    $(this).addClass('active');
  
    if (pos == 'account') {
      allMasterDetailData();
    } else if (pos == 'security') {
      masterDetailData("/ajax/tenant-details/"+adminId+'/security', "#data-tenant-detail");
    }
});

$(document).on('click', '#button-trigger-modal-edit-admin', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/admin/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-admin-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});


$(document).on('click', '#button-trigger-modal-edit-tenant', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/tenant/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-tenant-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-edit-warehouse-category', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/warehouse-category/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-warehouse-category-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-edit-subscription', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/subscription/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-subscription-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-edit-tax', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/tax/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-tax-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-edit-bank-account', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/bank-account/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-bank-account-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-show-list-warehouses', function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/warehouse/show",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-show-list-warehouses-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
      split = number_string.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);
    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;

    return prefix === undefined ? 'Rp. ' + rupiah : (rupiah ? prefix + rupiah : '');
}

function formatRupiahV2(angka) {
    var number_string = angka.toString();
    var split = number_string.split(',');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    if (ribuan) {
      separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return 'Rp ' + rupiah;
}

$(document).on('click', '#button-submit-image-change', function(e) {
    let filePath = $('#image').val();

    let allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if (!allowedExtensions.exec(filePath)) {
        e.preventDefault();
        alert('Invalid file type. Please select a valid image file (jpg, jpeg, png).');
        return false;
    }

    $(this).submit();
});

$(document).on('click', '#button-add-rental-price-calculation', function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/calculation/rental-price/clear",
        method: "post",
        success: function(response) {
            location.href = '/calculation/rental-price/add';
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-choose-warehouse', function (e) {
    let warehouse_id = $(this).attr('data-id');
    let formSelector = ".form-choose-warehouse-" + warehouse_id;

    $(formSelector).submit();
})

$(document).on('keydown', '#price_rate', function(event) {
    let charCode = event.which;
    
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        event.preventDefault();
        alert("Please enter only numbers for price rate!");
    }
});

$(document).on('input', '#price_rate', function() {
    let price_rate = $(this);
    let price_rate_value = price_rate.val();
    let total_price = $("#total_price");
    let subscription_month_duration = $("#subscription_id").find(':selected');
    let subscription_month_duration_value = subscription_month_duration.attr('data-month-duration');
    let warehouse = $("#warehouse_id");
    let warehouse_value = warehouse.val();
    let building_area_value = warehouse.attr('data-building-area');
    let surface_area_value = warehouse.attr('data-surface-area');

    if (subscription_month_duration.text() === "Select Subscription") {
      price_rate.val('');
      alert("Please choose a subscription!");
    } else if (subscription_month_duration.text() === "No Subscription") {
      price_rate.val('');
      alert("Please add subscription!");
    }

    if (warehouse_value == '') {
      price_rate.val('');
      alert("Please choose a warehouse!");
    }

    price_rate.val(formatRupiah(price_rate_value));
    total_price.val(calculateRentalPrice(price_rate_value, subscription_month_duration_value, building_area_value, surface_area_value)).attr('data-total-price', calculateRentalPrice(price_rate_value, subscription_month_duration_value, building_area_value, surface_area_value));
});

function calculateRentalPrice(price_rate_value, subscription_month_duration_value, building_area_value, surface_area_value) {
    let price_rate = price_rate_value.replace(/\D/g, '');
    let total_rental_price = ((price_rate * building_area_value) + ((surface_area_value - building_area_value) * price_rate)) * subscription_month_duration_value; 

    return formatRupiahV2(total_rental_price);
}

$(document).on('click', '#subscription_id', function () {
    let warehouse_id = $("#warehouse_id").attr('data-id');
    let price_rate_value = $("#price_rate").val().replace(/\D/g, '');
    let total_price = $("#total_price");
    let total_price_value = total_price.attr('data-total-price');
    let subscription = $(this).find(':selected');
    let subscription_id = subscription.val();
    let subscription_month_duration_value = subscription.attr('data-month-duration');
    let warehouse = $("#warehouse_id");
    let building_area_value = warehouse.attr('data-building-area');
    let surface_area_value = warehouse.attr('data-surface-area');
    
    if (subscription.text() != 'Select Subscription' && subscription.text() != 'No Subscription') {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    
        $.ajax({
            url: "/calculation/rental-price/add/" + warehouse_id,
            method: "post",
            data: {subscription_id: subscription_id, price_rate: price_rate_value, total_price: total_price_value},
            success: function(response) {
                total_price.val(calculateRentalPrice(price_rate_value, subscription_month_duration_value, building_area_value, surface_area_value)).attr('data-total-price', calculateRentalPrice(price_rate_value, subscription_month_duration_value, building_area_value, surface_area_value));
            },
            error: function(xhr, status, error) {
            }
        });
    }
});

$(document).on('blur', '#price_rate', function() {
    let warehouse_id = $("#warehouse_id").attr('data-id');
    let price_rate_value = $(this).val().replace(/\D/g, '');
    let total_price_value = $("#total_price").attr('data-total-price');
    let subscription = $("#subscription_id").find(':selected');
    let subscription_id = subscription.val();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/calculation/rental-price/add/" + warehouse_id,
        method: "post",
        data: {subscription_id: subscription_id, price_rate: price_rate_value, total_price: total_price_value},
        success: function(response) {
            return;
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-submit-warehouse-subscription', function () {
    const form_warehouse_subscription = $("#form-warehouse-subscription");

    form_warehouse_subscription.attr('action', '/calculation/rental-price/add');

    form_warehouse_subscription.submit();
});

$(document).on('click', '#button-cancel-warehouse-subscription', function () {
    const form_warehouse_subscription = $("#form-warehouse-subscription");

    form_warehouse_subscription.attr('action', '/calculation/rental-price/cancel');

    form_warehouse_subscription.submit();
});

$(document).on('click', '#button-edit-warehouse-subscription', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/warehouse_subscription/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            location.href = '/calculation/rental-price/'+id+'/edit';
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-update-warehouse-subscription', function () {
    const form_warehouse_subscription = $("#form-warehouse-subscription");
    const warehouse_subscription_id = $(this).attr('data-id');

    form_warehouse_subscription.attr('action', '/calculation/rental-price/'+warehouse_subscription_id);

    form_warehouse_subscription.submit();
});

$(document).on('click', '#button-add-warehouse', function () {
    location.href = "/master/warehouse/add";
});

$(document).on('click', '#button-add-biling-submit', function () {
    let form = $("#creditCardForm");
    form.attr('onsubmit', 'true');
    form.submit();
});

$(document).on('click', '#button-delete-bank-account', function () {
    let id = $(this).attr('data-id');
    let formSelector = "#form-delete-bank-account-" + id;

    Swal.fire({
      title: 'Are you sure?',
      text: "Bank Account will be deleted!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cancel',
      confirmButtonText: 'Yes, Delete it!',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.isConfirmed) {
        $(formSelector).submit();
      }
    });
});

$(document).on('click', '#button-trigger-modal-detail-tax-amount', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/tax/"+id+"/show",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-detail-tax-amount-modal").html(response);
            $("#listDetailTaxesReportTable").attr('data-id', id);
        },
        error: function(xhr, status, error) {
        }
    });
});