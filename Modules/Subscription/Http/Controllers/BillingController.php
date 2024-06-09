<?php

namespace Modules\Subscription\Http\Controllers;


use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Subscription\Entities\SubscriptionBilling;

class BillingController extends Controller
{
    
    public function index()
    {
        $billing=SubscriptionBilling::all();
        return view('subscription::billing.index',compact('billing'));
    }

    public function create()
    {
        return view('subscription::create');

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        return view('subscription::show');
    }

   
    public function edit($id)
    {
        return view('subscription::edit');

    }

  
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
        $delete=SubscriptionBilling::where('id',$id);
        if($delete->delete()){
            return redirect('subscription/billing/')->with('success',"Entry has been deleted");
        }
        else{
            return redirect('subscription/billing/')->with('error',"Entry couldn't be deleted");
        }
    }
}
