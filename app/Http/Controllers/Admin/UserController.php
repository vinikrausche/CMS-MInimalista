<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin-form');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $loggedId = intval(Auth::id());
        return view('admin.users.index',[
            'users' => $user,
            'loggedId' => $loggedId,
            
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['name','email','password','password_confirmation']);

        $rules = [
            'name' => ['string','max:155','required'],
            'email' => ['string','max:155','required','unique:users'],
            'password' => ['string','max:155','required','confirmed']
        ];

        $validator = Validator::make($data,$rules);

        if($validator->fails()){
            return redirect()->route('users.create')
            ->withErrors($validator)
            ->withInput();
        }

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

       return redirect()->route('users.index')
       ->with('success','Usuário criado com sucesso!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(!$user){
            return redirect()->route('users.index')
            ->with('warning','Usuário não encontrado');
        }
        return view('admin.users.show',['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $user = User::find($id);
       if($user){
            $data = $request->only(['name','email','password','password_confirmation']); 

            $validator = Validator::make($data,[
                'name' => ['string','min:5','max:155','required'],
                'email' => ['string','min:5','max:155','required']
            ]);

            if($validator->fails()){
                return redirect()->route('users.show',['user' => $id])
                ->withErrors($validator)
                ->withInput();
            }

            //validação do email
            $hasEmail = User::where('email',$data['email'])->get();
            if(count($hasEmail) === 0){
                $user->email = $data['email'];
            }else{
                $validator->errors()->add('email',__('validation.unique',[
                    'attribute' => 'email'
                ]));
            }

            if(!empty($data['password'])){
                if(strlen($data['password']) >= 5){
                    if($data['password'] === $data['password_confirmation']){
                       $user->password = $data['password'];
                    }else{
                        $validator->errors()->add('password',__('validation.confirmed',[
                            'attribute' => 'password'
                        ]));
                    }
                }else{
                    $validator->errors()->add('password',__('validation.min.string',[
                        'attribute' => 'password',
                        'min' => 5
                    ]));
                }
            }

            if(count($validator->errors()) > 0 ){
                return redirect()->route('users.show',['user' => $id])
                ->withErrors($validator)
                ->withInput();
            }


       }
        return redirect()->route('users.index')
        ->with('success','Dados atualizados com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $loggedId = intval(Auth::id());

        if($user){
           if($loggedId !== intval($id)){
                $user->delete();
                return redirect()
                ->route('users.index')
                ->with('deletado','Usuário deletado com sucesso!');
           }
        }else{
            return redirect()->route('users.index')
        ->with('warning','Usuário não encontrado');
        }


        return redirect()->route('users.index');
       
    }
}
