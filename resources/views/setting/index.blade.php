@extends('layouts.dashmix')
@section('content')
@section('styles')
    <!-- Page JS Plugins CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
<div id="app">
    <div>
        <BlockUI v-show="loader" :message="msg" :html="html"></BlockUI>
        <!-- Hero -->
        <div class="content">
            <div class="d-md-flex justify-content-md-between align-items-md-center py-3 pt-md-3 pb-md-0 text-center text-md-left">
                <div>
                    <h1 class="h2 mb-1">
                        Settings
                    </h1>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <div class="content">
            <div class="block block-rounded block-bordered">
                <div class="block-content">
                    <form action="{{route('settings.store')}}" method="POST">
                        @csrf
                        <h2 class="content-heading pt-0">Default Zone</h2>
                        <div class="row push">
                            <div class="col-lg-4">
                                <p class="text-muted">
                                    Default zone for all drivers
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <label for="dm-project-new-category">
                                            Zone <span class="text-danger">*</span>
                                        </label>
                                        <select class="custom-select" id="dm-project-new-category" name="default_zone[id]" required>
                                            @foreach ($zones as $zone)
                                                <option {{isset($settings['id']) && $settings['id'] == $zone->id ? 'selected' : ''}} value="{{$zone->id}}">{{$zone->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <label for="dm-project-new-category">
                                            Schedule From <span class="text-danger">*</span>
                                        </label>
                                        <input value="{{$settings['schedule_from'] ?? ''}}" type="time" class="form-control" id="default_zone[schedule_from]" name="default_zone[schedule_from]" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <label for="dm-project-new-category">
                                            Schedule To <span class="text-danger">*</span>
                                        </label>
                                        <input value="{{$settings['schedule_to'] ?? ''}}" type="time" class="form-control" id="default_zone[schedule_to]" name="default_zone[schedule_to]" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <label for="dm-project-new-category">
                                            Active
                                        </label>
                                        <select class="custom-select" id="dm-project-new-category" name="default_zone[is_active]" required>
                                            <option {{isset($settings['is_active']) && $settings['is_active'] == "1" ? 'selected' : ''}} value="1">Yes</option>
                                            <option {{isset($settings['is_active']) && $settings['is_active'] == "0" ? 'selected' : ''}} value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <label for="default_days">
                                            Days
                                        </label>
                                        @php
                                            $default_days = !empty($settings['default_days']) ? json_decode($settings['default_days'], true) : [];
                                        @endphp
                                        <select id="default_days" class="form-control" multiple="multiple" name="default_zone[default_days][]" required>
                                            <option {{$default_days && in_array("Monday", $default_days) ? 'selected' : ''}} >Monday</option>
                                            <option {{$default_days && in_array("Tuesday", $default_days) ? 'selected' : ''}} >Tuesday</option>
                                            <option {{$default_days && in_array("Wednesday", $default_days) ? 'selected' : ''}} >Wednesday</option>
                                            <option {{$default_days && in_array("Thursday", $default_days) ? 'selected' : ''}} >Thursday</option>
                                            <option {{$default_days && in_array("Friday", $default_days) ? 'selected' : ''}} >Friday</option>
                                            <option {{$default_days && in_array("Saturday", $default_days) ? 'selected' : ''}} >Saturday</option>
                                            <option {{$default_days && in_array("Sunday", $default_days) ? 'selected' : ''}} >Sunday</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h2 class="content-heading pt-0">Service</h2>
                        <div class="row push">
                            <div class="col-lg-4">
                                <p class="text-muted">
                                    Service Fee
                                </p>
                            </div>
                            <div class="col-lg-8 col-xl-5">
                                <div class="form-group row">
                                    <div class="col-lg-8">
                                        <label for="dm-project-new-category">
                                            Amount <span class="text-danger">*</span>
                                        </label>
                                        <input value="{{$settings['service_fee_amount'] ?? ''}}" type="number" class="form-control" id="service[service_fee_amount]" name="service[service_fee_amount]" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row push">
                            <div class="col-lg-8 col-xl-5 offset-lg-4">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-check-circle mr-1"></i> Update Settings
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Search -->
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $("#default_days").select2({
            tags: true
        });
    </script>
@endsection
