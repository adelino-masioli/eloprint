<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="{{$modalid}}" tabindex="-1" role="dialog" aria-labelledby="modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="title-label">{{$modaltitle}}</h5>            
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">               
            {{$modalcontent}}
        </div>        
        <div class="modal-footer">            
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary {{$modalbtnclass}}" {{$modalbtnact}}>{{$modalbtn}}</button>
        </div>
        </div>
    </div>
</div>