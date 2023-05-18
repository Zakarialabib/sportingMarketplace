<div class="px-6 py-2 bg-gradient-to-r from-move-400 via-move-600 to-move-800">
    <div class="flex items-center justify-between">
        <p class="text-xs text-center font-semibold font-heading text-white hover:text-move-200 hover:underline transition ease-in duration-300 cursor-pointer">
            {{__('Search & Compare Freely')}}
        </p>
        <div class="w-auto flex space-x-3">
            <a class="inline-flex items-center justify-center w-5 h-5 rounded-full"
                href="{{ Helpers::settings('social_facebook') }}" target="_blank">
                <i
                    class="fab fa-facebook-f text-md text-white hover:text-move-200  hover:underline transition ease-in duration-300"></i>
            </a>
            <a class="inline-flex items-center justify-center w-5 h-5 rounded-full"
                href="{{ Helpers::settings('social_instagram') }}" target="_blank">
                <i
                    class="fab fa-instagram text-md text-white hover:text-move-200  hover:underline transition ease-in duration-300"></i>
            </a>
            <a class="inline-flex items-center justify-center w-5 h-5 rounded-full"
                href="{{ Helpers::settings('social_twitter') }}" target="_blank">
                <i
                    class="fab fa-twitter text-md text-white hover:text-move-200  hover:underline transition ease-in duration-300"></i>
            </a>
            <a class="inline-flex items-center justify-center w-5 h-5 rounded-full"
                href="{{ Helpers::settings('social_linkedin') }}" target="_blank">
                <i
                    class="fab fa-linkedin-in text-md text-white hover:text-move-200  hover:underline transition ease-in duration-300"></i>
            </a>
        </div>
    </div>
</div>