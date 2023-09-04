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

                    @if($product->long_description)
                        <!-- Overview -->
                        <div class="edu_wraper">
                            {!! $product->long_description !!}
                        </div>
                    @endif

                    <div class="edu_wraper">
                        <h4 class="edu_title">آموزش کار با Premiere Pro</h4>
                        <div id="accordionExample" class="accordion shadow circullum">

                            <!-- Part 1 -->
                            <div class="card">
                                <div id="headingOne" class="card-header bg-white shadow-sm border-0">
                                    <h6 class="mb-0 accordion_title"><a href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="d-block position-relative text-dark collapsible-link py-2">مقدمه و معرفی دوره</a></h6>
                                </div>
                                <div id="collapseOne" aria-labelledby="headingOne" data-parent="#accordionExample" class="collapse show">
                                    <div class="card-body pl-3 pr-3">
                                        <ul class="lectures_lists">
                                            <li class="complete"><div class="lectures_lists_title"><i class="fas fa-check dios"></i></div>نحوه ایمپورت کردن فایل‌ها و مرتب سازی آنها<span class="cls_timing">40:20</span></li>
                                            <li class="progressing"><div class="lectures_lists_title"><i class="fas fa-play dios"></i></div>پوشه بندی و ساختار فایل‌ها به روش من<span class="cls_timing">20:12</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>آشنایی با پنل‌های اصلی در پریمیر<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>اجرای پریمیر و ایجاد اولین پروژه در پریمیر<span class="cls_timing">25:05</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>آشنایی با فضای نرم افزار پریمیر و درک Workspace<span class="cls_timing">18:10</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Part 2 -->
                            <div class="card">
                                <div id="headingTwo" class="card-header bg-white shadow-sm border-0">
                                    <h6 class="mb-0 accordion_title"><a href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" class="d-block position-relative collapsed text-dark collapsible-link py-2">شروع کار با پریمیر پرو</a></h6>
                                </div>
                                <div id="collapseTwo" aria-labelledby="headingTwo" data-parent="#accordionExample" class="collapse">
                                    <div class="card-body pl-3 pr-3">
                                        <ul class="lectures_lists">
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>نحوه ساخت یک سکانس جدید<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>Link و Overwrite کردن فایل ها<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>نکات مهم برای یک تدوین عالی و مناسب بازارکار<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>آشنایی کامل با تایم لاین در پریمیر<span class="cls_timing">25:05</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>پنل Program Monitor و تنظیمات مهم آن<span class="cls_timing">18:10</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Part 3 -->
                            <div class="card">
                                <div id="headingThree" class="card-header bg-white shadow-sm border-0">
                                    <h6 class="mb-0 accordion_title"><a href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" class="d-block position-relative collapsed text-dark collapsible-link py-2">ادیتینگ (تدوین ویدیو در پریمیر) از مبتدی تا حرفه ای</a></h6>
                                </div>
                                <div id="collapseThree" aria-labelledby="headingThree" data-parent="#accordionExample" class="collapse">
                                    <div class="card-body pl-3 pr-3">
                                        <ul class="lectures_lists">
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>نحوه ساخت شورتکات های جدید<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>تکنیک های سینک کردن صدا و تصویر در پریمیر<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>رزولوشن و جزئیات مربوط به آن<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>آشنایی با اصول سینک کردن<span class="cls_timing">25:05</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>مفهوم Nest کردن و بررسی جزئیات آن<span class="cls_timing">18:10</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- Part 04 -->
                            <div class="card">
                                <div id="headingFour" class="card-header bg-white shadow-sm border-0">
                                    <h6 class="mb-0 accordion_title"><a href="#" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" class="d-block position-relative collapsed text-dark collapsible-link py-2">ماسک در پریمیر  (Masking in Premiere)</a></h6>
                                </div>
                                <div id="collapseFour" aria-labelledby="headingFour" data-parent="#accordionExample" class="collapse">
                                    <div class="card-body pl-3 pr-3">
                                        <ul class="lectures_lists">
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>انیمیت کردن تصویر‌ها (Keyframes)<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>تنظیمات سکانس مخصوص ساخت ویدیو برای اینستاگرام<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>نحوه سینک صدا و تصویر به صورت دستی<span class="cls_timing">32:10</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>استفاده از مارکر ها برای سینک صدا و تصویر<span class="cls_timing">25:05</span></li>
                                            <li class="unview"><div class="lectures_lists_title"><i class="fa fa-lock dios lock"></i></div>Multi-Camera در پریمیر و نحوه کار با آن<span class="cls_timing">18:10</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

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

