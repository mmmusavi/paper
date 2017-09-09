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
        return view('dashboard.newpaper');
    }

    public function NewPaperPost(Request $request){
        $this->validate($request, [
            'title' => 'required',
        ]);

        $paper=new \App\Paper;
        $paper->fill($request->all());
        $paper->save();

        return redirect('/dashboard/papers');
    }

    public function DeletePaper($id){
        \App\Paper::destroy($id);
        return redirect('/dashboard/papers');
    }

    public function EditPaperShow($id){
        $papers=\App\Paper::find($id);
        return view('dashboard.newpaper',compact(['papers','id']));
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
}
