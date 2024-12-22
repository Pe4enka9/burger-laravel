<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $user = User::query()->where('login', 'admin')->first();

        if ($user) {
            $response = $this->get('/admin/login');
            $response->assertOk();

            $response->assertViewIs('admin.login');

            $response = $this->actingAs($user)->get('/admin');

            $response->assertOk();
        }
    }

    public function testCreate()
    {
        $response = $this->get('/admin/categories/create');
        $response->assertOk();
        $response->assertViewIs('admin.categories.create');

        $data = [
            'name' => 'test category',
        ];

        $response = $this->post('/admin/categories/create', $data);
        $response->assertRedirect('/admin/categories');

        $this->assertDatabaseHas('categories', $data);
    }

    public function testUpdate()
    {
        $response = $this->get('/admin/categories/1/edit');
        $response->assertOk();

        $data = [
            'name' => 'test category update',
        ];

        $response = $this->patch('/admin/categories/1/edit', $data);
        $response->assertRedirect('/admin/categories');

        $this->assertDatabaseHas('categories', $data);
    }

    public function testDelete()
    {
        $response = $this->delete('/admin/categories/1');
        $response->assertRedirect('/admin/categories');

        $this->assertDatabaseMissing('categories', [
            'name' => 'test category update',
        ]);
    }
}
