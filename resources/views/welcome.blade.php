@extends('layouts.app')

@section('content')
    <div class="mt-12 px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="max-w-3xl sm:text-center sm:mx-auto">
            <div class="inline-block mb-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-pink-50">
                    <svg class="w-10 h-10 text-themeColor" stroke="currentColor" viewBox="0 0 52 52">
                        <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none"
                                 points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
                    </svg>
                </div>
            </div>
            <h2 class="mb-6 font-sans text-3xl font-bold tracking-widest text-gray-900 sm:text-4xl sm:leading-none">
      <span class="relative inline-block">
        <svg viewBox="0 0 52 24" fill="currentColor"
             class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-pink-400 lg:w-32 lg:-ml-32 lg:-mt-10 sm:block">
          <defs>
            <pattern id="6b0188f3-b7a1-4e9b-b95e-cad916bb3042" x="0" y="0" width=".135" height=".30">
              <circle cx="1" cy="1" r=".7"></circle>
            </pattern>
          </defs>
          <rect fill="url(#6b0188f3-b7a1-4e9b-b95e-cad916bb3042)" width="52" height="24"></rect>
        </svg>
        <span class="relative bg-white text-gradient">接触者追跡アプリ、</span>
      </span>
                <span class="text-5xl text-gradient">cacao</span>
            </h2>
            <p class="mt-12 text-base text-gray-700 tracking-widest md:text-lg">
                部屋を登録するだけで、その部屋に入った人物を追跡。<br>
                体育館や講義室など、どこにでも設置することができ、簡単に追跡を始められます。<br>
                追跡する部屋が多くなるほど、接触者の判定も向上していきます。
            </p>
            <hr class="my-8 border-gray-300"/>
            <div class="flex items-center mb-3 sm:justify-center">
                <div class="flex-row">
                    <button
                        class="bg-gray-100 inline-flex py-3 px-5 rounded-lg items-center hover:bg-gray-200 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                             viewBox="0 0 512 512">
                            <path
                                d="M99.617 8.057a50.191 50.191 0 00-38.815-6.713l230.932 230.933 74.846-74.846L99.617 8.057zM32.139 20.116c-6.441 8.563-10.148 19.077-10.148 30.199v411.358c0 11.123 3.708 21.636 10.148 30.199l235.877-235.877L32.139 20.116zM464.261 212.087l-67.266-37.637-81.544 81.544 81.548 81.548 67.273-37.64c16.117-9.03 25.738-25.442 25.738-43.908s-9.621-34.877-25.749-43.907zM291.733 279.711L60.815 510.629c3.786.891 7.639 1.371 11.492 1.371a50.275 50.275 0 0027.31-8.07l266.965-149.372-74.849-74.847z"></path>
                        </svg>
                        <span class="ml-4 flex items-start flex-col leading-none">
                            <span class="text-xs text-gray-600 mb-1">GET IT ON</span>
                            <span class="title-font font-medium">Google Play</span>
                        </span>
                    </button>
                    <button
                        class="bg-gray-100 inline-flex py-3 px-5 rounded-lg items-center ml-4 md:mt-4 mt-0 lg:mt-0 hover:bg-gray-200 focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6"
                             viewBox="0 0 305 305">
                            <path
                                d="M40.74 112.12c-25.79 44.74-9.4 112.65 19.12 153.82C74.09 286.52 88.5 305 108.24 305c.37 0 .74 0 1.13-.02 9.27-.37 15.97-3.23 22.45-5.99 7.27-3.1 14.8-6.3 26.6-6.3 11.22 0 18.39 3.1 25.31 6.1 6.83 2.95 13.87 6 24.26 5.81 22.23-.41 35.88-20.35 47.92-37.94a168.18 168.18 0 0021-43l.09-.28a2.5 2.5 0 00-1.33-3.06l-.18-.08c-3.92-1.6-38.26-16.84-38.62-58.36-.34-33.74 25.76-51.6 31-54.84l.24-.15a2.5 2.5 0 00.7-3.51c-18-26.37-45.62-30.34-56.73-30.82a50.04 50.04 0 00-4.95-.24c-13.06 0-25.56 4.93-35.61 8.9-6.94 2.73-12.93 5.09-17.06 5.09-4.64 0-10.67-2.4-17.65-5.16-9.33-3.7-19.9-7.9-31.1-7.9l-.79.01c-26.03.38-50.62 15.27-64.18 38.86z"></path>
                            <path
                                d="M212.1 0c-15.76.64-34.67 10.35-45.97 23.58-9.6 11.13-19 29.68-16.52 48.38a2.5 2.5 0 002.29 2.17c1.06.08 2.15.12 3.23.12 15.41 0 32.04-8.52 43.4-22.25 11.94-14.5 17.99-33.1 16.16-49.77A2.52 2.52 0 00212.1 0z"></path>
                        </svg>
                        <span class="ml-4 flex items-start flex-col leading-none">
                            <span class="text-xs text-gray-600 mb-1">Download on the</span>
                            <span class="title-font font-medium">App Store</span>
                        </span>
                    </button>
                </div>
            </div>
            <p class="mt-6 text-xs text-gray-600 sm:text-sm sm:mx-auto">
                FeliCa 対応の iOS・Android スマートフォンで始められます。
            </p>
        </div>
    </div>
@endsection
