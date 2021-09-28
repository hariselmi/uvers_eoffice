@if (Auth::check())
<aside class="main-sidebar">
   <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <!-- admin menu buka -->
      <ul class="sidebar-menu" data-widget="tree">
         <li class="header">MENU UTAMA</li>
         <li class=""><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>
            <span>{{ trans('menu.dashboard') }}</span></a>
         </li>
         <li
            class="{{ Request::is('documents') || Request::is('schedules') || Request::is('members') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-calendar"></i> <span>{{ __('Persiapan Audit') }}</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
               <li class="{{ Request::is('members') ? 'active' : '' }} ">
                  <a href="{{ url('/members') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ trans('menu.members') }}</span></a>
               </li>
               <li class="{{ Request::is('schedules') ? 'active' : '' }} ">
                  <a href="{{ url('/schedules') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ trans('menu.schedules') }}</span></a>
               </li>
               <li class="{{ Request::is('documents') ? 'active' : '' }} ">
                  <a href="{{ url('/documents') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ __('Daftar Dokumen') }}</span></a>
               </li>
            </ul>
         </li>
         <li
            class="{{ Request::is('checklists') || Request::is('findings') || Request::is('reports') || Request::is('uploaddocuments') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Pelaksanaan Audit') }}</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
               <li class="{{ Request::is('checklists') ? 'active' : '' }} ">
                  <a href="{{ url('/checklists') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ __('Daftar Cheklist') }}</span></a>
               </li>
               <li class="{{ Request::is('uploaddocuments') ? 'active' : '' }} "><a
                  href="{{ url('/uploaddocuments') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ trans('menu.uploaddocuments') }}</span></a>
               </li>
               <li class="{{ Request::is('findings') ? 'active' : '' }} ">
                  <a href="{{ url('/findings') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ __('Daftar Temuan') }}</span></a>
               </li>
            </ul>
         </li>
         <li
            class="{{ Request::is('checklists') || Request::is('findings') || Request::is('reports') || Request::is('uploaddocuments') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Penutupan Audit') }}</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
               <li class="{{ Request::is('reports') ? 'active' : '' }} ">
                  <a href="{{ url('/reports') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ __('Laporan Audit') }}</span></a>
               </li>
            </ul>
         </li>
         <li class="{{ Request::is('reportalls') ? 'active' : '' }} "><a
            href="{{ url('/reportalls') }}"><i class="fa fa-file"></i>
            <span>{{ trans('menu.reportalls') }}</span></a>
         </li>
         <li
            class="{{ Request::is('agenda') || Request::is('verification') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-sitemap"></i> <span>{{ __('Rapat Tinjauan Manajemen') }}</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
               <li class="{{ Request::is('agenda') ? 'active' : '' }} ">
                  <a href="{{ url('/agenda') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ __('Berita Acara') }}</span></a>
               </li>
               <li class="{{ Request::is('verification') ? 'active' : '' }} ">
                  <a href="{{ url('/verification') }}"><i class="fa fa-circle-o"></i>
                  <span>{{ __('Verifikasi Tindak Lanjut') }}</span></a>
               </li>
            </ul>
         </li>
         <li
            class="{{ Request::is('articles') || Request::is('sliders') || Request::is('pages') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-cog"></i> <span>{{ __('Website') }}</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
            <ul class="treeview-menu">
               <li class="{{ Request::is('articles') ? 'active' : '' }} "><a
                  href="{{ url('/articles') }}"><i class="fa fa-newspaper-o"></i>
                  <span>{{ trans('menu.articles') }}</span></a>
               </li>
               <li class="{{ Request::is('sliders') ? 'active' : '' }} "><a
                  href="{{ url('/sliders') }}"><i class="fa fa-picture-o"></i>
                  <span>{{ trans('menu.sliders') }}</span></a>
               </li>
               <li class="{{ Request::is('pages') ? 'active' : '' }} "><a
                  href="{{ url('/pages') }}"><i class="fa fa-university"
                  aria-hidden="true"></i>
                  <span>{{ trans('menu.pages') }}</span></a>
               </li>
               <li class="{{ Request::is('identity') ? 'active' : '' }} "><a
                  href="{{ url('/identity') }}"><i class="fa fa-cog"></i>
                  <span>{{ trans('menu.identity') }}</span></a>
               </li>
            </ul>
         </li>
         <li
            class="{{ Request::is('standards') || Request::is('standarddetails') || Request::is('semesterperiods') || Request::is('academicyears') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-cog"></i> <span>Pengaturan</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>

            <ul class="treeview-menu">
               <li class="{{ Request::is('standards') ? 'active' : '' }} ">
                  <a href="{{ url('/standards') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                  <span>Jenis Surat</span></a>
               </li>
               <li class="{{ Request::is('standarddetails') ? 'active' : '' }} ">
                  <a href="{{ url('/standarddetails') }}"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
                  <span>Sifat Surat</span></a>
               </li>
               <li class="{{ Request::is('division') ? 'active' : '' }} "><a
                  href="{{ url('/division') }}"><i class="fa fa-clock-o" aria-hidden="true"></i>
                  <span>Prioritas Surat</span></a>
               </li>
               <li class="{{ Request::is('period') ? 'active' : '' }} "><a
                  href="{{ url('/period') }}"><i class="fa fa-paperclip" aria-hidden="true"></i>
                  <span>Media Surat</span></a>
               </li>
               <li class="{{ Request::is('period') ? 'active' : '' }} "><a
                  href="{{ url('/period') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i>
                  <span>Perintah Disposisi</span></a>
               </li>
            </ul>
         </li>
         <li class="{{ Request::is('employees') ? 'active' : '' }}"><a
            href="{{ url('/employees') }}"><i class="fa fa-user"></i>
            <span>{{ trans('menu.employees') }}</span></a>
         </li>
      </ul>
      <!-- admin menu tutup -->
   </section>
</aside>
@endif