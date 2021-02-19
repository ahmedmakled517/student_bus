@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>heads</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('dashboard.heads.index') }}"> heads</a></li>
                <li class="active">add </li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">add Bill head</h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.heads.store') }}" method="post" >

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                        <div class="form-group">
                            <label>client_name</label>
                            <select name="store_id" required style="width:200px" >
                             @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Bill_date</label>
                            <input type="date" required name="bill_date" class="form-control" value="{{ old('bill_date') }}">
                        </div>
                        <div class="form-group">
                            <label>Bill_date</label>
                            <input type="date" required name="bill_date" class="form-control" value="{{ old('bill_date') }}">
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
