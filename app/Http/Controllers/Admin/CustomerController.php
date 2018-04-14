<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }
    /**
     * List all customers.
     * 
     * @return view
     */
    public function index()
    {
    	$customers=Customer::paginate(10);

    	return view('admin.customer',compact('customers'));
    }
}
