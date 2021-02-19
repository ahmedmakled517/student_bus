@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>selles</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">selles</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">selles <small></small></h3>
                </div><!-- end of box header -->

                <div class="box-body">
                @include('partials._errors')
                <ul id="error" class="list-unstyled"></ul>
                <form  id='btn_ajex' >

                      

<div class="form-group">
    <label>store name</label>
    <select name="store_id" class="store_id" required style="width:200px" >
    <option ></option>
     @foreach($stores as $store)
        <option value="{{$store->id}}">{{$store->name}}</option>
     @endforeach
    </select>
</div>

<div class="form-group">
    <label>item name</label>
    <select name="item_id" class='item' required style="width:200px" >
    <option ></option>
     @foreach($items as $item)
        <option value="{{$item->id}}">{{$item->name}}</option>
     @endforeach
    </select>
</div>


<div class="form-group">
    <label>unite name</label>
    <select name="unite_id"  class="unite_id" required style="width:200px" >
    <option ></option>
     @foreach($unites as $unite)
        <option value="{{$unite->id}}">{{$unite->name}}</option>
     @endforeach
    </select>
</div>
<div class="form-group">
    <label> Qtn</label>
    <input type="text" required name="qtn" class="qtnn form-control" value="{{ old('qtne') }}">
</div>
<div class=" price form-group">
<label> Price</label>
    <input type="text" required name="price" class="price form-control" value="{{ old('price') }}">
</div>



<div class="form-group">
    <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> add</button>
</div>

</form><!-- end of form -->
<form class="btn_save">
<div class="div_table">
                            <table class="cont-data table table-hover">
                                <thead>
                               
                                    <th>Item Name</th>
                                    <th>Qtn</th>
                                    <th>price</th>
                                    <th>tottal</th>
                                    <th>store_id</th>
                                    <th>unite_id</th>
                                    <th>action</th>
                               
                                </thead>
                                 <tbody class='t_body' id="t_body">

                                 </tbody>


                            </table><!-- end of table -->
                           
                            <label >tottal </label>
                            <input type="text" required class="inp" value=''>
                            <label >discount</label>
                            <input type="text"  name="discount" required class="discount">
                            <label >paid</label>
                            <input type="text" required class="paid">
                         
                            <label >romain</label>
                            <input type="text" required class="romain"  disabled >
                            <hr>
                        <hr>
                <div class="form-group">
                            <label>Bill Number</label>
                            <input type="text" required name="bill_number" class="bill form-control" value="{{ old('bill_number') }}">
                        </div>
                        <div class="form-group">
                            <label>client name</label>
                            <select name="client_id" required class='client_name' style="width:200px" >
                            <option ></option>

                             @foreach($clients as $client)
                                <option value="{{$client->id}}">{{$client->name}}</option>
                             @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" required name="date" class="date form-control" value="{{ old('bill_number') }}">
                        </div>
                        <div class="form-group">
                            <label>safe</label>
                            <select name="safe_id" required class='safe_id' style="width:200px" >
                            <option ></option>
                             @foreach($safes as $safe)
                                <option value="{{$safe->id}}">{{$safe->name}}</option>
                             @endforeach
                            </select>
                        </div>
                   
                  
                
                          
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary"> save</button>
                        </div>

</form>
                            <!-- <input type="submit" class='btn_save  btn btn-primary' value='save'> -->
                        </div>
                   
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
    <!-- <script src="{{asset('/assets')}}/js/jquery-3.4.1.js"  ></script>
    <script src="{{asset('/assets')}}/js/popper.min.js" ></script>
    <script src="{{asset('/assets')}}/js/bootstrap.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!--add button from tabel  -->
