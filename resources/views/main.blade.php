@extends('layouts.app')

@section('titulo')
    Inicio
@endsection

@section('contenido')
    <section class="container mx-auto">        
        @if ($user->iFollow)                    
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">   
            @foreach ($posts as $post)
                <div> 
                    <a href="{{ route('posts.show', ['post' => $post, 'user' => $user ]) }}">
                        <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="Imagen del post {{ $post->titulo }}">
                    </a>
                </div>
            @endforeach
        </div>

        {{-- <div class="my-10">
            {{ $posts->links('pagination::tailwind') }}
        </div>  --}}

        @else 

            <p class="text-gray-699 uppercase text-sm text-center font-bold">No hay Posts</p>

        @endif
    </section>
@endsection
