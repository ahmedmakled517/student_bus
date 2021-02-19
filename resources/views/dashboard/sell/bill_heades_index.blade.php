@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">selles <small></small></h3>

                  

                </div><!-- end of box header -->

                <div class="box-body">

                  
@if($datas->count() >0)
                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>client_id</th>
                                <th>bill_number</th>
                                <th>bill_date</th>
                                <th>tottal</th>
                                <th>paid</th>
                                <th>romain</th>
                                <th>safe_id</th>
                                <th>Details</th>
                                <th>backs</th>
                            </tr>
                            </thead> 
                            
                            <tbody>
                            @foreach ($datas as $index=>$data)
                                @foreach($name as $nam)
                                    <tr>
                                    @if($data->client_id == $nam->id)

                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $nam->name }}</td>
                                        <td>{{ $data->bill_number }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>{{ $data->tottal }}</td>
                                        <td>{{ $data->paid }}</td>
                                        <td>{{ $data->roamin }}</td>
                                     @foreach($safes as $safe)
                                        @if($safe->id == $data->safe_id)
                                        <td>{{ $safe->name }}</td>
                                        @endif
                                     @endforeach   
                                        <td> <a href="{{route('dashboard.bill_details',$data->bill_number)}}" class="btn btn-primary">Details</a> </td>
                                     @foreach($backs as $back)
                                        @foreach($back as $key=>$value)
                                            @if($value == $data->bill_number)
                                            <td> <a href="{{route('dashboard.back_details',$data->bill_number)}}" class="btn btn-danger">backs</a> </td>
                                            @endif
                                        @endforeach  
                                     @endforeach  
                                        @endif
                                    
                                    </tr>
                                @endforeach
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
