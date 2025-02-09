@extends('layouts.master')
@section('content')
<div class="page-header">
	<div class="container-xl">
		<div class="row g-2 align-items-center">
			<div class="col">
				<h2 class="page-title">Tambah Aset</h2>
			</div>
		</div>
	</div>
</div>

<div class="page-body">
	<div class="container-xl">
		<div class="row row-cards">
			{{ html()->form('POST', route('asset.update'))->attribute('enctype', 'multipart/form-data')->open() }}
        {{ html()->hidden('id', $data->id) }}
				<div class="card">
					<div class="card-body">
						<div class="mb-3">
							{{ html()->label('Kode', 'code')->class('form-label') }}
							{{ html()->input('text', 'code', $data->code)
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan kode') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Nama', 'name')->class('form-label') }}
							{{ html()->input('text', 'name', $data->name)
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan nama') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Kondisi', 'condition')->class('form-label') }}
							{{ html()->input('text', 'condition', $data->condition)
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan kondisi') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Satuan', 'unit')->class('form-label') }}
							{{ html()->input('text', 'unit', $data->unit)
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan satuan') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Stok Awal', 'begin_stock')->class('form-label') }}
							{{ html()->input('number', 'begin_stock', $data->begin_stock)
								->class('form-control')->attribute('required', true)
								->attribute('min', '1')
								->attribute('placeholder', 'Isikan stok awal') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Harga', 'price')->class('form-label') }}
							{{ html()->input('number', 'price', $data->price)
								->class('form-control')->attribute('required', true)
								->attribute('min', '1')
								->attribute('placeholder', 'Isikan harga') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Foto', 'photo')->class('form-label') }}
							{{ html()->file('photo')
								->class('form-control') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Deskripsi', 'description')->class('form-label') }}
							{{ html()->input('textarea', 'description', $data->description)
								->class('form-control')->attribute('required', true)
								->attribute('placeholder', 'Isikan deskripsi') }}
						</div>
            <div class="mb-3">
							{{ html()->label('Kategori ', 'category_id')->class('form-label') }}
							{{ html()->select('category_id', ['' => 'Pilih Kategori'] + $categories->toArray(), $data->category_id)
                  ->class('form-control')
                  ->attribute('required', true) }}
						</div>
            <div class="mb-3">
							{{ html()->label('Sub Kategori ', 'sub_category_id')->class('form-label') }}
							{{ html()->select('sub_category_id', ['' => 'Pilih Sub Kategori'] + $subcategories->toArray(), $data->sub_category_id)
                  ->class('form-control')
                  ->attribute('required', true) }}
						</div>
            <div class="mb-3">
							{{ html()->label('Grup', 'group_id')->class('form-label') }}
							{{ html()->select('group_id', ['' => 'Pilih Grup'] + $groups->toArray(), $data->group_id)
                  ->class('form-control')
                  ->attribute('required', true) }}
						</div>
            <div class="mb-3">
							{{ html()->label('Lokasi', 'location_id')->class('form-label') }}
							{{ html()->select('location_id', ['' => 'Pilih Lokasi'] + $locations->toArray(), $data->location_id)
                  ->class('form-control')
                  ->attribute('required', true) }}
						</div>
					</div>
					<div class="card-footer">
						<div class="d-flex justify-content-between">
							<a href="{{ route('asset.index') }}" class="btn btn-default">Kembali</a>
							{{ html()->button('Simpan')->class('btn btn-primary')->attribute('type', 'submit') }}
						</div>
					</div>
				</div>
			{{ html()->form()->close() }}
		</div>
	</div>
</div>

@endsection