<x-layout>
    <div>
        <ul class="flex flex-col">
            <li style="margin-bottom: 10px" > Card Name : {{ $card->name }}</li>

            <li style="margin-bottom: 10px" > Card Description : {{ $card->description }}</li>

            <li style="margin-bottom: 10px" > Card Type : {{ $card->type_id}}</li>
        </ul>

        <a href="{{ route('cards.index')}}"> Go Back </a>
    </div>
</x-layout>
