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
            <a href="#" class="btn btn-primary btn-2" data-bs-toggle="modal" data-bs-target="#modal-simple">
              Setujui
            </a>
            <a href="{{ route('application.reject', $data->id) }}" class="btn btn-danger btn-5 d-sm-inline-block">
              Tolak
            </a>
          @endif
          @if($data->status === 'APPROVE')
            <a href="{{ route('application.receipt', $data->id) }}" class="btn btn-primary btn-5 d-sm-inline-block">
              Cetak Tanda Terima Barang
            </a>
            <a href="{{ route('application.letter', $data->id) }}" class="btn btn-primary btn-5 d-sm-inline-block">
              Cetak SK
            </a>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-1 modal-dialog-centered" role="document">
    {{ html()->form('POST', route('application.approve'))->attribute('enctype', 'multipart/form-data')->open() }}
      {{ html()->hidden('id', $data->id) }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Setujui Permohonan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            {{ html()->label('Foto Penerimaan Barang', 'photo')->class('form-label') }}
            {{ html()->file('photo')
              ->class('form-control')->attribute('required', true) }}
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Save changes</button>
        </div>
      </div>
    {{ html()->form()->close() }}
	</div>
</div>

@endsection
@section('content')
<div class="row row-cards">
  <div class="card">
    <div class="card-body">
      <div class="row">
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
        @if($data->photo)
          <div class="col-6">
            <img src="/storage/{{ $data->photo }}" alt="No Image">
          </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection