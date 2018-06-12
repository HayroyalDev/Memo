@if(Session::has('form-success'))
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success:</strong> {{Session::get('form-success')}}
    </div>
@endif

@if(Session::has('form-error'))
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <?php $form_error = Session::get('form-error')?>
        @for($i = 0; $i < count($form_error['email']); $i++)
            <strong>Error:</strong> {{$form_error['email'][$i]}}<br/>
        @endfor
        <br/>
        @for($i = 0; $i < count($form_error['username']); $i++)
            <strong>Error:</strong> {{$form_error['username'][$i]}}<br/>
        @endfor
        <br/>
        @for($i = 0; $i < count($form_error['password']); $i++)
            <strong>Error:</strong> {{$form_error['password'][$i]}}<br/>
        @endfor

    </div>
@endif

@if(Session::has('form-other-error'))
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error:</strong> {{Session::get('form-other-error')}}
    </div>
@endif