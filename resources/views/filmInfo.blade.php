@extends('basic')

@section('title','影片信息')

@section('header')
    @parent
@endsection

@section('content')
    <div class="filmInfo-banner">
        <div class="wrapper">
            <div class="filmInfo-box">
                <div class="filmInfo-img">
                    <img src="http://p1.meituan.net/movie/65ee71e7b58be81f612f2d28907d5ef01223359.jpg" alt="">
                </div>
                <div class="filmInfo-info">
                    <h3>黑豹</h3>
                    <p>剧情，动作，科幻</p>
                    <p>美国/135分钟</p>
                    <p>2018-03-09大陆上映</p>
                    <a href="href" class="filmInfo-ticket">立即购票</a>
                </div>
            </div>
        </div>
    </div>
    <div class="filmInfo-content-box">
        <div class="filmInfo-content-introduce">
            <span>剧情简介</span>
        </div>
        <div class="filmInfo-content">
            <span>特查拉（查德维克·博斯曼 饰）在其父亲——前瓦坎达国王去世之后，回到了这个科技先进但与世隔绝的非洲国家，继任成为新一任领袖。“黑豹”则是瓦坎达对于领袖的称呼。当旧敌重现时，作为“黑豹”及国王的特查拉身陷两难境地，眼看着瓦坎达及全世界陷于危难之中。面对背叛与危险，这位年轻的国王必须联合同盟，释放全部力量，奋力捍卫他的人民和国土。</span>
        </div>
    </div>
@endsection

@section('footer')
    @parent
@endsection