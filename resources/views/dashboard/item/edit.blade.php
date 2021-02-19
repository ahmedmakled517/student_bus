@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>item</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li><a href="{{ route('dashboard.items.index') }}">item</a></li>
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

                    <form action="{{ route('dashboard.items.update', $item->id) }}" method="post" >

                        {{ csrf_field() }}
                        {{ method_field('put') }}

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" required name="name" class="form-control" value="{{ $item->name }}">
                        </div>
                        <div class="form-group">
                           
                            <div class="form-group">
                            <label>main unite</label>
                            <select name="main_unite" required style="width:200px" >
                             @foreach($main_unite as $unite)
                                <option value="{{$unite->id}}" {{ ($unite->id == $item->main_unite) ? 'selected' : '' }}  >{{$unite->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Buy Price</label>
                            <input type="text" required name="m_buy_price" class="form-control" value="{{ $item->m_buy_price }}">
                        </div>
                        <div class="form-group">
                            <label>Sell Price</label>
                            <input type="text" required name="m_sell_price" class="form-control" value="{{  $item->m_sell_price }}">
                        </div>
                        </div>
                        <div class="form-group">
                        <label>sup unite</label>
                            <select name="sup_unite" required style="width:200px" >
                             @foreach($sup_unite as $unite)
                                <option value="{{$unite->id}}" {{ ($unite->id == $item->sup_unite) ? 'selected' : '' }} >{{$unite->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Buy Price</label>
                            <input type="text" required name="s_buy_price" class="form-control" value="{{ $item->s_buy_price  }}">
                        </div>
                        <div class="form-group">
                            <label>Sell Price</label>
                            <input type="text" required name="s_sell_price" class="form-control" value="{{ $item->m_sell_price  }}">
                        </div>
                        </div>
                        <div class="form-group">
                            <label>sup_count_main</label>
                            <input type="text" required name="sup_count_main" class="form-control" value="{{ $item->sup_count_main }}">
                        </div>
                      
                        <div class="form-group">
                        <label>Are these subject to the stamp law?</label>
                        <input type="checkbox"  name="stamp" value="Yes"    {{$item->stamp ==="Yes" ? 'checked' : ""}} >
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
