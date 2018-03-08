<div class="form-group">
      <label for="name">Nome do cliente</label>
      <input type="text" class="form-control" id="name" placeholder="Nome do cliente" name="name" value="{{isset($customer) ? $customer->name : old('name')}}" required>
      <div class="invalid-feedback">Favor informar o nome</div>
</div>
<div class="row">
    <div class="form-group col-md-9">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" value="{{isset($customer) ? $customer->email : old('email')}}" required>
        <div class="invalid-feedback">Favor informar um email válido</div>
    </div>
    <div class="form-group col-md-3">
        <label for="telephone">Telefone</label>
        <input type="text" class="form-control" id="telephone" placeholder="Telefone" name="telephone" value="{{isset($customer) ? $customer->telephone : old('telephone')}}" maxlength="15" required>
        <div class="invalid-feedback">Favor informar o telefone</div>
    </div>
</div>
<button type="submit" class="btn btn-success pull-right">Salvar</button>

@push('scripts')
    <script>
        $(window).load(function(){
            $("#telephone")
                    .mask("(99) 9999-9999?9",{placeholder:" "})
                    .focusout(function (event) {
                        var target, phone, element;
                        target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                        phone = target.value.replace(/\D/g, ''); //Remove tudo o que não é dígito
                        element = $(target);
                        element.unmask();
                        if(phone.length > 10) {
                            element.mask("(99) 99999-999?9",{placeholder:" "});
                        } else {
                            element.mask("(99) 9999-9999?9",{placeholder:" "});
                        }
            });
        });
    </script>
@endpush