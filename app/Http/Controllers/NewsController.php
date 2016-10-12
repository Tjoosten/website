<?php

namespace App\Http\Controllers;

use App\News;
use App\Tags;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class NewsController
 *
 * @package   App\Http\Controllers
 * @author    Tim Joosten <Topairy@gmail.com>
 * @copyright Tim Joosten 2015 - 2016
 * @version   2.0.0
 */
class NewsController extends Controller
{
    /**
     * NewsController constructor. 
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('lang');
    }

    /**
     * [BACKEND]: Get the backend overview page. 
     *
     * @url:platform  GET|HEAD: /backend/news
     * @see:phpunit 
     * 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        // Item states: 
        // -----
        // 1 = publish 
        // 0 = draft. 

        $data['draft']   = News::where('state', 0)->get(); 
        $data['publish'] = News::where('state', 1)->get();
        $data['tags']    = Tags::all();

        return view('news.index', $data);
    }

    /**
     * [METHOD]: Store the news message in the database.
     * 
     * @url:platform 
     * @see:phpunit 
     * @see:phpunit
     * 
     * @param  Requests\NewsValidator $input
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store($input)
    {
        $create = News::create($input->except('_token')); 

        if ($create) // Can create  the news item.
        {
            session()->flash('class', 'alert alert-success');
            session()->flash('message', trans('flash-session.news-create')); 
        }

        return redirect()->back();
    }

    /**
     * [BACKEND]: Show a specific news item. 
     * 
     * @url:platform  GET|HEAD:
     * @see:phpunit
     * 
     * @param  int $id the news item id in the database. 
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function BackendShow($id)
    {
        $data['item'] = News::find($id);
        return view('', $data); 
    }
    
    /**
     * [BACKEND]: Edit view for a news message.
     * 
     * @url:platform
     * @see:phpunit
     * 
     * @param  String $id The news id in the database.
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id) 
    {
        $data['item'] = News::find($id);
        return view('', $data); 
    }
    
    /**
     * [METHOD]: Update a news message in the database.
     * 
     * @url:platform 
     * @see:phpunit 
     * @see:phpunit
     * 
     * @param  Requests\NewsValidator $input
     * @return \Illuminate\Http\RedirectResponse 
     */
    public function update(Requests\Newsvalidator $input, $id)
    {
        $update = News::findOrFail($id)->update($input->except('_token')); 
        
        if ($update) {
            session()->flash('class', 'alert alert-success'); 
            session()->flash('message', '');
        }
        
        return redirect()->back();
    }

    /**
     * [METHOD]: Set a news message to draft.
     * 
     * @url:platform 
     * @see:phpunit
     * 
     * @param  string $id the news item id in the database. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function draft($id)
    {
        if (News::findOrFail($id)->update(['state' => 0])) 
        {
            session()->flash('class', 'alert alert-success'); 
            session()->flash('message', trans('flash-session.new-draft')); 
        } 

        return redirect()->back();
    }
  
    /**
     * [METHOD]: Publish a news message form the draft status.
     * 
     * @see:platform 
     * @see:phpunit
     * 
     * @param  integer  $id the news item id in the database. 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function publish($id)
    {
        if (News::findOrFail($id)->update(['state' => 1])) 
        {
            session()->flash('class', 'alert alert-danger'); 
            session()->flash('message', trans('flash-session.news-publish'));
        }

        return redirect()->back();
    }

    /**
     * [METHOD]: Delete a news post.
     *
     * @url:platform  GET|HEAD: 
     * @see:phpunit
     *
     * @param  int $id The news post id in the database.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $destroy = News::findOrFail($id);
        $destroy->tags()->sync([]); 
        $destroy->delete();

        if ($destroy) // Check: can destroy a news item. 
        {
            session()->flash('class', 'alert alert-danger');
            session()->flash('message', trans('flash-session.news-destroy'));
        }

        return redirect()->back();
    }
}
