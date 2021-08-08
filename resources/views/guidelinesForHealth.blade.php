@extends('layouts.app')
@section('hideHeader', true)

@section('content')
    <div
        class="px-4 py-4 md:py-8 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-10">
        <div class="sm:mx-auto">
            <p class="mb-3 text-lg"><strong>健康診断に利用するデータ</strong></p>
            <p class="text-sm">
                本サービスを使用している間、健康診断の提供が必要になる場合があります。
                このデータは、明らかに発熱をしている、または体調不良である人の入室を拒否するために使用されます。
                具体的には、体温が37.5度以上であるかどうか、体調が良好であるかどうか、息苦しさなどの症状があるか、だるさや倦怠感を感じることがあるかを尋ねます。
                体温を37.5度を境に判定する根拠は、厚生労働省の発熱の定義を基にしています。詳しくは
                <a class="text-themeColor"
                   href="https://www.mhlw.go.jp/web/t_doc?dataId=00tb9642&dataType=1&pageNo=1#l000000215">こちら</a>
                をご覧ください。
            </p>
            <br>
            <p class="text-sm">
                また、息苦しさや倦怠感を判断する根拠は、
                <a class="text-themeColor"
                   href="https://www.mhlw.go.jp/stf/seisakunitsuite/bunya/0000121431_00094.html#h2_free5">こちら</a>
                のページをご覧ください。
            </p>
            <br>
            <p class="text-sm">
                本アプリは医学的決定を下さず、医学的な情報を提供しません。
                このアプリを通じて自身の健康に疑問がある場合は、医師の診断を受けて、その指示に従ってください。
            </p>
            <p class="mt-4 text-sm">( 2021年8月8日 制定 )</p>
        </div>
    </div>
@endsection
