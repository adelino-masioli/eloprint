<div class="form-group">
      <label for="name">Nome do produto</label>
      <input type="text" class="form-control" id="name" placeholder="Nome do produto" name="name" value="{{isset($product) ? $product->name : old('name')}}" required>
      <div class="invalid-feedback">Favor informar o nome do produto</div>
</div>
<div class="form-group">
        <label for="description">Descrição do produto</label>
        <textarea class="form-control" id="description" placeholder="Descrição do produto" name="description">{{isset($product) ? $product->description : old('description')}}</textarea>
  </div>
<div class="row">
    <div class="form-group col-md-3">
        <label for="text">Preço</label>
        <input type="text" class="form-control" id="price" placeholder="Preço" name="price" value="{{isset($product) ? number_format($product->price, 2, ',', '.') : old('price')}}" required>
        <div class="invalid-feedback">Favor informar o valor do produto</div>
    </div>
    <div class="form-group col-md-3">
        <label for="status_id">Status</label>
        <select name="status_id" id="status_id" class="form-control">
            @foreach ($status as $statu)
                <option {{isset($product) && $product->status_id == $statu->id ? 'selected' : ''}} value="{{$statu->id}}">{{$statu->status}}</option>
            @endforeach
        </select>
    </div>
</div>
<button type="submit" class="btn btn-success pull-right">Salvar</button>

@push('scripts')
    <script>
        $(document).ready(function(){
            $(function() {
                $("#price").maskMoney({allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
            })
        });
    </script>
@endpush