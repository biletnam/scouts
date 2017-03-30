<?php

use Illuminate\Database\Seeder;

class TakkenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('takken')->insert([
        	[
        		'name' => 'Kapoenen',
        		'email' => 'kapoenenleiding@18bp.be',
        		'account' => 'BE25 0688 9980 6682',
        		'description' => 'Het leven van een kapoen is er één vol spel, fantasie, creativiteit en expressie.
					Spelenderwijs en ongedwongen ontdekken ze samen met hun leiding de wereld.
					De kapoenen gaan 2 keer per jaar op weekend.
					Eén keer met de hele groep (groepsweekend) en één keer met enkel de kapoentjes op takweekend.
					Naast de weekenden is er het kamp. Voor de kapoenen betekent dit 7 dagen ondergedompeld worden
					in een kampthema zoals Schotten, ridders, toeristen, oermensen, aliens, sprookjes, ...',
                'active' => 1
            ],
        	[
        		'name' => 'Welpen',
        		'email' => 'welpenleiding@18bp.be',
        		'account' => 'BE14 0688 9980 6783',
        		'description' => 'Het is typisch voor welpen dat ze zelf dingen leren doen.
					Ze krijgen de ruimte en kansen om dingen uit te proberen en van elkaar te leren.
					De welpen gaan 2 x per jaar op weekend.
					Eén keer met de hele groep (groepsweekend) en één keer op takweekend
					(= enkel de welpen). Hiernaast is er ook het kamp.',
                'active' => 1
            ],
        	[
        		'name' => 'Jojo\'s',
        		'email' => 'jojoleiding@18bp.be',
        		'account' => 'BE03 0688 9980 6884',
        		'description' => 'Bij de jojo’s komen de meest typische scouting activiteiten aan bod.
					Je leert er verschillende technieken zoals sjorren, hout zagen en hakken, vuur maken, je eigen potje koken, je weg vinden met kaart en kompas…
					Maar er blijft ook plaats voor sport, toneel, knutselen, bosspelen… 
					<br>
					De jojo’s gaan 2 keer per jaar op weekend. Eén keer met de hele groep (groepsweekend) en één keer op takweekend
					(= enkel de jojo’s). Tijdens de paasvakantie gaan de jojo’s ook op een 5daags tentenkamp. Ze doen daar de nodige ervaring op voor het groot kamp.
					De jojo’s moeten immers zelf hun tenten opzetten, bedden sjorren, vuur maken, hun potje koken …',
                'active' => 1
        	],
        	[
        		'name' => 'Givers',
        		'email' => 'giverleiding@18bp.be',
        		'account' => 'BE89 0688 9980 6985',
        		'description' => 'Givers is een samentrekking van “gidsen en verkenners”. De givers gaan 2 keer per jaar op weekend.
					Eén keer met de hele groep (groepsweekend) en één keer op takweekend
					(= enkel met de givers). Naast de weekenden is er het kamp. Om de 3 jaar gaan de givers op een “speciaal” kamp.
					Vaak betekent dit een kamp in het buitenland, maar het kan ook gaan om een fietskamp, trektocht …',
                'active' => 1
            ],
        	[
        		'name' => 'Jins',
        		'email' => null,
        		'account' => null,
        		'description' => null,
                'active' => 0
            ],
        	[
        		'name' => 'Leiding',
        		'email' => null,
        		'account' => null,
        		'description' => null,
                'active' => 0
            ],
        ]);
    }
}
