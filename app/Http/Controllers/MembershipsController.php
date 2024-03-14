<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;

class MembershipsController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        // return $memberships;
        return view('memberships', ['memberships' => $memberships]);
    }

    public function create(Request $request)
    {
        $membership = new Membership;
        $membership->name = $request->name;
        $membership->price = $request->price;
        $membership->save();

        return redirect('/memberships');
    }

    public function show($id)
    {
        $membership = Membership::findOrFail($id);
        return view('memberships', ['memberships' => $memberships]);
    }

    public function update(Request $request, $id)
    {
        $membership = Membership::findOrFail($id);
        $membership->name = $request->name;
        $membership->price = $request->price;
        $membership->save();

        return redirect('/memberships');
    }

    public function destroy($id)
    {
        $membership = Membership::findOrFail($id);
        $membership->delete();

        return redirect('/memberships');
    }
}
