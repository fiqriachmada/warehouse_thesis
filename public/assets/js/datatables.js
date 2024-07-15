$(document).ready(function () {
    $('#dataAdmin').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/dataAdmin',
        columns: [
            { data: 'id', name: 'id', class: 'text-center' },
            { data: 'name', name: 'name', class: 'text-center text-capitalize' },
            { data: 'email', name: 'email', class: 'text-center' },
            { data: 'phone', name: 'phone', class: 'text-center' },
            { data: 'pdob', name: 'pdob', class: 'text-center text-capitalize' },
            { data: 'gender', name: 'gender', class: 'text-center text-capitalize' },
            { data: 'action', name: 'action', class: 'text-center' }
        ]
    });
});