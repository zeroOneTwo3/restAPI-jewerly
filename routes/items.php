<?php
$app->group('/api', function () use ($app){
	/* CREATE */
    $app->post('/items/add', function ($request, $response) {
        // put log message
        $this->logger->info("saving item");
        $item = $request->getParsedBody();
        //$data = Item::create($item);
        $data = Item::create([
            'name' => $item['name'],
            'price' => $item['price'],
            'description' => $item['description'],
			'material' => $item['material']
        ]);
        //return $this->response->withJson($data, 200);
    });
	
	/* READ */
	$app->get('/items', function ($request, $response) {
        // put log message
        $this->logger->info("getting all items");
        $data = Item::all();
        //return json_encode($data, JSON_UNESCAPED_UNICODE);
		return $this->renderer->render(
			$response, 
			'items.phtml', 
			json_decode($data)
		);
    });
    $app->get('/items/[{id}]', function($request, $response, $args){
        // put log message
        $this->logger->info("getting item by id");
        $elem = Item::find($args['id']);
        //return json_encode($data, JSON_UNESCAPED_UNICODE);
		return $this->renderer->render(
			$response, 
			'items.phtml', 
			$data = ["0" => $elem]
		);
    });
	
	/* UPDATE */
    $app->put('/items/[{id}]', function ($request, $response, $args) {
        // put log message
        $this->logger->info("updating item");
        $item = $request->getParsedBody();
        $data = Book::where('id', $args['id'])->update([
            'title' => $item['title'],
            'author' => $item['author'],
            'category' => $item['category']
        ]);
        return $this->response->withJson($data, 200);
    });
	
	/* DELETE */
    $app->delete('/items/[{id}]', function ($request, $response, $args) {
        // put log message
        $this->logger->info("deleting item");
        $data = Item::destroy($args['id']);
        return $this->response->withJson($data, 200);
    });
});