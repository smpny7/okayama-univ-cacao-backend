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
                <a href="/" class="mr-3 transition duration-300 hover:shadow-lg">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3c/Download_on_the_App_Store_Badge.svg/1000px-Download_on_the_App_Store_Badge.svg.png"
                        class="object-cover object-top w-32 mx-auto" alt=""/>
                </a>
                <a href="/" class="transition duration-300 hover:shadow-lg">
                    <img
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/78/Google_Play_Store_badge_EN.svg/1000px-Google_Play_Store_badge_EN.svg.png"
                        class="object-cover object-top w-32 mx-auto" alt=""/>
                </a>
            </div>
            <p class="mt-6 text-xs text-gray-600 sm:text-sm sm:mx-auto">
                FeliCa 対応の iOS・Android スマートフォンで始められます。
            </p>
        </div>
    </div>
@endsection
