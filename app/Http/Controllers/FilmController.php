<?php

namespace App\Http\Controllers;

use App\Models\Film;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FilmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Auth::user()->films();

        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->filled('status')) {
            if ($request->status === 'assistido') {
                $query->assistidos();
            } elseif ($request->status === 'nao_assistido') {
                $query->naoAssistidos();
            }
        }

        $orderBy = $request->get('order_by', 'created_at');
        $orderDirection = $request->get('order_direction', 'desc');
        
        $films = $query->orderBy($orderBy, $orderDirection)->paginate(10);

        return view('films.index', compact('films'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('films.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'diretor' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'avaliacao' => 'nullable|numeric|min:0|max:10',
            'assistido' => 'boolean',
            'observacoes' => 'nullable|string|max:1000'
        ]);

        $validated['user_id'] = Auth::id();
        $validated['assistido'] = $request->has('assistido');

        Film::create($validated);

        return redirect()->route('films.index')
            ->with('success', 'Filme adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Film $film)
    {
        if ($film->user_id !== Auth::id()) {
            abort(403);
        }

        return view('films.show', compact('film'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Film $film)
    {
        if ($film->user_id !== Auth::id()) {
            abort(403);
        }

        return view('films.edit', compact('film'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Film $film)
    {
        if ($film->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'diretor' => 'required|string|max:255',
            'ano' => 'required|integer|min:1900|max:' . (date('Y') + 5),
            'avaliacao' => 'nullable|numeric|min:0|max:10',
            'assistido' => 'boolean',
            'observacoes' => 'nullable|string|max:1000'
        ]);

        $validated['assistido'] = $request->has('assistido');

        $film->update($validated);

        return redirect()->route('films.index')
            ->with('success', 'Filme atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Film $film)
    {
        // Verificar se o filme pertence ao usuário
        if ($film->user_id !== Auth::id()) {
            abort(403);
        }

        $film->delete();

        return redirect()->route('films.index')
            ->with('success', 'Filme removido com sucesso!');
    }

    /**
     * Toggle watched status of a film.
     */
    public function toggleWatched(Film $film)
    {
        if ($film->user_id !== Auth::id()) {
            abort(403);
        }

        $film->update(['assistido' => !$film->assistido]);

        $status = $film->assistido ? 'assistido' : 'não assistido';
        
        return redirect()->back()
            ->with('success', "Filme marcado como {$status}!");
    }
}
