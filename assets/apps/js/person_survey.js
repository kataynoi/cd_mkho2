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
            url: site_url + '/person_survey/fetch_person_survey',
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

    $('#frmModal').on('show.bs.modal', function () {
        $('#from_conutry').select2();
        $('#from_province').select2();
    })

    $('#frmModal').on('hidden.bs.modal', function () {
        $('#from_conutry').select2('destroy');
        $('#from_province').select2('destroy');
    })

});

var crud = {};

crud.ajax = {
    del_data: function (id, cb) {
        var url = '/person_survey/del_person_survey',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/person_survey/save_person_survey',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/person_survey/get_person_survey',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_tambon_list: function (amp, cb) {
        var url = '/basic/get_tambon_list',
            params = {
                amp: amp
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_moo_list: function (code, cb) {
        var url = '/basic/get_moo_list',
            params = {
                code: code
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_person_by_cid: function (cid, cb) {
        var url = '/person_survey/get_person_by_cid',
            params = {
                cid: cid
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }


    //
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
    row_id.find("td:eq(1)").html(items.d_update);
    row_id.find("td:eq(2)").html(items.cid);
    row_id.find("td:eq(3)").html(items.name);
    row_id.find("td:eq(4)").html(items.tel);
    row_id.find("td:eq(5)").html(items.from_conutry);
    row_id.find("td:eq(6)").html(items.from_province);
    row_id.find("td:eq(7)").html(items.date_in);
    row_id.find("td:eq(8)").html(items.no);
    row_id.find("td:eq(9)").html(items.moo);
    row_id.find("td:eq(10)").html(items.tambon);
    row_id.find("td:eq(11)").html(items.ampur);
    row_id.find("td:eq(12)").html(items.province);
    row_id.find("td:eq(13)").html(items.in_family);
    row_id.find("td:eq(14)").html(items.risk1);
    row_id.find("td:eq(15)").html(items.risk2);
    row_id.find("td:eq(16)").html(items.risk3);
    row_id.find("td:eq(17)").html(items.risk4);
    row_id.find("td:eq(18)").html(items.reporter);

}
crud.set_after_insert = function (items, id) {

    $('<tr name="row' + (id + 1) + '"><td>' + id + '</td>' +
        '<td>' + items.id + '</td>' + '<td>' + items.d_update + '</td>' + '<td>' + items.cid + '</td>' + '<td>' + items.name + '</td>' + '<td>' + items.tel + '</td>' + '<td>' + items.from_conutry + '</td>' + '<td>' + items.from_province + '</td>' + '<td>' + items.date_in + '</td>' + '<td>' + items.no + '</td>' + '<td>' + items.moo + '</td>' + '<td>' + items.tambon + '</td>' + '<td>' + items.ampur + '</td>' + '<td>' + items.province + '</td>' + '<td>' + items.in_family + '</td>' + '<td>' + items.risk1 + '</td>' + '<td>' + items.risk2 + '</td>' + '<td>' + items.risk3 + '</td>' + '<td>' + items.risk4 + '</td>' + '<td>' + items.reporter + '</td>' +
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
    $("#d_update").val(data.rows["d_update"]);
    $("#cid").val(data.rows["cid"]);
    $("#name").val(data.rows["name"]);
    $("#tel").val(data.rows["tel"]);
    $("#from_conutry").val(data.rows["from_conutry"]);
    $("#from_province").val(data.rows["from_province"]);
    $("#date_in").val(data.rows["date_in"]);
    $("#no").val(data.rows["no"]);
    $("#moo").val(data.rows["moo"]);
    $("#tambon").val(data.rows["tambon"]);
    $("#ampur").val(data.rows["ampur"]);
    $("#province").val(data.rows["province"]);
    $("#in_family").val(data.rows["in_family"]);
    $("#risk1").val(data.rows["risk1"]);
    $("#risk2").val(data.rows["risk2"]);
    $("#risk3").val(data.rows["risk3"]);
    $("#risk4").val(data.rows["risk4"]);
    $("#reporter").val(data.rows["reporter"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.id = $("#id").val();
    items.d_update = $("#d_update").val();
    items.cid = $("#cid").val();
    items.name = $("#name").val();
    items.tel = $("#tel").val();
    items.from_conutry = $("#from_conutry").val();
    items.from_province = $("#from_province").val();
    items.date_in = $("#date_in").val();
    items.no = $("#no").val();
    items.moo = $("#moo").val();
    items.tambon = $("#tambon").val();
    items.ampur = $("#ampur").val();
    items.province = $("#province").val();
    items.in_family = $("#in_family").val();
    items.risk1 = $("input[name='risk1']:checked").val();
    items.risk2 = $("input[name='risk2']:checked").val();
    items.risk3 = $("input[name='risk3']:checked").val();
    items.risk4 = $("input[name='risk4']:checked").val();

    items.reporter = $("#reporter").val();

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

    if (!items.cid) {
        swal("กรุณาระบุเลขบัตรประชาชน");
        $("#cid").focus();
    } else if (!items.name) {
        swal("กรุณาระบุชื่อ สกุล");
        $("#name").focus();
    }
    if (!items.from_province) {
        swal("กรุณาระบุมาจากจังหวัด");
        $("#from_province").focus();
    } else if (!items.date_in) {
        swal("กรุณาระบุวันเดินทางเข้า");
        $("#date_in").focus();
    }
    if (!items.moo) {
        swal("กรุณาระบุหมู่บ้าน");
        $("#moo").focus();
    } else if (!items.tambon) {
        swal("กรุณาระบุตำบล");
        $("#tambon").focus();
    } else if (!items.ampur) {
        swal("กรุณาระบุอำเภอ");
        $("#ampur").focus();
    }
    if (!items.in_family) {
        swal("กรุณาระบุคนในครอบครัว");
        $("#in_family").focus();
    } else {
        return true;
    }
}
$('#ampur').on('change', function () {
    var amp = $(this).val();

    crud.get_tambon_list(amp);

});

crud.get_tambon_list = function (ampcode) {

    $('#tambon').empty();

    crud.ajax.get_tambon_list(ampcode, function (err, data) {
        if (!err) {
            $('#tambon').append('<option value="">-*-</option>');
            _.each(data.rows, function (v) {
                $('#tambon').append('<option value="' + v.tamboncodefull + '">' + v.tambonname + '</option>');
            });
        }
    });

};

$('#tambon').on('change', function () {
    var code = $(this).val();

    crud.get_moo_list(code);

});

crud.get_moo_list = function (code) {

    $('#moo').empty();

    crud.ajax.get_moo_list(code, function (err, data) {
        if (!err) {
            $('#moo').append('<option value="">-*-</option>');
            _.each(data.rows, function (v) {
                $('#moo').append('<option value="' + v.villagename + '">' + v.villagename + '</option>');
            });
        }
    });

};

crud.get_person_by_cid = function (cid) {

    crud.ajax.get_person_by_cid(cid, function (err, data) {
        if (!err) {
            if(data.check){
                swal('มีบุคคลนี้ในระบบแล้ว');
                app.clear_form();
            }else if(data.rows){
                $("#cid").val(data.rows["CID"]);
                $("#name").val(data.rows["NAME"]+' '+data.rows["LNAME"]);
                $("#no").val(data.rows["addr"]);
                $("#ampur").val(data.rows["vhid"].substring(0,4));
                if(crud.get_tambon_list(data.rows["vhid"].substring(0,4))){
                    $("#tambon").val(data.rows["vhid"].substring(0,6));
                }
            }else{
                $('#name').focus();
            }
        }
    });

};


$("#cid").on('keyup', function () {
    var cid = $('#cid').val();
    if (cid.length == 13) {
       // alert(cid);
        crud.get_person_by_cid(cid);
    }

    //
});