<x-layout title="Create Card">
@if (Route::has('login'))
@auth
<form method="POST" action="{{ route('cards.store') }}">
    @csrf
    <p>Name</p>
    <label for="name"></label>
    <input type="text" id="name" name="name" required>

    <p>Description</p>
    <label for="description"></label>
    <input type="text" id="description" name="description" required>

    <p style="padding-top: 15px">Card Type</p>
    <!-- HTML escaping, prevent certain characters from being recognized as special characters  -->
    <form action="{{ route('card.create') }}" method="POST">
        @csrf
        <div style="flex: 1; flex-direction: column;" >
            <select class="form-select" id="type" name="type" style="margin-bottom: 25px; width: 150px; padding-left: 5px" required>
                <option value="" selected>Select a type</option>
                <option value="1">Monster</option>
                <option value="2">Magic</option>
                <option value="3">Trap</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="border-width: 1px; border-radius: 5px; padding-left: 5px; padding-right: 5px">Submit</button>
    </form>
</form>
@else
<p>You need to be <a href="{{ route('login') }}">logged in</a> to create a card.</p>
@endauth
@endif
</x-layout>
