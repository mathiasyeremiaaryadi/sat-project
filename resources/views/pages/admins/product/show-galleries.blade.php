@extends('layouts.admins.default')

@section('admin-content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Gambar {{ $product->name }}</h1>

@if(session('alert-not-found'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Peringatan!</strong> {{ session('alert-not-found') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('alert-delete-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-delete-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('alert-update-success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Berhasil!</strong> {{ session('alert-update-success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if(session('alert-update-failed'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Gagal!</strong> {{ session('alert-update-failed') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Gambar Produk</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($galleries as $gallery)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gallery->product->code }}</td>
                        <td>{{ $gallery->product->name }}</td>
                        <td>
                            <img src="{{ url('storage/' . $gallery->gallery_path) }}" alt="{{ $gallery->product->name }}" class="img-thumbnail" style="width: 200px; height: 180px">
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admins.product-galleries.update-status', ['product_gallery' => $gallery->id]) }}" method="post" class="d-inline">
                                @csrf
                                @method('put')

                                <input type="hidden" name="status" value="{{ $gallery->status }}">
                                <input type="hidden" name="product_id" value="{{ $gallery->product_id }}">
                                
                                @if($gallery->status == 0) 
                                <input type="hidden" name="active" value="1">
                                <button type="submit" class="btn btn-secondary">
                                    Aktifkan Gambar
                                @else
                                <input type="hidden" name="active" value="0">
                                <button type="submit" class="btn btn-success">
                                    Non-Aktifkan Gambar
                                @endif
                                </button>
                            </form>
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admins.product-galleries.destroy', ['product_gallery' => $gallery->id]) }}" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin menghapus data ini?')">
                            @csrf
                            @method('delete')

                                <button type="submit" class="btn btn-danger">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

