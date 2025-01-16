<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $leads = Lead::paginate(10);
        // $leads = Lead::onlyTrashed()->get();
        $leads = Lead::withTrashed()->get();
        // dd($leads);
        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:leads',
            'phone' => 'required',
            'status' => 'required|in:New,Contacted,Qualified,Lost',
        ]);
    
        Lead::create($request->all());
           
        return redirect()->route('leads.index')->with('success', 'Lead created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lead $lead)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone' => 'required',
            'status' => 'required|in:New,Contacted,Qualified,Lost',
        ]);
    
        $lead->update($request->all());

           
        return redirect()->route('leads.index')->with('success', 'Lead updated successfully.');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $lead->delete();

      
    return redirect()->route('leads.index')->with('success', 'Lead deleted successfully.');

    }

    public function restore($id)
    {
        $lead = Lead::withTrashed()->findOrFail($id);
        $lead->restore();

        return redirect()->route('leads.index')->with('success', 'Lead restored successfully.');
    }

}
