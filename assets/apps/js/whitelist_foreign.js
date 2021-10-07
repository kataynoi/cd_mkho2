$(document).ready(function () {
  var dataTable = $("#table_data").DataTable({
    createdRow: function (row, data, dataIndex) {
      $(row).attr("name", "row" + dataIndex);
      if (data[1] == 1) {
        $(row).addClass("green");
      } else if (data[1] == 2) {
        $(row).addClass("orange");
      } else {
        //$(row).addClass("orange");
      }
    },
    processing: true,
    serverSide: true,
    order: [],

    pageLength: 50,
    ajax: {
      url: site_url + "/whitelist_foreign/fetch_whitelist_foreign",
      data: {
        csrf_token: csrf_token,
      },
      type: "POST",
    },
    columnDefs: [
      {
        targets: [0, 1, 2, 3, 6, 7, 8, 9, 10],
        orderable: false,
      },
      {
        targets: [1],
        visible: false,
      },
    ],
  });
  //$("#prov").select2();
  $(".datepicker").datepicker({
    format: "dd/mm/yyyy",
    todayBtn: false,
    language: "th", //เปลี่ยน label ต่างของ ปฏิทิน ให้เป็น ภาษาไทย   (ต้องใช้ไฟล์ bootstrap-datepicker.th.min.js นี้ด้วย)
    thaiyear: true, //Set เป็นปี พ.ศ.
    autoclose: true,
  });
  //.datepicker("setDate", "0");
  //$("#birth").datepicker();
  $("#nation").select2();
  $("#destination").select2();
  var action = $("#action").val();
  var person_type = $("#person_type").val();
  if (action == "insert") {
    $("#div_destination").hide();
    $("#div_risk_vaccine").hide();
  } else {
    if (action == "update" && [person_type] == 1) {
      $("#div_destination").hide();
      $("#div_risk_vaccine").show();
    } else if (action == "update" && [person_type] == 2) {
      $("#div_destination").show();
      $("#div_risk_vaccine").hide();
    }
  }
});

var crud = {};

