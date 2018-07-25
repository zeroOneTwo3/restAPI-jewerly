<?php
$app->group('/api', function () use ($app){
	/* CREATE */
	$app->get('/categories/add', function ($request, $response) {
        // put log message
        $this->logger->info("open form for category creating");
        return $this->renderer->render(
			$response, 
			'category_form_create.phtml'
		);
    });
	
	$app->post('/categories/add', function ($request, $response) {
        // put log message
        $this->logger->info("saving category");
        $category = $request->getParsedBody();
        $data = Category::create([
			'name' => $category['name']
        ]);
        return "Succesful!";
    });
	
	/* READ */
	$app->get('/categories', function ($request, $response) {
        // put log message
        $this->logger->info("getting all categories");
        $data = Category::all();
        return $this->renderer->render(
			$response, 
			'all_data.phtml', 
			json_decode($data)
		);
    });
	
	$app->get('/categories/{category}', function ($request, $response, $args) {
        // put log message
        $this->logger->info("getting items from this category");
		if(Category::find($args['category']) == null) {
			$this->response
				->withStatus(400)
				->withHeader('Content-Type', 'text/html')
				->write('Bad Request');
				return $this->response; 
		}
        $data = Item::where('category', $args['category'])->get();
        return $this->renderer->render(
			$response, 
			'all_data.phtml', 
			json_decode($data)
		);
    });
	/* UPDATE */
	$app->get('/categories/edit/{id}', function ($request, $response, $arg) {
        // put log message
        $this->logger->info("open form for editing category");
        $elem = Category::find($arg['id']);
		if($elem == null){
			$this->response
				->withStatus(400)
				->withHeader('Content-Type', 'text/html')
				->write('Bad Request');
				return $this->response; 
		}
        return $this->renderer->render(
			$response, 
			'category_form_update_delete.phtml', 
			$data = json_decode($elem, true)
		);
    });
	$app->put('/categories/edit/{id}', function ($request, $response, $args) {
        // put log message
        $this->logger->info("editing category");
		$item = $request->getParsedBody();
        try{
			$result = Category::where('id', $args['id'])->update([
				'name' => $item['name'],
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
			'category_form_update_delete.phtml', 
			$item
		);
    });
	/* DELETE */
	$app->delete('/categories/edit/{id}', function ($request, $response, $args) {
        // put log message
        $this->logger->info("deleting category");
		$data = Category::destroy($args['id']);
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