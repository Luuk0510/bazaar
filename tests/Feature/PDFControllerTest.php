<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class PDFControllerTest extends TestCase
{
    use RefreshDatabase;

    public function it_generates_a_pdf_contract_for_a_user()
    {
        $user = User::factory()->create();

        $response = $this->get(route('generate.contract.pdf', $user->id));

        $response->assertOk();

        $response->assertHeader('Content-Type', 'application/pdf');

        $expectedContentDisposition = 'attachment; filename=contract-' . $user->name . '.pdf';
        $response->assertHeader('Content-Disposition', $expectedContentDisposition);
    }
}
