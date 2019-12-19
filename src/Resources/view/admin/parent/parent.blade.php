<!DOCTYPE html>
<html class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>欢迎页面</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <link rel="stylesheet" href="{{ shop_asset('css/font.css') }}">
    <link rel="stylesheet" href="{{ shop_asset('css/xadmin.css')  }}">
    <link rel="stylesheet" href="{{ shop_asset('css/theme49.min.css')  }}">
    <script type="text/javascript" src="{{ shop_asset('js/jquery.min.js')}}"></script>
    <script src="{{ shop_asset('lib/layui/layui.js')  }}" charset="utf-8"></script>
    <script src="{{ shop_asset('lib/layui/layui.all.js')  }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ shop_asset('js/xadmin.js')}}"></script>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    {{--引入css--}}
    @section('headercss')

    @show

</head>
<style>
    .successdiv{
        position: absolute;
        z-index: 999999;
        width: 30%;
        opacity: 0.8;
        cursor: pointer;
        top: 100px;
        left: 30%;
    }
    .errordiv{
        position: absolute;
        z-index: 999999;
        width: 30%;
        opacity: 0.8;
        cursor: pointer;
        top: 100px;
        left: 30%;
    }
    .validate{
        position: absolute;
        z-index: 999999;
        width: 30%;
        opacity: 0.8;
        cursor: pointer;
        top: 100px;
        left: 30%;
    }
    .layui-form-label {
        float: left;
        display: block;
        padding: 9px 5px;
        width: 80px;
        font-weight: 400;
        line-height: 20px;
        text-align: right;
    }
    .bg-info{
        background: #ECF8FC;
        width: 99%;
        margin: 5px auto;
        border-radius: 5px;
    }
    .bg-font{
        color: #4e5762;
    }
    .ul-list{
        color: #73898d;
        padding-top: 10px;
    }
    .ul-list li {
        padding-bottom: 5px;
    }
    .xing{
        color: red;
        padding-left: 5px;
    }
    .w100{
        width: 100px;
    }
</style>
@if (session('success'))
    <!-- 成功显示的div -->
    <div class="alert alert-success successdiv xianshi" style="font-size:16px;display: block;" id="divs">
        <i class="layui-icon layui-icon-close-fill"></i>
        {{ session('success') }}<span style="font-size: 12px;color:#ccc;">(点击可消失)</span>
    </div>
@endif

@if (session('error'))
    <!-- 错误提示的div -->
    <div class="alert alert-danger errordiv xianshi" style="font-size:16px;display: block" id="errorDiv">
        <i class="layui-icon layui-icon-close-fill"></i>
        {{ session('error') }}<span style="font-size: 12px;color:#ccc;">(点击可消失)</span>
    </div>
@endif

{{--这个是validate验证器输出错误时会提示--}}
@if (count($errors) > 0)
    <div class="alert alert-danger validate xianshi" id="errors">
        <i class="layui-icon layui-icon-close-fill"></i>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<script>
    $('.close').click(function () {
        $('.successdiv').css('display','none');
        $('.errordiv').css('display','none');
        $('.validate').css('display','none');
    })
    $('.successdiv').click(function () {
        $('.successdiv').css('display','none');
    })
    $('.errordiv').click(function () {
        $('.errordiv').css('display','none');
    })
    $('.validate').click(function () {
        $('.validate').css('display','none');
    })
    var alertInfo = $('.xianshi').css('display');
    if (alertInfo == 'block') {
        setTimeout(function () {
            $('.xianshi').css('display','none');
        },2000);
    }
</script>