<script type="text/javascript">

    $('#btn_ajex').submit(function(e){
      e.preventDefault();
      var de=[];
        // var btn_ajex=$('#btn_ajex').serialize();
        var tbl = document.getElementById('t_body');
        if (tbl.rows.length == 0) {
            var btn_ajex=$('#btn_ajex').serialize();
        }else{
            var deo =[];
             $('.t_body tr').each(function(index) {
                //  console.log($(this).find("td").eq(0).find('option').val())
                //  console.log($('.item').val())
                 deo.push({"item":$(this).find("td").eq(0).find('option').val(),"qtn":$(this).find("td").eq(1).text(),'unite':$(this).find("td").eq(5).find('option').val(),'store':$(this).find("td").eq(4).text()})
            if (parseInt($(this).find("td").eq(0).find('option').val()) == parseInt($('.item').val()) && parseInt($(this).find("td").eq(5).find('option').val()) == parseInt($('.unite_id').val())&& $(this).find("td").eq(4).html() ==$('.store_id').val() ) {
              console.log("good")
                $(this).remove()
            }
            
            })
            if ( deo.some(item => item.item == parseInt($('.item').val()) && item.unite == parseInt($('.unite_id').val())  &&item.store == $('.store_id').val() )) {
                console.log("sf")
                var lo =deo.find(item => item.item == parseInt($('.item').val()) && item.unite != parseInt($('.unite_id').val()) && item.store ==$('.store_id').val());
              console.log(lo)
              if (lo === undefined) {
                var ol = 0;
              }else{
                var ol =lo.qtn ;
              }
                var qnt =deo.find(item => item.item == parseInt($('.item').val()) && item.unite==parseInt($('.unite_id').val()) && item.store ==$('.store_id').val());
                var qtn= Number($('.qtnn').val()) + Number(qnt.qtn) ;
                var item= $('.item').val();
                var unite= $('.unite_id').val();    
                var store_id= $('.store_id').val();
                var price= $(".price").val();
                
                var btn_ajex="store_id="+store_id+"&item_id="+item+"&unite_id="+unite+"&qtn="+qtn+"&price="+ price +"&ol="+ol
                de.push(de,btn_ajex)
            }else{
                console.log("faild")
                var btn_ajex=$('#btn_ajex').serialize();
                de.push(de,btn_ajex)
            }
            }

    if (de.length == 0) {
        console.log("gooded")
        var btn_ajex=$('#btn_ajex').serialize();
        // var btn_ajex= btn_ajex;
    }else{
        var btn_ajex=de[1]
    }
    console.log(btn_ajex);
        $.ajax({
			 	type:'get',
			 	url:"{{url('dashboard/get_report')}}",
			 	data:btn_ajex,
			 	success:function(dataBack){
    console.log(dataBack)
                        if (dataBack.status == 100) {
                            var tt=0
                            $('.t_body tr').each(function(index) {
                                tt +=Number($(this).find("td").eq(3).text())
                            })
                        $(".inp").val(tt.toFixed(2)) 

                        // $("#error").empty();
                        
                            $("#error").html("<li class='alert alert-error text-center p-1'>"+ dataBack.messege +"</li>").fadeIn( 400 ).slideUp( 5000 );
                        
                        }else{
                                        // for (let index = 0; index < dataBack.length; index++) {

                        $(".t_body").append(
                                                $("<tr>" +
                                                "<td><option  value=' " + dataBack['item'].id + " '>"+dataBack['item'].name+"</option></td>" +
                                                "<td>" + dataBack['qtn'] + "</td>" +
                                                "<td>" + dataBack['price'] + "</td>" +
                                                "<td>" + dataBack['tottal'] + "</td>" +
                                                "<td>" + dataBack['store_id'] + "</td>" +
                                                "<td><option  value=' " + dataBack['unite'].id + " '>"+dataBack['unite'].name+"</option></td>" +
                                                "<td>" + "<button id='delete' class='btn btn-danger'>delete </button>" + "</td>" +
                                                "</tr>")
                                            )
                                        // }
                            var tt=0
                            $('.t_body tr').each(function(index) {
                                tt +=Number($(this).find("td").eq(3).text())
                            })
                        $(".inp").val(tt.toFixed(2)) 
                                        
                        }
            
			 	},
				error:function(err){
                    if (err.status == 422) {
                        var errors = JSON.parse(err.responseText);
                        //    console.warn(err.responseJSON.errors);
                       $.each(err.responseJSON.errors, function (i, error) {
                        // $("#error").empty();
                        // $("#error").html("<li class='alert alert-error text-center p-1'>"+ error[0] +"</li>");
                    $(".span").empty();
                        var el = $(document).find('[name="'+i+'"]');
                        el.first().after($('<span class="span" style="color: red;">'+error[0]+'</span>'));
                         });
                   
               }
				}
			 })
    })

