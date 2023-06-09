<div>
    @section('title', $page->title)

    <section class="relative table w-full bg-gray-100 pt-16">
        <article itemscope itemtype="http://schema.org/Article" class="max-w-prose mx-auto py-8 mt-10 items-center w-fullmd:px-12 lg:px-24">
            <img src="{{ $page->getFirstMediaUrl('local_files') }}" alt="{{ $page->title }}"
                class="object-cover object-top w-full" />
            <h1 class="mt-6 text-3xl text-center font-bold text-black md:text-5xl">
                {{ $page->title }}
            </h1>
            <p class="py-10 text-black">{!! $page->description !!}</p>
        </article>
    </section>

    @if ($page->section == 'contact')
        @livewire('front.contact')
    @endif
    
    @if (count($this->sections) > 0)
        <section class="py-5 px-10 mx-auto bg-gray-100">
            @foreach ($this->sections as $section)
                <div class="px-3 relative h-full text-center py-16 bg-white">
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
        </section>
    @endif
</div>
