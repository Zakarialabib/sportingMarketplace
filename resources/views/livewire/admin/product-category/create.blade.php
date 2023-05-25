<div>
    <!-- Create Modal -->
    <x-modal wire:model="createModal">
        <x-slot name="title">
            {{ __('Create Category') }}
        </x-slot>

        <x-slot name="content">
            <!-- Validation Errors -->
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form wire:submit.prevent="create">
                <div class="grid grid-cols-2 gap-2">
                    <div class="w-full">
                        <x-label for="name" :value="__('Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name"
                            wire:model.lazy="category.name" />
                        <x-input-error :messages="$errors->get('category.name')" for="category.name" class="mt-2" />
                    </div>
                    <div class="w-full">
                        <x-label for="category_id" :value="__('Category')" required />
                        <select
                            class="block mt-1 bg-white text-gray-700 rounded border border-gray-300 mb-1 text-sm w-full focus:shadow-outline-blue focus:border-blue-500"
                            id="category_id" name="category_id" wire:model="category.category_id">
                            <option value="" disabled>{{ __('Select Category') }}</option>
                            @foreach ($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            <x-input-error :messages="$errors->get('category.category_id')" for="category.category_id" class="mt-2" />
                        </select>
                    </div>
                </div>

                <div class="w-full">
                    <x-label for="description" :value="__('Description')" />
                    <x-input id="description" class="block mt-1 w-full" type="text" name="description"
                        wire:model.lazy="category.description" />
                    <x-input-error :messages="$errors->get('category.description')" for="category.description" class="mt-2" />
                </div>

                <div class="w-full my-2">
                    <x-label for="image" :value="__('RaceLocation Image')" />
                    <x-media-upload title="{{ __('RaceLocation Image') }}" name="image" wire:model="image"
                        :file="$image" single types="PNG / JPEG / WEBP" fileTypes="image/*" />
                </div>

                <div class="w-full">
                    <x-button primary type="submit" wire:loading.attr="disabled" class="w-full">
                        {{ __('Create') }}
                    </x-button>
                </div>
            </form>
        </x-slot>
    </x-modal>
    <!-- End Create Modal -->
</div>
