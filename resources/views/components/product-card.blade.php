@props(['product'])
<div itemprop="itemListElement" itemscope itemtype="https://schema.org/Product">
    <div itemprop="brand" content="{{ $product->brand }}"></div>
    <div itemprop="sku" content="{{ $product->code }}"></div>
    <div itemprop="description" content="{{ $product->description }}"></div>

    <div class="mb-5 bg-white rounded-lg shadow-2xl sm:w-full">
        <div class="relative text-left">
            <a href="{{ route('front.product', $product->slug) }}" class="flex justify-center" itemprop="url">
                <img class="lg:h-[250px] md:h-[150px] object-fill py-2"
                    src="{{ asset('images/products/' . $product->image) }}" onerror="this.onerror=null; this.remove();"
                    alt="{{ $product->name }}" loading="lazy" />
                <meta itemprop="image" content="{{ asset('images/products/' . $product->image) }}" />
            </a>

            @if ($product->old_price && $product->discount != 0)
                <div class="absolute top-0 right-0 mb-3 p-2 bg-red-500 rounded-bl-lg">
                    <span class="text-white font-bold text-sm">
                        - {{ $product->discount }}%
                    </span>
                </div>
            @endif
        </div>
        <div class="px-2 pb-4 text-left">
            <div class="w-full flex-none text-sm flex items-center justify-center text-gray-600">
                @if ($product->status == 1)
                    <div class="text-sm font-bold">
                        <span class="text-green-500">● {{ __('In Stock') }}</span>
                    </div>
                @else
                    <div class="text-sm font-bold">
                        <span class="text-red-500">●
                            {{ __('Out of Stock') }}</span>
                    </div>
                @endif

            </div>

            <a href="{{ route('front.product', $product->slug) }}">
                <h4 class="block text-center mb-2 lg:text-md md:text-sm font-bold font-heading hover:text-move-600"
                    itemprop="name">
                    {{ Str::limit($product->name, 40) }}</h4>
            </a>

            <div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                <p class="text-center text-move-400 hover:text-move-800 font-bold text-md mt-2"><span
                        itemprop="price">{{ $product->price }}</span>DH

                    @if ($product->old_price && $product->discount != 0)
                        <del class="ml-4 text-black">{{ $product->old_price }} DH </del>
                    @endif
                </p>

                <meta itemprop="priceValidUntil" content="{{ now()->addWeek()->toIso8601String() }}">
                <meta itemprop="priceCurrency" content="MAD">
                <meta itemprop="availability"
                    content="{{ $product->status ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock' }}">
            </div>

            <div class="flex justify-center">
                <a class="my-2 block bg-move-500 hover:bg-move-800 text-center text-white font-bold text-xs py-2 px-4 rounded-md uppercase cursor-pointer tracking-wider hover:shadow-lg transition ease-in duration-300"
                {{-- href="{{ route('redirect', $product->url) }}" --}}
                 wire:loading.attr="disabled">
                    {{ __('Boutique') }}
                </a>
            </div>
        </div>
    </div>
</div>