<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
            <div class="modal-body text-center p-5">
                <div class="mb-4">
                    <i class="bi bi-exclamation-triangle-fill text-danger" style="font-size: 60px;"></i>
                </div>
                <h4 class="fw-bold mb-3">Delete Passenger?</h4>
                <p class="text-muted mb-4">Are you sure you want to delete <strong>{{ $passenger->first_name }} {{ $passenger->last_name }}</strong>? This action cannot be undone.</p>
                
                <form action="{{ route('admin.passenger.delete', $passenger->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="d-flex gap-3 justify-content-center">
                        <button type="button" class="btn btn-light px-4 fw-bold" data-bs-dismiss="modal" style="border-radius: 10px;">Cancel</button>
                        <button type="submit" class="btn btn-danger px-4 fw-bold" style="border-radius: 10px;">Yes, Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add other modals here if needed -->
