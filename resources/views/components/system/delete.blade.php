 <!-- Button trigger modal -->
 <button type="button" class="btn btn-danger btn-sm mr-1 ml-1" data-toggle="modal" data-target="#{{ $input['id'] ?? '' }}"
     id="{{ $input['btnId'] ?? '' }}">
     {!! isset($input['btnIcon']) ? "<i class=\"{$input['btnIcon']}\"></i>" : "<i class='fa fa-trash'></i>" !!} {{ isset($input['btnTitle']) ? $input['btnTitle'] : '' }}
 </button>

 <!-- Modal -->
 <div class="modal fade" id="{{ $input['id'] ?? '' }}" role="dialog" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">
                     Delete Confirmation</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>

             <form action="{{ route($input['indexUrl'] . '.destroy', $input['itemId']) }}" method="post">
                 @csrf @method('DELETE')
                 <div class="modal-body text text-center">
                     <span>Are you sure you want to delete this?</span>
                 </div>
                 <div class="modal-footer">
                     <button type="submit" class="btn btn-primary btn-sm">Yes</button>
                     <button type="button" data-dismiss="modal" class="btn btn-danger btn-sm">No</button>
                 </div>

             </form>

         </div>
     </div>
 </div>
