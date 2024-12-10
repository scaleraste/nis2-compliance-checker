<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class CreazioneOrganizzazioneTest extends DuskTestCase
{
    /**
     * Test per l'inserimento di un'organizzazione
     * @group create-organization
     */
    public function testUtentePuoCreareOrganizzazione()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/crea-organizzazione')
                ->type('name', 'Enterprise SRL')
                ->select('industry_type', 'Costruzioni')
                ->select('size', '11-50 dipendenti (Piccola impresa)')
                ->press('#create-organization-button');
        });
    }


}
