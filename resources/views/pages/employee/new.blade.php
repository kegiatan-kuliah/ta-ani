@extends('layouts.master')
@section('content')
<div class="page-header">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<h2 class="page-title">Tambah Pegawai</h2>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="row row-cards">
			{{ html()->form('POST', route('employee.store'))->open() }}
				<div class="card">
					<div class="card-body">
						<div class="mb-3">
							{{ html()->label('Nama', 'name')->class('form-label') }}
							{{ html()->input('text', 'name')
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan nama') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Email', 'email')->class('form-label') }}
							{{ html()->input('email', 'email')
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan email') }}
						</div>
            <div class="mb-3">
							{{ html()->label('NIP', 'identity_no')->class('form-label') }}
							{{ html()->input('text', 'identity_no')
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan no nip') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Jenis Kelamin', 'gender')->class('form-label') }}
							{{ html()->select('gender', ['' => 'Pilih Jenis Kelamin', 'L' => 'Laki Laki', 'P' => 'Perempuan'])
                  ->class('form-control')
                  ->attribute('required', true) }}
						</div>
            <div class="mb-3">
							{{ html()->label('No HP', 'phone_no')->class('form-label') }}
							{{ html()->input('text', 'phone_no')
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan no hp') }}
						</div>
						<div class="mb-3">
							{{ html()->label('Hak Akses', 'role')->class('form-label') }}
							{{ html()->select('role', ['' => 'Pilih Hak Akses', 'guru' => 'Guru', 'tata usaha' => 'Tata Usaha'])
                  ->class('form-control')
                  ->attribute('required', true) }}
						</div>
            <div class="mb-3">
							{{ html()->label('Alamat', 'address')->class('form-label') }}
							{{ html()->input('textarea', 'address')
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan alamat') }}
						</div>
					</div>
					<div class="card-footer">
						<div class="d-flex justify-content-between">
							<a href="{{ route('employee.index') }}" class="btn btn-default">Kembali</a>
							{{ html()->button('Simpan')->class('btn btn-primary')->attribute('type', 'submit') }}
						</div>
					</div>
				</div>
			{{ html()->form()->close() }}
		</div>
	</div>
</div>

@endsection