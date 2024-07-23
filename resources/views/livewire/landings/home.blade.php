<div>
    <!-- ============================ Hero Banner  Start================================== -->
    <div class="hero_banner image-cover image_bottom h7_bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="simple-search-wrap text-right">
                        <div class="hero_search-2">
                            <div class="elsio_tag mb-5" style="font-size: large">یادگیری ساختارمند و اصولی</div>
                            <h1 class="banner_title mb-4 font-2">در مسیر پیشرفت<br>با دوره‌های آموزشی توترها<br><span class="light">در کنار شما هستیم...</span></h1>
                            <p class="mb-4" style="font-size: x-large">آموزش برنامه‌نویسی (Web programming), بک اند (Backend), ای تی (IT) و ... از مبتدی تا پیشرفته</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <div class="side_block extream_img">
                        <div class="list_crs_img visibledesktop">
                            <img src="{{ secure_asset('storage/home/ic-1.png') }}" class="img-fluid cirl animate-fl-y" alt="circle" />
                            <img src="{{ secure_asset('storage/home/ic-2.png') }}" class="img-fluid arrow animate-fl-x" alt="arrow" />
                            <img src="{{ secure_asset('storage/home/ic-3.png') }}" class="img-fluid moon animate-fl-x" alt="moon" />
                        </div>
                        <img src="{{ secure_asset('storage/home/side-2.png') }}" class="img-fluid" alt="guy" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Hero Banner End ================================== -->

    <!-- ============================ Our Awards Start ================================== -->
    <section class="p-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="crp_box ovr_top">
                        <div class="row align-items-center m-0">
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12">
                                <div class="crp_tags"><h6>تهیه دوره‌ها از بهترین انتشارات‌ها</h6></div>
                            </div>
                            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12">
                                <div class="part_rcp">
                                    <ul>
                                        <li><a href="{{ route('landings', ['title' => 'oreilly']) }}"><div class="crp_img"><img src="{{ secure_asset('storage/home/lg-12.png') }}" class="img-fluid" alt="O’Reilly" /></div></a></li>
                                        <li><a href="{{ route('landings', ['title' => 'packt']) }}"><div class="crp_img"><img src="{{ secure_asset('storage/home/lg-52.png') }}" class="img-fluid" alt="packt" /></div></a></li>
                                        <li><a href="{{ route('landings', ['title' => 'wiley']) }}"><div class="crp_img"><img src="{{ secure_asset('storage/home/lg-62.png') }}" class="img-fluid" alt="wiley" /></div></a></li>
                                        <li><a href="{{ route('landings', ['title' => 'manning']) }}"><div class="crp_img"><img src="{{ secure_asset('storage/home/lg-72.png') }}" class="img-fluid" alt="manning" /></div></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Our Awards End ================================== -->

    <!-- ============================ Latest Cources Start ================================== -->
    <section>
        <div class="container">
            <div class="row justify-content-start">
                <div class="col-lg-7 col-md-8">
                    <div class="sec-heading">
                        <h3 class="font-2">دوره‌ها</h3>
                    </div>
                </div>
            </div>

            <div class="row justify-content-start">
                <!-- Single Grid -->
                @foreach($data as $model)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="crs_grid">
                            <div class="crs_grid_thumb">
                                <a href="{{ route('course', [$model->id, str_replace(' ', '-', $model->title)]) }}" class="crs_detail_link">
                                    <img src="{{ url(route('getPublicImage', ['Product-' . $model->id . '-main', rand()])) }}" class="rounded" alt="{{ $model->title }}" />
                                </a>
                            </div>
                            <div class="crs_grid_caption">
                                <div class="crs_flex">
                                    <div class="crs_fl_first">
                                        @foreach($model->tags->pluck('name')->toArray() as $tag)
                                            <div class="crs_cates cl_8"><span>{{ $tag }}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="crs_title text-truncate"><h4><a href="{{ route('course', [$model->id, str_replace(' ', '-', $model->title)]) }}" class="crs_title_link">{{ $model->title }}...</a></h4></div>
                                <div class="crs_info_detail">
                                    <ul>
                                        <li><i class="fa fa-clock text-danger"></i><span>{{ $model->options['time'] }}</span></li>
                                        <li><i class="fa fa-video text-success"></i><span>{{ $model->options['numberOfEpisodes'] . ' ' . __('general.episode') }}</span></li>
                                        <li><i class="fa fa-signal text-warning"></i><span>{{ __('general.' . $model->options['level']) }}</span></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="crs_grid_foot">
                                <div class="crs_flex">
                                    <div class="crs_fl_first">
                                        <div class="crs_tutor">
                                            @foreach($model->tutors as $tutor)
                                                <div class="crs_tutor_thumb"><a href="instructor-detail.html"><img src="{{ url(route('getPublicImage', ['Tutor-' . $tutor->id . '-main', rand()])) }}" class="img-fluid circle" alt="{{ $tutor->name }}" /></a></div><div class="crs_tutor_name"><a href="instructor-detail.html">{{ $tutor->name }}</a></div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

