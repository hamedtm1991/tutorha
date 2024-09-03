<div>
    <ul class="lectures_lists">
        @if(!Auth::check() && empty($url))
            <li href="{{ route('login') }}">
            <span class="unview"><div class="lectures_lists_title">
                    <span class="fas fa-lock dios"></span>
                    <span class="text-dark">{{ $episode->title }}</span>
                </div>
                <span class="cls_timing">{{ number_format($episode->price) . ' / ' . $episode->time }}</span>
            </span>
            </li>
        @elseif(empty($url))
            <li class="unview">
            <span onclick="getConfirm('landings.episode', 'pay-{{ $episode->id }}', '{{ $episode->id }}', '{{ __('general.sure') }}', '{{ __('general.reducingMoney', ['value' => number_format($episode->price) . ' ' . __('general.toman')]) }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')">
                <div class="lectures_lists_title">
                    <span class="fas fa-lock dios"></span>
                    <span class="text-dark">{{ $episode->title }}</span>
                </div>
                <span class="mx-3">{{ number_format($episode->price) . ' ' . __('general.toman') }}</span>
                <span class="cls_timing">{{ $episode->time }}</span>
            </span>
            </li>
        @else
            <li class="complete">
            <span style="display: @if(empty($url)) none @endif" class="videourl" episodeid="{{ $episode->id }}" productid="{{ $product->id }}" cover="{{ url(route('getPublicImage', ['Episode-' . $episode->id . '-main', rand()])) }}" data-url="{{ $url }}">
                <div class="lectures_lists_title">
                    <span class="fas fa-{{ !empty($watchDetail[$episode->id]) ? 'check' : 'play' }} dios"></span>
                    <span class="text-dark">{{ $episode->title }}</span>
                </div>
                <span class="cls_timing">{{ $episode->time }}</span>
            </span>
            </li>
        @endif
    </ul>
</div>
