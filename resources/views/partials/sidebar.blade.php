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




         <li class="{{ Request::is('surat-masuk') ? 'active' : '' }}"><a
            href="{{ url('/surat-masuk') }}"><i class="fa fa-envelope"></i>
            <span>Surat Masuk</span></a>
         </li>


         <li class="{{ Request::is('surat-keluar') ? 'active' : '' }}"><a
            href="{{ url('/surat-keluar') }}"><i class="fa fa-envelope-o"></i>
            <span>Surat Keluar</span></a>
         </li>

         <li class="{{ Request::is('pelaporan-eoffice') ? 'active' : '' }}"><a
            href="{{ url('/pelaporan-eoffice') }}"><i class="fa fa-file"></i>
            <span>Pelaporan</span></a>
         </li>

         <li class="{{ Request::is('repositori-eoffice') ? 'active' : '' }}"><a
            href="{{ url('/repositori-eoffice') }}"><i class="fa fa-database"></i>
            <span>Repositori</span></a>
         </li>

            <!-- admin menu buka -->
            @if (Auth::user()->role == 'Admin')

         <li
            class="{{ Request::is('unit-kerja') || Request::is('jabatan') || Request::is('pegawai') || Request::is('akun') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-cog"></i> <span>Pengaturan Pegawai</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>

            <ul class="treeview-menu">
               <li class="{{ Request::is('unit-kerja') ? 'active' : '' }} ">
                  <a href="{{ url('/unit-kerja') }}"><i class="fa fa-building-o" aria-hidden="true"></i>
                  <span>Unit Kerja</span></a>
               </li>
               <li class="{{ Request::is('jabatan') ? 'active' : '' }} ">
                  <a href="{{ url('/jabatan') }}"><i class="fa fa-star-o" aria-hidden="true"></i>
                  <span>Jabatan</span></a>
               </li>
               <li class="{{ Request::is('pegawai') ? 'active' : '' }} "><a
                  href="{{ url('/pegawai') }}"><i class="fa fa-user" aria-hidden="true"></i>
                  <span>Pegawai</span></a>
               </li>
            </ul>
         </li>

         <li
            class="{{ Request::is('jenis-surat') || Request::is('sifat-surat') || Request::is('prioritas-surat') || Request::is('media-surat') || Request::is('perintah-disposisi') ? 'active' : '' }} treeview">
            <a href="#"><i class="fa fa-cog"></i> <span>Pengaturan</span><span
               class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>

            <ul class="treeview-menu">
               <li class="{{ Request::is('jenis-surat') ? 'active' : '' }} ">
                  <a href="{{ url('/jenis-surat') }}"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                  <span>Jenis Surat</span></a>
               </li>
<!--                <li class="{{ Request::is('sifat-surat') ? 'active' : '' }} ">
                  <a href="{{ url('/sifat-surat') }}"><i class="fa fa-question-circle-o" aria-hidden="true"></i>
                  <span>Sifat Surat</span></a>
               </li>
               <li class="{{ Request::is('prioritas-surat') ? 'active' : '' }} "><a
                  href="{{ url('/prioritas-surat') }}"><i class="fa fa-clock-o" aria-hidden="true"></i>
                  <span>Prioritas Surat</span></a>
               </li> -->
               <li class="{{ Request::is('media-surat') ? 'active' : '' }} "><a
                  href="{{ url('/media-surat') }}"><i class="fa fa-paperclip" aria-hidden="true"></i>
                  <span>Media Surat</span></a>
               </li>
<!--                <li class="{{ Request::is('perintah-disposisi') ? 'active' : '' }} "><a
                  href="{{ url('/perintah-disposisi') }}"><i class="fa fa-bullhorn" aria-hidden="true"></i>
                  <span>Perintah Disposisi</span></a>
               </li> -->
            </ul>
         </li>
         <li class="{{ Request::is('employees') ? 'active' : '' }}"><a
            href="{{ url('/employees') }}"><i class="fa fa-user"></i>
            <span>{{ trans('menu.employees') }}</span></a>
         </li>

@endif

         <li class="{{ Request::is('logout') ? 'active' : '' }}"><a
            href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i>
            <span>Logout</span></a>
         </li>


      </ul>
      <!-- admin menu tutup -->
   </section>
</aside>
@endif