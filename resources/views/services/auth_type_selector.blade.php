<form id="auth_type_selector" class="resp__holder" method="POST">
    @csrf
    <input type="hidden" name="keyhash" value="{!! base64_encode($key_hash) !!}">
    <h6>{!! @trans("services.auth") !!}:</h6>
    <select name="auth_type" class="resp__elems" onselect="" tabindex="1">
        @foreach($authtypes as $authtype)
            <option value="{!! $authtype !!}">{!! @trans("services.authby.{$authtype}") !!}</option>
        @endforeach
    </select>
    <div id="pass_field" class="resp__elems">
        <h6>{!! @trans("services.password") !!}:</h6>
        <input type="password" name="passwd" value="" tabindex="2" required />
    </div>
    <div id="auth_ctrls">
        <input type="button" name="rq_send" value="{!! @trans("services.send") !!}" tabindex="3" />
    </div>
</form>
