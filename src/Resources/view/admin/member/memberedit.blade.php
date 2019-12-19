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
                <form class="layui-form" method="post" action="{{url('pack/admin/admin_commit_edit')}}">
                    <input type="hidden" name="admin_id" value="{{$first_info['id']}}">
                    @csrf
                  <div class="layui-form-item">
                      <label for="username" class="layui-form-label">
                          <span class="x-red">*</span>登录名
                      </label>
                      <div class="layui-input-inline">
                          <input type="text" id="username" name="username" required="" lay-verify="required"
                          autocomplete="off" class="layui-input" value="{{$first_info['admin_name']}}">
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <span class="x-red"></span>将会成为您唯一的登入名
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label class="layui-form-label">
                          <span class="x-red">*</span>角色
                      </label>
                      <div class="layui-input-block">
                        <input type="checkbox" name="like1[write]" lay-skin="primary" title="超级管理员" checked="">
                        <input type="checkbox" name="like1[read]" lay-skin="primary" title="编辑人员">
                        <input type="checkbox" name="like1[write]" lay-skin="primary" title="宣传人员" checked="">
                      </div>
                  </div>
                  <div class="layui-form-item">
                      <label for="L_pass" class="layui-form-label">
                          <span class="x-red">*</span>密码
                      </label>
                      <div class="layui-input-inline">
                          <input type="password" id="L_pass" name="pass" lay-verify="pass"
                          autocomplete="off" class="layui-input" >
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          <a href="javascript:;" style="display: none;">
                              <img src="{{shop_asset('images/view.png')}}" title="隐藏密码" width='15'>
                          </a>
                          <a href="javascript:;" style="display: none;">
                            <img src="{{shop_asset('images/view_off.png')}}" title="显示密码" width='15'>
                          </a>
                      </div>
                      <div class="layui-form-mid layui-word-aux">
                          6到16个字符
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
                      <button  class="layui-btn layui-btn-normal w100" lay-filter="add" lay-submit="">
                          修改
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
                    // pass: [/(.+){6,12}$/, '密码必须6到12位'],
                    // repass: function(value) {
                    //     if ($('#L_pass').val() != $('#L_repass').val()) {
                    //         return '两次密码不一致';
                    //     }
                    // }
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
