<nav class="navbar"  id="navbar">
    <div class="container flex flex-wrap items-center justify-between">

        <div class="flex items-center">
            <a class="navbar-brand flex items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo_pemkab.png') }}" width="80px" class="inline-block dark:hidden" alt="Logo Pemkab">
                <img src="{{ asset('images/logo_pemkab.png') }}" class="hidden dark:inline-block" alt="Logo Pemkab">
                <div class="ml-3">
                    <div class="text-xl font-bold text-gray-800 ">SIMADE GIANYAR</div>
                    <div class="text-sm text-gray-600 ">Kabupaten Gianyar</div>
                </div>
            </a>
        </div>

        <div class="nav-icons flex items-center lg_992:order-2 ms-auto">

            <div class="hidden lg_992:flex items-center space-x-4">
                <a href="/admin" class="btn bg-orange-600 hover:bg-orange-700 text-white rounded-md px-5 py-2">Login</a>
                <a href="/admin/register" class="btn bg-orange-600/5 hover:bg-orange-600 border-orange-600/10 hover:border-orange-600 text-orange-600 hover:text-white rounded-md px-5 py-2">Register</a>
            </div>

           <button data-collapse="menu-collapse" type="button" class="collapse-btn inline-flex items-center ms-3 text-dark dark:text-dark lg_992:hidden" aria-controls="menu-collapse" aria-expanded="false">
                <span class="sr-only">Navigation Menu</span>

               <span class="mdi mdi-menu"></span>

            </button>
        </div>

        <div class="navigation lg_992:order-1 lg_992:flex hidden w-full" id="menu-collapse">

            <ul class="navbar-nav w-full">
                <li class="nav-item">
                    <a class="nav-link active" href="#home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tentang">Tentang Sistem</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tahapan">Tahapan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#formasi">Formasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">Kontak</a>
                </li>
            </ul>

            <div class="lg_992:hidden mt-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <a href="/admin" class="block w-full text-center btn bg-orange-600 hover:bg-orange-700 text-white rounded-md py-2 mb-3">Login</a>
                <a href="/admin/register" class="block w-full text-center btn bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-md py-2">Register</a>
            </div>

        </div>

    </div>
</nav>
