@extends('layout.app')
@section('title', 'Contact')
@section('content')
    <div class="map-wrap">
        <div class="contact">
            <h4>Adres:</h4>
            <address>
                <a href="https://goo.gl/maps/86weBWqxJ2P2" target="_blank">
                    Langstraat 12-14
                    <br>
                    2140 Borgerhout
                </a>
            </address>
            <h4>Je kan ons bereiken op:</h4>
            <ul class="mailinglist">
                <li><a href="mailto:info@18bp.be">info@18bp.be</a></li>
                <li><a href="mailto:ouderploeg@18bp.be">ouderploeg@18bp.be</a></li>
                <li><a href="mailto:bouwploeg@18bp.be">bouwploeg@18bp.be</a></li>
                <li><a href="mailto:verhuur@18bp.be">verhuur@18bp.be</a></li>
                <li><a href="mailto:uniformenbank@18bp.be">uniformenbank@18bp.be</a></li>
                <li><a href="mailto:redactie@18bp.be">redactie@18bp.be</a></li>
            </ul>
        </div>
        <div id="map" class="map" style="display: block;"></div>
    </div>
    <div class="parallax-wrapper">
        <main id="contact">
            <form action="contact/send" method="POST" id="contact-form">
                <div class="errors"><?= ''#$this->session->flashdata('errors') ?></div>
                <div class="success"><?= ''#$this->session->flashdata('success') ?></div>
                <h4>Ik heb een klacht / opmerking / compliment voor de webmaster:</h4>
                <ul>
                    <li><input type="text" name="email" placeholder="Uw e-mailadres"></li>
                    <li><textarea name="message" placeholder="Uw bericht"></textarea></li>
                    <li><button class="btn-submit" type="submit">Verzenden</button></li>
                </ul>
            </form>
        </main>
    </div>
@stop