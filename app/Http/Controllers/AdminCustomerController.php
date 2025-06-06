<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class AdminCustomerController extends Controller
{
    public function edit(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => $request->created_at,
        ]);

        return redirect()->back()->with('success', 'Customer updated successfully.');
    }

}
