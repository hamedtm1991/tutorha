<div>
    <!-- ============================ Hero Banner  Start================================== -->
    <div class="hero_banner image-cover image_bottom" style="background:#f7f8f9 url(assets/img/banner-1.png) no-repeat;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-10 col-sm-12">
                    <div class="simple-search-wrap">
                        <div class="hero_search-2 text-center">
                            <div class="elsio_tag">طرح تخفیف تابستان آموزشی</div>
                            <h1 class="banner_title mb-4 font-2">برگزاری محدود طرح تابستان آموزشی با 45درصد تخفیف ویژه</h1>
                            <p class="font-lg mb-4">چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.</p>
                            <div class="input-group simple_search">
                                <i class="fa fa-search ico"></i>
                                <input type="text" class="form-control" placeholder="نام دوره آموزشی...">
                                <div class="input-group-append">
                                    <button class="btn theme-bg" type="button">جستجو</button>
                                </div>
                            </div>
                        </div>
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
                                <div class="crp_tags"><h6>بیش از 700+ مسیر یادگیری آنلاین</h6></div>
                            </div>
                            <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12">
                                <div class="part_rcp">
                                    <ul>
                                        <li><div class="crp_img"><img src="assets/img/lg-1.png" class="img-fluid" alt="" /></div></li>
                                        <li><div class="crp_img"><img src="assets/img/lg-5.png" class="img-fluid" alt="" /></div></li>
                                        <li><div class="crp_img"><img src="assets/img/lg-6.png" class="img-fluid" alt="" /></div></li>
                                        <li><div class="crp_img"><img src="assets/img/lg-7.png" class="img-fluid" alt="" /></div></li>
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
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="sec-heading center">
                        <h3 class="font-2">آموزش های <span class="theme-cl">پرمخاطب</span></h3>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <!-- Single Grid -->
                @foreach($data as $model)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="crs_grid">
                            <div class="crs_grid_thumb">
                                <a href="{{ route('course', [$model->id, str_replace(' ', '-', $model->title)]) }}" class="crs_detail_link">
                                    <img src="{{ url(route('getPublicImage', ['Product-' . $model->id . '-main', rand()])) }}" class="img-fluid rounded" alt="{{ $model->title }}" />
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
                                <div class="crs_title"><h4><a href="{{ route('course', [$model->id, str_replace(' ', '-', $model->title)]) }}" class="crs_title_link">{{ $model->title }}</a></h4></div>
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
                                            <div class="crs_tutor_thumb"><a href="instructor-detail.html"><img src="assets/img/user-6.jpg" class="img-fluid circle" alt="" /></a></div><div class="crs_tutor_name"><a href="instructor-detail.html">الهام زند</a></div>
                                        </div>
                                    </div>
                                    <div class="crs_fl_last">
                                        <div class="crs_price"><h2><span class="theme-cl">{{ number_format($model->price) }}</span><span class="currency">تومان</span></h2></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8 mt-2">
                    <div class="text-center"><a href="grid-layout-with-sidebar.html" class="btn btn-md theme-bg-light theme-cl">مشاهده سایر دوره ها</a></div>
                </div>
            </div>

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
                        <h2 class="mb-3 font-2">معرفی بهترین مربیان در شهر شما</h2>
                        <p>در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mr-3">دسترسی کاملا مادام العمر</h6>
                            </div>
                        </div>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mr-3">بیش از 20 منبع قابل دانلود</h6>
                            </div>
                        </div>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mr-3">ارائه مدرک معتبر</h6>
                            </div>
                        </div>
                        <div class="mb-3 ml-4 mr-lg-0 ml-lg-4">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-light-success theme-cl p-2 small d-flex align-items-center justify-content-center">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h6 class="mb-0 mr-3">آزمایشی رایگان 7 روز</h6>
                            </div>
                        </div>
                        <div class="text-right mt-4"><a href="#" class="btn btn-md text-light theme-bg">شروع ثبت نام</a></div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                    <div class="lmp_thumb">
                        <img src="assets/img/lmp-2.png" class="img-fluid" alt="" />
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
                        <img src="assets/img/lmp-1.png" class="img-fluid" alt="" />
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-6 col-sm-12">
                    <div class="lmp_caption">
                        <ol class="list-unstyled p-0">
                            <li class="d-flex align-items-start my-3 my-md-4">
                                <div class="rounded-circle p-3 p-sm-4 d-flex align-items-center justify-content-center theme-bg">
                                    <div class="position-absolute text-white h5 mb-0">1</div>
                                </div>
                                <div class="mr-3 mr-md-4">
                                    <h4 class="font-2">ایجاد حساب کاربری</h4>
                                    <p>
                                        برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start my-3 my-md-4">
                                <div class="rounded-circle p-3 p-sm-4 d-flex align-items-center justify-content-center theme-bg">
                                    <div class="position-absolute text-white h5 mb-0">2</div>
                                </div>
                                <div class="mr-3 mr-md-4">
                                    <h4 class="font-2">عضویت در باشگاه</h4>
                                    <p>
                                        دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start my-3 my-md-4">
                                <div class="rounded-circle p-3 p-sm-4 d-flex align-items-center justify-content-center theme-bg">
                                    <div class="position-absolute text-white h5 mb-0">3</div>
                                </div>
                                <div class="mr-3 mr-md-4">
                                    <h4 class="font-2">شروع به یادگیری</h4>
                                    <p>
                                        برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                    </p>
                                </div>
                            </li>
                            <li class="d-flex align-items-start my-3 my-md-4">
                                <div class="rounded-circle p-3 p-sm-4 d-flex align-items-center justify-content-center theme-bg">
                                    <div class="position-absolute text-white h5 mb-0">4</div>
                                </div>
                                <div class="mr-3 mr-md-4">
                                    <h4 class="font-2">دریافت مدرک</h4>
                                    <p>
                                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                    </p>
                                </div>
                            </li>
                        </ol>
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
