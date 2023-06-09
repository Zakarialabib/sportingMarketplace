<div>
    @section('title', __('Home'))

    <x-topheader />

    <div class="relative mx-auto">
        <section class="w-full mx-auto bg-gray-900 h-screen relative">
            <x-theme.slider :sliders="$this->sliders" />
        </section>
        <section class="lg:px-10 sm:px-6 lg:py-16 md:py-14">
            <h3
                class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tighter font-heading text-black cursor-pointer pb-10 text-center">
                {{ __('Upcoming Races') }}
            </h3>
            <div class="flex flex-wrap items-center mt-4 space-y-4">
                @forelse ($this->races as $race)
                    <div class="relative lg:w-1/2 sm:w-full px-4">
                        <x-race-card :race="$race" view="list" />
                    </div>
                @empty
                    <div class="w-full bg-gray-50 py-10 mb-10 rounded-lg px-4 md:-mx-4 shadow-2xl">
                        <h3 class="text-3xl text-center font-bold font-heading text-blue-900">
                            {{ __('No Races found') }}
                        </h3>
                    </div>
                @endforelse
            </div>
        </section>

        <section class="h-auto bg-gray-50 text-black md:px-4 lg:px-10 py-4 md:py-6 lg:py-10">
            <h5
                class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl leading-tighter font-heading cursor-pointer py-10 text-center">
                {{ __('Races Locations') }}
            </h5>
            <hr>
            <div class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-2 gap-6 mt-4 px-5">
                @foreach ($this->raceLocations as $raceLocation)
                    <figure
                        class="p-4 md:p-6 mb-8 md:mb-0 shadow-2xl rounded-5xl bg-white transition duration-300 ease-in-out delay-200 transform  md:hover:translate-x-0 md:hover:-translate-y-4">
                        <div class="glightbox group relative block h-full overflow-hidden text-center">
                            <img class="aspect-video w-full object-cover transition-all duration-300 group-hover:scale-110 group-hover:opacity-75"
                                src="{{ $raceLocation->getFirstMediaUrl('local_files') }}" />
                            <h3
                                class="py-4 font-bold leading-tight text-primary dark:text-white lg:text-lg lg:leading-6">
                                {{ $raceLocation->name }}
                            </h3>

                            <p class="text-sm leading-tight tracking-tighter text-center py-6">
                                {!! $raceLocation->description !!}
                            </p>
                        </div>
                    </figure>
                @endforeach
            </div>
        </section>
        <section class="w-ful bg-green-50 py-12 px-8 lg:ml-auto bg-opacity-80">
            <h3 class="font-heading text-3xl xl:text-6xl leading-tighter pb-6 text-center">{{ __('Sponsors') }}</h3>
            <div class="flex flex-wrap items-center justify-center -mx-2 -mb-12 gap-x-6">
                @foreach ($this->sponsors as $sponsor)
                    <div class="w-1/4 sm:w-1/2 md:w-1/3 lg:w-1/6 px-2 mb-12">
                        <img class="mx-auto w-56 h-auto my-4 filter grayscale transition duration-300 hover:grayscale-0"
                            src="{{ $sponsor->getFirstMediaUrl('local_files') }}" alt="{{ $sponsor->name }}">
                        <p
                            class="text-center text-sm px-4 mb-4 absolute bottom-0 left-0 w-full text-white text-opacity-0 group-hover:text-opacity-100 transition-opacity duration-300 cursor-pointer">
                            {{ $sponsor->name }}
                        </p>
                    </div>
                @endforeach
            </div>
        </section>

        @livewire('front.resources')

        @if (count($this->featuredProducts) > 0)
            <section class="py-10 mx-auto px-4 text-center text-black">
                <h2
                    class="uppercase mb-4 text-xl xl:text-5xl lg:text-4xl md:text-3xl sm:text-2xl md:leading-normal leading-normal font-bold cursor-pointer pb-10 text-center">
                    <a href="{{ route('front.catalog') }}">
                        {{ __('Visit Store') }}
                    </a>
                </h2>

                <p class="text-center mb-6">
                    {{ __('We have a wide range of products for you to choose from') }}
                </p>

                <hr>
                <div class="relative mb-6">
                    <x-product-slider :products="$this->featuredProducts" />
                </div>
            </section>
        @endif


        @if (count($this->sections) > 0)
            <section class="py-5 px-4 mx-auto bg-gray-100">
                <div class="grid gap-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 w-full py-10">
                    @foreach ($this->sections as $section)
                        <div class="px-3 mb-6 relative h-full text-center pt-16 bg-white">
                            <div class="pb-12 border-b">
                                <h3 class="mb-4 text-xl font-bold font-heading">{{ $section->title }}</h3>
                                @if ($section->subtitle)
                                    <p>{{ $section->subtitle }}</p>
                                @endif
                            </div>
                            <div class="py-5 px-4 text-center">
                                <p class="text-lg text-gray-500">
                                    {!! $section->description !!}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</div>
