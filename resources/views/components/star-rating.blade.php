<!-- Star Rating Component -->
<div x-data="starRating({{ $rating ?? 0 }}, {{ $editable ?? false }})" class="flex items-center space-x-1">
    <template x-for="star in 5" :key="star">
        <button 
            x-show="editable"
            @click="setRating(star)"
            @mouseenter="hoverRating = star"
            @mouseleave="hoverRating = 0"
            type="button"
            class="focus:outline-none transition-transform hover:scale-110"
        >
            <svg 
                class="w-6 h-6 transition-colors"
                :class="star <= (hoverRating || currentRating) ? 'text-yellow-400 fill-current' : 'text-gray-300'"
                fill="none" 
                stroke="currentColor" 
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.381-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
            </svg>
        </button>
        <svg 
            x-show="!editable"
            class="w-5 h-5"
            :class="star <= currentRating ? 'text-yellow-400 fill-current' : (star - 0.5 <= currentRating ? 'text-yellow-400' : 'text-gray-300')"
            fill="none" 
            stroke="currentColor" 
            viewBox="0 0 24 24"
        >
            <path 
                :fill="star <= currentRating ? 'currentColor' : (star - 0.5 <= currentRating ? 'url(#half-star)' : 'none')"
                stroke-linecap="round" 
                stroke-linejoin="round" 
                stroke-width="2" 
                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.539-1.118l1.519-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.783-.57-.381-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" 
            />
        </svg>
    </template>
    <input type="hidden" name="rating" x-model="currentRating">
    <span x-show="!editable && showNumber" class="ml-2 text-sm text-gray-600" x-text="currentRating.toFixed(1)"></span>
</div>

<!-- SVG for half stars -->
<svg width="0" height="0" style="position: absolute;">
    <defs>
        <linearGradient id="half-star">
            <stop offset="50%" stop-color="currentColor"/>
            <stop offset="50%" stop-color="transparent"/>
        </linearGradient>
    </defs>
</svg>

<script>
function starRating(initialRating = 0, editable = false) {
    return {
        currentRating: parseFloat(initialRating),
        hoverRating: 0,
        editable: editable,
        showNumber: !editable,
        setRating(rating) {
            if (this.editable) {
                this.currentRating = rating;
            }
        }
    }
}
</script>
