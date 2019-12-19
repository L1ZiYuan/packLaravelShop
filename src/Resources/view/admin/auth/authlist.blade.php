@extends('pack::admin.parent.parent')
<script type="text/javascript" src="{{ shop_asset('js/jquery.min.js')}}"></script>
<script src="{{ shop_asset('lib/layui/layui.js')  }}" charset="utf-8"></script>
<script src="{{ shop_asset('lib/layui/layui.all.js')  }}" charset="utf-8"></script>
@section('headercss')
    <link rel="stylesheet" type="text/css" href="{{ shop_asset('css/bootstrap.css')  }}" media="all">
@show
<body>
<div class="x-nav">
          <span class="layui-breadcrumb">
            <a href="">首页</a>
            <a href="">演示</a>
            <a>
              <cite>导航元素</cite></a>
          </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" onclick="location.reload()" title="刷新">
        <i class="layui-icon layui-icon-refresh" style="line-height:30px"></i></a>
</div>
<div class="layui-fluid">
    <div class="layui-row layui-col-space15">
        <div class="layui-col-md12">
            <div class="layui-card">
               {{-- <div class="layui-card-body ">
                    <form class="layui-form layui-col-space5">
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input"  autocomplete="off" placeholder="开始日" name="start" id="start">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input class="layui-input"  autocomplete="off" placeholder="截止日" name="end" id="end">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <input type="text" name="username"  placeholder="请输入用户名" autocomplete="off" class="layui-input">
                        </div>
                        <div class="layui-inline layui-show-xs-block">
                            <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
                        </div>
                    </form>
                </div>--}}
                <div class="layui-card-header">
                    <a class="layui-btn layui-btn-normal" href="{{url('pack/admin/admin_auth_add_view')}}"><i class="layui-icon"></i>添加</a>
                </div>
                <div class="layui-card-body ">
                    <table class="layui-table layui-form">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>权限名称</th>
                            <th>权限控制器</th>
                            <th>权限方法</th>
                            <th>权限路由</th>
                            <th>加入时间</th>
                            <th>操作</th>
                        </thead>
                        <tbody>
                        @foreach($auth_list as $key => $value)
                               <tr>
                                   <td>{{$value->id}}</td>
                                   <td style="">@if($value->auth_pid != 0) ———— @endif{{$value->auth_name}}</td>
                                   <td>{{$value->auth_c}}</td>
                                   <td>{{$value->auth_a}}</td>
                                   <td>{{$value->auth_route}}</td>
                                   <td>{{$value->created_at}}</td>
                                   <td class="td-manage">
                                       <a title="编辑" href="{{ url('pack/admin/admin_auth_edit_view?auth_id='.$value->id) }}">
                                           <i class="layui-icon">&#xe642;</i>
                                       </a>
                                       @if ($value->auth_pid != 0)
                                       <a title="删除" onclick="member_del(this,'{{$value['id']}}')" href="javascript:;">
                                           <i class="layui-icon">&#xe640;</i>
                                       </a>
                                       @endif
                                   </td>
                               </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
               {{-- <div class="layui-card-body ">
                    <div class="page">
                        <div>
                            {{ $auth_list->links() }}
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>
    </div>
</div>
</body>
<script>
    layui.use(['laydate','form'], function(){
        var laydate = layui.laydate;
        var form = layui.form;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });

    /*用户-停用*/
    function member_stop(obj,id){
        layer.confirm('确认要停用吗？',function(index){

            if($(obj).attr('title')=='已启用'){
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type:"POST",
                    url: "{{url('pack/admin/admin_status_edit')}}",
                    data: {admin_id:id,admin_status:1},
                    dataType: "json",
                    success:function (data) {
                        if (data.code == 100) {
                            layer.msg(data.msg,{icon: 5,time:1000});
                            return;
                        }
                        //发异步把用户状态进行更改
                        $(obj).attr('title','已停用')
                        $(obj).find('i').html('&#xe62f;');

                        $(obj).parents("tr").find(".td-status").find('span').addClass('layui-btn-disabled').html('已停用');
                        layer.msg('已停用!',{icon: 5,time:1000});
                    }
                });

            }else{
                $.ajax({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    type:"POST",
                    url: "{{url('pack/admin/admin_status_edit')}}",
                    data: {admin_id:id,admin_status:0},
                    dataType: "json",
                    success:function (data) {
                        if (data.code == 100) {
                            layer.msg(data.msg,{icon: 5,time:1000});
                            return;
                        }
                        //发异步把用户状态进行更改
                        $(obj).attr('title','已启用')
                        $(obj).find('i').html('&#xe601;');

                        $(obj).parents("tr").find(".td-status").find('span').removeClass('layui-btn-disabled').html('已启用');
                        layer.msg('已启用!',{icon: 6,time:1000});
                    }
                });
            }

        });
    }

    /*用户-删除*/
    function member_del(obj,id){
        layer.confirm('确认要删除吗？',function(index){
            //发异步删除数据
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                type:"POST",
                url: "{{url('pack/admin/admin_auth_delete')}}",
                data: {auth_id:id},
                dataType: "json",
                success:function (data) {
                    if (data.code == 100) {
                        layer.msg(data.msg,{icon: 5,time:1000});
                        return;
                    }
                    $(obj).parents("tr").remove();
                    layer.msg('已删除!',{icon:1,time:1000});
                }
            });
        });
    }



    function delAll (argument) {

        var data = tableCheck.getData();

        layer.confirm('确认要删除吗？'+data,function(index){
            //捉到所有被选中的，发异步进行删除
            layer.msg('删除成功', {icon: 1});
            $(".layui-form-checked").not('.header').parents('tr').remove();
        });
    }
</script>
<script>var _hmt = _hmt || []; (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();</script>
</html>