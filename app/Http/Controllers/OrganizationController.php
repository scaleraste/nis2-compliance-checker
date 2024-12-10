<?php

namespace App\Http\Controllers;

use App\Models\Control;
use App\Models\Requirement;
use App\Models\Result;
use App\Models\Score;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $industry_type = $request->input('industry_type');
        $size = $request->input('size');

        $query = Organization::query();

        if ($industry_type) $query->where('industry_type', $industry_type);
        if ($size) $query->where('size', $size);

        // Filtra le organizzazioni in base all'utente loggato
        $organizations = $query->where('user_id', $user->id)->get();

        $industry_types = Organization::where('user_id', $user->id)->select('industry_type')->distinct()->pluck('industry_type');
        $sizes = Organization::where('user_id', $user->id)->select('size')->distinct()->pluck('size');

        return view('organization.my-organizations', compact('organizations','user', 'industry_types', 'sizes'));

    }


    /**
     * Display the creation interface.
     */
    public function create(Request $request)
    {
        return view('organization.create-organization');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'industry_type' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255'],
            'compliance_status' => ['nullable', 'boolean'],
        ]);

        $organization = new Organization();
        $organization->name = $data['name'];
        $organization->description = $data['description'];
        $organization->industry_type = $data['industry_type'];
        $organization->size = $data['size'];
        //$organization->compliance_status = $data['compliance_status'];
        $organization->user_id = auth()->id();  // Associa l'organizzazione all'utente autenticato
        $organization->save();

        // Associa i controlli all'organizzazione
        //$selectedControls = explode(',', $request->input('selected_controls'));
        //$organization->controls()->sync($selectedControls);

        return redirect((__('routes.my_organizations_index')))
        // . '/' . $organization->id));
            ->with('success', __('strings.organization-create-success'));

    }


    /**
     * Display the specified resource.
     */
    public function showData(Organization $organization)
    {
        $organization->load('controls');

        return view('organization.show-organization-data', compact('organization'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $organization = Organization::find($id);
        return view('organization.edit-organization', compact('organization'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'industry_type' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255'],
            'compliance_status' => ['nullable', 'boolean'],
        ]);

       // $organization = Organization::find($id);
        $organization->update($request->all());

        //$selectedControls = explode(',', $request->input('selected_controls'));
        //$organization->controls()->sync($selectedControls);


        return redirect(route('my-organizations.index'))
        // . '/' . $organization->id);
            ->with('success', __('strings.organization-update-success'));

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $organization = Organization::find($id);
        $organization->delete();
        return redirect()->route('my-organizations.index')
            ->with('success', __('strings.organization-delete-success'));
    }


    /**
     * Mostra il test di valutazione conformità NIS2
     */
    public function take(Organization $organization, $group = 1)
    {
        $controls = Control::where('nis2_ref', $group)->get();
        $requirement = Requirement::where('id', $group)->first();

        return view('organization.take-test', compact('organization', 'controls', 'group', 'requirement'));
    }



    /**
     * Termina il test di valutazione conformità NIS2
     */
    public function submit(Request $request, Organization $organization)
    {
        // Validazione delle risposte inviate
        $data = $request->validate([
            'responses' => ['nullable', 'array'],
            'responses.*' => ['nullable', 'string'],
            'action' => ['required', 'string'], // "next", "previous", o "finish"
            'current_group' => ['required', 'integer'], // Gruppo attuale
        ]);

        $user = Auth::user();
        $sessionKey = "organization_{$organization->id}_responses";

        // Recupera le risposte già salvate in sessione
        $savedResponses = session($sessionKey, []);

        // Salva solo le risposte del gruppo corrente
        if (!empty($data['responses'])) {
            $savedResponses[$data['current_group']] = $data['responses'];
            session([$sessionKey => $savedResponses]);
        }

        if (!is_array($savedResponses)) {
            $savedResponses = [];
        }

        // Gestione delle azioni
        $currentGroup = $data['current_group'];

        if ($data['action'] === 'next') {
            $nextGroup = $currentGroup + 1;
            if ($nextGroup > 17) $nextGroup = 17; // Limita al gruppo massimo
            return redirect()->route('test.show', ['organization' => $organization->id, 'group' => $nextGroup]);
        }

        if ($data['action'] === 'previous') {
            $previousGroup = $currentGroup - 1;
            if ($previousGroup < 1) $previousGroup = 1; // Limita al gruppo minimo
            return redirect()->route('test.show', ['organization' => $organization->id, 'group' => $previousGroup]);
        }

        if ($data['action'] === 'finish') {
            $uniformTimestamp = now(); // Timestamp unico
            $records = []; // Array per i record da salvare

            // Prepariamo variabili per calcolo score
            $totalWeight = 0;
            $achievedWeight = 0;
            $bonusWeight = 0;

            // Itera sulle risposte salvate in sessione
            foreach ($savedResponses as $groupResponses) {
                foreach ($groupResponses as $controlId => $response) {

                    // Recupera il controllo per calcolare il peso
                    $control = Control::find($controlId);

                    // Converti la priorità in peso
                    $weight = match ($control->priority) {
                        'Low' => 1,
                        'Medium' => 2,
                        'High' => 3,
                        default => 1, // Default a Low se non specificato
                    };

                    $totalWeight += $weight;

                    // Calcola il peso per risposta
                    if ($response === 'yes') {
                        $achievedWeight += $weight;

                        // Aggiungi il bonus per controlli ad alta priorità
                        if ($control->priority === 'High') {
                            $bonusWeight += $weight * 0.5;
                        }
                    }

                    // Salva il risultato nel database
                    $records[] = [
                        'user_id' => $user->id,
                        'organization_id' => $organization->id,
                        'control_id' => $controlId,
                        'response' => $response,
                        'created_at' => $uniformTimestamp,
                        'updated_at' => $uniformTimestamp,
                    ];

                }
            }

            // Calcolo del punteggio con bonus
            $effectiveAchievedWeight = min($achievedWeight + $bonusWeight, $totalWeight);
            $scorePercentage = $totalWeight > 0 ? ($effectiveAchievedWeight / $totalWeight) * 100 : 0;

            // Salva lo score nel database
            Score::create([
                'user_id' => $user->id,
                'organization_id' => $organization->id,
                'score' => $scorePercentage,
            ]);

            // Salvataggio di massa
            Result::insert($records);

            // Elimina le risposte dalla sessione dopo il salvataggio
            session()->forget($sessionKey);
        }

        // Reindirizza alla pagina dei dettagli
        return redirect()->route('results.details', [
            'organization' => $organization->id,
            'date' => $uniformTimestamp,
        ]);
    }



        /**
     * Raggruppa i risultati del test per data di creazione
     */
    public function listResults(Organization $organization)
    {
        // Recupera tutti i risultati per l'organizzazione, raggruppati per data e ora precisa (data, ora, minuti, secondi)
        $results = Result::where('organization_id', $organization->id)
            ->selectRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") as date_time, COUNT(*) as total')
            ->groupByRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s")')
            ->orderByDesc('date_time')
            ->get();

        return view('organization.results-list', compact('organization', 'results'));
    }


    /**
     * Mostra i risultati del test con i dettagli delle risposte e delle implementazioni mancanti
     */
    public function showResultsDetails(Organization $organization, $date_time)
    {
        $user = Auth::user();

        // Recupera lo score relativo a quella data, ora, minuti e secondi
        $score = Score::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") = ?', [$date_time])
            ->first();

        // Recupera i controlli con risposta "no" o "partially" e le implementazioni suggerite per quella data/ora
        $implementations = Result::where('results.organization_id', $organization->id)
            ->where('results.user_id', $user->id)
            ->whereRaw('DATE_FORMAT(results.created_at, "%Y-%m-%d %H:%i:%s") = ?', [$date_time])
            ->whereIn('results.response', ['no', 'partially']) // Filtra le risposte "no" e "partially"
            ->join('controls', 'results.control_id', '=', 'controls.id')
            ->join('implementations', function ($join) {
                $join->on('controls.code', '=', 'implementations.code_ref')
                    ->on('controls.framework', '=', 'implementations.framework_ref');
            })
            ->select(
                'controls.id as control_id',
                'controls.code',
                'controls.category',
                'implementations.implementation_text',
                'results.response', // Aggiungi la risposta per raggruppamenti futuri
                'controls.framework'
            )
            ->get();

        // Raggruppa le implementazioni per controllo e risposta
        $groupedImplementations = $implementations->groupBy(function ($item) {
            return $item->control_id . '|' . $item->code . '|' . $item->framework . '|' . $item->response;
        });


        // Recupera i risultati del test specifico per l'organizzazione ordinati per created_at discendente
        $results = Result::where('organization_id', $organization->id)
            ->where('user_id', $user->id)
            ->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d %H:%i:%s") = ?', [$date_time])
            ->orderBy('created_at', 'desc')
            ->paginate(10);



        return view('organization.result-details', compact('organization', 'date_time', 'score', 'groupedImplementations', 'results'));
    }

}
