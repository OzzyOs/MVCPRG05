<x-layout>
    <div class="flex flex-col align-middle w-full">
        <h1 class="flex justify-center">Please click on a card to reveal it's secrets or create your own card!</h1>
        <div class="flex flex-row gap-4 justify-center w-1/5 border">
                        @foreach($cards as $card)
                            <div class=" flex-wrap mb-6 border justify-center w-1/2 overflow-hidden py-2 px-2">
                                <a href="{{route('cards.show', $card->id)}}"> {{ $card -> name }} </a>
                            </div>
                        @endforeach
                    <div>
                </div>
        </div>
    </div>
</x-layout>
