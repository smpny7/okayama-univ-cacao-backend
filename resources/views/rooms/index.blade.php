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
                        <span class="inline-block ml-4 tracking-widest">部屋追加 / 編集</span>
                        <div
                            class="h-1 ml-auto duration-300 origin-left transform bg-deep-purple-accent-400 scale-x-30 group-hover:scale-x-100"></div>
                    </h2>
                </div>
            </div>

            <div class="text-right pb-6">
                <a href="/rooms/create"
                   class="px-10 py-4 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-themeColor focus:shadow-outline focus:outline-none"
                   aria-label="新規追加"
                   title="新規追加">
                    新規追加
                </a>
            </div>

            <div class="bg-white shadow-md rounded my-6">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">部屋名</th>
                        <th class="py-3 px-6 text-left">ID</th>
                        <th class="py-3 px-6 text-center">QRコード</th>
                        <th class="py-3 px-6 text-center">ステータス</th>
                        <th class="py-3 px-6 text-center">その他</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($rooms as $room)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{ $room->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $room->id }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if(!$room->is_admin)
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('rooms.regenerate', ['club_id' => $room->id]) }}" class="text-themeColor underline"
                                           onclick="return confirm('この部屋IDで認証している端末は強制ログアウトされます。\nよろしいですか？')">リセットして再生成
                                            ></a>
                                    </div>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                @if($room->is_admin)
                                    <span
                                        class="bg-pink-100 text-pink-600 py-1 px-3 rounded-full text-xs">管理者</span>
                                @else
                                    <span
                                        class="bg-green-100 text-green-600 py-1 px-3 rounded-full text-xs">標準ユーザー</span>
                                @endif
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <a href="/rooms/edit/{{ $room->id }}"
                                       class="block w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </a>
                                    @if(!$room->is_admin)
                                        <div
                                            class="cursor-not-allowed w-4 mr-2 transform hover:text-themeColor hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </div>
                                    @endif
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
