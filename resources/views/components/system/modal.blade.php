 <!-- Button trigger modal -->
 <button type="button" class="btn btn-{{ $input['btnColor'] }} btn-sm ml-1" data-toggle="modal"
     data-target="#{{ $input['id'] ?? '' }}" id="{{ $input['btnId'] ?? '' }}">
     {!! isset($input['icon']) ? "<i class=\"{$input['icon']}\"></i>" : '' !!} &nbsp;{{ isset($input['btnTitle']) ? $input['btnTitle'] : '' }}

 </button>

 <!-- Modal -->
 <div class="modal fade" id="{{ $input['id'] ?? '' }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog {{ isset($input['size']) && $input['size'] == 'large' ? 'modal-lg' : '' }}">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">
                     {{ isset($input['modalTitle']) ? $input['modalTitle'] : '' }}</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <form action="{{ isset($input['route']) ? route($input['route']) : '' }}"
                 method="{{ isset($input['method']) ? $input['method'] : 'POST' }}" enctype="multipart/form-data">
                 @csrf
                 <div class="modal-body">
                     {{ $body }}
                 </div>
                 <div class="modal-footer">
                     @if (!isset($input['isConfirmation']))
                         <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                         <button type="submit"
                             class="btn btn-primary btn-sm action-btn">{{ isset($input['submitBtn']) ? $input['submitBtn'] : 'Save' }}</button>
                     @else
                         <button type="button" data-dismiss="modal" class="btn btn-primary btn-sm">Ok</button>
                     @endif
                 </div>
             </form>
         </div>
     </div>
 </div>
