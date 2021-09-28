@extends('layouts.app')
@section('page-style')
<link rel="stylesheet" href="{{ asset('css/pages/dashboard.css') }}">
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                @include('partials.flash')
                <h3>{{ __('Dashboard e-Office - Universitas Universal') }}</h3>
 
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-12 form-inline">
                            <div class="form-group pr-2 pull-right">
                                <label class="pr-1" for="per_page"> Periode </label>
                                <select class="form-control" name="period_filter" onchange="period_filter(this.value);">
                                    @foreach($periods as $index=>$value) 
                                    <?php
                                    $selected = ($value->status == '1') ? 'selected' : '';
                                    ?>
                                    <option value="{{$value->id}}" {{$selected}}>{{$value->title}} {{$value->semester}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="div_period_id"></div>
                </div>
               
                <div class="row">

                    <div class="col-md-3">
                        <div class="well violet">
                            <span style="font-size: 40px"><div id="pending_filter"></div></span> <br>
                            Jadwal Pending <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well blue">
                            <span style="font-size: 40px"><div id="process_filter"></div></span> <br>
                            Jadwal Process <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well green">
                            <span style="font-size: 40px"><div id="complete_filter"></div></span> <br>
                            Jadwal Complete <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well purple">
                            <span style="font-size: 40px"><div id="cancel_filter"></div></span> <br>
                            Jadwal Cancel <br>
                        </div>
                    </div>
                </div>
                
    <div class="row">
        <div class="col-md-12">
            <div class="panel-heading">
                Grafik
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <canvas id="canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
                    

                </div>
            </div>
        </div>
    

</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>
<!-- chart js -->
<script src="{{asset('assets/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('assets/chart.js/dist/Chart.bundle.js')}}"></script>
<script src="{{asset('assets/chart.js/samples/utils.js')}}"></script>


<script>
$(function() {
$('[data-toggle="tooltip"]').tooltip()
});
</script>

<script type="text/javascript">
function period_filter(period_id) {


  url = site_url + "/home/period_filter";
  $.ajax({
    type: "POST",
    url: url,
    data: {
     "_token": "{{ csrf_token() }}",
      period_id : period_id
    },
    success: function(data) {
      if (data) {
        $("#pending_filter").html(data.pending);
        $("#process_filter").html(data.process);
        $("#complete_filter").html(data.complete);
        $("#cancel_filter").html(data.cancel);


        var totalaudit      = data.pending + data.process + data.complete + data.cancel;
        var pending_value   = (data.pending/totalaudit) * 100;
        var process_value   = (data.process/totalaudit) * 100;
        var complete_value  = (data.complete/totalaudit) * 100;
        var cancel_value    = (data.cancel/totalaudit) * 100;
 

        var MONTHS = ["Pending", "Process", "Complete", "Cancel"];
        var barChartData = {
        labels: ["Pending", "Process", "Complete", "Cancel"],
        datasets: [{
        label: 'Persentase',
        backgroundColor: [
        window.chartColors.violet,
        window.chartColors.blue,
        window.chartColors.green,
        window.chartColors.purple
        ],
        borderColor: window.chartColors.violet,
        borderWidth: 1,
        data: [
        pending_value,
        process_value,
        complete_value,
        cancel_value,
        ]
        }]
        };


var ctx = document.getElementById("canvas").getContext("2d");
window.myBar = new Chart(ctx, {
type: 'bar',
data: barChartData,
options: {
responsive: true,
legend: {
position: 'top',
},
title: {
display: true,
text: 'Grafik Audit Universitas Universal'
},
scales: {
xAxes: [{
display: true,
scaleLabel: {
display: true,
labelString: 'Status Audit'
}
}],
yAxes: [{
display: true,
ticks: {
beginAtZero: true,
steps: 10,
stepValue: 5,
max: 100
}
}]
},
}
});

      }

    }
  });
}
period_filter('<?=$period_current_id?>');
</script>


@endsection