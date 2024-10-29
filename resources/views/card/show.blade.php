<x-layout>
    <div class="flex flex-col border rounded">

        <div id="header" style="justify-content: center" >
           <p style="font-weight: bold; padding-left: 10px; padding-top: 5px; padding-bottom: 5px">{{ $card -> name }}</p>
        </div>

        <div id="description">
            <p style="margin-bottom: 10px; font-weight: bold; margin-left: 5px; margin-right: 5px">{{ $card->description }}</p>
        </div>

        <div style="align-content: center; justify-self: center">
            <p style="font-weight: bold; margin-bottom: 10px">{{ $card->type?->type_id}}</p>

        </div>

    </div>
    <div>
    <button class="border rounded">
        <a href="{{ route('cards.index')}}" class="px-2"> Go Back </a>
    </button>
    </div>

    <button>
       <a href="/cards/{{$card->id}}/edit"> Edit Card </a>
    </button>
</x-layout>
