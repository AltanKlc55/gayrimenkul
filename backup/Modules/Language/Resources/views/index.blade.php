@extends('language::layouts.master')

@section('content')
        <!DOCTYPE html>
<html>
<head>
    <title>Edit Language File</title>
</head>
<body>
<h1>Edit Language File for {{ $locale }}</h1>

<form method="POST" action="{{ route('updateLanguageKey', ['locale' => $locale, 'key' => ':key']) }}">
    @csrf
    @method('PUT')

    @foreach ($languageKeys as $key => $value)
        <div>
            <label for="{{ $key }}">{{ $key }}</label>
            <input type="text" id="{{ $key }}" name="value" value="{{ $value }}">
            <button type="submit" formaction="{{ route('updateLanguageKey', ['locale' => $locale, 'key' => $key]) }}">Update</button>
        </div>
    @endforeach
</form>
</body>
</html>
@endsection