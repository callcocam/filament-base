 <div x-show="$store.mobileMenu.mobile"
     class="flex flex-col w-full bg-slate-50 dark:bg-slate-700 min-h-screen absolute mt-4 max-w-72"
     @click.away="$store.mobileMenu.mobile = false" x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 transform -translate-x-full"
     x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 transform translate-x-0"
     x-transition:leave-end="opacity-0 transform -translate-x-full" x-cloak>
     <div class="flex flex-col ">
         <div class="bg-slate-100 dark:bg-slate-500 m-2 rounded-full p-2 flex flex-col justify-center">
             <div class="px-3">
                 <a href="/"
                     class="text-sm font-bold text-slate-900 dark:text-slate-100 leading-none flex items-center">

                     <div>
                         <span> {{ config('app.name') }}</span>
                         <p class="text-xs text-gray-500 dark:text-gray-300">
                             {{ config('app.tenant.email') }}
                         </p>
                     </div>
                 </a>
             </div>
         </div>
         @if ($menus)
             @foreach ($menus as $menu)
                 @if ($menu->getNavigationGroupItems())
                     <div x-data="dropdownMobile()" class="border-b border-slate-100 dark:border-slate-600">
                         <button type="button" x-on:click="toggle()"
                             class="bg-slate-100 dark:bg-slate-700 text-slate-800 dark:text-slate-50 uppercase w-full flex items-center justify-between px-3 border-l-2 border-l-transparent focus:border-l-slate-500 py-2">
                             <span>
                                 {{ $menu->getNavigationGroupLabel() }}
                             </span>
                             <x-heroicon-o-chevron-down class="w-5 h-5 ml-auto duration-200"
                                 x-bind:class="{ 'transform rotate-180': open }" />
                         </button>
                         <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-300"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-2"
                             class="w-full h-full inset-0 relative overflow-hidden shadow-md">
                             <div class="flex flex-col">
                                 @foreach ($menu->getNavigationGroupItems() as $items)
                                     @if (!$loop->first)
                                         <div
                                             class="border-t-2 border-t-slate-100 dark:border-t-slate-700 shadow-lg mb-2">
                                         </div>
                                     @endif
                                     @foreach ($items as $item)
                                         <x-menu.link.mobile :href="$item->route()" :active="request()->routeIs($item->getRouteIndex())" wire:navigate>
                                             {{ $item->getLabel() }}
                                         </x-menu.link.mobile>
                                     @endforeach
                                 @endforeach
                             </div>
                         </div>
                     </div>
                 @else
                     @if ($item = $menu->getNavigationGroupItem())
                         <x-menu.link.mobile :href="$item->route()" :active="request()->routeIs($item->getRouteIndex())" wire:navigate>
                             {{ $item->getLabel() }}
                         </x-menu.link.mobile>
                     @endif
                 @endif
             @endforeach
         @endif
         <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
             @auth
                 <div class="px-4">
                     <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}"
                         x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                     <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
                 </div>

                 <div class="mt-3 space-y-1">
                     <x-menu.link.mobile :href="route('profile')" wire:navigate>
                         <div class="flex items-center space-x-1">
                             <x-heroicon-o-user-circle class="h-4 w-4 text-gray-400" />
                             <span> {{ __('Profile') }} </span>
                         </div>
                     </x-menu.link.mobile> 
                     <!-- Authentication -->
                     <button wire:click="logout" class="w-full text-start">
                         <x-menu.link.mobile>
                             <div class="flex items-center space-x-1">
                                 <x-heroicon-o-arrow-right-start-on-rectangle class="h-4 w-4 text-gray-400" />
                                 <span> {{ __('Log Out') }} </span>
                             </div>
                         </x-menu.link.mobile>
                     </button>
                 </div>
             @else
                 <x-menu.link.mobile :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                     <div class="flex items-center w-full justify-between">
                         <span> {{ __('Login') }}</span>
                         <x-heroicon-o-arrow-right-on-rectangle class="h-5 w-5 text-gray-400" />
                     </div>
                 </x-menu.link.mobile>
                 <x-menu.link.mobile :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                     <div class="flex items-center w-full justify-between">
                         <span>{{ __('Register') }}</span>
                         <x-heroicon-o-plus-circle class="h-5 w-5 text-gray-400" />
                     </div>
                 </x-menu.link.mobile>
             @endauth
         </div>
     </div>
 </div>
 @push('scripts')
     <script>
         function dropdownMobile() {
             return {
                 open: false,
                 toggle() {
                     this.open = !this.open
                 }, 
             }
         } 
     </script>
 @endpush
