@extends('layout')

@section('body')
    <main>
        <section class="grid gap-10 grid-cols-2">
            <form action="{{ route('item-search') }}" method="post" class="prose">
                @csrf
                <h1>Search Users</h1>

                <fieldset class="my-5">
                    <label class="flex flex-col text-gray-500">
                        Keywords
                        <input type="text" name="keywords" autocomplete="off" value="{{ $keywords ?? '' }}" />
                    </label>
                </fieldset>

                <fieldset class="my-5">
                    <button class="bg-blue-300 font-medium px-10 py-2 rounded mt-2" type="submit">Search</button>
                </fieldset>
                <fieldset class="my-5">
                    <a href="{{ route('item-search') }}" class="bg-yellow-300 font-medium px-10 py-2 rounded mt-2"
                        type="submit">Clear</a>
                </fieldset>
            </form>

            <div class="prose">
                <h2>Results</h2>

                <ul>
                    @foreach ($people as $person)
                        <li><b>{{ $person->title }}</b>
                            <p>{{ $person->description }}</p>
                            <p>{{ $person->created_at }}</p>
                        </li>
                    @endforeach
                </ul>
                
            </div>
        </section>

        <section class="prose mt-10 max-w-5xl">
            <h2>Query</h2>
            <pre class="">{{ $query ?? 'none' }}</pre>
        </section>
    </main>
@endsection
