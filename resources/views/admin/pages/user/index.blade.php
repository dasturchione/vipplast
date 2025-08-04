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
                            Foydalanuvchilar ro'yxati
                        </h3>
                    </div>

                    <div x-data="{ isModalOpen: false }">
                        <button @click="isModalOpen = !isModalOpen"
                            class="text-theme-sm shadow-theme-xs inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-4 py-3 font-medium text-gray-700 hover:bg-gray-50 hover:text-gray-800 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-white/[0.03] dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M6 12h6m0 0h6m-6 0v6m0-6V6" />
                            </svg>
                            Qo'shish
                        </button>
                        <div x-show="isModalOpen"
                            class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
                            style="display: none;">
                            <div class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]">
                            </div>
                            <div @click.outside="isModalOpen = false"
                                class="relative w-full max-w-[600px] rounded-3xl bg-white p-6 dark:bg-gray-900 lg:p-10">
                                <!-- close btn -->
                                <button @click="isModalOpen = false"
                                    class="absolute right-3 top-3 z-999 flex h-9.5 w-9.5 items-center justify-center rounded-full bg-gray-100 text-gray-400 transition-colors hover:bg-gray-200 hover:text-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:right-6 sm:top-6 sm:h-11 sm:w-11">
                                    <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M6.04289 16.5413C5.65237 16.9318 5.65237 17.565 6.04289 17.9555C6.43342 18.346 7.06658 18.346 7.45711 17.9555L11.9987 13.4139L16.5408 17.956C16.9313 18.3466 17.5645 18.3466 17.955 17.956C18.3455 17.5655 18.3455 16.9323 17.955 16.5418L13.4129 11.9997L17.955 7.4576C18.3455 7.06707 18.3455 6.43391 17.955 6.04338C17.5645 5.65286 16.9313 5.65286 16.5408 6.04338L11.9987 10.5855L7.45711 6.0439C7.06658 5.65338 6.43342 5.65338 6.04289 6.0439C5.65237 6.43442 5.65237 7.06759 6.04289 7.45811L10.5845 11.9997L6.04289 16.5413Z"
                                            fill=""></path>
                                    </svg>
                                </button>

                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-7 text-title-sm dark:text-white/90">
                                        Foydalanuvchini qo'shish
                                    </h4>
                                    <form action="{{ route('admin.user.post') }}" method="POST">
                                        @csrf
                                        <x-adminfields.input name="name" label="Foydalanuvchi ismi"
                                            value="" placeholder="Foydalanuvchi ismi" required />
                                        <div class="mt-4">
                                            <x-adminfields.input name="surname" label="Foydalanuvchi familiyasi"
                                                value="" placeholder="Foydalanuvchi familiyasi"
                                                required />
                                        </div>
                                        <div class="mt-4">
                                            <x-adminfields.input type="email" name="email" label="Foydalanuvchi emaili"
                                                value="" placeholder="Foydalanuvchi emaili" required />
                                        </div>
                                        <div class="mt-4">
                                            <x-adminfields.input name="password"
                                                label="Parol (agar o'zgartirmochi bo'lsangiz)" type="password"
                                                value="" placeholder="Parol" min="6" required/>
                                        </div>
                                        <div class="mt-4">
                                            <x-adminfields.select name="status" label="Status" :options="[
                                                '1' => 'Faol',
                                                '0' => 'No faol',
                                            ]"
                                                selected="1" />
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
                                        Email
                                    </p>
                                </th>
                                <th class="px-5 py-3 text-left sm:px-6">
                                    <p class="font-medium text-gray-500 text-theme-xs dark:text-gray-400">
                                        Roli
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
                            @foreach ($data as $user)
                                <tr class="border-b border-gray-100 dark:border-gray-800">
                                    <td class="px-5 py-4 sm:px-6 w-95" colspan="1">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 overflow-hidden rounded-full">
                                                <img src="{{ asset('storage/images/user/user_image.png') }}"
                                                    alt="{{ $user->name }}" />
                                            </div>
                                            <div>
                                                <span
                                                    class="block font-medium text-gray-800 text-theme-sm dark:text-white/90">
                                                    {{ $user->surname }}
                                                </span>
                                                <span class="block text-gray-500 text-theme-xs dark:text-gray-400">
                                                    {{ $user->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $user->email }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            Admin
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p class="text-gray-500 text-theme-sm dark:text-gray-400">
                                            {{ $user->created_at->format('d.m.Y H:i') }}
                                        </p>
                                    </td>
                                    <td class="px-5 py-4 sm:px-6">
                                        <p
                                            class="
    text-theme-xs font-medium inline-block rounded-full px-2 py-0.5
    {{ $user->status
        ? 'bg-success-50 text-success-700 dark:bg-success-500/15 dark:text-success-500'
        : 'bg-error-50 text-error-700 dark:bg-error-500/15 dark:text-error-500' }}">
                                            {{ $user->status ? 'Faol' : 'Nofaol' }}
                                        </p>

                                    </td>
                                    <td class="px-5 py-4 sm:px-6 ">
                                        <div x-data="{ isModalOpen: false }">
                                            <button class="px-4 py-3 text-sm font-medium"
                                                @click="isModalOpen = !isModalOpen">
                                                <svg class="cursor-pointer hover:fill-success-500 dark:hover:fill-success-500 fill-gray-700 dark:fill-gray-400"
                                                    xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                                    viewBox="0 0 1024 1024" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                        d="M257.7 752c2 0 4-.2 6-.5L431.9 722c2-.4 3.9-1.3 5.3-2.8l423.9-423.9a9.96 9.96 0 0 0 0-14.1L694.9 114.9c-1.9-1.9-4.4-2.9-7.1-2.9s-5.2 1-7.1 2.9L256.8 538.8c-1.5 1.5-2.4 3.3-2.8 5.3l-29.5 168.2a33.5 33.5 0 0 0 9.4 29.8c6.6 6.4 14.9 9.9 23.8 9.9m67.4-174.4L687.8 215l73.3 73.3l-362.7 362.6l-88.9 15.7zM880 836H144c-17.7 0-32 14.3-32 32v36c0 4.4 3.6 8 8 8h784c4.4 0 8-3.6 8-8v-36c0-17.7-14.3-32-32-32" />
                                                </svg>
                                            </button>

                                            <div x-show="isModalOpen"
                                                class="fixed inset-0 flex items-center justify-center p-5 overflow-y-auto modal z-99999"
                                                style="display: none;">
                                                <div
                                                    class="modal-close-btn fixed inset-0 h-full w-full bg-gray-400/50 backdrop-blur-[32px]">
                                                </div>
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
                                                            Foydalanuvchini taxrirlash
                                                        </h4>
                                                        <form action="{{ route('admin.user.post', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <x-adminfields.input name="name" label="Foydalanuvchi ismi"
                                                                value="{{ $user->name }}"
                                                                placeholder="Foydalanuvchi ismi" required />
                                                            <div class="mt-4">
                                                                <x-adminfields.input name="surname"
                                                                    label="Foydalanuvchi familiyasi"
                                                                    value="{!! $user->surname !!}"
                                                                    placeholder="Foydalanuvchi familiyasi" required />
                                                            </div>
                                                            <div class="mt-4">
                                                                <x-adminfields.input name="email"
                                                                    label="Foydalanuvchi emaili"
                                                                    value="{{ $user->email }}"
                                                                    placeholder="Foydalanuvchi emaili" required />
                                                            </div>
                                                            <div class="mt-4">
                                                                <x-adminfields.input name="password"
                                                                    label="Parol (agar o'zgartirmochi bo'lsangiz)"
                                                                    type="password" value="" placeholder="Parol" />
                                                            </div>
                                                            <div class="mt-4">
                                                                <x-adminfields.select name="status" label="Status"
                                                                    :options="[
                                                                        '1' => 'Faol',
                                                                        '0' => 'No faol',
                                                                    ]" selected="{{ $user->status }}" />
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
