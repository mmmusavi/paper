<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','isadmin']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.index');
    }

    //
    //
    //PAPERS
    //
    //
    public function papersList(){
        $papers=\App\Paper::all();
        return view('dashboard.papers',compact('papers'));
    }

    public function NewPaperShow(){
        $volumes=\App\Volume::all();
        return view('dashboard.newpaper',compact('volumes'));
    }

    public function NewPaperPost(Request $request){
        $this->validate($request, [
            'title' => 'required',
            'keywords' => 'required',
            'abstract' => 'required',
            'volume_id' => 'required',
            'pdf' => 'required|max:8000|mimes:pdf',
        ]);

        $authornew=$request->authornew;
        $author=$request->author;
        $email=$request->email;
        $affiliationnew=$request->affiliationnew;
        $affiliation=$request->affiliation;
        $users_id=[];
        $affiliations_id=[];
        $authors_order='';

        for($i=0;$i<=sizeof($email)-1;$i++){
            if(empty($author[$i])){
                $user=new \App\User;
                $user->last_name=$authornew[$i];
                $user->email=$email[$i];
                $user->save();
                $authors_order.=$user->id.';';
                array_push($users_id,$user->id);
            }else{
                $authors_order.=$author[$i].';';
                array_push($users_id,$author[$i]);
            }
            if(empty($affiliation[$i])){
                $aff=new \App\Affiliation;
                $aff->name=$affiliationnew[$i];
                $aff->save();
                array_push($affiliations_id,$aff->id);
            }else{
                array_push($affiliations_id,$affiliation[$i]);
            }
        }

        $paper=new \App\Paper;
        $paper->title=$request->title;

        $keywords = explode(";", $request->keywords);
        $keywords_order='';
        $keywords_id=[];
        foreach ($keywords as $keyword){
            $newkeyword=new \App\Keyword;
            $newkeyword->name=$keyword;
            $newkeyword->save();
            $newkeyword_id=$newkeyword->id;
            $keywords_order.=$newkeyword_id.';';
            array_push($keywords_id,$newkeyword_id);
        }
        $paper->authors_order=$authors_order;
        $paper->keywords_order=$keywords_order;
        $paper->abstract=$request->abstract;
        $paper->volume_id=$request->volume_id;
        $paper->save();

        foreach ($keywords_id as $keyword){
            $newkeyword=new \App\PaperKeyword;
            $newkeyword->paper_id=$paper->id;
            $newkeyword->keyword_id=$keyword;
            $newkeyword->save();
        }

        for($i=0;$i<=sizeof($email)-1;$i++){
            $paperUser=new \App\PaperUser;
            $paperUser->paper_id=$paper->id;
            $paperUser->user_id=$users_id[$i];
            $paperUser->affiliation_id=$affiliations_id[$i];
            $paperUser->email=$email[$i];
            $paperUser->save();
        }

        $extention=$request->file('pdf')->extension();
        $request->file('pdf')->storeAs('PaperFiles',$paper->id.'.'.$extention);

        return redirect('/dashboard/papers');
    }

    public function DeletePaper($id){
        \App\Paper::destroy($id);
        return redirect('/dashboard/papers');
    }

    public function EditPaperShow($id){
        $papers=\App\Paper::find($id);
        $volumes=\App\Volume::all();
        return view('dashboard.newpaper',compact(['papers','id','volumes']));
    }

    public function EditPaper(Request $request,$id){

        $this->validate($request, [
            'title' => 'required',
        ]);

        $paper=\App\Paper::find($id);
        $paper->fill($request->all());
        $paper->save();
        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/papers/edit/'.$id);
    }

    //
    //
    // VOLUMES
    //
    //
    public function volumesList(){
        $volumes=\App\Volume::all();
        return view('dashboard.volumes',compact('volumes'));
    }

    public function NewVolumeShow(){
        return view('dashboard.newvolume');
    }

    public function NewVolumePost(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $volume=new \App\Volume;
        $volume->name=$request['name'];
        $volume->save();

        return redirect('/dashboard/volumes');
    }

    public function DeleteVolume($id){
        \App\Volume::destroy($id);
        return redirect('/dashboard/volumes');
    }

    public function EditVolumeShow($id){
        $volume=\App\Volume::find($id);
        return view('dashboard.newvolume',compact(['volume','id']));
    }

    public function EditVolume(Request $request,$id){

        $this->validate($request, [
            'name' => 'required',
        ]);

        $volume=\App\Volume::find($id);
        $volume->name=$request['name'];
        $volume->save();
        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/volumes/edit/'.$id);
    }

    //
    //
    // AJAX
    //
    //
    public function GetProfile(Request $request){
        $users=\App\User::where("first_name", "LIKE","%".$request->value."%")
            ->orWhere("last_name", "LIKE","%".$request->value."%")
            ->get();

        $string='';
        if($users->count()){
            foreach ($users as $user){
                $string.='<a href="#" class="instant_link user_select" 
                data-email="'.$user->email.'"
                data-name="'.$user->first_name.' '.$user->last_name.'"
                data-number="'.$request->numer.'"
                data-userid="'.$user->id.'">'.$user->first_name.' '.$user->last_name.' ('.$user->email.')</a>';
            }
        }else $string.='موردی پیدا نشد';
        return $string;
    }

    public function GetAffiliation(Request $request){
        $affiliations=\App\Affiliation::where("name", "LIKE","%".$request->value."%")->get();

        $string='';
        if($affiliations->count()>0){
            foreach ($affiliations as $affiliation){
                $string.='<a href="#" class="instant_link affiliation_select" data-affiliationid="'.$affiliation->id.'">'.$affiliation->name.'</a>';
            }
        }else $string.='موردی پیدا نشد';
        return $string;
    }
}
