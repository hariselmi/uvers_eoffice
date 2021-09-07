<div class="modal-content" id="showArticle">
    <section class="content-header">
        <h1><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            {{ __('Artikel') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
        @include('partials.flash')
        <div class="row">
            <div class="col-md-12">
                <!-- Profile Image -->
                <div class="box box-success">
                    <div class="box-body box-profile">
                        {{-- <img class="profile-user-img img-responsive img-circle" src="{{$avatar}}" alt="User profile picture"> --}}
                        <table>
                            <tr>
                                <td>Kategori</td>
                                <td>:</td>
                                <td>{{ $article->category }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal</td>
                                <td>:</td>
                                <td>{{ $article->date }}</td>
                            </tr>
                            <tr>
                                <td>Konten</td>
                                <td>:</td>
                                <td>{!! $article->content !!}</td>
                            </tr>
                            <tr>
                                <td>Gambar</td>
                                <td>:</td>
                                <td><img src="{{asset('/images/article/'.$article->thumbnail )}}" alt="" width="50px" height="50px"></td>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
</div>