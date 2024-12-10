<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EsecuzioneTestTest extends DuskTestCase
{
    /**
     * Test per l'esecuzione del test di conformità NIS2
     * @group take-test
     */

    public function testUtentePuoEseguireTest()
    {
        $this->browse(function (Browser $browser) {
            $browser->loginAs(User::find(1))
                ->visit('/le-mie-organizzazioni')
                ->press('#esegui-test-button')
                ->assertPathIs('/le-mie-organizzazioni/1/esegui-test-nis2')
                ->pause(500);

            // Esegui 17 iterazioni per simulare il processo di completamento dei gruppi
            for ($group = 1; $group <= 17; $group++) {
                $browser->click('#random-select-button')
                    ->pause(500);
                if ($group === 17) {
                    $browser->click('#finish-test-button');
                } else {
                    $browser->click('#next-group-btn')
                        ->pause(500);
                }
            }

        });
    }


}
