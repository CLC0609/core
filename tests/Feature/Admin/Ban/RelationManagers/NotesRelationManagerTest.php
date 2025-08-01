<?php

namespace Tests\Feature\Admin\Ban\RelationManagers;

use App\Filament\Admin\Resources\BanResource\RelationManagers\NotesRelationManager;
use App\Models\Mship\Account\Ban;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Livewire;
use Tests\Feature\Admin\BaseAdminTestCase;

class NotesRelationManagerTest extends BaseAdminTestCase
{
    public function test_it_renders()
    {
        $this->actingAsSuperUser();

        $ban = Ban::factory()->create();
        Livewire::test(NotesRelationManager::class, ['ownerRecord' => $ban, 'pageClass' => ViewRecord::class])
            ->assertSuccessful();
    }

    public function test_it_can_create_note()
    {
        $this->actingAsSuperUser();

        $ban = Ban::factory()->create();
        Livewire::test(NotesRelationManager::class, ['ownerRecord' => $ban, 'pageClass' => ViewRecord::class])
            ->callTableAction('create', null, ['content' => 'the content']);

        $this->assertDatabaseHas('mship_account_note', ['account_id' => $ban->account->id, 'writer_id' => $this->privacc->id, 'content' => 'the content', 'attachment_id' => $ban->id, 'attachment_type' => Ban::class]);
    }
}
