<?php
namespace controllers;

use services\controller;

/**
 * 
 */
class todosController extends controller
{
	
	function __construct($request)
	{
		parent::__construct($request);
	}

	public function indexAction () {                

		//$todo	= $this->getEntityManager('todo');

		$data['title']	=	'This is ToDos Page ';

		// +++++++++++++++++++++++++++++++++++++++++++++++
		// Not yet implemented foreach loops in view		
		// print all rows
		$data['content']	=	'';
		/*
		foreach ($todo->findAll() as $row) {
			$data['content']	.=	'<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["todo_name"].'</td>
				<td>'.$row["todo_description"].'</td>
				<td>
					<a href="/index.php/todos/view/'.$row["id"].'" data-modal>View</a> | 
					<a href="/index.php/todos/edit/'.$row["id"].'" data-modal>Edit</a> | 
					<a href="/index.php/todos/delete/'.$row["id"].'" data-modal>Delete</a>
				</td>
			</tr>';
		}
		*/
		// +++++++++++++++++++++++++++++++++++++++++++++++

		return $this->buildHtmlResponse($data);
	}

	public function viewAction() {
		$data['content']	=	'<div style="width:640px; height: 480px; display: inline-block;">
								  <p>This is the ToDos View</p>
								  <p><a href="#close" rel="modal:close">Close Window</p>
								</div>';
		return $this->buildResponse($data, 'modalView');
	}
}