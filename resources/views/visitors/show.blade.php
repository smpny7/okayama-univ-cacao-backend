@extends('layouts.app')

@section('content')
    <div class="container m-auto">
        <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
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

            <h3 class="text-2xl text-gray-600 tracking-widest border-b-2 border-themeColor mb-6 pb-2 pl-2">
                入退室履歴（月別）
            </h3>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 xl:gap-10 mb-16">
                @for($date = \Carbon\Carbon::today(); $date->gte(\Carbon\Carbon::createMidnightDate(2021, 7, 1)); $date = $date->subMonth())
                    <a href="{{route('visitors.print', ['room_id' => $room->id, 'year' => $date->year, 'month' => $date->month, 'forcePrint' => 0])}}"
                       target="_blank" rel="noopener noreferrer" class="block shadow-lg rounded-2xl bg-white p-4">
                        <div class="flex justify-center items-center">
                            <div class="flex-shrink pl-2">
                                <img alt="profil" src="{{ asset('img/pdf.svg') }}"
                                     class="mx-auto object-cover h-10"/>
                            </div>
                            <div class="flex-grow flex flex-col pl-6">
                                <span class="text-gray-600 text-lg font-medium">
                                    {{ $date->year }}年 {{ $date->month }}月
                                </span>
                                <span class="text-gray-400 text-xs tracking-wider">
                                    {{ $room->name }}
                                </span>
                            </div>
                            <button
                                onClick="window.open('{{route('visitors.print', ['room_id' => $room->id, 'year' => $date->year, 'month' => $date->month, 'forcePrint' => 1])}}')"
                                class="h-12 w-12 flex-shrink mt-1 pl-3 text-center text-themeColor rounded-full transition ease-out duration-500 hover:bg-pink-50">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="24" height="24"
                                     preserveAspectRatio="xMinYMin" class="icon__icon">
                                    <path fill="currentColor"
                                          d="M16 14h1a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h1V9h12v5zM4 4V0h12v4h1a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3h-1v4H4v-4H3a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3h1zm2 14h8v-7H6v7zM6 4h8V2H6v2z"></path>
                                </svg>
                            </button>
                        </div>
                    </a>
                @endfor
            </div>


            <h3 class="text-2xl text-gray-600 tracking-widest border-b-2 border-themeColor mb-6 pb-2 pl-2">
                現在の入室者
            </h3>

            @isset($visitors[0])
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 xl:gap-10">
                    @foreach($visitors as $visitor)
                        <div class="shadow-lg rounded-2xl p-4 bg-white">
                            <div class="flex flex-row items-start gap-4">
                                <div class="h-28 w-full flex flex-col justify-between">
                                    <div>
                                        <p class="text-gray-800 text-xl tracking-wider font-medium">
                                            {{ $visitor->student_id }}
                                        </p>
                                        <p class="text-gray-400 text-xs">
                                            {{ $visitor->created_at->format('H:i') . ' から入室' }}
                                        </p>
                                    </div>
                                    <div class="rounded-lg bg-pink-100 p-2 w-full">
                                        <div
                                            class="flex items-center justify-around text-xs text-pink-400 text-center">
                                            <p class="flex flex-col">
                                                体温
                                                <span class="text-black font-bold">
                                                {{ $visitor->activity->body_temp . ' ℃' }}
                                            </span>
                                            </p>
                                            <p class="flex flex-col">
                                                息苦しさ
                                                <span class="text-black font-bold">
                                                {{ $visitor->activity->stifling }}
                                            </span>
                                            </p>
                                            <p class="flex flex-col">
                                                だるさ
                                                <span class="text-black font-bold">
                                                {{ $visitor->activity->fatigue }}
                                            </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-between gap-4 mt-6">
                                <form action="{{ route('student.search') }}" method="post"
                                      class="w-1/2">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $visitor->activity->student_id }}">
                                    <button type="submit"
                                            class="text-center w-full px-4 py-3 text-sm border rounded-lg text-gray-500 tracking-widest bg-white">
                                        入退室履歴
                                    </button>
                                </form>
                                <form action="{{ route('tracking.search') }}" method="post"
                                      class="w-1/2">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $visitor->activity->student_id }}">
                                    <button type="submit"
                                            class="text-center w-full px-4 py-3 text-sm rounded-lg text-white tracking-widest bg-themeColor">
                                        接触追跡
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-gray-600">
                    現在の入室者はいません
                </div>
            @endisset
        </div>
    </div>
@endsection
