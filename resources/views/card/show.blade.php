<x-layout>
    <div>
        <ul class="flex flex-col">
            <li style="margin-bottom: 10px" > Card Name : {{ $card->name }}</li>

            <li style="margin-bottom: 10px" > Card Description : {{ $card->description }}</li>

            <!-- Eerst haal je de 'type' table op, daarna haal je de gewenste column (type_id) -->
            <li style="margin-bottom: 10px" > Card Type : {{ $card->type->type_id}}</li>
        </ul>

        <button class="border rounded">
            <a href="{{ route('cards.index')}}" class="px-2"> Go Back </a>
        </button>
    </div>
</x-layout>
