<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\Category;
use App\Models\Group;
use App\Models\Location;
use App\DataTables\AssetsDataTable;
use Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class AssetController extends Controller
{
    private $table;

    public function __construct(Asset $table) {
        $this->table = $table;
    }

    public function index(AssetsDataTable $dataTable)
    {
        return $dataTable->render('pages.asset.index');
    }

    public function new()
    {
        $categories = Category::where('category_id', null)->pluck('code', 'id');
        $subcategories = Category::whereNotNull('category_id')->pluck('code', 'id');
        $groups = Group::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');

        return view('pages.asset.new')->with([
            'categories' => $categories,
            'subcategories' => $subcategories,
            'groups' => $groups,
            'locations' => $locations
        ]);
    }

    public function edit($id)
    {
        $data = $this->table->findOrFail($id);
        $categories = Category::where('category_id', null)->pluck('code', 'id');
        $subcategories = Category::whereNotNull('category_id')->pluck('code', 'id');
        $groups = Group::pluck('name', 'id');
        $locations = Location::pluck('name', 'id');

        return view('pages.asset.edit')->with([
            'data' => $data,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'groups' => $groups,
            'locations' => $locations
        ]);
    }

    public function detail($id)
    {
        $data = $this->table->findOrFail($id);
        return view('pages.asset.detail')->with([
            'data' => $data
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:3',
            'name' => 'required|min:3',
            'condition' => 'required',
            'begin_stock' => 'required',
            'price' => 'required',
            'photo' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'group_id' => 'required',
            'location_id' => 'required',
            'unit' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $path = $request->file('photo')->store('assets','public');

        $store = $this->table->create([
            'code' => $request->code,
            'name' => $request->name,
            'condition' => $request->condition,
            'begin_stock' => $request->begin_stock,
            'out_stock' => 0,
            'end_stock' => $request->begin_stock,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'group_id' => $request->group_id,
            'location_id' => $request->location_id,
            'year' => date('Y'),
            'photo' => $path,
            'unit' => $request->unit
        ]);

        return redirect()->route('asset.index')->with('success', 'Data saved successfully');
    }

    public function update(Request $request) {
        $validator = Validator::make($request->all(), [
            'code' => 'required|min:3',
            'name' => 'required|min:3',
            'condition' => 'required',
            'begin_stock' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'group_id' => 'required',
            'location_id' => 'required',
            'unit' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                    ->withErrors($validator);
        }

        $asset = $this->table->findOrFail($request->id);

        if($request->hasFile('photo')) {
            $path = $request->file('photo')->store('assets','public');
        } else {
            $path = $asset->photo;
        }

        $store = $this->table->where('id', $request->id)->update([
            'code' => $request->code,
            'name' => $request->name,
            'condition' => $request->condition,
            'begin_stock' => $request->begin_stock,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'group_id' => $request->group_id,
            'location_id' => $request->location_id,
            'year' => date('Y'),
            'photo' => $path,
            'unit' => $request->unit
        ]);

        return redirect()->route('asset.index')->with('success', 'Data saved successfully');
    }

    public function destroy($id) {
        $data = $this->table->findOrFail($id);

        $destroy = $data->delete();

        return redirect()->route('asset.index')->with('success', 'Data deleted successfully');
    }

    public function report()
    {
        $assets = $this->table->whereBetween('created_at', [
            now()->startOfMonth(),
            now()->endOfDay()
        ])->get();
        $pdf = Pdf::loadView('pdf.asset.monthly_report', ['assets' => $assets])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
