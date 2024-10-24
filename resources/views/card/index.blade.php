<x-layout>
        <div class="flex justify-center align-middle">
        <h1>Please click on a card to reveal it's secrets or create your own card!</h1>
        </div>
        <div class=" flex flex-col">
                        @foreach($cards as $card)
                            <div class="flex mb-6 border w-full">
                                <a href="{{ route('cards.show', $card->id)}}"> {{ $card -> name }} </a>
                            </div>
                        @endforeach
                    <div>
                </div>
        </div>
</x-layout>
