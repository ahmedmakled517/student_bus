@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>stock</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">stockes</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">stockes <small></small></h3>

                    <form action="{{ route('dashboard.stockes.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                    <a href="{{ route('dashboard.stockes.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> stockes</a>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($stockes->count() > 0)

                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>store</th>
                                <th>item</th>
                                <th>Qtn</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($stockes as $index=>$stock)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                       @foreach($stores as $store)
                                           @if($store->id == $stock->store_id)  
                                            <td>{{ $store->name }}</td>
                                           @endif 
                                       @endforeach 
                                       @foreach($items as $item)
                                           @if($item->id == $stock->item_id)  
                                            <td>{{ $item->name }}</td>
                                           @endif 
                                       @endforeach 
                                        <td>{{ $stock->qtn }}</td>
                                        <td>
                                            <a href="{{ route('dashboard.stockes.edit', $stock->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            <form action="{{ route('dashboard.stockes.destroy', $stock->id) }}" method="post" style="display: inline-block">
                                                {{ csrf_field() }}
                                                {{ method_field('delete') }}
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i>Delete</button>
                                            </form><!-- end of form -->
                                        </td>
                                    </tr>
                                
                                @endforeach
                            </tbody>

                        </table><!-- end of table -->
                    @else
                        <h2>dont found any data</h2>
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
