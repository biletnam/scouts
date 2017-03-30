@extends('layout.app')
@section('title', 'Schakeltje')
@section('content')
    <header><img src="img/slide3.jpg" alt="header"></header>
    <div class="parallax-wrapper">
        <main>
            <h1 class="title">SCHAKELTJE</h1>
            @include('partial.errors')
            <p>
                Het Schakeltje is ons maandelijks schrift waarin u alles vindt dat u moet weten over die maand.
                Het maandprogramma staat per tak uitgeschreven met alle benodigdheden.
            </p>
            <p>
                Omdat wij het belangrijk vinden zo veel mogelijk papier uit te sparen verdelen wij onze Schakeltjes enkel nog digitaal. We vragen daarom ook aan jullie om in onze inspanningen te delen en onze Schakeltjes ook niet af te drukken. Wilt u meer weten over milieubewust leven? Klik dan <a href="http://www.milieubewust.net/">hier</a>.
            </p>

            <p>Hieronder kan u de recentste schakeltjes downloaden.</p>
            <ul id="schakel">
                @foreach ($schakeltjes as $schakeltje)
                    <li class="schakeltje">
                        <a href="{{ $schakeltje->url }}" target="_blank">{{ $schakeltje->title }}</a>
                    </li>
                @endforeach
            </ul>
            @if (Auth::check())
            <h3>Schakeltje toevoegen</h3>
            <form action="{{ route('schakeltje.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <ul>
                    <li>
                        <label for="title">Naam</label>
                        <input id="title" type="text" name="title" value="{{ old('title') }}">
                    </li>
                    <li>
                        <label for="file" id="file-label">
                            <span>Klik om te uploaden</span>
                            <input type="file" name="file" id="file" size="20" value="{{ old('file') }}">
                        </label>
                    </li>
                    <li><button type="submit">Uploaden</button></li>
                </ul>
            </form>
            <a href="schakeltje/archief">Ga naar het archief ></a>
            @endif
        </main>
    </div>
@stop