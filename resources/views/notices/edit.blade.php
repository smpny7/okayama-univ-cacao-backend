@extends('layouts.app')

@section('content')
    <form action="{{ $action }}" method="POST" class="container m-auto">
        @isset($notice) @method('PUT') @endisset
        @csrf
        <div
            class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                <div
                    class="lg:flex-grow lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                    <div class="flex w-full md:justify-start justify-center items-end">
                        <div class="relative mr-4 w-full">
                            <label for="sender_name" class="leading-7 text-sm text-gray-600">送信者</label>
                            <input type="text" id="sender_name" name="sender_name"
                                   @isset($notice) value="{{ $notice->sender_name }}" @endisset required
                                   class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-pink-200 focus:bg-transparent focus:border-pink-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="flex w-full md:justify-start justify-center items-end mt-2">
                        <div class="relative mr-4 w-full">
                            <label for="sender_icon_url" class="leading-7 text-sm text-gray-600">送信者の画像</label>
                            <input type="text" id="sender_icon_url" name="sender_icon_url"
                                   @isset($notice) value="{{ $notice->sender_icon_url }}" @endisset required
                                   class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-pink-200 focus:bg-transparent focus:border-pink-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="flex w-full md:justify-start justify-center items-end mt-2">
                        <div class="relative mr-4 w-full">
                            <label for="released_at" class="leading-7 text-sm text-gray-600">公開日時</label>
                            <input type="datetime-local" id="released_at" name="released_at"
                                   @isset($notice) value="{{ $notice->released_at->format('Y-m-d\TH:i') }}"
                                   @endisset required
                                   class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-pink-200 focus:bg-transparent focus:border-pink-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    <div class="flex w-full md:justify-start justify-center items-end mt-2">
                        <div class="relative mr-4 w-full">
                            <label class="leading-7 text-sm text-gray-600">内容</label>
                            <textarea id="contents" name="contents" required
                                      class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-pink-200 focus:bg-transparent focus:border-pink-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">@isset($notice){{ $notice->contents }}@endisset</textarea>
                        </div>
                    </div>
                    <div class="flex lg:flex-row md:flex-col py-8">
                        <button type="submit"
                                class="inline-flex text-white bg-themeColor border-0 py-2 px-6 focus:outline-none rounded text-lg">
                            @isset($notice) 保存 @else 登録 @endisset
                        </button>
                        <a href="{{ route('notices.index') }}"
                           class="block inline-flex text-white bg-gray-300 border-0 ml-4 py-2 px-6 focus:outline-none rounded text-lg">
                            キャンセル
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
