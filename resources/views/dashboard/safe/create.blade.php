@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>safes</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('dashboard.safes.index') }}"> safes</a></li>
                <li class="active">add </li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">add store</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.safes.store') }}" method="post" >

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="name" class="form-control" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label>safe</label>
                            <input type="text" required name="count" class="form-control" value="{{ old('count') }}">
                        </div>
                       

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> add</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
