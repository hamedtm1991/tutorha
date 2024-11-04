<div>
    @if($posts)
        <div class="row justify-content-center">
            @foreach($posts['items'] as $post)
                <div class="col-lg-4 col-md-6">
                    <div class="blg_grid_box">
                        <div class="blg_grid_thumb">
                            <a href="{{ route('blogDetail', ['id' => $post['id']]) }}"><img src="https://tutorha-ewoehznko.liara.run/api/files/{{ $post['collectionId'] }}/{{ $post['id'] }}/{{ $post['image'] }}" class="img-fluid" alt="{{ $post['title'] }}"></a>
                        </div>
                        <div class="blg_grid_caption">
                            <div class="blg_tag dark"><span>{{ $post['tag'] }}</span></div>
                            <div class="blg_title"><span class="fs-6 bold"><a href="{{ route('blogDetail', ['id' => $post['id']]) }}">{{ $post['title'] }}</a></span></div>
                            <div class="blg_desc"><p>{{ substr($post['description'], 0, strpos($post['description'], ' ', 150)) }}...</p></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
