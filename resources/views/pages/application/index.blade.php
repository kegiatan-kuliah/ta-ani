@extends('layouts.master')
@section('header')
<div class="page-header">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
      <div class="col">
        <h2 class="page-title">Permohonan</h2>
      </div>
      <div class="col-auto ms-auto">
        <div class="btn-list">
          <a href="#" class="btn btn-2" data-bs-toggle="modal" data-bs-target="#modal-simple">
            Cetak Laporan Periode
          </a>
          <a href="{{ route('application.daily_report') }}" target="__blank" class="btn btn-primary btn-5 d-sm-inline-block">
            Cetak Laporan Harian
          </a>
          <a href="{{ route('application.new') }}" class="btn btn-primary btn-5 d-sm-inline-block">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-2">
              <path d="M12 5l0 14"></path>
              <path d="M5 12l14 0"></path>
            </svg>
            Tambah Permohonan
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal modal-blur fade" id="modal-simple" tabindex="-1" style="display: none;" aria-hidden="true">
	<div class="modal-dialog modal-1 modal-dialog-centered" role="document">
    {{ html()->form('POST', route('application.report_period'))->open() }}
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cetak Data Period</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <input type="text" name="dates" class="form-control">
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
      <div class="table-responsive">
        {{ $dataTable->table() }}
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
    <script>
      $(document).ready(function() {
        $('input[name="dates"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="dates"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="dates"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
      })
    </script>
@endpush