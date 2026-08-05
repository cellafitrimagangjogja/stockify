@php
    $url = explode('/', request()->url());
    $page_slug = $url[count($url) - 2];
@endphp

<aside id="sidebar" class="fixed top-0 left-0 z-20 flex flex-col flex-shrink-0 hidden w-64 h-full pt-16 font-normal duration-75 lg:flex transition-width" aria-label="Sidebar">
  <div class="relative flex flex-col flex-1 min-h-0 pt-0 bg-white border-r border-gray-200">
    <div class="flex flex-col flex-1 pt-5 pb-4 overflow-y-auto">
      <div class="flex-1 px-3 space-y-1 bg-white divide-y divide-gray-200">
        <ul class="pb-2 space-y-2">
          
          <li>
            <a href="{{ route('dashboard.admin') }}" class="flex items-center p-2 text-base text-green-900 rounded-lg hover:bg-green-100 group">
              <svg class="w-6 h-6 text-green-800 transition duration-75 group-hover:text-green-1000" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path><path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path></svg>
              <span class="ml-3" sidebar-toggle-item>Dashboard Admin</span>
            </a>
          </li>
          <li>
            <button type="button"
                class="flex items-center w-full p-2 text-base text-green-900 transition duration-75 rounded-lg group hover:bg-green-100"
                aria-controls="dropdown-product"
                data-collapse-toggle="dropdown-product">

                <svg class="flex-shrink-0 w-6 h-6 text-green-800 transition duration-75 group-hover:text-green-800"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                </svg>

                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>
                    Product
                </span>

                <svg sidebar-toggle-item class="w-6 h-6"
                    fill="currentColor"
                    viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"/>
                </svg>
            </button>

            <ul id="dropdown-product"
                class="space-y-2 py-2
                {{ Request::is('admin/products*') ||
                   Request::is('admin/categories*') ||
                   Request::is('admin/suppliers*')
                   ? 'block' 
                   : 'hidden' }}">
                <li>
                  <a href="{{ route('admin.products.index') }}"
                    class="flex items-center w-full p-2 pl-11 text-green-900 hover:bg-green-100">
                      Data Product
                  </a>
              </li>

              <li>
                  <a href="{{ route('admin.categories.index') }}"
                    class="flex items-center w-full p-2 pl-11 text-green-900 hover:bg-green-100">
                      Category
                  </a>
              </li>

              <li>
                  <a href="{{ route('admin.suppliers.index') }}"
                    class="flex items-center w-full p-2 pl-11 text-green-900 hover:bg-green-100">
                      Supplier
                  </a>
              </li>

            </ul>
        </li>
          <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-green-900 transition duration-75 rounded-lg group hover:bg-green-100"
              aria-controls="dropdown-stock" data-collapse-toggle="dropdown-stock">
              <svg class="flex-shrink-0 w-6 h-6 text-green-900 transition duration-75 group-hover:text-green-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path clip-rule="evenodd" fill-rule="evenodd" d="M.99 5.24A2.25 2.25 0 013.25 3h13.5A2.25 2.25 0 0119 5.25l.01 9.5A2.25 2.25 0 0116.76 17H3.26A2.267 2.267 0 011 14.74l-.01-9.5zm8.26 9.52v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.615c0 .414.336.75.75.75h5.373a.75.75 0 00.627-.74zm1.5 0a.75.75 0 00.627.74h5.373a.75.75 0 00.75-.75v-.615a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625zm6.75-3.63v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75v.625c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75zM17.5 7.5v-.625a.75.75 0 00-.75-.75H11.5a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75h5.25a.75.75 0 00.75-.75zm-8.25 0v-.625a.75.75 0 00-.75-.75H3.25a.75.75 0 00-.75.75V7.5c0 .414.336.75.75.75H8.5a.75.75 0 00.75-.75z"></path>
              </svg>
              <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Stock</span>
              <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
              </svg>
            </button>
            <ul id="dropdown-stock"
                class="space-y-2 py-2
                {{ Request::routeIs('admin.riwayat-transaksi.index*') ||
                   Request::routeIs('admin.stockopname.index*')
                   ? 'block' 
                   : 'hidden' }}">
              <li>
                  <a href="{{ route('admin.riwayat-transaksi.index') }}"
                    class="flex items-center w-full p-2 pl-11 text-green-900 hover:bg-green-100">
                      Riwayat Transaksi
                  </a>
              </li>

              <li>
                  <a href="{{ route('admin.stockopname.index') }}"
                    class="flex items-center w-full p-2 pl-11 text-green-900 hover:bg-green-100">
                      Stock Opname
                  </a>
              </li>
            </ul>
          </li>
          <li>
            <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-base text-green-900 rounded-lg hover:bg-gray-100 group {{ $page_slug == 'pengguna' ? 'bg-gray-100' : '' }}">
              <svg class="w-6 h-6 text-green-900 transition duration-75 group-hover:text-green-900"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                  xmlns="http://www.w3.org/2000/svg"
                  aria-hidden="true">
                  <path fill-rule="evenodd"
                      d="M10 2a4 4 0 100 8 4 4 0 000-8zM4 16a6 6 0 1112 0H4z"
                      clip-rule="evenodd">
                  </path>
              </svg>
              <span class="ml-3" sidebar-toggle-item>Pengguna</span>
          </a>
          </li>
          <li>
            <button type="button" class="flex items-center w-full p-2 text-base text-green-900 transition duration-75 rounded-lg group hover:bg-green-100" aria-controls="dropdown-laporan" data-collapse-toggle="dropdown-laporan">
                <svg class="flex-shrink-0 w-6 h-6 text-green-900 transition duration-75 group-hover:text-green-900" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd"></path></svg>
                <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>Laporan</span>
                <svg sidebar-toggle-item class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
            <ul id="dropdown-laporan"
                class="space-y-2 py-2
                {{ Request::routeIs('admin.laporan.stok*') ||
                   Request::routeIs('admin.laporan.transaksi*') ||
                   Request::routeIs('admin.laporan.aktivitas*')
                   ? 'block' 
                   : 'hidden' }}">
              <li>
                <a href="{{ route('admin.laporan.stok') }}" 
                class="flex items-center p-2 text-base text-green-900 transition duration-75 rounded-lg pl-11 group hover:bg-green-100">
                Laporan Stok</a>
              </li>
              <li>
                <a href="{{ route('admin.laporan.transaksi') }}" 
                class="flex items-center p-2 text-base text-green-900 transition duration-75 rounded-lg pl-11 group hover:bg-green-100">
                Transaksi</a>
              </li>
              <li>
                <a href="{{ route('admin.laporan.aktivitas') }}" 
                class="flex items-center p-2 text-base text-green-900 transition duration-75 rounded-lg pl-11 group hover:bg-green-100">
                Aktivitas</a>
              </li>
            </ul>
          </li>
          <li>
            <a href="{{ route('admin.pengaturan.index') }}"
              class="flex items-center p-2 text-base text-green-900 rounded-lg hover:bg-green-100 group {{ $page_slug == 'settings' ? 'bg-gray-100' : '' }}">
            <svg class="w-6 h-6 text-green-900 transition duration-75 group-hover:text-green-900"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 24 24">

                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M10.7 3h2.6a1 1 0 0 1 1 .8l.3 1.5c.5.1 1 .3 1.4.6l1.3-.8a1 1 0 0 1 1.3.1l1 .9a1 1 0 0 1 .1 1.3l-.8 1.3c.2.4.4.9.6 1.4l1.5.3a1 1 0 0 1 .8 1v1.4a1 1 0 0 1-.8 1l-1.5.3c-.2.5-.4 1-.6 1.4l.8 1.3a1 1 0 0 1-.1 1.3l-1 .9a1 1 0 0 1-1.3.1l-1.3-.8c-.4.3-.9.5-1.4.6l-.3 1.5a1 1 0 0 1-1 .8h-2.6a1 1 0 0 1-1-.8l-.3-1.5c-.5-.1-1-.3-1.4-.6l-1.3.8a1 1 0 0 1-1.3-.1l-1-.9a1 1 0 0 1-.1-1.3l.8-1.3c-.2-.4-.4-.9-.6-1.4l-1.5-.3a1 1 0 0 1-.8-1v-1.4a1 1 0 0 1 .8-1l1.5-.3c.2-.5.4-1 .6-1.4l-.8-1.3a1 1 0 0 1 .1-1.3l1-.9a1 1 0 0 1 1.3-.1l1.3.8c.4-.3.9-.5 1.4-.6l.3-1.5a1 1 0 0 1 1-.8Z" />

                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M14.5 12a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0Z" />

            </svg>

            <span class="ml-3" sidebar-toggle-item>
                Pengaturan
            </span>

            </a>
          </li>
  </div>
</aside>

<div class="fixed inset-0 z-10 hidden bg-gray-900/50" id="sidebarBackdrop"></div>
