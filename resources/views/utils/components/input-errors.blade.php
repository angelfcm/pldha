@if ($errors->has($field))
    <div class="text-left invalid-feedback">
        <ul class="mb-0">
            @foreach($errors->get($field) as $message)
                <li>{{ $message }}</li>
            @endforeach
        </ul>
    </div>
@endif