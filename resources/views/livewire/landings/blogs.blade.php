<div>
    <section class="gray">
        <div class="container">

            <!-- row Start -->
            <div class="row">

                <!-- Blog Detail -->
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="row justify-content-right">
                        @if($posts)
                            @foreach($posts['items'] as $post)
                                <!-- Single Item -->
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                                    <div class="blg_grid_box">
                                        <div class="blg_grid_thumb">
                                            <a href="{{ route('blogDetail', ['slug' => $post['slug']]) }}"><img src="https://tutorha-ewoehznko.liara.run/api/files/{{ $post['collectionId'] }}/{{ $post['id'] }}/{{ $post['image'] }}" class="img-fluid" alt="{{ $post['title'] }}" /></a>
                                        </div>
                                        <div class="blg_grid_caption">
                                            <div class="blg_tag"><span>{{ $post['tag'] }}</span></div>
                                            <div class="blg_title"><h4><a href="{{ route('blogDetail', ['slug' => $post['slug']]) }}">{{ $post['title'] }}</a></h4></div>
                                            <div class="blg_desc"><p>{{ substr($post['description'], 0, strpos($post['description'], ' ', 150)) }}...</p></div>
                                        </div>
                                        <div class="crs_grid_foot">
                                            <div class="crs_flex">
                                                <div class="crs_fl_last">
                                                    <div class="foot_list_info">
                                                        <ul>
                                                            <li><div class="elsio_ic"><i class="fa fa-clock text-warning"></i></div><div class="elsio_tx">{{ localDate($post['created']) }}</div></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>

                <!-- Single blog Grid -->
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">

                    <!-- Searchbard -->
{{--                    <div class="single_widgets widget_search">--}}
{{--                        <h4 class="title">جستجو</h4>--}}
{{--                        <form action="#" class="sidebar-search-form">--}}
{{--                            <input type="search" name="search" placeholder="عنوان مورد نظر...">--}}
{{--                            <button type="submit"><i class="ti-search"></i></button>--}}
{{--                        </form>--}}
{{--                    </div>--}}

                    <!-- Categories -->
{{--                    <div class="single_widgets widget_category">--}}
{{--                        <h4 class="title">دسته بندی</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">سبک زندگی</a></li>--}}
{{--                            <li><a href="#">سیر و سفر <span>12</span></a></li>--}}
{{--                            <li><a href="#">کسب و کار <span>19</span></a>--}}
{{--                            </li><li><a href="#">طراحی سایت <span>17</span></a></li>--}}
{{--                            <li><a href="#">موزیک <span>10</span></a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

                    <!-- Trending Posts -->
{{--                    <div class="single_widgets widget_thumb_post">--}}
{{--                        <h4 class="title">جدیدترین وبلاگ</h4>--}}
{{--                        <ul>--}}
{{--                            <li>--}}
{{--										<span class="left">--}}
{{--											<img src="assets/img/b-1.png" alt="" class="">--}}
{{--										</span>--}}
{{--                                <span class="right">--}}
{{--											<a class="feed-title" href="#">ساخت بکگراند برای اینستاگرام</a>--}}
{{--											<span class="post-date"><i class="ti-calendar"></i>10 دقیقه پیش</span>--}}
{{--										</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--										<span class="left">--}}
{{--											<img src="assets/img/b-2.png" alt="" class="">--}}
{{--										</span>--}}
{{--                                <span class="right">--}}
{{--											<a class="feed-title" href="#">اعمال بک‌گراند و تنظیم حرکت آن</a>--}}
{{--											<span class="post-date"><i class="ti-calendar"></i>2 ساعت پیش</span>--}}
{{--										</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--										<span class="left">--}}
{{--											<img src="assets/img/b-3.png" alt="" class="">--}}
{{--										</span>--}}
{{--                                <span class="right">--}}
{{--											<a class="feed-title" href="#">تنظیمات سکانس تایم‌لپس</a>--}}
{{--											<span class="post-date"><i class="ti-calendar"></i>4 ساعت پیش</span>--}}
{{--										</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--										<span class="left">--}}
{{--											<img src="assets/img/b-4.png" alt="" class="">--}}
{{--										</span>--}}
{{--                                <span class="right">--}}
{{--											<a class="feed-title" href="#">آشنایی کامل با Pinning و درک آن</a>--}}
{{--											<span class="post-date"><i class="ti-calendar"></i>7 ساعت پیش</span>--}}
{{--										</span>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--										<span class="left">--}}
{{--											<img src="assets/img/b-5.png" alt="" class="">--}}
{{--										</span>--}}
{{--                                <span class="right">--}}
{{--											<a class="feed-title" href="#">آشنایی با ابزار Guide Template</a>--}}
{{--											<span class="post-date"><i class="ti-calendar"></i>3 روز پیش</span>--}}
{{--										</span>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

                    <!-- Tags Cloud -->
{{--                    <div class="single_widgets widget_tags">--}}
{{--                        <h4 class="title">برچسب</h4>--}}
{{--                        <ul>--}}
{{--                            <li><a href="#">تخصصی</a></li>--}}
{{--                            <li><a href="#">فیزیک</a></li>--}}
{{--                            <li><a href="#">دوره رایگان</a></li>--}}
{{--                            <li><a href="#">سوالات کنکوری</a></li>--}}
{{--                            <li><a href="#">دوره تخصصی</a></li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}

                </div>

            </div>
            <!-- /row -->

        </div>

    </section>
</div>

@push('seo')
    <meta name="description" content="آموزش برنامه‌نویسی (Web programming), بک اند (Backend), ای تی (IT) و ... از مبتدی تا پیشرفته">
    <meta name="keywords" content="backend, نرم افزار ,بک اند ,کامپیوتر  ,برنامه‌نویسی ,آموزش">
    <title>بلاگ</title>
@endpush
