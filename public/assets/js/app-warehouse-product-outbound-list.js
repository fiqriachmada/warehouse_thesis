$(function () {
  initializeDataTable();

  $(document).on('click', '[id^="btn-add-product-to-cart"]', function () {
    let product_id = $(this).attr('data-product-id');
    let warehouse_id = $(this).attr('data-warehouse-id');
  
    $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
  
    $.ajax({
        url: "/ajax/product-outbound/"+warehouse_id+"/store/"+product_id,
        method: "POST",
        processData: false,
        contentType: false,
        success: function(response) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Product Added To Cart',
            showConfirmButton: false,
            timer: 2500
          });
  
          // Destroy existing DataTable instance
          if ($.fn.DataTable.isDataTable('#listWarehouseProductsOutboundTable')) {
            $('#listWarehouseProductsOutboundTable').DataTable().destroy();
          }
  
          // Reload div and reinitialize DataTable
          $("#div-product-outbound").load(location.href + " #div-product-outbound", function() {
            initializeDataTable();
          });
  
          $("#div-cart-outbound").load(location.href + " #div-cart-outbound");
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
    });
  });

  $("#select_all_product_ids").on('click', function () {
    $("input[id^='checkbox_product_ids']").prop('checked', $(this).prop('checked'));
    $('#btn-add-all-product-to-cart').attr('disabled', !$(this).prop('checked'));
  });

  $(document).on("click", "[id^='checkbox_product_ids']", function () {
    if ($("[id^='checkbox_product_ids']:checked").length == $("[id^='checkbox_product_ids']").length) {
      $('#select_all_product_ids').prop('checked', true);
    } else {
      $('#select_all_product_ids').prop('checked', false);
    }

    if ($("[id^='checkbox_product_ids']:checked").length > 0) {
      $('#btn-add-all-product-to-cart').attr('disabled', false);
    } else {
      $('#btn-add-all-product-to-cart').attr('disabled', true);
    }
  });

  $(document).on("click", "#btn-add-all-product-to-cart", function () {
    let all_product_ids = [];
    let warehouse_id = $(this).attr('data-id');
    
    $('input[id^="checkbox_product_ids"]:checked').each(function() {
      all_product_ids.push($(this).val());
    });

    $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
  
    $.ajax({
        url: "/ajax/product-outbound/"+warehouse_id+"/store",
        method: "POST",
        data: {
          product_ids: all_product_ids
        },
        success: function(response) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Products Added To Cart',
            showConfirmButton: false,
            timer: 2500
          });
  
          // Destroy existing DataTable instance
          if ($.fn.DataTable.isDataTable('#listWarehouseProductsOutboundTable')) {
            $('#listWarehouseProductsOutboundTable').DataTable().destroy();
          }
  
          // Reload div and reinitialize DataTable
          $("#div-product-outbound").load(location.href + " #div-product-outbound", function() {
            initializeDataTable();
          });
  
          $("#div-cart-outbound").load(location.href + " #div-cart-outbound");
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
    });
  });

  $("#select_all_temp_outbound_ids").on('click', function () {
    $("input[id^='checkbox_temp_outbound_ids']").prop('checked', $(this).prop('checked'));
    $('#btn-delete-all-temp-outbound-to-cart').removeClass('d-none');
  });

  $(document).on("click", "[id^='checkbox_temp_outbound_ids']", function () {
      if ($("[id^='checkbox_temp_outbound_ids']:checked").length == $("[id^='checkbox_temp_outbound_ids']").length) {
          $('#select_all_temp_outbound_ids').prop('checked', true);
      } else {
          $('#select_all_temp_outbound_ids').prop('checked', false);
      }

      if ($("[id^='checkbox_temp_outbound_ids']:checked").length > 0) {
          $('#btn-delete-all-temp-outbound-to-cart').removeClass('d-none');
      } else {
          $('#btn-delete-all-temp-outbound-to-cart').addClass('d-none');
      }
  });

  $(document).on("click", "#btn-delete-all-temp-outbound-to-cart", function () {
    let all_temp_outbound_ids = [];
    let warehouse_id = $(this).attr('data-id');
    
    $('input[id^="checkbox_temp_outbound_ids"]:checked').each(function() {
      all_temp_outbound_ids.push($(this).val());
    });

    $.ajaxSetup({
      headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
      },
    });
  
    $.ajax({
        url: "/ajax/temp-outbound/"+warehouse_id+"/delete",
        method: "POST",
        data: {
          temp_outbound_ids: all_temp_outbound_ids
        },
        success: function(response) {
          Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Temp Outbound Products Deleted',
            showConfirmButton: false,
            timer: 2500
          });
  
          // Destroy existing DataTable instance
          if ($.fn.DataTable.isDataTable('#listWarehouseProductsOutboundTable')) {
            $('#listWarehouseProductsOutboundTable').DataTable().destroy();
          }
  
          // Reload div and reinitialize DataTable
          $("#div-product-outbound").load(location.href + " #div-product-outbound", function() {
            initializeDataTable();
          });
  
          $("#div-cart-outbound").load(location.href + " #div-cart-outbound");
        },
        error: function(xhr, status, error) {
          console.log(error);
        }
    });
  });
});

function initializeDataTable() {
  var dt_brand_table = $('#listWarehouseProductsOutboundTable');
  var warehouse_id = dt_brand_table.attr('data-id');

  if (dt_brand_table.length) {
    dt_brand_table.DataTable({
      ajax: "/listWarehouseProductsOutboundTable/"+ warehouse_id,
      processing: false,
      serverSide: false,
      columns: [
        { data: '' },
        { data: 'checkbox', class: 'text-center' },
        { data: 'name', class: 'text-center' },
        { data: 'category', class: 'text-center' },
        { data: 'rack', class: 'text-center' },
        { data: 'actual_stock', class: 'text-center' },
        { data: 'sale_price', class: 'text-center' },
        { data: 'weight', class: 'text-center' },
        { data: 'dimension', class: 'text-center' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.checkbox;
          }
        },
        {
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.name;
          }
        },
        {
          targets: 3,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.category;
          }
        },
        {
          targets: 4,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.rack;
          }
        },
        {
          targets: 5,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.actual_stock;
          }
        },
        {
          targets: 6,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.sale_price;
          }
        },
        {
          targets: 7,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.weight;
          }
        },
        {
          targets: 8,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.dimension;
          }
        },
        {
          targets: -1,
          title: 'Actions',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
              return full.action;
          }
        },
      ],
      order: [[1, 'desc']],
      dom:
        '<"row me-2"' +
        '<"col-md-2"<"me-3"l>>' +
        '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
        '>t' +
        '<"row mx-2"' +
        '<"col-sm-12 col-md-6"i>' +
        '<"col-sm-12 col-md-6"p>' +
        '>',
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Search..'
      },
      buttons: [
        {
          text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Add To Cart</span>',
          className: 'add-new btn btn-primary ms-3',
          attr: {
            'id': 'btn-add-all-product-to-cart',
            'disabled': true,
            'data-id': warehouse_id
          }
        }
      ],
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Rincian';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== ''
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
  }
}
