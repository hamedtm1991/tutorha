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
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ Course Detail ================================== -->
    <section class="gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 order-lg-first">

                    <div wire:ignore class="property_video radius lg mb-4">
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

                    <div class="edu_wraper">
                        <h4 class="edu_title">{{ __('general.episodes') }}</h4>
                        <div id="accordionExample" class="accordion shadow circullum">
                            <livewire:landings.episodes :$episodes :$product />
                        </div>
                    </div>


                    @if($product->long_description)
                        <!-- Overview -->
                        <div class="edu_wraper">
                            <h4 class="edu_title">{{ __('general.description') }}</h4>
                            {!! $product->long_description !!}
                        </div>
                    @endif

                    <livewire:landings.tutors :tutors="$product->tutors" />
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4 col-md-12 order-lg-last">

                    <div class="ed_view_box style_2 stick_top">
                        <div class="ed_view_features">
                            <div class="eld mb-3">
                                <ul class="edu_list right">
                                    <li>
                                        <i class="ti-user"></i>{{ __('general.tutor') }}:
                                        <strong>
                                            @foreach($product->tutors as $tutor)
                                                {{ $tutor->name }}
                                            @endforeach
                                        </strong>
                                    </li>
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
