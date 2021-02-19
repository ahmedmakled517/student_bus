@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>items</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">items</li>
            </ol>
        </section>

        <section class="content">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">items <small></small></h3>
                    <form action="{{ route('dashboard.items.index') }}" method="get">
                        <div class="row">
                            <div class="col-md-4">
                                    <a href="{{ route('dashboard.items.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> items</a>
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box header -->

                <div class="box-body">
                    @if ($items->count() > 0)
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Main Unite</th>
                                <th>Main buy price</th>
                                <th>Main sel price</th>
                                <th>Sup Unite</th>
                                <th>Sup buy price</th>
                                <th>Sup sel price</th>
                                
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($items as $index=>$item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                   @foreach($unites as $unite) 
                                        @if($unite->id == $item->main_unite)
                                            <td>{{ $unite->name }}</td>
                                        @endif
                                   @endforeach 
                                    <td>{{ $item->m_buy_price }}</td>
                                    <td>{{ $item->m_sell_price }}</td>
                                    @foreach($unites as $unite) 
                                        @if($unite->id == $item->sup_unite)
                                            <td>{{ $unite->name }}</td>
                                        @endif
                                   @endforeach 
                                    <td>{{ $item->s_buy_price }}</td>
                                    <td>{{ $item->s_sell_price }}</td>
                                   
                                   
                                    <td>
                                            <a href="{{ route('dashboard.items.edit', $item->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            <form action="{{ route('dashboard.items.destroy', $item->id) }}" method="post" style="display: inline-block">
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
