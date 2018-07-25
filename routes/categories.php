<?php
$app->group('/api', function () use ($app){
	$app->get('/categories', function ($request, $response) {
        // put log message
        $this->logger->info("getting all categories");
        $data = Category::all();
        return json_encode($data, JSON_UNESCAPED_UNICODE);
    });
});