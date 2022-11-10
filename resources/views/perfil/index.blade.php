@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')
    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white shadow p-6">
            @if(session('mensaje'))
                <div class="bg-red-500 p-2 rounded-lg mb-6 text-white text-center uppercase font-bold">
                    {{session('mensaje')}}
                </div>
            @endif

            <form method="POST" action="{{ route('profile.store', ['user' => auth()->user()->username]) }}" enctype="multipart/form-data" class="mt-10 md:mt-0">
                @csrf             
                <div class="mb-5">
                    <label for="username" class="mb-2 block uppercase text-gray-500 font-bold">username</label>
                    <input id="username" name="username" type="text" placeholder="Your username" value="{{ auth()->user()->username }}" class="border p-3 w-full rounded-lg @error('username') border-red-500 @enderror">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="email" class="mb-2 block uppercase text-gray-500 font-bold">email</label>
                    <input id="email" name="email" type="text" placeholder="Your email" value="{{ auth()->user()->email }}" class="border p-3 w-full rounded-lg @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>
                
                <div class="mb-5">
                    <label for="oldPassword" class="mb-2 block uppercase text-gray-500 font-bold">verify password</label>
                    <input id="oldPassword" name="oldPassword" type="password" placeholder="Introduce your old password" value="" class="border p-3 w-full rounded-lg @error('oldPassword') border-red-500 @enderror">
                    @error('oldPassword')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="newPassword" class="mb-2 block uppercase text-gray-500 font-bold">Your new password</label>
                    <input id="newPassword" name="newPassword" type="password" placeholder="Introduce your old password" value="" class="border p-3 w-full rounded-lg @error('newPassword') border-red-500 @enderror">
                    @error('newPassword')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-5">
                    <label for="image" class="mb-2 block uppercase text-gray-500 font-bold">Your profile picture</label>
                    <input id="image" name="image" type="file" value="" value=".jpg, .jpeg, .png" class="border p-3 w-full rounded-lg">
                </div>

                <input type="submit" value="Save changes" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase font-bold w-full p-3 text-white rounded-lg"> 

            </form>
        </div>
    </div>
@endsection
