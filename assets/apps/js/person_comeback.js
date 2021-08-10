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
    responsive: true,

    lengthMenu: [
      [10, 25, 50, -1],
      [10, 25, 50, "All"],
    ], // page length options

    dom: "Bfrtip",
    buttons: ["copy", "csv", "excel", "pdf", "print"],
    ajax: {
      url: site_url + "/person_comeback/fetch_person_comeback",
      data: {
        csrf_token: csrf_token,
      },
      type: "POST",
    },
    columnDefs: [
      {
        targets: [1, 2],
        orderable: false,
      },
    ],
  });
});

var crud = {};

crud.ajax = {
  del_data: function (id, cb) {
    var url = "/person_comeback/del_person_comeback",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save: function (items, cb) {
    var url = "/person_comeback/save_person_comeback",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_update: function (id, cb) {
    var url = "/person_comeback/get_person_comeback",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  confirm_bed: function (id, val, cb) {
    var url = "/basic/toggle_data",
      params = {
        id: id,
        val: val,
        table: "person_comeback",
        filed: "sat_confirm_bed",
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  confirm_travel: function (id, val, cb) {
    var url = "/basic/toggle_data",
      params = {
        id: id,
        val: val,
        table: "person_comeback",
        filed: "sat_confirm_travel",
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  sendToLine: function (sms, id, cb) {
    var url = "/person_comeback/sendtoline",
      params = {
        id: id,
        sms: sms,
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
crud.sendToLine = function (sms, id) {
  crud.ajax.sendToLine(sms, id, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      swal("ส่ง Line เรียบร้อยแล้ว");
      $("#smsModal").modal("toggle");
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

crud.confirm_bed = function (id, val) {
  crud.ajax.confirm_bed(id, val, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
  });
  return true;
};
crud.confirm_travel = function (id, val) {
  crud.ajax.confirm_travel(id, val, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
  });
  return true;
};
crud.set_update = function (data, row_id) {
  $("#row_id").val(row_id);
  $("#id").val(data.rows["id"]);
  $("#sat_confirm_bed").val(data.rows["sat_confirm_bed"]);
  $("#sat_confirm_travel").val(data.rows["sat_confirm_travel"]);
  $("#process_status").val(data.rows["process_status"]);
  $("#travel_status").val(data.rows["travel_status"]);
  $("#travel_date").val(data.rows["travel_date"]);
  $("#travel_type").val(data.rows["travel_type"]);
  $("#lab_type").val(data.rows["lab_type"]);
  $("#prov").val(data.rows["prov"]);
  $("#amp").val(data.rows["amp"]);
  $("#tambon").val(data.rows["tambon"]);
  $("#moo").val(data.rows["moo"]);
  $("#address").val(data.rows["address"]);
  $("#hospcode").val(data.rows["hospcode"]);
  $("#cid").val(data.rows["cid"]);
  $("#prename").val(data.rows["prename"]);
  $("#name").val(data.rows["name"]);
  $("#lname").val(data.rows["lname"]);
  $("#sex").val(data.rows["sex"]);
  $("#birth").val(data.rows["birth"]);
  $("#age_y").val(data.rows["age_y"]);
  $("#tel").val(data.rows["tel"]);
  $("#hsub").val(data.rows["hsub"]);
  $("#date_input").val(data.rows["date_input"]);
  $("#note").val(data.rows["note"]);
  $("#confirm_case").val(data.rows["confirm_case"]);
  $("#call_confirm").val(data.rows["call_confirm"]);
};

$("#btn_save").on("click", function (e) {
  e.preventDefault();
  var action;
  var items = {};
  var row_id = $("#row_id").val();
  items.action = $("#action").val();
  // items.brand_name = $("#brand option:selected").text();
  items.id = $("#id").val();
  items.sat_confirm_bed = $("#sat_confirm_bed").val();
  items.sat_confirm_travel = $("#sat_confirm_travel").val();
  items.process_status = $("#process_status").val();
  items.travel_status = $("#travel_status").val();
  items.travel_date = $("#travel_date").val();
  items.travel_type = $("#travel_type").val();
  items.lab_type = $("#lab_type").val();
  items.prov = $("#prov").val();
  items.amp = $("#amp").val();
  items.tambon = $("#tambon").val();
  items.moo = $("#moo").val();
  items.address = $("#address").val();
  items.hospcode = $("#hospcode").val();
  items.cid = $("#cid").val();
  items.prename = $("#prename").val();
  items.name = $("#name").val();
  items.lname = $("#lname").val();
  items.sex = $("#sex").val();
  items.birth = $("#birth").val();
  items.age_y = $("#age_y").val();
  items.tel = $("#tel").val();
  items.hsub = $("#hsub").val();
  items.date_input = $("#date_input").val();
  items.note = $("#note").val();
  items.confirm_case = $("#confirm_case").val();
  items.call_confirm = $("#call_confirm").val();

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
  window.location = site_url + "/person_comeback/add_person_comeback/" + id;
});

//btn_save_doctype
$(document).on("click", 'button[data-btn="btn_save_doctype"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var doc_type = $(this).parent().find("select").val();
  $("#action").val("update");
  window.location = site_url + "/person_comeback/add_person_comeback/" + id;
});

$(document).on("click", 'button[data-btn="btn_files"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var cid = $(this).data("cid");
  window.location = site_url + "/person_comeback/files/" + id + "/" + cid;
});

$(document).on("click", 'button[data-btn="btn_line"]', function (e) {
  var id = $(this).data("id");
  var n = $(this).parent().find("input");
  var message = n.val();
  $("#sms").text(message);
  $("#id_to_line").val(id);
});

$("#Line").on("click", function (e) {
  var text = $("#sms").val();
  var id = $("#id_to_line").val();
  //alert(id);
  crud.sendToLine(text, id);
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
  if (!items.id) {
    swal("กรุณาระบุID");
    $("#id").focus();
  } else if (!items.sat_confirm_bed) {
    swal("กรุณาระบุแจ้ง SAT ได้เตียง");
    $("#sat_confirm_bed").focus();
  } else if (!items.sat_confirm_travel) {
    swal("กรุณาระบุแจ้ง SAT เดินทาง");
    $("#sat_confirm_travel").focus();
  } else if (!items.process_status) {
    swal("กรุณาระบุสถานะดำเนินการ");
    $("#process_status").focus();
  } else if (!items.travel_status) {
    swal("กรุณาระบุสถานนะการเดินทาง");
    $("#travel_status").focus();
  } else if (!items.travel_date) {
    swal("กรุณาระบุวันที่เดินทาง");
    $("#travel_date").focus();
  } else if (!items.travel_type) {
    swal("กรุณาระบุประเภทการเดินทาง");
    $("#travel_type").focus();
  } else if (!items.lab_type) {
    swal("กรุณาระบุประเภทผล Lab");
    $("#lab_type").focus();
  } else if (!items.prov) {
    swal("กรุณาระบุจังหวัด");
    $("#prov").focus();
  } else if (!items.amp) {
    swal("กรุณาระบุอำเภอ");
    $("#amp").focus();
  } else if (!items.tambon) {
    swal("กรุณาระบุตำบล");
    $("#tambon").focus();
  } else if (!items.moo) {
    swal("กรุณาระบุหมู่ที่");
    $("#moo").focus();
  } else if (!items.address) {
    swal("กรุณาระบุที่อยู่");
    $("#address").focus();
  } else if (!items.hospcode) {
    swal("กรุณาระบุรหัสหน่วยฉีดวัคซีน");
    $("#hospcode").focus();
  } else if (!items.cid) {
    swal("กรุณาระบุเลขบัตรประชาชน");
    $("#cid").focus();
  } else if (!items.prename) {
    swal("กรุณาระบุคำนำหน้า");
    $("#prename").focus();
  } else if (!items.name) {
    swal("กรุณาระบุชื่อ");
    $("#name").focus();
  } else if (!items.lname) {
    swal("กรุณาระบุนามสกุล");
    $("#lname").focus();
  } else if (!items.sex) {
    swal("กรุณาระบุเพศ");
    $("#sex").focus();
  } else if (!items.birth) {
    swal("กรุณาระบุวันเกิด");
    $("#birth").focus();
  } else if (!items.age_y) {
    swal("กรุณาระบุอายุ");
    $("#age_y").focus();
  } else if (!items.tel) {
    swal("กรุณาระบุเบอร์โทร");
    $("#tel").focus();
  } else if (!items.hsub) {
    swal("กรุณาระบุหน่วยบริการรอง");
    $("#hsub").focus();
  } else if (!items.date_input) {
    swal("กรุณาระบุวันที่บันทึกข้อมูล");
    $("#date_input").focus();
  } else if (!items.note) {
    swal("กรุณาระบุบันทึกเพิ่มเติม");
    $("#note").focus();
  } else if (!items.confirm_case) {
    swal("กรุณาระบุผู้ป่วยยืนยัน มหาสารคาม");
    $("#confirm_case").focus();
  } else if (!items.call_confirm) {
    swal("กรุณาระบุโทรกลับ");
    $("#call_confirm").focus();
  } else {
    return true;
  }
}

$(document).on("click", 'button[data-btn="btn_confirm_bed"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var val = $(this).data("val");
  var n = $(this);
  swal({
    title: "คำเตือน?",
    text: "คุณต้องการแก้ไขการได้เตียง ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.confirm_bed(id, val)) {
        if (val == "0") {
          n.removeClass("btn-danger").addClass("btn-success");
          n.find("i").removeClass("fa-times").addClass("fa-check");
        } else {
          n.removeClass("btn-success").addClass("btn-danger");
          n.find("i").removeClass("fa-check").addClass("fa-times");
        }
      }
    }
  });
});

$(document).on("click", 'button[data-btn="btn_confirm_travel"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var val = $(this).data("val");
  var n2 = $(this);
  swal({
    title: "คำเตือน?",
    text: "คุณต้องการแก้ไข ยืนยันการเดินทาง ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.confirm_travel(id, val)) {
        if (val == "0") {
          n2.removeClass("btn-danger").addClass("btn-success");
          n2.find("i").removeClass("fa-times").addClass("fa-check");
        } else {
          n2.removeClass("btn-success").addClass("btn-danger");
          n2.find("i").removeClass("fa-check").addClass("fa-times");
        }
      }
    }
  });
});
