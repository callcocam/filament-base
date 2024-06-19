<?php

use Livewire\Volt\Component;

use Symfony\Component\Finder\Finder;
use App\Livewire\Page\Navigation\NavigationItem;
use App\Livewire\Page\Navigation\Navigation;
use Livewire\Attributes\Computed;

new class extends Component {}; ?>
<div class="flex flex-col items-center bg-slate-50 dark:bg-slate-800 shadow-lg"> 
    <livewire:layout.navigation-top />
    <header class="w-full md:max-w-7xl mx-auto">
        <div class="flex items-center justify-between h-full  mx-auto relative ">
            <div class="w-full">
                <div class="md:flex">
                    <livewire:layout.sidebar.desktop/> 
                    <livewire:layout.sidebar.mobile />
                </div>
            </div>
            <div class="flex px-4 items-center space-x-1">
                <div class="flex md:hidden">
                    <x-menu.action.theme />
                </div>
                <x-menu.action.mobile />
            </div>
        </div>
    </header>
</div>
