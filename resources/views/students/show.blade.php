@extends('layouts.app')

@section('content')
    <div class="container m-auto">
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="flex flex-col w-full mb-6 lg:justify-between lg:flex-row md:mb-8">
                <div class="flex items-center mb-5 md:mb-6 group lg:max-w-xl">
                    <div class="mr-3">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-pink-100 text-pink-400">
                            <svg class="w-8 h-8 text-pink-400" fill="currentColor" viewBox="-2 -1.5 24 24">
                                <path
                                    d="M3.534 11.07a1 1 0 1 1 .733 1.86A3.579 3.579 0 0 0 2 16.26V18a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1.647a3.658 3.658 0 0 0-2.356-3.419 1 1 0 1 1 .712-1.868A5.658 5.658 0 0 1 14 16.353V18a3 3 0 0 1-3 3H3a3 3 0 0 1-3-3v-1.74a5.579 5.579 0 0 1 3.534-5.19zM7 1a4 4 0 0 1 4 4v2a4 4 0 1 1-8 0V5a4 4 0 0 1 4-4zm0 2a2 2 0 0 0-2 2v2a2 2 0 1 0 4 0V5a2 2 0 0 0-2-2zm9 17a1 1 0 0 1 0-2h1a1 1 0 0 0 1-1v-1.838a3.387 3.387 0 0 0-2.316-3.213 1 1 0 1 1 .632-1.898A5.387 5.387 0 0 1 20 15.162V17a3 3 0 0 1-3 3h-1zM13 2a1 1 0 0 1 0-2 4 4 0 0 1 4 4v2a4 4 0 0 1-4 4 1 1 0 0 1 0-2 2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h2 class="font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl">
                        <span class="inline-block ml-4 tracking-widest">学生情報（{{ $student_id }}）</span>
                    </h2>
                </div>
            </div>

            <h3 class="text-2xl text-gray-600 tracking-widest border-b-2 border-themeColor mb-6 pb-2 pl-2">
                学生の情報
            </h3>

            <div class="flex">
                <div class="shadow-lg rounded-2xl bg-white dark:bg-gray-800 p-4">
                    <div class="flex-row gap-4 flex justify-center items-center">
                        <div class="flex-shrink-0 text-themeColor pl-1">
                            <svg viewBox="-7 -2 24 24" width="30" height="30" preserveAspectRatio="xMinYMin">
                                <path fill="currentColor"
                                      d="M10 15a5 5 0 1 1-8-4V3a3 3 0 1 1 6 0v8c1.214.912 2 2.364 2 4zm-3.201-2.401l-.799-.6V3a1 1 0 1 0-2 0v8.999l-.799.6a3 3 0 1 0 3.598 0zM5 17a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col pl-4 pr-20">
                            <span class="text-gray-600 dark:text-white text-lg font-medium tracking-wider">
                                @isset($average_temp)
                                    {{ $average_temp }} ℃
                                @else
                                    不明
                                @endisset
                            </span>
                            <span class="text-gray-400 text-xs tracking-widest">
                                平均体温
                            </span>
                        </div>
                    </div>
                </div>

                <div class="shadow-lg rounded-2xl bg-white dark:bg-gray-800 ml-6 p-4">
                    <div class="flex-row gap-4 flex justify-center items-center">
                        <div class="flex-shrink-0 text-themeColor pl-1">
                            <svg viewBox="-2 -3 24 24" width="30" height="30" preserveAspectRatio="xMinYMin">
                                <path fill="currentColor"
                                      d="M7.116 10.749L6 1.948l-1.116 8.8H1c-.552 0-1-.437-1-.976a.99.99 0 0 1 1-.978h2.116l.9-7.086C4.15.636 5.15-.124 6.245.008c.91.11 1.626.81 1.739 1.7l.899 7.086h1.974L12 16.04l1.142-7.245H19c.552 0 1 .438 1 .978s-.448.977-1 .977h-4.142l-.881 5.587a1.978 1.978 0 0 1-1.672 1.634c-1.092.165-2.113-.567-2.282-1.634l-.88-5.587H7.115z"></path>
                            </svg>
                        </div>
                        <div class="flex flex-col pl-4 pr-20">
                            <span class="text-gray-600 dark:text-white text-lg font-medium tracking-wider">
                                @isset($current_room)
                                    {{ $current_room }}
                                @else
                                    なし
                                @endisset
                            </span>
                            <span class="text-gray-400 text-xs tracking-widest">
                                入室中の部屋
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="text-2xl text-gray-600 tracking-widest border-b-2 border-themeColor mb-6 mt-16 pb-2 pl-2">
                過去1ヶ月の行動履歴
            </h3>

            <div class="mx-auto max-w-screen-xl">
                <div class="grid gap-x-6 gap-y-4 lg:grid-cols-2 xl:grid-cols-3 max-w-full">
                    @foreach($activities as $activity)
                        <a href="{{ route('visitors.show', ['visitor' => $activity->room_id]) }}"
                           class="block shadow-lg rounded-2xl bg-white dark:bg-gray-800 pb-2 px-4 pt-4">
                            <div class="flex">
                                <div class="pt-1 mr-6 text-center">
                                    <div class="px-2 pb-1 mb-1 border-b border-gray-400">
                                        <p class="text-xs text-blue-gray-700">{{ $activity->in_time->format('n') . '月' }}</p>
                                    </div>
                                    <div class="px-2"><p
                                            class="text-lg font-bold">{{ $activity->in_time->format('j') }}</p></div>
                                </div>
                                <div>
                                    <div class="mb-2">
                                        <div
                                            class="text-xs font-semibold tracking-wide text-gray-500">
                                            @isset($activity->out_time)
                                                {{ $activity->in_time->diffInMinutes($activity->out_time) }} 分
                                            @else
                                                不明
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div class="inline-block text-xl font-bold leading-5 text-gray-700 tracking-widest">
                                            {{ $activity->room->name }}</div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
