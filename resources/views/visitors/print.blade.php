@extends('layouts.app')
@section('hideHeader', true)

@section('content')
    @if($forcePrint)
        <script type="text/javascript">
            window.print();
        </script>
    @endif
    <div class="container m-auto">
        <div
            class="px-4 print:px-0 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="flex flex-col w-full mb-6 lg:justify-between lg:flex-row md:mb-8">
                <div class="flex items-center mb-5 md:mb-6 group lg:max-w-xl">
                    <div class="mr-3">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-pink-100 text-pink-400">
                            <svg class="w-8 h-8 text-pink-400" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M21.261,2.739A9.836,9.836,0,0,0,8.3,2.114,4.489,4.489,0,1,0,4.134,8.963a9.415,9.415,0,0,0,.842,5.668.5.5,0,0,1-.07.564L2,16.945A3.743,3.743,0,0,0,3.735,24a3.891,3.891,0,0,0,.457-.027,3.705,3.705,0,0,0,2.725-1.735l2.068-3.127a.5.5,0,0,1,.575-.089,9.663,9.663,0,0,0,11.315-2.147A10.5,10.5,0,0,0,24,9.758,9.409,9.409,0,0,0,21.261,2.739ZM2,4.5A2.5,2.5,0,1,1,4.5,7,2.5,2.5,0,0,1,2,4.5Zm8.44,12.726a2.494,2.494,0,0,0-3.017.632c-.024.029-.046.059-.067.09L5.229,21.166A1.742,1.742,0,0,1,2.02,20a1.76,1.76,0,0,1,.961-1.312l3.041-1.831a.956.956,0,0,0,.126-.09,2.49,2.49,0,0,0,.623-3.016,7.331,7.331,0,0,1-.693-4.259l8.433,8.433A7.31,7.31,0,0,1,10.44,17.226Zm9.021-1.765a8.871,8.871,0,0,1-2.732,1.865c-.009-.01-.012-.023-.022-.033L7.36,7.945A4.473,4.473,0,0,0,9,4.5c0-.119-.026-.231-.035-.347a8.01,8.01,0,0,1,10.882,0A7.423,7.423,0,0,1,22,9.7,8.506,8.506,0,0,1,19.461,15.461Z"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl">
                        <span class="inline-block ml-4 tracking-widest">{{ $room->name }}</span>
                    </h2>
                </div>
            </div>

            <div class="text-right pb-6 print:hidden">
                <a onclick="window.print(); return false;"
                   class="px-10 py-4 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-themeColor cursor-pointer focus:shadow-outline focus:outline-none">
                    印刷する
                </a>
            </div>

            <div class="bg-white shadow-md print:shadow-none rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">日付</th>
                        <th class="py-3 px-6 text-left">学籍番号</th>
                        <th class="py-3 px-6 text-center">体温</th>
                        <th class="py-3 px-6 text-center">だるさ</th>
                        <th class="py-3 px-6 text-center">息苦しさ</th>
                        <th class="py-3 px-6 text-center">入室時刻</th>
                        <th class="py-3 px-6 text-center">退室時刻</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($activities as $activity)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $activity->in_time->format('Y/m/d') }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $activity->student_id }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $activity->body_temp }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $activity->fatigue }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $activity->stifling }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $activity->in_time->format('H:i') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex items-center justify-center">
                                    <div class="flex items-center">
                                        @isset($activity->out_time)
                                            <span class="font-medium">{{ $activity->out_time->format('H:i') }}</span>
                                        @else
                                            <span class="font-medium text-gray-400 tracking-widest">不明</span>
                                        @endisset
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
