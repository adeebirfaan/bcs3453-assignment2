<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * GET /customers
     *
     * Shows the customer table, 10 customers per page.
     * Filters are read from the URL (query string):
     *   /customers?gender=Male          -> only male customers
     *   /customers?gender=Female        -> only female customers
     *   /customers?birthday=after2000   -> only customers born after 2000
     * Both filters can be combined: /customers?gender=Female&birthday=after2000
     */
    public function index(Request $request)
    {
        // 1. Accept only the allowed filter values
        $request->validate([
            'gender'   => 'nullable|in:Male,Female',
            'birthday' => 'nullable|in:after2000',
        ]);

        $gender   = $request->input('gender');    // "Male", "Female" or null
        $birthday = $request->input('birthday');  // "after2000" or null

        // 2. Build the query. Each filter is added only when it was chosen.
        $customers = Customer::query()
            ->when($gender, fn ($query) => $query->gender($gender))                     // WHERE gender = 'Male'
            ->when($birthday === 'after2000', fn ($query) => $query->bornAfter(2000))   // WHERE YEAR(birthday) > 2000
            ->orderBy('name')
            ->paginate(10)        // 10 customers per page
            ->withQueryString();  // keep the filters in the page links

        // 3. Heading for the page, e.g. "Female customers born after 2000"
        $title = $gender ? "$gender customers" : 'All customers';
        if ($birthday === 'after2000') {
            $title .= ' born after 2000';
        }

        // 4. Send everything to the view
        return view('customers.index', [
            'customers' => $customers,
            'title'     => $title,
            'gender'    => $gender,
            'birthday'  => $birthday,
            'counts'    => [   // shown next to each option in the filter dropdowns
                'male'      => Customer::gender('Male')->count(),
                'female'    => Customer::gender('Female')->count(),
                'after2000' => Customer::bornAfter(2000)->count(),
            ],
        ]);
    }
}
