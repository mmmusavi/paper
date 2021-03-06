<?php

namespace App\Http\Controllers;

use App\Paper;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('home');
    }
    public function ViewVolumePapers ($id){
        return view('volume' ,compact('id'));
    }
    public function ViewPaper ($id){
        $papers=\App\Paper::find($id);
//name and affiliation and email
        $authors=$papers->authors_order;
        $exploded_papers=explode(';',$authors);
        $arr_name=array();
        $arr_affiliation=array();
        $arr_email=array();
        foreach ($exploded_papers as $exploded_paper){
            if(!empty($exploded_paper)){
                $name_return=\App\User::find($exploded_paper);
                $last_name=$name_return->last_name;
                array_push($arr_name,$last_name);
                $affiliation_return=\App\PaperUser::where([
                    ['user_id', '=', $exploded_paper],
                    ['paper_id', '=', $id],
                ])->first();
                $affiliation_id=$affiliation_return->affiliation_id;
                $affiliation_name_return=\App\Affiliation::find($affiliation_id);
                $affiliation_name=$affiliation_name_return->name;
                array_push($arr_affiliation,$affiliation_name);
                $email=$affiliation_return->email;
                array_push($arr_email,$email);
            }

        }
//keyword
        $keyword=$papers->keywords_order;
        $exploded_keywords=explode('،',$keyword);
        $arr_keyword=array();
        foreach ($exploded_keywords as $exploded_keyword){
            if(!empty($exploded_keyword)) {
                $name_return = \App\Keyword::find($exploded_keyword);
                $keyword_name = $name_return->name;
                array_push($arr_keyword, $keyword_name);
            }
        }
//views
        $views=$papers->views;
//references
        $references=$papers->references;
//text
        $text=$papers->text;
        foreach ($references as $reference){
            $text=str_replace('['.$reference->find_id.']','<span class="ref_in_text" data-balloon-length="large" data-balloon="'.$reference->text.'" data-balloon-pos="up">['.ta_persian_num($reference->find_id).']</span>',$text);
        }
//figures
        $figures=$papers->figures;
        foreach ($figures as $figure){
            $text=str_replace('['.$figure->find_id.']','<div class="row figure-inline"><div class="col-md-3" style="text-align: center;"><a data-fancybox data-src="#figure'.$figure->id.'" href="javascript:;">برای مشاهده کلیک کنید</a></div><div class="col-md-9"><span class="bold">'.$figure->name.'.</span> '.$figure->caption.'</div></div><div style="display:none;" id="figure'.$figure->id.'"><div class="row" style="text-align: center; margin-bottom: 20px;"><span class="bold">'.$figure->name.'.</span> '.$figure->caption.'</div><div class="row" style="text-align: center; margin-bottom: 20px;"><img src="'.$figure->url.'" /></div><div class="row" style="text-align: center;"><p>'.$figure->desc.'</p></div></div>',$text);
        }
        return view('paper' ,compact(['papers','text','arr_affiliation','arr_name','arr_email','arr_keyword','views','references']));
    }

    //referees and about us and contact us
    public function RefIndex()
    {   $text=\App\Pages::first();
        return view('referees',compact('text'));
    }
    public function AboutIndex()
    {   $text=\App\Pages::first();
        return view('AboutUs',compact('text'));
    }
    public function ContactIndex()
    {   $text=\App\Pages::first();
        $contact=\App\Contact::all();
        return view('ContactUs',compact('text','contact'));
    }
    public function SendContact(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'num' => 'required|numeric',
            'txt' => 'required'
        ]);
        $contact = new \App\Contact();
        $contact->fill($request->all());
        $contact->save();
        \Session::flash('message','با موفقیت ارسال شد.');
        return redirect('ContactUs');
    }

    public function search(Request $request){
        $req=$request->search;
        $lastPapers=Paper::where('title','LIKE','%'.$req.'%')->orWhere('text','LIKE','%'.$req.'%')->orWhere('abstract','LIKE','%'.$req.'%')->orderBy('place','desc')->get();
        return view('search',compact(['lastPapers','req']));
    }
}
