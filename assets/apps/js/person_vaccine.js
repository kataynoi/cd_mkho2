$(document).ready(function () {
  var dataTable = $("#table_data").DataTable({
    createdRow: function (row, data, dataIndex) {
      $(row).attr("name", "row" + dataIndex);
    },
    scrollX: true,
    processing: true,
    serverSide: true,
    order: [],

    pageLength: 10,
    ajax: {
      url: site_url + "/person_vaccine/fetch_person_vaccine",
      data: {
        csrf_token: csrf_token,
      },
      type: "POST",
    },
    columnDefs: [
      {
        targets: [8, 10],
        orderable: true,
      },
    ],
  });
});

var crud = {};

crud.ajax = {
  del_data: function (id, cb) {
    var url = "/person_vaccine/del_person_vaccine",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save: function (items, cb) {
    var url = "/person_vaccine/save_person_vaccine",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_update: function (id, cb) {
    var url = "/person_vaccine/get_person_vaccine",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  set_vaccine_status: function (cid, val, cb) {
    var url = "/person_vaccine/set_vaccine_status",
      params = {
        cid: cid,
        val: val,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
};

crud.del_data = function (id) {
  crud.ajax.del_data(id, function (err, data) {
    if (err) {
      swal(err);
    } else {
      //swal('ลบข้อมูลเรียบร้อย')
      app.alert("ลบข้อมูลเรียบร้อย");
    }
  });
};

crud.save = function (items, row_id) {
  crud.ajax.save(items, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      if (items.action == "insert") {
        crud.set_after_insert(items, data.id);
      } else if (items.action == "update") {
        crud.set_after_update(items, row_id);
      }
      $("#frmModal").modal("toggle");
      swal("บันทึกข้อมูลเรียบร้อยแล้ว ");
    }
  });
};

crud.get_update = function (id, row_id) {
  crud.ajax.get_update(id, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      //swal('แก้ไขข้อมูลเรียบร้อยแล้ว ');
      //location.reload();
      crud.set_update(data, row_id);
    }
  });
};

crud.set_after_update = function (items, row_id) {
  var row_id = $('tr[name="' + row_id + '"]');
  row_id.find("td:eq(0)").html(items.HOSPCODE);
  row_id.find("td:eq(1)").html(items.CID);
  row_id.find("td:eq(2)").html(items.CID_HASH);
  row_id.find("td:eq(3)").html(items.PID);
  row_id.find("td:eq(4)").html(items.HID);
  row_id.find("td:eq(5)").html(items.PRENAME);
  row_id.find("td:eq(6)").html(items.NAME);
  row_id.find("td:eq(7)").html(items.LNAME);
  row_id.find("td:eq(8)").html(items.HN);
  row_id.find("td:eq(9)").html(items.SEX);
  row_id.find("td:eq(10)").html(items.BIRTH);
  row_id.find("td:eq(11)").html(items.MSTATUS);
  row_id.find("td:eq(12)").html(items.OCCUPATION_OLD);
  row_id.find("td:eq(13)").html(items.OCCUPATION_NEW);
  row_id.find("td:eq(14)").html(items.RACE);
  row_id.find("td:eq(15)").html(items.NATION);
  row_id.find("td:eq(16)").html(items.RELIGION);
  row_id.find("td:eq(17)").html(items.EDUCATION);
  row_id.find("td:eq(18)").html(items.FSTATUS);
  row_id.find("td:eq(19)").html(items.FATHER);
  row_id.find("td:eq(20)").html(items.MOTHER);
  row_id.find("td:eq(21)").html(items.COUPLE);
  row_id.find("td:eq(22)").html(items.VSTATUS);
  row_id.find("td:eq(23)").html(items.MOVEIN);
  row_id.find("td:eq(24)").html(items.DISCHARGE);
  row_id.find("td:eq(25)").html(items.DDISCHARGE);
  row_id.find("td:eq(26)").html(items.ABOGROUP);
  row_id.find("td:eq(27)").html(items.RHGROUP);
  row_id.find("td:eq(28)").html(items.LABOR);
  row_id.find("td:eq(29)").html(items.PASSPORT);
  row_id.find("td:eq(30)").html(items.TYPEAREA);
  row_id.find("td:eq(31)").html(items.D_UPDATE);
  row_id.find("td:eq(32)").html(items.check_hosp);
  row_id.find("td:eq(33)").html(items.check_typearea);
  row_id.find("td:eq(34)").html(items.vhid);
  row_id.find("td:eq(35)").html(items.check_vhid);
  row_id.find("td:eq(36)").html(items.maininscl);
  row_id.find("td:eq(37)").html(items.inscl);
  row_id.find("td:eq(38)").html(items.age_y);
  row_id.find("td:eq(39)").html(items.addr);
  row_id.find("td:eq(40)").html(items.home);
  row_id.find("td:eq(41)").html(items.TELEPHONE);
  row_id.find("td:eq(42)").html(items.MOBILE);
  row_id.find("td:eq(43)").html(items.HDC_DATE);
  row_id.find("td:eq(44)").html(items.vaccine_plan1_date);
  row_id.find("td:eq(45)").html(items.vaccine_hosp1);
  row_id.find("td:eq(46)").html(items.vaccine_name1);
  row_id.find("td:eq(47)").html(items.vaccine_plan2_date);
  row_id.find("td:eq(48)").html(items.vaccine_hosp2);
  row_id.find("td:eq(49)").html(items.vaccine_name2);
  row_id.find("td:eq(50)").html(items.vaccine_plan3_date);
  row_id.find("td:eq(51)").html(items.vaccine_hosp3);
  row_id.find("td:eq(52)").html(items.vaccine_name3);
  row_id.find("td:eq(53)").html(items.vaccine_plan4_date);
  row_id.find("td:eq(54)").html(items.vaccine_hosp4);
  row_id.find("td:eq(55)").html(items.vaccine_name4);
  row_id.find("td:eq(56)").html(items.vaccine_provname);
  row_id.find("td:eq(57)").html(items.vaccine_provcode);
  row_id.find("td:eq(58)").html(items.vaccine_status);
};
crud.set_after_insert = function (items, id) {
  $(
    '<tr name="row' +
      (id + 1) +
      '"><td>' +
      id +
      "</td>" +
      "<td>" +
      items.HOSPCODE +
      "</td>" +
      "<td>" +
      items.CID +
      "</td>" +
      "<td>" +
      items.CID_HASH +
      "</td>" +
      "<td>" +
      items.PID +
      "</td>" +
      "<td>" +
      items.HID +
      "</td>" +
      "<td>" +
      items.PRENAME +
      "</td>" +
      "<td>" +
      items.NAME +
      "</td>" +
      "<td>" +
      items.LNAME +
      "</td>" +
      "<td>" +
      items.HN +
      "</td>" +
      "<td>" +
      items.SEX +
      "</td>" +
      "<td>" +
      items.BIRTH +
      "</td>" +
      "<td>" +
      items.MSTATUS +
      "</td>" +
      "<td>" +
      items.OCCUPATION_OLD +
      "</td>" +
      "<td>" +
      items.OCCUPATION_NEW +
      "</td>" +
      "<td>" +
      items.RACE +
      "</td>" +
      "<td>" +
      items.NATION +
      "</td>" +
      "<td>" +
      items.RELIGION +
      "</td>" +
      "<td>" +
      items.EDUCATION +
      "</td>" +
      "<td>" +
      items.FSTATUS +
      "</td>" +
      "<td>" +
      items.FATHER +
      "</td>" +
      "<td>" +
      items.MOTHER +
      "</td>" +
      "<td>" +
      items.COUPLE +
      "</td>" +
      "<td>" +
      items.VSTATUS +
      "</td>" +
      "<td>" +
      items.MOVEIN +
      "</td>" +
      "<td>" +
      items.DISCHARGE +
      "</td>" +
      "<td>" +
      items.DDISCHARGE +
      "</td>" +
      "<td>" +
      items.ABOGROUP +
      "</td>" +
      "<td>" +
      items.RHGROUP +
      "</td>" +
      "<td>" +
      items.LABOR +
      "</td>" +
      "<td>" +
      items.PASSPORT +
      "</td>" +
      "<td>" +
      items.TYPEAREA +
      "</td>" +
      "<td>" +
      items.D_UPDATE +
      "</td>" +
      "<td>" +
      items.check_hosp +
      "</td>" +
      "<td>" +
      items.check_typearea +
      "</td>" +
      "<td>" +
      items.vhid +
      "</td>" +
      "<td>" +
      items.check_vhid +
      "</td>" +
      "<td>" +
      items.maininscl +
      "</td>" +
      "<td>" +
      items.inscl +
      "</td>" +
      "<td>" +
      items.age_y +
      "</td>" +
      "<td>" +
      items.addr +
      "</td>" +
      "<td>" +
      items.home +
      "</td>" +
      "<td>" +
      items.TELEPHONE +
      "</td>" +
      "<td>" +
      items.MOBILE +
      "</td>" +
      "<td>" +
      items.HDC_DATE +
      "</td>" +
      "<td>" +
      items.vaccine_plan1_date +
      "</td>" +
      "<td>" +
      items.vaccine_hosp1 +
      "</td>" +
      "<td>" +
      items.vaccine_name1 +
      "</td>" +
      "<td>" +
      items.vaccine_plan2_date +
      "</td>" +
      "<td>" +
      items.vaccine_hosp2 +
      "</td>" +
      "<td>" +
      items.vaccine_name2 +
      "</td>" +
      "<td>" +
      items.vaccine_plan3_date +
      "</td>" +
      "<td>" +
      items.vaccine_hosp3 +
      "</td>" +
      "<td>" +
      items.vaccine_name3 +
      "</td>" +
      "<td>" +
      items.vaccine_plan4_date +
      "</td>" +
      "<td>" +
      items.vaccine_hosp4 +
      "</td>" +
      "<td>" +
      items.vaccine_name4 +
      "</td>" +
      "<td>" +
      items.vaccine_provname +
      "</td>" +
      "<td>" +
      items.vaccine_provcode +
      "</td>" +
      "<td>" +
      items.vaccine_status +
      "</td>" +
      '<td><div class="btn-group pull-right" role="group">' +
      '<button class="btn btn-outline btn-success" data-btn="btn_view" data-id="' +
      id +
      '"><i class="fa fa-eye"></i></button>' +
      '<button class="btn btn-outline btn-warning" data-btn="btn_edit" data-id="' +
      id +
      '"><i class="fa fa-edit"></i></button>' +
      '<button class="btn btn-outline btn-danger" data-btn="btn_del" data-id="' +
      id +
      '"><i class="fa fa-trash"></i></button>' +
      "</td></div>" +
      "</tr>"
  ).insertBefore("table > tbody > tr:first");
};

crud.set_update = function (data, row_id) {
  $("#row_id").val(row_id);
  $("#HOSPCODE").val(data.rows["HOSPCODE"]);
  $("#CID").val(data.rows["CID"]);
  $("#CID_HASH").val(data.rows["CID_HASH"]);
  $("#PID").val(data.rows["PID"]);
  $("#HID").val(data.rows["HID"]);
  $("#PRENAME").val(data.rows["PRENAME"]);
  $("#NAME").val(data.rows["NAME"]);
  $("#LNAME").val(data.rows["LNAME"]);
  $("#HN").val(data.rows["HN"]);
  $("#SEX").val(data.rows["SEX"]);
  $("#BIRTH").val(data.rows["BIRTH"]);
  $("#MSTATUS").val(data.rows["MSTATUS"]);
  $("#OCCUPATION_OLD").val(data.rows["OCCUPATION_OLD"]);
  $("#OCCUPATION_NEW").val(data.rows["OCCUPATION_NEW"]);
  $("#RACE").val(data.rows["RACE"]);
  $("#NATION").val(data.rows["NATION"]);
  $("#RELIGION").val(data.rows["RELIGION"]);
  $("#EDUCATION").val(data.rows["EDUCATION"]);
  $("#FSTATUS").val(data.rows["FSTATUS"]);
  $("#FATHER").val(data.rows["FATHER"]);
  $("#MOTHER").val(data.rows["MOTHER"]);
  $("#COUPLE").val(data.rows["COUPLE"]);
  $("#VSTATUS").val(data.rows["VSTATUS"]);
  $("#MOVEIN").val(data.rows["MOVEIN"]);
  $("#DISCHARGE").val(data.rows["DISCHARGE"]);
  $("#DDISCHARGE").val(data.rows["DDISCHARGE"]);
  $("#ABOGROUP").val(data.rows["ABOGROUP"]);
  $("#RHGROUP").val(data.rows["RHGROUP"]);
  $("#LABOR").val(data.rows["LABOR"]);
  $("#PASSPORT").val(data.rows["PASSPORT"]);
  $("#TYPEAREA").val(data.rows["TYPEAREA"]);
  $("#D_UPDATE").val(data.rows["D_UPDATE"]);
  $("#check_hosp").val(data.rows["check_hosp"]);
  $("#check_typearea").val(data.rows["check_typearea"]);
  $("#vhid").val(data.rows["vhid"]);
  $("#check_vhid").val(data.rows["check_vhid"]);
  $("#maininscl").val(data.rows["maininscl"]);
  $("#inscl").val(data.rows["inscl"]);
  $("#age_y").val(data.rows["age_y"]);
  $("#addr").val(data.rows["addr"]);
  $("#home").val(data.rows["home"]);
  $("#TELEPHONE").val(data.rows["TELEPHONE"]);
  $("#MOBILE").val(data.rows["MOBILE"]);
  $("#HDC_DATE").val(data.rows["HDC_DATE"]);
  $("#vaccine_plan1_date").val(data.rows["vaccine_plan1_date"]);
  $("#vaccine_hosp1").val(data.rows["vaccine_hosp1"]);
  $("#vaccine_name1").val(data.rows["vaccine_name1"]);
  $("#vaccine_plan2_date").val(data.rows["vaccine_plan2_date"]);
  $("#vaccine_hosp2").val(data.rows["vaccine_hosp2"]);
  $("#vaccine_name2").val(data.rows["vaccine_name2"]);
  $("#vaccine_plan3_date").val(data.rows["vaccine_plan3_date"]);
  $("#vaccine_hosp3").val(data.rows["vaccine_hosp3"]);
  $("#vaccine_name3").val(data.rows["vaccine_name3"]);
  $("#vaccine_plan4_date").val(data.rows["vaccine_plan4_date"]);
  $("#vaccine_hosp4").val(data.rows["vaccine_hosp4"]);
  $("#vaccine_name4").val(data.rows["vaccine_name4"]);
  $("#vaccine_provname").val(data.rows["vaccine_provname"]);
  $("#vaccine_provcode").val(data.rows["vaccine_provcode"]);
  $("#vaccine_status").val(data.rows["vaccine_status"]);
};

$("#btn_save").on("click", function (e) {
  e.preventDefault();
  var action;
  var items = {};
  var row_id = $("#row_id").val();
  items.action = $("#action").val();
  // items.brand_name = $("#brand option:selected").text();
  items.HOSPCODE = $("#HOSPCODE").val();
  items.CID = $("#CID").val();
  items.CID_HASH = $("#CID_HASH").val();
  items.PID = $("#PID").val();
  items.HID = $("#HID").val();
  items.PRENAME = $("#PRENAME").val();
  items.NAME = $("#NAME").val();
  items.LNAME = $("#LNAME").val();
  items.HN = $("#HN").val();
  items.SEX = $("#SEX").val();
  items.BIRTH = $("#BIRTH").val();
  items.MSTATUS = $("#MSTATUS").val();
  items.OCCUPATION_OLD = $("#OCCUPATION_OLD").val();
  items.OCCUPATION_NEW = $("#OCCUPATION_NEW").val();
  items.RACE = $("#RACE").val();
  items.NATION = $("#NATION").val();
  items.RELIGION = $("#RELIGION").val();
  items.EDUCATION = $("#EDUCATION").val();
  items.FSTATUS = $("#FSTATUS").val();
  items.FATHER = $("#FATHER").val();
  items.MOTHER = $("#MOTHER").val();
  items.COUPLE = $("#COUPLE").val();
  items.VSTATUS = $("#VSTATUS").val();
  items.MOVEIN = $("#MOVEIN").val();
  items.DISCHARGE = $("#DISCHARGE").val();
  items.DDISCHARGE = $("#DDISCHARGE").val();
  items.ABOGROUP = $("#ABOGROUP").val();
  items.RHGROUP = $("#RHGROUP").val();
  items.LABOR = $("#LABOR").val();
  items.PASSPORT = $("#PASSPORT").val();
  items.TYPEAREA = $("#TYPEAREA").val();
  items.D_UPDATE = $("#D_UPDATE").val();
  items.check_hosp = $("#check_hosp").val();
  items.check_typearea = $("#check_typearea").val();
  items.vhid = $("#vhid").val();
  items.check_vhid = $("#check_vhid").val();
  items.maininscl = $("#maininscl").val();
  items.inscl = $("#inscl").val();
  items.age_y = $("#age_y").val();
  items.addr = $("#addr").val();
  items.home = $("#home").val();
  items.TELEPHONE = $("#TELEPHONE").val();
  items.MOBILE = $("#MOBILE").val();
  items.HDC_DATE = $("#HDC_DATE").val();
  items.vaccine_plan1_date = $("#vaccine_plan1_date").val();
  items.vaccine_hosp1 = $("#vaccine_hosp1").val();
  items.vaccine_name1 = $("#vaccine_name1").val();
  items.vaccine_plan2_date = $("#vaccine_plan2_date").val();
  items.vaccine_hosp2 = $("#vaccine_hosp2").val();
  items.vaccine_name2 = $("#vaccine_name2").val();
  items.vaccine_plan3_date = $("#vaccine_plan3_date").val();
  items.vaccine_hosp3 = $("#vaccine_hosp3").val();
  items.vaccine_name3 = $("#vaccine_name3").val();
  items.vaccine_plan4_date = $("#vaccine_plan4_date").val();
  items.vaccine_hosp4 = $("#vaccine_hosp4").val();
  items.vaccine_name4 = $("#vaccine_name4").val();
  items.vaccine_provname = $("#vaccine_provname").val();
  items.vaccine_provcode = $("#vaccine_provcode").val();
  items.vaccine_status = $("#vaccine_status").val();

  if (validate(items)) {
    crud.save(items, row_id);
  }
});

$("#add_data").on("click", function (e) {
  e.preventDefault();
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);
  $("#action").val("insert");
  app.clear_form();
});

