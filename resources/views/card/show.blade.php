<x-layout>
    <div class="flex flex-col border rounded">

        <div id="header" style="border-bottom-width: medium; justify-content: center" >
           <p style="font-weight: bold; padding-left: 10px; padding-top: 5px; padding-bottom: 5px">{{ $card->name }}</p>
        </div>

        <div id="description" style="height:100px; border-width: medium; margin-top: 50px">
            <p style="margin-bottom: 10px; font-weight: bold; margin-left: 5px; margin-right: 5px">{{ $card->description }}</p>
        </div>

            <!-- Eerst haal je de 'type' table op, daarna haal je de gewenste column (type_id) -->
            <p style="font-weight: bold; margin-bottom: 10px">{{ $card->type->type_id}}</p>

    </div>
    <div>
    <button class="border rounded">
        <a href="{{ route('cards.index')}}" class="px-2"> Go Back </a>
    </button>
    </div>
</x-layout>
