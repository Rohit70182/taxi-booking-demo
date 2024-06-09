<?php

namespace Modules\Sms\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Modules\Sms\Entities\Gateway;

class GatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $gateways = Gateway::all();
        return view('sms::Gateway.index', compact('gateways'));

      
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function add()
    {
        return view('sms::Gateway.add');
    }
    
    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function details(Request $request)
    {
        $id = $request->id;
        $title = $request->title;
        return view('sms::Gateway.create', compact('id','title'));
       

    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        
        $validator = validator($request->all(), [
            'title' => 'required',
            'type_id' => 'required',
            'state_id' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $gateway = new Gateway();
        $gateway->type_id = $request->type_id;
        $gateway->state_id = $request->state_id;
        $gateway->title = $request->title;
        if($gateway->save()){
          
            return redirect()->route('gateway_details', ['id' => $gateway->id, 'title' => $gateway->title]);   

        } else {
            return redirect()->back();
        }
       
    }
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function account(Request $request)
    {
        
        $validator = validator($request->all(), [
            'twilio_account_sid' => 'required',
            'twilio_account_token' => 'required',
            'phone' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        } 
        $data = [
            'twilio_account_sid' => $request->twilio_account_sid,
            'twilio_account_token' => $request->twilio_account_token,
            'phone' => $request->phone
        ];
        
        $data = serialize($data);
       ;
        $gateway = Gateway::where('id', $request->id)->first();
        $gateway->value = $data;
        if($gateway->save()){
            return redirect('/sms/gateway/show/'.$gateway->id)->with('success', 'Gateway details added succesfully');
            
            
        } else {
            return redirect('/sms/gateway/show')->with('error', 'Gateway Details not saved');
        }
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        $gateways = Gateway::find($id);
      
        $value = unserialize($gateways->value);
        $sid = $value['twilio_account_sid'];
        $token =$value['twilio_account_token'];
        $phone =$value['phone'];
        
 
        return view('sms::Gateway.show', compact('gateways','sid','token','phone'));
        

    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $gateway=Gateway::where('id',$id)->first();
        $value = unserialize($gateway->value);
        $sid = $value['twilio_account_sid'];
        $token =$value['twilio_account_token'];
        $phone =$value['phone'];
        
        
        
        return view('sms::Gateway.edit', compact('gateway','sid','token','phone'));

    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
      
        try{
            
            $data = [
                'twilio_account_sid' => $request->twilio_account_sid,
                'twilio_account_token' => $request->twilio_account_token,
                'phone' => $request->phone   
            ];
            $data = serialize($data);
           
            $validator = validator($request->all(),
                [
                    'title'=>'required',
                    'twilio_account_sid'=>'required',
                    'twilio_account_token'=>'required',
                    'phone'=> 'required',
                   
                    
                ]);
            if ($validator->fails()) {
                return Redirect::back()->withInput()->withErrors($validator);
            }
                $update=Gateway::where('id', $id)->first();
                $update->title=$request->input('title');
                $update->state_id=$request->input('state_id');
                $update->value = $data;
                $update->state_id=$request->input('state_id');

                $update->save();
            
            if($update){
                return redirect('/sms/gateway/')->with('status',"Gateway details updated");
            }else{
                return redirect('sms/gateway/')->with('status',"Gateway details couldn't be updated");
            }
        }catch (\Exception $e) {
            return redirect()->back()->with($e->getMessage());
        }
    

    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $delete=Gateway::where('id',$id);
        $delete->delete();
        return redirect('/sms/gateway/')->with('success',"Gateway Details has been deleted");

    }
}
