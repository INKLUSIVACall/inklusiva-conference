@if (isset($errors) && count($errors)>0)
    <div class="alert alert-danger" role="danger">
        <div class="alert-content">
            <div class="alert-icon">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <div class="alert-context">
                <h4>Es ist ein Fehler aufgetreten</h4>
                <ul>
                    @if (is_array($errors))
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    @else
                        @foreach ( $errors->all() as $error )
                            <li>{{$error}}</li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
    </div>
@endif

@if (isset($success) && !empty($success))
    <div class="alert alert-success" role="success">
        <div class="alert-content">
            <div class="alert-icon">
                <i class="fas fa-check"></i>
                <i class="fas fa-times" onclick="closeAlert(this)"></i>
            </div>
            <div class="alert-context">
                {!! $success !!}
            </div>
        </div>
    </div>
@endif
