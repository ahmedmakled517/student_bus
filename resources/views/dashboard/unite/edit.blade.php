@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>unite</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('dashboard.unites.index') }}">unite</a></li>
                <li class="active">edit</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">edit</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.unites.update', $unite->id) }}" method="post" >

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>name</label>
                            <input type="text" required name="name" class="form-control" value="{{ $unite->name }}">
                        </div>
                        <div class="form-group">
                            <label>Type:- </label>
                            <select name="type" required style="width:200px" >
                            @if($unite->type == 0)
                                <option   selected   value="0">main</option>
                                <option   value="1">sup</option>
                            @else
                            <option      value="0">main</option>
                                <option selected  value="1">sup</option>
                           @endif
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i> edit</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
