<div class="card card-body card-order">
    <div class="row">
        <div class="form-group col-md-2">
            <label for="product_id">Código</label>
            <input type="text" class="form-control bg-light" id="product_id" placeholder="Código" name="product_id"  onkeypress="return false;" onclick="onlyNumber('#product_id');openModalProduct('#productModal');">
        </div>
        <div class="form-group col-md-4">
            <label for="nproduct_nameame">Nome do produto</label>
            <input  type="text" class="form-control bg-light" id="product_name" placeholder="Nome do produto" name="product_name"  onkeypress="return false;" onclick="openModalProduct('#productModal');">
        </div>
        <div class="form-group col-md-2">
            <label for="product_price">Valor</label>
             <input  type="text" class="form-control bg-light" id="product_price" placeholder="Valor" name="product_price"  onkeypress="return false;" onclick="openModalProduct('#productModal');">
        </div>
        <div class="form-group col-md-2">
                <label for="product_discount">Desconto e Reais(R$)</label>
                <input  type="text" class="form-control bg-light" id="product_discount" placeholder="Desconto" name="product_discount">
            </div>
        <div class="form-group col-md-2">
            <label for="product_amount">Qtd</label>
            <div class="input-group">       
                <input  type="text" class="form-control bg-light" id="product_amount" placeholder="Qtd" name="product_amount" onclick="onlyNumberAndDot('#product_amount');">
                <div class="input-group-prepend">
                <button type="button" class="btn btn-success pull-right" onclick="functionAddItem('{{route('order.item.store')}}', '{{ $order->id }}');">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@component('dashboard.layouts.modal')
    @slot('modalid') productModal @endslot
    @slot('modalbtn') Confirmar @endslot
    @slot('modalbtnclass') btn-confirm-product @endslot
    @slot('modalbtnact') data-dismiss="modal" @endslot
    @slot('modaltitle') <i class="fa fa-users"></i> Listagem de Produtos @endslot 
    @slot('modalcontent')     
    <div class="table-responsive-sm">
        <div class="preload" id="preload_product"></div>   
        <div class="col-md-12 message-modal-product" style="display:none;">
            <div class="alert alert-danger col-md-12">
                Favor selecionar um Cliente

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <table class="table table-hover table-striped table-sm" width="100%" cellspacing="0" id="datatable_products">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">NOME DO PRODUTO</th>
                    <th class="text-center">VALOR</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($products as $product)                
                <tr class="trp_" id="trp_{{$product->id}}" onclick="selectProduct('{{$product->id}}', '{{$product->name}}', '{{number_format($product->price, 2, ',', '.')}}');">
                    <td class="text-center">{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td class="text-right">{{number_format($product->price, 2, ',', '.')}}</td>
                </tr> 
            @endforeach
            </tbody>             
        </table>
    </div>
    @endslot    
@endcomponent

@push('scripts')
    <script>
        $(document).ready(function(){
            $(function() {
                $("#product_discount").maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
            })
        });
        function openModalProduct(modal){
            $('#preload_product').fadeIn();
            $(modal).modal('show');
            resetFieldsProduct();
        }        
        function selectProduct(id, name, price){
            $('.message-modal').fadeOut();
            $('.trp_').removeClass('table-info');
            $('#product_id').val(id);
            $('#product_name').val(name);
            $('#product_price').val(price);
            $('#trp_'+id).addClass('table-info');
        }
        $(window).load(function(){           
            var table =  $('#datatable_products').DataTable( {
                "scrollY":        "200px",
                "scrollCollapse": true,
                "paging":         false,
                "bPaginate": false,
                "language": {
                    "sEmptyTable": "Nenhum registro encontrado",
                    "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                    "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sInfoThousands": ".",
                    "sLengthMenu": "_MENU_ resultados por página",
                    "sLoadingRecords": "Carregando...",
                    "sProcessing": "Processando...",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sSearch": "Pesquisar",
                    "oPaginate": {
                        "sNext": "Próximo",
                        "sPrevious": "Anterior",
                        "sFirst": "Primeiro",
                        "sLast": "Último"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            } );          
        });
        $(document).on('shown.bs.modal', function (e) {
            $('#datatable_products').fadeIn();
            
            $('.dataTables_filter').click(function(){
                resetFieldsProduct();               
            });
            $('.btn-confirm-product').click(function(){
               if($('#product_id').val().length == 0){
                   $('.message-modal-product').fadeIn();
                   return false;
               }
            });
           $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
           setTimeout(function(){
               $('#preload_product').fadeOut();
           }, 1000);
        });
        function resetFieldsProduct(){
            $('.trp_').removeClass('table-info');      
            $('#product_id').val('');
            $('#product_name').val('');
            $('#product_price').val('');
            $('#product_discount').val('');
            $('#product_amount').val('');
        }
        function functionAddItem(url, order_id) {
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    'order_id': order_id,
                    'product_id': $('#product_id').val(),
                    'product_discount': $('#product_discount').val(),
                    'product_amount': $('#product_amount').val(),
                    '_token': $('input[name="_token').val()
                },
                success: function (data) {
                    obj = JSON.parse(data);
                    if (obj.status == 1) {
                        swal("SUCESSO!", obj.response, "success");
                        resetFieldsProduct();
                        functionReloadItems();
                    }else{
                        swal("IMPORTANTE!", obj.response, "error");
                    }
                    return false;
                },
                error: function (data) {
                    swal("IMPORTANTE!", formatErrors(data.responseJSON).toString().replace(',', ''), "error");
                    return false;
                },
            });
            return false;
        }
        function functionRemoveItem(id){
            var url = '{{url('dashboard/order-item/destroy')}}/'+id;
            $.ajax({
                type: 'GET',
                url: url,
                success: function (data) {
                    obj = JSON.parse(data);
                    if (obj.status == 1) {
                        swal("SUCESSO!", obj.response, "success");
                        functionReloadItems();
                    }else{
                        swal("IMPORTANTES!", obj.response, "error");
                    }
                    return false;
                },
                error: function (data) {
                    swal("IMPORTANTE!", obj.response, "error");
                    return false;
                },
            });
            return false;            
        }
    </script>
@endpush