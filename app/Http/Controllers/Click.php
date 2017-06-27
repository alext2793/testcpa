<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClickModel;
use App\Models\BadDomains;
use Datatables;

class Click extends Controller
{
    public function index(Request $request)
    {
        $hash = $request->param1.''.$request->server('REMOTE_ADDR').''.$request->server('HTTP_USER_AGENT').''.$request->server('HTTP_REFERER');
        $hash = hash('tiger128,3',$hash);
        $bad_domain = 0;
        $timeout = false;
        if ($request->server('HTTP_REFERER')) {
            if(BadDomains::where('name','=',$request->server('HTTP_REFERER'))->first()){
                $bad_domain = 1;
                $timeout = true;
            }
        }
        if($item = ClickModel::where('click_id','=',$hash)->first()){
            $item->error += 1;
            $item->bad_domain = $bad_domain;
            $item->save();
            $type = 'error';
        }else{
            $item = new ClickModel;
            $item->click_id = $hash;
            $item->ua = $request->server('HTTP_USER_AGENT');
            $item->ip = $request->server('REMOTE_ADDR');
            $item->ref = $request->server('HTTP_REFERER') ? $request->server('HTTP_REFERER'):'' ;
            $item->param1 = $request->param1;
            $item->param2 = $request->param2;
            $item->error = $bad_domain == 1 ? 1:0;
            $item->bad_domain = $bad_domain;
            $item->save();
            $type = 'success';
        }
        if ($bad_domain == 1) {
            return redirect()->route('error', ['click_id' => $hash])->with('timeout',true);
        }else{
            return redirect()->route($type, ['click_id' => $hash])->with('timeout',false);
        }
    }
    public function getListItems()
    {
        return Datatables::of(ClickModel::all())->escapeColumns(['click_id'])->make(true);
    }
    public function getBad()
    {
        return Datatables::of(BadDomains::all())->escapeColumns(['name'])->make(true);
    }
    public function storebad(Request $request)
    {
        $item = new BadDomains;
        $item->name = $request->name;
        $item->save();
        return redirect()->route('bad')->withFlashSuccess('успешно');
    }
}
