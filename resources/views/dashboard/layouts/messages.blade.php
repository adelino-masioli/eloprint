@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show default-alerts">
    @foreach ($errors->all() as $error)
    {{ $error }}
    @endforeach

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show default-alerts">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show default-alerts">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@push('scripts')
    <script>
        $(window).load(function(){
           setTimeout(function(){
                $('.default-alerts').alert('close');
           }, 3000);
        });
    </script>
@endpush