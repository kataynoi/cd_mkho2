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
            url: site_url + '/person_risk/fetch_person_risk',
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
        var url = '/person_risk/del_person_risk',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, save: function (items, cb) {
        var url = '/person_risk/save_person_risk',
            params = {
                items: items
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }, get_update: function (id, cb) {
        var url = '/person_risk/get_person_risk',
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
    row_id.find("td:eq(1)").html(items.cid);
    row_id.find("td:eq(2)").html(items.risk_type);
    row_id.find("td:eq(3)").html(items.risk_group);
    row_id.find("td:eq(4)").html(items.risk_place);
    row_id.find("td:eq(5)").html(items.risk_event);
    row_id.find("td:eq(6)").html(items.from_country);
    row_id.find("td:eq(7)").html(items.tel);
    row_id.find("td:eq(8)").html(items.province);
    row_id.find("td:eq(9)").html(items.ampur);
    row_id.find("td:eq(10)").html(items.tambon);
    row_id.find("td:eq(11)").html(items.moo);
    row_id.find("td:eq(12)").html(items.no);
    row_id.find("td:eq(13)").html(items.date_throatswab);
    row_id.find("td:eq(14)").html(items.throatswab_sesult);
    row_id.find("td:eq(15)").html(items.hq_province);
    row_id.find("td:eq(16)").html(items.hq_ampur);
    row_id.find("td:eq(17)").html(items.hq_tambon);
    row_id.find("td:eq(18)").html(items.hq_moo);
    row_id.find("td:eq(19)").html(items.hq_no);
    row_id.find("td:eq(20)").html(items.hq_startdate);
    row_id.find("td:eq(21)").html(items.hq_enddate);
    row_id.find("td:eq(22)").html(items.hq_status);

}
crud.set_after_insert = function (items, id) {

    $('<tr name="row' + (id + 1) + '"><td>' + id + '</td>' +
        '<td>' + items.id + '</td>' + '<td>' + items.cid + '</td>' + '<td>' + items.risk_type + '</td>' + '<td>' + items.risk_group + '</td>' + '<td>' + items.risk_place + '</td>' + '<td>' + items.risk_event + '</td>' + '<td>' + items.from_country + '</td>' + '<td>' + items.tel + '</td>' + '<td>' + items.province + '</td>' + '<td>' + items.ampur + '</td>' + '<td>' + items.tambon + '</td>' + '<td>' + items.moo + '</td>' + '<td>' + items.no + '</td>' + '<td>' + items.date_throatswab + '</td>' + '<td>' + items.throatswab_sesult + '</td>' + '<td>' + items.hq_province + '</td>' + '<td>' + items.hq_ampur + '</td>' + '<td>' + items.hq_tambon + '</td>' + '<td>' + items.hq_moo + '</td>' + '<td>' + items.hq_no + '</td>' + '<td>' + items.hq_startdate + '</td>' + '<td>' + items.hq_enddate + '</td>' + '<td>' + items.hq_status + '</td>' +
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
    $("#risk_type").val(data.rows["risk_type"]);
    $("#risk_group").val(data.rows["risk_group"]);
    $("#risk_place").val(data.rows["risk_place"]);
    $("#risk_event").val(data.rows["risk_event"]);
    $("#from_country").val(data.rows["from_country"]);
    $("#tel").val(data.rows["tel"]);
    $("#province").val(data.rows["province"]);
    $("#ampur").val(data.rows["ampur"]);
    $("#tambon").val(data.rows["tambon"]);
    $("#moo").val(data.rows["moo"]);
    $("#no").val(data.rows["no"]);
    $("#date_throatswab").val(data.rows["date_throatswab"]);
    $("#throatswab_sesult").val(data.rows["throatswab_sesult"]);
    $("#hq_province").val(data.rows["hq_province"]);
    $("#hq_ampur").val(data.rows["hq_ampur"]);
    $("#hq_tambon").val(data.rows["hq_tambon"]);
    $("#hq_moo").val(data.rows["hq_moo"]);
    $("#hq_no").val(data.rows["hq_no"]);
    $("#hq_startdate").val(data.rows["hq_startdate"]);
    $("#hq_enddate").val(data.rows["hq_enddate"]);
    $("#hq_status").val(data.rows["hq_status"]);
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
    items.risk_type = $("#risk_type").val();
    items.risk_group = $("#risk_group").val();
    items.risk_place = $("#risk_place").val();
    items.risk_event = $("#risk_event").val();
    items.from_country = $("#from_country").val();
    items.tel = $("#tel").val();
    items.province = $("#province").val();
    items.ampur = $("#ampur").val();
    items.tambon = $("#tambon").val();
    items.moo = $("#moo").val();
    items.no = $("#no").val();
    items.date_throatswab = $("#date_throatswab").val();
    items.throatswab_sesult = $("#throatswab_sesult").val();
    items.hq_province = $("#hq_province").val();
    items.hq_ampur = $("#hq_ampur").val();
    items.hq_tambon = $("#hq_tambon").val();
    items.hq_moo = $("#hq_moo").val();
    items.hq_no = $("#hq_no").val();
    items.hq_startdate = $("#hq_startdate").val();
    items.hq_enddate = $("#hq_enddate").val();
    items.hq_status = $("#hq_status").val();

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

    if (!items.id) {
        swal("กรุณาระบุID");
        $("#id").focus();
    } else if (!items.cid) {
        swal("กรุณาระบุบัตรประชาชน");
        $("#cid").focus();
    } else if (!items.risk_type) {
        swal("กรุณาระบุระดับกลุ่มเสี่ยง");
        $("#risk_type").focus();
    } else if (!items.risk_group) {
        swal("กรุณาระบุกลุ่มผู้สัมผัส");
        $("#risk_group").focus();
    } else if (!items.risk_place) {
        swal("กรุณาระบุสถานที่สัมผัส");
        $("#risk_place").focus();
    } else if (!items.risk_event) {
        swal("กรุณาระบุเหตุการณ์ที่สัมผัส");
        $("#risk_event").focus();
    } else if (!items.from_country) {
        swal("กรุณาระบุมาจากประเทศ");
        $("#from_country").focus();
    } else if (!items.tel) {
        swal("กรุณาระบุโทร");
        $("#tel").focus();
    } else if (!items.province) {
        swal("กรุณาระบุจังหวัด");
        $("#province").focus();
    } else if (!items.ampur) {
        swal("กรุณาระบุอำเภอ");
        $("#ampur").focus();
    } else if (!items.tambon) {
        swal("กรุณาระบุตำบล");
        $("#tambon").focus();
    } else if (!items.moo) {
        swal("กรุณาระบุหมู่ที่");
        $("#moo").focus();
    } else if (!items.no) {
        swal("กรุณาระบุบ้านเลขที่");
        $("#no").focus();
    } else if (!items.date_throatswab) {
        swal("กรุณาระบุThroatswab");
        $("#date_throatswab").focus();
    } else if (!items.throatswab_sesult) {
        swal("กรุณาระบุผล Throatswab");
        $("#throatswab_sesult").focus();
    } else if (!items.hq_province) {
        swal("กรุณาระบุจัดหวัด กักตัว");
        $("#hq_province").focus();
    } else if (!items.hq_ampur) {
        swal("กรุณาระบุอำเภอกักตัว");
        $("#hq_ampur").focus();
    } else if (!items.hq_tambon) {
        swal("กรุณาระบุตำบลกักตัว");
        $("#hq_tambon").focus();
    } else if (!items.hq_moo) {
        swal("กรุณาระบุหมู่ที่ กักตัว");
        $("#hq_moo").focus();
    } else if (!items.hq_no) {
        swal("กรุณาระบุบ้านเลขที่กักตัว");
        $("#hq_no").focus();
    } else if (!items.hq_startdate) {
        swal("กรุณาระบุวันเริ่มกักตัว");
        $("#hq_startdate").focus();
    } else if (!items.hq_enddate) {
        swal("กรุณาระบุวันสิ้นสุดกักตัว");
        $("#hq_enddate").focus();
    } else if (!items.hq_status) {
        swal("กรุณาระบุสถานะการกักตัว");
        $("#hq_status").focus();
    }
    else {
        return true;
    }

}
$('.changwat').select2();