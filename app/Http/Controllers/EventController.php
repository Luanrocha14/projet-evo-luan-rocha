<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
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

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $event = new Event;

        $event->title = $request->title;
        $event->date = $request->date;
        $event->city = $request->city;
        $event->private = $request->private;
        $event->description = $request->description;
        $event->items = $request->items;

        // 🟢 Upload da imagem com verificação
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;
            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            // 🟢 Cria a pasta se não existir
            if (!file_exists(public_path('img/events'))) {
                mkdir(public_path('img/events'), 0755, true);
            }

            $requestImage->move(public_path('img/events'), $imageName);

            $event->image = $imageName;
        }

        // 🟢 Verifica se o usuário está autenticado
        $user = Auth::user();
        if ($user) {
            $event->user_id = $user->id;
        } else {
            return redirect('/login')->with('msg', 'Você precisa estar logado para criar um evento!');
        }

        $event->save();

        return redirect('/')->with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);

        $eventOwner = User::where('id', $event->user_id)->first()->toArray();

        return view('events.show', ['event' => $event, 'eventOwner' => $eventOwner]);
    }
}
