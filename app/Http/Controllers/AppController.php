<?php

namespace App\Http\Controllers;

use App\Models\AppModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apps = AppModel::paginate(10);
        return view('pages.application-lists', compact('apps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('App-list.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request -> validate([
            'name' => [
                'required',
                'string',
                'max:200',
                'regex: /^[a-zA-Z0-9_\-\[\]\s]+$/',
                Rule::unique('app_models', 'name'),
        ],
        'code' => [
            'required',
            'string',
            'max:200',
            'regex: /^[a-zA-Z0-9_\-\[\]\s]+$/',
            Rule::unique('app_models', 'code'),
        ],
        ]);

        AppModel::create($request->only('name', 'code'));
        return redirect() -> route('apps') -> with('success', 'Create app successfully!');
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
    public function edit(string $id)
    {
        $app = DB::table('app_models') -> where('id', $id) -> first();

        return view('App-list.edit', compact('app'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $app = AppModel::find($id);
        $request -> validate([
            'name' => [
                'required',
                'string',
                'max:200',
                Rule::unique('app_models', 'name')->ignore($app->id),
            ],
            'code' => [
                'required',
                'string',
                'max:200',
                Rule::unique('app_models', 'code')->ignore($app->id),
            ],
        ]);

        if (!$app) {
        return redirect()
            ->route('apps')
            ->with('alert', 'App đã được xóa trước đó');
        }
        
        $app -> update($request -> only('name', 'code', 'updated_at'));
        return redirect() -> route('apps') -> with('success', 'Update app successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $app = AppModel::find($id);

        if (!$app) {
        return redirect()
            ->route('apps')
            ->with('alert', 'App đã được xóa trước đó');
        }
        
        $app -> delete();
        return redirect() -> route('apps') -> with('success', 'Delete app successfully!');
    }
}
