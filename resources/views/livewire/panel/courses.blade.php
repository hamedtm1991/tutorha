<div>
    <section class="gray">
        <div class="container">
            <div class="row justify-content-start">
                <!-- Single Grid -->
                @foreach($data as $model)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="crs_grid">
                            <div class="crs_grid_thumb">
                                <a href="{{ route('courses', [$model->slug]) }}" class="crs_detail_link">
                                    <img src="{{ url(route('getPublicImage', ['Product-' . $model->id . '-main', rand()])) }}" class="rounded" alt="{{ $model->title }}" />
                                </a>
                            </div>
                            <div class="crs_grid_caption">
                                <div class="crs_flex">
                                    <div class="crs_fl_first mt-2">
                                        @foreach($model->tags->pluck('name')->toArray() as $tag)
                                            <div class="crs_cates cl_8"><span>{{ __('tags.' . $tag) }}</span></div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="crs_title text-truncate"><h4><a href="{{ route('courses', [$model->slug]) }}" class="crs_title_link">{{ $model->title }}...</a></h4></div>
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
                                                <a href="{{ route('tutorDetail', ['slug' => $tutor->slug]) }}"><div class="crs_tutor_thumb"><img src="{{ url(route('getPublicImage', ['Tutor-' . $tutor->id . '-main', rand()])) }}" class="img-fluid circle" alt="{{ $tutor->name }}" /></div><div class="crs_tutor_name">{{ $tutor->name }}</div></a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    {{ $data->links('pagination') }}
                </div>
            </div>

        </div>
    </section>
</div>
