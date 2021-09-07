@include('landing.head')
<!-- Content -->
<div class="section section-contents section-pad">
	<!-- Content -->
	<div class="section section-contents section-pad bg-light">
		<div class="container">
			{!!Get_field::get_data('25', 'pages', 'content')!!}

		</div>
	</div>
	
	<!-- End Content -->
</div>
@include('landing.foot')
