@extends('pack::admin.parent.parent')
<script type="text/javascript" src="{{ shop_asset('js/jquery.min.js')}}"></script>
<script src="{{ shop_asset('lib/layui/layui.js')  }}" charset="utf-8"></script>
<script src="{{ shop_asset('lib/layui/layui.all.js')  }}" charset="utf-8"></script>
@section('headercss')
    <link rel="stylesheet" type="text/css" href="{{ shop_asset('css/bootstrap.css')  }}" media="all">
@show
<style>
    .x-admin-sm .layui-form-checkbox span {
        font-size: 12px;
        height: auto;
    }
</style>
<body>
<div class="alert bg-info">
    <p class="bg-font">操作指南：</p>
    <ul type="circle" class="ul-list">
        <li>
            <i class="xing">*</i> 权限系统是每位后台产品产品经理绕不过去的问题，好的权限系统可以明确公司内不同人员、不同部门的分工，降低操作风险发生概率，便于管理等优势。
        </li>
        <li>
            <i class="xing">*</i> 好的权限系统可以明确公司内不同人员、不同部门的分工，降低操作风险发生概率，便于管理等优势。
        </li>
    </ul>
</div>
        <div class="layui-fluid">
            <div class="layui-row">
                <form class="layui-form" method="post" action="{{url('pack/admin/admin_auth_add')}}">
                    @csrf
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>权限名称
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="username" name="auth_name" required="" lay-verify="required"
                          autocomplete="off" class="layui-input" >
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red"></span>将会成为您唯一的登入名
                      </div>
                  </div>

                    <div class="layui-form-item">
                        <label for="username" class="layui-form-label">
                            <span class="x-red">*</span>上级权限
                        </label>
                        <div class="layui-input-inline">
                            <select name="auth_pid">
                                <option value="0"></option>
                                @foreach($auth_pid_list as $key => $value)
                                    <option value="{{$value->id}}">{{$value->auth_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span>如未选择，作为第一级权限
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label for="username" class="layui-form-label">
                            <span class="x-red">*</span>权限操作控制器
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="auth_c" name="auth_c" required="" value="0" lay-verify="required"
                                   autocomplete="off" class="layui-input" >
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span>例如：商品模块（GoodsController）
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label for="username" class="layui-form-label">
                            <span class="x-red">*</span>权限操作控制方法
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="auth_a" name="auth_a" required=""value="0" lay-verify="required"
                                   autocomplete="off" class="layui-input" >
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span>例如：商品模块的商品列表（GoodsList）
                        </div>
                    </div>

                    <div class="layui-form-item">
                        <label for="username" class="layui-form-label">
                            <span class="x-red">*</span>权限操作的路由
                        </label>
                        <div class="layui-input-inline">
                            <input type="text" id="auth_route" name="auth_route" required="" value="pack/" lay-verify="required"
                                   autocomplete="off" class="layui-input" >
                        </div>
                        <div class="layui-form-mid layui-word-aux">
                            <span class="x-red"></span>例如（admin/admin_auth_add_view）默认会再最前添加pack/
                        </div>
                    </div>

                    {{--<div class="layui-form-item">
                        <label class="layui-form-label">状态</label>
                        <div class="layui-input-block">
                            <input type="radio" name="admin_status" @if ($first_info['admin_status'] == 1) checked  @endif value="1" title="禁用">
                            <input type="radio" name="admin_status" @if ($first_info['admin_status'] == 0) checked  @endif value="0" title="启用" >
                        </div>
                    </div>--}}
                  <div class="layui-form-item">
                      <label for="L_repass" class="layui-form-label">
                      </label>
                      <button  	class="layui-btn layui-btn-normal w100" lay-filter="add" lay-submit="" >
                          添加
                      </button>
                  </div>
              </form>
            </div>
        </div>
        <script>layui.use(['form', 'layer'],
            function() {
                $ = layui.jquery;
                var form = layui.form,
                layer = layui.layer;

                //自定义验证规则
                form.verify({
                    nikename: function(value) {
                        if (value.length < 5) {
                            return '昵称至少得5个字符啊';
                        }
                    },
                    pass: [/(.+){6,12}$/, '密码必须6到12位'],
                    repass: function(value) {
                        if ($('#L_pass').val() != $('#L_repass').val()) {
                            return '两次密码不一致';
                        }
                    }
                });

                //监听提交
                form.on('submit(add)',
                function(data) {
                    console.log(data);
                    //发异步，把数据提交给php
                    layer.alert("增加成功", {
                        icon: 6
                    },
                    function() {
                        //关闭当前frame
                        xadmin.close();

                        // 可以对父窗口进行刷新 
                        xadmin.father_reload();
                    });
                    return false;
                });

            });</script>
        <script>var _hmt = _hmt || []; (function() {
                var hm = document.createElement("script");
                hm.src = "https://hm.baidu.com/hm.js?b393d153aeb26b46e9431fabaf0f6190";
                var s = document.getElementsByTagName("script")[0];
                s.parentNode.insertBefore(hm, s);
            })();</script>
    </body>

</html>
