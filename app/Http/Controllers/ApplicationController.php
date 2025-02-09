<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\ApplicationsDataTable;
use App\Models\Application;
use App\Models\ApplicationItem;
use App\Models\Purpose;
use App\Models\Employee;
use App\Models\Asset;
use Carbon\Carbon;
use Validator;
use Barryvdh\DomPDF\Facade\Pdf;

class ApplicationController extends Controller
{
    private $table;

    public function __construct(Application $table) {
        $this->table = $table;
    }

    public function index(ApplicationsDataTable $dataTable)
    {
        return $dataTable->render('pages.application.index');
    }

    public function new()
    {
        $purposes = Purpose::pluck('name', 'name');
        $employees = Employee::pluck('name', 'id');
        $assets = Asset::get();

        return view('pages.application.new')
            ->with([
                'purposes' => $purposes,
                'employees' => $employees,
                'assets' => $assets
            ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'purpose' => 'required',
            'requestor_id' => 'required',
        ]);
        $path = $request->file('photo')->store('assets','public');
        $application = Application::create([
            'application_no' => $this->table->generateApplicationNo(),
            'date' => Carbon::now()->format('Y-m-d'),
            'total_quantity' => 0,
            'purpose' => $request->purpose,
            'photo' => $path,
            'requestor_id' => $request->requestor_id
        ]);
        if($request->has('items') && count($request->items) > 0) {
            $total = 0;
            foreach($request->items as $item) {
                if(!isset($item['qty'])) {
                    return redirect()->back()->with('danger','Pastikan anda mengisi jumlah pada barang yang dipilih');
                }
                $total += $item['qty'];
                $asset = Asset::find($item['id']);

                if($asset->end_stock <= $item['qty']){
                    return redirect()->back()->with('danger','Stok '.$asset->name.' tidak cukup');
                }

                $asset->out_stock = $item['qty'];
                $asset->end_stock = $asset->begin_stock - $item['qty'];
                

                ApplicationItem::create([
                    'name' => $asset->name,
                    'unit' => $asset->unit,
                    'quantity' => $item['qty'],
                    'application_id' => $application->id
                ]);

                $asset->save();
            }

            $application->total_quantity = $total;
            $application->save();

            return redirect()->route('application.index')->with('success', 'Data saved successfully');
        }

        return redirect()->back()->with('danger','Mohon memilih barang minimal 1 barang');
        
    }

    public function detail($id)
    {
        $data = $this->table->findOrFail($id);
        return view('pages.application.detail')->with([
            'data' => $data
        ]);
    }

    public function approve($id) {
        $data = $this->table->findOrFail($id);
        $data->status = 'APPROVE';
        $store = $data->save();

        return redirect()->route('application.index')->with('success', 'Data approved successfully');
    }
    
    public function reject($id) {
        $data = $this->table->findOrFail($id);
        $data->status = 'REJECT';
        $store = $data->save();

        return redirect()->route('application.index')->with('success', 'Data rejected successfully');
    }

    public function dailyReport()
    {
        $applications = $this->table->whereDate('date', Carbon::now())->where('status','APPROVE')->get();
        $pdf = Pdf::loadView('pdf.application.daily_report', ['applications' => $applications])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }

    public function letter($id)
    {
        $application = $this->table->findOrFail($id);
        $pdf = Pdf::loadView('pdf.application.letter', ['application' => $application])->setPaper('a4', 'potrait');
        return $pdf->stream();
    }
}
