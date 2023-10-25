<div>
    <x-head-view title="payments" />

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <x-title title="payments" />
                <x-search/>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                        <div class="table-responsive">
                            <table class="table dash_list">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('general.userId') }}</th>
                                    <th scope="col">{{ __('general.price') }}</th>
                                    <th scope="col">{{ __('general.status') }}</th>
                                    <th scope="col">{{ __('general.created') }}</th>
                                    <th scope="col">{{ __('general.updated') }}</th>
                                    <th scope="col">{{ __('general.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $model)
                                    @php
                                        if ($model->status == \App\Models\Payment::STATUSPAID) {
                                            $statusColor = 'success';
                                        } elseif ($model->status == \App\Models\Payment::STATUSCANCELED || $model->status == \App\Models\Payment::STATUSREJECT) {
                                            $statusColor = 'danger';
                                        } elseif ($model->status == \App\Models\Payment::STATUSUNPAID) {
                                            $statusColor = 'warning';
                                        }
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $model->id }}</th>
                                        <th scope="row">{{ $model->user_id }}</th>
                                        <td>{{ number_format($model->price) . ' ' . __('general.toman') }}</td>
                                        <td class="bg-{{ $statusColor }}">{{ __('general.' . $model->status) }}</td>
                                        <td>{{ localDate($model->created_at) }}</td>
                                        <td>{{ localDate($model->updated_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $data->links('pagination') }}
            </div>
        </div>
    </div>
</div>
