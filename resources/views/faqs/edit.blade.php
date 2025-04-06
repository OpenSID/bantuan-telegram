blade.php
@extends('layouts.app')

@section('content')
    <h1>Edit FAQ</h1>

    {!! Form::model($faq, ['route' => ['faqs.update', $faq->id], 'method' => 'PUT']) !!}

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
            {!! Form::select('group_id', $groups, null, ['class' => 'form-control', 'placeholder' => 'Select Group']) !!}
        </div>

        {!! Form::submit('Update FAQ', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection