<?php

test('marketing use-case page renders successfully', function () {
    $response = $this->get(route('usecases.marketing'));

    $response->assertStatus(200);
    $response->assertSee('Marketing');
    $response->assertSee('Feltöltés alatt');
});