{{--            <div class="row justify-content-center">--}}
{{--                <div class="col-lg-7 col-md-8 mt-2">--}}
{{--                    <div class="text-center"><a href="grid-layout-with-sidebar.html" class="btn btn-md theme-bg-light theme-cl">مشاهده سایر دوره ها</a></div>--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </section>
    <!-- ============================ Latest Cources End ================================== -->

    <!-- ============================ Featured Categories Start ================================== -->
    <div class="clearfix"></div>
    <!-- ============================ Featured Categories End ================================== -->

    <!-- ============================ Work Process Start ================================== -->
    <section>
        <div class="container">

            <div class="row align-items-center justify-content-between mb-5">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="lmp_caption">
                        <h4 class="mb-3 font-2">سعی ما بر این است که یادگیری را برای شما لذت بخش کنیم.</h4>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mx-3">دسترسی مادام العمر به قسمت‌های خریداری شده</h6>
                            </div>
                        </div>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mx-3">امکان تهیه هر قسمت از دوره به صورت مجزا</h6>
                            </div>
                        </div>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mx-3">استفاده از بهترین منابع</h6>
                            </div>
                        </div>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mx-3">پشتیبانی</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                    <div class="lmp_thumb">
                        <img style="border-radius: 5%" src="{{ secure_asset('storage/home/lmp-21.jpg') }}" class="img-fluid" alt="attentions" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
                    <div class="lmp_thumb">
                        <img style="border-radius: 5%" src="{{ secure_asset('storage/home/lmp-24.jpg') }}" class="img-fluid" alt="our goal" />
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                    <div class="lmp_caption">
                        <div class="mx-3" style="text-align: justify">
                            <h2 class="font-2">هدف ما</h2>
                            <p style="font-size: large">
                                از آن جا که بسیاری از برنامه‌نویسان دانش خود را به صورت تجربی کسب کرده‌اند و  همینطور برخی از منابع نیز انتقال دانش‌ را فقط به صورت تجربی در نظر گرفته‌اند، تیم ما قصد دارد آموزش‌هایی با کیفیت، اصولی و با استفاده از بهترین منابع به روز دنیا در سطوح مختلف آموزشی تهیه نماید.
                                <br>
                                امیدواریم در مسیر حرفه‌ای شدن، راه را برای شما هموارتر کنیم.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ============================ Work Process End ================================== -->

    <!-- ============================ Students Reviews ================================== -->

    <!-- ============================ Students Reviews End ================================== -->

    <!-- ============================ article Start ================================== -->
    <div class="clearfix"></div>
    <!-- ============================ article End ================================== -->

    <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>
</div>

@push('seo')
    <meta name="description" content="آموزش برنامه‌نویسی (Web programming), بک اند (Backend), ای تی (IT) و ... از مبتدی تا پیشرفته">
    <meta name="keywords" content="backend, نرم افزار ,بک اند ,کامپیوتر  ,برنامه‌نویسی ,آموزش">
    <title>خانه</title>
@endpush
