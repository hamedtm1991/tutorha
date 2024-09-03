<div>
    @foreach($tutors as $tutor)
        <div class="single_instructor">
            <div class="single_instructor_thumb">
                <a href="#"><img src="{{ url(route('getPublicImage', ['Tutor-' . $tutor->id . '-main', rand()])) }}" class="img-fluid" alt="{{ $tutor->name }}"></a>
            </div>
            <div class="single_instructor_caption">
                <span style="font-weight: bold;font-size: large"><a href="#">{{ $tutor->name }}</a></span>
                <p>{{ $tutor->description }}</p>
            </div>
        </div>
    @endforeach
</div>
