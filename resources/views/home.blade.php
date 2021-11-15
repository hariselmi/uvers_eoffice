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
                <h4>Selamat Datang, {{ Get_field::get_data(Auth::user()->pegawai_id, 'pegawai', 'nama') }}</h4>
 
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="panel-body">
                        <div class="col-md-12 form-inline">
    
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


@endsection