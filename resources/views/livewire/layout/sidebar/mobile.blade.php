<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>
<div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
    <div class="pt-2 pb-3 space-y-1">
        <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" wire:navigate>
            {{ __('Dashboard') }}
        </x-responsive-nav-link>
    </div>

    <!-- Responsive Settings Options -->
    <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
       @auth
       <div class="px-4">
        <div class="font-medium text-base text-gray-800 dark:text-gray-200" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
    </div>

    <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile')" wire:navigate>
            {{ __('Profile') }}
        </x-responsive-nav-link>

        <!-- Authentication -->
        <button wire:click="logout" class="w-full text-start">
            <x-responsive-nav-link>
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </button>
    </div>
    @else
    <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
        {{ __('Login') }}
    </x-responsive-nav-link>
    <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
        {{ __('Register') }}
    </x-responsive-nav-link>
    @endauth
    </div>
</div>