@extends('layouts.admin_dynamic')

@section('content')
<div class="content-wrapper">
    @include('schedule.schedule')
</div>

@endsection


@section('script')
<script type="text/javascript">
function getClockStart() {


  url = site_url + "/schedule/getclockstart";
  $.ajax({
    type: "POST",
    url: url,
    data: {
      auditor : $('#auditor_id').val(),
      auditee : $('#auditee_id').val(),
      tanggal : $('#schedule_date').val(),
    },
    success: function(data) {
      if (data) {
  		$("#clock_start_id").html(data.clock);
      $("#clock_finish_id").html(data.clock);
      }

    }
  });
}
</script>

@endsection