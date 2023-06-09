<div>
    @section('title', __('Races'))

    <section x-data="{ showSidebar: false }" class="relative table w-full bg-green-700 pt-16 px-4">
        <div class="grid grid-cols-1 text-center mt-10">
            <h3
                class="uppercase mb-4 text-2xl lg:text-5xl md:text-3xl sm:text-xl md:leading-normal leading-normal font-bold text-white cursor-pointer">
                {{ __('Races') }}
            </h3>
            <div class="text-center z-10 bottom-5 start-0 end-0 mx-3">
                <ul class="breadcrumb tracking-[0.5px] breadcrumb-light mb-0 inline-block">
                    <li
                        class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white/50 hover:text-green-200">
                        <a href="{{ route('front.index') }}">{{ __('Home') }}</a>
                        <span class="px-2 text-white"> > </span>
                    </li>
                    <li class="inline breadcrumb-item uppercase text-[13px] font-bold duration-500 ease-in-out text-white hover:text-green-200"
                        aria-current="page">
                        <a href="{{ URL::Current() }}">
                            {{ __('Races') }}
                        </a>
                    </li>
                </ul>
                <div
                    class="flex flex-wrap items-center py-5 text-white w-full sm:w-auto justify-center my-2 overflow-x-scroll">
                    <div
                        class="py-2 sm:px-3 flex flex-col justify-center gap-y-4 items-center font-heading font-medium">
                        <span>{{ __('Location') }}</span>
                        <select name="location_id" id="location_id" wire:model.lazy="raceLocation_id"
                            class="bg-transparent border border-gray-200 hover:border-gray-300 rounded-4xl">
                            <option value=""></option>
                            @foreach (Helpers::getActiveRaceLocations() as $location)
                                <option value="{{ $location->id }}">
                                    {{ $location->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="py-2 sm:px-3 flex flex-col justify-center gap-y-4 items-center font-heading font-medium">
                        <span>{{ __('Race Type') }}</span>
                        <select name="category_id" id="category_id" wire:model.lazy="category_id"
                            class="bg-transparent border border-gray-200 hover:border-gray-300 rounded-4xl">
                            <option value=""></option>
                            @foreach (Helpers::getActiveCategories() as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div
                        class="py-2 sm:px-3 flex flex-col justify-center gap-y-4 items-center font-heading font-medium">
                        <span>{{ __('Sorting') }}</span>
                        <select id="sortBy" wire:model.lazy="sorting"
                            class="bg-transparent border border-gray-200 hover:border-gray-300 rounded-4xl">
                            <option value=""></option>
                            @foreach ($sortingOptions as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" @click="showSidebar = true"
                        class="flex lg:hidden items-center justify-center w-12 h-12 duration-500 ease-in-out text-white hover:text-green-200">
                        <svg class="w-6 h-6" fill="none" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <section class="w-full" x-data="{ loading: false }">
        <div class="sm:flex sm:flex-wrap">
            @foreach ($races as $race)
                <div class="md:px-6 w-full px-10 py-6 drop-shadow-xl bg-gray-100">
                    <div class="xl:flex xl:items-center p-10 xl:pb-12 xl:px-14 xl:pt-16 bg-white rounded-3xl">
                        <div class="mb-8 xl:mb-0 xl:w-4/12 xl:pr-6">
                            <a href="{{ route('front.raceDetails', $race->slug) }}"
                                class="w-full flex items-center md:items-start relative h-full transition-all duration-300 group-hover:scale-110 group-hover:opacity-75"
                                style="background-image: url({{ $race->getFirstMediaUrl('local_files') }});background-size: cover;background-position: center;height:27rem">
                            </a>
                        </div>
                        <div class="xl:w-8/12 xl:block md:flex items-center">
                            <div class="xl:flex xl:justify-between xl:items-start mb-4 xl:mb-20 xl:w-full md:w-1/2">
                                <div class="xl:pr-3 mb-6 xl:mb-0 xl:w-8/12">
                                    <a href="{{ route('front.raceDetails', $race->slug) }}">
                                        <p class="mb-4 text-xl leading-8 font-heading font-medium hover:underline">
                                            {{ $race->name }}
                                        </p>
                                        <p class="text-darkBlueGray-400 py-4">
                                            {!! $race->description !!}
                                        </p>
                                        <p class="flex items-center">
                                            <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                                {{ __('Registration Deadline') }} :
                                            </span>
                                            <span
                                                class="text-base md:text-lg capitalize">{{ Helpers::format_date($race->registration_deadline) }}</span>
                                        </p>
                                        <p class="flex items-center">
                                            <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                                {{ __('Location') }} :
                                            </span>
                                            <span
                                                class="text-base md:text-lg capitalize">{{ $race->location->name }}</span>
                                        </p>
                                        <p class="flex items-center">
                                            <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                                {{ __('Type') }} :
                                            </span>
                                            <span
                                                class="text-base md:text-lg capitalize">{{ $race->category->name }}</span>
                                        </p>
                                        <p class="flex items-center">
                                            <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                                {{ __('Number of days') }} :
                                            </span>
                                            <span class="text-base md:text-lg capitalize">{{ $race->number_of_days }}
                                                {{ __('days') }}</span>
                                        </p>
                                        <p class="flex items-center">
                                            <span class="text-sm md:text-base font-medium text-gray-500 mr-2">
                                                {{ __('Number of racers') }} :
                                            </span>
                                            <span
                                                class="text-base md:text-lg capitalize">{{ $race->number_of_racers }}</span>
                                        </p>
                                    </a>
                                </div>
                                <p
                                    class="flex items-center xl:justify-end xl:pl-3 xl:w-4/12 text-xl text-blue-500 font-heading font-medium tracking-tighter">
                                    <span>{{ Helpers::format_currency($race->price) }}</span>
                                </p>
                            </div>
                            <div
                                class="flex xl:flex-row text-center items-center md:flex-col xl:w-full md:w-1/2 md:my-auto">
                                <div class="w-1/2 xl:w-1/3 lg:w-6/12 md:w-1/3 mx-auto mb-4">
                                    @if ($race->course)
                                        <ul class="flex items-center gap-4">
                                            @foreach ($race->course as $key => $course)
                                                <li class="text-sans inline-flex md:text-lg">
                                                    <span
                                                        class="text-lg uppercase px-[10px] py-[5px] tracking-widest whitespace-nowrap inline-block rounded-md bg-green-500 hover:bg-green-800 text-white">
                                                        {{ $course['name'] }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <div class="w-1/2 xl:w-1/3 lg::w-2/12 md:w-1/3 mx-auto">
                                    <i class="fas fa-calendar-alt mr-2"></i>
                                    {{ \Carbon\Carbon::parse($race->date)->format('F/d/Y') }}
                                </div>
                                <div class="mt-6 xl:mt-0 w-full xl:w-1/3 lg::w-4/12 md:w-1/3 mx-auto">
                                    <div class="lg:mx-auto xl:mr-0 lg:max-w-max">
                                        <a class="block py-4 px-10 w-full text-lg leading-5 text-white font-medium tracking-tighter font-heading text-center bg-blue-500 hover:bg-blue-600 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 rounded-xl"
                                            href="{{ route('front.raceDetails', $race->slug) }}">
                                            {{ __('Read More') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="flex justify-center mt-10" x-show="!loading && '{{ $races->hasMorePages() }}'">
            <div x-intersect="() => { $wire.loadMore(() => loading = false) }"
                x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform translate-y-10"
                x-transition:enter-end="opacity-100 transform translate-y-0">
                <div class="flex items-center justify-center text-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-blue-500" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4" fill="none"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647zM20 12a8 8 0 01-8 8v4c4.627 0 10-5.373 10-12h-4zm-2-5.291A7.962 7.962 0 0120 12h4c0-3.042-1.135-5.824-3-7.938l-3 2.647z">
                        </path>
                    </svg>
                    <span>{{ __('Loading...') }}</span>
                </div>
            </div>
        </div>
    </section>
</div>