</script>
<!-- delete tr in tabel -->
<script type="text/javascript">
    $(document).ready(function(){

        $('body').on('click', '#delete', function() {
            var test = $(this).parents('tr').find("td").eq(3).text()
            $(".inp").val(parseFloat(Number($(".inp").val()) - Number(test)).toFixed(2)) 
            $(this).parents('tr').remove();  
        });
    })
</script>
<!-- store change -->
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','.store_id',function(){
		
        
		    var store_id=$('.store_id').val();
			 $.ajax({
			 	type:'get',
			 	url:'{!!URL::to('dashboard/get_item')!!}',
			 	data:{'store_id':store_id},
			 	success:function(data){
                     $('.item').empty();
                     $('.item').append('<option  data-url="some_data"></option>')
                     data.forEach((value ) => {
                        Object.entries(value).forEach(([key, valuee]) => 
                     $('.item').append('<option value="'+valuee+'" data-url="some_data">'+key+'</option>')
                     
                        );
                       
                     });
			 	},
				error:function(){

				}
			 });
		});

		

	});
</script>
<!-- item change -->
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','.item',function(){
		
        
		    var item_id=$('.item').val();
			 $.ajax({
			 	type:'get',
			 	url:'{!!URL::to('dashboard/get_unite')!!}',
			 	data:{'item_id':item_id},
			 	success:function(data){
                    //  console.log(data)
                     $('.unite_id').empty();
                     $('.unite_id').append('<option  data-url="some_data"></option>')
                     for (let index = 0; index < data.length; index++) {
                              Object.entries(data[index]).forEach(([key, valuee]) => 
                            $('.unite_id').append('<option value="'+valuee+'" data-url="some_data">'+key+'</option>')
                     
                        );
                     }
			 	},
				error:function(){

				}
			 });
		});

		

	});
</script>
<!-- unite change -->
<script type="text/javascript">
	$(document).ready(function(){

		$(document).on('change','.unite_id',function(){
		
        
		    var item_id=$('.item').val();
            var unite_id=$('.unite_id').val();
			// var inpo=" ";
			// var lab=" ";

			 $.ajax({
			 	type:'get',
			 	url:'{!!URL::to('dashboard/get_price')!!}',
			 	data:{'id':item_id,"unite_id":unite_id},
			 	success:function(data){
                     
                if (unite_id == data["main_unite"] ) {
                                $(".price").val(data["m_sell_price"] );
                }
                else{
                                    $(".price").val(data["s_sell_price"] );
                }
			 	},
				error:function(){

				}
			 });
		});

		

	});
</script>
<!--  paid change -->
<script type="text/javascript">

		$(document).on('change','.paid',function(){
			var paid=$(this).val();
            var tottal=$(".inp").val()
            var discount=$(".discount").val()
            var tt=0
                            $('.t_body tr').each(function(index) {
                                tt +=Number($(this).find("td").eq(3).text())
                            })
                            console.log((tt) )
            $('.romain').val(tt -discount - paid)
        });
</script>
<!-- discount -->
<script type="text/javascript">

		$(document).on('change','.discount',function(){
			var discount=$(this).val();
            var tt=0
                            $('.t_body tr').each(function(index) {
                                tt +=Number($(this).find("td").eq(3).text())
                            })
            $(".inp").val(parseFloat(Number(tt) - Number(discount)).toFixed(2))
            
    });
