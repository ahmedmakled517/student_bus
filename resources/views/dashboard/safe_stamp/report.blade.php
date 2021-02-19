<table class="table table-hover">

<thead>
<tr>
    <th>#</th>
    <th>Name</th>
    <th>kiend</th>
    <th>date</th>
    <th>مدين</th>
    <th>مدان</th>
   
</tr>
</thead>

<tbody>
@foreach ($stamps as $index=>$stamp)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{$total->name}}</td>
        <td>{{ $stamp->kiend }}</td>
        <td>{{ $stamp->date }}</td>
        <td>{{ $stamp->count_plus }}</td>
        <td>{{ $stamp->count_dis }}</td>
    </tr>

@endforeach
</tbody>

</table><!-- end of table -->
<div>
    <label > tottal:- </label>
    <input type="text" value="{{$total->count}}" disabled>
</div>