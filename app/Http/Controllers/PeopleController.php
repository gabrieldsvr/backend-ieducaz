<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {

        $persondao = new Person();

        return view('people.index', [
            "peoples" => $persondao->getAllPeople()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {

        return view('people.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function createModal()
    {

        return view('people.create-modal');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $data = $request->except(['_token']);

            $usuario = auth()->user();

            $people = new Person();
            $people->id = (string)Str::uuid();
            $people->name = $data['name'];
            $people->phone = $data['phone'];
            $people->mail = $data['email'];
            $people->document = $data['document'];
            $people->type = $data['type'];
            $people->user_id = $usuario->id;
            $people->status = true;

            $people->save();
            $callback["message"] = "Sucesso!";
            echo json_encode($callback);

        } catch (\Exception $exception) {
            echo $exception;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Person $people
     * @return \Illuminate\Http\Response
     */
    public function show(Person $people)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Person $person
     * @return Application|Factory|View
     */
    public function edit(Person $person)
    {

        return view('people.edit', ["person" => $person]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Person $person
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person)
    {
        try {
            $request = $request->except(['_token', '_method']);

            $person->name = $request['name'];
            $person->mail = $request['email'];
            $person->phone = $request['phone'];
            $person->document = $request['document'];
            $person->type = $request['type'];
            $person->status = true;
            $person->save();
            $callback["message"] = "Sucesso!";
            $callback["url"] = route("people.index");
            echo json_encode($callback);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


    public function destroy($id)
    {
        $people = Person::find($id);
        $retorno = $people->deleteOrFail();
        return redirect('/people')->with('msg', 'excluido');
    }

    public function all()
    {


        $jsonobj = array(
            "data" => [
                array("id" => 1,
                    "first_name" => "teste",
                    "last_name" => "farrrer",
                    "email" => "dadasddasdas@gmail.com")
            ]
        );

        echo json_encode($jsonobj);
    }
}
