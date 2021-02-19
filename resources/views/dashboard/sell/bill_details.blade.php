@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">bill_details <small></small></h3>

                  

                </div><!-- end of box header -->

                <div class="box-body">

                  
@if($bill_heads->count() >0)
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>item_name</th>
                                <th>unite_name</th>
                                <th>qtn</th>
                                <th>price</th>
                                <th>totatl</th>
                                <th>store_id</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            @foreach($bill_heads as $bill_head)
                           
                                    <tr>
                                    @foreach($items as $item)
                                        @if($item->id == $bill_head->item_id)
                                            <td>{{ $item->name }}</td>
                                        @endif   
                                    @endforeach

                                    @foreach($unites as $unite)
                                        @if($unite->id == $bill_head->unite_id)
                                            <td>{{ $unite->name }}</td>
                                        @endif    
                                    @endforeach

                                            <td>{{ $bill_head->qtn }}</td>
                                            <td>{{ $bill_head->price }}</td>
                                            <td>{{ $bill_head->tottal }}</td>
                                            
                                    @foreach($stores as $store)
                                        @if($store->id == $bill_head->store_id)
                                            <td>{{ $store->name }}</td>
                                        @endif          
                                    @endforeach
                                    </tr>
                             @endforeach       
                              
                            </tbody>

                        </table><!-- end of table -->
@else
    <h1>not found dada</h1>                                         
@endif                        
                
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
