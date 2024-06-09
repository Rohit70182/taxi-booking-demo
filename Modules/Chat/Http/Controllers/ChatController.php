<?php

namespace Modules\Chat\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\User;
use Modules\Chat\Entities\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {  

        $userlist=User::where('id','!=',Auth::user()->id)->get();
       
        return view('chat::chat',compact('userlist'));
    }
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     * display chat between two users
     */

    public function chat(Request $request , $id)
    {      
        $messages = Chat::select('*')
        ->where('from_id','=',Auth::user()->id)
        ->where('to_id','=',$id)
        ->orWhere('from_id','=',$id)
        ->where('to_id','=',Auth::user()->id)
        ->get();
        
        $chat = Chat::select('*')
        ->where('from_id','=',$id)
        ->where('to_id','=',Auth::user()->id)
        ->update([
            'is_read' => Chat::READ_YES
         ]);
        
        $userlist=User::where('id','!=',Auth::user()->id)->get();
        
        return view('chat::chat',compact("messages","userlist"));
    
     } 
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request , $id)
    {
            $chat=new Chat();
            $chat->message=$request->input('message');
            $chat->from_id=Auth::id();
            $chat->to_id=$id;
            $chat->readers = Auth::id().','.$id;
            
            request()->validate([
                'file'  => 'mimes:doc,jpeg,jpg,png,docx,pdf,txt|max:2048',
            ]);
            
            if($request->file('file')){
                $file= $request->file('file');
                $filename= time(). '.' . $file->getClientOriginalExtension();;
                $file-> move('public/uploads', $filename);
                $chat->file = $filename;
              
            }
               if( $chat->save())
            {
                $data = [
                    'message'=> $chat->message,
                    'file' =>$chat->file,
                    'time'=> $chat->created_at,
                ];
               
              return $data;   
            }

    }
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     * sending request to get new messages if available
     */
    public function getMessage($id){

        $messages = Chat::select('*')
        ->where('from_id','=',$id)
        ->where('to_id','=',Auth::user()->id)
        ->where('is_read', Chat::READ_NO)
        ->latest()->first();
        
        $chat = Chat::select('*')
        ->where('from_id','=',$id)
        ->where('to_id','=',Auth::user()->id)
        ->update([
            'is_read' => Chat::READ_YES
        ]);
       
        $data = [];
        
        if($messages){
            $data = [
                'message' => $messages->message,
                'time' => $messages->created_at,
            ];
        }
        
        return $data;
        
       }
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('chat::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
