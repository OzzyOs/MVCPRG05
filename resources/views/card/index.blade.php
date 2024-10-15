@foreach($cards as $card)
<div class="flex-col">
    <li>
        <a href="{{ route('cards.show', $card->id)}}"> {{ $card->name }} </a>
    </li>
</div>
@endforeach
