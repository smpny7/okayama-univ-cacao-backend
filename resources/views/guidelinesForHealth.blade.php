@extends('layouts.app')

@section('content')
    <div class="mt-3 md:mt-12 px-4 py-4 md:py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
        <div class="max-w-3xl sm:mx-auto">
            <p class="mb-3"><strong>健康診断に利用するデータ</strong></p>
            <p>
                本サービスを使用している間、健康診断の提供が必要になる場合があります。
                このデータは、明らかに発熱をしている、または体調不良である人の入室を拒否するために使用されます。
                具体的には、体温が37.5度以上であるかどうか、体調が良好であるかどうか、息苦しさなどの症状があるか、だるさや倦怠感を感じることがあるかを尋ねます。
                体温を37.5度を境に判定する根拠は、厚生労働省の発熱の定義を基にしています。詳しくはこちらをご覧ください。
            </p>
            <p>
                (<a class="text-themeColor" href="https://www.mhlw.go.jp/web/t_doc?dataId=00tb9642&dataType=1&pageNo=1#l000000215">
                    https://www.mhlw.go.jp/web/t_doc?dataId=00tb9642&dataType=1&pageNo=1 </a>)
            </p>
            <p>
                また、息苦しさや倦怠感を判断する根拠は、こちらのページをご覧ください。
            </p>
            <p>
                (<a class="text-themeColor" href="https://www.mhlw.go.jp/stf/seisakunitsuite/bunya/0000121431_00094.html#h2_free5">
                    https://www.mhlw.go.jp/stf/seisakunitsuite/bunya/0000121431_00094.html </a>)
            </p>
            <p>
                本アプリは医学的決定を下さず、医学的な情報を提供しません。
                このアプリを通じて自身の健康に疑問がある場合は、医師の診断を受けて、その指示に従ってください。
            </p>
            <p class="mt-4">（このガイドラインは、2021年8月8日に改定されました）</p>
        </div>
    </div>
@endsection
