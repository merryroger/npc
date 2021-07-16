<form id="auth_type_selector" class="resp__holder">
    <p class="resp__error">{!! @trans("services.record_locked") !!} {!! $ltm !!} {!! @trans("services.mins") !!}.</p>
    <div id="auth_ctrls">
        <input type="button" value="Ok" tabindex="1" onclick="hideResponsePanel(); rq_sent = false;" />
    </div>
</form>
