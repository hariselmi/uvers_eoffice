@if (Auth::check())
    <aside class="main-sidebar">
        <section class="sidebar">
            <!-- sidebar menu: : style can be found in sidebar.less -->

             <!-- admin menu buka -->
            @if (Auth::user()->role == 'admin')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU UTAMA</li>

                    <li class=""><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                            <span>{{ trans('menu.dashboard') }}</span></a></li>

                    @if (auth()->user()->checkSpPermission('schedulingaudit.index'))
                        <li
                            class="{{ Request::is('documents') || Request::is('schedules') || Request::is('members') ? 'active' : '' }} treeview">
                            <a href="#"><i class="fa fa-calendar"></i> <span>{{ __('Persiapan Audit') }}</span><span
                                    class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                            <ul class="treeview-menu">
                                @if (auth()->user()->checkSpPermission('members.index'))
                                    <li class="{{ Request::is('members') ? 'active' : '' }} ">
                                        <a href="{{ url('/members') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ trans('menu.members') }}</span></a>
                                    </li>
                                @endif
                                @if (auth()->user()->checkSpPermission('schedules.index'))
                                    <li class="{{ Request::is('schedules') ? 'active' : '' }} ">
                                        <a href="{{ url('/schedules') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ trans('menu.schedules') }}</span></a>
                                    </li>
                                @endif

                                @if (auth()->user()->checkSpPermission('documents.index'))
                                    <li class="{{ Request::is('documents') ? 'active' : '' }} ">
                                        <a href="{{ url('/documents') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Daftar Dokumen') }}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (auth()->user()->checkSpPermission('audit.index'))
                        <li
                            class="{{ Request::is('checklists') || Request::is('findings') || Request::is('reports') || Request::is('uploaddocuments') ? 'active' : '' }} treeview">
                            <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Pelaksanaan Audit') }}</span><span
                                    class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                            <ul class="treeview-menu">

                                @if (auth()->user()->checkSpPermission('checklists.index'))
                                    <li class="{{ Request::is('checklists') ? 'active' : '' }} ">
                                        <a href="{{ url('/checklists') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Daftar Cheklist') }}</span></a>
                                    </li>
                                @endif
                                @if (auth()->user()->checkSpPermission('uploaddocuments.index'))
                                    <li class="{{ Request::is('uploaddocuments') ? 'active' : '' }} "><a
                                            href="{{ url('/uploaddocuments') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ trans('menu.uploaddocuments') }}</span></a></li>
                                @endif
                                @if (auth()->user()->checkSpPermission('findings.index'))
                                    <li class="{{ Request::is('findings') ? 'active' : '' }} ">
                                        <a href="{{ url('/findings') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Daftar Temuan') }}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif


                    @if (auth()->user()->checkSpPermission('audit.index'))
                        <li
                            class="{{ Request::is('checklists') || Request::is('findings') || Request::is('reports') || Request::is('uploaddocuments') ? 'active' : '' }} treeview">
                            <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Penutupan Audit') }}</span><span
                                    class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                            <ul class="treeview-menu">
                                @if (auth()->user()->checkSpPermission('reports.index'))
                                    <li class="{{ Request::is('reports') ? 'active' : '' }} ">
                                        <a href="{{ url('/reports') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Laporan Audit') }}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (auth()->user()->checkSpPermission('reportalls.index'))
                        <li class="{{ Request::is('reportalls') ? 'active' : '' }} "><a
                                href="{{ url('/reportalls') }}"><i class="fa fa-file"></i>
                                <span>{{ trans('menu.reportalls') }}</span></a></li>
                    @endif

                    @if (auth()->user()->checkSpPermission('rtm.index'))
                        <li
                            class="{{ Request::is('agenda') || Request::is('verification') ? 'active' : '' }} treeview">
                            <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Rapat Tinjauan Manajemen') }}</span><span
                                    class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                            <ul class="treeview-menu">
                                @if (auth()->user()->checkSpPermission('agenda.index'))
                                    <li class="{{ Request::is('agenda') ? 'active' : '' }} ">
                                        <a href="{{ url('/agenda') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Berita Acara') }}</span></a>
                                    </li>
                                @endif
                                 @if (auth()->user()->checkSpPermission('verification.index'))
                                    <li class="{{ Request::is('verification') ? 'active' : '' }} ">
                                        <a href="{{ url('/verification') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Verifikasi Tindak Lanjut') }}</span></a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif



                    @if (auth()->user()->checkSpPermission('settingweb.index'))
                        <li
                            class="{{ Request::is('articles') || Request::is('sliders') || Request::is('pages') ? 'active' : '' }} treeview">
                            <a href="#"><i class="fa fa-cog"></i> <span>{{ __('Website') }}</span><span
                                    class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                            <ul class="treeview-menu">


                                @if (auth()->user()->checkSpPermission('articles.index'))
                                    <li class="{{ Request::is('articles') ? 'active' : '' }} "><a
                                            href="{{ url('/articles') }}"><i class="fa fa-newspaper-o"></i>
                                            <span>{{ trans('menu.articles') }}</span></a></li>
                                @endif

                                @if (auth()->user()->checkSpPermission('sliders.index'))
                                    <li class="{{ Request::is('sliders') ? 'active' : '' }} "><a
                                            href="{{ url('/sliders') }}"><i class="fa fa-picture-o"></i>
                                            <span>{{ trans('menu.sliders') }}</span></a></li>
                                @endif


                                @if (auth()->user()->checkSpPermission('pages.index'))
                                    <li class="{{ Request::is('pages') ? 'active' : '' }} "><a
                                            href="{{ url('/pages') }}"><i class="fa fa-university"
                                                aria-hidden="true"></i>
                                            <span>{{ trans('menu.pages') }}</span></a></li>
                                @endif

                                @if (auth()->user()->checkSpPermission('identity.index'))
                                    <li class="{{ Request::is('identity') ? 'active' : '' }} "><a
                                            href="{{ url('/identity') }}"><i class="fa fa-cog"></i>
                                            <span>{{ trans('menu.identity') }}</span></a></li>
                                @endif


                            </ul>
                        </li>
                    @endif

                    @if (auth()->user()->checkSpPermission('datamaster.index'))
                        <li
                            class="{{ Request::is('standards') || Request::is('standarddetails') || Request::is('semesterperiods') || Request::is('academicyears') ? 'active' : '' }} treeview">
                            <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Data Master') }}</span><span
                                    class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
                            <ul class="treeview-menu">
                                @if (auth()->user()->checkSpPermission('standards.index'))
                                    <li class="{{ Request::is('standards') ? 'active' : '' }} ">
                                        <a href="{{ url('/standards') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Standar') }}</span></a>
                                    </li>
                                @endif
                                @if (auth()->user()->checkSpPermission('standarddetails.index'))
                                    <li class="{{ Request::is('standarddetails') ? 'active' : '' }} ">
                                        <a href="{{ url('/standarddetails') }}"><i class="fa fa-circle-o"></i>
                                            <span>{{ __('Standar Detail') }}</span></a>
                                    </li>
                                @endif

                                @if (auth()->user()->checkSpPermission('division.index'))
                                    <li class="{{ Request::is('division') ? 'active' : '' }} "><a
                                            href="{{ url('/division') }}"><i class="fa fa-cog"></i>
                                            <span>{{ trans('menu.division') }}</span></a></li>
                                @endif

                                @if (auth()->user()->checkSpPermission('period.index'))
                                    <li class="{{ Request::is('period') ? 'active' : '' }} "><a
                                            href="{{ url('/period') }}"><i class="fa fa-calendar"></i>
                                            <span>{{ trans('menu.period') }}</span></a></li>
                                @endif


                            </ul>
                        </li>
                    @endif

                    @if (auth()->user()->checkSpPermission('employees.index'))
                        <li class="{{ Request::is('employees') ? 'active' : '' }}"><a
                                href="{{ url('/employees') }}"><i class="fa fa-user"></i>
                                <span>{{ trans('menu.employees') }}</span></a></li>
                    @endif

                    @if (Auth::user()->checkSpPermission('flexiblepossetting.create'))
                        <li class="{{ Request::is('flexiblepossetting/create') ? 'active' : '' }}"><a
                                href="{{ route('flexiblepossetting.create') }}"><i class="fa fa-gear"></i>
                                <span>{{ __('Settings') }}</span></a></li>
                    @endif
                </ul>

                <!-- admin menu tutup -->



            <!-- pimpinan menu buka -->

            @elseif (Auth::user()->role == 'pimpinan')
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MENU UTAMA</li>

                    <li class=""><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                            <span>{{ trans('menu.dashboard') }}</span></a></li>

                    @if (auth()->user()->checkSpPermission('reportalls.index'))
                        <li class="{{ Request::is('reportalls') ? 'active' : '' }} "><a
                                href="{{ url('/reportalls') }}"><i class="fa fa-file"></i>
                                <span>{{ trans('menu.reportalls') }}</span></a></li>
                    @endif

                </ul>

                <!-- pimpinan menu tutup -->



            @else
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>

                    <li class=""><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
                            <span>{{ trans('menu.dashboard') }}</span></a></li>

                    @if (session('role') == 'auditor')



                        @if (auth()->user()->checkSpPermission('schedulingaudit.index'))
                            <li
                                class="{{ Request::is('schedules') || Request::is('members') ? 'active' : '' }} treeview">
                                <a href="#"><i class="fa fa-calendar"></i>
                                    <span>{{ __('Persiapan Audit') }}</span><span class="pull-right-container"><i
                                            class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">

                                    @if (auth()->user()->checkSpPermission('schedules.index'))
                                        <li class="{{ Request::is('schedules') ? 'active' : '' }} ">
                                            <a href="{{ url('/schedules') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Pengaturan Jadwal') }}</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif





                        @if (auth()->user()->checkSpPermission('audit.index'))
                            <li
                                class="{{ Request::is('documents') || Request::is('checklists') || Request::is('findings') ? 'active' : '' }} treeview">
                                <a href="#"><i class="fa fa-sitemap"></i>
                                    <span>{{ __('Pelaksanaan Audit') }}</span><span class="pull-right-container"><i
                                            class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">

                                    @if (auth()->user()->checkSpPermission('checklists.index'))
                                        <li class="{{ Request::is('checklists') ? 'active' : '' }} ">
                                            <a href="{{ url('/checklists') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Cheklist') }}</span></a>
                                        </li>
                                    @endif

                                    @if (auth()->user()->checkSpPermission('documents.index'))
                                        <li class="{{ Request::is('documents') ? 'active' : '' }} ">
                                            <a href="{{ url('/documents') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Dokumen') }}</span></a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->checkSpPermission('findings.index'))
                                        <li class="{{ Request::is('findings') ? 'active' : '' }} ">
                                            <a href="{{ url('/findings') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Temuan') }}</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif


                        @if (auth()->user()->checkSpPermission('audit.index'))
                            <li class="{{ Request::is('reports') ? 'active' : '' }} treeview">
                                <a href="#"><i class="fa fa-sitemap"></i>
                                    <span>{{ __('Penutupan Audit') }}</span><span class="pull-right-container"><i
                                            class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    @if (auth()->user()->checkSpPermission('reports.index'))
                                        <li class="{{ Request::is('reports') ? 'active' : '' }} ">
                                            <a href="{{ url('/reports') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Laporan Audit') }}</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif



                    @elseif(session('role') == 'auditee')

                        @if (auth()->user()->checkSpPermission('schedules.index'))
                            <li class="{{ Request::is('schedules') ? 'active' : '' }} ">
                                <a href="{{ url('/schedules') }}"><i class="fa fa-calendar-o"></i>
                                    <span>{{ __('Jadwal Audit') }}</span></a>
                            </li>
                        @endif

                        @if (auth()->user()->checkSpPermission('audit.index'))
                            <li
                                class="{{ Request::is('documents') || Request::is('checklists') || Request::is('findings') || Request::is('reports') || Request::is('uploaddocuments') ? 'active' : '' }} treeview">
                                <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Proses Audit') }}</span><span
                                        class="pull-right-container"><i
                                            class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    @if (auth()->user()->checkSpPermission('uploaddocuments.index'))
                                        <li class="{{ Request::is('uploaddocuments') ? 'active' : '' }} "><a
                                                href="{{ url('/uploaddocuments') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ trans('menu.uploaddocuments') }}</span></a></li>
                                    @endif
                                    @if (auth()->user()->checkSpPermission('checklists.index'))
                                        <li class="{{ Request::is('checklists') ? 'active' : '' }} ">
                                            <a href="{{ url('/checklists') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Cheklist') }}</span></a>
                                        </li>
                                    @endif

                                    @if (auth()->user()->checkSpPermission('findings.index'))
                                        <li class="{{ Request::is('findings') ? 'active' : '' }} ">
                                            <a href="{{ url('/findings') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Temuan') }}</span></a>
                                        </li>
                                    @endif

                                </ul>
                            </li>
                        @endif


                    @elseif(session('role') == 'anggota')




                        @if (auth()->user()->checkSpPermission('schedulingaudit.index'))
                            <li
                                class="{{ Request::is('schedules') || Request::is('members') ? 'active' : '' }} treeview">
                                <a href="#"><i class="fa fa-calendar"></i>
                                    <span>{{ __('Persiapan Audit') }}</span><span class="pull-right-container"><i
                                            class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">

                                    @if (auth()->user()->checkSpPermission('schedules.index'))
                                        <li class="{{ Request::is('schedules') ? 'active' : '' }} ">
                                            <a href="{{ url('/schedules') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Pengaturan Jadwal') }}</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif





                        @if (auth()->user()->checkSpPermission('audit.index'))
                            <li
                                class="{{ Request::is('documents') || Request::is('checklists') || Request::is('findings') ? 'active' : '' }} treeview">
                                <a href="#"><i class="fa fa-sitemap"></i>
                                    <span>{{ __('Pelaksanaan Audit') }}</span><span class="pull-right-container"><i
                                            class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">

                                    @if (auth()->user()->checkSpPermission('checklists.index'))
                                        <li class="{{ Request::is('checklists') ? 'active' : '' }} ">
                                            <a href="{{ url('/checklists') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Cheklist') }}</span></a>
                                        </li>
                                    @endif

                                    @if (auth()->user()->checkSpPermission('documents.index'))
                                        <li class="{{ Request::is('documents') ? 'active' : '' }} ">
                                            <a href="{{ url('/documents') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Dokumen') }}</span></a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->checkSpPermission('findings.index'))
                                        <li class="{{ Request::is('findings') ? 'active' : '' }} ">
                                            <a href="{{ url('/findings') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Daftar Temuan') }}</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif


                        @if (auth()->user()->checkSpPermission('audit.index'))
                            <li class="{{ Request::is('reports') ? 'active' : '' }} treeview">
                                <a href="#"><i class="fa fa-sitemap"></i>
                                    <span>{{ __('Penutupan Audit') }}</span><span class="pull-right-container"><i
                                            class="fa fa-angle-left pull-right"></i></span></a>
                                <ul class="treeview-menu">
                                    @if (auth()->user()->checkSpPermission('reports.index'))
                                        <li class="{{ Request::is('reports') ? 'active' : '' }} ">
                                            <a href="{{ url('/reports') }}"><i class="fa fa-circle-o"></i>
                                                <span>{{ __('Laporan Audit') }}</span></a>
                                        </li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif


                </ul>
            @endif
        </section>
    </aside>
@endif
