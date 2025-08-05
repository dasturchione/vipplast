@extends('admin.layouts.app')

@section('content')
    <div class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">

        <div class="border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
            <!-- ====== Table Six Start -->
            <div
                class="overflow-hidden rounded-xl border border-gray-200 pt-6 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="flex flex-col gap-4 px-6 mb-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white/90">
                            Bloglar ro'yxati
                        </h3>
                    </div>

                    <div class="flex items-center gap-3">
                        <button onclick="window.location.href='{{ route('admin.ytblog.form', ['action' => 'create']) }}'"
                            class="text-theme-sm shadow-theme-xs inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 12h6m0 0h6m-6 0v6m0-6V6" />
                            </svg>
                            Qo'shish
                        </button>
                    </div>
                </div>
                <div class="max-w-full overflow-x-auto custom-scrollbar">
                    <table class="w-full min-w-[1102px]">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Video
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Title (uz)
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Title (ru)
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400 whitespace-nowrap">
                                        Yaratilgan vaqti
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Holat
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Harakat
                                    </p>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $ytblog)
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="px-5 py-4 sm:px-6 w-95" colspan="1">
                                        <div class="aspect-[9/16] w-48 rounded overflow-hidden">
                                            <iframe class="w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $ytblog->youtube_id }}?autoplay=0&mute=0&modestbranding=1&rel=0"
                                                loading="lazy" title="YouTube Shorts"
                                                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>

                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $ytblog->title_uz }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400 line-clamp-3">
                                            {{ $ytblog->title_ru }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400 whitespace-nowrap">
                                            {{ $ytblog->created_at->format('d.m.Y H:i') }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p
                                            class="
                                        text-theme-xs font-medium inline-block rounded-full px-2 py-0.5
                                        {{ $ytblog->status
                                            ? 'bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500'
                                            : 'bg-error-50 text-error-700 dark:bg-error-500/15 dark:text-error-500' }}">
                                            {{ $ytblog->status ? 'Faol' : 'Nofaol' }}
                                        </p>

                                    </td>
                                    <td class="px-5 py-4 sm:px-6 ">
                                        <div class="flex items-center space-x-2">
                                            <a
                                                href="{{ route('admin.ytblog.form', ['action' => 'edit', 'id' => $ytblog->id]) }}">
                                                <svg class="cursor-pointer hover:fill-success-500 dark:hover:fill-success-500 fill-gray-700 dark:fill-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 1024 1024" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M257.7 752c2 0 4-.2 6-.5L431.9 722c2-.4 3.9-1.3 5.3-2.8l423.9-423.9a9.96 9.96 0 0 0 0-14.1L694.9 114.9c-1.9-1.9-4.4-2.9-7.1-2.9s-5.2 1-7.1 2.9L256.8 538.8c-1.5 1.5-2.4 3.3-2.8 5.3l-29.5 168.2a33.5 33.5 0 0 0 9.4 29.8c6.6 6.4 14.9 9.9 23.8 9.9m67.4-174.4L687.8 215l73.3 73.3l-362.7 362.6l-88.9 15.7zM880 836H144c-17.7 0-32 14.3-32 32v36c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-36c0-17.7-14.3-32-32-32" />
                                                </svg>
                                            </a>
                                            <form method="POST" action="{{ route('admin.ytblog.destroy', $ytblog->id) }}"
                                                onsubmit="return confirm('Rostdan ham o‘chirmoqchimisiz?')" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit">
                                                    <svg class="cursor-pointer hover:fill-error-500 dark:hover:fill-error-500 fill-gray-700 dark:fill-gray-400"
                                                        width="20" height="20" viewBox="0 0 20 20" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                            d="M6.54142 3.7915C6.54142 2.54886 7.54878 1.5415 8.79142 1.5415H11.2081C12.4507 1.5415 13.4581 2.54886 13.4581 3.7915V4.0415H15.6252H16.666C17.0802 4.0415 17.416 4.37729 17.416 4.7915C17.416 5.20572 17.0802 5.5415 16.666 5.5415H16.3752V8.24638V13.2464V16.2082C16.3752 17.4508 15.3678 18.4582 14.1252 18.4582H5.87516C4.63252 18.4582 3.62516 17.4508 3.62516 16.2082V13.2464V8.24638V5.5415H3.3335C2.91928 5.5415 2.5835 5.20572 2.5835 4.7915C2.5835 4.37729 2.91928 4.0415 3.3335 4.0415H4.37516H6.54142V3.7915ZM14.8752 13.2464V8.24638V5.5415H13.4581H12.7081H7.29142H6.54142H5.12516V8.24638V13.2464V16.2082C5.12516 16.6224 5.46095 16.9582 5.87516 16.9582H14.1252C14.5394 16.9582 14.8752 16.6224 14.8752 16.2082V13.2464ZM8.04142 4.0415H11.9581V3.7915C11.9581 3.37729 11.6223 3.0415 11.2081 3.0415H8.79142C8.37721 3.0415 8.04142 3.37729 8.04142 3.7915V4.0415ZM8.3335 7.99984C8.74771 7.99984 9.0835 8.33562 9.0835 8.74984V13.7498C9.0835 14.1641 8.74771 14.4998 8.3335 14.4998C7.91928 14.4998 7.5835 14.1641 7.5835 13.7498V8.74984C7.5835 8.33562 7.91928 7.99984 8.3335 7.99984ZM12.4168 8.74984C12.4168 8.33562 12.081 7.99984 11.6668 7.99984C11.2526 7.99984 10.9168 8.33562 10.9168 8.74984V13.7498C10.9168 14.1641 11.2526 14.4998 11.6668 14.4998C12.081 14.4998 12.4168 14.1641 12.4168 13.7498V8.74984Z"
                                                            fill=""></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5">
                                    <x-paginator :paginator="$data" />
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endsection
