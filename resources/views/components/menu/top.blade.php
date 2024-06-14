<div class="flex w-full  bg-white dark:bg-gray-800 border-b border-slate-300 dark:border-slate-700">
    <div class="flex md:max-w-7xl mx-auto w-full">
        <div class="flex items-center justify-between w-full">
            <div class="hidden space-x-2 sm:-my-px sm:ms-10 sm:flex w-full  my-1">
                @auth
                    <span class="flex dark:text-gray-500 uppercase font-bold">
                        {{ auth()->user()->name }}
                    </span>
                    <span class="flex dark:text-gray-500">
                        {{ auth()->user()->email }}
                    </span>
                @endauth
            </div>
            <div class="flex items-center space-x-2 px-3 justify-end w-full  my-1">
                <div class="md:flex hidden">
                 <x-menu.action.theme />
                </div>
                @auth
                    <x-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                        <div class="flex items-center space-x-1">
                            <x-heroicon-o-user-circle class="h-4 w-4 text-gray-400" />
                            <span> {{ __('Profile') }} </span>
                        </div>
                    </x-nav-link>
                    <button wire:click="logout">
                        <x-nav-link>
                            <div class="flex items-center space-x-1">
                                <x-heroicon-o-arrow-right-start-on-rectangle class="h-4 w-4 text-gray-400" />
                                <span> {{ __('Log Out') }} </span>
                            </div>
                        </x-nav-link>
                    </button>
                @else
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                        <div class="flex items-center space-x-1">
                            <x-heroicon-o-arrow-left-start-on-rectangle class="h-4 w-4 text-gray-400" />
                            <span> {{ __('Login') }} </span>
                        </div>
                    </x-nav-link>
                    <x-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                        <div class="flex items-center space-x-1">
                            <x-heroicon-o-plus class="h-4 w-4 text-gray-400" />
                            <span> {{ __('Register') }} </span>
                        </div>
                    </x-nav-link>
                @endauth
            </div>
        </div>
    </div>
</div>
