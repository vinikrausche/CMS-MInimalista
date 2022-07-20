<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Visitor;
use App\Models\User;
use App\Models\Page;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request){
        $visitsCount = 0;
       // $visitsCount = Visitor::count();
        $pageCount = Page::count();
        $userCount = User::count();

        $interval = intval($request->input('dias',0));
        if($interval >120){
            $interval = 120;
        }
        $dateInterval = date('Y-m-a H:i:s',strtotime("-$interval days"));
        $visitsCount = Visitor::where('date_access','>=',$dateInterval)->count();
        

        $pagePie = [];
        
        $visitsAll = Visitor::selectRaw('page, count(page) as c')->where('date_access','>=',$dateInterval)->groupBy('page')->get();

        foreach($visitsAll as $visit){
            $pagePie[$visit['page']] = intval($visit['c']);
           
        }

         $labels = json_encode(array_keys($pagePie));
         $values = json_encode(array_values($pagePie));
         
        $dateLimit = date('Y-m-d H:i:s',strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('date_access','>=',$dateLimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);
        return view('admin.home',[
            'visits' => $visitsCount,
            'pages' => $pageCount,
            'users' => $userCount,
            'onlineCount' => $onlineCount,
            'labels' => $labels,
            'values' => $values,
            'interval' => $interval
        ]);
    }
    
}
