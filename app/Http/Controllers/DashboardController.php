<?php

namespace App\Http\Controllers;

use App\Paper;
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
        $papers=\App\Paper::orderBy('place','desc')->get();
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
            'pdf' => 'max:8000|mimes:pdf',
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
            if(empty($author[$i]) or $author[$i]==0){
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
            if(empty($affiliation[$i]) or $affiliation[$i]==0){
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
            $checkkeyword=\App\Keyword::where('name',$keyword)->first();
            if(count($checkkeyword)>0){
                $keywords_order.=$checkkeyword->id.';';
                array_push($keywords_id,$checkkeyword->id);
            }else {
                $newkeyword = new \App\Keyword;
                $newkeyword->name = $keyword;
                $newkeyword->save();
                $newkeyword_id = $newkeyword->id;
                $keywords_order .= $newkeyword_id . ';';
                array_push($keywords_id, $newkeyword_id);
            }
        }
        $paper->authors_order=$authors_order;
        $paper->keywords_order=$keywords_order;
        $paper->abstract=$request->abstract;
        $paper->volume_id=$request->volume_id;
        $paper->page=$request->page;
        $paper->price=$request->price;
        $paper->save();
        $paper->place=$paper->id;
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
        if($request->hasFile('pdf')) {
            $extention = $request->file('pdf')->extension();
            $request->file('pdf')->storeAs('PaperFiles', $paper->id . '.' . $extention);
        }
        return redirect('/dashboard/papers');
    }

    public function DeletePaper($id){
        \App\Paper::destroy($id);
        return redirect('/dashboard/papers');
    }

    public function EditPaperShow($id){
        $paper=\App\Paper::find($id);
        $authors=$paper->users;
        foreach ($authors as $user){
            $aff=\App\Affiliation::find($user->pivot->affiliation_id);
            $user->affiliation=$aff->name;
            $user->email=$user->pivot->email;
        }
        $keywords='';
        $allkeywords=explode(';',$paper->keywords_order);
        foreach ($allkeywords as $allkeyword){
            if(!empty($allkeyword)){
                $key=\App\Keyword::find($allkeyword);
                $keywords.=$key->name.';';
            }
        }
        $volumes=\App\Volume::all();
        return view('dashboard.editpaper',compact(['paper','id','volumes','authors','keywords']));
    }

    public function PaperUp($id){
        $volume=\App\Paper::find($id);
        $greater=\App\Paper::where('place','>',$volume->place)->orderBy('place','asc')->first();
        if(count($greater)==1){
            $new=$greater->place;
            $old=$volume->place;
            $volume->place=$new;
            $greater->place=$old;
            $volume->save();
            $greater->save();
        }
        return redirect('/dashboard/papers');
    }

    public function PaperDown($id){
        $volume=\App\Paper::find($id);
        $least=\App\Paper::where('place','<',$volume->place)->orderBy('place','desc')->first();
        if(count($least)==1){
            $new=$least->place;
            $old=$volume->place;
            $volume->place=$new;
            $least->place=$old;
            $volume->save();
            $least->save();
        }
        return redirect('/dashboard/papers');
    }

    public function EditPaper(Request $request,$id){

        $this->validate($request, [
            'title' => 'required',
            'keywords' => 'required',
            'abstract' => 'required',
            'volume_id' => 'required',
        ]);

        $paper=\App\Paper::find($id);

        $authornew=$request->authornew;
        $author=$request->author;
        $email=$request->email;
        $affiliationnew=$request->affiliationnew;
        $affiliation=$request->affiliation;
        $users_id=[];
        $affiliations_id=[];
        $authors_order='';

        for($i=0;$i<=sizeof($email)-1;$i++){
            if(empty($author[$i]) or $author[$i]==0){
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
            if(empty($affiliation[$i]) or $affiliation[$i]==0){
                $aff=new \App\Affiliation;
                $aff->name=$affiliationnew[$i];
                $aff->save();
                array_push($affiliations_id,$aff->id);
            }else{
                array_push($affiliations_id,$affiliation[$i]);
            }
        }

        $keywords = explode(";", $request->keywords);
        $keywords_order='';
        $keywords_id=[];
        foreach ($keywords as $keyword){
            $checkkeyword=\App\Keyword::where('name',$keyword)->first();
            if(count($checkkeyword)>0){
                $keywords_order.=$checkkeyword->id.';';
                array_push($keywords_id,$checkkeyword->id);
            }else{
                $newkeyword=new \App\Keyword;
                $newkeyword->name=$keyword;
                $newkeyword->save();
                $newkeyword_id=$newkeyword->id;
                $keywords_order.=$newkeyword_id.';';
                array_push($keywords_id,$newkeyword_id);
            }
        }

        $paper->title=$request->title;
        $paper->authors_order=$authors_order;
        $paper->keywords_order=$keywords_order;
        $paper->abstract=$request->abstract;
        $paper->volume_id=$request->volume_id;
        $paper->page=$request->page;
        $paper->price=$request->price;
        $paper->save();

        \App\PaperKeyword::where('paper_id',$id)->delete();

        foreach ($keywords_id as $keyword){
            $newkeyword=new \App\PaperKeyword;
            $newkeyword->paper_id=$paper->id;
            $newkeyword->keyword_id=$keyword;
            $newkeyword->save();
        }

        \App\PaperUser::where('paper_id',$id)->delete();

        for($i=0;$i<=sizeof($email)-1;$i++){
            $paperUser=new \App\PaperUser;
            $paperUser->paper_id=$paper->id;
            $paperUser->user_id=$users_id[$i];
            $paperUser->affiliation_id=$affiliations_id[$i];
            $paperUser->email=$email[$i];
            $paperUser->save();
        }

        if($request->hasFile('pdf')){
            $extention=$request->file('pdf')->extension();
            $request->file('pdf')->storeAs('PaperFiles',$id.'.'.$extention);
        }

        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/papers/edit/'.$id);
    }

    //
    //
    // VOLUMES
    //
    //
    public function volumesList(){
        $volumes=\App\Volume::orderBy('place','desc')->get();
        return view('dashboard.volumes',compact('volumes'));
    }

    public function NewVolumeShow(){
        $cats=\App\VolumeCat::all();
        return view('dashboard.newvolume',compact('cats'));
    }

    public function NewVolumePost(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $volume=new \App\Volume;
        $volume->name=$request['name'];
        $volume->cat=$request['cat'];
        $volume->desc=$request['desc'];
        $volume->save();
        $volume->place=$volume->id;
        $volume->save();

        return redirect('/dashboard/volumes');
    }

    public function DeleteVolume($id){
        $papers=\App\Volume::find($id)->papers;
        if(count($papers)==0){
            \App\Volume::destroy($id);
        }
        return redirect('/dashboard/volumes');
    }

    public function EditVolumeShow($id){
        $cats=\App\VolumeCat::all();
        $volume=\App\Volume::find($id);
        return view('dashboard.newvolume',compact(['volume','id','cats']));
    }

    public function VolumeUp($id){
        $volume=\App\Volume::find($id);
        $greater=\App\Volume::where('place','>',$volume->place)->orderBy('place','asc')->first();
        if(count($greater)==1){
            $new=$greater->place;
            $old=$volume->place;
            $volume->place=$new;
            $greater->place=$old;
            $volume->save();
            $greater->save();
        }
        return redirect('/dashboard/volumes');
    }

    public function VolumeDown($id){
        $volume=\App\Volume::find($id);
        $least=\App\Volume::where('place','<',$volume->place)->orderBy('place','desc')->first();
        if(count($least)==1){
            $new=$least->place;
            $old=$volume->place;
            $volume->place=$new;
            $least->place=$old;
            $volume->save();
            $least->save();
        }
        return redirect('/dashboard/volumes');
    }

    public function EditVolume(Request $request,$id){

        $this->validate($request, [
            'name' => 'required',
        ]);

        $volume=\App\Volume::find($id);
        $volume->name=$request['name'];
        $volume->cat=$request['cat'];
        $volume->desc=$request['desc'];
        $volume->save();
        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/volumes/edit/'.$id);
    }

    //
    //
    // VOLUME_CAT
    //
    //
    public function volumeCatList(){
        $volumes=\App\VolumeCat::orderBy('place','desc')->get();
        return view('dashboard.volumecat',compact('volumes'));
    }

    public function NewvolumeCatShow(){
        return view('dashboard.newvolumecat');
    }

    public function NewvolumeCatPost(Request $request){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $volume=new \App\VolumeCat();
        $volume->name=$request['name'];
        $volume->save();
        $volume->place=$volume->id;
        $volume->save();

        return redirect('/dashboard/volumeCat');
    }

    public function DeletevolumeCat($id){
        $papers=\App\VolumeCat::find($id)->volumes;
        if(count($papers)==0){
            \App\VolumeCat::destroy($id);
        }
        return redirect('/dashboard/volumeCat');
    }

    public function EditvolumeCatShow($id){
        $volume=\App\VolumeCat::find($id);
        return view('dashboard.newvolumecat',compact(['volume','id']));
    }

    public function VolumeCatUp($id){
        $volume=\App\VolumeCat::find($id);
        $greater=\App\VolumeCat::where('place','>',$volume->place)->orderBy('place','asc')->first();
        if(count($greater)==1){
            $new=$greater->place;
            $old=$volume->place;
            $volume->place=$new;
            $greater->place=$old;
            $volume->save();
            $greater->save();
        }
        return redirect('/dashboard/volumeCat');
    }

    public function VolumeCatDown($id){
        $volume=\App\VolumeCat::find($id);
        $least=\App\VolumeCat::where('place','<',$volume->place)->orderBy('place','desc')->first();
        if(count($least)==1){
            $new=$least->place;
            $old=$volume->place;
            $volume->place=$new;
            $least->place=$old;
            $volume->save();
            $least->save();
        }
        return redirect('/dashboard/volumeCat');
    }

    public function EditvolumeCat(Request $request,$id){

        $this->validate($request, [
            'name' => 'required',
        ]);

        $volume=\App\VolumeCat::find($id);
        $volume->name=$request['name'];
        $volume->save();
        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/volumeCat/edit/'.$id);
    }

    //
    //
    // AFFILIATIONS
    //
    //
    public function AffiliationsList(){
        $affiliations=\App\Affiliation::all();
        return view('dashboard.affiliations',compact('affiliations'));
    }

    public function DeleteAffiliation($id){
        $papers=\App\Affiliation::find($id)->papers;
        if(count($papers)==0){
            \App\Affiliation::destroy($id);
        }
        return redirect('/dashboard/affiliations');
    }

    public function EditAffiliationShow($id){
        $affiliation=\App\Affiliation::find($id);
        return view('dashboard.editaffiliation',compact('affiliation'));
    }

    public function EditAffiliation(Request $request,$id){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $affiliation=\App\Affiliation::find($id);
        $affiliation->name=$request['name'];
        $affiliation->save();
        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/affiliations/edit/'.$id);
    }

    //
    //
    // KEYWORDS
    //
    //
    public function KeywordsList(){
        $keywords=\App\Keyword::all();
        return view('dashboard.keywords',compact('keywords'));
    }

    public function DeleteKeyword($id){
        $papers=\App\Keyword::find($id)->papers;
        if(count($papers)==0){
            \App\Keyword::destroy($id);
        }
        return redirect('/dashboard/keywords');
    }

    public function EditKeywordShow($id){
        $keyword=\App\Keyword::find($id);
        return view('dashboard.editkeyword',compact('keyword'));
    }

    public function EditKeyword(Request $request,$id){
        $this->validate($request, [
            'name' => 'required',
        ]);

        $keyword=\App\Keyword::find($id);
        $keyword->name=$request['name'];
        $keyword->save();
        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/keywords/edit/'.$id);
    }

    //
    //
    // USERS
    //
    //
    public function UsersList(){
        $users=\App\User::all();
        return view('dashboard.users',compact('users'));
    }

    public function DeleteUser($id){
        $users=\App\User::find($id)->papers;
        if(count($users)==0){
            \App\User::destroy($id);
        }
        return redirect('/dashboard/users');
    }

    public function EditUserShow($id){
        $user=\App\User::find($id);
        return view('dashboard.edituser',compact('user'));
    }

    public function EditUser(Request $request,$id){
        $this->validate($request, [
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
        ]);

        $user=\App\User::find($id);
        $user->last_name=$request['last_name'];
        $user->email=$request['email'];
        $user->save();
        \Session::flash('message','با موفقیت ویرایش شد.');
        return redirect('/dashboard/users/edit/'.$id);
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
        if($users->count()>0){
            foreach ($users as $user){
                $string.='<a href="#" class="instant_link user_select" 
                data-email="'.$user->email.'"
                data-name="'.$user->first_name.' '.$user->last_name.'"
                data-number="'.$request->number.'"
                data-userid="'.$user->id.'">'.$user->first_name.' '.$user->last_name.' ('.$user->email.')</a>';
            }
        }else $string.='<a href="#" class="instant_link user_select" data-number="'.$request->number.'" data-userid="0">موردی پیدا نشد. ایجاد شود؟</a>';
        return $string;
    }

    public function GetAffiliation(Request $request){
        $affiliations=\App\Affiliation::where("name", "LIKE","%".$request->value."%")->get();

        $string='';
        if($affiliations->count()>0){
            foreach ($affiliations as $affiliation){
                $string.='<a href="#" data-number="'.$request->number.'" class="instant_link affiliation_select" data-affiliationid="'.$affiliation->id.'">'.$affiliation->name.'</a>';
            }
        }else $string.='<a href="#" data-number="'.$request->number.'" class="instant_link affiliation_select" data-affiliationid="0">موردی پیدا نشد. ایجاد شود؟</a>';
        return $string;
    }
    //edit referees and about

    public function pageIndex(){
        $page =\App\Pages::first();
        if(count($page)==0){
            $page='';
        }
        return view('dashboard.pages',compact('page'));
    }
    public function EditPage(Request $request)
    {
    $check_page= \App\Pages::all();
    if (count($check_page)==0){
        $page = new \App\Pages();
        $page->fill($request->all());
        $page->save();
    }
    else {
        $page =\App\Pages::first();
        $page->fill($request->all());
        $page->save();
    }

        return redirect('/dashboard/pages');
    }
  //referees and about us
    public function RefIndex()
    {   $text=\App\Pages::first();
        return view('referees',compact('text'));
    }
}

