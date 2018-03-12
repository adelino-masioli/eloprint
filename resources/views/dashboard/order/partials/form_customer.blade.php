<div class="card card-body card-order">
    <div class="row">
        <div class="form-group col-md-2">
            <label for="customer_id">Código cliente</label>
            <input type="text" class="form-control bg-light" id="customer_id" placeholder="Código cliente" name="customer_id" value="{{isset($order) ? $order->customer->id : old('id')}}" onkeypress="return false;" onclick="onlyNumber('#customer_id');openModal('#orderModal');" required>
        </div>
        <div class="form-group col-md-8">
                <label for="customer_name">Nome do cliente</label>
                <input  type="text" class="form-control bg-light" id="customer_name" name="customer_name" placeholder="Nome do cliente"  value="{{isset($order) ? $order->customer->name : old('name')}}" onkeypress="return false;" onclick="openModal('#orderModal');" required>
                <div class="invalid-feedback">Favor informar o cliente</div>
            </div>
        <div class="form-group col-md-2">
            <label for="customer_telephone">Telefone</label>
            <div class="input-group">       
                <input type="text" class="form-control bg-light" id="customer_telephone" placeholder="Telefone" name="customer_telephone" value="{{isset($order) ? $order->customer->telephone : old('telephone')}}" onkeypress="return false;" onclick="openModal('#orderModal');" required>
                @if(!isset($order))
                    <div class="input-group-prepend">
                        <button type="submit" class="btn btn-success pull-right">Avançar</button>
                    </div>
                @else
                    <div class="input-group-prepend">
                        <button type="button" class="btn btn-info pull-right" onclick="openModal('#orderModal');">
                            <i class="fa fa-search"></i> 
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@component('dashboard.layouts.modal')
    @slot('modalid') orderModal @endslot
    @slot('modalbtn') Confirmar @endslot
    @slot('modalbtnclass') btn-confirm-customer @endslot
    @slot('modalbtnact') data-dismiss="modal" @endslot
    @slot('modaltitle') <i class="fa fa-users"></i> Listagem de Clientes @endslot 
    @slot('modalcontent')     
    <div class="table-responsive-sm">
        <div class="preload" id="preload_customer"></div>   
        <div class="col-md-12 message-modal" style="display:none;">
            <div class="alert alert-danger col-md-12">
                Favor selecionar um Cliente

                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <table class="table table-hover table-striped table-sm" width="100%" cellspacing="0" id="datatable">
            <thead>
                <tr>
                    <th class="text-center">ID</th>
                    <th class="text-center">NOME DO CLIENTE</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($customers as $customer)                
                <tr id="tr_{{$customer->id}}" onclick="selectCustomer('{{$customer->id}}', '{{$customer->name}}', '{{$customer->telephone}}');">
                    <td class="text-center">{{$customer->id}}</td>
                    <td>{{$customer->name}}</td>
                </tr> 
            @endforeach
            </tbody>             
        </table>
    </div>
    @endslot    
@endcomponent

@push('scripts')
    <script>
        function openModal(modal){
            $('#preload_customer').fadeIn();
            $(modal).modal('show');
        }        
        function selectCustomer(id, name, telephone){
            $('.message-modal').fadeOut();
            $('tr').removeClass('table-info');
            $('#customer_id').val(id);
            $('#customer_name').val(name);
            $('#customer_telephone').val(telephone);
            $('#tr_'+id).addClass('table-info');
        }
        $(window).load(function(){           
            var table =  $('#datatable').DataTable( {
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
            $('.dataTables_filter').click(function(){
                $('tr').removeClass('table-info');
                $('#customer_id').val('');
                $('#customer_name').val('');
                $('#customer_telephone').val('');
            });
            $('.btn-confirm-customer').click(function(){
               if($('#customer_id').val().length == 0){
                   $('.message-modal').fadeIn();
                   return false;
               }
            });

           $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust();
           setTimeout(function(){
               $('#preload_customer').fadeOut();
           }, 1000);
        });
    </script>
@endpush