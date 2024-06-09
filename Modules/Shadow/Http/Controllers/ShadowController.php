<?php

namespace Modules\Shadow\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Session;
use Redirect;

class ShadowController extends Controller
{
    public function switch($id)
    {
         $new_user=User::find( $id );
         Session::put( 'orig_user', Auth::id() );
         Auth::login( $new_user );
         return redirect('/dashboard');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function return()
    {
        $id=Session::pull('orig_user');
        $orig_user=User::find($id);
        Auth::login($orig_user);
        return redirect('/dashboard');
        
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('shadow::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('shadow::edit');
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
