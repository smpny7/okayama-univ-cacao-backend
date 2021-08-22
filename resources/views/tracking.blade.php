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
                                    d="M23.052,11.654,21.233,7.563A6,6,0,0,0,15.75,4H14.4l-.66-2.642a1.794,1.794,0,0,0-3.48,0L9.6,4H5A5.006,5.006,0,0,0,0,9v8a2.994,2.994,0,0,0,2.071,2.838A3.4,3.4,0,0,0,2,20.5a3.5,3.5,0,0,0,7,0,3.465,3.465,0,0,0-.041-.5h6.082a3.465,3.465,0,0,0-.041.5,3.5,3.5,0,0,0,7,0,3.4,3.4,0,0,0-.071-.662A2.994,2.994,0,0,0,24,17v-.878A10.93,10.93,0,0,0,23.052,11.654ZM19.406,8.376,20.573,11H17a1,1,0,0,1-1-1V6.018A4,4,0,0,1,19.406,8.376ZM7,20.5a1.5,1.5,0,0,1-3,0,1.418,1.418,0,0,1,.093-.5H6.907A1.418,1.418,0,0,1,7,20.5ZM18.5,22A1.5,1.5,0,0,1,17,20.5a1.418,1.418,0,0,1,.093-.5h2.814a1.418,1.418,0,0,1,.093.5A1.5,1.5,0,0,1,18.5,22ZM22,17a1,1,0,0,1-1,1H3a1,1,0,0,1-1-1V9A3,3,0,0,1,5,6h9v4a3,3,0,0,0,3,3h4.429A8.916,8.916,0,0,1,22,16.122ZM11,12a1,1,0,0,1-1,1H9v1a1,1,0,0,1-2,0V13H6a1,1,0,0,1,0-2H7V10a1,1,0,0,1,2,0v1h1A1,1,0,0,1,11,12Z"/>
                            </svg>
                        </div>
                    </div>
                    <h2 class="font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl">
                        <span class="inline-block ml-4 tracking-widest">接触者追跡</span>
                    </h2>
                </div>
            </div>

            <form action="{{ route('tracking.search') }}" method="post" class="container px-5 pb-10 mx-auto">
                @csrf
                <div
                    class="flex lg:w-2/3 w-full sm:flex-row flex-col mx-auto px-8 sm:space-x-4 sm:space-y-0 space-y-4 sm:px-0 items-end">
                    <div class="relative flex-grow w-full">
                        <label for="student_id" class="leading-7 text-sm text-gray-600">学籍番号</label>
                        <input type="text" id="student_id" name="student_id" value="{{  $student_id ?? '' }}"
                               autocapitalize="on"
                               class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-themeColor focus:bg-transparent focus:ring-2 focus:ring-pink-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                    </div>
                    <button type="submit"
                            class="text-white bg-themeColor border-0 py-2 px-8 focus:outline-none rounded text-lg w-28">
                        追跡
                    </button>
                </div>
            </form>

            @isset($students)
                <div class="text-right">
                    @empty(!$student_id)
                        <a class="text-gray-500 tracking-widest"
                           href="{{ route('tracking.downloadCSV', ['student_id' => $student_id]) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline-block mb-1 mr-1" width="18"
                                 height="18"
                                 viewBox="0 0 14 14" fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M7.04727305,6 L5.88954613,4.78361162 C5.48634246,4.37558579 5.48634246,3.71404521 5.88954613,3.30601937 C6.29274981,2.89799354 6.94647213,2.89799354 7.34967581,3.30601937 L11,7 L7.34967581,10.6939806 C6.94647213,11.1020065 6.29274981,11.1020065 5.88954613,10.6939806 C5.48634246,10.2859548 5.48634246,9.62441421 5.88954613,9.21638838 L7.04727305,8.0448155 L2.0324676,8 C1.46225149,8 1,7.57703567 1,7 C1,6.42296433 1.46225149,6 2.0324676,6 L7.04727305,6 Z M12,2 C12.5522847,2 13,2.44771525 13,3 L13,11 C13,11.5522847 12.5522847,12 12,12 C11.4477153,12 11,11.5522847 11,11 L11,3 C11,2.44771525 11.4477153,2 12,2 Z"
                                      transform="rotate(90 7 7)"/>
                            </svg>
                            ダウンロード
                        </a>
                    @endempty
                </div>
                <div class="mt-2 text-right">
                    <p class="inline-block text-themeColor tracking-widest">{{ '検索結果: ' . count($students) . ' 名' }}</p>
                </div>
                <div class="bg-white shadow-md Erounded mb-6 mt-3">
                    <table class="min-w-max w-full table-auto">
                        <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">日付</th>
                            <th class="py-3 px-6 text-left">学籍番号</th>
                            <th class="py-3 px-6 text-left">接触部屋</th>
                            <th class="py-3 px-6 text-center">接触時間</th>
                            <th class="py-3 px-6 text-center">ステータス</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                        @foreach($students as $student)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ $student['date'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{ $student['student_id'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <span>{{ $student['room_id'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center">
                                        <span>{{ $student['time'] }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-center">
                                    @if($student['status'])
                                        <span
                                            class="bg-red-100 text-red-600 py-1 px-3 rounded-full text-xs">15分以上接触</span>
                                    @else
                                        <span
                                            class="bg-yellow-100 text-yellow-600 py-1 px-3 rounded-full text-xs">15分未満接触</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center">
                    <span class="text-gray-600">
                        学籍番号を入力してください
                    </span>
                </div>
            @endisset
        </div>
    </div>
@endsection
