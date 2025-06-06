<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'category', 'image_path'];

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

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
