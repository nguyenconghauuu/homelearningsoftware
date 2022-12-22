@if(session('danger'))
    <p style="color: red;text-align: center">{{session('danger')}}</p>
@endif
@if(session('success'))
    <p class="text-success" style="text-align: center">{{session('success')}}</p>
@endif
