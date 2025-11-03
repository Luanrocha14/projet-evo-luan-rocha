<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;



class EventController extends Controller
{
    // Lista eventos (home)
    public function index()
    {
        $search = request('search');

        if ($search) {
            $events = Event::where('title', 'like', '%' . $search . '%')->get();
        } else {
            $events = Event::all();
        }

        return view('welcome', [
            'events' => $events,
            'search' => $search,
        ]);
    }

    // Formulário para criar evento
    public function create()
    {
        return view('events.create');
    }

    // Salva evento no banco
    public function store(Request $request)
    {
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // Upload da imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            if (!file_exists(public_path('img/events'))) {
                mkdir(public_path('img/events'), 0755, true);
            }

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        // Verifica usuário autenticado
        $user = Auth::user();
        if ($user) {
            $event->user_id = $user->id;
        } else {
            return redirect('/login')->with('msg', 'Você precisa estar logado para criar um evento!');
        }

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    // Mostra detalhes de um evento
    public function show($id)
    {
        $event = Event::findOrFail($id);

        // Relacionamento com o dono do evento
        $eventOwner = $event->user;

        return view('events.show', [
            'event' => $event,
            'eventOwner' => $eventOwner
        ]);
    }

    // Dashboard do usuário
    public function dashboard()
    {
        if (!Auth::check()) {
            return redirect('/login')->with('msg', 'Você precisa estar logado para acessar o dashboard!');
        }

        $user = Auth::user();
        $events = $user->events; // relacionamento hasMany no model User

        return view('events.dashboard', ['events' => $events]);
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);

        if ($event->user_id != Auth::id()) {
            return redirect('/dashboard')->with('msg', 'Você não tem permissão para editar este evento.');
        }

        return view('events.edit', compact('event'));
    }


    public function update(Request $request)
    {

        $data = $request->all();

        // Image Upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/events'), $imageName);

            $data['image'] = $imageName;
        }

        Event::findOrFail($request->id)->update($data);

        return redirect('/dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent($id) {

        $user = Auth::user();

        $user->eventsAsParticipant()->attach($id);

        $event = Event::findOrFail($id);

        return redirect('/dashboard')->with('msg', 'Sua presença está confirmada no evento ' . $event->title);

    }
    

}