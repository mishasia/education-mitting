@extends('layouts.app')

@section('content')

    <div>
        <h3>Коментарі за оголошенням:</h3>
        <h4> <span class="">"{{ $plan->comment }} </span> яке активне з  {{ $plan->date_start }} по {{ $plan->date_end }}"</h4>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>Автор</th>
            <th>Коментар</th>
            <th>Дата створення</th>
            <th>Дія</th>
        </tr>
        </thead>
        <tbody>
        @foreach($comments as $comment)
            @php
                $person = $comment->user->teacher ? $comment->user->teacher : $comment->user->student
            @endphp
            <tr>
                <td>{{ $person->last_name }}  {{ $person->first_name  }}</td>
                <td>{{ $comment->text }}</td>
                <td>{{ $comment->created_at }}</td>
                <td>
                    @if (auth()->user()->id === $comment->user->id)
                        {!! Form::open(['method'=>'DELETE',
                        'route' => ['comment.remove', $comment->id]])  !!}
                        <button onclick=" return confirm('Ви точно хочете видалити?')"
                                style="
                                background: transparent;
                                border: none;
                                padding: 0px;
                                      ">
                            <i class="glyphicon glyphicon-remove" style="color: #337ab7"></i>
                        </button>
                        {!! Form::close() !!}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div>
        {!! Form::open(['route' => 'comment.save']) !!}

        {!! Form::hidden('plan_id', $plan->id) !!}

        <div class="form-group">
            {!! Form::label('text', 'Коментарій:') !!}
            {!! Form::textarea('text', null, ['class' => 'form-control', 'rows' => 5, 'required']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Додати', [
                'class' => 'btn btn-success col-md-3'
            ]) !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection
