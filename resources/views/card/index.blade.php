<x-layout>
    <div class=" flex flex-col">
        <p>Please click on a card to reveal it's secrets</p>
            @foreach($cards as $card)
                <div class="flex mb-6">
                    <a href="{{ route('cards.show', $card->id)}}"> {{ $card -> name }} </a>
                </div>
            @endforeach
        <div>

        </div>
    </div>
</x-layout>
