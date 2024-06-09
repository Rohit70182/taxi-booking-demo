@extends('admin.layouts.app')
@section('content')

<div class="mb-1 mt-2">
    <ul class="breadcrumb">
        <li><a href="{{url('/dashboard')}}">Home</a></li>
        <li class="mx-1">/</li>
        <li class="active">{{ isset($settings) ? 'Update' : 'Add' }}</li>
    </ul>
</div>
<div class="card">
    <div class="card-body">
        <div id="payment-stripe">
            <div class="row text-left">
                <div class="col-sm-12">
                    <div class="text-danger" id="stripe_message"></div>
                    <div class="form-group">
                        <label">Card Number</label>
                            <div class="input-group">
                                <input id="cc-number" type="text" maxlength="16" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="•••• •••• •••• ••••" required>
                            </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label>Expiration (MM)</label>
                        <div class="input-group">
                            <input id="cc-month" type="number" class="form-control" max="12" placeholder="••" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Expiration (YYYY)</label>
                        <div class="input-group">
                            <input id="cc-year" type="number" class="form-control" placeholder="••••" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>CVC Code</label>
                        <div class="input-group">
                            <input id="cc-cvc" type="tnumberel" class="form-control" placeholder="•••" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-bg" id="card-button" type="button" id="validate">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('style')
@endpush
@push('scripts')
<script src="{{ url('/Modules/Stripe/public/js/card-validation.js') }}" defer></script>
<script>
    var SITEURL = "{{url('/')}}";
</script>
@endpush