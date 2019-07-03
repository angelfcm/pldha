@if ($errors->count() > 0)
    <div class="alert alert-danger" role="alert">  
        <button type="button" class="close" data-dismiss="alert">×</button>	
        <ul class="mb-0">
            @foreach ($errors->all() as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif