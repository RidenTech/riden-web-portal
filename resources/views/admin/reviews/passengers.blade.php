<!-- Passenger Reviews Partial -->
<div class="reviews-container">
    
    <!-- 1. Header Row -->
    <div class="reviews-header-row riden-list-header d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <div class="riden-search-bar me-3">
                <div class="riden-search-icon">
                    <i class="bi bi-search"></i>
                </div>
                <input type="text" placeholder="Search passenger reviews...">
            </div>
            
            <div class="date-range-picker">
                <i class="bi bi-calendar-range"></i>
                <span>{{ date('d/m/Y') }} - {{ date('d/m/Y') }}</span>
            </div>
        </div>
        
        <div>
            <button class="btn btn-primary px-4 fw-semibold" style="border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#addPassengerReviewModal">
                <i class="bi bi-plus-lg me-1"></i> Add Review
            </button>
        </div>
    </div>

    <!-- 2. Tabs Row -->
    <div class="riden-tabs-container">
        <a href="{{ route('admin.reviews.ratings', ['tab' => 'drivers']) }}" class="riden-tab-item">Drivers Reviews</a>
        <a href="{{ route('admin.reviews.ratings', ['tab' => 'passengers']) }}" class="riden-tab-item active">Passengers Reviews</a>
    </div>

    <!-- 3. Stats Summary Card -->
    <div class="reviews-stats-card">
        <!-- Total Reviews -->
        <div class="stat-group">
            <div class="stat-label">Total Reviews</div>
            <div class="stat-value">{{ number_format($totalReviews ?? 0) }}</div>
            <div class="stat-growth text-success"><i class="bi bi-arrow-up-right"></i> Live Data</div>
        </div>

        <!-- Average Rating -->
        <div class="stat-group">
            <div class="stat-label">Average Rating</div>
            <div class="d-flex align-items-center">
                <div class="stat-value">{{ $averageRating ?? '0.0' }}</div>
                <div class="rating-stars" style="color: #FFC107;">
                    @php $avg = (float)($averageRating ?? 0); @endphp
                    @for($i=1; $i<=5; $i++)
                        @if($i <= $avg)
                            <i class="bi bi-star-fill"></i>
                        @elseif($i - 0.5 <= $avg)
                            <i class="bi bi-star-half"></i>
                        @else
                            <i class="bi bi-star"></i>
                        @endif
                    @endfor
                </div>
            </div>
            <div class="rating-subtext">Overall average rating</div>
        </div>

        <!-- Progress Bars -->
        <div class="rating-progress-group">
            @if(isset($ratingProgress))
                @foreach ($ratingProgress as $stars => $p)
                    <div class="rating-progress-item">
                        <span class="star-count">{{ $p['label'] }}</span>
                        <div class="progress-bar-container" style="background: #eee; flex-grow: 1; height: 8px; border-radius: 4px; margin: 0 10px; overflow: hidden;">
                            <div class="progress-fill" style="background: #FFC107; height: 100%; width: {{ $p['percentage'] }}%;"></div>
                        </div>
                        <span class="small text-muted">{{ $p['count'] }}</span>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <!-- 4. Reviews List -->
    <div class="reviews-list mt-4">
        @forelse ($reviews ?? [] as $review)
        <div class="review-item-card p-3 border rounded mb-3 shadow-sm" style="background: #fff;">
            <div class="review-item-header d-flex justify-content-between align-items-center mb-2">
                <div class="reviewer-info d-flex align-items-center">
                    <div class="rounded-circle bg-info text-white d-flex align-items-center justify-content-center me-3" style="width: 45px; height: 45px; font-weight: bold; font-size: 18px;">
                        {{ strtoupper(substr($review->passenger->first_name ?? 'P', 0, 1)) }}
                    </div>
                    <div>
                        <h5 class="reviewer-name mb-0 fw-bold">{{ $review->passenger->first_name ?? 'Unknown' }} {{ $review->passenger->last_name ?? 'Passenger' }}</h5>
                        <div class="reviewer-rating" style="color: #FFC107; font-size: 14px;">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $review->rating)
                                    <i class="bi bi-star-fill"></i>
                                @elseif($i - 0.5 <= $review->rating)
                                    <i class="bi bi-star-half"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                            <span class="text-muted ms-1">({{ number_format($review->rating, 1) }})</span>
                        </div>
                    </div>
                </div>
                <div class="review-meta text-end">
                    <div class="review-date text-muted small">{{ $review->created_at->format('d-m-Y h:ia') }}</div>
                    <div class="badge bg-light text-dark border mt-1">Passenger ID: {{ $review->passenger_id }}</div>
                </div>
            </div>
            <div class="review-body text-muted mb-3" style="font-size: 14px; line-height: 1.6;">
                {{ $review->review_text ?? 'No review text provided.' }}
            </div>
            <div class="review-footer d-flex justify-content-between align-items-center border-top pt-2 mt-2">
                <div class="by-passenger text-muted small fw-semibold">
                    <i class="bi bi-person-fill me-1"></i> By {{ $review->reviewer_name ?? 'Admin/Driver' }}
                </div>
                <form action="{{ route('admin.reviews.destroyPassenger', $review->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this review?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger border-0"><i class="bi bi-trash"></i></button>
                </form>
            </div>
        </div>
        @empty
        <div class="text-center p-5 border rounded" style="background: #f8f9fa;">
            <i class="bi bi-chat-left-text text-muted mb-3 d-block" style="font-size: 3rem;"></i>
            <h5 class="fw-bold text-dark">No Passenger Reviews Yet</h5>
            <p class="text-muted">Click the "Add Review" button to create the first review for a passenger.</p>
        </div>
        @endforelse
    </div>

</div>

<!-- Add Passenger Review Modal -->
<div class="modal fade" id="addPassengerReviewModal" tabindex="-1" aria-labelledby="addPassengerReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="addPassengerReviewModalLabel">Assign Review to Passenger</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.reviews.storePassenger') }}" method="POST">
                @csrf
                <div class="modal-body">
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Select Passenger</label>
                        <select name="passenger_id" class="form-select form-select-lg" style="font-size: 14px;" required>
                            <option value="">-- Choose a Passenger --</option>
                            @foreach($passengers ?? [] as $p)
                                <option value="{{ $p->id }}">{{ $p->first_name }} {{ $p->last_name }} (ID: {{ $p->id }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Reviewer Name (e.g. Driver Name)</label>
                        <input type="text" name="reviewer_name" class="form-control" placeholder="Ronald Richards" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Rating (1 to 5)</label>
                        <div class="d-flex align-items-center bg-light p-2 rounded" style="gap: 15px;">
                            <input type="range" name="rating" min="1" max="5" step="0.5" value="5" class="form-range flex-grow-1" id="passengerRatingSlider" oninput="document.getElementById('passengerRatingOutput').innerText = this.value + ' Stars'">
                            <span id="passengerRatingOutput" class="badge bg-warning text-dark fw-bold px-3 py-2" style="font-size: 14px;">5 Stars</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold text-muted small">Review Text</label>
                        <textarea name="review_text" class="form-control" rows="4" placeholder="Write the review details here..." required></textarea>
                    </div>

                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4 fw-semibold" style="border-radius: 8px;">Save Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
