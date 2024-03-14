<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Membership;
use App\Models\Payment;
use App\Models\User;

class PaymentsController extends Controller
{
    public function index(Request $request)
    {
        $showAll = $request->query('show_all');

        if ($showAll) {
            $payments = Payment::withTrashed()->get();
        } else {
            $payments = Payment::all();
        }

        $users = User::all();
        $memberships = Membership::all();

        return view('payments', ['users' => $users, 'payments' => $payments, 'memberships' => $memberships, 'showAll' => $showAll]);
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'memberships_id' => 'required|integer',
            'user_id' => 'required|integer',
        ]);

        $payment = new Payment;
        $payment->memberships_id = $request->memberships_id;
        $payment->user_id = $request->user_id;
        $payment->date = now();
        $payment->save();

        return redirect('/payments');
    }

    public function restore(string $id)
    {
        $payment = Payment::withTrashed()->findOrFail($id);
        $payment->restore();
    
        return redirect('/payments');
    }

    public function show(string $id)
    {
        $payment = Payment::findOrFail($id);
        return $payment;
        // return view('payments.show', ['payment' => $payment]);
    }

    public function paymentsByUser(string $user_id)
    {
        $showAll = false;
        $user = User::withTrashed()->findOrFail($user_id);
        $payments = Payment::where('user_id', $user_id)->withTrashed()->get();
        $memberships = Membership::all();
    
        return view('payments', ['users' => $user, 'payments' => $payments, 'memberships' => $memberships, 'showAll' => $showAll]);
    }      

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'memberships_id' => 'required|integer',
            'user_id' => 'required|integer',
            'date' => 'required|date',
        ]);

        $payment = Payment::findOrFail($id);
        $payment->memberships_id = $request->memberships_id;
        $payment->user_id = $request->user_id;
        $payment->date = $request->date;
        $payment->save();

        return redirect('/payments');
    }

    public function destroy(string $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->delete();

        return redirect('/payments');
    }
}