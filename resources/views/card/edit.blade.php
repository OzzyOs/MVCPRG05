<x-layout title="Edit Card">
    @if (Route::has('login'))
        @auth
            <form method="POST" action="{{ route('cards.update', $card->id) }}">
                @csrf
                @method('PATCH')
                <header>Current card:  {{$card -> name}}</header>

                <p>Name</p>
                <label for="name"></label>
                <input type="text"
                       id="name"
                       name="name"
                       value="{{ $card -> name }}"
                       required>

                <p>Description</p>
                <label for="description"></label>
                <input type="text"
                       id="description"
                       name="description"
                       value="{{ $card->description }}"
                       required>

                <p style="padding-top: 15px">Card Type</p>
                <div style="flex: 1; flex-direction: column;">
                    <select class="form-select" id="type" name="type" style="margin-bottom: 25px; width: 150px; padding-left: 5px" required>
                        <option value="" disabled>Select a type</option>
                        <option value="1" {{ $card-> type -> type_id === 'Monster' ? 'selected' : '' }}>Monster</option>
                        <option value="2" {{ $card-> type -> type_id === 'Magic' ? 'selected' : '' }}>Magic</option>
                        <option value="3" {{ $card-> type -> type_id === 'Trap' ? 'selected' : '' }}>Trap</option>
                    </select>
                </div>


                <button type="submit" class="btn btn-primary" style="border-width: 1px; border-radius: 5px; padding-left: 5px; padding-right: 5px">Save</button>
                <a href="/cards/{{$card->id}}"> Cancel </a>
            </form>

            <button form="delete-form">Delete</button>

            <form method="POST" action="/cards/{{$card -> id}}" id="delete-form">
                @csrf
                @method('DELETE')
            </form>

        @else
            <p>You need to be <a href="{{ route('login') }}">logged in</a> to edit a card.</p>
        @endauth
    @endif
</x-layout>
