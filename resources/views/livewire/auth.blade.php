<div>
    <section>
        <div class="container">
            <div class="row justify-content-center">

                <div class="col-xl-5 col-lg-8 col-md-12 col-sm-12">
                    <form wire:submit="verify">
                        @if($showCode)
                            <div class="crs_log_wrap">
                            <div class="crs_log__thumb" style="background-color: #02b97cbd">
                            </div>
                            <div class="crs_log__caption">
                                <div class="rcs_log_123">
                                    <div class="rcs_ico"><i class="fas fa-lock" style="color: @if($errors->has('code')) red @else #03b97c @endif"></i></div>
                                </div>

                                <div class="rcs_log_124">
                                    <div class="Lpo09"><h4>{{ __('auth.login') }}</h4></div>
                                    <div class="form-group">
                                        <label class="mb-1"> کد تایید برای شماره {{ $mobileBackup }} پیامک شد <a href="{{ route('login') }}"> | ویرایش شماره</a> </label>
                                        <a id="resend-verification" class="mb-2" href="#" x-on:click="$wire.resendVerification()" style="display: none; color: #02b97c">{{ __('buttons.resendVerification') }}</a>
                                        <input hidden="hidden"  id="code" type="text" class="form-control" placeholder="******" wire:model="code" />
                                        <div class="my-container">
                                            <div id="my-inputs" class="my-inputs">
                                                <div id='inputs' style="font-size: 35px">
                                                    <input id='input1' class="auth-input" type='text' maxLength="1" />
                                                    <input id='input2' class="auth-input" type='text' maxLength="1" />
                                                    <input id='input3' class="auth-input" type='text' maxLength="1" />
                                                    <input id='input4' class="auth-input" type='text' maxLength="1" />
                                                </div>
                                                <div class="mt-3" style="color: red; direction: rtl">@error('code') {{ $message }} @enderror</div>
                                                <p id="demo" style="color: green;font-size: 25px;text-align: center"></p>
                                        </div>
                                    </div>
                                    <div class="form-group mt-3 mb-2">
                                        <button id="form-verify" type="submit" class="btn full-width btn-md theme-bg text-white">{{ __('buttons.login') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>

                    <form wire:submit="initialAuth">
                        @if(!$showCode)
                            <div class="crs_log_wrap">
                            <div class="crs_log__thumb" style="background-color: #02b97cbd">
                            </div>
                            <div class="crs_log__caption">
                                <div class="rcs_log_123">
                                    <div class="rcs_ico"><i class="fas fa-lock" style="color: @if($errors->has('mobile')) red @else #03b97c @endif"></i></div>
                                </div>

                                <div class="rcs_log_124">
                                    <div class="Lpo09"><h4>{{ __('auth.login') }}</h4></div>
                                    <div class="form-group">
                                        <label class="mb-1">{{ __('inputs.mobileNumber') }}</label>
                                        <input id="mobile" type="text" class="form-control" placeholder="0912xxxxxxx" wire:model="mobile" />
                                        <div class="mt-2" style="color: red">@error('mobile') {{ $message }} @enderror</div>
                                    </div>
                                    <div class="form-group mt-3 mb-2">
                                        <button type="submit" class="btn full-width btn-md theme-bg text-white">{{ __('buttons.submit') }}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>

@push('styles')
    <style>
        .my-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 50px;
            direction: ltr;
        }

        input {
            width: 32px;
            height: 32px;
            text-align: center;
            border: none;
            border-bottom: 1.5px solid #d2d2d2;
            margin: 0 10px;
        }

        input:focus {
            border-bottom: 1.5px solid #03b97c;
            outline: none;
        }
    </style>
@endpush
