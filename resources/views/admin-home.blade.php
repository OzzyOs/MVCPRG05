<x-layout>
    <div class="flex flex-col" >

        <div>
            <header>Welcome to the Admin Page</header>
        </div>

        <p style="font-weight: bold">Current registered cards : </p>
            @foreach($cards as $card)
            <form action="{{ route('cards.checkStatus', $card->id) }}" method="POST">
                @csrf
                <button type="submit">
                    {{$card->status === 'true' ? 'Hide' : 'Show'}}
                </button>
            </form>

            <div class="flex flex-col">
                Card name : {{$card -> name}}
                Card type : {{$card -> type -> type_id}}
                Card author : {{$card -> user -> name}}
            </div>
            @endforeach



        <p style="font-weight: bold">Current Registered users : </p>
        @foreach($users as $user)
            <div class="flex-col flex">

            {{$user -> name}}
            </div>
        @endforeach



    </div>
</x-layout>
