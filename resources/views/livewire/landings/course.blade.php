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
                                                    <a class="videourl" cover="{{ url(route('getPublicImage', ['episode-' . $episode->id . '-main', rand()])) }}" data-url="{{ getVideoUrl($episode->links[0]) }}"><li class="complete"><div class="lectures_lists_title"><i class="fas fa-check dios"></i></div>{{ $episode->title }}<span class="cls_timing">{{ $episode->time }}</span></li></a>
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
                                <a href="#"><img src="{{ url(route('getPublicImage', ['tutor-' . $tutor->id . '-main', rand()])) }}" class="img-fluid" alt=""></a>
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

                        <div class="ed_author">
                            <h2 class="theme-cl m-0">{{ number_format($product->price) }}
                                @if($product->fake_price)
                                    <span class="old_prc">{{ number_format($product->fake_price) }}</span>
                                @endif
                            </h2>
                        </div>
                        <div class="ed_view_features">
                            <div class="eld mb-3">
                                <ul class="edu_list right">
                                    <li><i class="ti-time"></i>{{ __('general.episodes') }}:<strong>{{ $product->options['numberOfEpisodes'] }}</strong></li>
                                    <li><i class="ti-time"></i>{{ __('general.courseTime') }}:<strong>{{ $product->options['time'] }}</strong></li>
                                    <li><i class="ti-tag"></i>{{ __('general.level') }}:<strong>{{ __('general.' . $product->options['level']) }}</strong></li>
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
                        <div class="ed_view_link">
                            <a href="#" class="btn theme-bg enroll-btn">ثبت نام<i class="ti-angle-left"></i></a>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </section>
    <!-- ============================ Course Detail ================================== -->

    <!-- ============================ Call To Action ================================== -->
    <section class="theme-bg call_action_wrap-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">

                    <div class="call_action_wrap">
                        <div class="call_action_wrap-head">
                            <h3 class="font-2">آیا سوالی دارید؟</h3>
                            <span>ما به شما کمک خواهیم کرد تا شغل و رشد خود را افزایش دهید.</span>
                        </div>
                        <a href="#" class="btn btn-call_action_wrap">امروز با ما تماس بگیرید</a>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Call To Action End ================================== -->

    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
</div>

