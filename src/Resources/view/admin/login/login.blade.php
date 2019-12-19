<!doctype html>
<html  class="x-admin-sm">
<head>
	<meta charset="UTF-8">
	<title>后台管理系统</title>
	<meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ shop_asset('css/font.css')  }}">
    <link rel="stylesheet" href="{{ shop_asset('css/login.css')  }}">
	  <link rel="stylesheet" href="{{ shop_asset('css/xadmin.css')  }}">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ shop_asset('/lib/layui/layui.js')  }}" charset="utf-8"></script>
    <!--[if lt IE 9]>
      <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
      <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">
    <div class="login layui-anim ">
        <div class="message">管理登录</div>
        <div id="darkbannerwrap"></div>

        <form method="post" class="layui-form">
            {{--用户名开始--}}
                <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input username" >
                <hr class="hr15">
            {{--用户名结束--}}

            {{--密码开始--}}
                <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input password">
                <hr class="hr15">
            {{--密码结束--}}

            {{--登陆按钮开始--}}
                {{--<input value="登录" class="layui-anim-fadein btn" lay-submit lay-filter="login" style="width:100%;" type="submit">--}}
                <input value="登录" class="layui-anim-fadein btn" style="width:100%;" type="button">
                <hr class="hr20" >
            {{--登陆按钮结束--}}
        </form>
    </div>

    <script>
        function reloadCode(object)
        {
            $.ajax(
                {
                    url: "{{ url('admin/reloadCode') }}",
                    context: document.body,
                    success: function(data){
                        var jsonData = JSON.parse(data);
                        $('#code').attr('src', jsonData.data);
                    }}
            );
        }

        /**
         * 提交登陆开始
         */
        layui.use('form', function () {
            $('.btn').click(function () {

                var username = $('.username').val();
                if (username == '') {
                    layer.msg('用户必选项不能为空！', {time:3000, icon:5});
                    return;
                }

                var password = $('.password').val();
                if (password == '') {
                    layer.msg('密码必选项不能为空！', {time:3000, icon:5});
                    return;
                }

                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type:"POST",
                    url: "{{url('pack/admin/commit_login')}}",
                    data: {username:username, password:password},
                    dataType: "json",
                    success:function (data) {
                        if (data.code == 100) {
                            layer.msg(data.msg, {time:3000, icon:5});
                            return;
                        }
                        layer.msg(data.msg, {time:3000, icon:6}, function () {
                            window.location.href = "{{ url('pack/admin/index') }}"
                        });
                    }
                });

            });
        });

        /**
         * 提交登陆结束
         */

        $(function  () {
            {{--layui.use('form', function(){--}}
              {{--var form = layui.form;--}}
                {{--//icon = 5 错误提示 6 正确提示--}}
                {{--layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', {time: 3000, icon:5}, function () {--}}
                    {{--window.location.href = "{{url('admin/index')}}"--}}
                {{--});--}}

              {{--//监听提交--}}
              {{--form.on('submit(admin/loginCommit)', function(data){--}}
                  {{--console.log(data);--}}
                {{--// alert(888)--}}
                {{--layer.msg(JSON.stringify(data.field),function(){--}}
                    {{--location.href='index.html'--}}
                {{--});--}}
                {{--return false;--}}
              {{--});--}}
            {{--});--}}
        })
    </script>
    <!-- 底部结束 -->
    <script>
    //百度统计可去掉
    var _hmt = _hmt || [];
    (function() {
      var hm = document.createElement("script");
      hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
      var s = document.getElementsByTagName("script")[0];
      s.parentNode.insertBefore(hm, s);
    })();
    </script>
</body>
</html>
