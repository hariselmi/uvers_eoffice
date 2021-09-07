<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{

    public function __construct(Article $article)
    {
        $this->middleware('auth');
        $this->article = $article;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $search = [];
            if(!empty($request->filter)) {
                $search = $request->filter;
                Session::put('article_filter', $search);
            } else if( Session::get('article_filter')) {
                $search = Session::get('article_filter');
            }
            $data['articles'] = $this->article->getAll('paginate', $search);
            return $this->sendCommonResponse($data, null, 'index');
        }

        $data['articles'] = $this->article->getAll('paginate');
        return view('article.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->all();
        $this->validator($input)->validate();
        $articles = new Article;
        $articles->saveArticle($input);
        
        return $this->sendCommonResponse($data=[], 'You have successfully added article', 'add');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $data['article'] = Article::find($id);
        return $this->sendCommonResponse($data, null, 'show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data['article'] = Article::find($id);
        return $this->sendCommonResponse($data, null, 'edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $imgNewName = $request->Oldthumbnail;

        if ($request->file('thumbnail')) {
            # code...

            $thumbnail =  $request->file('thumbnail');

            $nameGenerate = hexdec(uniqid());
            $imgName = strtolower($thumbnail->getClientOriginalName());
            $imgNewName = $nameGenerate.'_'.$imgName;
            $uploadLocation = public_path().'/images/article';
            # code...
            $thumbnail->move($uploadLocation,$imgNewName);
        }

        $article = (new Article())->getById($id);
        $article->category = $request->category;
        $article->date = $request->date;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->thumbnail = $imgNewName;
        $article->save();

        $data['article'] = $article;
        return $this->sendCommonResponse($data, 'You have successfully updated article', 'update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {
            $member = Article::find($id);
            $member->dlt = '1';
            $member->save();

            return $this->sendCommonResponse([], 'You have successfully deleted article', 'delete');
        } catch (\Illuminate\Database\QueryException $e) {
            return $this->sendCommonResponse([], ['danger'=>__('Integrity constraint violation: You Cannot delete a parent row')]);
        }
    }

    protected function validator(Array $data)
    {
        return Validator::make($data, [
            'thumbnail'=>'mimes:jpeg,bmp,png|max:5120kb',
            'category'=>'required',
            'date'=>'required'
        ]);
    }

    private function sendCommonResponse($data=[], $notify = '', $option = null) 
    {
        $articleObj = new Article();
        $response = $this->processNotification($notify);
        
        if ($option == 'add') {
            $response['replaceWith']['#addArticle'] = view('article.formadd', $data)->render();
        } else if ($option == 'edit' || $option == 'update') {
            $response['replaceWith']['#editArticle'] = view('article.formedit', $data)->render();
        } else if ($option == 'show') {
            $response['replaceWith']['#showArticle'] = view('article.profile', $data)->render();
        }
        if ( in_array($option, ['index', 'add', 'update', 'delete', 'import'])) {
            if (empty($data['articles'])) {
                $data['articles'] = $articleObj->getAll('paginate');
            }
            $response['replaceWith']['#articleTable'] = view('article.table', $data)->render();
        }
        return $this->sendResponse($response);
    }
}
