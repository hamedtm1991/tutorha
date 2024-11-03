<div>
        <section class="gray">
            <div class="container">
                <div class="row">
                    <!-- Sidebar -->
                    <div class="col-xl-12 col-lg-12 col-md-12">
                        <div class="row justify-content-center">
                            @foreach($tutors as $tutor)
                                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                                    <div class="crs_trt_grid">
                                        <div class="crs_trt_thumb circle">
                                            <a href="{{ route('tutorDetail', ['slug' => $tutor->slug]) }}" class="crs_trt_thum_link"><img src="{{ url(route('getPublicImage', ['Tutor-' . $tutor->id . '-main', rand()])) }}" class="img-fluid circle" alt="{{ $tutor->name }}"></a>
                                        </div>
                                        <div class="crs_trt_caption">
                                            <div class="instructor_tag dark"><span>{{ $tutor->title }}</span></div>
                                            <div class="instructor_title"><h4><a href="{{ route('tutorDetail', ['slug' => $tutor->slug]) }}">{{ $tutor->name }}</a></h4></div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
</div>
