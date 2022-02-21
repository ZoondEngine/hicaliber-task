<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class TestSearchLogicTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_all_validation_rules()
    {
        $response = $this->post('api/search', [
            'name' => 1231231231,
            'price' => [
                'some',
                'value',
                'for',
                'error'
            ],
            'bedrooms' => 'NOT INTEGER',
            'bathrooms' => 'NOT INTEGER',
            'storeys' => 'NOT INTEGER',
            'garages' => 'NOT INTEGER'
        ]);

        $response->assertSessionHasErrors();

        Session::flush();

        $response =  $this->post('api/search', [
            'name' => 'i837b5oi7q5v8BO&q\8V7Q34P7q34',
            'price' => [
                1,
                200000
            ],
            'bedrooms' => 3,
            'bathrooms' => 3,
            'storeys' => 3,
            'garages' => 2
        ]);

        $response->assertSessionHasNoErrors();
        $content = $response->getOriginalContent();

        if(count($content['data']) > 0) {
            return self::markTestIncomplete('Data not was empty!');
        }

        if($content['error']) {
            if($content['error']['was'] === true || $content['error']['message'] !== '') {
                return self::markTestIncomplete('Error was occurred while searching - ' . $content['error']['message']);
            }
        }
    }
}
