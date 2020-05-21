@extends('layouts.app')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>List Nota</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Nota</a></li>
                            <li class="active">Tambah Nota</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Tambah Nota Baru</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
                            <div class="row form-group">
                                <div class="col-md-3">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Kota :</label></div>
                                    <div class="col-12 col-md-11"><input type="text" name="kota" placeholder="Masukan Kota..." value="balikpapan" class="form-control"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Tanggal :</label></div>
                                    <div class="col-12 col-md-12"><input type="date" name="tanggal" class="form-control"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Kepada :</label></div>
                                    <div class="col-12 col-md-11"><input type="text" name="kepada" placeholder="kepada..." class="form-control"></div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Attn :</label></div>
                                    <div class="col-12 col-md-11"><input type="text" name="attn" placeholder="attn..." class="form-control"></div>
                                </div>
                            </div><br>
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Nomor Nota :</label></div>
                                    <div class="col-12 col-md-11"><input type="text" name="nomor_nota" placeholder="Masukan Nomor Nota..." value="Balikpapan" class="form-control"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Make :</label></div>
                                    <div class="col-12 col-md-11"><input type="date" name="make" placeholder="Masukan Nama Unit..." class="form-control"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Unit Plat Number :</label></div>
                                    <div class="col-12 col-md-11"><input type="text" name="unit_plat_number" placeholder="Masukan Unit Plat Number..." class="form-control"></div>
                                </div>
                                <div class="col-md-6">
                                    <div class="col col-md-12"><label for="text-input" class=" form-control-label">Unit Kilometer :</label></div>
                                    <div class="col-12 col-md-11"><input type="text" name="unit_kilometer" placeholder="Masukan Unit Kilometer..." class="form-control"></div>
                                </div>
                            </div>
                            <br>
                            <hr>
                            {{-- job --}}
                            <div class="row form-group">
                                <div id="satu" class="col-12 col-md-12 text-center"><h4><b>Job dan Job detail</b></h4></div><br><br>
                                

                            </div>
                            {{-- endjob --}}
                            
                        </form>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                        <button type="reset" class="btn btn-danger btn-sm">
                            <i class="fa fa-ban"></i> Reset
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('local-stuff')
<script>

</script>

@endsection
