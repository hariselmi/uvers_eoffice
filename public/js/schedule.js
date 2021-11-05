$(function() {

  $('.date').datepicker({  
    dateFormat: 'dd-mm-yy',
    autoclose: true,
    orientation: "top auto",
  });  

    $('.clockpicker').clockpicker()
    .find('input').change(function(){
    });

});

function getJabatan(e) {
  console.log(e.value, 'e')
  var url = site_url + "/pegawai/getjabatan" + "/" + e.value;

  
  // $.get(url);

  if (e.value) {
    $.ajax({
      type: "GET",
      url: url,
      success: function (data) {
        if (data) {
          $("#jabatan_id").empty();
          var o = new Option("Pilih Jabatan", "");
          /// jquerify the DOM object 'o' so we can use the html method
          $(o).html("Pilih Jabatan", "");
          $("#jabatan_id").append(o);
          for (let index = 0; index < data.length; index++) {
            const element = data[index];
            var o = new Option("Pilih Jabatan", element.id);
            /// jquerify the DOM object 'o' so we can use the html method
            $(o).html(element.nama, element.id);

          $().html("Pilih Jabatan 2", "");

          $("#edit_member_two").append();

            $().html(element.nama, element.id);

            $("#edit_member_two").append();
            $("#jabatan_id").append(o);
          }
        }
      },
    });
    
  }
}

function getJabatanEdit(e) {
  var url = site_url + "/pegawai/getjabatan" + "/" + e.value;
  // $.get(url);

  $.ajax({
    type: "GET",
    url: url,
    success: function (data) {
      if (data) {
        $("#edit_jabatan_id").empty();
        $("#edit_member_two").empty();
        var o = new Option("Pilih Jabatan", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(o).html("Pilih Jabatan", "");
        $("#edit_jabatan_id").append(o);
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          var o = new Option("Pilih Jabatan", element.id);
          /// jquerify the DOM object 'o' so we can use the html method
          $(o).html(element.nama, element.id);
          $("#edit_jabatan_id").append(o);

        }
      }
    },
  });
}

function getStandardDetails(e) {
  var url = site_url + "/schedule/getstandarddetail" + "/" + e.value;
  // $.get(url);

  $.ajax({
    type: "GET",
    url: url,
    success: function (data) {
      if (data) {
        $("#standard_detail_id").empty();
        var o = new Option("Pilih Standar Detail", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(o).html("Pilih Standar Detail", "");
        $("#standard_detail_id").append(o);
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          var o = new Option("Pilih Standar Detail", element.id);
          /// jquerify the DOM object 'o' so we can use the html method
          $(o).html(element.standard_details, element.id);
          $("#standard_detail_id").append(o);
        }
      }
    },
  });
}


function getStandardDetailsEdit(e) {
  var url = site_url + "/schedule/getstandarddetail" + "/" + e.value;
  // $.get(url);

  $.ajax({
    type: "GET",
    url: url,
    success: function (data) {
      if (data) {
        $("#edit_standard_detail_id").empty();
        var o = new Option("Pilih Standar Detail", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(o).html("Pilih Standar Detail", "");
        $("#edit_standard_detail_id").append(o);
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          var o = new Option("Pilih Standar Detail", element.id);
          /// jquerify the DOM object 'o' so we can use the html method
          $(o).html(element.standard_details, element.id);
          $("#edit_standard_detail_id").append(o);
        }
      }
    },
  });
}

$('#auditor_id, #auditee_id, #semester_period, #academic_year, #member_one, #member_two, #standard_id, #standard_detail_id, #status, #edit_auditor_id, #edit_auditee_id, #edit_semester_period, #edit_academic_year, #edit_member_one, #edit_member_two, #edit_standard_id, #edit_standard_detail_id, #edit_status').select2({
    width:'100%'
});

function getClockStartEdit() {


  url = site_url + "/schedule/getclockstartedit";
  $.ajax({
    type: "POST",
    url: url,
    data: {
      auditor : document.getElementById("edit_auditor_id").value,
      auditee : $('#edit_auditee_id').val(),
      tanggal : $('#edit_schedule_date').val(),
      scheduleid : $('#edit_id').val(),
    },
    success: function(data) {
      if (data) {
      $("#edit_clock_start_id").html(data.clock);
      $("#edit_clock_finish_id").html(data.clock2);
      }

    }
  });
}



    
