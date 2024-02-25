<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('backadmin/assets/images/zeta.jpg') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text" style="color: #02ba5a">Zeta<b style="color: #3d3d3d">Library</b></h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
            <li class="{{ Request::is('admin/dashboard*') ? 'mm-active' : '' }}">
                <a href="{{ route('admin.dashboard') }}">
                    <div class="parent-icon"><i class='bx bx-cookie'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endif

        @if (Auth::user()->role == 'user')
            <li class="{{ Request::is('admin/dashboard*') ? 'mm-active' : '' }}">
                <a href="{{ route('user.dashboard') }}">
                    <div class="parent-icon"><i class='bx user'></i>
                    </div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>
        @endif

        {{-- <li>
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class='bx bx-at'></i>
                    </div>
                    <div class="menu-title">Brand</div>
                </a>
                <ul>
                    <li> <a href="{{ route('brand.index') }}"><i class="bx bx-radio-circle"></i>Semua Brand</a>
                    </li>
                    <li> <a href="{{ route('brand.create') }}"><i class="bx bx-radio-circle"></i>Tambah Brand</a>
                    </li>
                </ul>
            </li> --}}
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
            <li class="">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-book"></i>
                    </div>
                    <div class="menu-title">Buku</div>
                </a>
                <ul>
                    <li class="{{ Request::is('admin/buku') ? 'mm-active' : '' }}"> <a
                            href="{{ route('buku.index') }}"><i class="bx bx-radio-circle"></i>Semua Buku</a>
                    </li>
                    <li class=""> <a href="{{ route('buku.create') }}"><i class="bx bx-radio-circle"></i>Tambah
                            Buku</a>
                    </li>
                </ul>
            </li>
        @endif
        @if (Auth::user()->role == 'admin')
        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-user"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                <li class="{{ Request::is('admin/user') ? 'mm-active' : '' }}"> <a
                        href="{{ route('user.index') }}"><i class="bx bx-radio-circle"></i>Semua
                        Users</a>
                </li>
                
                <li class=""> <a href="{{ route('user.create') }}"><i
                            class="bx bx-radio-circle"></i>Tambah Users</a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->role == 'petugas')
        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Users</div>
            </a>
            <ul>
                <li class="{{ Request::is('admin/user') ? 'mm-active' : '' }}"> <a
                        href="{{ route('user.index') }}"><i class="bx bx-radio-circle"></i>Semua
                        Users</a>
                </li>
            </ul>
        </li>
        @endif
        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')
            <li class="">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-list-ol"></i>
                    </div>
                    <div class="menu-title">Pinjaman</div>
                </a>
                <ul>
                    <li class="{{ Request::is('admin/peminjaman') ? 'mm-active' : '' }}"> <a
                            href="{{ route('peminjaman.index') }}"><i class="bx bx-radio-circle"></i>Semua
                            Peminjaman</a>
                    </li>
                    <li class=""> <a href="{{ route('peminjaman.create') }}"><i
                                class="bx bx-radio-circle"></i>Tambah Data Pinjaman</a>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="javascript:;" class="has-arrow">
                    <div class="parent-icon"><i class="bx bx-category"></i>
                    </div>
                    <div class="menu-title">Kategori</div>
                </a>
                <ul>
                    <li class="{{ Request::is('admin/kategori') ? 'mm-active' : '' }}"> <a
                            href="{{ route('kategori.index') }}"><i class="bx bx-radio-circle"></i>Semua
                            Kategori</a>
                    </li>
                    <li class=""> <a href="{{ route('kategori.create') }}"><i
                                class="bx bx-radio-circle"></i>Tambah Kategori</a>
                    </li>
                </ul>
            </li>
        @endif

        @if (Auth::user()->role == 'user')
        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Pinjaman</div>
            </a>
            <ul>
                <li class=""> <a href="{{ route('peminjaman.create') }}"><i
                            class="bx bx-radio-circle"></i>Tambah Data Pinjaman</a>
                </li>
            </ul>
        </li>
        <li class="">
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-book"></i>
                </div>
                <div class="menu-title">List Pinjaman</div>
            </a>
            <ul>
                <li class=""> <a href="{{ route('list.index') }}"><i
                            class="bx bx-radio-circle"></i>List Buku Dipinjam</a>
                </li>
            </ul>
        </li>
    @endif

        <!--end navigation-->
</div>
