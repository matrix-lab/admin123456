<?php

namespace App\Http\Controllers\API;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
        return [
            'code'  => 0,
            'msg'   => '',
            'count' => Customer::count('id'),
            'data'  => Customer::orderBy('id', 'DESC')->get(),
        ];
    }

    public function store(Request $request)
    {
        $request->offsetSet('customer_id', 0);

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
