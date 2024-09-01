<div>
    @foreach($episodes as $index => $group)

        @php($rand = \Illuminate\Support\Str::random(10))
        <div class="card">
            <div id="heading{{ $rand }}" class="card-header bg-white shadow-sm border-0">
                <h6 class="mb-0 accordion_title"><a href="#" data-toggle="collapse" data-target="#collapse{{ $rand }}" aria-expanded="true" aria-controls="collapse{{ $rand }}" class="d-block position-relative text-dark collapsible-link py-2">{{ $index }}</a></h6>
            </div>
            <div id="collapse{{ $rand }}" aria-labelledby="heading{{ $rand }}" data-parent="#accordionExample" class="collapse show">
                <div class="card-body pl-3 pr-3">
                    <ul class="lectures_lists">
                        @foreach($group as $episode)
                            <livewire:landings.episode :$index :$episode :$product :key="$index" />
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endforeach
</div>
