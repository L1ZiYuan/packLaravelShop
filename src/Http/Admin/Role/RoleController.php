<?php

namespace Packs\LaravelShops\Http\Admin\Role;

use Packs\LaravelShops\Http\Controller\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Create a new channel instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function roleList()
    {
        return view('pack::admin/role/rolelist');
    }

    public function roleAddView()
    {
        echo 213;die;
//        return view()
    }


}
