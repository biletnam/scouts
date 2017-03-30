@extends('layouts.leiding')
@section('title', $kid->firstname.' '.$kid->name)
@section('content')
    <main>
        <h3>{{ $kid->firstname.' '.$kid->name }}</h3>
        <ul class="details">
            <li>{{ strtolower($kid->tak) }} ({{ $kid->year }}ejaars)</li>
            <li>{{ $kid->birthdate }}</li>
            <li>{{ $kid->address }}<br>{{ $kid->zip }} {{ $kid->city }}</li>
            <li>
                @if (isset($kid->tel))
                    <i class="fa fa-phone"></i>
                    <a href="tel:{{ str_replace('/', '', str_replace(' ', '', str_replace('+', '00', $kid->tel))) }}">{{ $kid->tel }}</a></li>
                @endif
            <li>
                @if (isset($kid->gsm))
                    <i class="fa fa-mobile"></i>
                    <a href="tel:{{ str_replace('/', '', str_replace(' ', '', str_replace('+', '00', $kid->gsm))) }}">{{ $kid->gsm }}</a>
                @endif
            </li>
            <li>
                <i class="fa fa-envelope-o"></i>
                <a href="mailto:{{ $kid->email }}">{{ $kid->email }}</a>
            </li>
        </ul>
        <a href="leiding/ledenlijst"><i class="fa fa-long-arrow-left"></i> Terug naar ledenlijst</a>
    </main>
@stop