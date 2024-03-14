<?php
namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

class InstructorsController extends Controller
{
    public function index(Request $request)
    {
        $showAll = $request->input('show_all', false);
    
        if ($showAll) {
            $instructors = Instructor::withTrashed()->get();
        } else {
            $instructors = Instructor::all();
        }
    
        return view('instructors', ['instructors' => $instructors, 'showAll' => $showAll]);
    }    

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'specialty' => 'required|max:75',
        ]);

        $instructor = new Instructor;
        $instructor->name = $request->name;
        $instructor->last_name = $request->last_name;
        $instructor->specialty = $request->specialty;
        $instructor->save();

        return redirect('/instructors');
    }

    public function restore(string $id)
    {
        $instructor = Instructor::withTrashed()->findOrFail($id);
        $instructor->restore();

        return redirect('/instructors');
    }

    public function show(string $id)
    {
        $instructor = Instructor::findOrFail($id);
        return $instructors;
        return view('instructors', ['instructor' => $instructor]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'specialty' => 'required|max:75',
        ]);

        $instructor = Instructor::findOrFail($id);
        $instructor->name = $request->name;
        $instructor->last_name = $request->last_name;
        $instructor->specialty = $request->specialty;
        $instructor->save();

        return redirect('/instructors');
    }

    public function destroy(string $id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();

        return redirect('/instructors');
    }
}