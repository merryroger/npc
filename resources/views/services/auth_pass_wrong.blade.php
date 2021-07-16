<form id="auth_type_selector" class="resp__holder" method="POST" onsubmit="return checkTypeSend(this)">
    @csrf
    <input type="hidden" name="keyhash" value="{!! base64_encode($key_hash) !!}">
    <h6>{!! @trans("services.auth") !!}:</h6>
    <p class="resp__error">{!! @trans("services.wrong_pass") !!} {!! @trans("services.tries_{$tries}") !!}</p>
    <select name="auth_type" class="resp__elems" onchange="selectMode(this)" tabindex="1">
        @foreach($authtypes as $authtype)
            <option value="{!! $authtype !!}">{!! @trans("services.authby.{$authtype}") !!}</option>
        @endforeach
    </select>
    <div id="pass_field" class="resp__elems">
        <h6>{!! @trans("services.password") !!}:</h6>
        <input type="password" name="passwd" class="resp__elems" value="" tabindex="2" required />
    </div>
    <div id="auth_ctrls">
        <input type="submit" name="rq_send" value="{!! @trans("services.send") !!}" tabindex="3" />
    </div>
</form>
