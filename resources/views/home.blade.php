@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!

                    <p>Lorem Ipsum je fiktívny text, používaný pri návrhu tlačovín a typografie. Lorem Ipsum je štandardným výplňovým textom už od 16. storočia, keď neznámy tlačiar zobral sadzobnicu plnú tlačových znakov a pomiešal ich, aby tak vytvoril vzorkovú knihu. Prežil nielen päť storočí, ale aj skok do elektronickej sadzby, a pritom zostal v podstate nezmenený. Spopularizovaný bol v 60-tych rokoch 20.storočia, vydaním hárkov Letraset, ktoré obsahovali pasáže Lorem Ipsum, a neskôr aj publikačným softvérom ako Aldus PageMaker, ktorý obsahoval verzie Lorem Ipsum.

Prečo ho používame?
Je dávno známe, že ak je zrozumiteľný obsah stránky, na ktorej rozloženie sa čitateľ díva, jeho pozornosť je rozptýlená. Dôvodom použitia Lorem Ipsum je fakt, že má viacmenej normálne rozloženie písmen, takže oproti použitiu 'Sem príde text, sem príde text' sa obsah vypĺňanej oblasti na stránke viac podobá na skutočný text. Mnohé balíky publikačného softvéru a editorov webových stránok už používajú Lorem Ipsum ako predvolený výplňový text a keď dáte na internete vyhľadávať 'lorem ipsum', objavíte mnoho webových stránok v rannom štádiu ich vzniku. V minulých rokoch sa objavilo mnoho verzií tohto textu, niekedy náhodou, niekedy úmyselne (pridaný humor a podobne).

</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
