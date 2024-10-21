<x-layout>
<p>Please click on a card to reveal it's secrets</p>

@foreach($cards as $card)
<div class="flex-col">
    <li>
        <a href="{{ route('cards.show', $card->id)}}"> {{ $card->name }} </a>
    </li>
</div>
@endforeach
    <div>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
            {{ __('Log Out') }}
        </button>
    </form>
    </div>
</x-layout>
