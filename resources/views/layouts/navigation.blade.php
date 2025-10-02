<nav x-data="{ open: false }" class="bg-stone-800 border-b border-stone-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-stone-100 text-xl font-bold">
                        ระบบสมาชิก
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @auth
                        @if(auth()->user()->isAdmin())
                            <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.*')" class="text-stone-300">
                                จัดการผู้ใช้ทั้งหมด
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->canManageStaff())
                            <x-nav-link :href="route('manager.staff.index')" :active="request()->routeIs('manager.*')" class="text-stone-300">
                                จัดการ Staff
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->canApproveMembers())
                            <x-nav-link :href="route('staff.members.index')" :active="request()->routeIs('staff.*')" class="text-stone-300">
                                จัดการสมาชิก
                            </x-nav-link>
                        @endif

                        @if(auth()->user()->isMember())
                            <x-nav-link :href="route('member.profile.index')" :active="request()->routeIs('member.*')" class="text-stone-300">
                                โปรไฟล์ของฉัน
                            </x-nav-link>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-stone-300 bg-stone-800 hover:text-stone-100 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="px-4 py-2 text-xs text-stone-500 border-b border-stone-200">
                                <div class="font-medium">บทบาท: <span class="font-bold text-stone-700">{{ ucfirst(Auth::user()->role) }}</span></div>
                                <div class="font-medium">สถานะ: <span class="font-bold {{ Auth::user()->isApproved() ? 'text-green-600' : 'text-yellow-600' }}">{{ Auth::user()->status }}</span></div>
                            </div>

                            <x-dropdown-link :href="route('member.profile.index')">
                                โปรไฟล์
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    ออกจากระบบ
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-stone-400 hover:text-stone-300 hover:bg-stone-700 focus:outline-none focus:bg-stone-700 focus:text-stone-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
                @if(auth()->user()->isAdmin())
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.*')">
                        จัดการผู้ใช้ทั้งหมด
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->canManageStaff())
                    <x-responsive-nav-link :href="route('manager.staff.index')" :active="request()->routeIs('manager.*')">
                        จัดการ Staff
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->canApproveMembers())
                    <x-responsive-nav-link :href="route('staff.members.index')" :active="request()->routeIs('staff.*')">
                        จัดการสมาชิก
                    </x-responsive-nav-link>
                @endif

                @if(auth()->user()->isMember())
                    <x-responsive-nav-link :href="route('member.profile.index')" :active="request()->routeIs('member.*')">
                        โปรไฟล์ของฉัน
                    </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-stone-600">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-stone-100">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-stone-400">{{ Auth::user()->email }}</div>
                    <div class="font-medium text-xs text-stone-500 mt-1">
                        บทบาท: <span class="font-bold text-stone-300">{{ ucfirst(Auth::user()->role) }}</span>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('member.profile.index')">
                        โปรไฟล์
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            ออกจากระบบ
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>