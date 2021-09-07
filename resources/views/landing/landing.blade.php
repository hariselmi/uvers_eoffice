@include('landing.head')

{!!Get_field::get_data('30', 'pages', 'content')!!}


<!-- Latest News -->
<div class="section section-news section-pad">
	<div class="container">
		<div class="content row">
			<div class="col-md-6 ">
			<h2 class="center">PEMBARUAN STANDAR MUTU</h2>
			<div class="gaps size-md"></div>
			<div class="blog-posts">
				<div class="row">
					<!-- // -->

					  @foreach($articles_standar as $index=>$value) 

					<div class="post post-boxed col-sm-12 res-s-bttm-lg mt-x2">
						<div class="post-thumbs">
							<a href="/articles_details/{{$value->id}}"><img alt="" src="{{asset('images/article')}}/{!!$value->thumbnail!!}"></a>
							<div class="post-meta"><span class="pub-date"><strong>{{date('d',strtotime($value->date))}}</strong> {{date('m',strtotime($value->date))}}</span></div>
						</div>
						<div class="post-entry">
							<h3><a href="/articles_details/{{$value->id}}">{!!$value->title!!}</a></h3>



							<p class="alignjustify">{!!$value->content!!}</p>
							<a class="btn-link link-arrow-sm" href="/articles_details/{{$value->id}}">Read More</a>
						</div>
					</div>

					  @endforeach

				</div>
			</div>
		</div>

					<div class="col-md-6 ">
			<h2 class="center">AGENDA KEGIATAN LPM</h2>
			<div class="gaps size-md"></div>
			<div class="blog-posts">
				<div class="row">
					<!-- // -->

					  @foreach($articles_agenda as $index=>$value) 

					<div class="post post-boxed col-sm-12 res-s-bttm-lg mt-x2">
						<div class="post-thumbs">
							<a href="/articles_details/{{$value->id}}"><img alt="" src="{{asset('images/article')}}/{!!$value->thumbnail!!}"></a>
							<div class="post-meta"><span class="pub-date"><strong>{{date('d',strtotime($value->date))}}</strong> {{date('m',strtotime($value->date))}}</span></div>
						</div>
						<div class="post-entry">
							<h3><a href="/articles_details/{{$value->id}}">{!!$value->title!!}</a></h3>

		


							<p class="alignjustify">{!!$value->content!!}</p>
							<a class="btn-link link-arrow-sm" href="/articles_details/{{$value->id}}">Read More</a>
						</div>
					</div>

					  @endforeach

				</div>
			</div>
		</div>


	</div>


	</div>
</div>
<!-- End Section -->
<!-- Latest News -->
<!-- End Section -->
@include('landing.foot')