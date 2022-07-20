<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Setting;
use PhpParser\Node\Expr\Cast\Array_;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin-form');
    }

    public function index(){
      $settings = [];

      $dbSettings = Setting::get();

      foreach($dbSettings as $dbSetting){
          $settings[$dbSetting['name']] = $dbSetting['content'];
      }
        
        return view('admin.setting.index',[
         'settings' => $settings
        ]);
       
    }

    public function save(Request $request){
        $data = $request->only([
            'title',
            'subtitle',
            'bgcolor',
            'textcolor'
        ]);

        $validator = $this->validator($data);
        if($validator->fails()){
            return redirect()->route('settings')
            ->withErrors($validator);
        }


        //salvar
        foreach($data as $item => $value){
            Setting::where('name',$item)->update([
                'content' => $value
            ]);
        }


        return redirect()->route('settings')
        ->with('success','Os dados foram atualizados com sucesso!');

        
    }

    protected function validator(array $data){
        return Validator::make($data,[
            'title' =>    ['string','required','min:5','max:155'],
            'subtitle' => ['string','required','min:5','max:155'],
            'bgcolor' =>  ['string','regex:(\#[\da-f]{3}|\#[\da-f]{6}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))'],
            'textcolor' => ['string','regex:(\#[\da-f]{3}|\#[\da-f]{6}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))']
        ]);
    }

}
