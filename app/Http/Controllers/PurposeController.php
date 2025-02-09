<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purpose;
use Validator;
use App\DataTables\PurposesDataTable;

class PurposeController extends Controller
{
    private $table;

    public function __construct(Purpose $table) {
        $this->table = $table;
    }

    public function index(PurposesDataTable $dataTable)
    {
        return $dataTable->render('pages.purpose.index');
    }

    public function new()
    {
        return view('pages.purpose.new');
    }

    public function edit($id)
    {
        $data = $this->table->findOrFail($id);
        return view('pages.purpose.edit')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:purposes,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = $this->table->create($request->all());

        return redirect()->route('purpose.index')->with('success', 'Data saved successfully');
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|unique:purposes,name,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = $this->table->where('id', $request->id)->update([
            'name' => $request->name,
        ]);

        return redirect()->route('purpose.index')->with('success', 'Data updated successfully');
    }

    public function destroy($id) {
        $data = $this->table->findOrFail($id);

        $destroy = $data->delete();

        return redirect()->route('purpose.index')->with('success', 'Data deleted successfully');
    }
}
