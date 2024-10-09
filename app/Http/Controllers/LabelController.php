<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateLabelRequest;
use App\Models\Label;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LabelController extends Controller
{
    public function index(?Request $search = null)
    {
        return view('labels.index', [
            'labels' => Label::search($search)->paginate(10),
        ]);
    }

    public function show(Label $label)
    {
        return view('labels.show', [
            'label' => $label,
        ]);
    }

    public function store(CreateLabelRequest $request): RedirectResponse
    {
        Label::create([
            'name' => $request->validated('name'),
            'slug' => $request->validated('slug'),
            'is_visible' => $request->input('is_visible', 0),
        ]);

        return back()->with('success', 'Label created.');
    }

    public function edit(Label $label)
    {
        return view('labels.edit', [
            'label' => $label,
        ]);
    }

    public function update(Label $label)
    {
        //
    }

    public function destroy(Label $label)
    {
        //
    }
}
