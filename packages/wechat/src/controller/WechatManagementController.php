<?php

namespace Hugostech\Wechat\Controller;

use Hugostech\Wechat\Facade\Wechat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WechatManagementController extends Controller
{
    public function index(){
        return view('wechat::console.index');
    }
}
