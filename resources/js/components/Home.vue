<template class="text-gray-600 body-font">
    <div class="sm:max-w-xl md:max-w-full lg:max-w-screen-xl px-5 py-12 mx-auto">
        <div class="flex flex-wrap w-full mb-12 flex-col items-center text-center">
            <h1 class="sm:text-3xl text-2xl font-medium title-font mb-2 text-gray-900">
                ホーム
            </h1>
            <p class="lg:w-1/2 w-full leading-relaxed text-gray-500">
                実行したいアクションを選択してください
            </p>
        </div>
        <div class="flex flex-wrap -m-4">
            <div v-for="card in cards" class="xl:w-1/3 md:w-1/2 p-4">
                <a :href="card.href" class="border border-gray-200 block p-6 rounded-lg">
                    <div
                        class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-pink-100 text-pink-400 mb-4">
                        <div v-html="card.icon" class="fill-current h-5 w-5"></div>
                    </div>
                    <h2 class="text-lg text-gray-900 font-medium title-font mb-2 tracking-widest">{{ card.title}}</h2>
                    <p class="leading-relaxed text-base text-gray-500 tracking-wider">{{ card.description }}</p>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Home",
    data() {
        return {
            cards: [
                {
                    title: '部屋一覧',
                    href: '/rooms',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"><path d="M12,6a4,4,0,1,0,4,4A4,4,0,0,0,12,6Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,12Z"/><path d="M12,24a5.271,5.271,0,0,1-4.311-2.2c-3.811-5.257-5.744-9.209-5.744-11.747a10.055,10.055,0,0,1,20.11,0c0,2.538-1.933,6.49-5.744,11.747A5.271,5.271,0,0,1,12,24ZM12,2.181a7.883,7.883,0,0,0-7.874,7.874c0,2.01,1.893,5.727,5.329,10.466a3.145,3.145,0,0,0,5.09,0c3.436-4.739,5.329-8.456,5.329-10.466A7.883,7.883,0,0,0,12,2.181Z"/></svg>',
                    description: '各部屋の人数や在室者一覧を確認できます。0時に入室状況はリセットされます。',
                },
                {
                    title: '接触追跡',
                    href: '/tracking',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"><path d="M9,12A6,6,0,1,0,3,6,6.006,6.006,0,0,0,9,12ZM9,2A4,4,0,1,1,5,6,4,4,0,0,1,9,2Z"/><path d="M9,14a9.011,9.011,0,0,0-9,9,1,1,0,0,0,2,0,7,7,0,0,1,14,0,1,1,0,0,0,2,0A9.011,9.011,0,0,0,9,14Z"/><path d="M22,7.875a2.107,2.107,0,0,0-2,2.2,2.107,2.107,0,0,0-2-2.2,2.107,2.107,0,0,0-2,2.2c0,1.73,2.256,3.757,3.38,4.659a.992.992,0,0,0,1.24,0c1.124-.9,3.38-2.929,3.38-4.659A2.107,2.107,0,0,0,22,7.875Z"/></svg>',
                    description: '学籍番号を入力することで、その人が過去2週間に接触した人物一覧が表示されます。',
                },
                {
                    title: '部屋追加 / 編集',
                    href: '/rooms/list',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"¥><path d="M7,0H4A4,4,0,0,0,0,4V7a4,4,0,0,0,4,4H7a4,4,0,0,0,4-4V4A4,4,0,0,0,7,0ZM9,7A2,2,0,0,1,7,9H4A2,2,0,0,1,2,7V4A2,2,0,0,1,4,2H7A2,2,0,0,1,9,4Z"/><path d="M7,13H4a4,4,0,0,0-4,4v3a4,4,0,0,0,4,4H7a4,4,0,0,0,4-4V17A4,4,0,0,0,7,13Zm2,7a2,2,0,0,1-2,2H4a2,2,0,0,1-2-2V17a2,2,0,0,1,2-2H7a2,2,0,0,1,2,2Z"/><path d="M20,13H17a4,4,0,0,0-4,4v3a4,4,0,0,0,4,4h3a4,4,0,0,0,4-4V17A4,4,0,0,0,20,13Zm2,7a2,2,0,0,1-2,2H17a2,2,0,0,1-2-2V17a2,2,0,0,1,2-2h3a2,2,0,0,1,2,2Z"/><path d="M14,7h3v3a1,1,0,0,0,2,0V7h3a1,1,0,0,0,0-2H19V2a1,1,0,0,0-2,0V5H14a1,1,0,0,0,0,2Z"/></svg>',
                    description: '部屋を追加したり、既存の部屋を編集できます。パスワードリセットもこちら。',
                },
                {
                    title: 'アナウンス設定',
                    href: '/announce',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"><path d="M12,0A12,12,0,1,0,24,12,12.013,12.013,0,0,0,12,0Zm0,22A10,10,0,1,1,22,12,10.011,10.011,0,0,1,12,22Z"/><path d="M12,6a1,1,0,0,0-1,1v4.325L7.629,13.437a1,1,0,0,0,1.062,1.7l3.84-2.4A1,1,0,0,0,13,11.879V7A1,1,0,0,0,12,6Z"/></svg>',
                    description: '設定した日時に、アプリケーション内にショートテキストを表示できます。',
                },
                {
                    title: '設定',
                    href: '/settings',
                    icon: '<svg xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24"><path d="M1,4.75H3.736a3.728,3.728,0,0,0,7.195,0H23a1,1,0,0,0,0-2H10.931a3.728,3.728,0,0,0-7.195,0H1a1,1,0,0,0,0,2ZM7.333,2a1.75,1.75,0,1,1-1.75,1.75A1.752,1.752,0,0,1,7.333,2Z"/><path d="M23,11H20.264a3.727,3.727,0,0,0-7.194,0H1a1,1,0,0,0,0,2H13.07a3.727,3.727,0,0,0,7.194,0H23a1,1,0,0,0,0-2Zm-6.333,2.75A1.75,1.75,0,1,1,18.417,12,1.752,1.752,0,0,1,16.667,13.75Z"/><path d="M23,19.25H10.931a3.728,3.728,0,0,0-7.195,0H1a1,1,0,0,0,0,2H3.736a3.728,3.728,0,0,0,7.195,0H23a1,1,0,0,0,0-2ZM7.333,22a1.75,1.75,0,1,1,1.75-1.75A1.753,1.753,0,0,1,7.333,22Z"/></svg>',
                    description: 'その他の設定を行います。管理者アカウントの権限設定等を行います。',
                },
            ],
        };
    },
}
</script>
