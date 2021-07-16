@extends('layouts.app')

@section('content')
    <div
        class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl lg:px-8 lg:py-20 flex lg:flex-row flex-col items-center">
        <div class="lg:max-w-lg lg:w-full mb-10 md:mb-0 ml-2 text-center">
            {!! $qr_code !!}
        </div>
        <div
            class="lg:flex-grow lg:w-1/2 md:pl-10 flex flex-col lg:items-start lg:text-left items-center text-center">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-gray-900">
                このQRコードを控えておいてください
            </h1>
            <p class="mb-8 leading-relaxed">
                このページを移動すると、同じQRコードを表示させることはできません。
            </p>
            <div class="flex flex-col pb-6 pr-0 w-full lg:w-auto lg:text-left text-center">
                <h2 class="text-themeColor tracking-widest font-medium title-font mb-1">部屋名</h2>
                <h1 class="md:text-2xl text-xl font-medium title-font text-gray-900 tracking-widest">{{ $room_name }}</h1>
            </div>

            <div class="text-right py-6 print:pb-0">
                <a href="#" onclick="window.print(); return false;"
                   class="px-10 py-4 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-themeColor focus:shadow-outline focus:outline-none"
                   aria-label="印刷する"
                   title="印刷する">
                    印刷する
                </a>
                <a href="/rooms/index"
                   class="px-10 py-4 font-medium ml-4 tracking-wide text-white transition duration-200 rounded shadow-md bg-gray-300 focus:shadow-outline focus:outline-none"
                   aria-label="戻る"
                   title="戻る">
                    戻る
                </a>
            </div>
        </div>
    </div>
@endsection
