/**
 * Page User List
 */

'use strict';

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

  var dt_brand_table = $('#listWarehousesTable');

  if (dt_brand_table.length) {
    var dt_user = dt_brand_table.DataTable({
      ajax: "/listWarehousesTable/show",
      columns: [
        { data: '' },
        { data: 'index', class: 'text-center' },
        { data: 'name' },
        { data: 'category', class: 'text-center' },
        { data: 'capacity', class: 'text-center' },
        { data: 'surface_area', class: 'text-center' },
        { data: 'building_area', class: 'text-center' },
        { data: 'country', class: 'text-center' },
        { data: 'zip_code', class: 'text-center' },
        { data: 'city', class: 'text-center' },
        { data: 'address' },
        { data: 'storage_shelves', class: 'text-center' },
        { data: 'goods_handling_equipment', class: 'text-center' },
        { data: 'effective_lighting_system', class: 'text-center' },
        { data: 'advanced_security_system', class: 'text-center' },
        { data: 'toilet_and_rest_area', class: 'text-center' },
        { data: 'electricity', class: 'text-center' },
        { data: 'administrative_room_or_office', class: 'text-center' },
        { data: 'worker_safety_equipment', class: 'text-center' },
        { data: 'firefighting_tools', class: 'text-center' },
        { data: 'description' },
        { data: 'admin', class: 'text-center' },
        { data: 'created_at', class: 'text-center' },
        { data: 'status', class: 'text-center' },
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
            return full.index;
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
          render: function (data, type, full, meta) {
            return full.capacity;
          }
        },
        {
          targets: 5,
          render: function (data, type, full, meta) {
            return full.surface_area;
          }
        },
        {
          targets: 6,
          render: function (data, type, full, meta) {
            return full.building_area;
          }
        },
        {
          targets: 7,
          render: function (data, type, full, meta) {
            return full.country;
          }
        },
        {
          targets: 8,
          render: function (data, type, full, meta) {
            return full.zip_code;
          }
        },
        {
          targets: 9,
          render: function (data, type, full, meta) {
            return full.city;
          }
        },
        {
          targets: 10,
          render: function (data, type, full, meta) {
            return full.address;
          }
        },
        {
          targets: 11,
          render: function (data, type, full, meta) {
            return full.storage_shelves;
          }
        },
        {
          targets: 12,
          render: function (data, type, full, meta) {
            return full.goods_handling_equipment;
          }
        },
        {
          targets: 13,
          render: function (data, type, full, meta) {
            return full.effective_lighting_system;
          }
        },
        {
          targets: 14,
          render: function (data, type, full, meta) {
            return full.advanced_security_system;
          }
        },
        {
          targets: 15,
          render: function (data, type, full, meta) {
            return full.toilet_and_rest_area;
          }
        },
        {
          targets: 16,
          render: function (data, type, full, meta) {
            return full.electricity;
          }
        },
        {
          targets: 17,
          render: function (data, type, full, meta) {
            return full.administrative_room_or_office;
          }
        },
        {
          targets: 18,
          render: function (data, type, full, meta) {
            return full.worker_safety_equipment;
          }
        },
        {
          targets: 19,
          render: function (data, type, full, meta) {
            return full.firefighting_tools;
          }
        },
        {
          targets: 20,
          render: function (data, type, full, meta) {
            return full.description;
          }
        },
        {
          targets: 21,
          render: function (data, type, full, meta) {
            return full.admin;
          }
        },
        {
          targets: 22,
          render: function (data, type, full, meta) {
            return full.created_at;
          }
        },
        {
          targets: 23,
          render: function (data, type, full, meta) {
            return full.status;
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
          extend: 'collection',
          className: 'btn btn-label-secondary dropdown-toggle mx-3',
          text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
          buttons: [
            {
              extend: 'print',
              text: '<i class="ti ti-printer me-2" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
              },
              customize: function (win) {
                $(win.document.body)
                  .css('color', headingColor)
                  .css('border-color', borderColor)
                  .css('background-color', bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="ti ti-file-text me-2" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
              }
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-2" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23],
              }
            }
          ]
        },
        {
          text: '<i class="ti ti-plus me-0 me-sm-1 ti-xs"></i><span class="d-none d-sm-inline-block">Warehouse</span>',
          className: 'add-new btn btn-primary',
          attr: {
            'id': 'button-add-warehouse'
          }
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Details';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
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

  // Delete Record
  $(document).on('click', '#button-delete-warehouse', function () {
    let id = $(this).attr('data-id');
    let formSelector = ".form-delete-warehouse-" + id;

    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cancel',
      confirmButtonText: 'Yes, Delete!',
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

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
