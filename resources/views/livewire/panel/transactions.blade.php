<div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12">
            <div class="dashboard_wrap">
                <x-title title="transactions" />

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 mb-2">
                        <div class="table-responsive">
                            <table class="table dash_list">
                                <thead>
                                <tr>
                                    <th scope="col">{{ __('general.type') }}</th>
                                    <th scope="col">{{ __('general.resnumber') }}</th>
                                    <th scope="col">{{ __('general.value') }}</th>
                                    <th scope="col">{{ __('general.status') }}</th>
                                    <th scope="col">{{ __('general.createdAt') }}</th>
                                    <th scope="col">{{ __('general.detail') }}</th>
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
                                        <td class="bg-{{ $model->type == \App\Models\WalletTransaction::TYPE_INCREASE ? 'success' : 'danger'  }}">{{ $model->type == \App\Models\WalletTransaction::TYPE_INCREASE ? __('general.increase') : __('general.decrease') }}</td>
                                        <td>{{ $model->resnumber }}</td>
                                        <td>{{ number_format($model->value) . ' ' . __('general.toman') }}</td>
                                        <td class="bg-{{ $statusColor }}">{{ __('general.' . $model->status) }}</td>
                                        <td>{{ localDate($model->created_at, 'Y-m-d H:i:s', 'Y-m-d H:i:s') }}</td>
                                        <td>
                                            @php($orderId = $model->order_id ? ' / ' . __('general.orderId') . ': ' : '')
                                            {{ __('general.' . $model->detail) . $orderId . $model->order_id  }}
                                        </td>
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
