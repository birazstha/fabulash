 <!-- Button trigger modal -->
 <button type="button" class="btn btn-{{ $input['btnColor'] }} btn-sm" data-toggle="modal"
     data-target="#{{ $input['id'] ?? '' }}" id="{{ $input['btnId'] ?? '' }}">
     {!! isset($input['icon']) ? "<i class=\"{$input['icon']}\"></i>" : '' !!} {{ isset($input['btn-title']) ? $input['btn-title'] : '' }}

 </button>

 <!-- Modal -->
 <div class="modal fade" id="{{ $input['id'] ?? '' }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">{{ isset($input['title']) ? $input['title'] : '' }}</h5>
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
                             class="btn btn-primary btn-sm">{{ isset($input['primaryBtn']) ? $input['primaryBtn'] : 'Save' }}</button>
                     @else
                         <button type="button" data-dismiss="modal" class="btn btn-primary btn-sm">Ok</button>
                     @endif
                 </div>
             </form>
         </div>
     </div>
 </div>
