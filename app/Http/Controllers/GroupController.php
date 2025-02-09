<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Validator;
use App\DataTables\GroupsDataTable;

class GroupController extends Controller
{
    private $table;

    public function __construct(Group $table) {
        $this->table = $table;
    }

    public function index(GroupsDataTable $dataTable)
    {
        return $dataTable->render('pages.group.index');
    }

    public function new()
    {
        return view('pages.group.new');
    }

    public function edit($id)
    {
        $data = $this->table->findOrFail($id);
        return view('pages.group.edit')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:3|unique:groups,code',
            'name' => 'required|min:3|unique:groups,name',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = $this->table->create($request->all());

        return redirect()->route('group.index')->with('success', 'Data saved successfully');
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:3|unique:groups,code,'.$request->id,
            'name' => 'required|min:3|unique:groups,name,'.$request->id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $store = $this->table->where('id', $request->id)->update([
            'name' => $request->name,
            'code' => $request->code,
        ]);

        return redirect()->route('group.index')->with('success', 'Data updated successfully');
    }

    public function destroy($id) {
        $data = $this->table->findOrFail($id);

        $destroy = $data->delete();

        return redirect()->route('group.index')->with('success', 'Data deleted successfully');
    }
}
