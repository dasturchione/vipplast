@extends('admin.layouts.app')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

        <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <!-- Form -->
            <form action="{{ isset($item) ? route('admin.ytblog.post', $item->id) : route('admin.ytblog.post') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div x-data="{ youtubeId: '{{ old('youtube_id', $item->youtube_id ?? '') }}' }" class="flex gap-4">
                    <div class="flex-1">
                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2">
                            <x-adminfields.input label="Title (uz)" name="title_uz" type="text"
                                value="{{ old('title_uz', $item->title_uz ?? '') }}" />
                            <x-adminfields.input label="Title (ru)" name="title_ru" type="text"
                                value="{{ old('title_ru', $item->title_ru ?? '') }}" />
                        </div>

                        <div class="grid grid-cols-1 gap-5 lg:grid-cols-2 mt-4">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">Youtube
                                    ID</label>
                                <input type="text" name="youtube_id" x-model="youtubeId"
                                    class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 border-gray-300"
                                    value="{{ old('youtube_id', $item->youtube_id ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <div class="w-80 aspect-[9/16] rounded overflow-hidden bg-gray-100">
                        <template x-if="youtubeId">
                            <iframe class="w-full h-full"
                                :src="`https://www.youtube.com/embed/${youtubeId}?autoplay=1&mute=0&modestbranding=1&rel=0`"
                                loading="lazy" title="YouTube video preview"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </template>
                        <template x-if="!youtubeId">
                            <div class="w-full h-full flex items-center justify-center text-sm text-gray-500">
                                YouTube ID kiriting
                            </div>
                        </template>
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
    <script></script>
@endpush
