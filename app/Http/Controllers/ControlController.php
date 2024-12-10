<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Models\Requirement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ControlController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {/*
        $framework = $request->input('framework');
        $code = $request->input('code');
        $priority = $request->input('priority');
        $category = $request->input('category');
        $sub_category = $request->input('sub_category');
        $description = $request->input('description');
        $function = $request->input('function');
        $asset_type = $request->input('asset_type');


        $query = Control::query();

        if ($framework) $query->where('framework', $framework);
        if ($code) $query->where('code', $code);
        if ($priority) $query->where('priority', $priority);
        if ($category) $query->where('category', $category);
        if ($sub_category) $query->where('sub_category', $sub_category);
        if ($description) $query->where('description', $description);
        if ($function) $query->where('function', $function);
        if ($asset_type) $query->where('asset_type', $asset_type);

*/

        //$user = Auth::user();

        // Filtra i controlli in base all'utente loggato
        $controls = Control::where('nis2_ref', 0)->get();
        $requirement = Requirement::first();

        /*
                $frameworks = Control::select('framework')->distinct()->pluck('framework');
                $codes = Control::select('code')->distinct()->pluck('code');
                $priorities = Control::select('priority')->distinct()->pluck('priority');
                $categories = Control::select('category')->distinct()->pluck('category');
                $sub_categories = Control::select('sub_category')->distinct()->pluck('sub_category');
                $descriptions = Control::select('description')->distinct()->pluck('description');
                $functions = Control::select('function')->distinct()->pluck('function');
                $asset_types = Control::select('asset_type')->distinct()->pluck('asset_type');


        /*      // Controlla se l'utente ha inviato il parametro 'crea-organizzazione'
                if ($request->has('crea-organizzazione')) {
                    // Se sì, restituisci la vista "organization.select-controls"
                    return view('organization.select-controls', compact('controls', 'frameworks', 'codes', 'priorities', 'categories','sub_categories', 'descriptions', 'functions', 'asset_types'));
                } else {
                   // Altrimenti, restituisci la vista "organization.my-controls"
                    return view('organization.my-controls', compact('controls', 'frameworks', 'codes', 'priorities', 'categories','sub_categories', 'descriptions', 'functions', 'asset_types'));
                }
        */
        return view('organization.my-controls', compact('controls', 'requirement'
            /*'frameworks', 'codes', 'priorities', 'categories','sub_categories', 'descriptions', 'functions', 'asset_types'
            */
        ));

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $frameworks = Control::distinct()->pluck('framework');
        $codes = Control::distinct()->pluck('code');

        return view('organization.create-control', compact('frameworks', 'codes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $data = request()->validate([
            'nis2_ref' => ['required', 'integer', 'max:255'],
            'framework' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'priority' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'sub_category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'function' => ['nullable', 'string', 'max:255'],
            'asset_type' => ['nullable', 'string', 'max:255'],
        ]);

        $control = Control::create($data);
        return redirect()->route('my-controls.index')
            ->with('success', __('strings.control-create-success'));
    }

    /**
     * Display the specified resource.
     */
    public function showData(Control $control)
    {
        return view('organization.show-control-data', compact('control'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $control = Control::find($id);
        return view('organization.edit-control', compact('control'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis2_ref' => ['required', 'integer', 'max:255'],
            'framework' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'priority' => ['nullable', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'sub_category' => ['nullable', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'function' => ['nullable', 'string', 'max:255'],
            'asset_type' => ['nullable', 'string', 'max:255'],
        ]);

        $control = Control::find($id);
        $control->update($request->all());
        return redirect()->route('my-controls.index')
            ->with('success', __('strings.control-update-success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $control = Control::find($id);
        $control->delete();
        return redirect()->route('my-controls.index')
            ->with('success', __('strings.control-delete-success'));
    }
}
