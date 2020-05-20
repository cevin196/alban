@extends('layouts.app')
@section('style')
<style>
    span > a{
        font-size : large;
    }
    .lihat{
        color: green;
    }
    .edit{
        color: orange;
    }
    .hapus{
        color: red;
    }
    
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
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
                                <li class="active">List Nota</li>
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
                            <strong class="card-title">Tabel List Nota</strong>
                            <a href="{{route('nota.create')}}" class="btn btn-success btn-sm float-right">Tambah</a> 
                        </div>
                        <input class="form-control" id="myInput" type="text" placeholder="Cari sesuatu...">
                                <div class="table-stats order-table ov-h">
                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th class="serial">#</th>
                                                <th class="avatar">Make</th>
                                                <th>Unit Plat Number</th>
                                                <th>Attn</th>
                                                <th>Tanggal</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @foreach ($notas as $nota)    
                                            <tr>
                                                <td class="serial">{{$loop->index+1}}</td>
                                                <td>{{$nota->make}}</td>
                                                <td>{{$nota->unit_plat_number}}</td>
                                                <td>{{$nota->attn}}</td>
                                                <td>{{$nota->tanggal}}</td>
                                                <td>
                                                    <span><a class="lihat" href="#" data-toggle="tooltip" data-placement="top" title="lihat"><i class="fa fa-eye"></i></a></span>
                                                    <span><a class="edit" href="#" data-toggle="tooltip" data-placement="top" title="edit"><i class="fa fa-edit"></i></a></span>
                                                    <span><a class="hapus" href="#" data-toggle="tooltip" data-placement="top" title="hapus"><i class="fa fa-trash"></i></a></span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {!! $notas->appends(['sort' => 'votes'])->links() !!}
                                </div> <!-- /.table-stats -->
                    </div>
                </div>
            </div>
</div><!-- .animated -->
</div><!-- .content -->

<div class="clearfix"></div>
    
@endsection

@section('local-stuff')
<script>
    $(document).ready(function(){
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
    });
</script>
@endsection