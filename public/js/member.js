function getMembers(e) {
  var url = site_url + "/members/getmembers" + "/" + e;

  
  // $.get(url);

  $.ajax({
    type: "GET",
    url: url,
    success: function (data) {
      if (data) {
        $("#users_id").empty();
        var o = new Option("Pilih Anggota", "");
        /// jquerify the DOM object 'o' so we can use the html method
        $(o).html("Pilih Anggota", "");
        $("#users_id").append(o);
        for (let index = 0; index < data.length; index++) {
          const element = data[index];
          var o = new Option("Pilih Anggota", element.id);
          /// jquerify the DOM object 'o' so we can use the html method
          $(o).html(element.name, element.id);
          $("#users_id").append(o);

        }
      }
    },
  });
}



$('#auditor_id, #edit_auditor_id').select2({
    width:'100%'
});
