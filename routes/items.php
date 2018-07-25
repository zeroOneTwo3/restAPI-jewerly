<?php
$app->group('/api', function () use ($app){
	/* CREATE */
	$app->get('/items/add', function ($request, $response, $args) {
        // put log message
        $this->logger->info("open form for creating item");
        return $this->renderer->render(
			$response,
			"item_form_create.phtml"
		);
    });
	
    $app->post('/items/add', function ($request, $response) {
        // put log message
        $this->logger->info("saving item");
        $item = $request->getParsedBody();
        //$data = Item::create($item);
        $data = Item::create([
            'name' => $item['name'],
            'price' => $item['price'],
            'description' => $item['description'],
			'material' => $item['material'],
			'decoration' => $item['decoration']
        ]);
        return "Succesful!";
    });
	
	/* READ */
	$app->get('/items', function ($request, $response) {
        // put log message
        $this->logger->info("getting all items");
        $data = Item::all();
        //return json_encode($data, JSON_UNESCAPED_UNICODE);
		return $this->renderer->render(
			$response, 
			'all_data.phtml', 
			json_decode($data)
		);
    });
    $app->get('/items/{id}', function($request, $response, $args){
        // put log message
        $this->logger->info("getting item by id");
		$elem = Item::find($args['id']);
		if($elem == null) {
               $this->response
				->withStatus(400)
				->withHeader('Content-Type', 'text/html')
				->write('Bad Request');
				return $this->response; 
		}
        //return json_encode($data, JSON_UNESCAPED_UNICODE);
		return $this->renderer->render(
			$response, 
			'all_data.phtml', 
			$data = ["0" => $elem]
		);
    });
	
	/* UPDATE */
	$app->get('/items/edit/{id}', function ($request, $response, $args) {
        // put log message
        $this->logger->info("open form for editing item");
		$elem = Item::find($args['id']);
		if($elem == null) {
               $this->response
				->withStatus(400)
				->withHeader('Content-Type', 'text/html')
				->write('Bad Request');
				return $this->response; 
		} 
        return $this->renderer->render(
			$response,
			"item_form_update.phtml",
			$data = json_decode($elem, true)
		);
    });
	
    $app->put('/items/edit/{id}', function ($request, $response, $args) {
        // put log message
        $this->logger->info("updating item");
        $item = $request->getParsedBody();
		try{
			$result = Item::where('id', $args['id'])->update([
				'name' => $item['name'],
				'price' => $item['price'],
				'description' => $item['description'],
				'category' => $item['category'],
				'material' => $item['material'],
				'decoration' => $item['decoration']
			]);
		}catch (Illuminate\Database\QueryException $e) {
               $this->response
				->withStatus(400)
				->withHeader('Content-Type', 'text/html')
				->write('Bad Request');
				return $this->response; 
		} 
		return $this->renderer->render(
			$response,
			"item_form_update.phtml",
			$item
			);
    });
	
	/* DELETE */
	$app->get('/items/delete/{id}', function ($request, $response, $args) {
        // put log message
        $this->logger->info("open form for deleting item");
        return $this->renderer->render(
			$response,
			"item_form_delete.phtml"
		);
    });
	
    $app->delete('/items/delete/{id}', function ($request, $response, $args) {
        // put log message
        $this->logger->info("deleting item");
        $data = Item::destroy($args['id']);
		if($data == null) {
			$this->response
				->withStatus(400)
				->withHeader('Content-Type', 'text/html')
				->write('Bad Request');
				return $this->response; 
		}
        return "Succesful!";
    });
});