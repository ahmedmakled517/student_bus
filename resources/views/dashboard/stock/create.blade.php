@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>stockes</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('dashboard.stockes.index') }}"> stockes</a></li>
                <li class="active">add </li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">add </h3>
                </div><!-- end of box header -->

                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('dashboard.stockes.store') }}" method="post" >

                        {{ csrf_field() }}
                        {{ method_field('post') }}

                       
                        <div class="form-group">
                           
                            <div class="form-group">
                            <label>Store</label>
                            <select name="store_id" required style="width:200px" >
                             @foreach($stores as $store)
                                <option value="{{$store->id}}">{{$store->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label>Item</label>
                            <select name="item_id" required style="width:200px" >
                             @foreach($items as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Qtn</label>
                            <input type="text" required name="qtn" class="form-control" value="{{ old('qtn') }}">
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
