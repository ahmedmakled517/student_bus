@extends('layout_dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>المرتجع</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> dashboard</a></li>
                <li class="active">المرتجع</li>
            </ol>
        </section>

        <section class="content">

         <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title" style="margin-bottom: 15px">المرتجع <small></small></h3>
                </div><!-- end of box header -->

            <div class="box-body">
                @include('partials._errors')
                <ul id="error" class="list-unstyled"></ul>
                <form class="btn_get">
                    <div class="form-group">
                                <label>Bill Number</label>
                                <select name="bill" id="bill" style="width:150px">
                             <option >--chose bill number--</option>
                                @foreach($bills as $bill)
                                    <option value="{{$bill->bill_number}}">{{$bill->bill_number}}</option>
                                @endforeach
                            </select>    
                        </div>
                        <div class="form-group">
                            <label>client name</label>
                            <input type="text"  name="client_id" class="client form-control" value="" disabled>

                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input type="date" required name="date" class="date form-control" value="{{ old('bill_number') }}">
                        </div>
                        <div class="form-group">
                            <label>safe</label>
                            <div class="safe"></div>
                        </div>
                      
                        <hr>
                        <hr>
                           
                        <table class="table table-hover">

                        <thead>
                        <tr>
                                <th>Item Name</th>
                                <th>Qtn</th>
                                <th>price</th>
                                <th>tottal</th>
                                <th>store_id</th>
                                <th>unite_id</th>
                        </tr>
                        </thead>
                        <tbody class="t_body">
                           
                        </tbody>
                        </table><!-- end of table -->
                            <label >tottal </label>
                            <input type="text" required class="tottal" value='' disabled>
                            <label >discount</label>
                            <input type="text" required class="discount" disabled>
                            <label >paid</label>
                            <input type="text" required class="paid"disabled>
                         
                            <label >romain</label>
                            <input type="text" required class="romain"  disabled >
                            <div class="form-group"> <label >mony return</label>
                            <input type="text" required class="mony_return"  disabled >
                            <input type="submit" class='btn_save  btn btn-primary' value='save'></div>
                           
       
        </form>
                        </div>
                   
                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!--bill change  -->
<script type="text/javascript">
    var mak;
    var qtn_old =[];
	$(document).ready(function(){

		$(document).on('change','#bill',function(){
		
        
		    var bill_number=$('#bill').val();
			 $.ajax({
			 	type:'get',
			 	url:'{!!URL::to('dashboard/back_get')!!}',
			 	data:{'bill_number':bill_number},
			 	success:function(data){
                     console.log(data)
                    if (data.status == 100) {
                        $("#error").html("<li class='alert alert-error text-center p-1'>"+ data.messege +"</li>").fadeIn( 400 ).slideUp( 5000 );
                        $("#bill").val('--chose bill number--');
                    }else{
                    $('.client').val(data.client_name.name);
                    $('.date').val(data.date);
                     $('.safe').empty();
                    $('.safe').append(
                        "<option disabled class='safe_idd' value='"+data.safe_name.id +"'>"+data.safe_name.name+"</option>"
                    )
                    // $('.client_id').val(data.client_id);
                    $(".t_body").empty();
                    for (let index = 0; index < data.detail.length; index++) {
                       $(".t_body").append(
                                                $("<tr>" +
                                                "<td><option value=' " + data.de[index].item_id + " '>"+ data.de[index].item_name+"</option></td>" +
                                                "<td><input type='text' name='qtn' class='qtn' value=' " + data.detail[index].qtn + "'></td>" +
                                                "<td><input type='text'class='pricez' value=' " + data.detail[index].price + "'disabled></td>" +
                                                "<td><input type='text'class='tottalz' value=' " + data.detail[index].tottal + "'disabled></td>" +
                                                "<td><option value=' " + data.de[index].store_id + " '>"+ data.de[index].store_name+"</option></td>" +
                                                "<td><option value=' " + data.de[index].unite_id + " '>"+ data.de[index].unite_name+"</option></td>" +
                                                "</tr>")
                                            )
                    }
                    $('.tottal').val(data.tottal);
                    $('.paid').val(data.paid);
                    $('.romain').val(data.roamin);
                    $('.discount').val(data.discount);
                    // $('.tottal').val(data.tottal);
                    mak= data.paid;
                    $('.t_body tr').each(function() {
                        qtn_old.push( {"item_id":$(this).find("td").eq(0).find('option').val(),"qtn":$(this).find("td").eq(1).find('input').val(),"unite":$(this).find("td").eq(5).find('option').val(),"store":$(this).find("td").eq(4).find('option').val(),"tot":$(this).find("td").eq(3).find('input').val()} )
                    })
                    console.log(qtn_old)

                    }
			 	},
				error:function(err){
                    var errors = JSON.parse(err.responseText);
                    console.log(errors)
				}
			 });
		});

		 

	});
</script>
<!--qtn change  -->
<script type="text/javascript">
	$(document).ready(function(){
        $(document).on('focusin', ".qtn",function(){
                $(this).data('val', $(this).val());
                var row=$(this).closest('tr')
                $(this).data('old_tot', row.find('td').eq(3).find('input').val());
                // var old_tot=row.find('td').eq(3).find('input')
            });
		$(document).on('change','.qtn',function(){

            // console.log($(this).data('old_tot'))

        var row=$(this).closest('tr')
		var tot=row.find('td').eq(3).find('input')
		var pric=row.find('td').eq(2).find('input')

           
        for (let index = 0; index < qtn_old.length; index++) {
            if(qtn_old[index].item_id ==  row.find('td').eq(0).find('option').val()&&qtn_old[index].store ==  row.find('td').eq(4).find('option').val()&&qtn_old[index].unite ==  row.find('td').eq(5).find('option').val()   ){
                console.log(qtn_old[index].qtn) 

                var qtn=$(this).val();
                    
                    var farq =((  parseFloat(( tot.val() - parseInt(qtn_old[index].qtn) * parseInt(pric.val()))).toFixed(2) * 100 ) /(parseInt(qtn_old[index].qtn) * parseInt(pric.val())) )
                    if ( parseInt(qtn_old[index].qtn) >= parseInt($(this).val())) {
                        if (farq == 15) {
                        var diss= Number(qtn) - Number(qtn_old[index].qtn)
                        var value_plus=Number( ((pric.val() * 15) / 100) )
                        var dise =Number( ((Number(pric.val()) + Number(value_plus))  ))
                        var elnespa_tottal= parseFloat((qtn_old[index].tot * 100) / (parseFloat($('.tottal').val()) + parseFloat($('.discount').val()))).toFixed(2);
                        
                        var elnespa_disqount = parseFloat((elnespa_tottal / 100) * $('.discount').val()).toFixed(2) ; 
                        var vlaue_one_pice = parseFloat(elnespa_disqount /  qtn_old[index].qtn).toFixed(2)
                        var diss=   parseFloat(qtn_old[index].qtn) -parseFloat(qtn)
                        var dis = Number( ( parseFloat((diss)*dise).toFixed(2) ) ) - Number(   parseFloat((diss) * vlaue_one_pice).toFixed(2))
                        tot.val( parseFloat((qtn)* dise).toFixed(2)  - qtn *vlaue_one_pice);
                        $('.mony_return').val( Number($('.mony_return').val()) + Number(dis));
                        var too =0;
                        $('.t_body tr').each(function() {
                            too += Number($(this).find("td").eq(3).find('input').val())
                            })
                        $(".paid").val(too);
                        
                    }else{
                        var elnespa_tottal= parseFloat((qtn_old[index].tot * 100) / (parseFloat($('.tottal').val()) + parseFloat($('.discount').val()))).toFixed(2);
                        
                        var elnespa_disqount = parseFloat((elnespa_tottal / 100) * $('.discount').val()).toFixed(2) ; 
                        var vlaue_one_pice = parseFloat(elnespa_disqount /  qtn_old[index].qtn).toFixed(2)
                        var diss=   parseFloat(qtn_old[index].qtn) -parseFloat(qtn)
                        var dis = Number( ( parseFloat((diss)* pric.val()).toFixed(2) ) ) - Number(   parseFloat((diss) * vlaue_one_pice).toFixed(2))
                        // console.log(diss)
                        //  console.log(parseFloat((diss)* pric.val()).toFixed(2) )
                    
                        tot.val( parseFloat((qtn)* pric.val()).toFixed(2)  - qtn *vlaue_one_pice);
                        $('.mony_return').val( Number($('.mony_return').val()) + Number(dis));
                        var too =0;
                        $('.t_body tr').each(function() {
                            too += Number($(this).find("td").eq(3).find('input').val())
                            })
                        $(".paid").val(too);
                    }
                
                    }else{
                        $("#error").html("<li class='alert alert-error text-center p-1'>sorry dont request qtn more but less</li>").fadeIn( 400 ).slideUp( 5000 );
                        $(this).val(qtn_old[index].qtn)
                    }
                    



    }else{
        console.log("faild")
    }
    
    }
		});

		

	});
</script>
<!--discount change  -->
<script type="text/javascript">
	$(document).ready(function(){
        // $('.discount').on('focusin', function(){
        //         $(this).data('val', $(this).val());
        //     });
		$(document).on('change','.discount',function(){
            var old=$(this).data('val')
            $('.tottal').val( $('.tottal').val() - (Number($('.discount').val())) )
		});
	});
</script>
<!-- paid change -->
<script type="text/javascript">
	$(document).ready(function(){
        $('.paid').on('focusin',function(){
                $(this).data('val', $(this).val());
            });
		$(document).on('change','.paid',function(){
            $('.romain').val( $('.tottal').val() - (  Number($('.paid').val())) )
            $('.mony_return').val( parseFloat($(this).data('val') - (  Number($('.paid').val()))).toFixed(2) )
            
		});
	});
</script>
<!-- save data -->
<script type="text/javascript">
 $.ajaxSetup({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });



    $('.btn_get').submit(function(e){
      e.preventDefault();
        
      var dataArr = [];
        $('.t_body tr').each(function() {
            
            dataArr.push({'item_id':$(this).find("td").eq(0).find('option').val(),'qtn':$(this).find("td").eq(1).find('input').val()
            ,'price':$(this).find("td").eq(2).find('input').val(),'tottal':$(this).find("td").eq(3).find('input').val()
            ,'store_id':$(this).find("td").eq(4).find('option').val(),'unite_id':$(this).find("td").eq(5).find('option').val()
        })
           
    })
            var bill=$('#bill').val();
            var client_name=$('.client_id').val();
            var date=$('.date').val();
            var tottall=$(".tottal").val()
            var safe_id=$(".safe_idd").val()
    // console.log(too)
            
            var paid=$(".paid").val();
            var romain= $('.romain').val() 
            var discount= $('.discount').val() 
            var rom=mak - paid 
            var too =0;
                 $('.t_body tr').each(function() {
                    too += Number($(this).find("td").eq(3).find('input').val())
                    })
 

      $.ajax({
			 	type:'post',
			 	url:"{{url('dashboard/back_save_data')}}",

			 	data:{"bill_number":bill,"client_id":client_name,"tottal":tottall,"date":date,"paid":paid,"roamin":romain,"safe_id":safe_id,"discount":discount,
                    "bill_id":bill,"old_roamin":rom,"mony_return":$('.mony_return').val(),"new_tottal":too
                    ,"item":dataArr
                 },
			
             	success:function(dataBack){
                    if (dataBack.status == 422) {
                        var errors = JSON.parse(dataBack.responseText);
                        console.log(errors)
                    }
                    $(".btn_get")[0].reset();
                    $('.t_body').empty();
                     if (dataBack) {
                        // $("#error").empty();
                        $("#error").html("<li class='alert alert-error text-center p-1'>"+ dataBack +"</li>").fadeIn( 400 ).slideUp( 5000 );
                        }else{
                        // $("#error").empty();
                        $("#error").html("<li class='alert alert-success text-center p-1'> Added Success </li>").fadeIn( 400 ).slideUp( 5000 );
                        }
             	},
				error:function(err){
                    // if (err.status == 500) {
                    //     var errors = JSON.parse(err.responseText);
                    //     console.log(errors)
                    //     }
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
@endsection
