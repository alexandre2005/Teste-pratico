<?php

namespace App\Http\Controllers;

use App\User;
use App\Veiculo;
use Illuminate\Http\Request;
use App\Mail\VeiculoCadastrado;
use Illuminate\Support\Facades\Mail;

class VeiculoController extends Controller
{
    public function index()
    {
        if (auth()->user()->role == User::ROLE_ADMIN) {
            $veiculos = Veiculo::all();
        } else {
            $veiculos = Veiculo::where('propietario', auth()->user()->id)->get();
        }
        return view('veiculos.index', compact('veiculos'));
    }

    public function create()
    {
        if (auth()->user()->role == User::ROLE_ADMIN) {
            $users = User::all();
            return view('veiculos.create', compact('users'));
        } else {
            return redirect()->back()->with('status', 'Você não tem permissão para cadastrar veículos');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'placa' => ['required', 'regex:/^[A-Z]{3}[0-9]{4}$/'],
            'ano' => ['required', 'digits:4', 'integer'],
            'renavam' => ['required'],
            'modelo' => ['required'],
            'marca' => ['required'],
            'propietario' => ['required', 'exists:users,id']
        ], [
            'placa.required' => 'A placa é obrigatória.',
            'placa.regex' => 'A placa deve estar no formato AAA1111.',
            'ano.required' => 'O ano é obrigatório.',
            'ano.digits' => 'O ano deve ter exatamente 4 dígitos.',
            'ano.integer' => 'O ano deve ser um número inteiro.',
            'renavam.required' => 'O renavam é obrigatório.',
            'modelo.required' => 'O modelo é obrigatório.',
            'marca.required' => 'A marca é obrigatória.',
            'propietario.required' => 'O proprietário é obrigatório.',
            'propietario.exists' => 'O proprietário selecionado não existe.'
        ]);

        try {
            $veiculo = new Veiculo;
            $veiculo->placa = $request->input('placa');
            $veiculo->renavam = $request->input('renavam');
            $veiculo->modelo = $request->input('modelo');
            $veiculo->marca = $request->input('marca');
            $veiculo->ano = $request->input('ano');
            $veiculo->propietario = $request->input('propietario');
            $veiculo->save();

            $proprietario = User::find($veiculo->propietario);
            $proprietarioEmail = $proprietario->email;

            $adminEmails = User::where('role', User::ROLE_ADMIN)->pluck('email');

            $emails = $adminEmails->push($proprietarioEmail);

            //email sera enviado para todos os administradores e para o dono do veiculo
            Mail::to($emails)->send(new VeiculoCadastrado($veiculo));

            return redirect()->back()->with('status', 'Veículo cadastrado com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o veículo: ' . $e->getMessage());
        }
    }


    public function edit($id)
    {
        $veiculo = Veiculo::find($id);

        if (auth()->user()->role == User::ROLE_ADMIN || auth()->user()->id == $veiculo->propietario) {
            $users = User::all();
            return view('veiculos.edit', compact('veiculo', 'users'));
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para editar este veículo.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'placa' => ['required', 'regex:/^[A-Z]{3}[0-9]{4}$/'],
            'ano' => ['required', 'digits:4', 'integer'],
            'renavam' => ['required'],
            'modelo' => ['required'],
            'marca' => ['required'],
            'propietario' => ['required', 'exists:users,id']
        ], [
            'placa.required' => 'A placa é obrigatória.',
            'placa.regex' => 'A placa deve estar no formato AAA1111.',
            'ano.required' => 'O ano é obrigatório.',
            'ano.digits' => 'O ano deve ter exatamente 4 dígitos.',
            'ano.integer' => 'O ano deve ser um número inteiro.',
            'renavam.required' => 'O renavam é obrigatório.',
            'modelo.required' => 'O modelo é obrigatório.',
            'marca.required' => 'A marca é obrigatória.',
            'propietario.required' => 'O proprietário é obrigatório.',
            'propietario.exists' => 'O proprietário selecionado não existe.'
        ]);
        
        try {
            $veiculo = Veiculo::findOrFail($id);

            if (auth()->user()->role == User::ROLE_ADMIN || auth()->user()->id == $veiculo->propietario) {
                $veiculo->placa = $request->input('placa');
                $veiculo->renavam = $request->input('renavam');
                $veiculo->modelo = $request->input('modelo');
                $veiculo->marca = $request->input('marca');
                $veiculo->ano = $request->input('ano');
                $veiculo->propietario = $request->input('propietario');
                $veiculo->save();

                $proprietario = User::find($veiculo->propietario);
                $proprietarioEmail = $proprietario->email;

                $adminEmails = User::where('role', User::ROLE_ADMIN)->pluck('email')->toArray();

                // Adiciona o e-mail do proprietário aos e-mails dos administradores
                $emails = array_merge($adminEmails, [$proprietarioEmail]);

                // Envia o e-mail para todos os administradores e para o dono do veículo
                Mail::to($emails)->send(new VeiculoCadastrado($veiculo));

                return redirect()->back()->with('status', 'Veículo atualizado com sucesso');
            } else {
                return redirect()->back()->with('error', 'Você não tem permissão para atualizar este veículo.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao atualizar o veículo: ' . $e->getMessage());
        }
    }


    public function destroy($id)
    {
        $veiculo = Veiculo::find($id);

        if (auth()->user()->role == User::ROLE_ADMIN || auth()->user()->id == $veiculo->propietario) {
            if ($veiculo) {
                $veiculo->delete();
                return redirect()->back()->with('success', 'Veículo excluído com sucesso');
            } else {
                return redirect()->back()->with('error', 'Veículo não encontrado.');
            }
        } else {
            return redirect()->back()->with('error', 'Você não tem permissão para excluir este veículo.');
        }
    }

}
