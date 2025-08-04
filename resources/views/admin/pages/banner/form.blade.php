@extends('admin.layouts.app')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <!-- Form -->
            <form action="{{ isset($item) ? route('admin.banners.post', $item->id) : route('admin.banners.post') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                    <x-adminfields.input label="Title (uz)" name="title_uz" type="text"
                        value="{{ old('title_uz', $item->title_uz ?? '') }}" />
                    <x-adminfields.input label="Title (ru)" name="title_ru" type="text"
                        value="{{ old('title_ru', $item->title_ru ?? '') }}" />
                </div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                    <x-adminfields.textarea label="Description (uz)" name="subtitle_uz" rows="6"
                        value="{{ old('subtitle_uz', $item->subtitle_uz ?? '') }}" />
                    <x-adminfields.textarea label="Description (ru)" name="subtitle_ru" rows="6"
                        value="{{ old('subtitle_ru', $item->subtitle_ru ?? '') }}" />
                </div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                    <x-adminfields.select label="Rasm animatsiyasi" name="animation" :options="[
                        'kenburns-top-right' => 'Ken Burns Top Right',
                        'kenburns-top-left' => 'Ken Burns Top Left',
                    ]"
                        selected="{{ old('animation', $item->animation ?? '') }}" />
                    <x-adminfields.select label="Title animatsiyasi" name="titleAnimation" :options="[
                        'tracking-in-expand-fwd' => 'Tracking In Expand Forward',
                        // 'tracking-in-expand-left' => 'Tracking In Expand Left',
                    ]"
                        selected="{{ old('titleAnimation', $item->titleAnimation ?? '') }}" />
                </div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                    <x-adminfields.select label="SubTitle animatsiyasi" name="subtitleAnimation" :options="[
                        'slit-in-horizontal' => 'Slit in Horizontal',
                    ]"
                        selected="{{ old('subtitleAnimation', $item->subtitleAnimation ?? '') }}" />
                    <x-adminfields.select label="Text jolashuvi" name="position" :options="[
                        'center-left' => 'Center left',
                        'center-right' => 'Center right',
                        'bottom-left' => 'Bottom left',
                    ]"
                        selected="{{ old('position', $item->position ?? '') }}" />
                </div>
                <div class="mt-4" x-data="{ image: '{{ $item ? $item->image : '' }}' }">
                    <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Rasm yuklash (1905x900 px)
                    </label>
                    <div id="demo-upload"
                        class="dropzone relative hover:border-brand-500! dark:hover:border-brand-500! rounded-xl border border-dashed! border-gray-300! bg-gray-50 p-7 lg:p-10 dark:border-gray-700! dark:bg-gray-900 dz-clickable">
                        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/webp"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" />

                        <div id="uploader" :class="{ 'hidden': image }"
                            class="dz-message m-0 pointer-events-none text-center">
                            <div class="mb-[22px] flex justify-center">
                                <div
                                    class="flex h-[68px] w-[68px] items-center justify-center rounded-full bg-gray-200 text-gray-700 dark:bg-gray-800 dark:text-gray-400">
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
                        <div id="preview" :class="image ? 'mt-6 block' : 'mt-6 hidden'">
                            <img id="previewImg" class="rounded-xl border border-gray-300 shadow max-w-full"
                                :src="'{{ $item ? $item->image : '' }}'" alt="Uploaded Image" />
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-between">
                    <x-adminfields.select label="Holat" name='status' :options="['1' => 'Faol', '0' => 'No faol']"
                        selected="{{ old('status', $item->status ?? '') }}" />
                    <button type="submit"
                        class="mt-4 inline-flex items-center justify-center rounded-lg bg-brand-500 px-4 py-2.5 text-sm font-medium text-white shadow hover:bg-brand-600 focus:outline-none focus:ring-2 focus:ring-brand-500/10 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                        Saqlash
                    </button>
                </div>
            </form>

        </div>
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
                    if (img.width === 1905 && img.height === 900) {
                        previewImg.src = event.target.result;
                        uploader.classList.add("hidden");
                        preview.classList.remove("hidden");
                    } else {
                        alert(
                            "Faqat 1905x900 o‘lchamdagi rasm yuklashingiz mumkin"
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
