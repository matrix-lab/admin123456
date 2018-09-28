<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        return Customer::create($request->all());
    }

    public function update(Request $request, Customer $customer)
    {
        $customer->update($request->all());

        return $customer;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return $customer;
    }
}
