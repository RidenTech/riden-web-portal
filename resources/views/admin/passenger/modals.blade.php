<!-- Block/Unblock Confirmation Modal -->
<div class="modal fade" id="toggleStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div class="status-icon-ring mx-auto mb-3" style="width: 70px; height: 70px; background: rgba(239, 68, 68, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-exclamation-triangle-fill text-danger fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Change Passenger Status?</h4>
                    <p class="text-muted">Are you sure you want to change the status for this passenger? This may affect their ability to use the mobile app.</p>
                </div>
                <div class="d-flex gap-3 justify-content-center mt-4">
                    <button type="button" class="btn btn-light px-4 fw-bold" data-bs-dismiss="modal" style="border-radius: 12px;">Cancel</button>
                    <form action="{{ route('admin.passenger.toggleStatus', $passenger->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger px-4 fw-bold" style="border-radius: 12px; background: var(--riden-red); border: none;">
                            Yes, Proceed
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deletePassengerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
            <div class="modal-body p-4 text-center">
                <div class="mb-3">
                    <div class="status-icon-ring mx-auto mb-3" style="width: 70px; height: 70px; background: rgba(239, 68, 68, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-trash3-fill text-danger fs-1"></i>
                    </div>
                    <h4 class="fw-bold mb-2">Delete Passenger?</h4>
                    <p class="text-muted">This action cannot be undone. All passenger history will be permanently deleted from the system.</p>
                </div>
                <div class="d-flex gap-3 justify-content-center mt-4">
                    <button type="button" class="btn btn-light px-4 fw-bold" data-bs-dismiss="modal" style="border-radius: 12px;">Cancel</button>
                    <form action="{{ route('admin.passenger.delete', $passenger->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger px-4 fw-bold" style="border-radius: 12px; background: var(--riden-red); border: none;">
                            Permanently Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
