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
                            Fikrlar ro'yxati
                        </h3>
                    </div>


                </div>
                <div class="max-w-full overflow-x-auto custom-scrollbar">
                    <table class="w-full min-w-[1102px]">
                        <thead>
                            <tr class="border-b border-gray-100 dark:border-gray-800">
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Foydalanuvchi
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Telefon
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Mavzu
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Yaratildi
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
                            @foreach ($data as $feedback)
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="px-5 py-4 sm:px-6 w-95" colspan="1">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 overflow-hidden rounded-full">
                                                <img src="{{ asset('storage/images/user/user_image.png') }}"
                                                    alt="{{ $feedback->username }}" />
                                            </div>
                                            <div>
                                                <span
                                                    class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $feedback->username }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ phone_format($feedback->phone) }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {!! isset($feedback->subject)
                                                ? $feedback->subject
                                                : '<p class="text-theme-xs font-medium inline-block rounded-full px-2 py-0.5 bg-error-50 text-error-700 dark:bg-error-500/15 dark:text-error-500">Mavzu kiritilmagan</p>' !!}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $feedback->created_at->format('d.m.Y H:i') }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p
                                            class="
    text-theme-xs font-medium inline-block rounded-full px-2 py-0.5
    {{ $feedback->view
        ? 'bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500'
        : 'bg-error-50 text-error-700 dark:bg-error-500/15 dark:text-error-500' }}">
                                            {{ $feedback->view ? 'Ko`rilgan' : 'Ko`rilmagan' }}
                                        </p>

                                    </td>
                                    <td class="px-5 py-4 sm:px-6 ">
                                        <div x-data="feedbackModal({ id: {{ $feedback->id }} })">
                                            <button @click="openModal" class="px-4 py-3 text-sm font-medium">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 1024 1024" class="hover:fill-blue-500 fill-black"
                                                    fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M942.2 486.2C847.4 286.5 704.1 186 512 186c-192.2 0-335.4 100.5-430.2 300.3a60.3 60.3 0 0 0 0 51.5C176.6 737.5 319.9 838 512 838c192.2 0 335.4-100.5 430.2-300.3c7.7-16.2 7.7-35 0-51.5M512 766c-161.3 0-279.4-81.8-362.7-254C232.6 339.8 350.7 258 512 258c161.3 0 279.4 81.8 362.7 254C791.5 684.2 673.4 766 512 766m-4-430c-97.2 0-176 78.8-176 176s78.8 176 176 176s176-78.8 176-176s-78.8-176-176-176m0 288c-61.9 0-112-50.1-112-112s50.1-112 112-112s112 50.1 112 112s-50.1 112-112 112" />
                                                </svg>
                                            </button>

                                            <div x-show="isModalOpen" x-transition
                                                class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto z-99999">
                                                <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[5px]"
                                                    @click="isModalOpen = false"></div>

                                                <div @click.outside="isModalOpen = false"
                                                    class="relative w-full max-w-[600px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
                                                    <!-- close btn -->
                                                    <button @click="isModalOpen = false"
                                                        class="absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
                                                        <svg class="fill-current" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                                                                fill=""></path>
                                                        </svg>
                                                    </button>

                                                    <div>
                                                        <h4
                                                            class="font-semibold text-gray-800 mb-7 text-title-sm dark:text-white/90">
                                                            Foydalanuvchini fikri
                                                        </h4>
                                                        <div class="flex justify-between text-sm">
                                                            <div>
                                                                <h1>FIO:</h1>
                                                                <span>{{ $feedback->username }}</span>
                                                            </div>
                                                            <div>
                                                                <h1>Telefon:</h1>
                                                                <span>{{ phone_format($feedback->phone) }}</span>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-5">Xabar:</h1>
                                                        <p class="text-sm">{{ $feedback->message }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ====== Table Six End -->
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function feedbackModal({
            id
        }) {
            return {
                isModalOpen: false,
                openModal() {
                    fetch('/admin/feedback/view', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content'),
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            this.isModalOpen = true;
                        })
                        .catch(error => {
                            console.error(error);
                            alert('Xatolik yuz berdi');
                        });
                }
            }
        }
    </script>
@endpush
