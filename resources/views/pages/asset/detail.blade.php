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
          <a href="{{ route('asset.index') }}" class="btn btn-default btn-5 d-sm-inline-block">
            Kembali
          </a>
          <a href="{{ route('asset.edit', $data->id) }}" class="btn btn-primary btn-5 d-sm-inline-block">
            Sunting
          </a>
          <a href="{{ route('asset.destroy', $data->id) }}" class="btn btn-danger btn-5 d-sm-inline-block">
            Hapus
          </a>
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
            {{ html()->label('Kode', 'code')->class('form-label') }}
            <p>{{ $data->code }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Nama', 'name')->class('form-label') }}
            <p>{{ $data->name }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Kondisi', 'condition')->class('form-label') }}
            <p>{{ $data->condition }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Stok Awal', 'begin_stock')->class('form-label') }}
            <p>{{ $data->begin_stock }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Stok Keluar', 'out_stock')->class('form-label') }}
            <p>{{ $data->out_stock }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Stok Akhir', 'end_stock')->class('form-label') }}
            <p>{{ $data->end_stock }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Harga', 'price')->class('form-label') }}
            <p>{{ $data->price }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Deskripsi', 'description')->class('form-label') }}
            <p>{{ $data->description }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Kategori', 'category')->class('form-label') }}
            <p>{{ $data->category->code }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Sub Kategori', 'sub_category')->class('form-label') }}
            <p>{{ $data->sub_category->code }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Grup', 'group_id')->class('form-label') }}
            <p>{{ $data->group->name }} </p>
          </div>
          <div class="mb-3">
            {{ html()->label('Lokasi', 'location_id')->class('form-label') }}
            <p>{{ $data->location->name }} </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection