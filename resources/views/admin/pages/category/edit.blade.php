<div x-data="{ isModalOpen: false }" class="max-h-screen">
    <button @click="isModalOpen = !isModalOpen"
        class="cursor-pointer hover:fill-error-500 dark:hover:fill-error-500 fill-gray-700 dark:fill-gray-400">
        <svg class="cursor-pointer hover:fill-success-500 dark:hover:fill-success-500 fill-gray-700 dark:fill-gray-400"
            xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 1024 1024" fill="none">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M257.7 752c2 0 4-.2 6-.5L431.9 722c2-.4 3.9-1.3 5.3-2.8l423.9-423.9a9.96 9.96 0 0 0 0-14.1L694.9 114.9c-1.9-1.9-4.4-2.9-7.1-2.9s-5.2 1-7.1 2.9L256.8 538.8c-1.5 1.5-2.4 3.3-2.8 5.3l-29.5 168.2a33.5 33.5 0 0 0 9.4 29.8c6.6 6.4 14.9 9.9 23.8 9.9m67.4-174.4L687.8 215l73.3 73.3l-362.7 362.6l-88.9 15.7zM880 836H144c-17.7 0-32 14.3-32 32v36c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-36c0-17.7-14.3-32-32-32" />
        </svg>
    </button>
    <div x-show="isModalOpen" class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
        style="display: none;">
        <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]">
        </div>
        <div @click.outside="isModalOpen = false"
            class="relative w-full max-w-[600px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
            <!-- close btn -->
            <button @click="isModalOpen = false"
                class="absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                        fill=""></path>
                </svg>
            </button>

            <div>
                <h4 class="font-semibold text-gray-800 mb-7 text-title-sm dark:text-white/90">
                    Kategoriya taxrirlash
                </h4>
                <form action="{{ route('admin.category.post', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <x-adminfields.input name="name_uz" label="Nomi (uz)" value="{{ $category->name_uz }}"
                        placeholder="Kategoriya nomi" required />
                    <div class="mt-4">
                        <x-adminfields.input name="name_ru" label="Nomi (ru)" value="{{ $category->name_ru }}"
                            placeholder="Kategoriya nomi" required />
                    </div>
                    <div class="mt-4">
                        <x-adminfields.input type="text" name="description_uz" label="Izoh (uz)" value="{{ $category->description_uz }}"
                            placeholder="izoh" required />
                        <x-adminfields.input type="text" name="description_ru" label="Izoh (ru)" value="{{ $category->description_ru }}"
                            placeholder="izoh" required />
                    </div>
                    <div class="mt-4">
                        <div class="mt-4" x-data="{ imagem: '{{ $category ? asset('storage/'.$category->image) : '' }}' }">
                            <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                                Rasm yuklash (kvadrat 250 px)
                            </label>
                            <div id="demo-upload"
                                class="dropzone relative hover:border-brand-500! dark:hover:border-brand-500! rounded-xl border border-dashed! border-gray-300! bg-gray-50 p-3 dark:border-gray-700! dark:bg-gray-900 dz-clickable">
                                <input type="file" id="imagem" name="image"
                                    accept="image/png, image/jpeg, image/webp"
                                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-50" />

                                <div id="uploaderm" :class="{ 'hidden': imagem }"
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
                                <div id="previewm" :class="imagem ? 'block' : 'hidden'">
                                    <img id="previewImgm" class="rounded-xl border border-gray-300 shadow max-w-full"
                                        :src="imagem" alt="Uploaded Image" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center justify-end w-full gap-3 mt-8">
                        <button type="submit"
                            class="flex justify-center w-full px-4 py-3 text-sm font-medium text-white rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600 sm:w-auto">
                            Saqlash
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
