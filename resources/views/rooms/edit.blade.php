@extends('layouts.app')

@section('content')
    <form action="{{ $action }}" method="post" class="container m-auto">
        @csrf
        <div
            class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
            <div class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center">
                @if(!isset($club) || !$club->is_admin)
                    <div class="lg:max-w-lg lg:w-full md:w-1/2 w-5/6 mb-10 md:mb-0">
                        <img class="object-cover object-center rounded" alt="hero"
                             src="{{ $club->image_path ?? 'http://placehold.jp/24/FFE7EC/FE6A88/600x400.png?text=%E7%94%BB%E5%83%8F%E3%81%8C%E3%81%82%E3%82%8A%E3%81%BE%E3%81%9B%E3%82%93' }}">
                    </div>
                @endif
                <div
                    class="lg:flex-grow md:w-1/2 lg:pl-24 md:pl-16 flex flex-col md:items-start md:text-left items-center text-center">
                    <div class="flex w-full md:justify-start justify-center items-end">
                        <div class="relative mr-4 w-full">
                            <label for="name" class="leading-7 text-sm text-gray-600">団体名</label>
                            <input type="text" id="name" name="name" value="{{ $club->name ?? null }}" required
                                   class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-pink-200 focus:bg-transparent focus:border-pink-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                        </div>
                    </div>
                    @if(!isset($club) || !$club->is_admin)
                        <div class="flex w-full md:justify-start justify-center items-end mt-2">
                            <div class="relative mr-4 w-full">
                                <label for="image_path" class="leading-7 text-sm text-gray-600">画像パス</label>
                                <input type="text" id="image_path" name="image_path"
                                       value="{{ $club->image_path ?? null }}"
                                       class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:ring-2 focus:ring-pink-200 focus:bg-transparent focus:border-pink-500 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                        </div>
                    @endif
                    <div class="flex lg:flex-row md:flex-col py-8">
                        <button type="submit"
                                class="inline-flex text-white bg-themeColor border-0 py-2 px-6 focus:outline-none rounded text-lg">
                            @isset($club) 保存 @else 登録 @endisset
                        </button>
                        <a href="{{ route('rooms.index') }}"
                           class="block inline-flex text-white bg-gray-300 border-0 ml-4 py-2 px-6 focus:outline-none rounded text-lg">
                            キャンセル
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
