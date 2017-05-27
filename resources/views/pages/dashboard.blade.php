@extends('layout.leiding')
@section('title', 'Dashboard')
@section('content')
    <main>
        <h1>Welkom {{ ucfirst(Auth::user()->member->firstname) }}!</h1>

        <div id="body">
            <p>Dit is het platform voor de lieve leuke lekkere leiding van den 18!</p>
            <p>
                Van hieruit kan je schakeltjes toevoegen/verwijderen, nieuwsberichten posten/wijzigen/verwijderen en eventueel je wachtwoord herzien.<br>Voor suggesties omtrent nieuwe features kan je altijd mailen/zagen bij jullie teergeliefde webmaster.
            </p>
            Voor de gewone website ga naar <a href="http://www.18bp.be">www.18bp.be</a>
            <h3>Waar vind ik ____ ?</h3>
            <p>Voor een lijstje met handige links <a href="leiding/nuttig">klik hier</a>.</p>
        </div>
    </main>
@stop