<?php
namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
{
    $query = Contact::query();

    // Handle search functionality
    if ($request->has('search')) {
        $search = $request->query('search');
        $query->where('name', 'like', '%' . $search . '%')
              ->orWhere('email', 'like', '%' . $search . '%');
    }

    // Handle sorting functionality
    if ($request->has('sort')) {
        $sort = $request->query('sort');
        $query->orderBy($sort, 'asc');
    } else {
        $query->orderBy('name', 'asc');
    }

    // Paginate results
    $contacts = $query->paginate(10);

    // Pass data to the view with existing search and sort parameters
    return view('contacts.index', compact('contacts'));
}


    public function create()
    {
        return view('contacts.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts',
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        Contact::create($request->all());

        return redirect('/contacts')->with('success', 'Contact created successfully.');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.show', compact('contact'));
    }

    public function edit($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:contacts,email,'.$id,
            'phone' => 'nullable',
            'address' => 'nullable',
        ]);

        $contact = Contact::findOrFail($id);
        $contact->update($request->all());

        return redirect('/contacts')->with('success', 'Contact updated successfully.');
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect('/contacts')->with('success', 'Contact deleted successfully.');
    }
}
