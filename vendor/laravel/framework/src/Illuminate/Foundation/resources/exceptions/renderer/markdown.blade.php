# {{ $exception->class() }} - {!! $exception->title() !!}

{!! $exception->message() !!}

PHP {{ PHP_VERSION }}
Laravel {{ app()->version() }}
{{ $exception->request()->httpHost() }}

## Stack Trace

@foreach($exception->frames() as $index => $frame)
{{ $index }} - {{ $frame->file() }}:{{ $frame->line() }}
@endforeach

## Request

{{ $exception->request()->method() }} {{ \Illuminate\Support\Str::start($exception->request()->path(), '/') }}

## Headers

@if(count($exception->requestHeaders()) > 0)
    @foreach ($exception->requestHeaders() as $key => $value)
        * **{{ $key }}**: {!! $value !!}
    @endforeach
@else
No header data available.
@endif

## Route Context

@if(count($exception->applicationRouteContext()) > 0)
    @foreach($exception->applicationRouteContext() as $name => $value)
    {{ $name }}: {!! $value !!}
    @endforeach
@else
No routing data available.
@endif

## Route Parameters

@if ($routeParametersContext = $exception->applicationRouteParametersContext())
{!! $routeParametersContext !!}
@else
No route parameter data available.
@endif

## Database Queries

@if(count($exception->applicationQueries()) > 0)
    @foreach ($exception->applicationQueries() as ['connectionName' => $connectionName, 'sql' => $sql, 'time' => $time])
    * {{ $connectionName }} - {!! $sql !!} ({{ $time }} ms)
    @endforeach
@else
No database queries detected.
@endif
