<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Session;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $paginate = 2;

        if (!isset($request->search_string)) {
            $users = User::orderBy('id', 'desc')->paginate($paginate);
        } else {
            $data['searchTitle'] = $request->search_string;
            $users = User::where('name', 'like', '%' . $request->search_string . '%')
                        ->orWhere('email', 'like', '%' . $request->search_string . '%')
                        ->orderBy('id', 'desc')->paginate($paginate);
        }

        return view('admin.users', compact('users', 'data'));
    }

    public function create(Request $request)
    {
        return view('admin.users_form_create');
    }

    public function update($id)
    {
        $user = User::find($id);
        return view('admin.users_form_update', compact('user'));
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();

        Session::flash('message', "Usuário excluido com sucesso!");
        return redirect()->route('adminUsers');
    }

    public function save(Request $request)
    {
        $messages = [
            'name.required' => 'Digite o nome',
            'email.email' => 'Email invalido',
            'email.required' => 'Digite o email',
            'email.unique' => 'Email ja cadastrado',
            'password.alpha_num' => 'Digite uma senha valida',
            'password.max' => 'A senha deve ter entre 6 e 15 caracteres',
            'password.min' => 'A senha deve ter entre 6 e 15 caracteres',
            'password.required' => 'Digite uma senha valida',
            'conf_password.required' => 'Digite a senha de confirmacao',
            'conf_password.same' => 'Senha de confirmacao incorreta',
        ];

        if ($request->id) { //update
            $user = User::find($request->id);

            if ($user->email == $request->email) {
                $ruleEmail = 'required|email';
            } else {
                $ruleEmail = 'required|email|unique:users,email';
            }

            $rules = [
                'name'  => 'required|min:3',
                'email' => $ruleEmail,
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->route('adminUsersUpdate', ['id' => $request->id])->withErrors($validator)->withInput();
            }
            Session::flash('message', 'Usuário atualizado com sucesso!');
        } else { // insert
            $rules = [
                'name'  => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:6|max:15',
                'conf_password' => 'required|same:password',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return redirect()->route('usersCreate')->withErrors($validator)->withInput();
            }

            $user = new User();
            $user->password = bcrypt($request->password);
            $user->remember_token = bcrypt($request->email);
            Session::flash('message', 'Usuário cadastrado com sucesso!');
        }

        $user->name = $request->name;
        $user->email = $request->email;

        $user->save();

        return redirect()->route('adminUsers');
    }
}
