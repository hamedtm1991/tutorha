<div>
    <section class="gray">

        <div class="container">

            <!-- row Start -->
            <div class="row">

                <!-- Blog Detail -->
                <div class="col-lg-8 col-md-12 col-sm-12 col-12 on-the-lg">
                    <div class="article_detail_wrapss single_article_wrap format-standard">
                        <div class="article_body_wrap">

                            <div class="article_featured_image">
                                <img src="https://tutorha-ewoehznko.liara.run/api/files/{{ $post['collectionId'] }}/{{ $post['id'] }}/{{ $post['image'] }}" class="img-fluid" alt="{{ $post['title'] }}">
                            </div>

                            <div class="article_top_info">
                                <ul class="article_middle_info">
                                    <li><a href="#"><span class="icons"><i class="ti-user"></i></span><span class="text-dark">نویسنده: {{ $post['writer'] }}</span></a></li>
                                    <li><a href="#"><span class="icons"><i class="ti-user"></i></span><span class="text-dark">مترجم: {{ $post['translator'] }}</span></a></li>
                                </ul>
                            </div>
                            <div class="mt-5">
                                <h1 class="post-title">{{ $post['title'] }}</h1>
                            </div>
                            {!! $post['text'] !!}
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>

    </section>
</div>

@push('seo')
    <meta name="description" content="{{ $post['description'] }}">
    <meta name="keywords" content="{{ $post['keywords'] }}">
    <title>{{ $post['title_tag'] }}</title>
@endpush

@push('styles')
    <style>
        @media (min-width: 1000px) {
            .on-the-lg {
                margin-right: 16.6%;
            }
        }
        .article_body_wrap img { max-width: 100%; height: 100%}
    </style>
@endpush
