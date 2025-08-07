<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Validation\Rule;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function novoUsuario()
    {
        return view('usuarios.form');
    }

    public function criar(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'nivel_perfil' => 'required|string',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nivel_perfil' => $request->nivel_perfil,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso');
    }

    public function editarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.form', compact('usuario'));
    }

    public function atualizarUsuario(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $data = $request->all();

        $validado = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($usuario->id),
            ],
            'password' => 'nullable|string|min:6|confirmed',
            'nivel_perfil' => 'required|string',
        ])->validate();

        if (!empty($validado['password'])) {
            $validado['password'] = bcrypt($validado['password']);
        } else {
            unset($validado['password']);
        }

        $usuario->update($validado);

        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function confirmarExclusao($id)
    {
        $usuario = User::findOrFail($id);

        return view('usuarios.deletar', compact('usuario'));
    }

    public function deletar($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('usuarios.index')->with('success', 'Sucesso ao deletar registro!');
    }
}
