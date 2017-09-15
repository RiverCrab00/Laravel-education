<?php

namespace App\Http\Controllers\Admin;


use App\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Lesson;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use DB;
class LessonController extends Controller
{
    public function index(Request $request){
        if($request->isMethod('get')){
            return view('admin.lesson.index');
        }elseif ($request->isMethod('post')){
            $offset=$request->input('start');
            $limit=$request->input('length');
            $id=$request->input('order.0.column');
            $order=$request->input("columns.{$id}.data");
            $orderway=$request->input('order.0.dir');
            $datemax=$request->input('datemax');
            $datemin=$request->input('datemin');
            $title=$request->input('title');
            $data=Lesson::orderBy($order,$orderway)
                ->with(['course'=>function($c){$c->with('profession');}])
                ->where('lesson_name','like',"%{$title}%")
                ->where(function ($query) use($datemin,$datemax){
                    if($datemin!=''){
                        $query->where('create_at','>=',$datemin);
                    }
                    if($datemax!=''){
                        $query->where('create_at','>=',$datemax);
                    }
                })
                ->offset($offset)->limit($limit)->get();
            $count=Lesson::where('lesson_name','like',"%{$title}%")
                ->where(function ($query) use($datemin,$datemax){
                    if($datemin!=''){
                        $query->where('create_at','>=',$datemin);
                    }
                    if($datemax!=''){
                        $query->where('create_at','<=',$datemax);
                    }
                })
                ->count();
            $info=[
                'draw'=>$request->input('draw'),
                'recordsTotal'=>$count,
                'recordsFiltered'=>$count,
                'data'=>$data,
            ];
            return $info;
        }
    }
    public  function status(Request $request,Lesson $lesson){
        $res = $lesson->update(['status'=>$request->input('status')]);
        if($res){
            return ['info'=>1];
        }else {
            return ['info'=>0];
        }
    }
    public function add(Request $request){
        if($request->isMethod('get')){
            $course=DB::table('course')->pluck('course_name','id');
            return view('admin/lesson/add',compact('course'));
        }elseif($request->isMethod('post')){
            $rules=[
                'lesson_name'=>'required',
                'course_id'=>'required|integer',
                'lesson_length'=>'required|integer|min:10',
                'lesson_desc'=>'required'
            ];
            $msgs=[
              'lesson_name.required'=>'课时名称不能为空',
              'course_id.required'=>'所属课程未选择',
              'course_id.integer'=>'所属课程非法',
              'lesson_length.required'=>'课时时长不能为空',
              'lesson_length.min'=>'课时时长要大于10分钟',
              'lesson_desc.required'=>'课时描述不能为空',
            ];
            $validator=Validator::make($request->all(),$rules,$msgs);
            if($validator->passes()){
                Lesson::create($request->all());
                return ['info'=>1];
            }else{
                //未通过验证,把错误传递到视图中去
                $error=collect($validator->messages())->implode('0',',');
                return ['info'=>0,'error'=>$error];
            }
        }
    }
    public function update(Request $request,Lesson $lesson){
        if($request->isMethod('get')){
            $course=Course::pluck('course_name','id');
            return view('admin.lesson.update',compact('lesson','course'));
        }elseif ($request->isMethod('post')){
            $rules=[
                'lesson_name'=>'required',
                'course_id'=>'required|integer',
                'lesson_length'=>'required|integer|min:10',
                'lesson_desc'=>'required'
            ];
            $msgs=[
                'lesson_name.required'=>'课时名称不能为空',
                'course_id.required'=>'所属课程未选择',
                'course_id.integer'=>'所属课程非法',
                'lesson_length.required'=>'课时时长不能为空',
                'lesson_length.min'=>'课时时长要大于10分钟',
                'lesson_desc.required'=>'课时描述不能为空',
            ];
            $validator=Validator::make($request->all(),$rules,$msgs);
            if($validator->passes()){
                if($lesson->cover_img!=$request->input('cover_img')){
                    $filename=$lesson->cover_img;
                    $filename=str_replace('/storage/','',$filename);
                    Storage::disk('public')->delete($filename);
                }
                if($lesson->video_address!=$request->input('video_address')){
                    $filename=$lesson->video_address;
                    $filename=str_replace('/storage/','',$filename);
                    Storage::disk('public')->delete($filename);
                }
                $lesson->update($request->all());
                return ['info'=>1];
            }else{
                //未通过验证,把错误传递到视图中去
                $error=collect($validator->messages())->implode('0',',');
                return ['info'=>0,'error'=>$error];
            }
        }
    }
    public function del(Request $request,Lesson $lesson){
        $filename=$lesson->cover_img;
        if($filename!=''){
            $filename=str_replace('/storage/','',$filename);
            Storage::disk('public')->delete($filename);
        }
        $filename=$lesson->video_address;
        if($filename!=''){
            $filename=str_replace('/storage/','',$filename);
            Storage::disk('public')->delete($filename);
        }
        $res=$lesson->delete();
        if($res){
            return ['info'=>1];
        }else{
            return ['info'=>0];
        }
    }
    public function batchdel(Request $request){
        $ids=$request->input('ids');
        Lesson::whereIn('id',$ids)->get()->each(function($item){
           $filename=$item->cover_img;
           if($filename!=''){
               $filename=str_replace('/storage/','',$filename);
               Storage::disk('public')->delete($filename);
           }
            $filename=$item->video_address;
            if($filename!=''){
                $filename=str_replace('/storage/','',$filename);
                Storage::disk('public')->delete($filename);
            }
            $item->delete();
        });
        return ['info'=>1];
    }
    public function upvideo(Request $request){
        $file=$request->file('Filedata');
        if($file->isValid()){
            $filename = $file->store('video/'.date('Y/m/d'),'public');
            return '/storage/'.$filename;
        }
    }
    public function upimg(Request $request){
        $file=$request->file('Filedata');
        if($file->isValid()){
            $filename = $file->store('img/'.date('Y/m/d'),'public');
            return '/storage/'.$filename;
        }
    }
    public function play(Request $request,Lesson $lesson){
        return view('admin.lesson.play',compact('lesson'));
    }
}
