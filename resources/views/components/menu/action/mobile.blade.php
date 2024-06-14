<button x-on:click="$store.mobileMenu.toggle()" class="p-2 text-slate-900 dark:text-slate-100 md:hidden">
    <svg x-show="!$store.mobileMenu.mobile" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
    </svg>
    <svg x-show="$store.mobileMenu.mobile" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
        viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
    </svg>
</button>
@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            Alpine.store('mobileMenu', {
                mobile: false,
                toggle() {
                    this.mobile = !this.mobile 
                }
            })
        })
    </script>
@endpush
