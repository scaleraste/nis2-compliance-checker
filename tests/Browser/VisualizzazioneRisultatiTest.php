<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class VisualizzazioneRisultatiTest extends DuskTestCase
{
    /**
     * Test per la visualizzazione dei risultati
     * @group see-results
     */
    public function testUtentePuoVedereRisultati()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/le-mie-organizzazioni')
                ->press('#results-button')
                ->assertPathIs('/organizations/1/results')
                ->assertSee('Risultati');
        });
    }
}
