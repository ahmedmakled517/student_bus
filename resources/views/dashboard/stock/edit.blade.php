@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>stock</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('dashboard.stockes.index') }}">stock</a></li>
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

                    <form action="{{ route('dashboard.stockes.update', $stock->id) }}" method="post" >

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                      
                        <div class="form-group">
                           
                        <div class="form-group">
                            <label>Store</label>
                            <select name="store_id" required style="width:200px" >
                             @foreach($stor as $store)
                                <option value="{{$store->id}}"  {{ ($store->id == $stock->store_id) ? 'selected' : '' }}>{{$store->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        </div>
                        <div class="form-group">
                        <label>Item</label>
                            <select name="item_id" required style="width:200px" >
                             @foreach($items as $item)
                                <option value="{{$item->id}}" {{ ($item->id == $stock->item_id) ? 'selected' : '' }}>{{$item->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Qtn</label>
                            <input type="text" required name="qtn" class="form-control" value="{{ $stock->qtn }}">
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
