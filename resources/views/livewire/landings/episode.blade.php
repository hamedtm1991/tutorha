<div>
    <a style="display: @if(empty($url)) none @endif" class="videourl" episodeid="{{ $episode->id }}" productid="{{ $product->id }}" cover="{{ url(route('getPublicImage', ['Episode-' . $episode->id . '-main', rand()])) }}" data-url="{{ $url }}"><li class="complete"><div class="lectures_lists_title"><i class="fas fa-{{ !empty($watchDetail[$episode->id]) ? 'check' : 'play' }} dios"></i></div>{{ $episode->title }}<span class="cls_timing">{{ $episode->time }}</span></li></a>

    @if(!Auth::check() && empty($url))
        <a wire:click="login"><li class="unview"><div class="lectures_lists_title"><i class="fas fa-lock dios"></i></div>{{ $episode->title }}<span class="cls_timing">{{ number_format($episode->price) . ' / ' . $episode->time }}</span></li></a>
    @elseif(empty($url))
        <a onclick="getConfirm('landings.episode', 'pay-{{ $episode->id }}', '{{ $episode->id }}', '{{ __('general.sure') }}', '{{ __('general.reducingMoney', ['value' => number_format($episode->price) . ' ' . __('general.toman')]) }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')"><li class="unview"><div class="lectures_lists_title"><i class="fas fa-lock dios"></i></div>{{ $episode->title }}<span class="mx-3">{{ number_format($episode->price) . ' ' . __('general.toman') }}</span><span class="cls_timing">{{ $episode->time }}</span></li></a>
    @endif
</div>
