<nav x-data="{ open: false }" style="background-color: #ffffff; border-bottom: 1px solid #f3f4f6;">
    <!-- Primary Navigation Menu -->
    <div style="max-width: 80rem; margin-left: auto; margin-right: auto; padding-left: 1rem; padding-right: 1rem;">
        <div style="display: flex; justify-content: space-between; height: 4rem;">
            <div style="display: flex;">
                <!-- Logo -->
                <div style="flex-shrink: 0; display: flex; align-items: center;">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo style="display: block; height: 2.25rem; width: auto; fill: currentColor; color: #1f2937;" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div style="display: flex; margin-top: -1px; margin-bottom: -1px; margin-left: 2.5rem; gap: 2rem;">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div style="display: flex; align-items: center; margin-left: 1.5rem;">
                <x-dropdown allign="right" width="48">
                    <x-slot name="trigger">
                        <button style="display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; border: 1px solid transparent; font-size: 0.875rem; line-height: 1rem; font-weight: 500; border-radius: 0.375rem; color: #6b7280; background-color: #ffffff; outline: none; cursor: pointer; transition: all 150ms ease-in-out;">
                            <div>{{ Auth::user()->name }}</div>

                            <div style="margin-left: 0.25rem;">
                                <svg style="fill: currentColor; height: 1rem; width: 1rem;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile Toggle) -->
            <div style="margin-right: -0.5rem; display: flex; align-items: center;">
                <button @click="open = ! open" style="display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem; border-radius: 0.375rem; color: #9ca3af; background: transparent; border: none; cursor: pointer; transition: all 150ms ease-in-out;">
                    <svg style="height: 1.5rem; width: 1.5rem;" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" style="display: inline-flex;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" style="display: none;" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" style="display: none;">
        <div style="padding-top: 0.5rem; padding-bottom: 0.75rem; display: flex; flex-direction: column; gap: 0.25rem;">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div style="padding-top: 1rem; padding-bottom: 0.25rem; border-top: 1px solid #e5e7eb;">
            <div style="padding-left: 1rem; padding-right: 1rem;">
                <div style="font-weight: 500; font-size: 1rem; color: #1f2937;">{{ Auth::user()->name }}</div>
                <div style="font-weight: 500; font-size: 0.875rem; color: #6b7280;">{{ Auth::user()->email }}</div>
            </div>

            <div style="margin-top: 0.75rem; display: flex; flex-direction: column; gap: 0.25rem;">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
