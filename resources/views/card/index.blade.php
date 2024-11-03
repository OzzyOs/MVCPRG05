<x-layout>
    <div class="flex flex-col align-middle w-full">

        <h1 class="flex justify-center">Please click on a card to reveal it's secrets or create your own card!</h1>

        <form action="{{route('cards.index')}}" method="GET">
            @csrf
            <input type="text" name="search" placeholder="Search a card" value="{{request('search')}}">
            <button type="submit">Search</button>
        </form>

        <form action="{{ route('cards.index') }}" method="GET">
            @csrf
            <div>
                <button type="submit" name="category" value="1">Monster</button>
                <button type="submit" name="category" value="2">Magic</button>
                <button type="submit" name="category" value="3">Trap</button>
                <button type="submit" name="category" value="">All</button>
            </div>
        </form>


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
