<nav class="fixed z-50 w-full bg-white dark:bg-gray-800 border-b dark:border-gray-700">
  <div class="px-3 py-3 lg:px-5 lg:pl-3">
    <div class="flex items-center justify-between">
      <div class="flex items-center justify-start">
        <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 text-gray-600 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 focus:ring-2 focus:ring-gray-100">
          <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
          <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
        </button>
        <a href="{{ url('/') }}" class="flex ml-2 md:mr-24">

            @if($setting && $setting->logo)
                <img
                    src="{{ asset('storage/' . $setting->logo) }}"
                    class="h-8 mr-3"
                    alt="{{ $setting->app_name }}"
                >
            @else
                <img
                    src="{{ asset('static/images/logo.svg') }}"
                    class="h-8 mr-1"
                    alt="Stockify Logo">
            @endif

            <span class="self-center text-xl text-green-900 font-extrabold sm:text-2xl whitespace-nowrap text-green-800">
                {{ $setting->app_name ?? 'Stockify' }}
            </span>

        </a>
        
      </div>
      <div class="flex items-center">
          
          <!-- Search mobile -->
          <button id="toggleSidebarMobileSearch" type="button" class="p-2 text-gray-500 rounded-lg lg:hidden hover:text-gray-900 hover:bg-gray-100">
            <span class="sr-only">Search</span>
            <!-- Search icon -->
            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
          </button>
         
          
          <!-- Profile -->
          <div class="flex items-center ml-3">
            <div class="flex items-center ml-3">
              <div>
                  <button
                      type="button"
                      class="flex items-center justify-center w-8 h-8 text-sm rounded-full focus:ring-4 focus:ring-gray-300 overflow-hidden"
                      id="user-menu-button-2"
                      aria-expanded="false"
                      data-dropdown-toggle="dropdown-2">
                      @if(auth()->user()->image)
                          <img
                              src="{{ asset('storage/profile/' . auth()->user()->image) }}"
                              alt="{{ auth()->user()->name }}"
                              class="w-8 h-8 object-cover"
                          >
                      @else
                          <span class="text-white font-semibold">
                              {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                          </span>
                      @endif
                  </button>
              </div>

              <!-- Dropdown menu -->
              <div
                  class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
                  id="dropdown-2">
                  <div class="px-4 py-3" role="none">
                      <p class="text-sm text-gray-900">
                          {{ auth()->user()->name }}
                      </p>

                      <p class="text-sm font-medium text-gray-900 truncate">
                          {{ auth()->user()->email }}
                      </p>
                  </div>
              <ul class="py-1" role="none">
                <li>
                    <a href="{{ route('profile.edit') }}"
                      class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                      role="menuitem">
                        Pengaturan Profil
                    </a>
                </li>
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="flex items-center w-full py-2 px-4 text-sm hover:bg-gray-100">
                                    Sign Out
                                </button>
                    </form>
                </li>
              </ul>
            </div>
          </div>
        </div>
    </div>
  </div>
</nav>