</script>
<!-- button save -->
<script type="text/javascript">
 $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



    $('.btn_save').submit(function(e){
      e.preventDefault();
        
      var dataArr = [];
        $('.cont-data tr').each(function() {

            dataArr.push({'item_id':$(this).find("td").eq(0).find('option').val(),'qtn':$(this).find("td").eq(1).html()
            ,'price':$(this).find("td").eq(2).html(),'tottal':$(this).find("td").eq(3).html()
            ,'store_id':$(this).find("td").eq(4).html(),'unite_id':$(this).find("td").eq(5).find('option').val()
        })
           
    })
            var bill=$('.bill').val();
            var client_name=$('.client_name').val();
            var date=$('.date').val();
            var tottall=$(".inp").val()
            var safe_id=$(".safe_id").val()
            
            var paid=$(".paid").val();
            var romain= $('.romain').val() 
            var discount= $('.discount').val() 
             
      $.ajax({
			 	type:'post',
			 	url:"{{url('dashboard/save_data')}}",

			 	data:{"bill_number":bill,"client_id":client_name,"tottal":tottall,"date":date,"paid":paid,"roamin":romain,"safe_id":safe_id,"discount":discount,
                    "bill_id":bill
                    ,"item":dataArr
                 },
			
             	success:function(dataBack){
                    $(".btn_save")[0].reset();
                    $('.cont-data').empty();
                     console.log(dataBack)
                     if (dataBack) {
                        // $("#error").empty();
                        $("#error").html("<li class='alert alert-error text-center p-1'>"+ dataBack +"</li>").fadeIn( 400 ).slideUp( 5000 );
                        }else{
                        // $("#error").empty();
                        $("#error").html("<li class='alert alert-success text-center p-1'> Added Success </li>").fadeIn( 400 ).slideUp( 5000 );
                        }
             	},
				error:function(err){

                    if (err.status == 422) {
                        var errors = JSON.parse(err.responseText);
                       $.each(err.responseJSON.errors, function (i, error) {
                        $("#error").html("<li class='alert alert-error text-center p-1'>"+ error[0] +"</li>").fadeIn( 400 ).slideUp( 5000 );
                         });
                   }
				}
			 })
    })

   

</script>

<!-- <script type="text/javascript">
 $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

    $('.btn_save').click(function(e){
      e.preventDefault();
        var bill=$('.bill').val();
        var client_name=$('.client_name').val();
        var date=$('.date').val();
        var tottal=$(".inp").val()
        var safe_id=$(".safe_id").val()
        var paid=$(".paid").val();
        var romain= $('.romain').val()
        
        
            
             
      $.ajax({
			 	type:'post',
			 	url:"{{url('dashboard/save_data_head')}}",
			 	data:{"bill_number":bill,"client_id":client_name,"date":date,"tottal":tottal,"paid":paid,"roamin":romain,"safe_id":safe_id,
                 },
			
             	success:function(dataBack){
                    //  console.log(dataBack)
                    //  if (dataBack) {
                    //     $("#error").empty();
                    //     $("#error").html("<li class='alert alert-error text-center p-1'>"+ dataBack +"</li>");
                    //     }else{
                    //     $("#error").empty();
                    //     $("#error").html("<li class='alert alert-success text-center p-1'> Added Success </li>");
                    //     }
             	},
				error:function(err){
                //     if (err.status == 422) {
                //         var errors = JSON.parse(err.responseText);
                //         //    console.warn(err.responseJSON.errors);
                //        $.each(err.responseJSON.errors, function (i, error) {
                //         // var el = $(document).find('[name="'+i+'"]');
                //         // el.after($('<span style="color: red;">'+error[0]+'</span>'));
                //         // alert(error);
                //         $("#error").empty();
                //         $("#error").html("<li class='alert alert-error text-center p-1'>"+ error[0] +"</li>");
                //          });
                //    }
				}
			 })
    
    })



</script> -->

</script>


@endsection
