<li class="{{ $class }}" onclick="{{ $onclick }}"
@if(!empty($url))
    episodeid="{{ $episode->id }}" productid="{{ $product->id }}" cover="{{ url(route('getPublicImage', ['Episode-' . $episode->id . '-main', rand()])) }}" data-url="{{ $url }}"
@endif
>
    @if(empty($url))
        <div class="lectures_lists_title">
            <i class="fas fa-lock dios"></i>
        </div>{{ $episode->title }}<span class="cls_timing text-dark">{{ number_format($episode->price). ' ' . __('general.toman') . ' / ' . $episode->time }}</span>
    @else
        <div class="lectures_lists_title">
            <i class="fas fa-{{ !empty($watchDetail[$episode->id]) ? 'check' : 'play' }} dios"></i>
        </div>{{ $episode->title }}<span class="cls_timing text-dark">{{ $episode->time }}</span>
    @endif
</li>

@push('scripts')
    <script>
        function scrollup()
        {
            window.scrollTo({ top: 0, behavior: 'smooth' })
        }

        function login()
        {
            window.location.href = "{{ route('login') }}";
        }
    </script>
@endpush
