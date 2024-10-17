    <form method="POST" action="{{route('types.store')}}">
        @csrf
        <label for="title"></label>
        <input type="text" id="title" name="title">
        <button type="submit"></button>
    </form>
