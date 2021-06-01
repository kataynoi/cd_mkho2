$(document).ready(function() {
    var dataTable = $('#table_data').DataTable({
        'createdRow': function (row, data, dataIndex) {
                    $(row).attr('name', 'row'+dataIndex);
                },
        "processing": true,
        "serverSide": true,
        "order": [],

        "pageLength": 50,
        "ajax": {
            url: site_url + '/person/fetch_person',
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

crud .ajax = {
    del_data:function (id,cb){
        var url = '/person/del_person',
            params = {
                id: id
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },save:function (items,cb){
             var url = '/person/save_person',
                 params = {
                     items: items
                 }

             app.ajax(url, params, function (err, data) {
                 err ? cb(err) : cb(null, data);
             });
    },get_update:function (id,cb){
                   var url = '/person/get_person',
                       params = {
                           id: id
                       }

                   app.ajax(url, params, function (err, data) {
                       err ? cb(err) : cb(null, data);
                   });
    },search_person:function (txt_search,search_type,cb){
        var url = '/person/search_person_hdc',
            params = {
                txt_search: txt_search,
                search_type: search_type
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    },import_person:function (cid,cb){
        var url = '/person/import_person',
            params = {
                cid: cid
            }

        app.ajax(url, params, function (err, data) {
            err ? cb(err) : cb(null, data);
        });
    }

};
crud.del_data = function(id){

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

crud.save = function (items,row_id) {
    crud.ajax.save(items, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
            if(items.action == 'insert'){
                crud.set_after_insert(items,data.id);
            }else if(items.action == 'update'){
                crud.set_after_update(items,row_id);
            }
            $('#frmModal').modal('toggle');
            swal('บันทึกข้อมูลเรียบร้อยแล้ว ');
        }
    });

}


crud.get_update = function (id,row_id) {
    crud.ajax.get_update(id, function (err, data) {
        if (err) {
            //app.alert(err);
            swal(err);
        }
        else {
                //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
                //location.reload();
                crud.set_update(data,row_id);
        }
    });

}


crud.set_after_update = function (items,row_id) {

    var row_id = $('tr[name="' + row_id + '"]');
    row_id.find("td:eq(0)").html(items.HOSPCODE);row_id.find("td:eq(1)").html(items.CID);row_id.find("td:eq(2)").html(items.PID);row_id.find("td:eq(3)").html(items.HID);row_id.find("td:eq(4)").html(items.PRENAME);row_id.find("td:eq(5)").html(items.NAME);row_id.find("td:eq(6)").html(items.LNAME);row_id.find("td:eq(7)").html(items.HN);row_id.find("td:eq(8)").html(items.SEX);row_id.find("td:eq(9)").html(items.BIRTH);row_id.find("td:eq(10)").html(items.MSTATUS);row_id.find("td:eq(11)").html(items.OCCUPATION_OLD);row_id.find("td:eq(12)").html(items.OCCUPATION_NEW);row_id.find("td:eq(13)").html(items.RACE);row_id.find("td:eq(14)").html(items.NATION);row_id.find("td:eq(15)").html(items.RELIGION);row_id.find("td:eq(16)").html(items.EDUCATION);row_id.find("td:eq(17)").html(items.FSTATUS);row_id.find("td:eq(18)").html(items.FATHER);row_id.find("td:eq(19)").html(items.MOTHER);row_id.find("td:eq(20)").html(items.COUPLE);row_id.find("td:eq(21)").html(items.VSTATUS);row_id.find("td:eq(22)").html(items.MOVEIN);row_id.find("td:eq(23)").html(items.DISCHARGE);row_id.find("td:eq(24)").html(items.DDISCHARGE);row_id.find("td:eq(25)").html(items.ABOGROUP);row_id.find("td:eq(26)").html(items.RHGROUP);row_id.find("td:eq(27)").html(items.LABOR);row_id.find("td:eq(28)").html(items.PASSPORT);row_id.find("td:eq(29)").html(items.TYPEAREA);row_id.find("td:eq(30)").html(items.D_UPDATE);row_id.find("td:eq(31)").html(items.check_hosp);row_id.find("td:eq(32)").html(items.check_typearea);row_id.find("td:eq(33)").html(items.vhid);row_id.find("td:eq(34)").html(items.check_vhid);row_id.find("td:eq(35)").html(items.maininscl);row_id.find("td:eq(36)").html(items.inscl);row_id.find("td:eq(37)").html(items.age_y);row_id.find("td:eq(38)").html(items.addr);row_id.find("td:eq(39)").html(items.home);row_id.find("td:eq(40)").html(items.TELEPHONE);row_id.find("td:eq(41)").html(items.MOBILE);

}
crud.set_after_insert = function (items,id) {

            $('<tr name="row'+(id+1)+'"><td>'+id+'</td>' +
                '<td>' +items.HOSPCODE+'</td>' +'<td>' +items.CID+'</td>' +'<td>' +items.PID+'</td>' +'<td>' +items.HID+'</td>' +'<td>' +items.PRENAME+'</td>' +'<td>' +items.NAME+'</td>' +'<td>' +items.LNAME+'</td>' +'<td>' +items.HN+'</td>' +'<td>' +items.SEX+'</td>' +'<td>' +items.BIRTH+'</td>' +'<td>' +items.MSTATUS+'</td>' +'<td>' +items.OCCUPATION_OLD+'</td>' +'<td>' +items.OCCUPATION_NEW+'</td>' +'<td>' +items.RACE+'</td>' +'<td>' +items.NATION+'</td>' +'<td>' +items.RELIGION+'</td>' +'<td>' +items.EDUCATION+'</td>' +'<td>' +items.FSTATUS+'</td>' +'<td>' +items.FATHER+'</td>' +'<td>' +items.MOTHER+'</td>' +'<td>' +items.COUPLE+'</td>' +'<td>' +items.VSTATUS+'</td>' +'<td>' +items.MOVEIN+'</td>' +'<td>' +items.DISCHARGE+'</td>' +'<td>' +items.DDISCHARGE+'</td>' +'<td>' +items.ABOGROUP+'</td>' +'<td>' +items.RHGROUP+'</td>' +'<td>' +items.LABOR+'</td>' +'<td>' +items.PASSPORT+'</td>' +'<td>' +items.TYPEAREA+'</td>' +'<td>' +items.D_UPDATE+'</td>' +'<td>' +items.check_hosp+'</td>' +'<td>' +items.check_typearea+'</td>' +'<td>' +items.vhid+'</td>' +'<td>' +items.check_vhid+'</td>' +'<td>' +items.maininscl+'</td>' +'<td>' +items.inscl+'</td>' +'<td>' +items.age_y+'</td>' +'<td>' +items.addr+'</td>' +'<td>' +items.home+'</td>' +'<td>' +items.TELEPHONE+'</td>' +'<td>' +items.MOBILE+'</td>' +
                '<td><div class="btn-group pull-right" role="group">' +
                '<button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' + id + '"><i class="fa fa-eye"></i></button>' +
                '<button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' + id + '"><i class="fa fa-edit"></i></button>' +
                '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' + id + '"><i class="fa fa-trash"></i></button>' +
                '</td></div>' +
                '</tr>').insertBefore('table > tbody > tr:first');
}

crud.set_update = function (data,row_id) {
    $("#row_id").val(row_id);
    $("#HOSPCODE").val(data.rows["HOSPCODE"]);$("#CID").val(data.rows["CID"]);$("#PID").val(data.rows["PID"]);$("#HID").val(data.rows["HID"]);$("#PRENAME").val(data.rows["PRENAME"]);$("#NAME").val(data.rows["NAME"]);$("#LNAME").val(data.rows["LNAME"]);$("#HN").val(data.rows["HN"]);$("#SEX").val(data.rows["SEX"]);$("#BIRTH").val(data.rows["BIRTH"]);$("#MSTATUS").val(data.rows["MSTATUS"]);$("#OCCUPATION_OLD").val(data.rows["OCCUPATION_OLD"]);$("#OCCUPATION_NEW").val(data.rows["OCCUPATION_NEW"]);$("#RACE").val(data.rows["RACE"]);$("#NATION").val(data.rows["NATION"]);$("#RELIGION").val(data.rows["RELIGION"]);$("#EDUCATION").val(data.rows["EDUCATION"]);$("#FSTATUS").val(data.rows["FSTATUS"]);$("#FATHER").val(data.rows["FATHER"]);$("#MOTHER").val(data.rows["MOTHER"]);$("#COUPLE").val(data.rows["COUPLE"]);$("#VSTATUS").val(data.rows["VSTATUS"]);$("#MOVEIN").val(data.rows["MOVEIN"]);$("#DISCHARGE").val(data.rows["DISCHARGE"]);$("#DDISCHARGE").val(data.rows["DDISCHARGE"]);$("#ABOGROUP").val(data.rows["ABOGROUP"]);$("#RHGROUP").val(data.rows["RHGROUP"]);$("#LABOR").val(data.rows["LABOR"]);$("#PASSPORT").val(data.rows["PASSPORT"]);$("#TYPEAREA").val(data.rows["TYPEAREA"]);$("#D_UPDATE").val(data.rows["D_UPDATE"]);$("#check_hosp").val(data.rows["check_hosp"]);$("#check_typearea").val(data.rows["check_typearea"]);$("#vhid").val(data.rows["vhid"]);$("#check_vhid").val(data.rows["check_vhid"]);$("#maininscl").val(data.rows["maininscl"]);$("#inscl").val(data.rows["inscl"]);$("#age_y").val(data.rows["age_y"]);$("#addr").val(data.rows["addr"]);$("#home").val(data.rows["home"]);$("#TELEPHONE").val(data.rows["TELEPHONE"]);$("#MOBILE").val(data.rows["MOBILE"]);
}

$('#btn_save').on('click', function (e) {
    e.preventDefault();
    var action;
    var items = {};
    var row_id = $("#row_id").val();
    items.action = $('#action').val();
    // items.brand_name = $("#brand option:selected").text();
    items.HOSPCODE=$("#HOSPCODE").val();items.CID=$("#CID").val();items.PID=$("#PID").val();items.HID=$("#HID").val();items.PRENAME=$("#PRENAME").val();items.NAME=$("#NAME").val();items.LNAME=$("#LNAME").val();items.HN=$("#HN").val();items.SEX=$("#SEX").val();items.BIRTH=$("#BIRTH").val();items.MSTATUS=$("#MSTATUS").val();items.OCCUPATION_OLD=$("#OCCUPATION_OLD").val();items.OCCUPATION_NEW=$("#OCCUPATION_NEW").val();items.RACE=$("#RACE").val();items.NATION=$("#NATION").val();items.RELIGION=$("#RELIGION").val();items.EDUCATION=$("#EDUCATION").val();items.FSTATUS=$("#FSTATUS").val();items.FATHER=$("#FATHER").val();items.MOTHER=$("#MOTHER").val();items.COUPLE=$("#COUPLE").val();items.VSTATUS=$("#VSTATUS").val();items.MOVEIN=$("#MOVEIN").val();items.DISCHARGE=$("#DISCHARGE").val();items.DDISCHARGE=$("#DDISCHARGE").val();items.ABOGROUP=$("#ABOGROUP").val();items.RHGROUP=$("#RHGROUP").val();items.LABOR=$("#LABOR").val();items.PASSPORT=$("#PASSPORT").val();items.TYPEAREA=$("#TYPEAREA").val();items.D_UPDATE=$("#D_UPDATE").val();items.check_hosp=$("#check_hosp").val();items.check_typearea=$("#check_typearea").val();items.vhid=$("#vhid").val();items.check_vhid=$("#check_vhid").val();items.maininscl=$("#maininscl").val();items.inscl=$("#inscl").val();items.age_y=$("#age_y").val();items.addr=$("#addr").val();items.home=$("#home").val();items.TELEPHONE=$("#TELEPHONE").val();items.MOBILE=$("#MOBILE").val();

          if(validate(items)){
                crud.save(items,row_id);
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

$(document).on('click', 'button[data-btn="btn_del"]', function(e) {
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
    }).then(function(isConfirm){
        if(isConfirm){
            crud.del_data(id);
            td.hide();
        }
    });
});

$(document).on('click', 'button[data-btn="btn_edit"]', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $('#action').val('update');
    $('#id').val(id);
    var row_id = $(this).parent().parent().parent().attr('name');
        $("#frmModal input").prop('disabled', false);
        $("#frmModal select").prop('disabled', false);
        $("#frmModal textarea").prop('disabled', false);
        $("#frmModal .btn").prop('disabled', false);

    crud.get_update(id,row_id);
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

function validate(items){

    if (!items.HOSPCODE) { swal("กรุณาระบุหน่วยบริการ");$("#HOSPCODE").focus();}else if (!items.CID) { swal("กรุณาระบุบัตรประชาชน");$("#CID").focus();}else if (!items.PID) { swal("กรุณาระบุ");$("#PID").focus();}else if (!items.HID) { swal("กรุณาระบุ");$("#HID").focus();}else if (!items.PRENAME) { swal("กรุณาระบุคำนำหน้า");$("#PRENAME").focus();}else if (!items.NAME) { swal("กรุณาระบุชื่อ");$("#NAME").focus();}else if (!items.LNAME) { swal("กรุณาระบุสกุล");$("#LNAME").focus();}else if (!items.HN) { swal("กรุณาระบุHN");$("#HN").focus();}else if (!items.SEX) { swal("กรุณาระบุเพศ");$("#SEX").focus();}else if (!items.BIRTH) { swal("กรุณาระบุว/ด/ป เกิด");$("#BIRTH").focus();}else if (!items.MSTATUS) { swal("กรุณาระบุสถานะการแต่งงาน");$("#MSTATUS").focus();}else if (!items.OCCUPATION_OLD) { swal("กรุณาระบุ");$("#OCCUPATION_OLD").focus();}else if (!items.OCCUPATION_NEW) { swal("กรุณาระบุอาชีพ");$("#OCCUPATION_NEW").focus();}else if (!items.RACE) { swal("กรุณาระบุ");$("#RACE").focus();}else if (!items.NATION) { swal("กรุณาระบุ");$("#NATION").focus();}else if (!items.RELIGION) { swal("กรุณาระบุ");$("#RELIGION").focus();}else if (!items.EDUCATION) { swal("กรุณาระบุ");$("#EDUCATION").focus();}else if (!items.FSTATUS) { swal("กรุณาระบุ");$("#FSTATUS").focus();}else if (!items.FATHER) { swal("กรุณาระบุ");$("#FATHER").focus();}else if (!items.MOTHER) { swal("กรุณาระบุ");$("#MOTHER").focus();}else if (!items.COUPLE) { swal("กรุณาระบุ");$("#COUPLE").focus();}else if (!items.VSTATUS) { swal("กรุณาระบุ");$("#VSTATUS").focus();}else if (!items.MOVEIN) { swal("กรุณาระบุ");$("#MOVEIN").focus();}else if (!items.DISCHARGE) { swal("กรุณาระบุ");$("#DISCHARGE").focus();}else if (!items.DDISCHARGE) { swal("กรุณาระบุ");$("#DDISCHARGE").focus();}else if (!items.ABOGROUP) { swal("กรุณาระบุ");$("#ABOGROUP").focus();}else if (!items.RHGROUP) { swal("กรุณาระบุ");$("#RHGROUP").focus();}else if (!items.LABOR) { swal("กรุณาระบุ");$("#LABOR").focus();}else if (!items.PASSPORT) { swal("กรุณาระบุ");$("#PASSPORT").focus();}else if (!items.TYPEAREA) { swal("กรุณาระบุ");$("#TYPEAREA").focus();}else if (!items.D_UPDATE) { swal("กรุณาระบุ");$("#D_UPDATE").focus();}else if (!items.check_hosp) { swal("กรุณาระบุ");$("#check_hosp").focus();}else if (!items.check_typearea) { swal("กรุณาระบุTypeArea");$("#check_typearea").focus();}else if (!items.vhid) { swal("กรุณาระบุ");$("#vhid").focus();}else if (!items.check_vhid) { swal("กรุณาระบุที่อยู่");$("#check_vhid").focus();}else if (!items.maininscl) { swal("กรุณาระบุ");$("#maininscl").focus();}else if (!items.inscl) { swal("กรุณาระบุ");$("#inscl").focus();}else if (!items.age_y) { swal("กรุณาระบุอายุ");$("#age_y").focus();}else if (!items.addr) { swal("กรุณาระบุ");$("#addr").focus();}else if (!items.home) { swal("กรุณาระบุ");$("#home").focus();}else if (!items.TELEPHONE) { swal("กรุณาระบุ");$("#TELEPHONE").focus();}else if (!items.MOBILE) { swal("กรุณาระบุโทรศัพย์");$("#MOBILE").focus();}
    else{
        return true;
    }

}

$('#btn_search').on('click', function(e) {

    var txt_search = $('#txt_search').val();
    var search_type ;
    if(!txt_search) {
        swal('กรุณาระบุบัตรประชาชนหรือชื่อผู้ต้องการค้นหา');
        $("#btn_login").removeProp("disabled");
        return false;
    }else {

        if(parseInt(txt_search)) {
            search_type='cid';
        }
        else {
            search_type='name';
        }
        $('#tbl_search_result > tbody').empty();
        crud.search_person(txt_search,search_type);
    }
});
crud.set_search_person = function(data){

    $('#tbl_search_result > tbody').empty();

    if (_.size(data.rows) > 0) {
        var i =1;
        _.each(data.rows, function (v) {
            $('#tbl_search_result > tbody').append(
                '<tr>' +
                '<td>'+ i+'</td>' +
                '<td >'+ v.NAME+' '+ v.LNAME+'</td>' +
                '<td>'+ v.CID+'</td>' +
                '<td>'+ v.BIRTH+'</td>' +
                '<td>'+ v.age_y+'</td>' +
                '<td>'+ v.VHID+'</td>' +
                '<td><button class="btn btn-success " data-btn="btn_import_person" data-cid="'+v.CID+'">' +
                '<i class="fa fa-plus-circle"></i> ลงทะเบียน Person</button></td>' +
                '</tr>'

            );
            i++;
        });
    }
}

crud.search_person = function(txt_search,search_type){

    crud.ajax.search_person(txt_search,search_type, function (err, data) {
        if (err) {
            swal(err)
        }
        else {
            $('#tbl_search_result > tbody').empty();
            crud.set_search_person(data);
        }
    });
}
crud.import_person = function(cid){
    //app.alert('Save Pass : '+user_id+' : '+password);
    crud.ajax.import_person(cid, function (err, data) {
        if (err) {

            swal('มีบุคคลนี้ในระบบแล้ว')
        }
        else {
            //console.log(data);
            app.alert('นำเข้าเรียบร้อย');
        }
    });
}
$(document).on('click', 'button[data-btn="btn_import_person"]', function(e) {
    e.preventDefault();
    var cid = $(this).data('cid');

    console.log(cid);
    crud.import_person(cid);
    //$(this).parent().parent().hide();
});

$(document).on('click', 'button[data-btn="btn_symptom"]', function(e) {
    e.preventDefault();
    var cid = $(this).data('id');
    window.open(site_url+'/symptom/symptom_aday/'+cid);
});
