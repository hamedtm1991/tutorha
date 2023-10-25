<div>
    <x-head-view title="transactions" />

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <x-title title="transactions" />
                <x-search/>

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                        <div class="table-responsive">
                            <table class="table dash_list">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('general.wallet_id') }}</th>
                                    <th scope="col">{{ __('general.type') }}</th>
                                    <th scope="col">{{ __('general.resnumber') }}</th>
                                    <th scope="col">{{ __('general.value') }}</th>
                                    <th scope="col">{{ __('general.status') }}</th>
                                    <th scope="col">{{ __('general.transfer') }}</th>
                                    <th scope="col">{{ __('general.confirmedBy') }}</th>
                                    <th scope="col">{{ __('general.detail') }}</th>
                                    <th scope="col">{{ __('general.description') }}</th>
                                    <th scope="col">{{ __('general.created') }}</th>
                                    <th scope="col">{{ __('general.updated') }}</th>
                                    <th scope="col">{{ __('general.actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $model)
                                    @php
                                        if ($model->status == \App\Models\WalletTransaction::STATUS_CONFIRMED) {
                                            $statusColor = 'success';
                                        } elseif ($model->status == \App\Models\WalletTransaction::STATUS_REJECTED) {
                                            $statusColor = 'danger';
                                        } elseif ($model->status == \App\Models\WalletTransaction::STATUS_PENDING) {
                                            $statusColor = 'warning';
                                        }
                                    @endphp
                                    <tr>
                                        <th scope="row">{{ $model->id }}</th>
                                        <td>{{ $model->wallet_id }}</td>
                                        <td class="bg-{{ $model->type == \App\Models\WalletTransaction::TYPE_INCREASE ? 'success' : 'danger'  }}">{{ $model->type == \App\Models\WalletTransaction::TYPE_INCREASE ? __('general.increase') : __('general.decrease') }}</td>
                                        <td>{{ $model->resnumber }}</td>
                                        <td>{{ number_format($model->value) . ' ' . __('general.toman') }}</td>
                                        <td class="bg-{{ $statusColor }}">{{ __('general.' . $model->status) }}</td>
                                        <td>{{ empty($model->transfer_from_id) ? '-' : __('general.from') . $model->transferFrom->name . ' (' . $model->transfer_from_id . ') ' . __('general.to') . $model->transferTo->name . ' (' . $model->transfer_to_id . ')' }}</td>
                                        <td>{{ $model->confirmed_by }}</td>
                                        <td>
                                            @php($orderId = $model->order_id ? ' / ' . __('userPanel.orderId') . ': ' : '')
                                            {{ __('userPanel.' . $model->detail) . $orderId . $model->order_id  }}
                                        </td>
                                        <td>{{ $model->description ?? '-' }}</td>
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
