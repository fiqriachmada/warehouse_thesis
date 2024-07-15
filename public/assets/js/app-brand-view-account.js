$(function () {
    'use strict';
  
    var dt_project_table = $('.datatable-brand-task');
    let brand_id = dt_project_table.attr('data-id');

    if (dt_project_table.length) {
      var dt_project = dt_project_table.DataTable({
        ajax: "/listBrandTasksTable/"+brand_id,
        columns: [
          { data: '' },
          { data: 'task' },
          { data: 'progress' },
          { data: 'start_date' },
          { data: 'end_date' }
        ],
        columnDefs: [
          {
            // For Responsive
            className: 'control',
            searchable: false,
            responsivePriority: 2,
            targets: 0,
            render: function (data, type, full, meta) {
              return '';
            }
          },
          {
            // User full name and email
            targets: 1,
            responsivePriority: 1,
            render: function (data, type, full, meta) {
              return full.task;
            }
          },
          {
            targets: 2,
            orderable: false,
            responsivePriority: 3,
            render: function (data, type, full, meta) {
              return full.progress;
            }
          },
          {
            targets: 3,
            render: function (data, type, full, meta) {
              return full.start_date;
            }
          },
          {
            targets: 4,
            render: function (data, type, full, meta) {
              return full.end_date;
            }
          },
          {
            targets: -1,
            orderable: false
          }
        ],
        order: [[1, 'desc']],
        dom:
          '<"d-flex justify-content-between align-items-center flex-column flex-sm-row mx-4 row"' +
          '<"col-sm-4 col-12 d-flex align-items-center justify-content-sm-start justify-content-center"l>' +
          '<"col-sm-8 col-12 d-flex align-items-center justify-content-sm-end justify-content-center"f>' +
          '>t' +
          '<"d-flex justify-content-between mx-4 row"' +
          '<"col-sm-12 col-md-6"i>' +
          '<"col-sm-12 col-md-6"p>' +
          '>',
        displayLength: 7,
        lengthMenu: [7, 10, 25, 50, 75, 100],
        language: {
          sLengthMenu: 'Show _MENU_',
          // search: '',
          searchPlaceholder: 'Search Project'
        },
        // For responsive popup
        responsive: {
          details: {
            display: $.fn.dataTable.Responsive.display.modal({
              header: function (row) {
                var data = row.data();
                return 'Details of ' + data['full_name'];
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
  
    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
      $('.dataTables_filter .form-control').removeClass('form-control-sm');
      $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
  });
  