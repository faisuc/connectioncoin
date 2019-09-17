@if (session('success'))
    @alert(['type' => 'success'])
        {{ session('success') }}
    @endalert
@endif

@if ($errors->any())
    @foreach ($errors->all() as $error)
        @alert(['type' => 'warning'])
            {{ $error }}
        @endalert
    @endforeach
@endif