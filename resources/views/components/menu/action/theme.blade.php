@props(['visible' => true])
<button 
@class(['p-2 text-slate-900 dark:text-slate-100', 'visible' => $visible, 'invisible' => !$visible])
x-on:click="$store.darkMode.toggle()">
    <x-heroicon-o-moon x-show="$store.darkMode.dark" class="h-5 w-5 text-white" />
    <x-heroicon-o-sun x-show="!$store.darkMode.dark" class="h-6 w-6 text-black" />
</button>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Alpine.store('darkMode', {
                dark: false,
                toggle() {
                    this.dark = !this.dark
                    document.documentElement.classList.toggle('dark', this.dark)
                    localStorage.setItem('_x_darkMode_on', this.dark)
                },
                init() {
                    this.dark = localStorage.getItem('_x_darkMode_on') === 'true'
                    document.documentElement.classList.toggle('dark', this.dark)
                }
            })
        })
    </script>
@endpush
