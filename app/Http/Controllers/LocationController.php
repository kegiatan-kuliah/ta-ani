<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use Validator;
use App\DataTables\LocationsDataTable;

class LocationController extends Controller
{
    private $table;

    public function __construct(Location $table) {
        $this->table = $table;
    }

    public function index(LocationsDataTable $dataTable)
    {
        return $dataTable->render('pages.location.index');
    }

    public function new()
    {
        return view('pages.location.new');
    }

    public function edit($id)
    {
        $data = $this->table->findOrFail($id);
        return view('pages.location.edit')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:3|unique:locations,code',
            'name' => 'required|min:3|unique:locations,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = $this->table->create($request->all());

        return redirect()->route('location.index')->with('success', 'Data saved successfully');
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:3|unique:locations,code,'.$request->id,
            'name' => 'required|min:3|unique:locations,name,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = $this->table->where('id', $request->id)->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('location.index')->with('success', 'Data updated successfully');
    }

    public function destroy($id) {
        $data = $this->table->findOrFail($id);

        $destroy = $data->delete();

        return redirect()->route('location.index')->with('success', 'Data deleted successfully');
    }
}
