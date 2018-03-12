<div class="table-responsive-md">
  <table class="table table-hover table-striped table-sm" width="100%" cellspacing="0">
    <thead>
      <tr>
        <th class="col-md-1 text-center" scope="col">#</th>
        <th class="col-md-6 text-center" scope="col">NOME DO PRODUTO</th>
        <th class="col-md-1 text-center" scope="col">VALOR</th>
        <th class="col-md-1 text-center" scope="col">DESC</th>
        <th class="col-md-1 text-center" scope="col">QTD</th>
        <th class="col-md-1 text-center" scope="col">SUBTOTAL</th>
        <th class="col-md-1 text-center" scope="col"><i class="fa fa-cog"></i></th>
      </tr>
    </thead>
    <tbody id="showitens">
      @if(count($items))
        <?php $i_item=1; ?>
        @foreach($items as $item)
          <tr id="trlistprod_{{$item->id}}">
            <th class="text-center" scope="row">{{$i_item}}</th>
            <td>{{$item->products->name}}</td>
            <td class="text-right">{{number_format($item->products->price, 2, ',', '.')}}</td>
            <td class="text-right">{{number_format($item->price, 2, ',', '.')}}</td>
            <td class="text-center">{{$item->amount}}</td>
            <td class="text-right">{{number_format($item->subtotal, 2, ',', '.')}}</td>
            <td class="text-center"><span class="btn btn-default btn-sm"><i class="fa fa-trash-alt text-danger" onclick="functionRemoveItem('{{$item->id}}');"></i></span></td>
          </tr>
          <?php $i_item++; ?>
        @endforeach
      @else
          <tr><td colspan="7" class="text-center">Nenhum produto adicionado!</td></tr>
      @endif
    </tbody>
  </table>
</div>
@push('scripts')
  <script>
    //list items
    function functionReloadItems() {
      var url = '{{route('order.item.list', $order->id)}}';
      $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
          obj = JSON.parse(data);
          var tr = '';
          $('#showitens').html('');
          var i_item = 1;
          if(obj.status == 1){
            $.each(obj.response, function (i, val) {
                tr += '<tr id="trlistprod_'+val.id+'">';
                tr += '<td class="col-md-1 text-center">'+i_item+'</td>';
                tr += '<td class="col-md-6 text-left">'+val.product+'</td>';
                tr += '<td class="col-md-1 text-right">'+val.price+'</td>';
                tr += '<td class="col-md-1 text-right">'+val.discount+'</td>';
                tr += '<td class="col-md-1 text-center">'+val.amount+'</td>';
                tr += '<td class="col-md-1 text-right">'+val.subtotal+'</td>';
                tr += '<td class="col-md-1 text-center"><span class="btn btn-default btn-sm"><i class="fa fa-trash-alt text-danger" onclick="functionRemoveItem(\''+val.id+'\');"></i></span></td>';
                tr += '</tr>';
                i_item++;
            });
          }else{
            tr += '<tr><td colspan="7" class="text-center">Nenhum produto adicionado!</td></tr>';
          }
          $('#showitens').append(tr);
          return false;
        }
      });
    return false;
    }
  </script>
@endpush