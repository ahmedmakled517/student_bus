@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>Unites</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">unites</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">unites <small></small></h3>

                    <form action="{{ route('dashboard.unites.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                    <a href="{{ route('dashboard.unites.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> unites</a>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if ($unites->count() > 0)

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach ($unites as $index=>$unite)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $unite->name }}</td>
                                    <td>
                                            <a href="{{ route('dashboard.unites.edit', $unite->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                            <form action="{{ route('dashboard.unites.destroy', $unite->id) }}" method="post" style="display: inline-block">
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
