@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>clients</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">client_acount</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">clients <small></small></h3>

                 

                </div><!-- end of box header -->

                <div class="box-body">

                  <form id="get_acount">

                  <div class="form-group">
                  <label > from</label>
                    <input type="date" required  name="date_from" class="form-control" value="{{ old('name') }}" >
                    </div>
                 <div class="form-group">
                 <label >to</label>
                        <input required type="date" name="date_to"  class="form-control" value="{{ old('name') }}" >
                    </div>
                    <select name="client_id" >
                    <option >--chose client --</option>
                        @foreach($clients as $client)
                            <option value="{{$client->id}}">{{$client->name}}</option>
                        @endforeach
                    </select>     
                    <button type="submit" class="btn btn-primary"> <i class="fa fa-search"></i>search</button>             
                  </form>



                  <div class="cont-data"></div>

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">

    $('#get_acount').submit(function(e){
    e.preventDefault();
        var btn_ajex=$('#get_acount').serialize();
    $.ajax({
                type:'get',
                url:"{{url('dashboard/client_acount_get')}}",
                data:btn_ajex,
                success:function(dataBack){
                    // console.log(dataBack)
                    $(".cont-data").empty();
                    $(".cont-data").append(dataBack)
                },
                error:function(err){
                    // if (err.status == 422) {
                    //     var errors = JSON.parse(err.responseText);
                    //     //    console.warn(err.responseJSON.errors);
                    // $.each(err.responseJSON.errors, function (i, error) {
                    //     // $("#error").empty();
                    //     // $("#error").html("<li class='alert alert-error text-center p-1'>"+ error[0] +"</li>");
                    // $(".span").empty();
                    //     var el = $(document).find('[name="'+i+'"]');
                    //     el.first().after($('<span class="span" style="color: red;">'+error[0]+'</span>'));
                    //     });
                
                    //  }
                }
            })
    })

  
</script>

@endsection
