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

    <p>Type</p>
    <label for="type"></label>
    <input type="text" id="type" name="type" required>

    <button type="submit">Create Card</button>
</form>
@else
<p>Please <a href="{{ route('login') }}">log in</a> to create a card.</p>
@endauth
@endif
