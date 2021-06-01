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
            url: site_url + '/symptom/fetch_symptom',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [1, 2],
                "orderable": false,
            },
        ],
    });

});

var crud = {};

crud.ajax = {
    del_data: function (id, cb) {
        var url = '/symptom/del_symptom',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/symptom/save_symptom',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/symptom/get_symptom',
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

            $('#frmModal').modal('toggle');
            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
            //location.reload();

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
    row_id.find("td:eq(1)").html(items.cid);
    row_id.find("td:eq(2)").html(items.s_date);
    row_id.find("td:eq(3)").html(items.temperature);
    row_id.find("td:eq(4)").html(items.cough);
    row_id.find("td:eq(5)").html(items.throat);
    row_id.find("td:eq(6)").html(items.muscle);
    row_id.find("td:eq(7)").html(items.snot);
    row_id.find("td:eq(8)").html(items.mucus);
    row_id.find("td:eq(9)").html(items.gasp);
    row_id.find("td:eq(10)").html(items.headache);

}
crud.set_after_insert = function (items, id) {

    $('<tr name="row' + (id + 1) + '"><td>' + id + '</td>' +
        '<td>' + items.id + '</td>' + '<td>' + items.cid + '</td>' + '<td>' + items.s_date + '</td>' + '<td>' + items.temperature + '</td>' + '<td>' + items.cough + '</td>' + '<td>' + items.throat + '</td>' + '<td>' + items.muscle + '</td>' + '<td>' + items.snot + '</td>' + '<td>' + items.mucus + '</td>' + '<td>' + items.gasp + '</td>' + '<td>' + items.headache + '</td>' +
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
    $("#cid").val(data.rows["cid"]);
    $("#s_date").val(data.rows["s_date"]);
    $("#temperature").val(data.rows["temperature"]);
    $("#cough").val(data.rows["cough"]);
    $("#throat").val(data.rows["throat"]);
    $("#muscle").val(data.rows["muscle"]);
    $("#snot").val(data.rows["snot"]);
    $("#mucus").val(data.rows["mucus"]);
    $("#gasp").val(data.rows["gasp"]);
    $("#headache").val(data.rows["headache"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    items.cough=0;
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.id = $("#id").val();
    items.cid = $("#cid").val();
    items.s_date = $("#s_date").val();
    items.temperature = $("#temperature").val();
    items.cough = $("input[name='cough']:checked"). val();
    items.throat = $("input[name='throat']:checked"). val();
    items.muscle = $("input[name='muscle']:checked"). val();
    items.snot = $("input[name='snot']:checked"). val();
    items.mucus = $("input[name='mucus']:checked"). val();
    items.gasp = $("input[name='gasp']:checked"). val();
    items.headache = $("input[name='headache']:checked"). val();
    if (validate(items)) {
        crud.save(items, row_id);
    }

});

$('#add_data').on('click', function (e) {
    e.preventDefault();
    $("#frmModal input").prop('disabled', false);
    $("#frmModal select").prop('disabled', false);
    $("#frmModal textarea").prop('disabled', false);
    $("#frmModal .btn").prop('disabled', false);
    //app.clear_form();
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

     if (!items.s_date) {
        swal("กรุณาระบุวันที่ตรวจ");
        $("#s_date").focus();
    } else if (!items.temperature) {
        swal("กรุณาระบุอุณหภูมิ");
        $("#temperature").focus();
    }
    else {
        return true;
    }

}