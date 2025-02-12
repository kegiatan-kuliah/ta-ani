@extends('layouts.master')
@section('content')
<div class="page-header">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<h2 class="page-title">Tambah Permohonan</h2>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
  {{ html()->form('POST', route('application.store'))->attribute('enctype', 'multipart/form-data')->open() }}
	<div class="container-xl">
		<div class="row row-cards">
      <div class="card">
        <div class="card-body">
          <div class="mb-3">
            {{ html()->label('Jenis Keperluan', 'purpose')->class('form-label') }}
            {{ html()->select('purpose', ['' => 'Pilih Jenis Keperluan'] + $purposes->toArray())
                ->class('form-control') }}
          </div>
          <div class="mb-3">
            {{ html()->label('Pemohon', 'requestor_id')->class('form-label') }}
            {{ html()->select('requestor_id', ['' => 'Pilih Pemohon'] + $employees->toArray())
                ->class('form-control') }}
          </div>
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th></th>
                  <th>Nama</th>
                  <th>Jumlah</th>
                </tr>
              </thead>
              <tbody id="renderData">
                @foreach($assets as $index => $asset)
                  <tr>
                    <td>{{ html()->input('checkbox', 'items['.$index.'][id]', $asset->id) }}</td>
                    <td>{{ $asset->name }}</td>
                    <td>{{ html()->input('number', 'items['.$index.'][qty]')
                          ->class('form-control')
                          ->attribute('min', '1')
                          ->attribute('placeholder', 'Isikan jumlah') }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer">
          <div class="d-flex justify-content-between">
            <a href="{{ route('application.index') }}" class="btn btn-default">Kembali</a>
            {{ html()->button('Simpan')->class('btn btn-primary')->attribute('type', 'submit') }}
          </div>
        </div>
      </div>
    </div>
  </div>
  {{ html()->form()->close() }}
</div>

@endsection