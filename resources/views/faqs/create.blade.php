php
@extends('layouts.app')

@section('content')
    <h1>Create FAQ</h1>

    {!! Form::open(['route' => 'faqs.store', 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('question', 'Question') !!}
            {!! Form::text('question', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('answer', 'Answer') !!}
            {!! Form::textarea('answer', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('group_id', 'Group') !!}
            {!! Form::select('group_id', $groups->pluck('name', 'id'), null, ['class' => 'form-control', 'placeholder' => 'Select Group']) !!}
        </div>

        {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endsection