@extends('layout.leiding')
@section('title', $member->firstname.' '.$member->name)
@section('content')
    <main>
        <h3>
            {{ $member->firstname.' '.$member->name }}
            {{ (strtolower($member->tak) == 'leiding' && isset($member->nickname)) ? '(' . $member->nickname . ')' : '' }}
        </h3>
        <ul class="details">
            <li>{{ ucfirst($member->tak) }} ({{ $member->year }}ejaars)</li>
            <li>{{ $member->birthdate }}</li>
            <li>{{ $member->address }}<br>{{ $member->zip }} {{ $member->city }}</li>
            <li>
                @if (isset($member->tel))
                    <i class="fa fa-phone"></i>
                    <a href="tel:{{ str_replace('/', '', str_replace(' ', '', str_replace('+', '00', $member->tel))) }}">{{ $member->tel }}</a></li>
                @endif
            <li>
                @if (isset($member->gsm))
                    <i class="fa fa-mobile"></i>
                    <a href="tel:{{ str_replace('/', '', str_replace(' ', '', str_replace('+', '00', $member->gsm))) }}">{{ $member->gsm }}</a>
                @endif
            </li>
            <li>
                <i class="fa fa-envelope-o"></i>
                <a href="mailto:{{ $member->email }}">{{ $member->email }}</a>
            </li>
            @if (Auth::user()->hasPermission('administratie'))
                <li>Betaald: <i class="fa fa-{{ ($member->paid == 1) ? 'check' : 'remove' }}"></i></li>
            @endif
        </ul>
        <a href="{{ route('ledenlijst.index') }}"><i class="fa fa-long-arrow-left"></i> Terug naar ledenlijst</a>
    </main>
@stop