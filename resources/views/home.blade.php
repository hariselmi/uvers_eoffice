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
                @if (Auth::user()->role != 'admin' or Auth::user()->role != 'pimpinan')
                @if (!session('role'))
                <h1>{{ __('Login Sebagai :') }}</h1>
                @else
                <h1>{{ __('Dashboard Sistem SPMI') }}</h1>
                @endif
                @else
                <h1>{{ __('Dashboard Sistem SPMI') }}</h1>
                @endif
            </div>
            <div class="panel-body">
                @if (Auth::user()->role == 'admin' or Auth::user()->role == 'pimpinan' )
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
                @endif
                <div class="row">
                    @if (Auth::user()->role == 'admin' or Auth::user()->role == 'pimpinan')
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
                
                    @else
                    @if (!session('role'))
                    <div class="row">
                        <div class="panel-body">
                    <div class="col-md-4">
                        <a class="btn btn-primary" href="{{ url('/set-role/auditor') }}" role="button"
                        style="width: 100%">Auditor</a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-success" href="{{ url('/set-role/auditee') }}" role="button"
                        style="width: 100%">Auditee</a>
                    </div>
                    <div class="col-md-4">
                        <a class="btn btn-info" href="{{ url('/set-role/anggota') }}" role="button"
                        style="width: 100%">Anggota Auditor</a>
                    </div>
                </div>
                </div>


                

                    @else
                    @if (session('role') == 'auditee')

                 <div class="row">
                    <div class="panel-body">
                        <div class="col-md-12">

                                
                                <h4>Anda Login sebagai : <?=session('role')?></h4>
                            </div>
    
                        </div>
                    </div>
                     <div class="row">
                        <div class="panel-body">
                    <div class="col-md-6">
                        <div class="well blue">
                            <span style="font-size: 40px">{{ $process }}</span> <br>
                            Jadwal Process <br>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="violet well">
                            <span style="font-size: 40px">{{ $complete }}</span> <br>
                            Jadwal Complete <br>
                        </div>
                    </div>
                </div>
                </div>

               
                    @elseif (session('role') == 'auditor')

                     <div class="row">
                        <div class="panel-body">
                        <div class="col-md-12">
       
                                
                                <h4>Anda Login sebagai : <?=session('role')?></h4>

          
                        </div>
                    </div>
                    </div>
                    
                    <div class="row">
<div class="panel-body">
                     <div class="col-md-3">
                        <div class="well green">
                            <span style="font-size: 40px">{{ $pending }}</span> <br>
                            Jadwal Pending <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well blue">
                            <span style="font-size: 40px">{{ $process }}</span> <br>
                            Jadwal Process <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="violet well">
                            <span style="font-size: 40px">{{ $complete }}</span> <br>
                            Jadwal Complete <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="brown well">
                            <span style="font-size: 40px">{{ $cancel }}</span> <br>
                            Jadwal Cancel <br>
                        </div>
                    </div>
                </div>
                </div>

                
                    @elseif (session('role') == 'anggota')


                       <div class="row">
                        <div class="panel-body">
                        <div class="col-md-12">
                           
                                <h4>Anda Login sebagai : <?=session('role')?></h4>
                            </div>
                        </div>
                    </div>
                <div class="row">
                        <div class="panel-body">
                    <div class="col-md-3">
                        <div class="well green">
                            <span style="font-size: 40px">{{ $pending }}</span> <br>
                            Jadwal Pending <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="well blue">
                            <span style="font-size: 40px">{{ $process }}</span> <br>
                            Jadwal Process <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="violet well">
                            <span style="font-size: 40px">{{ $complete }}</span> <br>
                            Jadwal Complete <br>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="brown well">
                            <span style="font-size: 40px">{{ $cancel }}</span> <br>
                            Jadwal Cancel <br>
                        </div>
                    </div>
                </div>
            </div>
                    @endif
                    @endif
                    @endif
                </div>
            </div>
        </div>
    
    @if (Auth::user()->role == 'admin' or Auth::user()->role == 'pimpinan')
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
    @endif
</div>
@endsection
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.2/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.0/morris.min.js"></script>
<!-- chart js -->
<script src="{{asset('assets/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{asset('assets/chart.js/dist/Chart.bundle.js')}}"></script>
<script src="{{asset('assets/chart.js/samples/utils.js')}}"></script>

@if (Auth::user()->role == 'admin' or Auth::user()->role == 'pimpinan')
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
   @endif


@endsection