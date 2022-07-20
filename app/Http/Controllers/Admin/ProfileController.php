<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class ProfileController extends Controller
{
    public function index(Request $request){
        $user = $request->user();
        return view('admin.users.profile',['user' => $user]);
    }

    public function save(Request $request){
        $loggedId = Auth::id();
        $user = User::find($loggedId);
        if($user){
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);
 
            $validator = Validator::make($data,[
                'name' => ['string','required','min:5','max:155'],
                'email' => ['string','required','min:5','max:155']
            ]);

            $validator->fails() ? $validator->errors($validator): false;

            $hasEmail = User::where('email',$data['email'])->get();
            if(count($hasEmail) === 0){
                $user->email = $data['email'];
            }elseif(count($hasEmail) > 0 && $data['email'] === $user->email){
                $user->email = $data['email'];
                
            }else{
                $validator->errors()->add('email',__('validation.unique',[
                    'attribute' => 'email'
                ]));
            }

           if(!empty($data['password'])){
                    if(intval($data['password']) === intval($data['password_confirmation']) && strlen(intval($data['password'])) >= 5){
                        $hash = addslashes($data['password']);
                        $user->password = Hash::make($hash);
                }else{
                    $validator->errors()->add('password',__('validation.confirmed',[
                        'attribute' => 'password'
                    ]));
                    $validator->errors()->add('password',__('validation.min.string',[
                        'attribute' => 'password',
                        'min' => 5
                    ]));
                    
                }
           }
            $user->name = addslashes($data['name']);

            if(count($validator->errors()) > 0){
                return redirect()->route('profile')
                ->withErrors($validator)
                ->withInput();
            }

            return redirect()->route('profile')
            ->with('success','Dados alterados com sucesso!');
        }
    }
}