crud.ajax = {
  del_data: function (id, cb) {
    var url = "/whitelist_foreign/del_whitelist_foreign",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save: function (items, cb) {
    var url = "/whitelist_foreign/save_whitelist_foreign",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  save_org: function (items, cb) {
    var url = "/whitelist_foreign/save_org",
      params = {
        items: items,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_update: function (id, cb) {
    var url = "/whitelist_foreign/get_whitelist_foreign",
      params = {
        id: id,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_foreign_by_cid: function (cid, cb) {
    var url = "/whitelist_foreign/get_foreign_by_cid",
      params = {
        cid: cid,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_ampur_list: function (provcode, cb) {
    var url = "/basic/get_ampur_list",
      params = {
        provcode: provcode,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_tambon_list: function (amp, cb) {
    var url = "/basic/get_tambon_list",
      params = {
        amp: amp,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  get_moo_list: function (code, cb) {
    var url = "/basic/get_moo_list",
      params = {
        code: code,
      };

    app.ajax(url, params, function (err, data) {
      err ? cb(err) : cb(null, data);
    });
  },
  confirm_vaccine: function (id, val, cb) {
    var url = "/basic/set_data",
      params = {
        id: id,
        val: val,
        table: "whitelist_foreign",
        filed: "confirm_vaccine",
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
      $("#register").hide();
      //var q = data.id;
      var hospname = $("#hospcode").find(":selected").html();
      //console.log("Queue:" + q);
      $("#hos_regis").html(hospname);
      //$("#q").html(q);
      $("#alert").show();
    } else {
      $("#register").hide();
      var q = data.id;
      var hospname = $("#hospcode").find(":selected").html();
      console.log("Queue:" + q);
      $("#hos_regis").html(hospname);
      $("#q").html(q);
      $("#alert").show();
      //swal("บันทึกข้อมูลเรียบร้อยแล้ว ");
      //window.location = site_url + "/whitelist_foreign/add_whitelist";
    }
  });
};
crud.save_org = function (items) {
  crud.ajax.save_org(items, function (err, data) {
    if (err) {
      //app.alert(err);
      swal(err);
    } else {
      swal("บันทึกข้อมูลเรียบร้อยแล้ว ");
      window.location = site_url + "/whitelist_foreign";
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
  row_id.find("td:eq(0)").html(items.id);
  row_id.find("td:eq(1)").html(items.organization);
  row_id.find("td:eq(2)").html(items.target_type);
  row_id.find("td:eq(3)").html(items.prov);
  row_id.find("td:eq(4)").html(items.amp);
  row_id.find("td:eq(5)").html(items.tambon);
  row_id.find("td:eq(6)").html(items.moo);
  row_id.find("td:eq(7)").html(items.hospname);
  row_id.find("td:eq(8)").html(items.hospcode);
  row_id.find("td:eq(9)").html(items.cid);
  row_id.find("td:eq(10)").html(items.prename);
  row_id.find("td:eq(11)").html(items.name);
  row_id.find("td:eq(12)").html(items.lname);
  row_id.find("td:eq(13)").html(items.sex);
  row_id.find("td:eq(14)").html(items.birth);
  row_id.find("td:eq(15)").html(items.tel);
  row_id.find("td:eq(16)").html(items.vaccine);
};

crud.set_update = function (data, row_id) {
  $("#row_id").val(row_id);
  $("#id").val(data.rows["id"]);
  $("#organization").val(data.rows["organization"]);
  $("#target_type").val(data.rows["target_type"]);
  $("#prov").val(data.rows["prov"]);
  $("#amp").val(data.rows["amp"]);
  $("#tambon").val(data.rows["tambon"]);
  $("#moo").val(data.rows["moo"]);
  $("#hospname").val(data.rows["hospname"]);
  $("#hospcode").val(data.rows["hospcode"]);
  $("#cid").val(data.rows["cid"]);
  $("#prename").val(data.rows["prename"]);
  $("#name").val(data.rows["name"]);
  $("#lname").val(data.rows["lname"]);
  $("#sex").val(data.rows["sex"]);
  $("#birth").val(data.rows["birth"]);
  $("#tel").val(data.rows["tel"]);
  $("#vaccine").val(data.rows["vaccine"]);
};

$("#btn_save").on("click", function (e) {
  e.preventDefault();
  var action;
  var items = {};
  var row_id = $("#row_id").val();
  items.action = $("#action").val();
  // items.brand_name = $("#brand option:selected").text();
  items.id = $("#id").val();
  items.person_type = $("#person_type").val();
  items.file1 = $("#file1").val();
  items.file2 = $("#file2").val();
  items.file3 = $("#file3").val();
  items.file4 = $("#file4").val();
  items.weight = $("#weight").val();
  items.height = $("#height").val();
  items.prov = $("#prov").val();
  items.ampur = $("#ampur").val();
  items.tambon = $("#tambon").val();
  items.moo = $("#moo").val();
  items.cid = $("#cid").val();
  items.prename = $("#prename").val();
  items.name = $("#name").val();
  items.lname = $("#lname").val();
  items.sex = $("#sex").val();
  items.nation = $("#nation").val();
  items.risk_vaccine = $("#risk_vaccine").val();
  items.destination = $("#destination").val();
  items.birth = $("#birth").val();
  items.tel = $("#tel").val();
  items.hospcode = $("#hospcode").val();
  items.hospname = $("#hospcode").find(":selected").html();
  items.vaccine = $("input[name='vaccine']:checked").val();

  if (validate(items)) {
    $("#frm_register").submit();
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
  if (!items.person_type) {
    swal("กรุณาเลือกประเภทการลงทะเบียน");
    $("#cid").focus();
  } else if (items.person_type == 2 && !items.destination) {
    swal("กรุณาระบุประเทศปลายทาง");
    $("#cid").focus();
  } else if (!items.cid) {
    swal("กรุณาระบุเลขบัตรประชาชนหรือ Passport");
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
  } else if (!items.tel || items.tel.length != 10) {
    swal("กรุณาระบุเบอร์โทรให้ถูกต้อง");
    $("#tel").focus();
  } else if (!items.prov) {
    swal("กรุณาระบุจังหวัด");
    $("#prov").focus();
  } else if (!items.ampur) {
    swal("กรุณาระบุอำเภอ");
    $("#amp").focus();
  } else if (!items.tambon) {
    swal("กรุณาระบุตำบล");
    $("#tambon").focus();
  } else if (!items.moo) {
    swal("กรุณาระบุหมู่ที่");
    $("#moo").focus();
  } else if (
    items.person_type == 1 &&
    items.action == "insert" &&
    !items.weight &&
    !items.height
  ) {
    swal(" weight height field is required");
    $("#weight").focus();
  } else if (!items.file1 && items.action == "insert") {
    swal("กรุณาแนบ ไฟลล์ Passport");
    $("#file1").focus();
  } else if (
    !items.file3 &&
    items.person_type == 2 &&
    items.action == "insert"
  ) {
    swal(
      "กรุณาแนบ ไฟลล์ เอกสารการเดินทางไปต่างประเทศเช่น เอกสารจากมหาวิทยาลัยหรือตั๋วเครื่องบิน"
    );
    $("#file3").focus();
  } else if (!items.hospcode) {
    swal("กรุณาระบุหน่วยบริการที่ต้องการฉีดวัคซีน: select hospital");
    $("#้hospcode").focus();
  } else {
    return true;
  }
}
$("#btn_save_org").on("click", function (e) {
  e.preventDefault();
  var action;
  var items = {};

  // items.brand_name = $("#brand option:selected").text();
  items.id = $("#id").val();
  items.org_name = $("#org_name").val();
  items.tel = $("#tel").val();
  items.ampur = $("#ampur").val();
  items.action = $("#action").val();

  if (validate_org(items)) {
    crud.save_org(items);
  }
});

crud.confirm_vaccine = function (id, val) {
  crud.ajax.confirm_vaccine(id, val, function (err, data) {
    if (err) {
      $r = false;
    } else {
      $r = true;
    }
    //alert($r);
  });
  return true;
};
crud.get_foreign_by_cid = function (cid) {
  crud.ajax.get_foreign_by_cid(cid, function (err, data) {
    $("#provchange").val("0");
    if (!err) {
      if (data.check_vaccine) {
        swal("บุคคลนี้ได้รับการฉีดวัคซีนแล้ว");
        app.clear_form();
        return;
      } else if (data.check) {
        swal("บุคคลนี้บันทึกข้อมูลในระบบแล้ว");
        app.clear_form();
        return;
      } else if (data.rows["age_y"] < 18 || data.rows["age_y"] > 60) {
        swal("บุคคลนี้ไม่อยู่ในช่วงอายุ 18-60 ปี");
        app.clear_form();
        return;
      } else if (data.rows) {
        $("#cid").val(data.rows["CID"]);
        $("#prename").val(data.rows["PRENAME"]);
        $("#name").val(data.rows["NAME"]);
        $("#lname").val(data.rows["LNAME"]);
        $("#birth").val(data.rows["BIRTH"]);
        $("#sex").val(data.rows["SEX"]);
        $("#no").val(data.rows["addr"]);
        $("#hospcode").val(data.rows["HOSPMAIN"]);
        $("#hsub").val(data.rows["HOSPCODE"]);
        //$("#age").val(data.rows["age_y"]);
        $provcode = data.rows["vhid"].substring(0, 2);
        $amp = data.rows["vhid"].substring(0, 4);
        $tambon = data.rows["vhid"].substring(0, 6);
        $moo = data.rows["vhid"];
        crud.get_ampur_list($provcode);
        crud.get_tambon_list($amp);
        crud.get_moo_list($tambon);
        $(document).ajaxStop(function () {
          $check_provchange = $("#provchange").val();
          if ($check_provchange == 0) {
            $("#prov").val($provcode);
            $("#ampur").val($amp);
            $("#tambon").val($tambon);
            $("#moo").val($moo);
          }
        });
      } else {
        $("#name").focus();
      }
    }
  });
};
crud.get_ampur_list = function (provcode) {
  $("#ampur").empty();

  crud.ajax.get_ampur_list(provcode, function (err, data) {
    if (!err) {
      $("#ampur").append('<option value="">-*-</option>');
      _.each(data.rows, function (v) {
        $("#ampur").append(
          '<option value="' + v.ampurcodefull + '">' + v.ampurname + "</option>"
        );
      });
    }
  });
};
crud.get_tambon_list = function (ampcode) {
  $("#tambon").empty();

  crud.ajax.get_tambon_list(ampcode, function (err, data) {
    if (!err) {
      $("#tambon").append('<option value="">-*-</option>');
      _.each(data.rows, function (v) {
        $("#tambon").append(
          '<option value="' +
            v.tamboncodefull +
            '">' +
            v.tambonname +
            "</option>"
        );
      });
    }
  });
};

crud.get_moo_list = function (code) {
  $("#moo").empty();

  crud.ajax.get_moo_list(code, function (err, data) {
    if (!err) {
      $("#moo").append('<option value="">-*-</option>');
      _.each(data.rows, function (v) {
        $("#moo").append(
          '<option value="' +
            v.villagecodefull +
            '" data-villagecode="' +
            v.villagecodefull +
            '">' +
            v.villagecode +
            ":" +
            v.villagename +
            "</option>"
        );
      });
    }
  });
};

$("#prov").on("change", function () {
  var prov = $(this).val();
  $("#provchange").val("1");
  crud.get_ampur_list(prov);
});
$("#ampur").on("change", function () {
  var amp = $(this).val();
  $("#provchange").val("1");
  crud.get_tambon_list(amp);
});
$("#tambon").on("change", function () {
  var tambon = $(this).val();
  $("#provchange").val("1");
  crud.get_moo_list(tambon);
});
$("#new_regis").on("click", function () {
  $("#alert").hide();
  app.clear_form();
  $("#register").show();
  $("#hos_regis").html("");
  $("#q").html("");
});

$(document).on("click", 'button[data-btn="btn_con_vac"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var val = $(this).data("val");
  var n = $(this);
  swal({
    title: "คำเตือน?",
    text: "คุณต้องการแก้ไขสถานะรับวัคซีน ",
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.confirm_vaccine(id, val)) {
        if (val == "0") {
          n.removeClass("btn-danger").addClass("btn-success");
          n.find("i").removeClass("fa-times").addClass("fa-check");
          n.data("val", 1);
        } else {
          n.removeClass("btn-success").addClass("btn-danger");
          n.find("i").removeClass("fa-check").addClass("fa-times");
          n.data("val", 0);
        }
      }
    }
  });
});

$(document).on("change", 'select[data-name="confirm_vaccine"]', function (e) {
  e.preventDefault();
  var id = $(this).data("id");
  var val = $(this).val();
  var tr = $(this).parent().parent().parent();
  var text = "";
  if (val == 0) {
    text = "ไม่ผ่านการพิจารณา";
  } else if (val == 1) {
    text = "รับวัคซีน";
  } else if (val == 2) {
    text = "รอตรวจสอบ";
  }
  swal({
    title: "คำเตือน?",
    text: "คุณต้องการแก้ไขสถานะเป็น " + text,
    icon: "warning",
    buttons: ["cancel !", "Yes !"],
    dangerMode: true,
  }).then(function (isConfirm) {
    if (isConfirm) {
      if (crud.confirm_vaccine(id, val)) {
        if (val == 0) {
          tr.removeClass("green").removeClass("orange");
        } else if (val == 1) {
          tr.removeClass("orange").addClass("green");
        } else if (val == 2) {
          tr.removeClass("green").addClass("orange");
        }
      }
    }
  });
});

$("#person_type").on("change", function (e) {
  var val = $(this).val();
  //alert(val);
  if (val == 1) {
    $("#div_destination").hide();
    $("#div_risk_vaccine").show();
  } else if (val == 2) {
    $("#div_destination").show();
    $("#div_risk_vaccine").hide();
  }
});

$("#cid").on("keyup", function () {
  var cid = $("#cid").val();
  var person_type = $("#person_type").val();
  if (cid.length == 13 && person_type == 2) {
    // alert(cid);
    crud.get_person_by_cid(cid);
  }
});

crud.get_person_by_cid = function (cid) {
  crud.ajax.get_foreign_by_cid(cid, function (err, data) {
    $("#provchange").val("0");
    if (!err) {
      if (data.check) {
        swal("บุคคลนี้บันทึกข้อมูลในระบบแล้ว");
        app.clear_form();
        return;
      } else if (data.rows) {
        $("#cid").val(data.rows["CID"]);
        $("#prename").val(data.rows["PRENAME"]);
        $("#name").val(data.rows["NAME"]);
        $("#lname").val(data.rows["LNAME"]);
        $("#birth").val(data.rows["BIRTH"]);
        $("#sex").val(data.rows["SEX"]);
        $("#no").val(data.rows["addr"]);
        $("#hospcode").val(data.rows["HOSPMAIN"]);
        $("#hsub").val(data.rows["HOSPCODE"]);
        //$("#age").val(data.rows["age_y"]);
        $provcode = data.rows["vhid"].substring(0, 2);
        $amp = data.rows["vhid"].substring(0, 4);
        $tambon = data.rows["vhid"].substring(0, 6);
        $moo = data.rows["vhid"];
        crud.get_ampur_list($provcode);
        crud.get_tambon_list($amp);
        crud.get_moo_list($tambon);
        $(document).ajaxStop(function () {
          $check_provchange = $("#provchange").val();
          if ($check_provchange == 0) {
            $("#prov").val($provcode);
            $("#ampur").val($amp);
            $("#tambon").val($tambon);
            $("#moo").val($moo);
          }
        });
      } else {
        $("#name").focus();
      }
    }
  });
};
