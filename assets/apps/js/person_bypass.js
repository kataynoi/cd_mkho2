$(document).ready(function () {
    var dataTable = $('#table_data').DataTable({
        'createdRow': function (row, data, dataIndex) {
            $(row).attr('name', 'row' + dataIndex);
        }, dom: 'Bfrtip',
        buttons: [
            'excel'
        ],
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 20,
        "ajax": {
            url: site_url + '/person_bypass/fetch_person_bypass',
            data: {
                'csrf_token': csrf_token
            },
            type: "POST"
        },
        "columnDefs": [
            {
                "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                "orderable": false,
            },
        ],
    });

});
$('#frm_vehicle').hide();

$('#frmModal').on('shown.bs.modal', function () {
    $('#cid').focus();
    $('#form').select2();
    $('#to').select2();
});

$('#frmModal').on('hidden.bs.modal', function () {
    $('#form').select2('destroy');
    $('#to').select2('destroy');
});

var crud = {};

crud.ajax = {
    del_data: function (id, cb) {
        var url = '/person_bypass/del_person_bypass',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/person_bypass/save_person_bypass',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/person_bypass/get_person_bypass',
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
            location.reload();

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
    row_id.find("td:eq(2)").html(items.trpre);
    row_id.find("td:eq(3)").html(items.tname);
    row_id.find("td:eq(4)").html(items.tlast);
    row_id.find("td:eq(5)").html(items.birth);
    row_id.find("td:eq(6)").html(items.sex);
    row_id.find("td:eq(7)").html(items.addrno);
    row_id.find("td:eq(8)").html(items.addrmu);
    row_id.find("td:eq(9)").html(items.addrtb);
    row_id.find("td:eq(10)").html(items.addrap);
    row_id.find("td:eq(11)").html(items.addrcw);
    row_id.find("td:eq(12)").html(items.agenow);
    row_id.find("td:eq(13)").html(items.datestamp);
    row_id.find("td:eq(14)").html(items.temp_check);
    row_id.find("td:eq(15)").html(items.temp_result);
    row_id.find("td:eq(16)").html(items.symtom1);
    row_id.find("td:eq(17)").html(items.check_point);

}
crud.set_after_insert = function (items, id) {

    $('<tr name="row' + (id + 1) + '"><td>' + id + '</td>' +
        '<td>' + items.id + '</td>' + '<td>' + items.cid + '</td>' + '<td>' + items.trpre + '</td>' + '<td>' + items.tname + '</td>' + '<td>' + items.tlast + '</td>' + '<td>' + items.birth + '</td>' + '<td>' + items.sex + '</td>' + '<td>' + items.addrno + '</td>' + '<td>' + items.addrmu + '</td>' + '<td>' + items.addrtb + '</td>' + '<td>' + items.addrap + '</td>' + '<td>' + items.addrcw + '</td>' + '<td>' + items.agenow + '</td>' + '<td>' + items.datestamp + '</td>' + '<td>' + items.temp_check + '</td>' + '<td>' + items.temp_result + '</td>' + '<td>' + items.symtom1 + '</td>' + '<td>' + items.check_point + '</td>' +
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
    $("#trpre").val(data.rows["trpre"]);
    $("#tname").val(data.rows["tname"]);
    $("#tlast").val(data.rows["tlast"]);
    $("#birth").val(data.rows["birth"]);
    $("#sex").val(data.rows["sex"]);
    $("#addrno").val(data.rows["addrno"]);
    $("#addrmu").val(data.rows["addrmu"]);
    $("#addrtb").val(data.rows["addrtb"]);
    $("#addrap").val(data.rows["addrap"]);
    $("#addrcw").val(data.rows["addrcw"]);
    $("#agenow").val(data.rows["agenow"]);
    $("#datestamp").val(data.rows["datestamp"]);
    $("#tel").val(data.rows["tel"]);
    $("#form").val(data.rows["form"]);
    $("#to").val(data.rows["to"]);
    $("#temp_check").val(data.rows["temp_check"]);
    $("#temp_result").val(data.rows["temp_result"]);
    $("#symtom1").val(data.rows["symtom1"]);
    $("#check_point").val(data.rows["check_point"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.id = $("#id").val();
    items.cid = $("#cid").val();
    items.trpre = $("#trpre").val();
    items.tname = $("#tname").val();
    items.tlast = $("#tlast").val();
    items.birth = $("#birth").val();
    items.sex = $("#sex").val();
    items.addrno = $("#addrno").val();
    items.addrmu = $("#addrmu").val();
    items.addrtb = $("#addrtb").val();
    items.addrap = $("#addrap").val();
    items.addrcw = $("#addrcw").val();
    items.agenow = $("#agenow").val();
    items.datestamp = $("#datestamp").val();
    items.tel = $("#tel").val();
    items.form = $("#form").val();
    items.to = $("#to").val();
    items.temp_check = $("#temp_check").val();
    items.temp_result = $("#temp_result").val();
    items.symtom1 = $("#symtom1").val();
    items.vehicle = $("#vehicle").val();
    items.driver = $('input[name=driver]:checked').val()
    items.check_point = $("#check_point").val();

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
    app.clear_form();
    $('#check_point').val(user_id);
    $('#check_point2').html(user_name);
    $('#cid').focus();
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
    $("#cid").focus();
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

    if (!items.tname) {
        swal("กรุณาระบุชื่อ");
        $("#tname").focus();
    } else if (!items.tlast) {
        swal("กรุณาระบุสกุล");
        $("#tlast").focus();
    }
    else {
        return true;
    }

}
$(document).on('click', 'button[data-btn="add_data"]', function (e) {
    //$('.form').select2();
    $('#cid').focus();
    $('#frmModal').modal('show')
});

$(document).on('click', 'input[name=driver][value="1"]', function (e) {

    $('#frm_vehicle').show();
});

$(document).on('click', 'input[name=driver][value="0"]', function (e) {

    $('#frm_vehicle').hide();
});


