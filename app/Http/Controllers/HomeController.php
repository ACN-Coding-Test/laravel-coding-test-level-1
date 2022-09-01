<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Source;
use App\Models\Artical;
use App\Models\UserComment;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $articalObj = new Artical;
        $description_for_layout = 'latest news in the world';
        $keywords_for_layout = 'latest news,news,world news';
        $title_for_layout = 'Home';

        $keyword = '';
        $latestArticals;
        if(!empty($request->search)){
            $keyword = $request->search;
            $search = '%'.$request->search.'%';
            $articalObj = $articalObj->where('title','like',$search);
            $latestArticals = $articalObj->take(3)->with('source')->get();
        }else{
            $latestArticals = $articalObj->take(3)->with('source')->inRandomOrder()->get();
        }

        $sources = Source::has('articals', '>=', 3)->inRandomOrder()->take(5)->get();
        $sourceArticals = array();
        foreach($sources as $source){
            $sourceArticals[$source->id] = Artical::where('source_id',$source->id)->take(3)->with('source')->orderBy('id','Desc')->get();
        }
       
        
        //

        return view('home.index',compact('keyword','latestArticals','sources','description_for_layout','keywords_for_layout','title_for_layout','sourceArticals'));
    }



    function sources(){
        $articalObj = new Artical;
        $description_for_layout = 'latest news in the world';
        $keywords_for_layout = 'latest news,news,world news';
        $title_for_layout = 'Sources And Articals List';
        $sources = Source::with('articals')->get();
        return view('home.sources',compact('sources','description_for_layout','keywords_for_layout','title_for_layout'));
    }

    function details(Artical $artical)
    {
        $description_for_layout = 'latest news in the world';
        $keywords_for_layout = 'latest news,news,world news';
        $title_for_layout = $artical->title;
        $source = Source::find($artical->source_id);
        $comments = $artical->comments()->with('user')->get();
        return view('home.details',compact('comments','artical','source','description_for_layout','keywords_for_layout','title_for_layout'));
    }

    function comment(Request $request,Artical $artical){
        $user = User::where('email',$request->email)->first();
        $userComment = new UserComment;
        if(!empty($user->id)){
            $userComment->user_id = $user->id;
        }else{
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $userComment->user_id = $user->id;
        }
        $userComment->comment = $request->message;
        $artical->comments()->save($userComment);
        return response('OK', 200);
    }
}