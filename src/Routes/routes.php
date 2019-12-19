<?php
// 单元测试
Route::get('abc','Controller\QjunitController@index');
Route::post('commit','Controller\QjunitController@store')->name('qjunit.store');

/**
 * 后台路由
 */
Route::prefix('admin')->group(function () {
    // Admin\Index中的控制器，默认指向到Http目录
    Route::get('login', 'Admin\Login\LoginController@index')
        ->name('admin.Login.login');

    Route::post('commit_login', 'Admin\Login\LoginController@login')
        ->name('admin.Login.commit');
    // 退出登陆
    Route::get('loginout', 'Admin\Login\LoginController@loginout')
        ->name('admin.Login.loginout');

    // 后台首页
    Route::get('index','Admin\Index\IndexController@index')
        ->name('admin.index.index')
        ->middleware('admin_login');

    // 后台管理员列表
    Route::get('admin_list','Admin\Member\MemberController@adminList')
        ->name('admin.member.admin_list')
        ->middleware('admin_login');

    // 后台管理员编辑页面
    Route::get('admin_edit','Admin\Member\MemberController@adminEdit')
        ->name('admin.member.admin_edit')
        ->middleware('admin_login');

    // 提交编辑
    Route::post('admin_commit_edit', 'Admin\Member\MemberController@adminCommitEdit')
        ->middleware('admin_login');
    // 更改管理员状态
    Route::post('admin_status_edit', 'Admin\Member\MemberController@memberStatusEdit')
        ->middleware('admin_login');

    // 添加管理员页面
    Route::get('admin_member_add_view', 'Admin\Member\MemberController@memberAddView')
        ->name('admin.member.add.view')
        ->middleware('admin_login');
    // 提交添加管理员
    Route::post('admin_member_add', 'Admin\Member\MemberController@memberAdd')
        ->middleware('admin_login');

    // 权限列表
    Route::get('admin_auth_list', 'Admin\Auth\AuthController@authList')
        ->name('admin.auth_list')
        ->middleware('admin_login');

    // 权限添加页面
    Route::get('admin_auth_add_view','Admin\Auth\AuthController@authAddView')
        ->name('admin.auth_add_view')
        ->middleware('admin_login');

    // 权限添加操作
    Route::post('admin_auth_add','Admin\Auth\AuthController@authAdd')
        ->name('admin.auth_add')
        ->middleware('admin_login');
    // 权限编辑页面
    Route::get('admin_auth_edit_view','Admin\Auth\AuthController@authEditView')
        ->name('admin.auth_edit_view')
        ->middleware('admin_login');
    // 权限编辑操作
    Route::post('admin_auth_edit','Admin\Auth\AuthController@authEdit')
        ->name('admin.auth_edit')
        ->middleware('admin_login');
    // 权限删除
    Route::post('admin_auth_delete','Admin\Auth\AuthController@authDelete')
        ->name('admin.auth_delete')
        ->middleware('admin_login');

    // 角色列表
    Route::get('admin_role_list','Admin\Role\RoleController@roleList')
        ->name('admin.auth_list')
        ->middleware('admin_login');
    // 角色添加页面
    Route::get('admin_role_add_view','Admin\Role\RoleController@roleAddView')
        ->name('admin.role_add_view')
        ->middleware('admin_login');
});