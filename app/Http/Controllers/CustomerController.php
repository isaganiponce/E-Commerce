<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;


class CustomerController extends Controller
{
    public function generateCustomerPDF()
    {
        $customers = Customer::all();
        $pdf = Pdf::loadView('pdf', compact('customers'));
        return $pdf->download('customer_report.pdf');
    }

    public function update(Request $request)
    {
        $customersData = $request->input('customers', []);

        foreach ($customersData as $id => $data) {
            $customer = Customer::find($id);
            if ($customer) {
                $customer->name = $data['name'];
                $customer->email = $data['email'];
                $customer->created_at = $data['created_at'];
                $customer->save();
            }
        }

        return redirect()->back()->with('success', 'Customer records updated successfully!');
    }

    public function bulkAction(Request $request)
    {
        if ($request->action === 'delete' && $request->has('delete_ids')) {
            Customer::whereIn('id', $request->delete_ids)->delete();
            return back()->with('success', 'Selected customers deleted.');
        }

        if ($request->action === 'update' && $request->has('customers')) {
            foreach ($request->customers as $id => $data) {
                Customer::where('id', $id)->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'created_at' => $data['created_at'],
                ]);
            }
            return back()->with('success', 'Changes saved.');
        }

        return back()->with('error', 'No action performed.');
    }

}