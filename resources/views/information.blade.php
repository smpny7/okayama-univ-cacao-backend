@extends('layouts.app')
@section('hideHeader', true)

@section('content')
    <div class="container m-auto">
        <div class="px-4 py-4 md:py-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-10">
            <div class="grid gap-4 row-gap-5 mb-8 lg:grid-cols-3 lg:row-gap-8">
                @foreach($notices as $notice)
                    <div class="bg-white dark:bg-gray-800 w-full rounded-lg p-4 shadow sm:inline-block">
                        <div class="flex items-start text-left">
                            <div class="flex-shrink-0">
                                <div class="inline-block relative">
                                    <a href="#" class="block relative">
                                        <img alt="profile" src="{{ $notice->sender_icon_url }}"
                                             class="mx-auto object-cover h-12 w-12 "/>
                                    </a>
                                </div>
                            </div>
                            <div class="ml-6">
                                <p class="flex items-baseline">
                                    <span class="text-gray-600 dark:text-gray-200 font-bold">
                                        {{ $notice->sender_name }}
                                    </span>
                                </p>
                                <div class="flex items-center mt-1">
                                    <span class="text-gray-500 dark:text-gray-300 text-sm">
                                        {{ $notice->getFuzzyTime() }}
                                    </span>
                                </div>
                                <div class="mt-3">
                                    <p class="mt-1 max-w-xs dark:text-white">
                                        {!! $notice->contents !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