$(document).on("click", 'button[data-btn="btn_del"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var td = $(this).parent().parent().parent();

  swal({
    title: "คำเตือน?",
    text: "คุณต้องการลบข้อมูล ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      crud.del_data(id);
      td.hide();
    }
  });
});

$(document).on("click", 'button[data-btn="btn_edit"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  $("#action").val("update");
  $("#id").val(id);
  var row_id = $(this).parent().parent().parent().attr("name");
  $("#frmModal input").prop("disabled", false);
  $("#frmModal select").prop("disabled", false);
  $("#frmModal textarea").prop("disabled", false);
  $("#frmModal .btn").prop("disabled", false);

  crud.get_update(id, row_id);
  $("#frmModal").modal("show");
});

$(document).on("click", 'button[data-btn="btn_view"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  $("#action").val("update");
  $("#id").val(id);
  var row_id = $(this).parent().parent().parent().attr("name");
  crud.get_update(id, row_id);
  $("#frmModal input").prop("disabled", true);
  $("#frmModalselect").prop("disabled", true);
  $("#frmModaltextarea").prop("disabled", true);
  $("#frmModal .btn").prop("disabled", true);
  $("#btn_close").prop("disabled", false);
  $("#frmModal").modal("show");
});

function validate(items) {
  if (!items.HOSPCODE) {
    swal("กรุณาระบุรหัสหน่วยบริการ");
    $("#HOSPCODE").focus();
  } else if (!items.CID) {
    swal("กรุณาระบุเลขบัตรประชาชน");
    $("#CID").focus();
  } else if (!items.CID_HASH) {
    swal("กรุณาระบุ");
    $("#CID_HASH").focus();
  } else if (!items.PID) {
    swal("กรุณาระบุ");
    $("#PID").focus();
  } else if (!items.HID) {
    swal("กรุณาระบุ");
    $("#HID").focus();
  } else if (!items.PRENAME) {
    swal("กรุณาระบุ");
    $("#PRENAME").focus();
  } else if (!items.NAME) {
    swal("กรุณาระบุชื่อ");
    $("#NAME").focus();
  } else if (!items.LNAME) {
    swal("กรุณาระบุสกุล");
    $("#LNAME").focus();
  } else if (!items.HN) {
    swal("กรุณาระบุ");
    $("#HN").focus();
  } else if (!items.SEX) {
    swal("กรุณาระบุเพศ");
    $("#SEX").focus();
  } else if (!items.BIRTH) {
    swal("กรุณาระบุวันเกิด");
    $("#BIRTH").focus();
  } else if (!items.MSTATUS) {
    swal("กรุณาระบุ");
    $("#MSTATUS").focus();
  } else if (!items.OCCUPATION_OLD) {
    swal("กรุณาระบุ");
    $("#OCCUPATION_OLD").focus();
  } else if (!items.OCCUPATION_NEW) {
    swal("กรุณาระบุ");
    $("#OCCUPATION_NEW").focus();
  } else if (!items.RACE) {
    swal("กรุณาระบุ");
    $("#RACE").focus();
  } else if (!items.NATION) {
    swal("กรุณาระบุ");
    $("#NATION").focus();
  } else if (!items.RELIGION) {
    swal("กรุณาระบุ");
    $("#RELIGION").focus();
  } else if (!items.EDUCATION) {
    swal("กรุณาระบุ");
    $("#EDUCATION").focus();
  } else if (!items.FSTATUS) {
    swal("กรุณาระบุ");
    $("#FSTATUS").focus();
  } else if (!items.FATHER) {
    swal("กรุณาระบุ");
    $("#FATHER").focus();
  } else if (!items.MOTHER) {
    swal("กรุณาระบุ");
    $("#MOTHER").focus();
  } else if (!items.COUPLE) {
    swal("กรุณาระบุ");
    $("#COUPLE").focus();
  } else if (!items.VSTATUS) {
    swal("กรุณาระบุ");
    $("#VSTATUS").focus();
  } else if (!items.MOVEIN) {
    swal("กรุณาระบุ");
    $("#MOVEIN").focus();
  } else if (!items.DISCHARGE) {
    swal("กรุณาระบุ");
    $("#DISCHARGE").focus();
  } else if (!items.DDISCHARGE) {
    swal("กรุณาระบุ");
    $("#DDISCHARGE").focus();
  } else if (!items.ABOGROUP) {
    swal("กรุณาระบุ");
    $("#ABOGROUP").focus();
  } else if (!items.RHGROUP) {
    swal("กรุณาระบุ");
    $("#RHGROUP").focus();
  } else if (!items.LABOR) {
    swal("กรุณาระบุ");
    $("#LABOR").focus();
  } else if (!items.PASSPORT) {
    swal("กรุณาระบุ");
    $("#PASSPORT").focus();
  } else if (!items.TYPEAREA) {
    swal("กรุณาระบุประเภทการอยู่อาศัย");
    $("#TYPEAREA").focus();
  } else if (!items.D_UPDATE) {
    swal("กรุณาระบุ");
    $("#D_UPDATE").focus();
  } else if (!items.check_hosp) {
    swal("กรุณาระบุ");
    $("#check_hosp").focus();
  } else if (!items.check_typearea) {
    swal("กรุณาระบุ");
    $("#check_typearea").focus();
  } else if (!items.vhid) {
    swal("กรุณาระบุที่อยู่");
    $("#vhid").focus();
  } else if (!items.check_vhid) {
    swal("กรุณาระบุ");
    $("#check_vhid").focus();
  } else if (!items.maininscl) {
    swal("กรุณาระบุ");
    $("#maininscl").focus();
  } else if (!items.inscl) {
    swal("กรุณาระบุ");
    $("#inscl").focus();
  } else if (!items.age_y) {
    swal("กรุณาระบุอายุ");
    $("#age_y").focus();
  } else if (!items.addr) {
    swal("กรุณาระบุ");
    $("#addr").focus();
  } else if (!items.home) {
    swal("กรุณาระบุ");
    $("#home").focus();
  } else if (!items.TELEPHONE) {
    swal("กรุณาระบุ");
    $("#TELEPHONE").focus();
  } else if (!items.MOBILE) {
    swal("กรุณาระบุ");
    $("#MOBILE").focus();
  } else if (!items.HDC_DATE) {
    swal("กรุณาระบุ");
    $("#HDC_DATE").focus();
  } else if (!items.vaccine_plan1_date) {
    swal("กรุณาระบุวัคซีนเข็ม1");
    $("#vaccine_plan1_date").focus();
  } else if (!items.vaccine_hosp1) {
    swal("กรุณาระบุหน่วยฉีดวัคซีน");
    $("#vaccine_hosp1").focus();
  } else if (!items.vaccine_name1) {
    swal("กรุณาระบุชื่อวัคซีน");
    $("#vaccine_name1").focus();
  } else if (!items.vaccine_plan2_date) {
    swal("กรุณาระบุวัคซีนเข็ม2");
    $("#vaccine_plan2_date").focus();
  } else if (!items.vaccine_hosp2) {
    swal("กรุณาระบุหน่วยฉีดวัคซีน");
    $("#vaccine_hosp2").focus();
  } else if (!items.vaccine_name2) {
    swal("กรุณาระบุชื่อวัคซีน");
    $("#vaccine_name2").focus();
  } else if (!items.vaccine_plan3_date) {
    swal("กรุณาระบุ");
    $("#vaccine_plan3_date").focus();
  } else if (!items.vaccine_hosp3) {
    swal("กรุณาระบุ");
    $("#vaccine_hosp3").focus();
  } else if (!items.vaccine_name3) {
    swal("กรุณาระบุ");
    $("#vaccine_name3").focus();
  } else if (!items.vaccine_plan4_date) {
    swal("กรุณาระบุ");
    $("#vaccine_plan4_date").focus();
  } else if (!items.vaccine_hosp4) {
    swal("กรุณาระบุ");
    $("#vaccine_hosp4").focus();
  } else if (!items.vaccine_name4) {
    swal("กรุณาระบุ");
    $("#vaccine_name4").focus();
  } else if (!items.vaccine_provname) {
    swal("กรุณาระบุ");
    $("#vaccine_provname").focus();
  } else if (!items.vaccine_provcode) {
    swal("กรุณาระบุ");
    $("#vaccine_provcode").focus();
  } else if (!items.vaccine_status) {
    swal("กรุณาระบุสถานะการับวัคซีน");
    $("#vaccine_status").focus();
  } else {
    return true;
  }
}

crud.set_vaccine_status = function (cid, val) {
  crud.ajax.set_vaccine_status(cid, val, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
  });
  return true;
};
$(document).on("change", "select[data-btn='sl_vaccine_status']", function (e) {
  var cid = $(this).data("cid");
  var val = $(this).val();
  swal({
    title: "คำเตือน?",
    text: "คุณต้องการแก้ไข สถานะการรับวัคซีน ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.set_vaccine_status(cid, val)) {
      }
    }
  });
});
