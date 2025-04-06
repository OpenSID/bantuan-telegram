php
<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Group;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    /**
     * Display a listing of the FAQs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $faqs = FAQ::with('group')->get();
        $groups = Group::all();
        return view('faqs.index', compact('faqs', 'groups'));
    }

    /**
     * Show the form for creating a new FAQ.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $groups = Group::all();
        return view('faqs.create', compact('groups'));
    }

    /**
     * Store a newly created FAQ in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id', // Ensure the group_id exists in the groups table
            'question' => 'required|string|max:255', // Ensure the question is present, is a string, and is not too long
            'answer' => 'required|string', // Ensure the answer is present and is a string
        ]);
        
        FAQ::create($request->all());

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ created successfully.');
    }

    /**
     * Show the form for editing the specified FAQ.
     *
     * @param  \App\Models\FAQ  $faq
     * @return \Illuminate\View\View
     */
    public function edit(FAQ $faq)
    {
        $groups = Group::all();
        return view('faqs.edit', compact('faq', 'groups'));
    }

    /**
     * Update the specified FAQ in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FAQ  $faq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, FAQ $faq)
    {
        $validatedData = $request->validate([
            'group_id' => 'required|exists:groups,id', // Ensure the group_id exists in the groups table
            'question' => 'required|string|max:255', // Ensure the question is present, is a string, and is not too long
            'answer' => 'required|string', // Ensure the answer is present and is a string
        ]);
        
        $faq->update($request->all());

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ updated successfully.');
    }

    /**
     * Remove the specified FAQ from storage.
     *
     * @param  \App\Models\FAQ  $faq
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(FAQ $faq)
    {
        $faq->delete();

        return redirect()->route('faqs.index')
            ->with('success', 'FAQ deleted successfully.');
    }
}