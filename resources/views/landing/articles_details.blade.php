@include('landing.head')
	<!-- Content -->
	<div class="section section-blog section-pad">
		<div class="container">
			<div class="content row">
			
				<div class="blog-wrapper row">
					<div class="col-md-8 res-m-bttm">

						<div class="post post-single">
							<div class="post-thumbs">
								<img alt="" src="{{asset('images/article')}}/{!!$articles->thumbnail!!}">
							</div>
							<div class="post-meta">
								<span class="pub-date"><em class="fa fa-calendar" aria-hidden="true"></em> {{date('d M	, Y',strtotime($articles->date))}} </span>
							</div>
							<div class="post-entry">
								<h1>{!!$articles->title!!}</h1>
								{!!$articles->content!!}
							</div>
						</div>
						
					</div>

<!-- Sidebar -->
					<div class="col-md-4">
						<div class="sidebar-right">
							<div class="wgs-box wgs-recents">
								<h3 class="wgs-heading">Recent Posts</h3>
								<div class="wgs-content">
									<ul class="blog-recent">
										  @foreach($recent_posts as $index=>$value) 
										<li>
											<a href="/articles_details/{{$value->id}}">
												<img alt="/articles_details/{{$value->id}}" src="{{asset('images/article')}}/{!!$value->thumbnail!!}">
												<p>{!!$value->title!!}</p>
											</a>
										</li>
										@endforeach
									</ul>
								</div>
							</div>

						

						</div>
					</div>
					<!-- Sidebar #end -->
				</div>

			</div>
		</div>
	</div>
	<!-- End Content -->
@include('landing.foot')