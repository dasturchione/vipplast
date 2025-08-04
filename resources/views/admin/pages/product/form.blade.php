@extends('admin.layouts.app')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <form action="{{ isset($item) ? route('admin.products.post', $item->id) : route('admin.products.post') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-3">
                    <div class="lg:col-span-2">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <x-adminfields.input label="Nomi (uz)" name="name_uz" type="text"
                                value="{{ old('name_uz', $item->name_uz ?? '') }}" />
                            <x-adminfields.input label="Nomi (ru)" name="name_ru" type="text"
                                value="{{ old('name_ru', $item->name_ru ?? '') }}" />
                        </div>
                        <div x-data="categorySelector()" x-init="init()"
                            class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                            <x-adminfields.select label="Kategoriya" name="parent_id" x-model="selectedParent"
                                @change="fetchChildren" :options="$pcatecory->pluck('name_uz', 'id')->toArray()" />
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                    Sub kategoriya
                                </label>
                                <div class="relative z-20 bg-transparent">
                                    <select name="category_id" x-model="selectedChild" :disabled="!children.length"
                                        class="disabled:cursor-not-allowed dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30">
                                        <option value="">Tanlang...</option>
                                        <template x-for="(name, id) in childrenOptions" :key="id">
                                            <option :value="id" x-text="name"
                                                selected="{{ old('category_id', $item->category_id ?? '') }}"></option>
                                        </template>

                                    </select>
                                    <span
                                        class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                                        <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke-width="1.5"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </div>
                                @error('category_id')
                                    <p class="mt-1 text-sm text-error-500 dark:text-red-400">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>
                        </div>
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                            <x-adminfields.textarea label="Xususiyat (uz)" name="options_uz"
                                value="{{ old('options_uz', $item->options_uz ?? '') }}" />
                            <x-adminfields.textarea label="Xususiyat (ru)" name="options_ru"
                                value="{{ old('options_ru', $item->options_ru ?? '') }}" />
                        </div>
                    </div>
                    <div class="mt-4" x-data="{ image: '{{ $item ? $item->image : '' }}' }">
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Rasm yuklash (kvadrat 250 px)
                        </label>
                        <div id="demo-upload"
                            class="dropzone relative hover:border-brand-500! dark:hover:border-brand-500! rounded-xl border border-dashed! border-gray-300! bg-gray-50 p-3 dark:border-gray-700! dark:bg-gray-900 dz-clickable">
                            <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/webp"
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
                                <span
                                    class="mx-auto mb-5 block w-full max-w-[290px] text-sm text-gray-700 dark:text-gray-400">
                                    Drag and drop your PNG, JPG, WebP, SVG images here or browse
                                </span>

                                <span class="text-theme-sm text-brand-500 font-medium underline">
                                    Browse File
                                </span>
                            </div>

                            <!-- Preview -->
                            <div id="preview" :class="image ? 'block' : 'hidden'">
                                <img id="previewImg" class="rounded-xl border border-gray-300 shadow max-w-full"
                                    :src="'{{ $item ? $item->image : '' }}'" alt="Uploaded Image" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                    <x-adminfields.textarea label="Mahsulot izohi (uz)" name="description_uz"
                        value="{{ old('description_uz', $item->description_uz ?? '') }}" />
                    <x-adminfields.textarea label="Mahsulot izohi (ru)" name="description_ru"
                        value="{{ old('description_ru', $item->description_ru ?? '') }}" />
                </div>
                <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                    <x-adminfields.textarea label="Seo keywords (uz)" name="keywords_uz"
                        value="{{ old('keywords_uz', $item->keywords_uz ?? '') }}" />
                    <x-adminfields.textarea label="Seo keywords (ru)" name="keywords_ru"
                        value="{{ old('keywords_ru', $item->keywords_ru ?? '') }}" />
                </div>
                <div class="mt-4 flex justify-between items-center">
                    <x-adminfields.select label="Holat" name='status'
                    :options="['1' => 'Faol', '0' => 'No faol']"
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
        function categorySelector() {
            return {
                selectedParent: @js(old('parent_id', $item->category->parent->id ?? '')),
                selectedChild: '',
                children: [],

                get childrenOptions() {
                    return this.children.reduce((acc, cur) => {
                        acc[cur.id] = cur.name_uz;
                        return acc;
                    }, {});
                },

                init() {
                    if (this.selectedParent) {
                        this.fetchChildren();
                    }
                },

                fetchChildren() {
                    this.selectedChild = '';
                    this.children = [];

                    if (!this.selectedParent) return;
                    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
                    const csrf = tokenMeta ? tokenMeta.getAttribute('content') : '';
                    fetch(`/admin/child-categories/${this.selectedParent}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrf,
                            },
                            body: JSON.stringify({})
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.children = data;
                        })
                        .catch(err => {
                            console.error('Xatolik:', err);
                        });
                }
            };
        }

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
                    if (img.width === img.height) {
                        previewImg.src = event.target.result;
                        uploader.classList.add("hidden");
                        preview.classList.remove("hidden");
                    } else {
                        alert(
                            "Faqat kvadrat (eni = bo‘yi) shakldagi rasm yuklashingiz mumkin"
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
