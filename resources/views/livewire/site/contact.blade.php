<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            <x-breadcrumbs :sub_title="$sub_title" :title="$title">
                <li>
                    <span
                        class=" text-primary-100 px-2 py-2 rounded-md text-sm flex space-x-2 items-center justify-center">
                        <x-heroicon-o-chevron-right class="h-4 w-4" />
                        <span> {{ __($sub_title) }}</span>
                    </span>
                </li>
            </x-breadcrumbs>
        </h2>
    </x-slot>
    <div class="px-6 py-6 sm:py-12 lg:px-8">
        <div class="absolute inset-x-0 top-[-10rem] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[-20rem]"
            aria-hidden="true">
            <div class="relative left-1/2 -z-10 aspect-[1155/678] w-[36.125rem] max-w-none -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-40rem)] sm:w-[72.1875rem]"
                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)">
            </div>
        </div>
        <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                {{ __('CONTACT_TITLE_PAGE') }}
            </h2>
            <p class="mt-2 text-lg leading-8 text-gray-600 dark:text-gray-50">
                {{ __('CONTACT_SUBTITLE_PAGE') }}
            </p>
        </div>
        <form class="mx-auto mt-12 max-w-xl sm:mt-14  shadow-lg p-8" wire:submit.prevent="send">
            <div class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">
                <div class="col-span-2">
                    <x-input-label for="name" :value="__('CONTACT_NAME_LABEL')" />
                    <x-text-input wire:model="form.name" id="name" class="block mt-1 w-full" type="text"
                        name="name" required autofocus autocomplete="name"
                        placeholder="{{ __('CONTACT_NAME_PLACEHOLDER') }}" />
                    <x-input-error :messages="$errors->get('form.name')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="email" :value="__('CONTACT_EMAIL_LABEL')" />
                    <x-text-input wire:model="form.email" id="email" class="block mt-1 w-full" type="email"
                        name="email" required autofocus autocomplete="username"
                        placeholder="{{ __('CONTACT_EMAIL_PLACEHOLDER') }}" />
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="message" :value="__('CONTACT_MESSAGE_LABEL')" />
                    <x-textarea-input wire:model="form.message" id="message" class="block mt-1 w-full" name="message" rows="6"
                        required placeholder="{{ __('CONTACT_MESSAGE_PLACEHOLDER') }}" />
                    <x-input-error :messages="$errors->get('form.message')" class="mt-2" />
                </div>
            </div>
            <div class="mt-10">
                <button type="submit"
                    class="block w-full rounded-md bg-indigo-600 px-3.5 py-2.5 text-center text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ __('CONTACT_SEND_BUTTON_LABEL') }}
                </button>
            </div>
        </form>
    </div>
</div>
