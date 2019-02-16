@extends('backend.layouts.app')

@section('title', __('titles.user_contribution'))

@section('content')

    <div class="col-12">
        <div class="container">
            <div class="d-flex flex-row-reverse">
                <div class="p-1">
                    <a href="{{ route('user.myContribution.index') }}" class="btn btn-primary"><i class="fa fa-chevron-circle-left"></i> {{ __('form.action_back') }}</a>
                </div>
            </div>
        </div>

        <hr>

        <div class="card">
            <div class="card-header">
                {{ __('titles.add_contribution') }}
            </div>
            <form method="POST" id="form_contribution_add" enctype="multipart/form-data" action="{{ route('user.myContribution.store') }}">
                @csrf

                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="title" class="col-form-label">{{ __('form.contribution_title') }}</label>
                        </div>
                        <div class="col-6">
                            <input type="text" id="title" name="title" class="form-control" required value="{{ old('title') }}" minlength="6">
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="type" class="col-form-label">{{ __('form.contribution_type') }}</label>
                        </div>
                        <div class="col-2">
                            <select id="type" name="type" class="form-control" required>
                                <option value="" selected disabled>{{ __('form.contribution_choose_type') }}</option>
                                <option value="1">{{ __('form.contribution_type1') }}</option>
                                <option value="2">{{ __('form.contribution_type2') }}</option>
                            </select>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="abstract" class="col-form-label">{{ __('form.contribution_abstract') }}</label>
                        </div>
                        <div class="col-6">
                            <textarea type="text" id="abstract" name="abstract" class="form-control" required rows="6">{{ old('abstract') }}</textarea>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-4 text-right">
                            <label for="file" class="col-form-label">{{ __('form.contribution_file') }}</label>
                        </div>
                        <div class="col-4">
                            <input type="file" class="form-control" id="file" name="file" accept="application/pdf" required>
                        </div>
                        <div class="col-8 offset-4">
                            <span style="font-size: 0.85em">{{ __('form.contribution_file_hint') }}</span>
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-success">{{ __('form.save') }}</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $().ready(function () {
            $('#form_contribution_add').validate({
                rules: {
                    'title' : {
                        required: true,
                        minlength: 6,
                    },
                    'type': 'required',
                    'abstract': 'required',
                    'file': 'required',
                },
                highlight: function (element, errorClass, validClass) {
                    // Only validation controls
                    if (!$(element).hasClass('novalidation')) {
                        $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid');
                    }
                },
                unhighlight: function (element, errorClass, validClass) {
                    // Only validation controls
                    if (!$(element).hasClass('novalidation')) {
                        $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                    }
                }
            })
        })

    </script>
@stop
