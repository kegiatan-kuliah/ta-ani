@extends('layouts.master')
@section('header')
<div class="page-header">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">{{ $data->code }}</h2>
      </div>
      <div class="col-auto ms-auto">
        <div class="btn-list">
          <a href="{{ route('application.index') }}" class="btn btn-default btn-5 d-sm-inline-block">
            Kembali
          </a>
          @if($data->status === 'WAITING')
            <a href="{{ route('application.approve', $data->id) }}" class="btn btn-primary btn-5 d-sm-inline-block">
              Setujui
            </a>
            <a href="{{ route('application.reject', $data->id) }}" class="btn btn-danger btn-5 d-sm-inline-block">
              Tolak
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')
<div class="row row-cards">
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-6">
          <img src="/storage/{{ $data->photo }}" alt="No Image" class="img-responsive" >
        </div>
        <div class="col-6">
          <div class="mb-3">
            {{ html()->label('No Permohonan', 'code')->class('form-label') }}
            <p>{{ $data->application_code }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Tanggal Permohonan', 'name')->class('form-label') }}
            <p>{{ $data->date }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Jumlah Barang', 'condition')->class('form-label') }}
            <p>{{ $data->total_quantity }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Jenis Keperluan', 'begin_stock')->class('form-label') }}
            <p>{{ $data->purpose }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Nama', 'out_stock')->class('form-label') }}
            <p>{{ $data->employee->name }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('NIP', 'end_stock')->class('form-label') }}
            <p>{{ $data->employee->identity_no }} </p>
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th></th>
                  <th>Nama</th>
                  <th>Satuan</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody id="renderData">
                @foreach($data->items as $index => $item)
                  <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->unit }}</td>
                    <td>{{ $item->quantity }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection