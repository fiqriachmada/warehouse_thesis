$(document).on('click', '.btn-submit-inbound', function () {
    let formInbound = $('.form-submit-inbound');
    formInbound.attr('onsubmit', 'return true');
    formInbound.submit();
});

$(function(){
    $("#sale_price, #price").keyup(function(e){
      $(this).val(format($(this).val()));
    });
});

var format = function(num){
    var str = num.toString().replace("", ""), parts = false, output = [], i = 1, formatted = null;
    if(str.indexOf(".") > 0) {
      parts = str.split(".");
      str = parts[0];
    }
    str = str.split("").reverse();
    for(var j = 0, len = str.length; j < len; j++) {
      if(str[j] != ",") {
        output.push(str[j]);
        if(i%3 == 0 && j < (len - 1)) {
          output.push(",");
        }
        i++;
      }
    }
    formatted = output.reverse().join("");
    return("" + formatted + ((parts) ? "." + parts[1].substr(0, 2) : ""));
};

$(document).on('click', '#button-trigger-modal-edit-product-category', function () {
  let id = $(this).attr('data-id');

  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });

  $.ajax({
      url: "/ajax/product-category/"+id+"/edit",
      method: "get",
      processData: false,
      contentType: false,
      success: function(response) {
          $("#data-edit-product-category-modal").html(response);
      },
      error: function(xhr, status, error) {
      }
  });
});

$(document).on('click', '#button-trigger-modal-edit-rack', function () {
  let id = $(this).attr('data-id');

  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });

  $.ajax({
      url: "/ajax/rack/"+id+"/edit",
      method: "get",
      processData: false,
      contentType: false,
      success: function(response) {
          $("#data-edit-rack-modal").html(response);
      },
      error: function(xhr, status, error) {
      }
  });
});

$(document).on('click', '#button-trigger-modal-edit-supplier', function () {
  let id = $(this).attr('data-id');

  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });

  $.ajax({
      url: "/ajax/supplier/"+id+"/edit",
      method: "get",
      processData: false,
      contentType: false,
      success: function(response) {
          $("#data-edit-supplier-modal").html(response);
      },
      error: function(xhr, status, error) {
      }
  });
});

$(document).on('click', '#add-new-customer', function () {
  let id = $(this).attr('data-id');

  $("#AddCustomerOutbound").modal('show');

  $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
  });

  $.ajax({
      url: "/ajax/customer-outbound/"+id+"/create",
      method: "get",
      processData: false,
      contentType: false,
      success: function(response) {
          $("#data-create-customer-modal").html(response);
      },
      error: function(xhr, status, error) {
      }
  });
});

$(document).on('change', '[id^="quantity"]', function () {
    let id = $(this).attr('data-id');
    let quantity = $(this).val();

    let value = parseInt(quantity);
    let min = parseInt($(this).attr('min'));
    let max = parseInt($(this).attr('max'));
    let quantity_now = '';

    if (value < min) {
        $(this).val(min);
    } else if (value > max) {
        $(this).val(max);
    }

    quantity_now = $(this).val();

    if (quantity_now <= max && quantity_now >= min) {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    
        $.ajax({
            url: "/ajax/product-quantity-outbound/"+id+"/edit",
            method: "post",
            data: {
                quantity: quantity_now
            },
            success: function(response) {
                $("#div-cart-outbound").load(location.href + " #div-cart-outbound");
            },
            error: function(xhr, status, error) {
            }
        });
    }
});

$(document).on('click', '[id^="btn-delete-outbound"]', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/product-outbound/"+id+"/delete",
        method: "post",
        success: function(response) {
            if (response) {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Delete Success',
                    showConfirmButton: false,
                    timer: 2500
                });
            }

            $("#div-product-outbound").load(location.href + " #div-product-outbound", function() {
                initializeDataTable();
            });
      
            $("#div-cart-outbound").load(location.href + " #div-cart-outbound");
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#btn-submit-outbound', function () {
    let customer_id = $("#customer_id").val();
    let warehouse_id = $(this).attr('data-id');

    if (customer_id == '') {
        alert('Please Select Customer!');
        // window.location.reload();
    }

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/warehouse/"+warehouse_id+"/outbounds/store",
        method: "post",
        success: function(response) {
            if (response) {
                setTimeout(function() {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Outbound Success',
                        showConfirmButton: false,
                        timer: 2500
                    });
                }, 2500);

                window.open('/warehouse/'+warehouse_id+'/outbound/'+response, '_blank');
                window.location.reload();
            }
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-edit-inbound', function () {
    let id = $(this).attr('data-id');
  
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
  
    $.ajax({
        url: "/ajax/inbound/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-inbound-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
  });

$(document).on('click', '#button-trigger-modal-detail-warehouse-product-performance', function () {
    let id = $(this).attr('data-id');
  
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
  
    $.ajax({
        url: "/ajax/warehouse-product-performance/"+id+"/detail",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-detail-warehouse-product-performance-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-detail-warehouse-supplier-performance', function () {
    let id = $(this).attr('data-id');
  
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
  
    $.ajax({
        url: "/ajax/warehouse-supplier-performance/"+id+"/detail",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-detail-warehouse-supplier-performance-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-detail-warehouse-customer-performance', function () {
    let id = $(this).attr('data-id');
  
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
  
    $.ajax({
        url: "/ajax/warehouse-customer-performance/"+id+"/detail",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-detail-warehouse-customer-performance-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});