@include('landing.head')
	
	<!-- Content -->
	<div class="section section-contents section-pad bg-light">
		<div class="container">


{!!Get_field::get_data('1', 'pages', 'content')!!}



		</div>
	</div>
	<!-- End Content -->
	

@include('landing.foot')	