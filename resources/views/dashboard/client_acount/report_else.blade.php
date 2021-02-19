<table class="table table-hover">

<thead>
<tr>
    <th>#</th>
    <th>Name</th>
    <th>kiend</th>
    <th>date</th>
    <th>مدين</th>
    <th>مدان</th>
    <th>الرصيد</th>
</tr>
</thead>

<tbody>
@foreach ($stamps as $index=>$stamp)
    <tr>
        <td>{{ $index + 1 }}</td>
        @foreach($client_name as $client)
            @if($client->id == $stamp->client_id)
                <td>{{ $client->name }}</td>
            @endif
        @endforeach
        <td>عمليه شراء</td>
        <td>{{ $stamp->date }}</td>
        <td>{{ $stamp->tottal }}</td>
        <td>{{ $stamp->paid }}</td>
        <td>{{ $stamp->tottal  - $stamp->paid }}</td>
    </tr>

@endforeach
</tbody>

</table><!-- end of table -->
