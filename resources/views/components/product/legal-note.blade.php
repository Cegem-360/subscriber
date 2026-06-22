{{--
    Per-module legal disclaimer block for product landing pages.
    Pass module-specific disclaimer sentences as the slot; the shared
    "illustrative results" footnote and the privacy / terms links are
    rendered automatically. Part of the website content-audit (section 4).
--}}
<section class="border-t border-gray-200 bg-white py-12">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="rounded-2xl bg-gray-50 p-6 text-sm leading-relaxed text-gray-500 sm:p-8">
            <p class="mb-3 text-base font-semibold text-gray-700">{{ __('Legal information') }}</p>
            <div class="space-y-2">
                {{ $slot }}
                <p>{{ __('The figures and results shown on this page are illustrative examples and not guaranteed.') }}</p>
            </div>
            <div class="mt-5 flex flex-wrap items-center gap-x-5 gap-y-2">
                <a href="{{ route('legal.adatvedelmi-tajekoztato') }}"
                    class="font-medium text-gray-700 underline underline-offset-2 hover:text-gray-900">{{ __('Privacy notice') }}</a>
                <a href="{{ route('legal.szolgaltatasi-feltetelek') }}"
                    class="font-medium text-gray-700 underline underline-offset-2 hover:text-gray-900">{{ __('Terms of service') }}</a>
            </div>
        </div>
    </div>
</section>
