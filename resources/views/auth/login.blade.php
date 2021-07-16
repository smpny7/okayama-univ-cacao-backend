@extends('layouts.app')

@section('content')
    <div class="container text-gray-600 body-font px-5 py-24 mx-auto">
        <form method="POST" action="{{ route('login') }}"
              class="lg:w-2/6 md:w-1/2 bg-gray-100 rounded-lg p-8 flex flex-col m-auto w-full mt-10 md:mt-0">
            @csrf

            <h2 class="text-gray-900 text-lg font-medium title-font mb-5">ログイン</h2>
            <div class="relative mb-4">
                <label for="login_id" class="leading-7 text-sm text-gray-600">ID</label>
                <input type="text" id="login_id" name="login_id"
                       value="{{ old('login_id') }}" required autofocus
                       class="@error('login_id') border-themeColor @enderror w-full bg-white rounded border border-gray-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                @error('login_id')
                <span class="text-themeColor">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="relative mb-4">
                <label for="password" class="leading-7 text-sm text-gray-600">パスワード</label>
                <input type="password" id="password" name="password"
                       class="@error('password') border-themeColor @enderror w-full bg-white rounded border border-gray-300 focus:border-pink-500 focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                @error('password')
                <span class="text-themeColor">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="block mt-2">
                <label class="flex justify-start items-start">
                    <div
                        class="bg-white border rounded border-gray-300 w-5 h-5 flex flex-shrink-0 justify-center items-center mr-2">
                        <input type="checkbox" class="opacity-0 absolute" {{ old('remember') ? 'checked' : '' }}>
                        <svg class="fill-current hidden w-3 h-3 text-themeColor pointer-events-none"
                             viewBox="0 0 20 20">
                            <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
                        </svg>
                    </div>
                    <div class="select-none text-sm text-gray-700 tracking-wide">ログイン情報を記憶する</div>
                </label>
            </div>
            <button type="submit"
                    class="text-white bg-themeColor border-0 mt-10 py-2 px-8 focus:outline-none rounded text-lg">
                ログイン
            </button>
        </form>
    </div>
@endsection
