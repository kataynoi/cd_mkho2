$(document).ready(function () {
    var dataTable = $('#table_data').DataTable({
        'createdRow': function (row, data, dataIndex) {
            $(row).attr('name', 'row' + dataIndex);
        },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/news/fetch_news',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "orderable": false,
            },
        ],
    });

});

var crud = {};

crud.ajax = {
    del_data: function (id, cb) {
        var url = '/news/del_news',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/news/save_news',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/news/get_news',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};
crud.del_data = function (id) {

    crud.ajax.del_data(id, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            //swal('ลบข้อมูลเรียบร้อย')
            app.alert('ลบข้อมูลเรียบร้อย');

        }
    });
}

crud.save = function (items, row_id) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            if (items.action == 'insert') {
                crud.set_after_insert(items, data.id);
            } else if (items.action == 'update') {
                crud.set_after_update(items, row_id);
            }
            $('#frmModal').modal('toggle');
            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
        }
    });

}


crud.get_update = function (id, row_id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
            //location.reload();
            crud.set_update(data, row_id);
        }
    });

}


crud.set_after_update = function (items, row_id) {

    var row_id = $('tr[name="' + row_id + '"]');
    row_id.find("td:eq(0)").html(items.id);
    row_id.find("td:eq(1)").html(items.topic);
    row_id.find("td:eq(2)").html(items.detail);
    row_id.find("td:eq(3)").html(items.date_sent);
    row_id.find("td:eq(4)").html(items.user_id);
    row_id.find("td:eq(5)").html(items.cat_id);
    row_id.find("td:eq(6)").html(items.read);
    row_id.find("td:eq(7)").html(items.files);

}
crud.set_after_insert = function (items, id) {

    $('<tr name="row' + (id + 1) + '"><td>' + id + '</td>' +
        '<td>' + items.id + '</td>' + '<td>' + items.topic + '</td>' + '<td>' + items.detail + '</td>' + '<td>' + items.date_sent + '</td>' + '<td>' + items.user_id + '</td>' + '<td>' + items.cat_id + '</td>' + '<td>' + items.read + '</td>' + '<td>' + items.files + '</td>' +
        '<td><div class="btn-group pull-right" role="group">' +
        '<button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' + id + '"><i class="fa fa-eye"></i></button>' +
        '<button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' + id + '"><i class="fa fa-edit"></i></button>' +
        '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' + id + '"><i class="fa fa-trash"></i></button>' +
        '</td></div>' +
        '</tr>').insertBefore('table > tbody > tr:first');
}

crud.set_update = function (data, row_id) {
    $("#row_id").val(row_id);
    $("#id").val(data.rows["id"]);
    $("#topic").val(data.rows["topic"]);
    $("#detail").val(data.rows["detail"]);
    $("#date_sent").val(data.rows["date_sent"]);
    $("#user_id").val(data.rows["user_id"]);
    $("#cat_id").val(data.rows["cat_id"]);
    $("#read").val(data.rows["read"]);
    $("#file2").val(data.rows["file"]);
}

$('#frm_news').submit(function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    items.id = $("#id").val();
    items.topic = $("#topic").val();
    items.detail = $("#detail").val();
    //items.user_id = $("#user_id").val();
    items.cat_id = $("#cat_id").val();
    items.file = $("#file").val();
    if (validate(items)) {


        if (items.file) {
            $.ajax({
                url: 'upload/do_upload_file/',
                type: "post",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (data) {
                    if (data.success) {
                        items.file = data.file;
                        crud.save(items, row_id);
                    }
                }
            });

        } else {
            items.file = $("#file2").val();
            crud.save(items, row_id);
        }
    }
});

$('#add_data').on('click', function (e) {
    e.preventDefault();
    $("#frmModal input").prop('disabled', false);
    $("#frmModal select").prop('disabled', false);
    $("#frmModal textarea").prop('disabled', false);
    $("#frmModal .btn").prop('disabled', false);
    app.clear_form();
});

$(document).on('click', 'button[data-btn="btn_del"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    var td = $(this).parent().parent().parent();

    swal({
        title: "คำเตือน?",
        text: "คุณต้องการลบข้อมูล ",
        icon: "warning",
        buttons: [
            'cancel !',
            'Yes !'
        ],
        dangerMode: true,
    }).then(function (isConfirm) {
        if (isConfirm) {
            crud.del_data(id);
            td.hide();
        }
    });
});

$(document).on('click', 'button[data-btn="btn_edit"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
    $("#frmModal input").prop('disabled', false);
    $("#frmModal select").prop('disabled', false);
    $("#frmModal textarea").prop('disabled', false);
    $("#frmModal .btn").prop('disabled', false);

    crud.get_update(id, row_id);
    $('#frmModal').modal('show');

});

$(document).on('click', 'button[data-btn="btn_view"]', function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
    crud.get_update(id, row_id);
    $("#frmModal input").prop('disabled', true);
    $("#frmModalselect").prop('disabled', true);
    $("#frmModaltextarea").prop('disabled', true);
    $("#frmModal .btn").prop('disabled', true);
    $("#btn_close").prop('disabled', false);
    $('#frmModal').modal('show');

});

function validate(items) {

    if (!items.topic) {
        swal("กรุณาระบุหัวข้อ");
        $("#topic").focus();
    } else if (!items.detail) {
        swal("กรุณาระบุรายละเอียด");
        $("#detail").focus();
    } else if (!items.cat_id) {
        swal("กรุณาระบุหมวดหมู่");
        $("#cat_id").focus();
    }
    else {
        return true;
    }

}