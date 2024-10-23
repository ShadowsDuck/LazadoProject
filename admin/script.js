const editor = new DataTable.Editor({
    ajax: '../php/staff.php',
    fields: [
        {
            label: 'First name:',
            name: 'first_name'
        },
        {
            label: 'Last name:',
            name: 'last_name'
        },
        {
            label: 'Position:',
            name: 'position'
        },
        {
            label: 'Office:',
            name: 'office'
        },
        {
            label: 'Extension:',
            name: 'extn'
        },
        {
            label: 'Start date:',
            name: 'start_date',
            type: 'datetime'
        },
        {
            label: 'Salary:',
            name: 'salary'
        }
    ],
    table: '#example'
});
 
const table = new DataTable('#example', {
    ajax: '../php/staff.php',
    columns: [
        {
            data: null,
            render: (data) => data.first_name + ' ' + data.last_name
        },
        { data: 'position' },
        { data: 'office' },
        { data: 'extn' },
        { data: 'start_date' },
        { data: 'salary', render: DataTable.render.number(null, null, 0, '$') },
        {
            data: null,
            className: 'dt-center editor-edit',
            defaultContent: '<button><i class="fa fa-pencil"/></button>',
            orderable: false
        },
        {
            data: null,
            className: 'dt-center editor-delete',
            defaultContent: '<button><i class="fa fa-trash"/></button>',
            orderable: false
        }
    ],
    layout: {
        topStart: {
            buttons: [
                {
                    text: 'Create new record',
                    action: function () {
                        // Create new record
                        editor.create({
                            title: 'Create new record',
                            buttons: 'Add'
                        });
                    }
                }
            ]
        }
    }
});
 
// Edit record
table.on('click', 'td.editor-edit button', function (e) {
    editor.edit(e.target.closest('tr'), {
        title: 'Edit record',
        buttons: 'Update'
    });
});
 
// Delete a record
table.on('click', 'td.editor-delete button', function (e) {
    editor.remove(e.target.closest('tr'), {
        title: 'Delete record',
        message: 'Are you sure you wish to remove this record?',
        buttons: 'Delete'
    });
});