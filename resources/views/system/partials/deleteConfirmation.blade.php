<!-- Modal -->
<div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                {{-- <form action="{{ route($indexUrl . '.destroy', $item->id) }}" method="post"> --}}
                <form action="{{ $indexUrl . '/' . $item->id }}" method="post">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm action-btn">Delete</button>
                </form>

            </div>
        </div>
    </div>
</div>
