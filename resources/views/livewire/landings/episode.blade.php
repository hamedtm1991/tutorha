<li class="{{ $class }}" onclick="{{ $onclick }}">
    @if(!Auth::check() && empty($url))
        <a href="{{ route('login') }}">
            <span class="unview">
                <div class="lectures_lists_title">
                    <span class="fas fa-lock dios"></span>
                    <span class="text-dark">{{ $episode->title }}</span>
                </div>
                <span class="cls_timing">{{ number_format($episode->price) . ' / ' . $episode->time }}</span>
            </span>
        </a>
    @elseif(empty($url))
        <span>
            <div class="lectures_lists_title">
                <span class="fas fa-lock dios"></span>
                <span class="text-dark">{{ $episode->title }}</span>
                <span class="cls_timing">{{ number_format($episode->price) . ' / ' . $episode->time }}</span>
            </div>
        </span>
    @else
        <span class="videourl" episodeid="{{ $episode->id }}" productid="{{ $product->id }}" cover="{{ url(route('getPublicImage', ['Episode-' . $episode->id . '-main', rand()])) }}" data-url="{{ $url }}">
            <div class="lectures_lists_title">
                <span class="fas fa-{{ !empty($watchDetail[$episode->id]) ? 'check' : 'play' }} dios"></span>
                <span class="text-dark">{{ $episode->title }}</span>
            </div>
            <span class="cls_timing">{{ $episode->time }}</span>
        </span>
    @endif
</li>


@push('scripts')
    <script>
        function scrollup()
        {
            window.scrollTo({ top: 0, behavior: 'smooth' })
        }
    </script>
@endpush
