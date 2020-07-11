@extends('backend.layouts.app')
@section('title') Currency Settings @endsection
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid settings-page">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 rounded-0">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header p-0">
                        @include('backend.settings.partial.nav')
                    </div>
                    <!-- Card Body -->
                    <div class="card-body p-5">
                        <form action="{{route('save-application-setting')}}" method="post" enctype="multipart/form-data" data-parsley-validate>
                            @csrf
                            <div class="row p-5 justify-content-center">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <select name="app_currency" class="form-control select2">
                                            <option value="$" {{get_option('app_currency') == '$' ? 'selected' : ''}}  > $ </option>
                                            <option value="€" {{get_option('app_currency') == '€' ? 'selected' : ''}}  >€ (Euro)</option>
                                            <option value="BDT" {{get_option('app_currency') == 'BDT' ? 'selected' : ''}}  >BDT</option>
                                            <option value="Rs." {{get_option('app_currency') == 'Rs.' ? 'selected' : ''}}  >Rs (Indian Rupee)</option>
                                            <option value="£" {{get_option('app_currency') == '£' ? 'selected' : ''}}  >£ (Pound)</option>
                                            <option value="Rp" {{get_option('app_currency') == 'Rp' ? 'selected' : ''}}  >Rp (Indonesia Rupiah)</option>
                                            <option value="¥" {{get_option('app_currency') == '¥' ? 'selected' : ''}}  >¥ (Japan Yen)</option>
                                            <option value="kr" {{get_option('app_currency') == 'kr' ? 'selected' : ''}}  >kr (Sweden Krona)</option>
                                            <option value="CHF" {{get_option('app_currency') == 'CHF' ? 'selected' : ''}}  >CHF (CHF)</option>
                                            <option value="TRY" {{get_option('app_currency') == 'TRY' ? 'selected' : ''}}  >TRY (Turkish lira)</option>
                                            <option value="E£" {{get_option('app_currency') == 'E£' ? 'selected' : ''}}  >E£ (Egyptian Pound)</option>
                                            <option value="RM" {{get_option('app_currency') == 'RM' ? 'selected' : ''}}  >RM (Malaysian Ringgit)</option>
                                            <option value="KSh" {{get_option('app_currency') == 'KSh' ? 'selected' : ''}}  >KSh (Kenyan Shilling)</option>
                                            <option value="KHR" {{get_option('app_currency') == 'KHR' ? 'selected' : ''}}  >KHR (Cambodian Riel)</option>
                                            <option value="NGN" {{get_option('app_currency') == 'NGN' ? 'selected' : ''}}  >NGN (Nigerian Naira)</option>
                                            <option value="AED" {{get_option('app_currency') == 'AED' ? 'selected' : ''}}  >AED (United Arab Emirates dirham)</option>
                                            <option value="MAD" {{get_option('app_currency') == 'MAD' ? 'selected' : ''}}  >MAD (Moroccan dirham)</option>
                                        </select>

                                        @if ($errors->has('currency'))
                                            <div class="error">{{ $errors->first('currency') }}</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block">Save & Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection

@section('js')

@endsection

