@extends('layouts.app')
@section('hideHeader', true)

@section('content')
    <div
        class="px-4 py-4 md:py-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-10">
        <div class="sm:mx-auto">
            <p class="mb-3 text-md text-gray-800 tracking-wide"><strong>1. 学生証から収集するデータについて</strong></p>
            <p class="text-xs">
                デバイスで個人を識別する際に、学生証が必要となります。
                これは、本人以外の操作・登録を防止するためであり、第三者による大量のデータの送信（攻撃）を防止するためでもあります。
                学生証から取得するデータは、学籍番号8桁のみであり、その他のデータは一切取得しません。
            </p>
            <br>

            <p class="mb-3 text-md text-gray-800 tracking-wide"><strong>2. 入力いただく情報について</strong></p>
            <p class="text-xs">
                入室する前に、現在の体温と体調不良でないかの調査を行います。
                これまでと同様、体温については学務部で管理するためデータを送信しますが、体調不良に関する調査は送信しません。
                これらのデータの保存方法については後述します(5章)。
            </p>
            <br>

            <p class="mb-3 text-md text-gray-800 tracking-wide"><strong>3. 送信するデータについて</strong></p>
            <p class="text-xs">
                以上より、サーバに送信される情報は、学籍番号と体温のみであり、SSLにより暗号化されてサーバに送信されます。
                また送信可能な端末はストア証明書で署名されている端末に制限し、それ以外の手段を用いたリクエストは全て受け付けないようにしています。
            </p>
            <br>

            <p class="mb-3 text-md text-gray-800 tracking-wide"><strong>4. データベース上での保存方法について</strong></p>
            <p class="text-xs">
                本サービスでは、氏名や所属団体等の情報は一切保管せず、学生それぞれの識別番号と各団体に紐づくランダムな識別子を用いて、データベースに保管しております。
                そのため、第三者が個人や団体名などのプライバシーに関わる情報を、閲覧することができないようになっております。
                また、収集したデータについては、3ヶ月保管のちデータベースから完全に削除されます。
            </p>
            <br>

            <p class="mb-3 text-md text-gray-800 tracking-wide"><strong>5. アカウントの悪用対策について</strong></p>
            <p class="text-xs">
                セキュリティの観点から、各団体に交付してあるアカウントからは一切のデータの閲覧ができない権限に設定されており、アカウントの悪用の対策をしております。
                また、端末からの不審な動作やQRコードの流出などが発生した場合は、こちらからすぐにアカウントの無効化を行えるようになっております。
                QRコードが紛失・流出した場合は早急にご連絡ください。
            </p>
            <br>

            <p class="mb-3 text-md text-gray-800 tracking-wide"><strong>6. その他</strong></p>
            <p class="text-xs">
                上記以外に少しでも疑問に思われることや心配な点がございましたら、<a class="text-themeColor" target="_blank" rel="noopener noreferrer"
                                                   href="https://docs.google.com/forms/d/e/1FAIpQLSdS47woHtsbvv6xqjsxJYiej1RjcSDwG9FBWj2ZpEfaQFeD9w/viewform?usp=sf_link">こちらのフォーム</a> よりお気軽にご連絡ください。
            </p>
        </div>
    </div>
@endsection
