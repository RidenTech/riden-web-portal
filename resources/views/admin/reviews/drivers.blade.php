<!-- Driver Reviews Partial -->
<div class="reviews-container">
    
    <!-- 1. Header Row -->
    <div class="reviews-header-row riden-list-header">
        <div class="riden-search-bar">
            <div class="riden-search-icon">
                <i class="bi bi-search"></i>
            </div>
            <input type="text" placeholder="Search reviews...">
        </div>
        
        <div class="date-range-picker">
            <i class="bi bi-calendar-range"></i>
            <span>23/04/2025 - 23/04/2025</span>
        </div>
    </div>

    <!-- 2. Tabs Row -->
    <div class="riden-tabs-container">
        <a href="{{ route('reviews.ratings', ['tab' => 'drivers']) }}" class="riden-tab-item active">Drivers Reviews</a>
        <a href="{{ route('reviews.ratings', ['tab' => 'passengers']) }}" class="riden-tab-item">Passengers Reviews</a>
    </div>

    <!-- 3. Stats Summary Card -->
    <div class="reviews-stats-card">
        <!-- Total Reviews -->
        <div class="stat-group">
            <div class="stat-label">Total Reviews</div>
            <div class="stat-value">10.0K</div>
            <div class="stat-growth">+40% Growth rate this year</div>
        </div>

        <!-- Average Rating -->
        <div class="stat-group">
            <div class="stat-label">Average Rating</div>
            <div class="d-flex align-items-center">
                <div class="stat-value">4.0</div>
                <div class="rating-stars">
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star-fill"></i>
                    <i class="bi bi-star"></i>
                </div>
            </div>
            <div class="rating-subtext">Average rating this year</div>
        </div>

        <!-- Progress Bars -->
        <div class="rating-progress-group">
            @php
                $progress = [
                    ['label' => '5 star', 'class' => 'fill-5'],
                    ['label' => '4 star', 'class' => 'fill-4'],
                    ['label' => '3 star', 'class' => 'fill-3'],
                    ['label' => '2 star', 'class' => 'fill-2'],
                    ['label' => '1 star', 'class' => 'fill-1'],
                ];
            @endphp
            @foreach ($progress as $p)
                <div class="rating-progress-item">
                    <span class="star-count">{{ $p['label'] }}</span>
                    <div class="progress-bar-container">
                        <div class="progress-fill {{ $p['class'] }}"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- 4. Reviews List -->
    <div class="reviews-list">
        @php
            $reviews = [
                ['name' => 'Floyd Miles', 'rating' => '4.5', 'date' => '22-02-2025 09:30pm', 'id' => '#34565', 'by' => 'Passenger Ronald Richards'],
                ['name' => 'Floyd Miles', 'rating' => '4.5', 'date' => '22-02-2025 09:30pm', 'id' => '#34565', 'by' => 'Passenger Ronald Richards'],
                ['name' => 'Floyd Miles', 'rating' => '4.5', 'date' => '22-02-2025 09:30pm', 'id' => '#34565', 'by' => 'Passenger Ronald Richards'],
            ];
        @endphp
        @foreach ($reviews as $review)
        <div class="review-item-card">
            <div class="review-item-header">
                <div class="reviewer-info">
                    <img src="https://i.pravatar.cc/100?img=12" class="reviewer-avatar" alt="Avatar">
                    <div>
                        <h5 class="reviewer-name">{{ $review['name'] }}</h5>
                        <div class="reviewer-rating">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                            <span>({{ $review['rating'] }})</span>
                        </div>
                    </div>
                </div>
                <div class="review-meta">
                    <div class="review-date">{{ $review['date'] }}</div>
                    <div class="booking-badge">BookingID {{ $review['id'] }}</div>
                </div>
            </div>
            <div class="review-body">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </div>
            <div class="review-footer">
                <div class="by-passenger">By {{ $review['by'] }}</div>
                <button class="delete-review-btn"><i class="bi bi-trash"></i></button>
            </div>
        </div>
        @endforeach
    </div>

</div>
