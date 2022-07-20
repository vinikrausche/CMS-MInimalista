<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Page;

class PageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::paginate(10);
        return view('admin.pages.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['title','body']);

        $data['slug'] = Str::slug($data['title'],'-');

        $validator = $this->validator($data);

        if($validator->fails()){
            return redirect()->route('pages.create')
            ->withErrors($validator)
            ->withInput();
        }

        $page = new Page;
        $page->title = addslashes($data['title']);
        $page->slug = addslashes($data['slug']);
        $page->body = addslashes($data['body']);

        $page->save();
        return redirect()->route('pages.index')
        ->with('info','Página criada com sucesso!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $page = Page::find($id);

       return $page?view('admin.pages.edit',compact('page')):redirect()->route('pages.index');
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
        $page = Page::find($id);

        if($page){
            $data = $request->only(['title','body']);

            $validator = Validator::make($data,[
                'title' => ['string','required','min:5','max:155'],
                'body'  => ['string']
            ]);
            $page->title = $data['title'];
            $page->body = $data['body'];

            $validator->fails() ? $validator->errors($validator):false;

            $data['slug'] = Str::slug($data['title'],'-');

            $hasSlug = Page::where('slug',$data['slug'])->get();
            if(count($hasSlug) === 0 || $page->slug === $data['slug']){
               $page->slug = $data['slug'];
            }else{
                $validator->errors()->add('slug',__('validation.unique',[
                    'attribute' => 'slug'
                ]));
            }

            if(count($validator->errors()) > 0){
                return redirect()->route('pages.edit',['page' => $id])
                ->withErrors($validator)
                ->withInput();
            }

            $page->save();
            return redirect()->route('pages.index')
            ->with('info','Informações da página alteradas com sucesso');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $page = Page::find($id);

        if($page){
            $page->delete();
            return redirect()->route('pages.index')
            ->with('info','Página excluida com sucesso!');
        }

        return redirect()->route('pages.index')
        ->with('wrong','Página não encontrada');
    }

    protected function validator(array $data){
        return Validator::make($data,[
            'title' => ['string','required','max:155','min:5'],
            'body' => ['string'],
            'slug' => ['string','max:155','unique:pages']
        ]);
    }
}
