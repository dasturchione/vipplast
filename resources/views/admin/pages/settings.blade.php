@extends('admin.layouts.app')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03] p-5">
        <form action="{{ route('admin.setting.post') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                <x-adminfields.input label="Title (uz)" name="meta_title_uz"
                    value="{{ old('meta_title_uz', $settings->meta_title_uz ?? '') }}" />
                <x-adminfields.input label="Title (ru)" name="meta_title_ru"
                    value="{{ old('meta_title_ru', $settings->meta_title_ru ?? '') }}" />
            </div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                <x-adminfields.textarea label="Izoh (uz)" name="meta_title_uz"
                    value="{{ old('meta_title_uz', $settings->meta_title_uz ?? '') }}" />
                <x-adminfields.textarea label="Izoh (ru)" name="meta_title_ru"
                    value="{{ old('meta_title_ru', $settings->meta_title_ru ?? '') }}" />
            </div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                <x-adminfields.textarea label="Seo keywords (uz)" name="meta_keywords_uz"
                    value="{{ old('meta_keywords_uz', $settings->meta_keywords_uz ?? '') }}" />
                <x-adminfields.textarea label="Seo keywords (ru)" name="meta_keywords_ru"
                    value="{{ old('meta_keywords_ru', $settings->meta_keywords_ru ?? '') }}" />
            </div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-3 mt-4">
                <div class="lg:col-span-2">
                    <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                        <x-adminfields.input label="Telefon" name="phone"
                            value="{{ old('phone', $settings->phone ?? '') }}" />
                        <x-adminfields.input label="Email" name="email"
                            value="{{ old('email', $settings->email ?? '') }}" />
                        <x-adminfields.input label="Instagram" name="instagram"
                            value="{{ old('instagram', $settings->instagram ?? '') }}" />
                        <x-adminfields.input label="Telegram" name="telegram"
                            value="{{ old('telegram', $settings->telegram ?? '') }}" />
                        <x-adminfields.input label="Facebook" name="facebook"
                            value="{{ old('facebook', $settings->facebook ?? '') }}" />
                        <x-adminfields.input label="Google joylashuv" name="map_link"
                            value="{{ old('map_link', $settings->map_link ?? '') }}" />
                    </div>

                </div>
                <div class="mt-4" x-data="{ image: '{{ $settings ? asset('storage/' . $settings->logo) : '' }}' }">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Logo ( 300x100)
                    </label>
                    <div id="demo-upload"
                        class="dropzone relative hover:border-brand-500! dark:hover:border-brand-500! rounded-xl border border-dashed! border-gray-300! bg-gray-50 p-3 dark:border-gray-700! dark:bg-gray-900 dz-clickable">
                        <input type="file" id="image" name="logo" accept="image/png, image/jpeg, image/webp"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" />

                        <div id="uploader" :class="{ 'hidden': image }"
                            class="dz-message m-0 pointer-events-none text-center">
                            <div class="mb-[22px] flex justify-center">
                                <div
                                    class="flex h-[50px] w-[50px] items-center justify-center rounded-full bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
                                    <svg class="fill-current" width="29" height="28" viewBox="0 0 29 28"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M14.5019 3.91699C14.2852 3.91699 14.0899 4.00891 13.953 4.15589L8.57363 9.53186C8.28065 9.82466 8.2805 10.2995 8.5733 10.5925C8.8661 10.8855 9.34097 10.8857 9.63396 10.5929L13.7519 6.47752V18.667C13.7519 19.0812 14.0877 19.417 14.5019 19.417C14.9161 19.417 15.2519 19.0812 15.2519 18.667V6.48234L19.3653 10.5929C19.6583 10.8857 20.1332 10.8855 20.426 10.5925C20.7188 10.2995 20.7186 9.82463 20.4256 9.53184L15.0838 4.19378C14.9463 4.02488 14.7367 3.91699 14.5019 3.91699ZM5.91626 18.667C5.91626 18.2528 5.58047 17.917 5.16626 17.917C4.75205 17.917 4.41626 18.2528 4.41626 18.667V21.8337C4.41626 23.0763 5.42362 24.0837 6.66626 24.0837H22.3339C23.5766 24.0837 24.5839 23.0763 24.5839 21.8337V18.667C24.5839 18.2528 24.2482 17.917 23.8339 17.917C23.4197 17.917 23.0839 18.2528 23.0839 18.667V21.8337C23.0839 22.2479 22.7482 22.5837 22.3339 22.5837H6.66626C6.25205 22.5837 5.91626 22.2479 5.91626 21.8337V18.667Z"
                                            fill=""></path>
                                    </svg>
                                </div>
                            </div>

                            <h4 class="text-theme-xl mb-3 font-semibold text-gray-800 dark:text-white/90">
                                Drag &amp; Drop File Here
                            </h4>
                            <span class="mx-auto mb-5 block w-full max-w-[290px] text-sm text-gray-700 dark:text-gray-400">
                                Drag and drop your PNG, JPG, WebP, SVG images here or browse
                            </span>

                            <span class="text-theme-sm text-brand-500 font-medium underline">
                                Browse File
                            </span>
                        </div>

                        <!-- Preview -->
                        <div id="preview" :class="image ? 'block' : 'hidden'">
                            <img id="previewImg" class="rounded-xl border border-gray-300 shadow max-w-full"
                                :src="'{{ $settings ? asset('storage/' . $settings->logo) : '' }}'" alt="Uploaded Image" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                <x-adminfields.textarea label="Manzil (uz)" name="address_uz"
                    value="{{ old('address_uz', $settings->address_uz ?? '') }}" />
                <x-adminfields.textarea label="Manzil (ru)" name="address_ru"
                    value="{{ old('address_ru', $settings->address_ru ?? '') }}" />
            </div>

            <div>
                <div>
                    <label for="about_uzt" class="block text-sm font-medium text-gray-700 mb-2">Companiya haqida
                        (uz):</label>

                    <!-- Hidden input field for actual data -->
                    <input id="about_uz" type="hidden" name="about_uz"
                        value="{{ old('about_uz', $settings->about_uz ?? '') }}">
                    <!-- Trix editor -->
                    <trix-editor style="min-height: 600px" id="about_uzt" input="about_uz"
                        class="border rounded-md shadow-sm"></trix-editor>
                </div>
                <div>
                    <label for="about_ru" class="block text-sm font-medium text-gray-700 mb-2">Companiya haqida
                        (ru):</label>

                    <!-- Hidden input field for actual data -->
                    <input id="about_ru" type="hidden" name="about_ru"
                        value="{{ old('about_ru', $settings->about_ru ?? '') }}">
                    <!-- Trix editor -->
                    <trix-editor style="min-height: 600px" input="about_ru"
                        class="border rounded-md shadow-sm min-h-600"></trix-editor>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <button type="submit"
                        class="mt-4 inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        Saqlash
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        const fileInput = document.getElementById("image");
        const preview = document.getElementById("preview");
        const uploader = document.getElementById("uploader");
        const previewImg = document.getElementById("previewImg");

        fileInput.addEventListener("change", function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const img = new Image();
            const reader = new FileReader();

            reader.onload = function(event) {
                img.onload = function() {
                    const aspectRatio = img.width / img.height;
                    const targetRatio = 3 / 1;
                    const tolerance = 0.3;

                    if (Math.abs(aspectRatio - targetRatio) <= tolerance) {
                        previewImg.src = event.target.result;
                        uploader.classList.add("hidden");
                        preview.classList.remove("hidden");
                    } else {
                        alert(
                            "Faqat 3:1 formatdagi rasm yuklashingiz mumkin."
                        );
                        fileInput.value = "";
                    }
                };
                img.src = event.target.result;
            };

            reader.readAsDataURL(file);
        });
    </script>
@endpush
