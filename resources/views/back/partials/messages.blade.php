@if(count(Session::get('messages'))>0)
    <div class="am-alert am-alert-success">
        <ul>
            @foreach (Session::get('messages') as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif