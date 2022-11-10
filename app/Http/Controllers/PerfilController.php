<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        if($user->id === auth()->user()->id) 
        {
            return view('perfil.index');
        } else {
            return redirect()->route('profile.index', ['user' => auth()->user()->username]);
        }        
    }

    public function store(Request $request)
    {           
        $this->validate($request,   [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:30', 'not_in:edit-profile'],            
            'oldPassword' => ['required'],
        ]);        

        if($request->newPassword) {
            $this->validate($request, [                
                'newPassword' => ['min:6'],                 
            ]);        
        }

        if($request->image) {                                                  
            $imagen = $request->file('image');
            $nombreImagen = Str::uuid() . "." . $imagen->extension();
            $imagenServidor = Image::make($imagen);
            $imagenServidor->fit(1000, 1000, null, 'center');
            $imagePath = public_path('profile_pictures') . '/' . $nombreImagen;
            $imagenServidor->save($imagePath);
            
            $oldImage = public_path('profile_pictures/' . auth()->user()->image);

            if(File::exists($oldImage)) {
                unlink($oldImage);            
            }
        }                
        

        // Guardar cambios
        $user = User::find(auth()->user()->id);        
        $user->username = $request->username;
        $user->image = $nombreImagen ?? auth()->user()->image ?? null;
        $user->email = $request->email ?? auth()->user()->email;
        if($request->newPassword && Hash::check($request->oldPassword, auth()->user()->password)) {   
            $user->password = Hash::make($request->newPassword);       
        } elseif (!Hash::check($request->oldPassword, auth()->user()->password)) {
            return back()->with('mensaje', 'Contraseña incorrecta.');
        }

        $user->save();
        
        // Redireccionar usuario
        return redirect()->route('posts.index', $user->username);
    }
}
