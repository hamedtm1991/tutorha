<div id="main-wrapper">
    <!-- ============================ Page Title Start================================== -->
    <div class="ed_detail_head">
        <div class="container">
            <div class="row align-items-center">

                <div class="col-lg-8 col-md-7">
                    <div class="ed_detail_wrap">
                        @foreach($tags as $tag)
                            <div class="crs_cates cl_{{ $i }}"><span>{{ $tag }}</span></div>
                            @php($i--)
                        @endforeach
                        <div class="ed_header_caption">
                            <h2 class="ed_title">{{ $product->title }}</h2>
                            <ul>
                                <li><i class="fa fa-clock"></i>{{ $product->options['time'] }}</li>
                                <li><i class="fa fa-video"></i>{{ $product->options['numberOfEpisodes'] . ' ' . __('general.episode') }}</li>
                                <li><i class="fa fa-signal"></i>{{ __('general.' . $product->options['level']) }}</li>
                            </ul>
                        </div>
                        <div class="ed_header_short">
                            {!! $product->description !!}
                        </div>
                    </div>
                </div>
                <div wire:ignore>
                    <video
                        id="player"
                        class="video-js vjs-fluid vjs-default-skin vjs-big-play-centered"
                        width="640" height="268"
                        controls
                        preload="auto"
                        data-setup='{"controlBar": {"pictureInPictureToggle": false}}'
                    >
                    </video>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ Course Detail ================================== -->
    <section class="gray">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-12 order-lg-first">

                    @if($product->long_description)
                        <!-- Overview -->
                        <div class="edu_wraper">
                            {!! $product->long_description !!}
                        </div>
                    @endif

                    <div class="edu_wraper">
                        <h4 class="edu_title">{{ __('general.episodes') }}</h4>
                        <div id="accordionExample" class="accordion shadow circullum">
                            @foreach($episodes as $index => $group)
                                <div class="card">
                                    <div id="heading{{ $index }}" class="card-header bg-white shadow-sm border-0">
                                        <h6 class="mb-0 accordion_title"><a href="#" data-toggle="collapse" data-target="#collapse{{ $index }}" aria-expanded="true" aria-controls="collapse{{ $index }}" class="d-block position-relative text-dark collapsible-link py-2">{{ $index }}</a></h6>
                                    </div>
                                    <div id="collapse{{ $index }}" aria-labelledby="heading{{ $index }}" data-parent="#accordionExample" class="collapse show">
                                        <div class="card-body pl-3 pr-3">
                                            <ul class="lectures_lists">
                                                @foreach($group as $episode)
                                                    @php($url = getVideoUrl($episode->links[0] ?? '', $episode))
                                                    <a style="display: @if(empty($url)) none @endif" class="videourl" episodeid="{{ $episode->id }}" productid="{{ $product->id }}" cover="{{ url(route('getPublicImage', ['episode-' . $episode->id . '-main', rand()])) }}" data-url="{{ $url }}"><li class="complete"><div class="lectures_lists_title"><i class="fas fa-{{ !empty($watchDetail[$episode->id]) ? 'check' : 'play' }} dios"></i></div>{{ $episode->title }}<span class="cls_timing">{{ $episode->time }}</span></li></a>

                                                    @if(!Auth::check() && empty($url))
                                                        <a wire:click="login"><li class="unview"><div class="lectures_lists_title"><i class="fas fa-lock dios"></i></div>{{ $episode->title }}<span class="cls_timing">{{ number_format($episode->price) . ' / ' . $episode->time }}</span></li></a>
                                                    @elseif(empty($url))
                                                        <a onclick="getConfirm('landings.course', 'pay', '{{ $episode->id }}', '{{ __('general.sure') }}', '{{ __('general.reducingMoney', ['value' => number_format($episode->price) . ' ' . __('general.toman')]) }}', '{{ __('buttons.yes') }}', '{{ __('buttons.no') }}')"><li class="unview"><div class="lectures_lists_title"><i class="fas fa-lock dios"></i></div>{{ $episode->title }}<span class="mx-3">{{ number_format($episode->price) . ' ' . __('general.toman') }}</span><span class="cls_timing">{{ $episode->time }}</span></li></a>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- instructors -->
                    @foreach($product->tutors as $tutor)
                        <div class="single_instructor">
                            <div class="single_instructor_thumb">
                                <a href="#"><img src="{{ url(route('getPublicImage', ['Tutor-' . $tutor->id . '-main', rand()])) }}" class="img-fluid" alt="{{ $tutor->name }}"></a>
                            </div>
                            <div class="single_instructor_caption">
                                <h4><a href="#">{{ $tutor->name }}</a></h4>
                                <p>{{ $tutor->description }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 order-lg-last">

                    <div class="ed_view_box style_2 stick_top">
                        <div class="ed_view_features">
                            <div class="eld mb-3">
                                <ul class="edu_list right">
                                    <li><i class="ti-time"></i>{{ __('general.episodes') }}:<strong>{{ $product->options['numberOfEpisodes'] }}</strong></li>
                                    <li><i class="ti-time"></i>{{ __('general.courseTime') }}:<strong>{{ $product->options['time'] }}</strong></li>
                                    <li><i class="ti-tag"></i>{{ __('general.level') }}:<strong>{{ __('general.' . $product->options['level']) }}</strong></li>
                                    <li><i class="ti-check"></i>{{ __('general.status') }}:<strong>{{ $product->is_finished ? __('general.finished') : __('general.notFinished') }}</strong></li>
                                </ul>
                            </div>
                            <div class="eld mb-3">
                                <h5 class="font-medium">ویژگی ها:</h5>
                                <ul>
                                    @foreach($product->options['features'] as $feature)
                                        <li><i class="fa fa-check"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- ============================ Course Detail ================================== -->

    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
</div>

@push('seo')
    <meta name="description" content="{{ $product->description }}">
    <meta name="keywords" content="{{ $product->options['metaKeywords'] }}">
    <title>{{ $product->title }}</title>
@endpush
